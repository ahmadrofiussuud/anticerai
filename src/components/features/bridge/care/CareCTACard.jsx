"use client";

import { motion } from "framer-motion";
import { Calendar, MessageSquare, ArrowRight, ShieldCheck, Clock } from "lucide-react";
import Link from "next/link";

export default function CareCTACard() {
    return (
        <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            className="bg-white rounded-[2rem] p-8 border border-black/5 shadow-xl relative overflow-hidden group"
        >
            {/* Background Decor */}
            <div className="absolute -top-10 -right-10 w-40 h-40 bg-[#C67C5C]/5 rounded-full blur-3xl group-hover:bg-[#C67C5C]/10 transition-colors"></div>

            <div className="relative z-10">
                <div className="flex items-center gap-3 mb-6">
                    <div className="w-12 h-12 bg-[#2A3C2A] rounded-2xl flex items-center justify-center text-white shadow-lg shadow-[#2A3C2A]/20">
                        <MessageSquare className="w-6 h-6" />
                    </div>
                    <div>
                        <h3 className="text-xl font-serif font-bold text-[#2A3C2A]">Bridge Care</h3>
                        <p className="text-[10px] font-bold text-[#C67C5C] uppercase tracking-widest">Hybrid Mediation</p>
                    </div>
                </div>

                <h4 className="text-2xl font-serif font-bold text-[#2A3C2A] mb-4 leading-tight">
                    Butuh teman ngobrol yang <span className="text-[#C67C5C]">netral?</span>
                </h4>

                <p className="text-sm text-[#6B7C6B] font-medium mb-8 leading-relaxed">
                    Sesi mediasi 60 menit untuk membantu komunikasi lebih jelas dan aman. Didampingi mediator profesional.
                </p>

                <div className="grid grid-cols-2 gap-4 mb-8">
                    <div className="bg-[#FDFBF7] p-4 rounded-2xl border border-black/5">
                        <div className="flex items-center gap-2 mb-1">
                            <Clock className="w-3.5 h-3.5 text-[#C67C5C]" />
                            <span className="text-[10px] font-bold text-[#2A3C2A] uppercase tracking-wide">Durasi</span>
                        </div>
                        <p className="text-xs font-bold text-[#6B7C6B]">60 Menit</p>
                    </div>
                    <div className="bg-[#FDFBF7] p-4 rounded-2xl border border-black/5">
                        <div className="flex items-center gap-2 mb-1">
                            <ShieldCheck className="w-3.5 h-3.5 text-[#C67C5C]" />
                            <span className="text-[10px] font-bold text-[#2A3C2A] uppercase tracking-wide">Biaya</span>
                        </div>
                        <p className="text-xs font-bold text-[#6B7C6B]">Rp150.000</p>
                    </div>
                </div>

                <div className="flex items-center gap-4">
                    <Link
                        href="/home/bridge/care"
                        className="flex-1 bg-[#2A3C2A] text-white py-4 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-[#384F38] transition-all shadow-lg shadow-[#2A3C2A]/10"
                    >
                        Book Session
                        <ArrowRight className="w-4 h-4" />
                    </Link>
                    <button className="px-6 py-4 bg-transparent text-[#2A3C2A] border border-black/10 rounded-xl font-bold text-sm hover:bg-black/5 transition-all">
                        Pelajari
                    </button>
                </div>

                <p className="text-[9px] text-[#A0A0A0] mt-6 text-center font-medium italic">
                    *Tersedia pengingat otomatis & ringkasan sesi.
                </p>
            </div>
        </motion.div>
    );
}
