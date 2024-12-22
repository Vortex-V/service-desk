<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Client\Client;
use App\Models\Service\Service;
use App\Models\User\Enum\UserRole;
use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

final class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::chunkById(3, function (Collection $services): void {
            Client::factory(5)->faked()
                ->has(
                    User::factory(20)->faked()
                    ->set('role', UserRole::Client)
                )
                ->hasAttached($services, relationship: 'services')
                ->create();
        });
    }
}
