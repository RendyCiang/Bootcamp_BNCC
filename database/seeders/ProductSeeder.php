<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $products = [
            [
                'name' => 'T-Shirt',
                'price' => 100000,
                'quantity' => 10,
                'category_id' => Category::where('name', 'Fashion')->first()->id,
                'photo' => 'tshirt.jpg',
            ],
            [
                'name' => 'Laptop',
                'price' => 7000000,
                'quantity' => 5,
                'category_id' => Category::where('name', 'Electronics')->first()->id,
                'photo' => 'laptop.jpg',
            ],
            [
                'name' => 'Sofa',
                'price' => 2500000,
                'quantity' => 2,
                'category_id' => Category::where('name', 'Home & Living')->first()->id,
                'photo' => 'sofa.jpg',
            ],
            [
                'name' => 'Basketball',
                'price' => 350000,
                'quantity' => 8,
                'category_id' => Category::where('name', 'Sports')->first()->id,
                'photo' => 'basketball.jpg',
            ],
            [
                'name' => 'Novel',
                'price' => 75000,
                'quantity' => 20,
                'category_id' => Category::where('name', 'Books')->first()->id,
                'photo' => 'novel.jpg',
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
