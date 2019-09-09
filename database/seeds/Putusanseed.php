<?php

use Illuminate\Database\Seeder;

class Putusanseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Putusan::class, 5000)->create();
    }
}
