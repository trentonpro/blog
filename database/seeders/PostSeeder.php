<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use RuntimeException;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::query()->pluck('id');

        if ($userIds->isEmpty()) {
            throw new RuntimeException('Run UserSeeder before PostSeeder.');
        }

        Post::query()->whereNull('user_id')->chunkById(100, function ($posts) use ($userIds): void {
            foreach ($posts as $post) {
                $post->user_id = $userIds->random();
                $post->save();
            }
        });

        $postsToCreate = max(0, 1000 - Post::query()->count());
        $posts = Post::factory($postsToCreate)
            ->state(fn (array $attributes): array => ['user_id' => $userIds->random()])
            ->make()
            ->sortBy('created_at');
        foreach ($posts as $post) {
            $post->save();
        }
    }
}
