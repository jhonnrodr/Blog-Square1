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

    public function test_user_can_create_a_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();

        $response = $this->post(route('posts.store'), [
            'title' => 'random title',
            'description' =>  'Lorem Ipsum'
        ]);
        $this->assertDatabaseHas('posts', [
            'title' => 'random title'
        ]);
    }
}
