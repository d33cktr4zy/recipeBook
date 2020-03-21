<?php

use Illuminate\Database\Seeder;

class IngredientCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $items = [
            ['id'=>1, 'name'=>'Bahan Pokok'],
            ['id'=>2, 'name'=>'Bumbu'],
            ['id'=>3, 'name'=>'Saus'],
            ['id'=>4, 'name'=>'Penyedap'],
            ['id'=>5, 'name'=>'Sayuran'],
            ['id'=>6, 'name'=>'Tambahan'],
        ];

        foreach($items as $item){
            \recipeBook\IngredientCategory::updateOrCreate($item);
        }
    }
}
