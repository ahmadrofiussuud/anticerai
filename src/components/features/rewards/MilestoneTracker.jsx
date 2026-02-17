"use client";

import { motion } from "framer-motion";
import { Check, Lock, ChevronRight } from "lucide-react";

export default function MilestoneTracker({ milestones }) {
    return (
        <div className="bg-white rounded-[2rem] p-8 border border-black/5 shadow-sm h-full flex flex-col">
            <h3 className="text-xl font-serif font-bold text-[#2A3C2A] mb-8">Milestone Tracker</h3>

            <div className="flex flex-col gap-8 flex-grow">
                {milestones.map((ms, i) => (
                    <div key={i} className="flex gap-4 relative">
                        {/* Vertical line connector */}
                        {i !== milestones.length - 1 && (
                            <div className="absolute left-[13px] top-8 bottom-[-24px] w-[1px] bg-black/5"></div>
                        )}

                        <div className={`w-7 h-7 rounded-full flex items-center justify-center shrink-0 z-10 ${ms.unlocked
                                ? 'bg-[#2A3C2A] text-white shadow-lg shadow-black/10'
                                : 'bg-black/5 text-[#A0A0A0]'
                            }`}>
                            {ms.unlocked ? <Check className="w-4 h-4" /> : <Lock className="w-3.5 h-3.5" />}
                        </div>

                        <div className="flex flex-col gap-0.5">
                            <h4 className={`text-sm font-bold ${ms.unlocked ? 'text-[#2A3C2A]' : 'text-[#A0A0A0]'}`}>
                                {ms.title}
                            </h4>
                            <p className="text-[11px] text-[#6B7C6B] font-medium leading-relaxed max-w-[200px]">
                                {ms.description}
                            </p>
                            {ms.unlocked ? (
                                <span className="text-[9px] font-bold text-[#C67C5C] uppercase tracking-widest mt-1 italic">Selesai</span>
                            ) : (
                                <span className="text-[9px] font-bold text-[#A0A0A0] uppercase tracking-widest mt-1">Terkunci</span>
                            )}
                        </div>
                    </div>
                ))}
            </div>

            <button className="mt-8 pt-6 border-t border-black/5 flex items-center justify-between group">
                <span className="text-xs font-bold text-[#2A3C2A] group-hover:text-[#C67C5C] transition-colors">Lihat Semua History</span>
                <ChevronRight className="w-4 h-4 text-[#A0A0A0] group-hover:text-[#C67C5C] transition-all group-hover:translate-x-1" />
            </button>
        </div>
    );
}
