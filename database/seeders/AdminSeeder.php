<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@tasnoonahnb.com'],
            [
                'name'     => 'Admin Tas NoonaHnB',
                'email'    => 'admin@tasnoonahnb.com',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Upgrade existing test user to admin too (optional)
        User::where('email', 'test@example.com')->update(['role' => 'user']);

        $this->command->info('Admin created: admin@tasnoonahnb.com / admin123');
    }
}
