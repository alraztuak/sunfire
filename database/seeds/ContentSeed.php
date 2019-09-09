<?php

use Illuminate\Database\Seeder;

class ContentSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Content::class, 5000)->create();
    }
}
