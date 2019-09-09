<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ContentCat;
use Faker\Generator as Faker;

$factory->define(ContentCat::class, function (Faker $faker) {
    return [
        'judul' => $faker->name(2),
        'status' => $faker->numberBetween(0,1),
        'create_by' => $faker->name,
        'update_by' => $faker->name
    ];
});
