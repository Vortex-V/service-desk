<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Service\Service;
use App\Models\User\Enum\UserRole;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

final class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::where('role', UserRole::Manager)->chunkById(3, function (Collection $users): void {
            Service::factory()->faked()
                ->hasAttached($users,  relationship: 'users')
                ->createOne();
        });
    }
}
