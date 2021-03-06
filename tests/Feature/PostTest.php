<?php

namespace Tests\Feature;

use App\Jobs\AutoPostImportJob;
use Artisan;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan as FacadesArtisan;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user can create a post
     */
    public function test_user_can_create_a_posts(): void
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

    /**
     * Test unregistered user cannot create a post
     */
    public function test_guest_cannot_create_a_posts(): void
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

    /**
     * Test user can see his/her own post
     */
    public function test_user_can_see_his_post(): void
    {
        $user = User::factory()->create()->fresh();
        
        $this->actingAs($user)->post(route('posts.store'), [
            'title' => 'random title',
            'description' =>  'Lorem Ipsum'
        ]);

        $response = $this->get('/posts');
        $response->assertSee('random title');
    }

    /**
     * Test user cannot see posts from other users
     */
    public function test_user_cannot_see_posts_from_other_user_in_the_dashboard(): void
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

    /**
     * Test AutoPostImporter job
     */
    public function test_see_if_auto_post_import_executed(): void
    {
        Queue::fake();

        Artisan::call('cron:auto-post-import');

        Queue::assertPushed(AutoPostImportJob::class);
    }
}
