<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created = fake()->dateTimeBetween();
        $updated = fake()->dateTimeBetween($created);
        if(rand(0, 9)){
            $updated = $created;
        }

        $imageurl = null;
        if(rand(0, 9)){
            $imageurl = 'https://picsum.photos/seed/'.fake()->uuid().'/1280/960';
        }
        return [
            'title' => fake()->sentence(),
            'body' => fake()->paragraphs(6, true),
            'created_at' => $created,
            'updated_at' => $updated,
        ];
    }
}