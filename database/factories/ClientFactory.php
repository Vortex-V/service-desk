<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Client\Client;
use App\Models\Client\LegalDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Client>
 */
final class ClientFactory extends Factory
{
    protected $model = Client::class;

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
        return $this->state(fn (array $attributes) => [
            'name' => fake()->company(),
        ])
            ->has(LegalDetail::factory()->faked());
    }


}
