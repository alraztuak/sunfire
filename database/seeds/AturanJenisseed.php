<?php

use Illuminate\Database\Seeder;

class AturanJenisseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AturanJenis::class, 50)->create();
    }
}
