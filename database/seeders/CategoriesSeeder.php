<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{

    private $categories = [
        ['name' => 'RealEstate'],
        ['name' => 'vehicles'],
        ['name' => 'Electrical & Electronic Devices'],
        ['name' => 'Furniture'],
        ['name' => 'Animals'],
        ['name' => 'Personal collections'],
        ['name' => 'Clothing and fashion'],
        ['name' => 'Food and drinks'],
        ['name' => 'Services'],
        ['name' => 'Jobs'],
        ['name' => 'Books and hobbies'],
        ['name' => 'Toys Children\'s equipment'],
        ['name' => 'Sports and clubs'],
        ['name' => 'Industrial equipment'],
    ];

    public function run(): void
    {
        foreach ($this->categories as $category) {
            Category::create($category);
        }
    }
}
