<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'nama' => 'Sports',
                'status' => 1
            ],
            [
                'nama' => 'National',
                'status' => 1
            ],
            [
                'nama' => 'Techology',
                'status' => 1
            ],
            [
                'nama' => 'Health',
                'status' => 1
            ]
        ];

        foreach ($categories as $key => $category) {
            Category::create($category);
        }
    }
}
