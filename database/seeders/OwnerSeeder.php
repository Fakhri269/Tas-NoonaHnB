<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    public function run(): void
    {
        // Validasi: hanya boleh 1 akun owner
        if (User::where('role', 'owner')->exists()) {
            $this->command->error('Role owner hanya boleh 1 akun');
            return;
        }

        User::create([
            'name'     => 'Owner',
            'email'    => 'owner@gmail.com',
            'password' => Hash::make('owner123'),
            'role'     => 'owner',
        ]);

        $this->command->info('Akun owner berhasil dibuat! (owner@gmail.com / owner123)');
    }
}
