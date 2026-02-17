"use client";

import { motion } from "framer-motion";
import { Trophy, Star, TrendingUp, Calendar, ChevronRight } from "lucide-react";
import Link from "next/link";
import { useState, useEffect } from "react";
import { rewardService } from "@/lib/services/rewardService";

export default function RewardsCard() {
    const [data, setData] = useState(null);
    const [monthly, setMonthly] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        async function fetchRewards() {
            // Mocking couple ID 1 for now
            const profile = await rewardService.getProfile(1);
            const stats = await rewardService.getMonthlyStats(1);
            setData(profile);
            setMonthly(stats);
            setLoading(false);
        }
        fetchRewards();
    }, []);

    if (loading) return (
        <div className="h-full bg-white/40 backdrop-blur-md rounded-[2rem] p-8 border border-white/60 animate-pulse">
            <div className="h-8 bg-black/5 rounded w-1/2 mb-4"></div>
            <div className="h-4 bg-black/5 rounded w-3/4 mb-8"></div>
            <div className="space-y-4">
                <div className="h-24 bg-black/5 rounded-2xl"></div>
            </div>
        </div>
    );

    const xpToNext = 500; // Mock target
    const progress = (data?.xp / xpToNext) * 100;

    return (
        <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            className="group relative h-full bg-white/40 backdrop-blur-md rounded-[2rem] p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.1)] transition-all duration-700 ease-out border border-white/60 hover:border-[#C67C5C]/20 overflow-hidden"
        >
            <div className="absolute top-0 right-0 p-8">
                <div className="w-12 h-12 bg-[#F4A460]/10 rounded-2xl flex items-center justify-center text-[#C67C5C]">
                    <Trophy className="w-6 h-6" />
                </div>
            </div>

            <div className="relative z-10 flex flex-col h-full">
                <div className="mb-6">
                    <h3 className="text-2xl font-serif font-bold text-[#2A3C2A] mb-1">Relationship Rewards</h3>
                    <p className="text-sm text-[#6B7C6B]">Pantau progres keintiman Anda</p>
                </div>

                {/* Level Badge & XP */}
                <div className="flex items-center gap-4 mb-8">
                    <div className="relative">
                        <div className="w-16 h-16 rounded-full bg-gradient-to-br from-[#2A3C2A] to-[#4A6741] flex items-center justify-center text-white shadow-lg">
                            <span className="text-lg font-bold">{data?.level?.charAt(0)}</span>
                        </div>
                        <div className="absolute -bottom-1 -right-1 bg-white rounded-full p-1 shadow-sm border border-black/5">
                            <Star className="w-3 h-3 text-[#C67C5C] fill-current" />
                        </div>
                    </div>
                    <div>
                        <div className="text-sm font-bold text-[#2A3C2A] uppercase tracking-wider">{data?.level} Level</div>
                        <div className="text-2xl font-serif font-bold text-[#C67C5C]">{data?.xp} <span className="text-sm text-[#6B7C6B] font-sans">XP</span></div>
                    </div>
                </div>

                {/* Progress Bar */}
                <div className="space-y-2 mb-8">
                    <div className="flex justify-between text-xs font-bold text-[#6B7C6B] uppercase tracking-widest">
                        <span>Menuju Silver</span>
                        <span>{Math.round(progress)}%</span>
                    </div>
                    <div className="h-2 w-full bg-black/5 rounded-full overflow-hidden">
                        <motion.div
                            initial={{ width: 0 }}
                            animate={{ width: `${progress}%` }}
                            transition={{ duration: 1.5, ease: "easeOut" }}
                            className="h-full bg-gradient-to-r from-[#C67C5C] to-[#D89A7A] rounded-full"
                        />
                    </div>
                    <p className="text-[10px] text-[#6B7C6B] italic">Butuh {(xpToNext - (data?.xp || 0))} XP lagi untuk naik level</p>
                </div>

                {/* Stats Grid */}
                <div className="grid grid-cols-2 gap-4 mb-8">
                    <div className="bg-white/60 rounded-2xl p-4 border border-white/60">
                        <div className="flex items-center gap-2 text-[#6B7C6B] mb-1">
                            <Calendar className="w-3 h-3" />
                            <span className="text-[10px] font-bold uppercase tracking-wider">Date/Bulan</span>
                        </div>
                        <div className="text-lg font-bold text-[#2A3C2A]">{monthly?.datesCompleted || 0} / {monthly?.targetDates || 3}</div>
                    </div>
                    <div className="bg-white/60 rounded-2xl p-4 border border-white/60">
                        <div className="flex items-center gap-2 text-[#6B7C6B] mb-1">
                            <TrendingUp className="w-3 h-3" />
                            <span className="text-[10px] font-bold uppercase tracking-wider">Streak</span>
                        </div>
                        <div className="text-lg font-bold text-[#2A3C2A]">{data?.streak_days || 0} Hari</div>
                    </div>
                </div>

                <div className="mt-auto flex flex-col gap-3">
                    <Link href="/home/rewards" className="w-full bg-[#2A3C2A] hover:bg-[#384F38] text-white py-4 rounded-2xl font-bold flex items-center justify-center gap-2 transition-all shadow-lg shadow-black/10 group-hover:scale-[1.02] active:scale-[0.98]">
                        <span>Lihat Hadiah</span>
                        <ChevronRight className="w-4 h-4" />
                    </Link>
                    <Link href="/home/date-roulette" className="w-full bg-white/60 hover:bg-white text-[#2A3C2A] py-3 rounded-2xl font-bold text-sm border border-white/60 transition-all text-center">
                        Log a Date
                    </Link>
                </div>
            </div>
        </motion.div>
    );
}
