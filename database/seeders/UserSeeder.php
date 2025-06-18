<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'phone_number' => '0821234567',
            'address' => 'Jalan Raya Citayam, No.123, Kota Depok'
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('user123'),
            'role' => 'user',
            'phone_number' => '0123456789',
            'address' => 'Jalan Boulevard City, No. 100, Kota Casablanca'
        ]);

        User::create([
            'name' => 'User 2',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('user2123'),
            'role' => 'user',
            'phone_number' => '0888123457',
            'address' => 'Jalan Semanggi, No. 10, Kota Seoul'
        ]);
        User::create([
            'name' => 'gnarly',
            'email' => 'gnarly@gmail.com',
            'password' => bcrypt('gnarly'),
            'role' => 'admin',
            'phone_number' => '012223344',
            'address' => 'Kota Palembang'
        ]);
    }
}
