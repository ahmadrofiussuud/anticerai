<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Memory;
use App\Models\Couple;
use Carbon\Carbon;

class MemorySeeder extends Seeder
{
    public function run(): void
    {
        // Get all couples to add memories
        $couples = Couple::all();
        
        // Clear existing memories to prevent duplicates/broken data
        Memory::query()->delete();

        if ($couples->isEmpty()) {
            $this->command->warn('No couples found. Run TestAccountSeeder first.');
            return;
        }

        foreach ($couples as $couple) {
            // Dummy nostalgia data for each couple
            $memories = [
                [
                    'title' => 'Pernikahan Kami',
                    'description' => 'Hari paling indah dalam hidup kami. Dikelilingi keluarga dan teman-teman tersayang.',
                    'memory_date' => Carbon::now()->subYears(2),
                    'tags' => ['wedding', 'celebration', 'love'],
                    'image_path' => 'https://images.unsplash.com/photo-1519225468063-501861532f62?w=800&q=80',
                ],
                [
                    'title' => 'Liburan ke Bali',
                    'description' => 'Menikmati sunset di pantai Kuta bersama. Momen yang tak terlupakan.',
                    'memory_date' => Carbon::now()->subYear()->subMonths(6),
                    'tags' => ['vacation', 'beach', 'romantic'],
                    'image_path' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&q=80',
                ],
                [
                    'title' => 'Anniversary Pertama',
                    'description' => 'Dinner romantis di restoran favorit. Terima kasih untuk tahun pertama yang luar biasa!',
                    'memory_date' => Carbon::now()->subYear(),
                    'tags' => ['anniversary', 'dinner', 'celebration'],
                    'image_path' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=800&q=80',
                ],
                [
                    'title' => 'Pindahan Rumah Baru',
                    'description' => 'Memulai babak baru di rumah impian kami. Kompak membereskan dan menata ruangan.',
                    'memory_date' => Carbon::now()->subMonths(8),
                    'tags' => ['home', 'milestone', 'teamwork'],
                    'image_path' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800&q=80',
                ],
                [
                    'title' => 'Memasak Bersama',
                    'description' => 'Pertama kali berhasil masak rendang! Walau dapurnya agak berantakan, tapi hasilnya enak.',
                    'memory_date' => Carbon::now()->subMonths(4),
                    'tags' => ['cooking', 'fun', 'quality-time'],
                    'image_path' => 'https://images.unsplash.com/photo-1507048331197-7d4ac70811cf?w=800&q=80',
                ],
                [
                    'title' => 'Nonton Konser Favorit',
                    'description' => 'Akhirnya bisa nonton konser band kesukaan kita bareng. Seru banget!',
                    'memory_date' => Carbon::now()->subMonths(2),
                    'tags' => ['music', 'concert', 'entertainment'],
                    'image_path' => 'https://images.unsplash.com/photo-1429962714451-bb934ecdc4ec?w=800&q=80',
                ],
                [
                    'title' => 'Piknik di Taman',
                    'description' => 'Weekend santai dengan piknik di taman. Bawa bekal dan main badminton.',
                    'memory_date' => Carbon::now()->subMonth(),
                    'tags' => ['outdoor', 'picnic', 'recreation'],
                    'image_path' => 'https://images.unsplash.com/photo-1623479322729-28b25c16b011?w=800&q=80',
                ],
                [
                    'title' => 'Date Night Spesial',
                    'description' => 'Nonton film romantis di bioskop, lanjut makan malam di cafe cozy.',
                    'memory_date' => Carbon::now()->subWeeks(2),
                    'tags' => ['date-night', 'movies', 'romantic'],
                    'image_path' => 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?w=800&q=80',
                ],
            ];

            foreach ($memories as $memoryData) {
                Memory::create([
                    'couple_id' => $couple->id,
                    'title' => $memoryData['title'],
                    'description' => $memoryData['description'],
                    'memory_date' => $memoryData['memory_date'],
                    'tags' => $memoryData['tags'],
                    'image_path' => $memoryData['image_path'],
                ]);
            }
        }

        $this->command->info('Memory seeder completed! Added dummy nostalgia data for all couples.');
    }
}
