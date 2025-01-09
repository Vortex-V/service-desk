<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User\Contact;
use App\Models\User\Enum\UserRole;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
final class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): self
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function faked(): self
    {
        return $this->state(fn(array $attributes) => [
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => self::$password ??= Hash::make('testuser'),
            'remember_token' => Str::random(10),
        ])
            ->has(Contact::factory()->faked(), 'contact');
    }

    public function asManager(): UserFactory
    {
        return $this->state([
            'role' => UserRole::Manager,
        ]);
    }
}
