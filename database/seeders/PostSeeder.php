<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for($i=0; $i<20;$i++) {
            DB::table('posts')->insert([
                    'title' => $faker->sentence,
                    'content' => $faker->text(2000),
                    'category_id' => $faker->numberBetween(1, 7),
                    'posted_by' => $faker->numberBetween(1, 5),
                    'approved_by' => 1
                ]
            );
        }
    }
}
