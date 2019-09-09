<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::where('email', 'yoga.alkautzar@gmail.com')->first();

        if(!$user){
            User::create([
            'name' => "Yoga Alkautzar",
            'email' => "yoga.alkautzar@gmail.com",
            'password' => Hash::make('Ogay0647')
            ]);
        }
    }
}
