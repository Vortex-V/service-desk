<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Client\Client;
use App\Models\Ticket\Enum\TicketStatus;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketPriority;
use App\Models\Ticket\TicketType;
use App\Models\User\Enum\UserRole;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
final class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => TicketStatus::New,
            'author_id' => auth()->id(),
        ];
    }

    public function faked(User $author)
    {
        return $this->state(function () use ($author) {
            $client = match ($author->role) {
                UserRole::Client => $author->client()->first(),
                UserRole::Manager => Client::whereManager($author)->get()->random(),
            };
            return [
                'client_id' => $client->id,
                'applicant_id' => $client->users()->get()->random()->id,
                'service_id' => $client->services()->get()->random()->id,
                'type_id' => TicketType::all()->random()->id,
                'priority_id' => TicketPriority::all()->random()->id,
                'description' => fake()->text(),
                'author_id' => $author->id
            ];
        });
    }
}
