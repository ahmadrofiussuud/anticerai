"use client";

import { useState } from "react";

export default function DateRouletteHero() {
    return (
        <div className="relative bg-[#FDFBF7] min-h-[90vh] flex items-start pt-0 lg:pt-0 pb-12 overflow-hidden">
            {/* Background Image with Overlay */}
            <div className="absolute inset-0 z-0">
                <img
                    src="https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=2000&auto=format&fit=crop"
                    alt="Background"
                    className="w-full h-full object-cover opacity-60"
                />
                <div className="absolute inset-0 bg-gradient-to-r from-[#FDFBF7]/90 via-[#FDFBF7]/70 to-[#FDFBF7]/40"></div>
            </div>

            {/* Abstract Background Blobs */}
            <div className="absolute top-0 right-0 w-2/3 h-full bg-[#FAEFED]/30 rounded-l-[100px] -z-10 transform translate-x-1/3"></div>

            <div className="relative z-10 max-w-7xl mx-auto px-4 w-full pt-4">
                {/* Main Grid layout */}
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-start pt-4 lg:pt-8">

                    {/* Left Content */}
                    <div className="text-left flex flex-col h-full justify-between space-y-12">
                        {/* Title Section */}
                        <div className="space-y-8">
                            <h1 className="text-5xl md:text-6xl lg:text-7xl font-serif font-bold text-[#4A3427] leading-[0.95] tracking-tight">
                                Ciptakan <br /> Momen <br />
                                <span className="text-[#C67C5C] italic">Tak Terlupakan</span>
                            </h1>

                            {/* Buttons */}
                            <div className="flex flex-col sm:flex-row flex-wrap gap-4">
                                <a href="#preferences" className="bg-[#EAB89D] hover:bg-[#E2A688] text-[#4A3427] font-bold py-3 px-8 text-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 min-w-[180px] text-center rounded-none">
                                    Mulai Rencanakan
                                </a>

                                <a href="#activities" className="bg-transparent border-2 border-[#EAB89D] text-[#4A3427] font-bold py-3 px-8 text-lg hover:bg-[#FFF5F2] transition-colors min-w-[180px] text-center flex items-center justify-center rounded-none">
                                    Lihat Ide
                                </a>
                            </div>

                            {/* Social Proof */}
                            <div className="flex items-center gap-6">
                                <div className="flex -space-x-4">
                                    <img className="w-14 h-14 rounded-full border-4 border-[#FDFBF7] object-cover" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop" alt="User" />
                                    <img className="w-14 h-14 rounded-full border-4 border-[#FDFBF7] object-cover" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=100&h=100&fit=crop" alt="User" />
                                    <img className="w-14 h-14 rounded-full border-4 border-[#FDFBF7] object-cover" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop" alt="User" />
                                    <div className="w-14 h-14 rounded-full border-4 border-[#FDFBF7] bg-[#EAB89D] text-[#4A3427] flex items-center justify-center font-bold text-xs">2k+</div>
                                </div>
                                <div className="text-[#4A3427] font-medium">
                                    <span className="block font-bold text-lg">2,718 Pasangan Bahagia</span>
                                    <span className="text-sm text-[#8A7A70]">Mempercayai Amora</span>
                                </div>
                            </div>
                        </div>

                        {/* Stats Row */}
                        <div className="grid grid-cols-3 gap-3 sm:gap-12 pt-8 pb-12">
                            <div>
                                <div className="text-2xl sm:text-4xl font-serif font-bold text-[#4A3427]">50+</div>
                                <div className="text-[10px] sm:text-sm text-[#8A7A70] uppercase tracking-wide font-bold mt-2">Aktivitas</div>
                            </div>
                            <div>
                                <div className="text-2xl sm:text-4xl font-serif font-bold text-[#4A3427]">24/7</div>
                                <div className="text-[10px] sm:text-sm text-[#8A7A70] uppercase tracking-wide font-bold mt-2">Tersedia</div>
                            </div>
                            <div>
                                <div className="text-2xl sm:text-4xl font-serif font-bold text-[#4A3427]">100%</div>
                                <div className="text-[10px] sm:text-sm text-[#8A7A70] uppercase tracking-wide font-bold mt-2">Seru</div>
                            </div>
                        </div>
                    </div>

                    {/* Right Content - Images */}
                    <div className="flex flex-col h-full lg:pl-12">
                        <div className="mb-12 lg:mb-auto pt-2">
                            <p className="text-[#5D544F] text-xl lg:text-xl leading-relaxed max-w-lg font-medium">
                                Kami percaya bahwa merancang kencan yang sempurna lebih dari sekadar perencanaan – ini tentang mengkurasi pengalaman yang mencerminkan kisah cinta unik Anda dan menjaga api asmara tetap menyala.
                            </p>
                        </div>

                        {/* Images Container */}
                        <div className="relative h-[500px] w-full mt-8 lg:mt-0">
                            <div className="absolute inset-0 bg-[#FAE3D5] opacity-40 blur-3xl rounded-full transform rotate-45 scale-75 -z-10"></div>
                            <div className="absolute top-0 right-10 text-[#EAB89D] text-5xl animate-pulse">✨</div>
                            <div className="absolute bottom-10 left-0 text-[#EAB89D] text-6xl opacity-50 transform -rotate-12">♡</div>

                            {/* Static Polaroid 1 (Back) */}
                            <div className="absolute top-10 right-0 w-80 h-96 bg-white p-3 pb-12 shadow-2xl transform rotate-6 z-10 border border-[#EBEBEB]">
                                <img src="https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=500&q=80" className="w-full h-full object-cover filter contrast-105" alt="Couple 1" />
                            </div>

                            {/* Static Polaroid 2 (Front) */}
                            <div className="absolute top-24 right-48 w-72 h-80 bg-white p-3 pb-10 shadow-xl transform -rotate-3 z-20 border border-[#EBEBEB]">
                                <img src="https://images.unsplash.com/photo-1621621667797-e06afc217fb0?w=500&q=80" className="w-full h-full object-cover filter sepia-[.1]" alt="Couple 2" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
