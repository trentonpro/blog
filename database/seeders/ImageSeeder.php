<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::query()
            ->doesntHave('images')
            ->chunkById(100, function ($posts): void {
                foreach ($posts as $post) {
                    $post->images()->save(Image::factory()->make());
                }
            });
    }
}
