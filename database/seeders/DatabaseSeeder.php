<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Seat;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::create([
        //     'firstName' => 'User',
        //     'lastName' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'phone' => '0812345678910',
        //     'password' => Hash::make('qazwsx'),
        //     'is_admin' => true,
        // ]);

        // User::create([
        //     'firstName' => 'Dummy',
        //     'lastName' => 'User',
        //     'email' => 'user@gmail.com',
        //     'phone' => '0812345678911',
        //     'password' => Hash::make('qazwsx'),
        //     'is_admin' => false,
        // ]);

        // User::factory(10)->create();
        // Seat::factory(10)->create();

        // Seat::factory()->maker('Z', 5, 'vip', 10000);
    }
}
