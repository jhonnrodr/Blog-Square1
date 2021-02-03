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
    
    public function test_guest_can_see_the_blog()
    {
        $this->assertGuest()
        ->get('/')->assertSee('Home');
    }

    public function test_guest_cannot_see_the_dashboard()
    {
        $this->assertGuest()
        ->get('/posts')
        ->assertRedirect('/login');
    }

    public function test_user_can_see_the_dashboard()
    {
        $this->actingAs(User::factory()->create()->fresh())->get('/posts')
        ->assertSee('Manage Posts');
    }

    public function test_guest_can_register()
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
