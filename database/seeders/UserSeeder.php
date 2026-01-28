<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@pmum.my.id',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@pmum.my.id',
            'username' => 'user',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);
    }
}
