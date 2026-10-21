<?php

namespace Database\Seeders;
<<<<<<< HEAD

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
=======
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
>>>>>>> 83a15dc86e24ae1c8e4859fff5071065c75f580e
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
        //
    }
}
=======
        $users = User::select('id')->get();
        $posts = Post::factory(1000)->make()->sortBy('created_at');
        foreach($posts as $post) {
            Image::factory(rand(0, 5))->create(['post_id' => $post->id]);
        }
    }
}
>>>>>>> 83a15dc86e24ae1c8e4859fff5071065c75f580e
