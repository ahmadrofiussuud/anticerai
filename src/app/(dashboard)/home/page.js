"use client";

import { useSession } from "next-auth/react";
import PairingManager from "@/components/features/PairingManager";
import EnergyMeter from "@/components/features/EnergyMeter";
import DailyLog from "@/components/features/DailyLog";
import PartnershipPlaybook from "@/components/features/PartnershipPlaybook";
import { Loader2 } from "lucide-react";
import Link from "next/link";
import { useState, useEffect } from "react";
import { useRouter } from "next/navigation";
import HeroCarousel from "@/components/features/home/HeroCarousel";
import FloatingAction from "@/components/features/home/FloatingAction";
import RewardsCard from "@/components/features/home/RewardsCard";

export default function HomePage() {
    const { data: session, status } = useSession();
    // const router = useRouter(); // Removed redundant router

    // Middleware already handles protection
    // useEffect(() => {
    //    if (status === "unauthenticated") {
    //        router.push("/login");
    //    }
    // }, [status, router]);

    if (status === "loading") {
        return (
            <div className="flex h-screen items-center justify-center">
                <Loader2 className="h-8 w-8 animate-spin text-[#2A3C2A]" />
            </div>
        );
    }

    // Bypass Pairing Check
    // if (!session?.user?.couple_id) {
    //    return <PairingManager />;
    // }

    return (
        <div className="min-h-screen bg-[#FDFBF7] pb-20">
            {/* Global Background Mesh Gradient */}
            <div className="fixed inset-0 z-0 pointer-events-none">
                <div className="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-[#C67C5C]/20 blur-[120px]"></div>
                <div className="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-[#4A6741]/20 blur-[120px]"></div>
            </div>



            // ... existing code ...

            {/* Global Background Mesh Gradient */}
            <div className="fixed inset-0 z-0 pointer-events-none">
                <div className="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-[#C67C5C]/20 blur-[120px]"></div>
                <div className="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-[#4A6741]/20 blur-[120px]"></div>
            </div>

            {/* Hero Carousel (P1 Restored) */}
            <HeroCarousel />

            {/* Greeting (Moved below Hero) */}
            <div className="relative z-10 pt-10 pb-10 text-center">
                <h2 className="text-3xl font-serif font-bold text-[#2A3C2A]">
                    Selamat Datang, {session?.user?.name ? session.user.name.split(" ")[0] : 'User'}
                </h2>
                <p className="text-[#6B7C6B]">
                    Ruang aman untuk tumbuh bersama pasangan.
                </p>
            </div>

            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 relative z-10">

                {/* 1. Daily Suggestions (P0) */}
                <DailySuggestions />

                <div className="text-center pt-8 border-t border-black/5">
                    <h2 className="text-4xl font-serif font-bold text-[#2A3C2A] mb-4">Pusat Kendali Hubungan</h2>
                    <p className="text-lg text-[#6B7C6B]">Ringkasan kesehatan hubungan Anda dalam satu pandangan</p>
                </div>

                {/* 2. Widgets Grid */}
                <div className="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    {/* Energy Meter */}
                    <div className="lg:col-span-4">
                        <EnergyMeter />
                    </div>

                    {/* Daily Log */}
                    <div className="lg:col-span-4">
                        <DailyLog />
                    </div>

                    {/* Rewards Card */}
                    <div className="lg:col-span-4">
                        <RewardsCard />
                    </div>

                    {/* Partnership Playbook (P0) */}
                    <div className="lg:col-span-4">
                        <PartnershipPlaybook />
                    </div>
                </div>

                {/* 3. Feature Links (P0) */}
                <div>
                    <div className="text-center mb-12">
                        <h2 className="text-4xl font-serif font-bold text-[#2A3C2A] mb-4">Fitur Kami</h2>
                        <p className="text-lg text-[#6B7C6B]">Alat bantu untuk memperdalam koneksi Anda</p>
                    </div>
                    <FeatureLinks />
                </div>
            </div>

            {/* Floating Action Button */}
            <FloatingAction />
        </div>
    );
}

