<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => "Ahmad Rafi",
            'email' => "rafia9005@gmail.com",
            'password' => bcrypt('ahmadrafi01'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => "Asep Kurniawan",
            'email' => "asep@gmail.com",
            'password' => bcrypt('ahmadrafi01'),
            'role' => 'user',
        ]);
        User::create([
            'name' => "swakmkwa",
            'email' => "asepq@gmail.com",
            'password' => bcrypt('ahmadrafi01'),
            'role' => 'user',
        ]);
        User::create([
            'name' => "swakmkwdwada",
            'email' => "asedwapq@gmaial.com",
            'password' => bcrypt('ahmadrafi01'),
            'role' => 'user',
        ]);
        User::create([
            'name' => "swakmkwdwaa",
            'email' => "asepqwd@gmail.com",
            'password' => bcrypt('ahmadrafi01'),
            'role' => 'user',
        ]);
        User::create([
            'name' => "swakmkwa",
            'email' => "asepqdw@dwagmail.com",
            'password' => bcrypt('ahmadrafi01'),
            'role' => 'user',
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
