<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'cat_name' => str_random(50),
        'cat_slug' => str_random(50),
        'cat_description' => str_random(100),
        'cat_order' => rand(1,5),
        ];
});
