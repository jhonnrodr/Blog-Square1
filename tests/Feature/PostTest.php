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

    public function test_user_can_see_his_post()
    {
        $user = User::factory()->create()->fresh();
        
        $this->actingAs($user)->post(route('posts.store'), [
            'title' => 'random title',
            'description' =>  'Lorem Ipsum'
        ]);

        $response = $this->get('/posts');
        $response->assertSee('random title');
    }

    public function test_user_cannot_see_posts_from_other_user_in_the_dashboard()
    {
        $user1 = User::factory()->create()->fresh();
        $user2 = User::factory()->create()->fresh();

        $this->actingAs($user1)->post(route('posts.store'), [
            'title' => 'random title',
            'description' =>  'Lorem Ipsum'
        ]);

        $this->actingAs($user2)->post(route('posts.store'), [
            'title' => 'other title',
            'description' =>  'Lorem Ipsum'
        ]);

        $response = $this->actingAs($user1)->get('/posts');
        $response->assertDontSee('other title');

        $response = $this->actingAs($user2)->get('/posts');
        $response->assertDontSee('random title');
    }
}
