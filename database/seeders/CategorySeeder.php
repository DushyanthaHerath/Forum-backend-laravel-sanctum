<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'action' => 'mdi-ticket',
                'title' => 'Attractions',
            ],
            [
                'action' => 'mdi-silverware-fork-knife',
                'title' => 'Dining',
            ],
            [
                'action' => 'mdi-school',
                'title' => 'Education',
            ],
            [
                'action' => 'mdi-human-male-female-child',
                'title' => 'Family',
            ],
            [
                'action' => 'mdi-bottle-tonic-plus',
                'title' => 'Health',
            ],
            [
                'action' => 'mdi-briefcase',
                'title' => 'Office',
            ],
            [
                'action' => 'mdi-tag',
                'title' => 'Promotions',
            ]
        ])->each(function ($item) {
            DB::table('categories')->insert([
                'name' => $item['title'],
                'icon' => $item['action']
            ]);
        });
    }
}
