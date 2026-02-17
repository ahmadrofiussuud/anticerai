"use client";

import { motion } from "framer-motion";
import { Ticket, Coffee, Utensils, HeartPulse, Clock, Pill, Sparkles } from "lucide-react";
import { format } from "date-fns";

export default function VoucherCard({ voucher, onRedeem }) {
    const isRedeemed = voucher.status === 'redeemed';

    // Mapping categories to icons
    const icons = {
        'Coffee': Coffee,
        'Restaurant': Utensils,
        'Wellness': Pill,
        'Activity': Sparkles,
    };
    const Icon = icons[voucher.category] || Ticket;

    return (
        <div className={`relative px-6 py-5 rounded-2xl border transition-all duration-300 flex flex-col justify-between h-full bg-white ${isRedeemed ? 'opacity-50 grayscale border-black/5' : 'border-black/5 shadow-sm hover:shadow-md'
            }`}>
            {/* Top Info */}
            <div>
                <div className="flex items-start justify-between mb-4">
                    <div className="p-2 bg-[#FDFBF7] rounded-xl border border-black/5 text-[#6B7C6B]">
                        <Icon className="w-5 h-5" />
                    </div>
                    {isRedeemed && (
                        <div className="px-2 py-0.5 bg-black/5 rounded text-[9px] font-bold text-[#A0A0A0] uppercase tracking-wider">
                            Digunakan
                        </div>
                    )}
                </div>

                <h4 className="text-sm font-bold text-[#2A3C2A] mb-0.5 line-clamp-1">{voucher.title}</h4>
                <p className="text-[11px] font-medium text-[#6B7C6B] mb-4">{voucher.merchant}</p>

                <div className="inline-block text-xl font-serif font-bold text-[#2A3C2A] mb-1">
                    {voucher.percent}% <span className="text-xs font-sans">OFF</span>
                </div>
            </div>

            {/* Expiry & CTA */}
            <div className="mt-4 pt-4 border-t border-black/5 flex items-center justify-between gap-4">
                <div className="flex flex-col">
                    <span className="text-[9px] font-bold text-[#A0A0A0] uppercase tracking-wider">Berlaku s/d</span>
                    <span className="text-[10px] font-bold text-[#2A3C2A]">{new Date(voucher.expiry).toLocaleDateString()}</span>
                </div>
                {!isRedeemed ? (
                    <button
                        onClick={() => onRedeem(voucher)}
                        className="bg-[#C67C5C] hover:bg-[#B56A4B] text-white text-[11px] font-bold px-4 py-2 rounded-lg transition-colors"
                    >
                        Redeem
                    </button>
                ) : (
                    <div className="text-[11px] font-bold text-[#A0A0A0] italic">
                        Redeemed
                    </div>
                )}
            </div>
        </div>
    );
}
