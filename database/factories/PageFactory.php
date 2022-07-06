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

$factory->define(App\Page::class, function (Faker $faker) {
    return [
        'page_name' => str_random(50),
        'page_slug' => str_random(50),
        'page_img' => str_random(5).".png",
        'page_content' => str_random(20),
        'user_id' => '1',
    ];
});
