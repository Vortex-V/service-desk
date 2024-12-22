<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Ticket\TicketPriority;
use Illuminate\Database\Seeder;

final class TicketPrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketPriority::factory()
            ->createMany([
                ['title' => 'Низкий'],
                ['title' => 'Средний'],
                ['title' => 'Высокий'],
                ['title' => 'Срочный'],
            ]);
    }
}
