<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testLogin()
    {
        $userData = [
            'email' => 'admin@gmail.com',
            'password' => 'password123',
        ];

        $response = $this->json('POST', '/api/auth/login', $userData);

        $response->assertStatus(200);
    }
}