function DailySuggestions() {
    return (
        <div className="mb-12">
            <div className="flex items-center justify-between mb-8">
                <div className="flex items-center gap-4">
                    <div className="w-14 h-14 bg-white/80 backdrop-blur-md rounded-2xl flex items-center justify-center shadow-lg border border-white/50">
                        <svg className="w-7 h-7 text-[#2A3C2A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 className="text-3xl font-serif font-bold text-[#2A3C2A] tracking-tight">Saran Hari Ini</h3>
                        <p className="text-sm text-[#6B7C6B] font-medium tracking-wide uppercase">Aksi kecil, dampak besar</p>
                    </div>
                </div>
                <div className="hidden sm:flex bg-white/60 backdrop-blur-sm px-5 py-2.5 rounded-full shadow-sm border border-white/50">
                    <span className="text-xs font-bold text-[#2A3C2A] tracking-widest uppercase">
                        {new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}
                    </span>
                </div>
            </div>

            <div className="grid md:grid-cols-3 gap-6">
                {/* Card 1 */}
                <SuggestionCard
                    title="Kopi Pagi"
                    desc="Awali hari dengan kopi bersama dan bagikan impian kalian."
                    iconColor="text-[#C67C5C]"
                    bgClass="bg-[#C67C5C]/10 group-hover:bg-[#C67C5C]"
                    btnText="Coba Sekarang"
                    btnColor="text-[#C67C5C]"
                    icon={<path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>}
                />
                {/* Card 2 */}
                <SuggestionCard
                    title="Waktu Check-in"
                    desc="Tanya 'Gimana perasaanmu hari ini?' dan dengarkan jawabannya."
                    iconColor="text-[#4A6741]"
                    bgClass="bg-[#4A6741]/10 group-hover:bg-[#4A6741]"
                    btnText="Mulai Ngobrol"
                    btnColor="text-[#4A6741]"
                    icon={<path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>}
                />
                {/* Card 3 */}
                <SuggestionCard
                    title="Ungkapkan Syukur"
                    desc="Katakan satu hal yang kamu hargai dari pasanganmu hari ini."
                    iconColor="text-[#D89A7A]"
                    bgClass="bg-[#D89A7A]/10 group-hover:bg-[#D89A7A]"
                    btnText="Tunjukkan Cinta"
                    btnColor="text-[#D89A7A]"
                    icon={<path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>}
                />
            </div>
        </div>
    )
}

function SuggestionCard({ title, desc, iconColor, bgClass, btnText, btnColor, icon }) {
    return (
        <div className="group relative bg-white/40 backdrop-blur-md rounded-[2rem] p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.1)] transition-all duration-700 ease-out border border-white/60 hover:border-black/5 overflow-hidden hover:-translate-y-2 cursor-pointer">
            <div className="absolute inset-0 bg-gradient-to-br from-white/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div className="relative z-10">
                <div className={`w-14 h-14 rounded-2xl flex items-center justify-center mb-6 transition-all duration-300 group-hover:text-white ${bgClass}`}>
                    <svg className={`w-6 h-6 transition-colors group-hover:text-white ${iconColor}`} fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {icon}
                    </svg>
                </div>
                <h4 className="font-serif font-bold text-xl text-[#2A3C2A] mb-3">{title}</h4>
                <p className="text-sm text-[#6B7C6B] leading-relaxed mb-6 font-medium">{desc}</p>
                <div className={`flex items-center gap-2 text-xs font-bold uppercase tracking-wider group-hover:gap-3 transition-all ${btnColor}`}>
                    <span>{btnText}</span>
                    <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </div>
            </div>
        </div>
    )
}

function FeatureLinks() {
    return (
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            {/* Nostalgia Engine */}
            <Link href="/home/nostalgia" className="group relative rounded-[2rem] overflow-hidden shadow-lg h-[400px] cursor-pointer transform transition-all duration-700 ease-out hover:shadow-2xl">
                <img src="https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=800&h=600&fit=crop"
                    alt="Nostalgia Engine"
                    className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[1.5s]" />
                <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                <div className="absolute inset-0 p-8 flex flex-col justify-end text-white">
                    <div className="transform transition-transform duration-500 group-hover:translate-y-[-10px]">
                        <h3 className="text-3xl font-serif font-bold mb-2">Nostalgia Engine</h3>
                        <p className="text-white/80 mb-4 max-w-sm text-lg">Hidupkan kembali momen magis. Kurasi timeline kenangan tak terlupakan.</p>
                        <div className="flex items-center text-sm font-bold uppercase tracking-widest text-[#F4A460] opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                            <span>Mulai Menjelajah</span>
                            <svg className="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </div>
                </div>
            </Link>

            {/* Invisible Bridge */}
            <Link href="/home/bridge" className="group relative rounded-[2rem] overflow-hidden shadow-lg h-[400px] cursor-pointer transform transition-all duration-700 ease-out hover:shadow-2xl">
                <img src="https://images.unsplash.com/photo-1516589091380-5d8e87df6999?w=800&h=600&fit=crop"
                    alt="Invisible Bridge"
                    className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[1.5s]" />
                <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                <div className="absolute inset-0 p-8 flex flex-col justify-end text-white">
                    <div className="transform transition-transform duration-500 group-hover:translate-y-[-10px]">
                        <h3 className="text-3xl font-serif font-bold mb-2">Invisible Bridge</h3>
                        <p className="text-white/80 mb-4 max-w-sm text-lg">Pahami bahasa cinta tersembunyi dengan bantuan AI.</p>
                        <div className="flex items-center text-sm font-bold uppercase tracking-widest text-[#90EE90] opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                            <span>Jembatani Hati</span>
                            <svg className="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </div>
                </div>
            </Link>

            {/* Date Roulette */}
            <Link href="/home/date-roulette" className="group relative rounded-[2rem] overflow-hidden shadow-lg h-[400px] cursor-pointer transform transition-all duration-700 ease-out hover:shadow-2xl">
                <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=800&h=600&fit=crop"
                    alt="Date Roulette"
                    className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[1.5s]" />
                <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                <div className="absolute inset-0 p-8 flex flex-col justify-end text-white">
                    <div className="transform transition-transform duration-500 group-hover:translate-y-[-10px]">
                        <h3 className="text-3xl font-serif font-bold mb-2">Date Roulette</h3>
                        <p className="text-white/80 mb-4 max-w-sm text-lg">Kejutan tak terduga. Biarkan takdir memilih kencan Anda.</p>
                        <div className="flex items-center text-sm font-bold uppercase tracking-widest text-[#F4A460] opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                            <span>Putar Roda</span>
                            <svg className="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </div>
                </div>
            </Link>

            {/* Growth Space */}
            <Link href="/home/growth-space" className="group relative rounded-[2rem] overflow-hidden shadow-lg h-[400px] cursor-pointer transform transition-all duration-700 ease-out hover:shadow-2xl">
                <img src="https://images.unsplash.com/photo-1529390079861-591de354faf5?w=800&h=600&fit=crop"
                    alt="Growth Space"
                    className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[1.5s]" />
                <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                <div className="absolute inset-0 p-8 flex flex-col justify-end text-white">
                    <div className="transform transition-transform duration-500 group-hover:translate-y-[-10px]">
                        <h3 className="text-3xl font-serif font-bold mb-2">Growth Space</h3>
                        <p className="text-white/80 mb-4 max-w-sm text-lg">Edukasi mikro untuk hubungan yang lebih sehat.</p>
                        <div className="flex items-center text-sm font-bold uppercase tracking-widest text-[#90EE90] opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                            <span>Mulai Belajar</span>
                            <svg className="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </div>
                </div>
            </Link>
        </div>
    )
}


