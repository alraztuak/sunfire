<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(\App\Treaty::class, function (Faker $faker) {
    return [
        'treaty_info_id' => $faker->numberBetween(1,20),
        'treaty_jenis_id' => $faker->numberBetween(1,4),
        'kode' => $faker->numberBetween(100,120),
        'judul' => $faker->paragraph(2),
        'isi_id' => $faker->paragraph(25),
        'isi_en' => $faker->paragraph(25),
        'views' => $faker->numberBetween(1,1000),
        'status' => $faker->numberBetween(0,1),
        'create_by' => $faker->name,
        'update_by' => $faker->name,
        'signed_at' => $faker->dateTime('now'),
        'published_at' => $faker->dateTime('now')
    ];
});
