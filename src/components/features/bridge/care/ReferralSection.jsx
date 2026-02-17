"use client";

import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { Heart, ClipboardCheck, ArrowRight, Hospital, FlaskConical, Check, Loader2, Copy } from "lucide-react";
import { careService } from "@/lib/services/careService";

export default function ReferralSection({ existingReferrals = [] }) {
    const [referrals, setReferrals] = useState(existingReferrals);
    const [loadingPartner, setLoadingPartner] = useState(null);

    const partners = [
        {
            id: 'bio-amora',
            name: 'Bio-Amora Lab',
            type: 'Clinical Lab',
            desc: 'Screening hormon & darah komprehensif sebelum penyatuan legal.',
            price: 'Rp1.2M - 2.5M',
            icon: FlaskConical
        },
        {
            id: 'siloam-care',
            name: 'Siloam Love Center',
            type: 'Medical Center',
            desc: 'Konsultasi pra-nikah & kesehatan reproduksi di setting privat.',
            price: 'Rp800K - 1.5M',
            icon: Hospital
        }
    ];

    const getReferral = async (partner) => {
        setLoadingPartner(partner.id);
        try {
            const newRef = await careService.createReferral({
                userId: 1,
                partnerType: partner.type,
                partnerName: partner.name
            });
            setReferrals([...referrals, newRef]);
        } catch (error) {
            console.error("Referral error:", error);
        } finally {
            setLoadingPartner(null);
        }
    };

    const latestReferral = referrals[referrals.length - 1];

    return (
        <div className="space-y-6">
            <div className="flex items-center justify-between">
                <div className="space-y-1">
                    <h3 className="text-sm font-bold text-[#2A3C2A]">Pre-marital Health Check</h3>
                    <p className="text-[11px] text-[#6B7C6B] font-medium italic">Partner medis terpercaya untuk fondasi hubungan yang jelas.</p>
                </div>
            </div>

            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {partners.map((partner) => {
                    const existing = referrals.find(r => r.partnerName === partner.name);
                    const Icon = partner.icon;

                    return (
                        <div key={partner.id} className="bg-white/60 backdrop-blur rounded-3xl border border-black/5 p-5 shadow-sm flex flex-col h-full group hover:bg-white transition-all">
                            <div className="flex items-start justify-between mb-4">
                                <div className="w-10 h-10 bg-black/5 rounded-xl flex items-center justify-center text-[#C67C5C]">
                                    <Icon className="w-5 h-5" />
                                </div>
                                <span className="px-2 py-0.5 bg-black/5 rounded-full text-[9px] font-bold text-[#A0A0A0] uppercase tracking-wider">
                                    {partner.type}
                                </span>
                            </div>

                            <div className="space-y-1 mb-4">
                                <h4 className="text-sm font-bold text-[#2A3C2A]">{partner.name}</h4>
                                <p className="text-[11px] text-[#6B7C6B] leading-relaxed line-clamp-2">{partner.desc}</p>
                            </div>

                            <div className="mt-auto pt-4 border-t border-black/5 flex flex-col gap-4">
                                <div className="flex items-center justify-between">
                                    <span className="text-[10px] font-bold text-[#A0A0A0] uppercase">Estimasi</span>
                                    <span className="text-xs font-bold text-[#2A3C2A]">{partner.price}</span>
                                </div>

                                {existing ? (
                                    <div className="flex items-center justify-between px-3 py-2 bg-[#2A3C2A] text-white rounded-xl">
                                        <span className="text-[10px] font-mono font-bold tracking-wider">{existing.referralCode}</span>
                                        <button className="p-1 hover:bg-white/20 rounded-md transition-colors">
                                            <Copy className="w-3 h-3" />
                                        </button>
                                    </div>
                                ) : (
                                    <button
                                        onClick={() => getReferral(partner)}
                                        disabled={loadingPartner === partner.id}
                                        className="w-full h-9 bg-white border border-[#2A3C2A] text-[#2A3C2A] rounded-full font-bold text-[10px] uppercase tracking-wider flex items-center justify-center gap-2 hover:bg-[#2A3C2A] hover:text-white transition-all disabled:opacity-50"
                                    >
                                        {loadingPartner === partner.id ? (
                                            <Loader2 className="w-3 h-3 animate-spin" />
                                        ) : (
                                            <>Get Referral</>
                                        )}
                                    </button>
                                )}
                            </div>
                        </div>
                    );
                })}
            </div>

            {latestReferral && (
                <div className="flex items-center justify-between p-4 bg-[#FDFBF7] border border-black/5 rounded-2xl">
                    <div className="flex items-center gap-3">
                        <div className="w-8 h-8 bg-white rounded-lg border border-black/[0.03] flex items-center justify-center text-[#2A3C2A]">
                            <ClipboardCheck className="w-4 h-4" />
                        </div>
                        <div className="space-y-0.5">
                            <p className="text-[10px] font-bold text-[#2A3C2A] uppercase tracking-wider">Status Referral</p>
                            <p className="text-[11px] text-[#6B7C6B] font-medium">{latestReferral.partnerName} • {latestReferral.referralCode}</p>
                        </div>
                    </div>
                    <span className={`px-2 py-0.5 rounded-full text-[9px] font-bold uppercase tracking-wider ${latestReferral.status === 'completed' ? 'bg-[#2A3C2A] text-white' : 'bg-black/5 text-[#A0A0A0]'
                        }`}>
                        {latestReferral.status}
                    </span>
                </div>
            )}
        </div>
    );
}
