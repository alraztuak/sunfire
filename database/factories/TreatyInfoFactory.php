<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(\App\TreatyInfo::class, function (Faker $faker) {
    return [
        'kode' => $faker->numberBetween(100,120),
        'indonesia' => $faker->name(2),
        'english' => $faker->name(2),
        'splash' => $faker->url(),
        'status' => $faker->numberBetween(0,1),
        'create_by' => $faker->name,
        'update_by' => $faker->name
    ];
});
