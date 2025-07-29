<?php

namespace Database\Factories;

use App\Enums\ServiceStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $count = 1;

        return [
            'name' => 'Service ' . str_pad($count++, 2, '0', STR_PAD_LEFT),
            'description' => $this->faker->sentence(8),
            'price' => $this->faker->numberBetween(100, 1000),
            'status' => ServiceStatus::ACTIVE->value,
        ];
    }
}
