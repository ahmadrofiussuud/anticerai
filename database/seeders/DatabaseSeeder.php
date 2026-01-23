<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user for quick testing
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Run all seeders in order
        $this->call([
            TestAccountSeeder::class,    // Create test couples and users
            ActivitySeeder::class,        // Create activities catalog
            InsightSeeder::class,         // Create insights
            MemorySeeder::class,          // Create nostalgia/memories
            DailyLogSeeder::class,        // Create daily logs (kabar hari ini)
            GrowthMaterialSeeder::class,  // Create growth materials
        ]);
    }
}
