<?php

use App\Models\Post;
use App\Models\User;
use Database\Seeders\ImageSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('new posts are saved from the create form', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('posts.store'), [
        'title' => 'A new post',
        'body' => 'The post content.',
    ]);

    $response->assertRedirect(route('posts.index'));
    $this->assertDatabaseHas('posts', [
        'title' => 'A new post',
        'body' => 'The post content.',
        'user_id' => $user->id,
    ]);
});

test('uploaded post images are stored and displayed with their author', function () {
    $this->travelTo('2026-10-19 05:56:29');
    Storage::fake('public');
    $user = User::factory()->create(['name' => 'Post author']);

    $response = $this->actingAs($user)->post(route('posts.store'), [
        'title' => 'A post with an image',
        'body' => 'Image content.',
        'images' => [UploadedFile::fake()->create('photo.jpg', 1)->mimeType('image/jpeg')],
    ]);

    $response->assertRedirect(route('posts.index'));
    $post = Post::query()->where('title', 'A post with an image')->firstOrFail();
    $image = $post->images()->firstOrFail();
    Storage::disk('public')->assertExists($image->path);

    $this->assertDatabaseHas('posts', ['id' => $post->id, 'user_id' => $user->id]);
    $this->get(route('post', $post))
        ->assertSee('Post author')
        ->assertSee(Storage::disk('public')->url($image->path))
        ->assertSee('October 19, 2026')
        ->assertDontSee('2 days ago');
});

test('image seeder creates images and the image factory URL is rendered directly', function () {
    $this->travelTo('2026-10-19 05:56:29');
    $post = Post::factory()->create();

    $this->seed(ImageSeeder::class);
    $image = $post->images()->firstOrFail();

    expect($image->path)->toStartWith('https://picsum.photos/');

    $this->get(route('post', $post))
        ->assertSee($image->path)
        ->assertSee($post->user->name);

    $this->seed(ImageSeeder::class);
    $this->assertDatabaseCount('images', 1);
});

test('edit form shows the post content and update URL', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $post = Post::factory()->for($user)->create([
        'title' => 'Existing title',
        'body' => 'Existing content.',
    ]);

    $response = $this->get(route('posts.edit', $post));

    $response->assertOk();
    $response->assertSee(route('posts.update', $post));
    $response->assertSee('Existing content.');

    $this->get(route('posts.index'))
        ->assertSee(route('posts.edit', $post));
});

test('post changes are saved from the edit form', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $post = Post::factory()->for($user)->create();

    $response = $this->put(route('posts.update', $post), [
        'title' => 'Updated title',
        'body' => 'Updated content.',
    ]);

    $response->assertRedirect(route('posts.index'));
    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'Updated title',
        'body' => 'Updated content.',
    ]);
});

test('a post without content is rejected before saving', function () {
    $response = $this->actingAs(User::factory()->create())->post(route('posts.store'), [
        'title' => 'A title without content',
    ]);

    $response->assertSessionHasErrors('body');
    $this->assertDatabaseCount('posts', 0);
});

test('an update without content is rejected without changing the post', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $post = Post::factory()->for($user)->create([
        'title' => 'Original title',
        'body' => 'Original content.',
    ]);

    $response = $this->put(route('posts.update', $post), [
        'title' => 'Changed title',
    ]);

    $response->assertSessionHasErrors('body');
    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'Original title',
        'body' => 'Original content.',
    ]);
});
