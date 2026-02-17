"use client";

import { motion } from "framer-motion";
import { Calendar, ChevronRight } from "lucide-react";
import Link from "next/link";

export default function MonthlyDatesCard({ current, target = 3 }) {
    const progress = (current / target) * 100;

    return (
        <div className="bg-white rounded-[2rem] p-8 border border-black/5 shadow-sm h-full flex flex-col justify-between">
            <div className="flex items-start justify-between">
                <div>
                    <span className="text-[10px] font-bold text-[#C67C5C] uppercase tracking-[0.2em] mb-2 block">Kencan Bulan Ini</span>
                    <h3 className="text-3xl font-serif font-bold text-[#2A3C2A]">{current} / {target}</h3>
                </div>
                <div className="w-12 h-12 bg-[#FDFBF7] rounded-2xl flex items-center justify-center border border-black/5">
                    <Calendar className="w-6 h-6 text-[#C67C5C]" />
                </div>
            </div>

            <div className="mt-8 flex flex-col gap-4">
                <div className="h-1.5 w-full bg-black/5 rounded-full overflow-hidden">
                    <motion.div
                        initial={{ width: 0 }}
                        animate={{ width: `${progress}%` }}
                        transition={{ duration: 1, ease: "easeOut" }}
                        className="h-full bg-[#C67C5C] rounded-full"
                    />
                </div>

                <div className="flex flex-col gap-2">
                    <Link
                        href="/home/date-roulette"
                        className="w-full bg-[#2A3C2A] text-white text-xs font-bold py-3 rounded-xl flex items-center justify-center gap-2 hover:bg-[#384F38] transition-all"
                    >
                        Log a Date
                        <ChevronRight className="w-3 h-3" />
                    </Link>
                    <p className="text-[10px] text-[#A0A0A0] text-center font-medium">
                        Kurang {target - current} kencan lagi untuk syarat Silver.
                    </p>
                </div>
            </div>
        </div>
    );
}
