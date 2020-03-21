<?php

use Illuminate\Database\Seeder;

class RecipeDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['recipe_id'=>1,'ingredient_id'=>5,'amount'=>'1 piring'],
            ['recipe_id'=>1,'ingredient_id'=>4,'amount'=>'secukupnya'],
            ['recipe_id'=>1,'ingredient_id'=>6,'amount'=>'2'],
            ['recipe_id'=>1,'ingredient_id'=>1,'amount'=>'5'],
            ['recipe_id'=>1,'ingredient_id'=>2,'amount'=>'5'],
            ['recipe_id'=>1,'ingredient_id'=>8,'amount'=>'5'],
            ['recipe_id'=>1,'ingredient_id'=>9,'amount'=>'secukupnya'],
            ['recipe_id'=>1,'ingredient_id'=>10,'amount'=>'secukupnya'],
            ['recipe_id'=>1,'ingredient_id'=>11,'amount'=>'secukupnya'],
        ];

        foreach ($items as $item){
            \recipeBook\RecipeDetail::updateOrCreate($item);
        }

        factory('recipeBook\RecipeDetail',100)->create();

    }
}
