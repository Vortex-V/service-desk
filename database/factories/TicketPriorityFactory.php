<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Ticket\TicketPriority;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TicketPriority>
 */
final class TicketPriorityFactory extends Factory
{
    protected $model = TicketPriority::class;

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
}
