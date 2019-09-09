<?php

use Illuminate\Database\Seeder;

class AturanTopikseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AturanTopik::class, 8)->create();
    }
}
