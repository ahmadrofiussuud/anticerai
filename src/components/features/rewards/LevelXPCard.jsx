"use client";

import { motion } from "framer-motion";
import { Trophy, Star } from "lucide-react";

export default function LevelXPCard({ level, xp, nextXp = 500 }) {
    const progress = (xp / nextXp) * 100;

    return (
        <div className="bg-white rounded-[2rem] p-8 border border-black/5 shadow-sm h-full flex flex-col justify-between">
            <div className="flex items-start justify-between">
                <div>
                    <span className="text-[10px] font-bold text-[#C67C5C] uppercase tracking-[0.2em] mb-2 block">Level Anda</span>
                    <h3 className="text-3xl font-serif font-bold text-[#2A3C2A]">{level} Level</h3>
                </div>
                <div className="w-12 h-12 bg-[#FDFBF7] rounded-2xl flex items-center justify-center border border-black/5">
                    <Trophy className="w-6 h-6 text-[#C67C5C]" />
                </div>
            </div>

            <div className="mt-8">
                <div className="flex items-end justify-between mb-3">
                    <span className="text-2xl font-serif font-bold text-[#2A3C2A]">
                        {xp} <span className="text-sm font-sans font-bold text-[#6B7C6B] ml-1">/ {nextXp} XP</span>
                    </span>
                    <span className="text-xs font-bold text-[#6B7C6B] uppercase tracking-widest">{Math.round(progress)}%</span>
                </div>
                <div className="h-2 w-full bg-black/5 rounded-full overflow-hidden">
                    <motion.div
                        initial={{ width: 0 }}
                        animate={{ width: `${progress}%` }}
                        transition={{ duration: 1, ease: "easeOut" }}
                        className="h-full bg-[#2A3C2A] rounded-full"
                    />
                </div>
                <p className="text-[10px] text-[#A0A0A0] mt-3 font-medium tracking-wide">
                    Butuh {nextXp - xp} XP lagi untuk mencapai peringkat berikutnya.
                </p>
            </div>
        </div>
    );
}
