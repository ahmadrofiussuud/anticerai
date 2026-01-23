<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DailyLog;
use App\Models\User;
use Carbon\Carbon;

class DailyLogSeeder extends Seeder
{
    public function run(): void
    {
        $amora = app(\App\Services\AmoraService::class);
        
        // Get all users to add daily logs
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->warn('No users found. Run TestAccountSeeder first.');
            return;
        }

        // Dummy activities for different users
        $activities = [
            [
                'activity' => 'Bekerja lembur menyelesaikan laporan',
                'category' => 'mental',
                'intensity' => 'high',
                'created_at' => Carbon::now()->subHours(5),
            ],
            [
                'activity' => 'Macet di jalan pulang dari kantor',
                'category' => 'physical',
                'intensity' => 'medium',
                'created_at' => Carbon::now()->subHours(4),
            ],
            [
                'activity' => 'Membereskan rumah dan mencuci baju',
                'category' => 'physical',
                'intensity' => 'high',
                'created_at' => Carbon::now()->subHours(3),
            ],
            [
                'activity' => 'Menyiapkan makan malam untuk keluarga',
                'category' => 'physical',
                'intensity' => 'medium',
                'created_at' => Carbon::now()->subHours(2),
            ],
            [
                'activity' => 'Meeting panjang dengan klien',
                'category' => 'mental',
                'intensity' => 'high',
                'created_at' => Carbon::now()->subHour(),
            ],
            [
                'activity' => 'Olahraga pagi jogging 5km',
                'category' => 'physical',
                'intensity' => 'medium',
                'created_at' => Carbon::now()->subMinutes(45),
            ],
            [
                'activity' => 'Belajar skill baru online',
                'category' => 'mental',
                'intensity' => 'medium',
                'created_at' => Carbon::now()->subMinutes(30),
            ],
            [
                'activity' => 'Bermain dengan anak-anak',
                'category' => 'physical',
                'intensity' => 'low',
                'created_at' => Carbon::now()->subMinutes(15),
            ],
        ];

        // Add activities for each user
        foreach ($users as $user) {
            // Add 3-5 random activities for each user
            $numActivities = rand(3, 5);
            $selectedActivities = array_rand(array_flip(array_keys($activities)), $numActivities);
            
            foreach ($selectedActivities as $index) {
                $activityData = $activities[$index];
                $log = DailyLog::create([
                    'user_id' => $user->id,
                    'activity' => $activityData['activity'],
                    'category' => $activityData['category'],
                    'intensity' => $activityData['intensity'],
                    'created_at' => $activityData['created_at'],
                ]);
                
                // Analyze partner state if Amora service is available
                if (method_exists($amora, 'analyzePartnerState')) {
                    $amora->analyzePartnerState($log);
                }
            }
        }

        $this->command->info('DailyLog seeder completed! Added dummy kabar hari ini for all users.');
    }
}
