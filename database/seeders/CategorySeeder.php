<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            ['name' => 'Fashion'],
            ['name' => 'Electronics'],
            ['name' => 'Home & Living'],
            ['name' => 'Sports'],
            ['name' => 'Books']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
