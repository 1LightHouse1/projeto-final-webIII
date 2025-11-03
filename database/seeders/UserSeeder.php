<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Sistema',
            'email' => 'admin@ecommerce.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Usuario Teste',
            'email' => 'usuario@ecommerce.com',
            'password' => Hash::make('user123'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'João Silva',
            'email' => 'joao@ecommerce.com',
            'password' => Hash::make('user123'),
            'role' => 'user'
        ]);
    }
}
