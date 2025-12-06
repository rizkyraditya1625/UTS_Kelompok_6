<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::create([
            'name' => 'Administrator',
            'nim' => 'ADMIN001',
            'email' => 'admin@unikom.ac.id',
            'password' => Hash::make('admin1234'),
            'role' => 'ADMIN'
            // Rating dihapus
        ]);
        
        // Akun Contoh
        User::create([
            'name' => 'Mahasiswa Contoh',
            'nim' => '10123000',
            'email' => 'mhs@unikom.ac.id',
            'password' => Hash::make('123456'),
            'role' => 'USER'
        ]);
    }
}