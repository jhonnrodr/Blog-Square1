<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_guest_can_not_see_dashboard()
    {
        $this->assertGuest();
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_user_can_see_dashboard()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user) ->get('/dashboard');
        $response->assertSee('Dashboard');
    }
}
