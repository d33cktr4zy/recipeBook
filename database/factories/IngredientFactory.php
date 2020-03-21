<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use recipeBook\Ingredient;
use Faker\Generator as Faker;

$factory->define(Ingredient::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Food($faker));
    return [
        //
        'name' => $faker->unique()->ingredient,
        'ingredientCategory_id' => $faker->randomElement($array=array(1,2,3,4,5,6))


    ];
});
