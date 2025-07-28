<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_successfully()
    {
        $user = User::factory()->create([
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/v1/login', [
            'email' => 'jane@example.com',
            'password' => 'password',
        ]);

        $response->assertOk()->assertJsonStructure(['data']);
    }

    public function test_login_fails_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('correct-password'),
        ]);

        $response = $this->postJson('/api/v1/login', [
            'email' => 'test@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(401)
                 ->assertJson(['message' => 'Email or Password is wrong.']);
    }

    public function test_login_fails_with_non_existing_user()
    {
        $user = User::factory()->create([
            'email' => 'test02@example.com',
            'password' => bcrypt('correct-password'),
        ]);

        $response = $this->postJson('/api/v1/login', [
            'email' => 'test01@example.com',
            'password' => 'correct-password',
        ]);

        $response->assertStatus(422)
         ->assertJsonValidationErrors(['email'])
         ->assertJson([
                'message' => "User doesn't exist.",
                'errors' => [
                    'email' => ["User doesn't exist."],
            ],
        ]);
    }

    public function test_login_fails_with_missing_fields()
    {
        $response = $this->postJson('/api/v1/login', [
            'email' => '',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email', 'password']);
    }
}
