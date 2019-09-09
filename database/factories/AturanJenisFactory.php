<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\AturanJenis;
use Faker\Generator as Faker;

$factory->define(AturanJenis::class, function (Faker $faker) {
    return [
        'id' => $faker->numberBetween(1,1000),
        'judul' => $faker->name(2),
        'status' => $faker->numberBetween(0,1),
        'create_by' => $faker->name,
        'update_by' => $faker->name
    ];
});
