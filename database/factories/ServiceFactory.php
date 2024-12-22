<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
final class ServiceFactory extends Factory
{
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    public function faked(): self
    {
        return $this->state(fn(array $attributes) => [
            'title' => fake()->jobTitle(),
        ]);
    }
}
