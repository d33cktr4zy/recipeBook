<?php

use Illuminate\Database\Seeder;
use recipeBook\Recipe;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'Nasi Goreng', 'recipeCategory_id' => 3, 'step' => 'Masukkan nasi \n Masukkan telur \n masukkan bawang\n aduk dalam wajan\n dst','pax' => '3 piring'],

        ];

        foreach($items as $item){
            Recipe::updateOrCreate($item);
        }

        factory('recipeBook\Recipe', 9)->create();
    }
}
