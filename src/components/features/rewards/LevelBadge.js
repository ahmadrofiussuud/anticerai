import { motion } from "framer-motion";
import { Star } from "lucide-react";

export default function LevelBadge({ level, size = "md" }) {
    const sizes = {
        sm: "w-10 h-10 text-xs",
        md: "w-20 h-20 text-xl",
        lg: "w-32 h-32 text-3xl"
    };

    return (
        <div className="relative inline-block">
            <motion.div
                whileHover={{ scale: 1.05 }}
                className={`${sizes[size]} rounded-full bg-gradient-to-br from-[#2A3C2A] to-[#4A6741] flex items-center justify-center text-white font-bold shadow-2xl border-4 border-white/20`}
            >
                {level?.charAt(0)}
            </motion.div>
            <div className="absolute -bottom-2 -right-2 bg-white rounded-full p-2 shadow-lg border border-black/5">
                <Star className="w-4 h-4 text-[#C67C5C] fill-current" />
            </div>
        </div>
    );
}
