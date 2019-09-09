<?php

use Illuminate\Database\Seeder;

class TreatyJenisseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TreatyJenis::class, 4)->create();
    }
}
