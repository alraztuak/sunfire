<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */


use Faker\Generator as Faker;

$factory->define(\App\Content::class, function (Faker $faker) {
    return [
        'content_cat_id' => $faker->numberBetween(1,6),
        'judul' => $faker->paragraph(2),
        'sumber' => $faker->name,
        'info' => $faker->paragraph(2),
        'isi' => $faker->paragraph(25),
        'url' => $faker->url,
        'splash' => $faker->url,
        'views' => $faker->numberBetween(1,1000),
        'status' => $faker->numberBetween(0,1),
        'create_by' => $faker->name,
        'update_by' => $faker->name
    ];
});
