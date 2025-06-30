<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Criando o usuário master
        User::create([
            'name' => 'helder',
            'email' => 'helder@gmail.com',
            'email_verified_at' => now(),
            'telephone' => '(41) 98877-3355',
            'password' => Hash::make('12345678'), 
            'is_master' => true,
            'remember_token' => Str::random(10),
        ]);

        // Criando 10 usuários não-masters
        User::factory(10)->create([
            'is_master' => false, // Todos os usuários terão is_master como false
        ]);
    }
}
