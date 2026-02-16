"use client";

// Logic ported: Smooth scroll to 'articles-grid'
const scrollToArticles = () => {
    const el = document.getElementById('articles-grid');
    if (el) el.scrollIntoView({ behavior: 'smooth' });
};

export default function GrowthHero() {
    return (
        <div className="relative bg-[#FDFBF7] pt-8 pb-16 lg:pt-14 lg:pb-24 overflow-hidden">
            {/* Background Image with Overlay */}
            <div className="absolute inset-0 z-0">
                <img
                    src="https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?q=80&w=2000&auto=format&fit=crop"
                    alt="Background"
                    className="w-full h-full object-cover opacity-40"
                />
                <div className="absolute inset-0 bg-gradient-to-r from-[#FDFBF7]/85 via-[#FDFBF7]/60 to-[#FDFBF7]/30"></div>
            </div>

            {/* Abstract Background Blobs */}
            <div className="absolute top-0 right-0 w-1/2 h-full bg-[#EAB89D]/10 rounded-l-[100px] -z-10"></div>

            <div className="relative z-10 max-w-7xl mx-auto px-4">
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                    {/* Left Content */}
                    <div className="text-left space-y-8">
                        <div className="space-y-4">
                            <span className="text-[#C67C5C] font-bold tracking-widest uppercase text-sm">Pusat Pengetahuan Amora</span>
                            <h1 className="text-5xl lg:text-7xl font-serif font-bold text-[#4A3427] leading-[1.1]">
                                Tumbuh Bersama, <br />
                                <span className="text-[#C67C5C] italic">Satu Langkah Tiap Waktu</span>
                            </h1>
                        </div>

                        <p className="text-[#8A7A70] text-lg leading-relaxed max-w-xl">
                            Jelajahi pembelajaran mikro yang dirancang untuk memperkuat ikatan unik Anda. Dari penguasaan komunikasi hingga membangun keintiman, temukan wawasan yang benar-benar penting.
                        </p>

                        {/* Buttons */}
                        <div className="flex flex-wrap gap-4 pt-2">
                            <button
                                onClick={scrollToArticles}
                                className="bg-[#4A6741] hover:bg-[#3A5233] text-white font-bold py-4 px-10 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 text-lg"
                            >
                                Mulai Belajar
                            </button>
                        </div>

                        {/* Stats */}
                        <div className="grid grid-cols-3 gap-8 pt-8 border-t border-[#DCCBC4]/50">
                            <div>
                                <div className="text-3xl font-serif font-bold text-[#4A3427]">50+</div>
                                <div className="text-xs text-[#8A7A70] uppercase font-bold mt-1">Topik</div>
                            </div>
                            <div>
                                <div className="text-3xl font-serif font-bold text-[#4A3427]">10rb</div>
                                <div className="text-xs text-[#8A7A70] uppercase font-bold mt-1">Dibaca</div>
                            </div>
                            <div>
                                <div className="text-3xl font-serif font-bold text-[#4A3427]">Ahli</div>
                                <div className="text-xs text-[#8A7A70] uppercase font-bold mt-1">Terkurasi</div>
                            </div>
                        </div>
                    </div>

                    {/* Right Content (Visuals) */}
                    <div className="relative hidden lg:block h-[500px]">
                        {/* Main Image Card */}
                        <div className="absolute top-10 right-10 w-80 bg-white p-3 pb-8 rounded-2xl shadow-2xl transform rotate-3 hover:rotate-6 transition-all duration-500 border border-[#EBEBEB]">
                            <div className="h-64 overflow-hidden rounded-xl mb-4 relative">
                                <img
                                    src="https://images.unsplash.com/photo-1493863641943-9b68992a8d07?w=600&auto=format&fit=crop"
                                    alt="Growth"
                                    className="w-full h-full object-cover transform hover:scale-110 transition-transform duration-700"
                                />
                                <div className="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-[#4A6741] shadow-sm">
                                    Baru
                                </div>
                            </div>
                            <h3 className="font-serif font-bold text-[#4A3427] text-xl px-2">Merawat Pertumbuhan</h3>
                            <p className="text-xs text-[#8A7A70] px-2 mt-1">Wawasan hubungan harian</p>
                        </div>

                        {/* Secondary Image Card (Overlapping) */}
                        <div className="absolute bottom-20 left-10 w-64 bg-white p-3 rounded-2xl shadow-xl transform -rotate-6 hover:-rotate-3 transition-all duration-500 border border-[#EBEBEB]">
                            <div className="h-40 overflow-hidden rounded-xl mb-3 relative">
                                <img
                                    src="https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?w=600&auto=format&fit=crop"
                                    alt="Connection"
                                    className="w-full h-full object-cover"
                                />
                            </div>
                            <div className="flex items-center justify-between px-2">
                                <div>
                                    <h4 className="font-bold text-[#4A3427] text-sm">Koneksi Mendalam</h4>
                                    <div className="flex items-center gap-1 mt-1">
                                        <div className="w-2 h-2 rounded-full bg-[#C67C5C]"></div>
                                        <span className="text-[10px] text-[#8A7A70]">Topik Hangat</span>
                                    </div>
                                </div>
                                <div className="w-8 h-8 rounded-full bg-[#FDFBF7] flex items-center justify-center text-[#4A3427]">
                                    <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
