<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Client\LegalDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LegalDetail>
 */
final class LegalDetailFactory extends Factory
{
    protected $model = LegalDetail::class;

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
            'inn' => fake()->inn10(),
            'kpp' => fake()->kpp(),
            'ogrn' => fake()->numerify('#############'),
            'bik' => fake()->numerify('#########'),
            'country' => fake()->country(),
            'city' => fake()->city(),
            'street' => fake()->streetName(),
            'house' => fake()->buildingNumber(),
            'postcode' => fake()->postcode(),
        ]);
    }
}
