<?php

namespace Tests\Feature\Service;

use App\Enums\UserRoles;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_services_list()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        Service::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/services');

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'price',
                        'status',
                    ],
                ],
            ]);
    }

    public function test_admin_can_create_a_service()
    {
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => UserRoles::ADMIN->value,
        ]);

        Sanctum::actingAs($user);

        $response = $this->postJson('/api/v1/services', [
            'name' => 'My Service',
            'description' => 'Service Description',
            'price' => 500,
            'status' => 'active',
        ]);

        $response->assertCreated();
    }
}
