<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Technology']);
        Category::create(['name' => 'Programming']);
        Category::create(['name' => 'Business']);
        Category::create(['name' => 'Lifestyle']);
        Category::create(['name' => 'Education']);
    }
}