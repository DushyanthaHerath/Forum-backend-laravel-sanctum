<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin User
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@app.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
            'avatar' => 'https://cdn.vuetifyjs.com/images/lists/1.jpg'
        ]);

        // Regular Users
        for ($i = 1; $i < 6; $i++) { // Ignoring factories to keep it simple

            $faker = Factory::create();
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $i == 1 ? 'user@app.com' : $faker->email,
                'password' => Hash::make('password'),
                'role_id' => 2,
                'avatar' => 'https://cdn.vuetifyjs.com/images/lists/' . $i . '.jpg'
            ]);

        }
    }
}
