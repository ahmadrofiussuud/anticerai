"use client";

import { motion } from "framer-motion";
import { CheckCircle2, Lock, Gift, Star } from "lucide-react";

export default function MilestoneGrid({ milestones }) {
    return (
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            {milestones.map((ms, index) => (
                <motion.div
                    key={index}
                    whileHover={{ scale: 1.02 }}
                    className={`p-5 rounded-[2rem] border transition-all ${ms.unlocked
                            ? 'bg-white/80 border-[#C67C5C]/20 shadow-sm'
                            : 'bg-black/5 border-transparent opacity-60'
                        }`}
                >
                    <div className="flex items-center gap-4">
                        <div className={`w-12 h-12 rounded-2xl flex items-center justify-center ${ms.unlocked ? 'bg-[#F4A460]/10 text-[#C67C5C]' : 'bg-black/10 text-black/20'
                            }`}>
                            {ms.unlocked ? <Gift className="w-6 h-6" /> : <Lock className="w-5 h-5" />}
                        </div>
                        <div className="flex-grow">
                            <h5 className={`font-bold text-sm ${ms.unlocked ? 'text-[#2A3C2A]' : 'text-[#6B7C6B]'}`}>
                                {ms.title}
                            </h5>
                            <p className="text-[10px] uppercase font-bold tracking-[0.1em] text-[#A0A0A0]">
                                {ms.description}
                            </p>
                        </div>
                        {ms.unlocked && (
                            <div className="text-[#C67C5C]">
                                <CheckCircle2 className="w-5 h-5" />
                            </div>
                        )}
                    </div>
                </motion.div>
            ))}
        </div>
    );
}
