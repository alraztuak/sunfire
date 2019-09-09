<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\PutusanCat;
use Faker\Generator as Faker;

$factory->define(PutusanCat::class, function (Faker $faker) {
    return [
        'judul' => $faker->name(2),
        'status' => $faker->numberBetween(0,1),
        'create_by' => $faker->name,
        'update_by' => $faker->name
    ];
});
