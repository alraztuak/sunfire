<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Aturan;
use Faker\Generator as Faker;

$factory->define(Aturan::class, function (Faker $faker) {
    return [
        'nomor' => $faker->bothify('PMK/##/??/2018'),
        'nomor_index' => $faker->randomNumber(2),
        'perihal' => $faker->sentence(5),
        'isi' => $faker->paragraph(50),
        'aturan_jenis_id' => $faker->randomNumber(4),
        'aturan_info_id' => $faker->randomNumber(1),
        'lampiran'=> $faker->url(),
        'pdf' => $faker->url(),
        'views' => $faker->numberBetween(1,1000),
        'status' => $faker->numberBetween(0,1),
        'create_by' => $faker->name,
        'update_by' => $faker->name,
        'published_at' => $faker->dateTime('now')
    ];
});
