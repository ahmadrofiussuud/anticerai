<?php

namespace Database\Seeders;

use App\Models\Insight;
use Illuminate\Database\Seeder;

class InsightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insights = [
            // Low Energy Triggers
            [
                'type' => 'text',
                'title' => '3 Cara Menenangkan Pasangan Lelah',
                'brief_text' => '1. Tawarkan air putih. 2. Jangan tanya "kenapa" dulu. 3. Beri pelukan diam selama 20 detik.',
                'trigger_context' => 'low_energy',
                'content_path' => null,
            ],
            [
                'type' => 'image',
                'title' => 'Cheat Sheet: Validasi Emosi',
                'brief_text' => 'Gunakan kalimat sakti: "Aku ngerti kamu capek banget hari ini. Sini istirahat dulu."',
                'trigger_context' => 'low_energy',
                'content_path' => 'https://placehold.co/600x400/rose/white?text=Validasi+Emosi',
            ],
            
            // Random Wisdom
            [
                'type' => 'audio',
                'title' => 'Pentingnya "Micro-Dates" - 1 Menit',
                'brief_text' => 'Dengarkan tips singkat tentang kencan 10 menit yang bisa mengubah mood seharian.',
                'trigger_context' => 'random',
                'content_path' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3', // Sample audio
            ],
            [
                'type' => 'text',
                'title' => 'The 5:1 Ratio Rule',
                'brief_text' => 'Riset John Gottman: Untuk setiap 1 interaksi negatif, butuh 5 interaksi positif untuk menyeimbangkannya.',
                'trigger_context' => 'random',
                'content_path' => null,
            ],
            [
                'type' => 'image',
                'title' => 'Love Map Question',
                'brief_text' => 'Tanya pasanganmu: "Siapa teman masa kecil yang paling dia ingat?"',
                'trigger_context' => 'random',
                'content_path' => 'https://placehold.co/600x400/indigo/white?text=Love+Map',
            ],
             [
                'type' => 'text',
                'title' => 'Ritual Pulang Kerja',
                'brief_text' => 'Sambut pasangan di pintu seperti kamu menyambut tamu agung. Senyum + Peluk = Dopamin.',
                'trigger_context' => 'random',
                'content_path' => null,
            ],
        ];

        foreach ($insights as $insight) {
            Insight::create($insight);
        }
    }
}
