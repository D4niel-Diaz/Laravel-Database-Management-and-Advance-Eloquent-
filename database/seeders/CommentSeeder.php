<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentSeeder extends Seeder
{
    public function run()
    {

        $welcomePost = Post::where('title', 'Welcome to Our Blog!')->first();
        // Create comments for the welcome post
        $users = User::inRandomOrder()->take(5)->get();

        foreach ($users as $user) {
            Comment::create([
                'body' => fake()->sentence,
                'user_id' => $user->id,
                'post_id' => $welcomePost->id
            ]);
        }

        // create remaining comments randomly
        Comment::factory()->count(95)->create();
    }
}