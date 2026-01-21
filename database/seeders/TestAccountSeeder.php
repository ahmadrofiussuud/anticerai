<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Couple;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TestAccountSeeder extends Seeder
{
    public function run(): void
    {
        // Cleanup existing test users to avoid duplicate errors
        User::whereIn('email', [
            'suami@example.com',
            'istri@example.com', 
            'budi@example.com', 
            'siti@example.com'
        ])->delete();

        // 1. Create Paired Couple (Suami & Istri)
        $husband = User::create([
            'name' => 'Suami Test',
            'email' => 'suami@example.com',
            'password' => Hash::make('password123'),
        ]);

        $wife = User::create([
            'name' => 'Istri Test',
            'email' => 'istri@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Create Couple
        $couple = Couple::create([
            'husband_id' => $husband->id,
            'wife_id' => $wife->id,
            'pairing_code' => 'COUPLE', // Static code for testing
            'anniversary_date' => Carbon::now()->subYears(2),
        ]);

        $husband->update(['couple_id' => $couple->id]);
        $wife->update(['couple_id' => $couple->id]);

        // 2. Create Unpaired Users
        $budi = User::create([
            'name' => 'Budi (Belum Pasangan)',
            'email' => 'budi@example.com',
            'password' => Hash::make('password123'),
        ]);

        $siti = User::create([
            'name' => 'Siti (Punya Kode)',
            'email' => 'siti@example.com',
            'password' => Hash::make('password123'),
            'pairing_code' => 'SITI12',
            'pairing_code_expires_at' => Carbon::now()->addHours(24),
        ]);

        $this->command->info("Test Accounts Created Successfully!");
        $this->command->table(
            ['Role', 'Name', 'Email', 'Password', 'Status', 'Code'],
            [
                ['Suami', 'Suami Test', 'suami@example.com', 'password123', 'Connected', '-'],
                ['Istri', 'Istri Test', 'istri@example.com', 'password123', 'Connected', '-'],
                ['Single 1', 'Budi', 'budi@example.com', 'password123', 'Not Connected', '-'],
                ['Single 2', 'Siti', 'siti@example.com', 'password123', 'Not Connected', 'SITI12'],
            ]
        );
    }
}
