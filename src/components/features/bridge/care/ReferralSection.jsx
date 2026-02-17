"use client";

import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { Heart, ClipboardCheck, ArrowRight, Hospital, FlaskConical, Check, Loader2 } from "lucide-react";
import { careService } from "@/lib/services/careService";

export default function ReferralSection({ existingReferrals = [] }) {
    const [referrals, setReferrals] = useState(existingReferrals);
    const [loadingPartner, setLoadingPartner] = useState(null);

    const partners = [
        {
            id: 'bio-amora',
            name: 'Bio-Amora Lab',
            type: 'lab',
            desc: 'Paket pemeriksaan darah & hormon lengkap.',
            price: 'Rp1.2jt - 2.5jt',
            icon: FlaskConical
        },
        {
            id: 'siloam-care',
            name: 'Siloam Love Center',
            type: 'hospital',
            desc: 'Konsultasi dokter & USG kesehatan reproduksi.',
            price: 'Rp800rb - 1.5jt',
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

    return (
        <div className="space-y-8">
            <div className="flex flex-col gap-1">
                <h3 className="text-2xl font-serif font-bold text-[#2A3C2A]">Pre-marital Health Check</h3>
                <p className="text-sm text-[#6B7C6B] font-medium">Urus persiapan kesehatan jadi lebih simpel dengan partner Amora.</p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                {partners.map((partner) => {
                    const existing = referrals.find(r => r.partnerName === partner.name);
                    const Icon = partner.icon;

                    return (
                        <div key={partner.id} className="bg-white rounded-3xl p-8 border border-black/5 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                            <div>
                                <div className="flex items-center justify-between mb-6">
                                    <div className="w-12 h-12 bg-[#FDFBF7] rounded-2xl flex items-center justify-center text-[#C67C5C] group-hover:bg-[#C67C5C] group-hover:text-white transition-all">
                                        <Icon className="w-6 h-6" />
                                    </div>
                                    <span className="text-[10px] font-bold text-[#6B7C6B] uppercase tracking-widest bg-black/5 px-2 py-1 rounded-md">
                                        {partner.type}
                                    </span>
                                </div>
                                <h4 className="text-lg font-bold text-[#2A3C2A] mb-2">{partner.name}</h4>
                                <p className="text-xs text-[#6B7C6B] font-medium leading-relaxed mb-6">{partner.desc}</p>
                                <div className="text-[10px] font-bold text-[#A0A0A0] uppercase tracking-widest mb-1">Estimasi Biaya</div>
                                <p className="text-sm font-bold text-[#2A3C2A] mb-8">{partner.price}</p>
                            </div>

                            {existing ? (
                                <div className="bg-[#2A3C2A] text-white p-4 rounded-xl flex items-center justify-between shadow-lg">
                                    <div className="flex flex-col">
                                        <span className="text-[9px] font-bold opacity-60 uppercase tracking-widest">Kode Referral</span>
                                        <span className="text-sm font-bold tracking-wider">{existing.referralCode}</span>
                                    </div>
                                    <Check className="w-5 h-5 text-[#B5C4B5]" />
                                </div>
                            ) : (
                                <button
                                    onClick={() => getReferral(partner)}
                                    disabled={loadingPartner === partner.id}
                                    className="w-full bg-[#FDFBF7] border border-black/5 py-4 rounded-xl font-bold text-sm text-[#2A3C2A] flex items-center justify-center gap-2 hover:bg-[#2A3C2A] hover:text-white transition-all group"
                                >
                                    {loadingPartner === partner.id ? (
                                        <Loader2 className="w-4 h-4 animate-spin" />
                                    ) : (
                                        <>
                                            Get Referral
                                            <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition-transform" />
                                        </>
                                    )}
                                </button>
                            )}
                        </div>
                    );
                })}
            </div>

            {referrals.length > 0 && (
                <div className="bg-[#FDFBF7] rounded-3xl p-6 border border-black/5">
                    <h5 className="text-sm font-bold text-[#2A3C2A] mb-4 flex items-center gap-2">
                        <ClipboardCheck className="w-4 h-4 text-[#C67C5C]" />
                        Status Rujukan
                    </h5>
                    <div className="space-y-3">
                        {referrals.map((r, i) => (
                            <div key={i} className="flex items-center justify-between py-3 border-b border-black/5 last:border-none">
                                <div className="flex flex-col">
                                    <span className="text-xs font-bold text-[#2A3C2A]">{r.partnerName}</span>
                                    <span className="text-[9px] font-bold text-[#A0A0A0] uppercase tracking-widest">Code: {r.referralCode}</span>
                                </div>
                                <div className={`px-2 py-1 rounded text-[9px] font-bold uppercase tracking-wider ${r.status === 'completed' ? 'bg-[#2A3C2A]/10 text-[#2A3C2A]' :
                                        r.status === 'booked' ? 'bg-[#C67C5C]/10 text-[#C67C5C]' :
                                            'bg-black/5 text-[#A0A0A0]'
                                    }`}>
                                    {r.status}
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            )}
        </div>
    );
}
