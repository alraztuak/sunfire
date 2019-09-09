<?php

use Illuminate\Database\Seeder;

class AturanInfoseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AturanInfo::class, 10)->create();
    }
}
