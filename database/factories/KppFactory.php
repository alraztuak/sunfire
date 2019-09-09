<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(\App\Kpp::class, function (Faker $faker) {
    return [
        'kpp_jenis_id' => $faker->numberBetween(1,5),
        'kodekpp' => $faker->numberBetween(100,120),
        'kodewil' => $faker->numberBetween(100,120),
        'nama' => $faker->name(2),
        'kota' => $faker->name(1),
        'lurah' => $faker->name(1),
        'camat' => $faker->name(1),
        'alamat' => $faker->paragraph(25),
        'telepon' => $faker->randomNumber(8),
        'fax' => $faker->randomNumber(8),
        'views' => $faker->numberBetween(1,1000),
        'status' => $faker->numberBetween(0,1),
        'create_by' => $faker->name,
        'update_by' => $faker->name
    ];
});
