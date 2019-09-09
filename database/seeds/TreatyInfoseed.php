<?php

use Illuminate\Database\Seeder;

class TreatyInfoseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TreatyInfo::class, 20)->create();
    }
}
