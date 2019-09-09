<?php

use Illuminate\Database\Seeder;

class PutusanCatseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PutusanCat::class, 18)->create();
    }
}
