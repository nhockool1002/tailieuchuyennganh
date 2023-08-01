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

$factory->define(App\Pokemon::class, function (Faker $faker) {
    return [
        'name' => $faker->text(30),
        'description' => $faker->text(200),
        'content' => $faker->text(1000),
        'base_on' => $faker->text(5),
        'version' => $faker->text(5),
        'thumb' => 'https://picsum.photos/536/354',
        'author' => $faker->name,
        'author_bio' => 'https://tailieuchuyennganh.com',
        'url' => 'https://tailieuchuyennganh.com',
        'url2' => 'https://tailieuchuyennganh.com',
    ];
});
