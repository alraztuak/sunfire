<?php

use Illuminate\Database\Seeder;

class Kppseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Kpp::class, 1000)->create();
    }
}
