<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanBeCreatedWithApiKey()
    {
        // Arrange: Create test user data
        $userData = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'yoursecurepassword'
        ];

        // Act: Make a POST request to your endpoint
        $response = $this->postJson('/api/generate-api-key', $userData);

        // Assert: Check if the user was created and the API key was generated
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'user' => [
                    'name',
                    'email',
                    'api_token'
                ],
                'api_token'
            ]);

        // Assert: Check if the user was saved to the database
        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'email' => $userData['email']
        ]);

        // Retrieve the API key from the response
        $apiKey = $response->getData()->api_token;

        // Log the API key
        Log::info('API Key: ' . $apiKey);
    }
}
