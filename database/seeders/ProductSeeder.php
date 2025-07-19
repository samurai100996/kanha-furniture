<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Modern Sectional Sofa',
                'description' => 'A comfortable and stylish 3-seater sectional sofa perfect for modern living rooms.',
                'price' => 1299.99,
                'discount' => 10,
                'category' => 'Living Room',
                'image' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=500'
            ],
            [
                'name' => 'Wooden Coffee Table',
                'description' => 'Elegant wooden coffee table with storage compartments.',
                'price' => 599.99,
                'discount' => 15,
                'category' => 'Living Room',
                'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=500'
            ],
            [
                'name' => 'Queen Size Bed Frame',
                'description' => 'Sturdy wooden bed frame with headboard, queen size.',
                'price' => 899.99,
                'discount' => 0,
                'category' => 'Bedroom',
                'image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=500'
            ],
            [
                'name' => 'Bedside Table Set',
                'description' => 'Set of 2 matching bedside tables with drawers.',
                'price' => 399.99,
                'discount' => 20,
                'category' => 'Bedroom',
                'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=500'
            ],
            [
                'name' => '6-Seater Dining Table',
                'description' => 'Large wooden dining table that seats 6 people comfortably.',
                'price' => 1199.99,
                'discount' => 5,
                'category' => 'Dining Room',
                'image' => 'https://images.unsplash.com/photo-1449247709967-d4461a6a6103?w=500'
            ],
            [
                'name' => 'Dining Chairs Set',
                'description' => 'Set of 6 comfortable upholstered dining chairs.',
                'price' => 899.99,
                'discount' => 12,
                'category' => 'Dining Room',
                'image' => 'https://images.unsplash.com/photo-1581539250439-c96689b516dd?w=500'
            ],
            [
                'name' => 'Executive Office Desk',
                'description' => 'Large L-shaped office desk with built-in storage.',
                'price' => 799.99,
                'discount' => 8,
                'category' => 'Office',
                'image' => 'https://images.unsplash.com/photo-1541558869434-2840d308329a?w=500'
            ],
            [
                'name' => 'Ergonomic Office Chair',
                'description' => 'High-back ergonomic office chair with lumbar support.',
                'price' => 449.99,
                'discount' => 25,
                'category' => 'Office',
                'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=500'
            ],
            [
                'name' => '5-Shelf Bookcase',
                'description' => 'Tall wooden bookcase with 5 adjustable shelves.',
                'price' => 299.99,
                'discount' => 0,
                'category' => 'Storage',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500'
            ],
            [
                'name' => 'Storage Ottoman',
                'description' => 'Multi-functional storage ottoman with removable lid.',
                'price' => 149.99,
                'discount' => 30,
                'category' => 'Storage',
                'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=500'
            ]
        ];

        foreach ($products as $productData) {
            $category = Category::where('name', $productData['category'])->first();
            
            Product::create([
                'name' => $productData['name'],
                'slug' => Str::slug($productData['name']),
                'description' => $productData['description'],
                'price' => $productData['price'],
                'discount' => $productData['discount'],
                'image' => $productData['image'],
                'category_id' => $category->id
            ]);
        }
    }
}
