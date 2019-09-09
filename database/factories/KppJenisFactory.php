<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\KppJenis;
use Faker\Generator as Faker;

$factory->define(KppJenis::class, function (Faker $faker) {
    return [
        'judul' => $faker->name(1),
        'status' => $faker->numberBetween(0,1),
        'create_by' => $faker->name,
        'update_by' => $faker->name
    ];
});
