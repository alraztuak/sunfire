<?php

use Illuminate\Database\Seeder;

class KursKodeseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\KursKode::class, 30)->create();
    }
}
