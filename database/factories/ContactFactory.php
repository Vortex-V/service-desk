<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

/**
 * @extends Factory<Contact>
 */
final class ContactFactory extends Factory
{
    protected $model = Contact::class;

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
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'patronymic' => fake()->emoji(),
            'phone' => fake()->e164PhoneNumber(),
        ])
            ->sequence(
                fn(Sequence $sequence) => [
                    'first_name' => fake()->firstNameMale(),
                    'last_name' => fake()->lastName('male'),
                ],
                fn(Sequence $sequence) =>              [
                    'first_name' => fake()->firstNameFemale(),
                    'last_name' => fake()->lastName('female'),
                ],
            );
    }
}
