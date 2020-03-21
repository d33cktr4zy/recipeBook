<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use recipeBook\RecipeDetail;
use Faker\Generator as Faker;

$factory->define(RecipeDetail::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Food($faker));
    return [
        'recipe_id' => $faker->randomElement($array=array(2,3,4,5,6,7,8,9,10)),
        'ingredient_id'=>$faker->randomDigitNotNull(),
        'amount' => $faker->measurement(),


        //
    ];
});
