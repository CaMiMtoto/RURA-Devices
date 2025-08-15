<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        if (User::query()->exists()) {
            return;
        }

        User::query()->create([
            'name' => 'RURA Admin',
            'email' => 'admin@rura.rw',
            'username' => 'admin@rura.rw',
            'password' => bcrypt('password'),
            'is_super_admin' => true,
            'phone_number' => '0780000000',
            'email_verified_at' => now(),
        ]);
    }
}
