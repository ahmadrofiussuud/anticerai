<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrowthMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Videos
        \App\Models\GrowthMaterial::create([
            'title' => 'Cara Menjadi Pendengar yang Baik',
            'type' => 'video',
            'url' => 'https://www.youtube.com/watch?v=7uV_V07p7Sg', // The School of Life - How to Listen
            'thumbnail_url' => 'https://images.unsplash.com/photo-1511895426328-dc8714191300?w=600&h=400&fit=crop',
            'duration' => '5:30',
            'views' => '1.2k',
            'category' => 'Komunikasi',
        ]);
        \App\Models\GrowthMaterial::create([
            'title' => 'Psikologi Di Balik Pilihan Pasangan',
            'type' => 'video',
            'url' => 'https://www.youtube.com/watch?v=-EvvPZFdjyk',
            'thumbnail_url' => 'https://images.unsplash.com/photo-1621621667797-e06afc217fb0?w=600&h=400&fit=crop',
            'duration' => '8:15',
            'views' => '3.5k',
            'category' => 'Psikologi',
        ]);
        \App\Models\GrowthMaterial::create([
            'title' => 'Seni Meminta Maaf',
            'type' => 'video',
            'url' => 'https://www.youtube.com/watch?v=tzSRE-mI0v8',
            'thumbnail_url' => 'https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=600&h=400&fit=crop',
            'duration' => '10:00',
            'views' => '890',
            'category' => 'Pertumbuhan',
        ]);
        \App\Models\GrowthMaterial::create([
            'title' => 'Mengatasi Konflik dengan Sehat',
            'type' => 'video',
            'url' => 'https://www.youtube.com/watch?v=oW2v8zXmO0k',
            'thumbnail_url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=600&h=400&fit=crop',
            'duration' => '6:45',
            'views' => '2.1k',
            'category' => 'Resolusi Konflik',
        ]);

        // Articles
        \App\Models\GrowthMaterial::create([
            'title' => '5 Cara Memahami Pasangan dengan Mendengar',
            'type' => 'article',
            'thumbnail_url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=200&h=200&fit=crop',
            'subtitle' => 'Solusi ringan, hubungan berkualitas.',
            'description' => 'Mendengarkan aktif adalah salah satu alat paling kuat dalam membangun hubungan yang kuat. Ini bukan hanya tentang mendengar kata-kata, tapi memahami emosi di baliknya...',
            'category' => 'Komunikasi',
        ]);
        \App\Models\GrowthMaterial::create([
            'title' => 'Mencegah Konflik dalam Hubungan',
            'type' => 'article',
            'thumbnail_url' => 'https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=200&h=200&fit=crop',
            'subtitle' => 'Solusi ringan, hubungan berkualitas.',
            'description' => 'Memahami pemicu dan pola komunikasi dapat membantu mencegah konflik sebelum meledak menjadi pertengkaran besar...',
            'category' => 'Konflik',
        ]);
        \App\Models\GrowthMaterial::create([
            'title' => 'Membangun Resiliensi Keluarga',
            'type' => 'article',
            'thumbnail_url' => 'https://images.unsplash.com/photo-1511895426328-dc8714191300?w=200&h=200&fit=crop',
            'subtitle' => 'Solusi ringan, hubungan berkualitas.',
            'description' => 'Ketahanan keluarga dibangun melalui pengalaman bersama dan dukungan timbal balik di masa-masa sulit...',
            'category' => 'Ketahanan',
        ]);
        \App\Models\GrowthMaterial::create([
            'title' => '10 Kebiasaan Baik untuk Pasangan',
            'type' => 'article',
            'thumbnail_url' => 'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=200&h=200&fit=crop',
            'subtitle' => 'Solusi ringan, hubungan berkualitas.',
            'description' => 'Kebiasaan kecil sehari-hari dapat membuat perbedaan besar dalam kualitas hubungan jangka panjang...',
            'category' => 'Kebiasaan',
        ]);
    }
}
