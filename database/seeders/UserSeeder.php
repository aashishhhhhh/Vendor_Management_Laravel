<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker= Faker::create();
        for ($i=0; $i<5  ; $i++) { 
            User::create(
                [
                    'name'=>$faker->userName,
                    'email'=>$faker->email,
                    'password'=>Hash::make('12345678')
                ]
                );            
        }
    }
}
