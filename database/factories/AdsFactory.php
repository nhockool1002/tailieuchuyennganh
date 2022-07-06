<?php

use Faker\Generator as Faker;

$factory->define(App\Ads::class, function (Faker $faker) {
    return [
        'ads_zone' => str_random(10),
        'target_link' => \Constant::URL_HOME,
        'ads_img' => \Constant::URL_HOME.'img/nblogsite.png'
    ];
});
