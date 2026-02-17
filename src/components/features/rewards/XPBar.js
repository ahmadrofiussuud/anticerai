import { motion } from "framer-motion";

export default function XPBar({ current, total, label }) {
    const progress = Math.min((current / total) * 100, 100);

    return (
        <div className="space-y-3">
            <div className="flex justify-between items-end">
                <div>
                    <span className="text-xs font-bold text-[#6B7C6B] uppercase tracking-[0.2em]">{label}</span>
                    <div className="text-2xl font-serif font-bold text-[#2A3C2A]">{current} <span className="text-sm font-sans text-[#6B7C6B]">/ {total} XP</span></div>
                </div>
                <div className="text-right">
                    <span className="text-2xl font-serif font-bold text-[#C67C5C]">{Math.round(progress)}%</span>
                </div>
            </div>
            <div className="h-4 w-full bg-black/5 rounded-full overflow-hidden p-1 border border-white/50">
                <motion.div
                    initial={{ width: 0 }}
                    animate={{ width: `${progress}%` }}
                    transition={{ duration: 1, ease: "easeOut" }}
                    className="h-full bg-gradient-to-r from-[#C67C5C] to-[#D89A7A] rounded-full shadow-inner"
                />
            </div>
        </div>
    );
}
