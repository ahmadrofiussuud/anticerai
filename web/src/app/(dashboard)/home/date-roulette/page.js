"use client";

import DateRoulette from "@/components/features/date-roulette/DateRoulette";
import DateRouletteHero from "@/components/features/date-roulette/DateRouletteHero";

export default function DateRoulettePage() {
    return (
        <div className="min-h-screen bg-[#FDFBF7]">
            <DateRouletteHero />

            <div id="activities" className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 scroll-mt-12">
                <DateRoulette />
            </div>
        </div>
    );
}
