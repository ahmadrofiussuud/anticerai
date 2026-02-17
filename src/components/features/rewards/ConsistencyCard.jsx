"use client";

import { motion } from "framer-motion";
import { Flame, CheckCircle2 } from "lucide-react";

export default function ConsistencyCard({ streakDays, weeklyActivity = [true, true, true, false, false, false, false] }) {
    const days = ["S", "S", "R", "K", "J", "S", "M"];

    return (
        <div className="bg-white rounded-[2rem] p-8 border border-black/5 shadow-sm h-full flex flex-col justify-between">
            <div className="flex items-start justify-between">
                <div>
                    <span className="text-[10px] font-bold text-[#C67C5C] uppercase tracking-[0.2em] mb-2 block">Konsistensi</span>
                    <h3 className="text-3xl font-serif font-bold text-[#2A3C2A]">{streakDays} Hari</h3>
                </div>
                <div className="w-12 h-12 bg-[#FDFBF7] rounded-2xl flex items-center justify-center border border-black/5">
                    <Flame className="w-6 h-6 text-[#C67C5C]" />
                </div>
            </div>

            <div className="mt-8">
                <div className="flex items-center justify-between mb-4">
                    <span className="text-xs font-bold text-[#6B7C6B] uppercase tracking-widest">Aktivitas Minggu Ini</span>
                    <span className="text-[10px] font-bold text-[#2A3C2A] bg-black/5 px-2 py-1 rounded-md">
                        {weeklyActivity.filter(v => v).length}/7 Selesai
                    </span>
                </div>
                <div className="flex justify-between items-center gap-1">
                    {days.map((day, i) => (
                        <div key={i} className="flex flex-col items-center gap-2 flex-1">
                            <div className={`w-full aspect-square rounded-lg flex items-center justify-center border transition-all ${weeklyActivity[i]
                                    ? 'bg-[#2A3C2A] border-[#2A3C2A] text-white'
                                    : 'bg-transparent border-black/5 text-[#A0A0A0]'
                                }`}>
                                {weeklyActivity[i] && <CheckCircle2 className="w-3 h-3" />}
                            </div>
                            <span className="text-[9px] font-bold text-[#6B7C6B] uppercase">{day}</span>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
}
