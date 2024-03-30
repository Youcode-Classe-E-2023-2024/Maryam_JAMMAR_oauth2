<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testLogout()
    {
        // Create a user
        $user = User::factory()->create();

        // Acting as the user
        $this->actingAs($user, 'api');

        // Attempt to logout
        $response = $this->json('POST', '/api/auth/logout');

        // Assert successful logout
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'User logged out successfully'
            ]);

        // Assert the user's token has been revoked
        $this->assertNull($user->refresh()->token());
    }
}
