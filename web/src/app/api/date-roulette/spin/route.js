import { NextResponse } from "next/server";
import { AmoraService } from "@/lib/services/amoraService";

// Fallback activities from Laravel
const FALLBACK_ACTIVITIES = [
    {
        id: 1,
        title: 'Makan Malam Romantis',
        description: 'Masak makanan spesial bersama di rumah dengan cahaya lilin.',
        icon: '🍽️',
        image: 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=400&h=300&fit=crop',
        category: 'Indoor',
        budget: 'Low',
        atmospheres: ['Romantis', 'Ngobrol Santai']
    },
    {
        id: 2,
        title: 'Piknik di Taman',
        description: 'Nikmati udara segar dengan membawa bekal favorit ke taman kota.',
        icon: '🧺',
        image: 'https://images.unsplash.com/photo-1551524559-8af4e6624178?w=400&h=300&fit=crop',
        category: 'Outdoor',
        budget: 'Low',
        atmospheres: ['Romantis', 'Keluarga', 'Ngobrol Santai']
    },
    {
        id: 3,
        title: 'Nonton Film di Rumah',
        description: 'Marathon film favorit dengan popcorn dan selimut hangat.',
        icon: '🎬',
        image: 'https://images.unsplash.com/photo-1522869635100-9f4c5e86aa37?w=400&h=300&fit=crop',
        category: 'Indoor',
        budget: 'Low',
        atmospheres: ['Romantis', 'Keluarga']
    },
    {
        id: 4,
        title: 'Kelas Memasak Bersama',
        description: 'Ikuti kelas memasak atau coba resep baru bersama di dapur.',
        icon: '👨‍🍳',
        image: 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=400&h=300&fit=crop',
        category: 'Indoor',
        budget: 'Medium',
        atmospheres: ['Ngobrol Santai', 'Romantis']
    },
    {
        id: 5,
        title: 'Hiking & Sunrise',
        description: 'Mendaki gunung untuk menyaksikan matahari terbit bersama.',
        icon: '⛰️',
        image: 'https://images.unsplash.com/photo-1551632811-561732d1e306?w=400&h=300&fit=crop',
        category: 'Outdoor',
        budget: 'Low',
        atmospheres: ['Petualangan', 'Romantis']
    },
    {
        id: 6,
        title: 'Spa Day at Home',
        description: 'Manjakan diri dengan spa treatment di rumah.',
        icon: '💆',
        image: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=400&h=300&fit=crop',
        category: 'Indoor',
        budget: 'Medium',
        atmospheres: ['Romantis', 'Hemat']
    },
    {
        id: 7,
        title: 'Kunjungan Museum',
        description: 'Jelajahi seni dan budaya di museum atau galeri lokal.',
        icon: '🎨',
        image: 'https://images.unsplash.com/photo-1554907984-15263bfd63bd?w=400&h=300&fit=crop',
        category: 'Indoor',
        budget: 'Low',
        atmospheres: ['Ngobrol Santai', 'Keluarga']
    },
    {
        id: 8,
        title: 'Beach Sunset',
        description: 'Saksikan sunset romantis di pantai sambil jalan-jalan.',
        icon: '🏖️',
        image: 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400&h=300&fit=crop',
        category: 'Outdoor',
        budget: 'Low',
        atmospheres: ['Romantis', 'Ngobrol Santai']
    },
    {
        id: 9,
        title: 'Fine Dining',
        description: 'Rayakan malam istimewa di restoran mewah favorit.',
        icon: '🥂',
        image: 'https://images.unsplash.com/photo-1514933651103-005eec06c04b?w=400&h=300&fit=crop',
        category: 'Indoor',
        budget: 'High',
        atmospheres: ['Romantis']
    },
    {
        id: 10,
        title: 'Game Night',
        description: 'Malam seru dengan board games dan snacks favorit.',
        icon: '🎮',
        image: 'https://images.unsplash.com/photo-1610890716171-6b1bb98ffd09?w=400&h=300&fit=crop',
        category: 'Indoor',
        budget: 'Low',
        atmospheres: ['Keluarga', 'Ngobrol Santai', 'Hemat']
    }
];

export async function POST(req) {
    try {
        const body = await req.json();
        const { mood, budget, location, atmosphere } = body;

        // 1. Try AI First
        const aiResult = await AmoraService.generateDateIdea({ mood, budget, location, atmosphere });

        if (aiResult) {
            return NextResponse.json({
                ...aiResult,
                image: location === 'Outdoor'
                    ? 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=500&q=80'
                    : 'https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=500&q=80',
                source: 'AI'
            });
        }

        // 2. Fallback to Hardcoded List (Filtered)
        let filtered = FALLBACK_ACTIVITIES.filter(a => {
            if (location && a.category !== location) return false;
            if (budget && a.budget !== budget) return false;
            // Loose filter for atmosphere
            return true;
        });

        if (filtered.length === 0) filtered = FALLBACK_ACTIVITIES;

        const random = filtered[Math.floor(Math.random() * filtered.length)];

        return NextResponse.json({
            ...random,
            source: 'FALLBACK'
        });

    } catch (error) {
        console.error("Date Spin Error:", error);
        return NextResponse.json({ error: "Internal Server Error" }, { status: 500 });
    }
}
