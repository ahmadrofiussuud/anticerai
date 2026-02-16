"use client";

import { useState } from "react";
import Link from "next/link";
import { Plus, X, Zap, Camera } from "lucide-react";

export default function FloatingAction() {
    const [open, setOpen] = useState(false);

    return (
        <div className="fixed bottom-8 right-8 z-50">
            {/* Menu Items */}
            <div className={`absolute bottom-20 right-0 space-y-3 flex flex-col items-end min-w-[220px] transition-all duration-300 ${open ? 'opacity-100 translate-y-0 scale-100 pointer-events-auto' : 'opacity-0 translate-y-4 scale-95 pointer-events-none'}`}>

                <button
                    onClick={() => { setOpen(false); document.getElementById('energy-slider')?.focus(); }}
                    className="flex items-center justify-between gap-3 bg-white text-[#2A3C2A] px-5 py-4 rounded-2xl shadow-xl border border-[#E5E0D0] hover:bg-[#FDFBF7] hover:border-[#C67C5C] group transition-all transform hover:-translate-x-2 w-full"
                >
                    <span className="font-bold group-hover:text-[#C67C5C] transition-colors">Update Energi</span>
                    <span className="bg-[#C67C5C]/10 text-[#C67C5C] w-10 h-10 flex items-center justify-center rounded-lg text-xl">
                        <Zap className="w-5 h-5 fill-current" />
                    </span>
                </button>

                <Link
                    href="/nostalgia"
                    onClick={() => setOpen(false)}
                    className="flex items-center justify-between gap-3 bg-white text-[#2A3C2A] px-5 py-4 rounded-2xl shadow-xl border border-[#E5E0D0] hover:bg-[#FDFBF7] hover:border-[#4A6741] group transition-all transform hover:-translate-x-2 w-full"
                >
                    <span className="font-bold group-hover:text-[#4A6741] transition-colors">Tambah Kenangan</span>
                    <span className="bg-[#4A6741]/10 text-[#4A6741] w-10 h-10 flex items-center justify-center rounded-lg text-xl">
                        <Camera className="w-5 h-5" />
                    </span>
                </Link>
            </div>

            {/* Main Toggle Button */}
            <button
                onClick={() => setOpen(!open)}
                className="bg-gradient-to-br from-[#2C3E2C] to-[#1E2923] hover:from-[#1E2923] hover:to-[#0F1511] text-white w-16 h-16 rounded-full shadow-2xl flex items-center justify-center transform transition-all duration-300 hover:scale-110 active:scale-95"
            >
                {open ? (
                    <X className="w-7 h-7" strokeWidth={3} />
                ) : (
                    <Plus className="w-7 h-7" strokeWidth={3} />
                )}
            </button>
        </div>
    );
}
