<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activities = [
            ['title' => 'Masak Bareng Resep Baru', 'category' => 'Food', 'description' => 'Cari resep viral di TikTok dan coba masak bareng. Gagal atau enak, yang penting seru!', 'estimated_cost' => '$'],
            ['title' => 'Jalan Sore di Taman', 'category' => 'Chill', 'description' => 'Nikmati udara segar sambil ngobrol deep talk tanpa gangguan HP.', 'estimated_cost' => 'Free'],
            ['title' => 'Nonton Film Jadul', 'category' => 'Chill', 'description' => 'Rewatch film favorit masa kecil atau film klasik romantis sambil makan popcorn.', 'estimated_cost' => '$'],
            ['title' => 'Cari Martabak Hidden Gem', 'category' => 'Food', 'description' => 'Jelajahi kota demi menemukan martabak legendaris yang belum pernah dicoba.', 'estimated_cost' => '$$'],
            ['title' => 'Night Ride Keliling Kota', 'category' => 'Adventure', 'description' => 'Naik motor atau mobil santai keliling kota di malam hari sambil dengerin playlist favorit.', 'estimated_cost' => '$'],
            ['title' => 'Museum Date', 'category' => 'Chill', 'description' => 'Kunjungi museum lokal dan pura-pura jadi kritikus seni profesional.', 'estimated_cost' => '$'],
            ['title' => 'Picnic di Halaman/Teras', 'category' => 'Food', 'description' => 'Gelar tikar, bawa snack, dan nikmati sore di rumah dengan suasana beda.', 'estimated_cost' => '$'],
            ['title' => 'Board Game War', 'category' => 'Adventure', 'description' => 'Main Uno, Monopoli, atau Catur. Yang kalah harus mijitin yang menang!', 'estimated_cost' => 'Free'],
            ['title' => 'DIY Crafting', 'category' => 'Chill', 'description' => 'Bikin gelang couple, lukis pot, atau origami bareng.', 'estimated_cost' => '$$'],
            ['title' => 'Street Food Hunting', 'category' => 'Food', 'description' => 'Jajan bakso bakar, cilok, atau telur gulung di pinggir jalan.', 'estimated_cost' => '$'],
            ['title' => 'Karaoke di Rumah', 'category' => 'Adventure', 'description' => 'Nyanyi sekeras-kerasnya di ruang tamu. Duet lagu galau wajib hukumnya.', 'estimated_cost' => 'Free'],
            ['title' => 'Sunset Hunting', 'category' => 'Adventure', 'description' => 'Cari spot terbaik buat liat matahari terbenam. Jangan lupa foto siluet!', 'estimated_cost' => 'Free'],
            ['title' => 'Bookstore Date', 'category' => 'Chill', 'description' => 'Pergi ke toko buku, pilihkan buku buat pasangan, dan baca bareng di cafe.', 'estimated_cost' => '$$'],
            ['title' => 'Video Game Marathon', 'category' => 'Adventure', 'description' => 'Co-op game seperti It Takes Two atau Overcooked sampai tamat (atau sampai berantem).', 'estimated_cost' => 'Free'],
            ['title' => 'Fancy Dinner at Home', 'category' => 'Food', 'description' => 'Dandan rapi, pasang lilin, dan makan mie instan tapi plating ala fine dining.', 'estimated_cost' => '$'],
        ];

        foreach ($activities as $activity) {
            Activity::create($activity);
        }
    }
}
