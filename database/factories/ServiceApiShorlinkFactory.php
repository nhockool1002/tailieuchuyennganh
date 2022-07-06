<?php

use Faker\Generator as Faker;

$factory->define(App\ServiceApiShortLink::class, function (Faker $faker) {
   return [
        'name_service' => str_random(15),
        'key_service' => str_random(15),
        'api_service_url' => str_random(15)
    ];
});
