<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use recipeBook\Recipe;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'name'=>$faker->sentence($nbWords=3,$variableNbWords=true),
        'recipeCategory_id' => $faker->randomElement($array=array(1,2,3,4,5)),
        'step' => $faker->paragraphs($nb=3,$asText=true),
        'user_id' => $faker->randomElement($array=array(1,2,3)),
        'pax' => $faker->randomElement($array = array('1 piring', '2 piring', '3 piring')),
        'image' => $faker->imageUrl($width=600, $height=600,'food'),
    ];
});
