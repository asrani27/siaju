<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin
        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@siaju.go.id',
            'password' => Hash::make('dashword'),
            'role' => 'admin',
        ]);

        $this->command->info('admin user created: admin / dashword');
    }
}
