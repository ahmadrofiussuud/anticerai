"use client";

import { useState, useEffect } from "react";
import Link from "next/link";

export default function HeroCarousel() {
    const [activeSlide, setActiveSlide] = useState(0);
    const slidesCount = 4;
    const [isPaused, setIsPaused] = useState(false);

    useEffect(() => {
        if (isPaused) return;
        const interval = setInterval(() => {
            setActiveSlide((prev) => (prev + 1) % slidesCount);
        }, 5000);
        return () => clearInterval(interval);
    }, [isPaused]);

    return (
        <div
            className="relative min-h-[600px] lg:min-h-[700px] bg-black overflow-hidden"
            onMouseEnter={() => setIsPaused(true)}
            onMouseLeave={() => setIsPaused(false)}
        >
            {/* Global Background Mesh Gradient via CSS/Tailwind preserved from blade context but inside hero for containment */}
            {/* Note: The blade file had this fixed in body, but for this component we keep it contained or omitted if layout handles it. 
                The user asked to copy hero markup. The slider container starts at line 35 of home.blade.php.
            */}

            {/* Background Images */}
            <div className="absolute inset-0">
                {/* Slide 1: Nostalgia Engine */}
                <div className={`absolute inset-0 transition-opacity duration-[2000ms] ease-in-out ${activeSlide === 0 ? 'opacity-100' : 'opacity-0'}`}>
                    <img src="https://images.unsplash.com/photo-1518568814500-bf0f8d125f46?w=1920&h=1080&fit=crop" alt="Nostalgia Engine" className="w-full h-full object-cover" />
                    <div className="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>
                </div>

                {/* Slide 2: Invisible Bridge */}
                <div className={`absolute inset-0 transition-opacity duration-[2000ms] ease-in-out ${activeSlide === 1 ? 'opacity-100' : 'opacity-0'}`}>
                    <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?w=1920&h=1080&fit=crop" alt="Invisible Bridge" className="w-full h-full object-cover" />
                    <div className="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>
                </div>

                {/* Slide 3: Date Roulette */}
                <div className={`absolute inset-0 transition-opacity duration-[2000ms] ease-in-out ${activeSlide === 2 ? 'opacity-100' : 'opacity-0'}`}>
                    <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=1920&h=1080&fit=crop" alt="Date Roulette" className="w-full h-full object-cover" />
                    <div className="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>
                </div>

                {/* Slide 4: Growth Space */}
                <div className={`absolute inset-0 transition-opacity duration-[2000ms] ease-in-out ${activeSlide === 3 ? 'opacity-100' : 'opacity-0'}`}>
                    <img src="https://images.unsplash.com/photo-1556909172-54557c7e4fb7?w=1920&h=1080&fit=crop" alt="Growth Space" className="w-full h-full object-cover" />
                    <div className="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>
                </div>
            </div>

            {/* Content */}
            <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
                <div className="max-w-3xl">
                    {/* Slide 1 Content */}
                    <div className={`transition-all duration-700 ease-out ${activeSlide === 0 ? 'opacity-100 translate-y-0 delay-300' : 'opacity-0 translate-y-8 absolute top-20 lg:top-32 left-4 sm:left-6 lg:left-8'}`}>
                        <h1 className="text-5xl lg:text-7xl font-serif font-bold text-white mb-6 leading-tight drop-shadow-2xl">
                            Kurasi Kenangan <span className="text-[#F4A460]">Indah Anda</span>
                        </h1>
                        <p className="text-xl lg:text-2xl text-white/90 mb-8 leading-relaxed drop-shadow-lg">
                            Nostalgia Engine membantu Anda mengabadikan dan menghargai momen positif bersama. Bangun linimasa perjalanan hubungan Anda.
                        </p>
                        <Link href="/nostalgia" className="inline-flex items-center gap-2 bg-white text-[#2A3C2A] font-bold px-8 py-4 rounded-full hover:bg-[#E5E0D0] transition-all shadow-2xl">
                            <span>Jelajahi Kenangan</span>
                            <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"></path></svg>
                        </Link>
                    </div>

                    {/* Slide 2 Content */}
                    <div className={`transition-all duration-700 ease-out ${activeSlide === 1 ? 'opacity-100 translate-y-0 delay-300' : 'opacity-0 translate-y-8 absolute top-20 lg:top-32 left-4 sm:left-6 lg:left-8'}`}>
                        <h1 className="text-5xl lg:text-7xl font-serif font-bold text-white mb-6 leading-tight drop-shadow-2xl">
                            Pahami Kebutuhan <span className="text-[#90EE90]">Mereka</span>
                        </h1>
                        <p className="text-xl lg:text-2xl text-white/90 mb-8 leading-relaxed drop-shadow-lg">
                            Invisible Bridge menggunakan AI untuk membantu Anda berkomunikasi lebih baik dan memahami keinginan pasangan melalui Komunikasi Non-Kekerasan.
                        </p>
                        <Link href="/home/bridge" className="inline-flex items-center gap-2 bg-white text-[#2A3C2A] font-bold px-8 py-4 rounded-full hover:bg-[#E5E0D0] transition-all shadow-2xl">
                            <span>Mulai Percakapan</span>
                            <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"></path></svg>
                        </Link>
                    </div>

                    {/* Slide 3 Content */}
                    <div className={`transition-all duration-700 ease-out ${activeSlide === 2 ? 'opacity-100 translate-y-0 delay-300' : 'opacity-0 translate-y-8 absolute top-20 lg:top-32 left-4 sm:left-6 lg:left-8'}`}>
                        <h1 className="text-5xl lg:text-7xl font-serif font-bold text-white mb-6 leading-tight drop-shadow-2xl">
                            Ide Kencan <span className="text-[#F4A460]">Spontan</span>
                        </h1>
                        <p className="text-xl lg:text-2xl text-white/90 mb-8 leading-relaxed drop-shadow-lg">
                            Bingung mau ngapain? Biarkan Date Roulette memilihkan aktivitas seru untukmu. Dari kencan santai di rumah hingga petualangan seru.
                        </p>
                        <Link href="/home/date-roulette" className="inline-flex items-center gap-2 bg-white text-[#2A3C2A] font-bold px-8 py-4 rounded-full hover:bg-[#E5E0D0] transition-all shadow-2xl">
                            <span>Putar Roda</span>
                            <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"></path></svg>
                        </Link>
                    </div>

                    {/* Slide 4 Content */}
                    <div className={`transition-all duration-700 ease-out ${activeSlide === 3 ? 'opacity-100 translate-y-0 delay-300' : 'opacity-0 translate-y-8 absolute top-20 lg:top-32 left-4 sm:left-6 lg:left-8'}`}>
                        <h1 className="text-5xl lg:text-7xl font-serif font-bold text-white mb-6 leading-tight drop-shadow-2xl">
                            Tumbuh Bersama, <span className="text-[#90EE90]">Belajar Bersama</span>
                        </h1>
                        <p className="text-xl lg:text-2xl text-white/90 mb-8 leading-relaxed drop-shadow-lg">
                            Growth Space menawarkan artikel terkurasi dan edukasi mikro untuk membantu Anda membangun hubungan yang lebih kuat dan sehat.
                        </p>
                        <Link href="/home/growth-space" className="inline-flex items-center gap-2 bg-white text-[#2A3C2A] font-bold px-8 py-4 rounded-full hover:bg-[#E5E0D0] transition-all shadow-2xl">
                            <span>Mulai Belajar</span>
                            <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"></path></svg>
                        </Link>
                    </div>
                </div>
            </div>

            {/* Navigation Dots */}
            <div className="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 flex justify-center gap-3">
                {[0, 1, 2, 3].map((idx) => (
                    <button
                        key={idx}
                        onClick={() => setActiveSlide(idx)}
                        className={`h-3 rounded-full transition-all duration-300 hover:bg-white ${activeSlide === idx ? 'bg-white w-12' : 'bg-white/50 w-3'}`}
                    ></button>
                ))}
            </div>

            {/* Arrow Navigation */}
            <button
                onClick={() => setActiveSlide((prev) => (prev > 0 ? prev - 1 : slidesCount - 1))}
                className="absolute left-4 lg:left-8 top-1/2 -translate-y-1/2 z-20 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full shadow-xl flex items-center justify-center hover:bg-white/30 transition-colors"
            >
                <svg className="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button
                onClick={() => setActiveSlide((prev) => (prev < slidesCount - 1 ? prev + 1 : 0))}
                className="absolute right-4 lg:right-8 top-1/2 -translate-y-1/2 z-20 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full shadow-xl flex items-center justify-center hover:bg-white/30 transition-colors"
            >
                <svg className="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    );
}
