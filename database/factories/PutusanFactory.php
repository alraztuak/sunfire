<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(\App\Putusan::class, function (Faker $faker) {
    return [
        'putusan_cat_id' => $faker->numberBetween(1,17),
        'putusan_jenis_id' => $faker->numberBetween(1,2),
        'tahun' => $faker->numberBetween(1998,2019),
        'judul' => $faker->paragraph(2),
        'info' => $faker->paragraph(2),
        'isi' => $faker->paragraph(25),
        'views' => $faker->numberBetween(1,1000),
        'status' => $faker->numberBetween(0,1),
        'create_by' => $faker->name,
        'update_by' => $faker->name,
        'published_at' => $faker->dateTime('now')
    ];
});
