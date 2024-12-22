<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User\Enum\UserRole;
use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

final class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->faked()->createOne([
            'name' => 'admin',
            'password' => Hash::make('admin'),
            'role' => UserRole::Admin,
        ]);
        User::factory(21)->faked()->create();
    }
}
