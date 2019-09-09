<?php

use Illuminate\Database\Seeder;

class ContentCatSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ContentCat::class, 5)->create();
    }
}
