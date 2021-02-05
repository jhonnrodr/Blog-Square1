<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test guest can see the blog homepage
     */
    public function test_guest_can_see_the_blog(): void
    {
        $this->assertGuest()
        ->get('/')->assertSee('Home');
    }

    /**
     * Test unauthenticated user cannot see the dashboard
     */
    public function test_guest_cannot_see_the_dashboard(): void
    {
        $this->assertGuest()
        ->get('/posts')
        ->assertRedirect('/login');
    }

    /**
     * Test authenticated user can see dashboard
     */
    public function test_user_can_see_the_dashboard(): void
    {
        $this->actingAs(User::factory()->create()->fresh())->get('/posts')
        ->assertSee('Manage Posts');
    }

    /**
     * Test guest can regiter/signup
     */
    public function test_guest_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
