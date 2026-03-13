<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

class PostFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(3, true),

            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,

            'status' => 'published',
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now')
        ];
    }

    public function published()
    {
        return $this->state([
            'status' => 'published'
        ]);
    }

    public function draft()
    {
        return $this->state([
            'status' => 'draft'
        ]);
    }
}