<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Shortword::class, function (Faker $faker) {
    return [
        'short_url' => 'https://hallnet.com',
        'long_url' => 'https://hallnet.com',
        'counter' => 0,
        'active'=>false,
        'description' => 'No description',
    ];
});
