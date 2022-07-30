<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Samsung Galaxy',
                'description' => 'Samsung Brand',
                'image' => 'storage/images/admin5.jpg',
                'price' => '100',
                'category_id' => 1
            ],
            [
                'name' => 'Apple iPhone 12',
                'description' => 'Apple Brand',
                'image' => 'storage/images/admin5.jpg',
                'price' => '500',
                'category_id' => 1
            ],
            [
                'name' => 'Google Pixel 2 XL',
                'description' => 'Google Pixel Brand',
                'image' => 'storage/images/admin5.jpg',
                'price' => '400',
                'category_id' => 1
            ],
            [
                'name' => 'LG V10 H800',
                'description' => 'LG Brand',
                'image' => 'storage/images/admin5.jpg',
                'price' => '200',
                'category_id' => 1
            ]
        ];
  
        foreach ($products as $key => $value) {
            Product::create($value);
        }
    }
    
}
