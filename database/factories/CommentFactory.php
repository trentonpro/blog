<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created = fake()->dateTimeBetween();
        $updated = fake()->dateTimeBetween($created, (clone $created)->modify('+3 days'));
        if (rand(0, 9)) {
            $updated = $created;
        }

        return [
            'body' => fake()->sentence(),
            'created_at' => $created,
            'updated_at' => $updated,
        ];

        return [
            //
        ];
    }
}
