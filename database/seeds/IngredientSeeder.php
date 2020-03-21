<?php

use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name'=>'Bawang Merah','ingredientCategory_id'=>2],
            ['id'=>2, 'name'=>'Cabai','ingredientCategory_id'=>2],
            ['id'=>3, 'name'=>'Daun Sop','ingredientCategory_id'=>5],
            ['id'=>4, 'name'=>'Minyak Goreng','ingredientCategory_id'=>6],
            ['id'=>5, 'name'=>'Nasi Putih','ingredientCategory_id'=>1],
            ['id'=>6, 'name'=>'Telur','ingredientCategory_id'=>1],
            ['id'=>7, 'name'=>'Bawang Putih','ingredientCategory_id'=>2],
            ['id'=>8, 'name'=>'Cesim','ingredientCategory_id'=>5],
            ['id'=>9, 'name'=>'Ayam','ingredientCategory_id'=>1],
            ['id'=>10, 'name'=>'Kecap','ingredientCategory_id'=>3],
            ['id'=>11, 'name'=>'Garam','ingredientCategory_id'=>4],
        ];

        foreach($items as $item){
            \recipeBook\Ingredient::updateOrCreate($item);
        }

        factory('recipeBook\Ingredient', 20)->create();
    }
}
