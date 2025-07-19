<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Living Room', 'icon' => '🛋️'],
            ['name' => 'Bedroom', 'icon' => '🛏️'],
            ['name' => 'Dining Room', 'icon' => '🍽️'],
            ['name' => 'Office', 'icon' => '💼'],
            ['name' => 'Storage', 'icon' => '📦']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
