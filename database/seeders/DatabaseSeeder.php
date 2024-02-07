<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Offices::factory(10)->create();
        \App\Models\Drivers::factory(10)->create();
        \App\Models\Vehicles::factory(10)->create();
        \App\Models\Events::factory(10)->create();
        \App\Models\Requestors::factory(10)->create();
        \App\Models\Reservations::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
