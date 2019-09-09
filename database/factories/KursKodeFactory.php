<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\KursKode;
use Faker\Generator as Faker;

$factory->define(KursKode::class, function (Faker $faker) {
    return [
        'kode' => $faker->numberBetween(100,130),
        'judul' => $faker->name(1),
        'satuan' => $faker->numberBetween(0,1),
        'kursmk' => $faker->numberBetween(0,1),
        'kursbi' => $faker->numberBetween(0,1),
        'splash' => $faker->url(),
        'status' => $faker->numberBetween(0,1),
        'create_by' => $faker->name,
        'update_by' => $faker->name
    ];
});
