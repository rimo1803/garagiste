<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
   User::factory()->state([
             'username' => 'admin',
             'firstname' => 'Rhimou',
             'lastname' => 'El harras',
             'address' => 'Martil',
             'phone' => '0642532183',
             'role' => 'Administrateur',
             'email' => 'admin@gmail.com',
             'password' =>Hash::make('admin'),
         ])->create();
        User::factory()->state([
            'username' => 'mech',
            'firstname' => 'Mechanic',
            'lastname' => 'Mechanic',
            'address' => 'Tetouan',
            'phone' => '05-598-259-5',
            'role' => 'Mecanicien',
            'email' => 'mechanic@gmail.com',
            'password' => Hash::make('mechanic'),
        ])->create();
        User::factory()->state([
            'username' => 'cli',
            'firstname' => 'Client',
            'lastname' => 'Client',
            'address' => 'mdiq',
            'phone' => '05554458',
            'role' => 'Client',
            'email' => 'client@gmail.com',
            'password' =>Hash::make('client'),
        ])->create();

    }
}
