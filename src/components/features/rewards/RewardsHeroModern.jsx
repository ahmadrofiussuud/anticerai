"use client";

import { motion } from "framer-motion";
import { ChevronLeft, ArrowRight, Gift, Star } from "lucide-react";
import Link from "next/link";

export default function RewardsHeroModern() {
    return (
        <section className="mb-12 relative">


            <div className="relative overflow-hidden rounded-[3rem] bg-white border border-black/5 shadow-2xl">
                {/* Background Decor */}
                <div className="absolute top-0 right-0 w-1/2 h-full bg-[#2A3C2A]/[0.02] transform skew-x-12 translate-x-32"></div>

                <div className="grid lg:grid-cols-2 items-center gap-12 p-8 lg:p-16 relative z-10">
                    {/* Left: Content */}
                    <div className="flex flex-col gap-8">
                        <div className="flex flex-col gap-4">
                            <div className="flex items-center gap-2">
                                <span className="px-3 py-1 bg-[#C67C5C]/10 text-[#C67C5C] text-[10px] font-bold uppercase tracking-widest rounded-full">
                                    Member Benefit
                                </span>
                                <div className="h-px w-8 bg-[#C67C5C]/20"></div>
                            </div>
                            <h1 className="text-5xl lg:text-6xl font-serif font-bold text-[#2A3C2A] tracking-tight leading-tight">
                                Unlock Hadiah <br />
                                <span className="text-[#C67C5C]">Spesial Kamu.</span>
                            </h1>
                            <p className="text-[#6B7C6B] text-lg font-medium leading-relaxed max-w-md">
                                Makin sering kencan, makin gampang klaim benefit eksklusif bareng pasangan. Konsisten itu ada rewardnya.
                            </p>
                        </div>

                        <div className="flex items-center gap-4">
                            <Link
                                href="/home/date-roulette"
                                className="px-8 py-4 bg-[#2A3C2A] text-white rounded-2xl font-bold flex items-center gap-3 hover:bg-[#384F38] shadow-lg shadow-[#2A3C2A]/10 transition-all group"
                            >
                                Mulai Kencan
                                <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition-transform" />
                            </Link>
                            <button className="px-8 py-4 bg-transparent text-[#2A3C2A] border border-black/10 rounded-2xl font-bold hover:bg-black/5 transition-all">
                                Cara Kerja
                            </button>
                        </div>

                        <div className="flex items-center gap-8 pt-4 border-t border-black/5">
                            <div className="flex flex-col">
                                <span className="text-xl font-bold text-[#2A3C2A]">40+</span>
                                <span className="text-[10px] font-bold text-[#6B7C6B] uppercase tracking-widest">Partner</span>
                            </div>
                            <div className="flex flex-col">
                                <span className="text-xl font-bold text-[#2A3C2A]">Rp 2jt+</span>
                                <span className="text-[10px] font-bold text-[#6B7C6B] uppercase tracking-widest">Total Value</span>
                            </div>
                        </div>
                    </div>

                    {/* Right: Visual Section */}
                    <div className="relative hidden lg:block">
                        <div className="relative aspect-square w-full max-w-[450px] mx-auto">
                            {/* Main Image Base */}
                            <motion.div
                                initial={{ opacity: 0, scale: 0.9 }}
                                animate={{ opacity: 1, scale: 1 }}
                                transition={{ duration: 1 }}
                                className="absolute inset-0 rounded-[2.5rem] overflow-hidden shadow-2xl border-4 border-white"
                            >
                                <img
                                    src="https://images.unsplash.com/photo-1549488344-1f9b8d2bd1f3?w=800&fit=crop"
                                    className="w-full h-full object-cover"
                                    alt="Date Night"
                                />
                            </motion.div>

                            {/* Floating Rewards Card 1 */}
                            <motion.div
                                animate={{ y: [0, -15, 0] }}
                                transition={{ duration: 4, repeat: Infinity, ease: "easeInOut" }}
                                className="absolute -top-6 -right-6 bg-white/95 backdrop-blur-md p-6 rounded-3xl shadow-xl border border-black/5 flex items-center gap-4 z-20 group"
                            >
                                <div className="w-12 h-12 bg-[#C67C5C]/10 rounded-2xl flex items-center justify-center text-[#C67C5C]">
                                    <Gift className="w-6 h-6" />
                                </div>
                                <div>
                                    <div className="text-[10px] font-bold text-[#A0A0A0] uppercase tracking-widest">Diskon Baru</div>
                                    <div className="text-sm font-bold text-[#2A3C2A]">25% OFF Cafe Mawar</div>
                                </div>
                            </motion.div>

                            {/* Floating Rewards Card 2 */}
                            <motion.div
                                animate={{ y: [0, 15, 0] }}
                                transition={{ duration: 5, repeat: Infinity, ease: "easeInOut", delay: 0.5 }}
                                className="absolute -bottom-10 -left-10 bg-[#2A3C2A] p-6 rounded-3xl shadow-xl border border-white/10 flex items-center gap-4 z-20"
                            >
                                <div className="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-white">
                                    <Star className="w-6 h-6 fill-current" />
                                </div>
                                <div>
                                    <div className="text-[10px] font-bold text-white/40 uppercase tracking-widest">Upgrade Peringkat</div>
                                    <div className="text-sm font-bold text-white">Siap menuju Silver</div>
                                </div>
                            </motion.div>

                            {/* Decorative Rings */}
                            <div className="absolute -inset-10 border border-[#C67C5C]/10 rounded-full animate-[spin_20s_linear_infinite]"></div>
                            <div className="absolute -inset-20 border border-[#2A3C2A]/5 rounded-full animate-[spin_30s_linear_infinite_reverse]"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
