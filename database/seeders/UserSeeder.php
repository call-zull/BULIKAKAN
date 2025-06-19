<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'username' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'status_user' => 'official',
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        $berwenang = User::create([
            'username' => 'Berwenang',
            'email' => 'berwenang@example.com',
            'password' => Hash::make('password'),
            'status_user' => 'official',
            'email_verified_at' => now(),
        ]);
        $berwenang->assignRole('berwenang');
    }
}
