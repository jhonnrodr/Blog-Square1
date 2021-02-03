<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_a_posts()
    {
        $this->actingAs(User::factory()->create()->fresh())
        ->assertAuthenticated()
        ->post(route('posts.store'), [
            'title' => 'random title',
            'description' =>  'Lorem Ipsum'
        ]);
        $this->assertDatabaseHas('posts', [
            'title' => 'random title'
        ]);
    }

    public function test_guest_cannot_create_a_posts()
    {
        $this->assertGuest()
        ->post(route('posts.store'), [
            'title' => 'guest title',
            'description' =>  'Lorem Ipsum'
        ]);
        $this->assertDatabaseMissing('posts', [
            'title' => 'guest title'
        ]);
    }
}
