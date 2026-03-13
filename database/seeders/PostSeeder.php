<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Create a specific post
        Post::create([
            'title' => 'Welcome to Our Blog!',
            'content' => 'This is the first post of our blog.',
            'user_id' => 1,
            'category_id' => 1,
            'status' => 'published'
        ]);


        Post::factory()->published()->count(25)->create();
        Post::factory()->draft()->count(5)->create();
    }
}