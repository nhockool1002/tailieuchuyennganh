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

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'post_name' => str_random(50),
        'post_slug' => str_random(50),
        'post_img' => str_random(5).".png",
        'post_content' => str_random(20),
        'post_special' => rand(0,1),
        'cat_id' => rand(1,5),
        'user_id' => '1',
    ];
});
