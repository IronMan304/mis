<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'John',
            'middle_name' => 'Admin',
            'last_name' => 'Doe',
            'position' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ])->assignRole('admin');
        User::create([
            'first_name' => 'jerecho rey',
            'middle_name' => '',
            'last_name' => 'inatilleza',
            'username' => 'jerechorey',
            'email' => 'jerecho@gmail.com',
            'password' => bcrypt('jerecho123')
        ])->assignRole('customer');
    }
}
