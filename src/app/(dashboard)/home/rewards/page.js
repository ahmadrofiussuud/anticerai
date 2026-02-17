"use client";

import { useState, useEffect, useMemo } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { X, Loader2, Sparkles, Filter, Gift } from "lucide-react";
import Link from "next/link";

// Components
import RewardsHeroModern from "@/components/features/rewards/RewardsHeroModern";
import LevelXPCard from "@/components/features/rewards/LevelXPCard";
import ConsistencyCard from "@/components/features/rewards/ConsistencyCard";
import MonthlyDatesCard from "@/components/features/rewards/MonthlyDatesCard";
import MilestoneTracker from "@/components/features/rewards/MilestoneTracker";
import VoucherCard from "@/components/features/rewards/VoucherCard";

// Services
import { rewardService } from "@/lib/services/rewardService";

export default function RewardsPage() {
    const [profile, setProfile] = useState(null);
    const [monthly, setMonthly] = useState(null);
    const [vouchers, setVouchers] = useState([]);
    const [loading, setLoading] = useState(true);
    const [redeemModal, setRedeemModal] = useState({ show: false, voucher: null });

    useEffect(() => {
        async function loadData() {
            try {
                // Mock couple ID 1
                const p = await rewardService.getProfile(1);
                const m = await rewardService.getMonthlyStats(1);
                const v = await rewardService.getVouchers(1);
                setProfile(p);
                setMonthly(m);
                setVouchers(v);
            } catch (error) {
                console.error("Gagal memuat data rewards", error);
            } finally {
                setLoading(false);
            }
        }
        loadData();
    }, []);

    const confirmRedeem = async () => {
        if (redeemModal.voucher) {
            await rewardService.redeemVoucher(redeemModal.voucher.id);
            const v = await rewardService.getVouchers(1);
            setVouchers(v);
            setRedeemModal({ show: false, voucher: null });
        }
    };

    const milestones = useMemo(() => [
        { title: 'Bergabung', description: 'Memulai perjalanan di Amora', unlocked: true },
        { title: 'Kencan Pertama', description: 'Log kencan pertama dengan sukses', unlocked: true },
        { title: 'Konsisten Sebulan', description: '3 kencan dalam satu bulan kalender', unlocked: false },
        { title: '1 Bulan Bersama', description: 'Merayakan bulan pertama di Amora', unlocked: false },
    ], []);

    const merchants = [
        { name: 'Amora Wellness Lab', cat: 'Wellness', disc: '25% OFF', img: 'https://images.unsplash.com/photo-1516549655169-df83a0774514?w=500&h=300&fit=crop' },
        { name: 'The Silent Cafe', cat: 'Coffee', disc: '10% OFF', img: 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=500&h=300&fit=crop' },
        { name: 'Moonlight Dinner', cat: 'Restaurant', disc: '15% OFF', img: 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?w=500&h=300&fit=crop' },
        { name: 'Garden Spa', cat: 'Activity', disc: 'Buy 1 Get 1', img: 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?w=500&h=300&fit=crop' },
    ];

    if (loading) return (
        <div className="min-h-screen flex items-center justify-center bg-[#FDFBF7]">
            <Loader2 className="w-8 h-8 animate-spin text-[#C67C5C]" />
        </div>
    );

    return (
        <div className="min-h-screen bg-[#FDFBF7] pb-20 pt-8 selection:bg-[#C67C5C]/20">
            <div className="max-w-[1200px] mx-auto px-6 sm:px-10">

                {/* Modern Product Hero */}
                <RewardsHeroModern />

                {/* Main Grid: SaaS Bento Style */}
                <div className="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8">

                    {/* Row 1: High Signal Metrics */}
                    <div className="md:col-span-4">
                        <motion.div initial={{ opacity: 0, y: 10 }} animate={{ opacity: 1, y: 0 }} transition={{ delay: 0.1 }}>
                            <LevelXPCard level={profile.level} xp={profile.xp} />
                        </motion.div>
                    </div>

                    <div className="md:col-span-4">
                        <motion.div initial={{ opacity: 0, y: 10 }} animate={{ opacity: 1, y: 0 }} transition={{ delay: 0.2 }}>
                            <ConsistencyCard streakDays={profile.streak_days} />
                        </motion.div>
                    </div>

                    <div className="md:col-span-4">
                        <motion.div initial={{ opacity: 0, y: 10 }} animate={{ opacity: 1, y: 0 }} transition={{ delay: 0.3 }}>
                            <MonthlyDatesCard current={monthly.datesCompleted} />
                        </motion.div>
                    </div>

                    {/* Row 2: Journey & Rewards */}
                    <div className="md:col-span-5 lg:col-span-4">
                        <motion.div initial={{ opacity: 0, y: 10 }} animate={{ opacity: 1, y: 0 }} transition={{ delay: 0.4 }}>
                            <MilestoneTracker milestones={milestones} />
                        </motion.div>
                    </div>

                    <div className="md:col-span-7 lg:col-span-8">
                        <motion.div
                            initial={{ opacity: 0, y: 10 }}
                            animate={{ opacity: 1, y: 0 }}
                            transition={{ delay: 0.5 }}
                            className="bg-white rounded-[2rem] p-8 border border-black/5 shadow-sm h-full"
                        >
                            <div className="flex items-center justify-between mb-8">
                                <div className="flex flex-col gap-1">
                                    <h3 className="text-xl font-serif font-bold text-[#2A3C2A]">Voucher Vault</h3>
                                    <p className="text-[11px] text-[#6B7C6B] font-medium">Selesaikan target untuk membuka lebih banyak benefit.</p>
                                </div>
                                <div className="flex items-center gap-2">
                                    <button className="p-2 hover:bg-black/5 rounded-lg transition-colors text-[#6B7C6B]">
                                        <Filter className="w-4 h-4" />
                                    </button>
                                </div>
                            </div>

                            <div className="grid sm:grid-cols-2 gap-4">
                                {vouchers.length > 0 ? (
                                    vouchers.map(v => (
                                        <VoucherCard key={v.id} voucher={v} onRedeem={(voucher) => setRedeemModal({ show: true, voucher: voucher })} />
                                    ))
                                ) : (
                                    <div className="col-span-1 sm:col-span-2 py-16 text-center border border-dashed border-black/10 rounded-3xl bg-black/[0.02]">
                                        <Gift className="w-8 h-8 text-[#A0A0A0] mx-auto mb-4 opacity-40" />
                                        <p className="text-xs text-[#A0A0A0] font-medium px-8">
                                            Belum ada voucher tersedia. Selesaikan 3 date bulan ini untuk mulai membuka reward pertama Anda.
                                        </p>
                                    </div>
                                )}
                            </div>
                        </motion.div>
                    </div>

                    {/* Row 3: Merchant Offers (Full Width) */}
                    <div className="md:col-span-12 mt-4">
                        <div className="flex items-center justify-between mb-6">
                            <div className="flex items-center gap-2">
                                <h3 className="text-xl font-serif font-bold text-[#2A3C2A]">Partner Merchant</h3>
                                <span className="bg-[#C67C5C]/10 text-[#C67C5C] text-[9px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">
                                    Curated for {profile.level}
                                </span>
                            </div>
                            <button className="text-xs font-bold text-[#6B7C6B] hover:text-[#2A3C2A] transition-colors">Lihat Semua</button>
                        </div>

                        <div className="grid grid-cols-2 md:grid-cols-4 gap-6">
                            {merchants.map((merchant, i) => (
                                <motion.div
                                    key={i}
                                    whileHover={{ y: -4 }}
                                    className="group cursor-pointer bg-white rounded-3xl overflow-hidden border border-black/5 shadow-sm hover:shadow-md transition-all h-[240px] flex flex-col"
                                >
                                    <div className="relative h-[60%] overflow-hidden">
                                        <img src={merchant.img} className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt={merchant.name} />
                                        <div className="absolute top-3 left-3 bg-white/95 backdrop-blur-md px-2 py-1 rounded-lg text-[10px] font-bold text-[#2A3C2A] shadow-sm">
                                            {merchant.disc}
                                        </div>
                                    </div>
                                    <div className="p-4 flex flex-col justify-between flex-grow">
                                        <div>
                                            <span className="text-[10px] font-bold text-[#6B7C6B] uppercase tracking-wider block mb-1 opacity-60">
                                                {merchant.cat}
                                            </span>
                                            <h4 className="text-sm font-bold text-[#2A3C2A] leading-snug group-hover:text-[#C67C5C] transition-colors">
                                                {merchant.name}
                                            </h4>
                                        </div>
                                        <div className="text-[10px] text-[#A0A0A0] mt-4 flex items-center gap-1">
                                            <Sparkles className="w-3 h-3" />
                                            Mock Data Partner
                                        </div>
                                    </div>
                                </motion.div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>

            {/* Simple Redeem Modal */}
            <AnimatePresence>
                {redeemModal.show && (
                    <div className="fixed inset-0 z-[100] flex items-center justify-center p-4">
                        <motion.div
                            initial={{ opacity: 0 }}
                            animate={{ opacity: 1 }}
                            exit={{ opacity: 0 }}
                            onClick={() => setRedeemModal({ show: false, voucher: null })}
                            className="absolute inset-0 bg-black/20 backdrop-blur-md"
                        ></motion.div>
                        <motion.div
                            initial={{ scale: 0.95, opacity: 0, y: 10 }}
                            animate={{ scale: 1, opacity: 1, y: 0 }}
                            exit={{ scale: 0.95, opacity: 0, y: 10 }}
                            className="bg-white rounded-[2.5rem] p-10 w-full max-w-md relative z-10 shadow-3xl border border-black/5"
                        >
                            <button onClick={() => setRedeemModal({ show: false, voucher: null })} className="absolute top-6 right-6 text-[#A0A0A0] hover:text-[#2A3C2A]">
                                <X className="w-5 h-5" />
                            </button>

                            <div className="text-center">
                                <div className="w-16 h-16 bg-[#FDFBF7] rounded-3xl flex items-center justify-center text-[#C67C5C] mx-auto mb-6 border border-black/5">
                                    <Gift className="w-8 h-8" />
                                </div>
                                <h3 className="text-2xl font-serif font-bold text-[#2A3C2A] mb-2 tracking-tight">Keluarkan Voucher</h3>
                                <p className="text-sm text-[#6B7C6B] mb-8 px-4 leading-relaxed">
                                    Tukarkan voucher ini untuk digunakan saat berkencan. Pastikan Anda berada di lokasi merchant.
                                </p>

                                <div className="bg-[#FDFBF7] rounded-3xl p-8 mb-8 border border-black/5">
                                    <div className="text-3xl font-serif font-bold text-[#2A3C2A] mb-1">{redeemModal.voucher?.percent}% OFF</div>
                                    <div className="text-sm font-bold text-[#C67C5C] uppercase tracking-[0.2em]">{redeemModal.voucher?.title}</div>
                                    <div className="text-xs text-[#A0A0A0] mt-4 font-bold opacity-60">Merchant: {redeemModal.voucher?.merchant}</div>
                                </div>

                                <button
                                    onClick={confirmRedeem}
                                    className="w-full bg-[#2A3C2A] text-white py-4 rounded-xl font-bold shadow-lg hover:bg-[#384F38] transition-all"
                                >
                                    Selesai, Gunakan Voucher
                                </button>
                                <p className="text-[10px] text-[#A0A0A0] mt-4 tracking-wide">
                                    *Hanya berlaku satu kali penukaran.
                                </p>
                            </div>
                        </motion.div>
                    </div>
                )}
            </AnimatePresence>
        </div>
    );
}
