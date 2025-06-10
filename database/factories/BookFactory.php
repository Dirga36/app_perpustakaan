<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'content' => fake()->paragraphs(50, true),
            'author' => fake()->name(),
            // 'cover' => fake()->image(null, 640, 480),
            'publisher' => fake()->company(),
            'publication_date' => fake()->date(),
            'status' => fake()->randomElement(['Available', 'Not Available']),
        ];
    }
}
