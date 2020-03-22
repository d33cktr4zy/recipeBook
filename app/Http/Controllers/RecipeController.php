<?php

namespace recipeBook\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use recipeBook\Recipe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()) {
            //will return recipe with this user and public
            $recipes = \recipeBook\Recipe::where('user_id', '=', Auth::id())->orWhere('user_id', '=', 0)->get();

        } else {
            $recipes = \recipeBook\Recipe::where('user_id', '=', 0)->get();

        }

        foreach ($recipes as $r) {
            $ind = $r->details;
            $ingredients = [];
            foreach ($ind as $i) {
                $ingredients[] = [
                    'name' => $i->ingredient->name,
                    'amount' => $i->amount,

                ];
            }

            $respon[] = [
                'name' => $r->name,
                'category' => $r->category->name,
                'image' => $r->image,
                'ingredient' => $ingredients,
                'step' => $r->step,
                'pax' => $r->pax,

            ];
            unset($ind, $ingredients);
        }


        return response()->json($respon, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        dd($request);

        if (Auth::check()) {
            try {
                //make new recipe with the user id
                $resep = new \recipeBook\Recipe;

                $resep->user_id = Auth::id();
                $resep->name = $request->nama_resep;
//                $resep->image = $request->image;
                $resep->recipeCategory_id = $request->kat_resep;
                $resep->step = $request->langkah;
                $resep->pax = $request->penyajian;
//                dd($request->bahan);
                $resep->save();
                //resep sudah naik

                //get the recipeId
                $idResep = $resep->id;

            } catch (Exception $e) {
                // cannot make resep
                return response()->json($e->getMessage(), 300);
            }

            // make ingredient
            //sekarang bikin ingrdientnya
            try {
                //check if the recipe is already in recipe detail before star making recipeDetail entry
                if (\recipeBook\RecipeDetail::recipeExsist($idResep)) {
                    //id recipe sudah ada yang pakai di recipeDetail
                    $message = "I don't know what happened, but your new recipe detail has already have an owner.
                                    Please contact Admin!";
                    return response()->json($message, 300);
                }
                //no recipe_id yang sama dengan $idResep di table recipeDetail
                $details=[];
                foreach ($request->bahan as $key => $i) {
                    $ingr = new \recipeBook\RecipeDetail;
                    $ingr->recipe_id = $idResep;
                    //check inggredient
                    if (\recipeBook\Ingredient::ingredCheck($i['nama'])) {
                        //inggrideient is already listed So we just get the id
                        $ingr->ingredient_id = \recipeBook\Ingredient::getId($i['nama']);
                    } else {
                        // which means new inggredient
                        try {
                            $ings = new \recipeBook\Ingredient;
                            $ings->name = $i['nama'];
                            $ings->ingredientCategory_id = $i['igrCat']; //todo this need to be replace with variable

                            $ings->save();
                            //then we get the new id
                            $ingr->ingredient_id = $ings->id;
                        } catch (Exception $e) {
                            //cannot make  new ingredient
                        }
                    }
                    $ingr->amount = $i['amount'];
                    $ingr->save();
//
                    $details[$ingr->ingredient->name]=$ingr;
                }
            } catch (Exception $e) {
                //one of the recipe detail failed
            }
            $resp=[
                'message' => 'Your New Recipe has been created!. Thank You.',
                'result' => [
                    'resep' => $resep,
                    'bahan' => $details
                ],
            ];
            return response()->json($resp, 200);
        }

        //user not loggedin > no can do make new recipe
        return response()->json('You are not logged in. You are not authorized for the action.', 401);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     * Update fields
     */
    public function store(Request $request, $id)
    {
//        dd($request->query, $id);
        //first get the recipe
        try{
            $recipe = Recipe::findOrFail($id);
        }catch (ModelNotFoundException $e){
            //No model
        }
        $data = $request;
//        dd($data->details);
        //not failing, then we continue updating the thing
        //update recipe master
        $recipe->name = isset($data->name) ? $data->name : $recipe->name;
        $recipe->image = isset($data->image) ?$data->image:$recipe->image;
        $recipe->recipeCategory_id = isset($data->recipeCategory_id)?$data->recipeCategory_id:$recipe->recipeCategory_id;
        $recipe->step= isset($data->step) ?$data->step:$recipe->step;
        $recipe->pax= isset($data->pax) ?$data->pax:$recipe->pax;


        foreach($data->details as $i){
            //since the details is a dropdown, if there is no id then new details
            if(isset($i['id'])){
            // we don't make new ingredients
            $a = $recipe->details->where('ingredient_id',$i['id'])->first(); //the record
            $a->amount = $i['amount'];
            }else{
                //if no id is set
                $newDet = new \recipeBook\RecipeDetail;
                $newDet->recipe_id = $id;

            }

        }

        //update recipe detail
        //should not update ingredient directly/ doit using ingredient endpoint
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //authenticate user


        try {
            $recipeUser = \recipeBook\Recipe::findOrFail($id)->user_id;

            if (Auth::user()) {
                // user have logged in
                if ($recipeUser == Auth::id() or $recipeUser == 0) {
                    //if the reciepe is owned by the user

                    return response()->json($this->makeSingleRecipe($id), 200);
                } else {
                    return response()->json('You are not authorized to view the Recipe. This is not your Recipe', 401);
                }
            } else {
                //when its a guest
                if ($recipeUser > 0) {
                    //guest have no authority to view owned recipes
                    return response()->json('You are not authorized to view the Recipe. Maybe login First?! ', 401);
                }
                //but if the recipe has no user_id (public) alow them to view it
                return response()->json($this->makeSingleRecipe($id), 200);
            }


        } catch (ModelNotFoundException $e) {
            return response()->json('No Recipe with that ID', 404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function makeSingleRecipe($id)
    {
        //the recipe with the id should exist because we have try it before went to this function
        $rec = Recipe::find($id);
        $ingredient = [];

        foreach ($rec->details as $key => $ig) {
            $ingredient[] = [
                $key => [
                    'nama_bahan' => $ig->ingredient->name,
                    'takaran' => $ig->amount
                ],
            ];
        }

        $data = [
            'nama_masakan' => $rec->name,
            'pemilik' => $this->getUserName($rec->user_id),
            'image' => $rec->image,
            'bahan' => $ingredient,
            'langkah' => $rec->step,
            'penyajian' => $rec->pax

        ];
        return $data;
    }

    public function getUserName($id)
    {
        try {
            $user = \recipeBook\User::findOrFail($id);
            return $user->name;

        } catch (ModelNotFoundException $e) {
            return 'Umum';
        }
    }

    public function showform($for='recipe',$state = 'new', $data='')
    {
        if($for == 'new'){
            // just display blank form
        }
    }


}
