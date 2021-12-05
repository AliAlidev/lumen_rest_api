<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition(): array
    {
    	return [
    	    'title' => $this->faker->title(),
    	    'body' => $this->faker->text(),
    	];
    }
}
