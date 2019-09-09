<?php

use Illuminate\Database\Seeder;

class KppJenisseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\KppJenis::class, 5)->create();
    }
}
