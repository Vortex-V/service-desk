<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Ticket\TicketType;
use Illuminate\Database\Seeder;

final class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketType::factory()
            ->createMany([
                ['title' => 'Ошибка'],
                ['title' => 'Вопрос'],
                ['title' => 'Предложение функционала'],
            ]);
    }
}
