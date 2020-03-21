<?php

use Illuminate\Database\Seeder;

class RecipeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id'=>1,'name'=>'Appetizer'],
            ['id'=>2,'name'=>'Soup'],
            ['id'=>3,'name'=>'Main Course'],
            ['id'=>4,'name'=>'Desert'],
            ['id'=>5,'name'=>'Pasta'],
        ];

        foreach ($items as $item){
            \recipeBook\RecipeCategory::updateOrCreate($item);
        }
    }
}
