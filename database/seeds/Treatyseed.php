<?php

use Illuminate\Database\Seeder;

class Treatyseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Treaty::class, 5000)->create();
    }
}
