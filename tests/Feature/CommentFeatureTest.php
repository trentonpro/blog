<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a signed-in user can add a comment to a post', function () {
    $this->travelTo('2026-10-19 05:56:29');
    $user = User::factory()->create(['name' => 'Comment author']);
    $post = Post::factory()->create();

    $response = $this->actingAs($user)->post(route('comments.store', $post), [
        'body' => 'This is a comment.',
    ]);

    $response->assertRedirect(route('post', $post));
    $this->assertDatabaseHas('comments', [
        'post_id' => $post->id,
        'user_id' => $user->id,
        'body' => 'This is a comment.',
    ]);

    $this->get(route('post', $post))
        ->assertSee('This is a comment.')
        ->assertSee('Comment author')
        ->assertSee('October 19, 2026 05:56');
});

test('a guest cannot add a comment', function () {
    $post = Post::factory()->create();

    $response = $this->post(route('comments.store', $post), ['body' => 'Guest comment']);

    $response->assertRedirect(route('login'));
    $this->assertDatabaseCount('comments', 0);
});

test('an empty comment is rejected without saving', function () {
    $post = Post::factory()->create();

    $response = $this->actingAs(User::factory()->create())
        ->from(route('post', $post))
        ->post(route('comments.store', $post), ['body' => '']);

    $response->assertRedirect(route('post', $post));
    $response->assertSessionHasErrors('body');
    $this->get(route('post', $post))->assertSee(route('comments.store', $post));
    $this->assertDatabaseCount('comments', 0);
});

test('post detail shows the comment form to signed-in users', function () {
    $post = Post::factory()->create();

    $response = $this->actingAs(User::factory()->create())->get(route('post', $post));

    $response->assertSee(route('comments.store', $post));
});

test('post detail prompts guests to sign in before commenting', function () {
    $post = Post::factory()->create();

    $response = $this->get(route('post', $post));

    $response->assertSee(route('login'));
    expect(Comment::query()->count())->toBe(0);
});
