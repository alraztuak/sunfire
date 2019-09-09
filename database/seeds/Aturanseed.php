<?php

use Illuminate\Database\Seeder;

class Aturanseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Aturan::class, 20000)->create();
    }
}
