<?php

namespace Database\Seeders;

use App\Models\Couple;
use App\Models\User;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find or create the main test user
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );

        // Find or create the partner
        $partner = User::firstOrCreate(
            ['email' => 'partner@example.com'],
            ['name' => 'Partner', 'password' => bcrypt('password')]
        );

        // Create the couple relationship
        // Assuming user is husband and partner is wife for simplicity, or vice versa
        // We'll check if a couple already exists
        $existingCouple = Couple::where('husband_id', $user->id)
            ->orWhere('wife_id', $user->id)
            ->first();

        if (!$existingCouple) {
            $couple = Couple::create([
                'husband_id' => $user->id,
                'wife_id' => $partner->id,
                'pairing_code' => 'AUTO01',
                'anniversary_date' => now()->subYears(5), // 5 Years together
            ]);

            // Update users foreign keys
            $user->update(['couple_id' => $couple->id]);
            $partner->update(['couple_id' => $couple->id]);
        }
    }
}
