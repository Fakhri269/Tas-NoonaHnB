<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateUserNameSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')
            ->where('email', 'test@example.com')
            ->update(['name' => 'Muhamad Faqi Fairuz']);
        
        $this->command->info('User name updated to: Muhamad Faqi Fairuz');
    }
}
