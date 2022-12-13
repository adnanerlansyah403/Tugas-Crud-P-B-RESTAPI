<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $title = fake()->sentence();

        return [
            'title' => $title,
            'slug' => Str::slug($title, '-'),
            'body' => fake()->text(),
            'author_name' => fake()->unique()->name(),
            'category_id' => random_int(1, 4),
        ];

        
    }
}
