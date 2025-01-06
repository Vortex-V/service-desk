<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Ticket\Ticket;
use App\Models\User\Enum\UserRole;
use App\Models\User\User;
use Illuminate\Database\Seeder;
final class TicketSeeder extends Seeder
{
    public function run(): void {
        User::whereNot('role', UserRole::Admin)->each(function ($user) {
           Ticket::factory(10)
               ->faked($user)
               ->create();
        });
    }
}
