<?php

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('new posts are saved from the create form', function () {
    $response = $this->post(route('posts.store'), [
        'title' => 'A new post',
        'body' => 'The post content.',
    ]);

    $response->assertRedirect(route('posts.index'));
    $this->assertDatabaseHas('posts', [
        'title' => 'A new post',
        'body' => 'The post content.',
    ]);
});

test('edit form shows the post content and update URL', function () {
    $post = Post::factory()->create([
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
    $post = Post::factory()->create();

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
    $response = $this->post(route('posts.store'), [
        'title' => 'A title without content',
    ]);

    $response->assertSessionHasErrors('body');
    $this->assertDatabaseCount('posts', 0);
});

test('an update without content is rejected without changing the post', function () {
    $post = Post::factory()->create([
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
