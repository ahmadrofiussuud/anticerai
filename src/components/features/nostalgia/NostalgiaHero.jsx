export default function NostalgiaHero({ memoryCount, tagsCount }) {
    const currentYear = new Date().getFullYear();
    const yearsJourney = currentYear - 2016; // Based on blade file logic

    return (
        <div className="relative w-full min-h-[700px] flex items-center justify-center overflow-hidden pt-20 pb-20">
            {/* Background Image with Overlay */}
            <div className="absolute inset-0 z-0">
                <img
                    src="https://images.unsplash.com/photo-1490730141103-6cac27aaab94?w=1920&q=80"
                    alt="Nostalgic Sky"
                    className="w-full h-full object-cover opacity-90"
                />
                <div className="absolute inset-0 bg-gradient-to-b from-[#FDFBF7]/90 via-[#FDFBF7]/80 to-[#FDFBF7]"></div>
                <div
                    className="absolute inset-0 opacity-30"
                    style={{
                        backgroundImage: `url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoNDIsIDYwLCA0MiwgMC4wNSkiLz48L3N2Zz4=')`,
                    }}
                ></div>
            </div>

            {/* Central Core (Memory Hub) */}
            <div className="relative z-10 flex flex-col items-center justify-center text-center animate-float">
                <div className="relative w-64 h-64 mb-8">
                    {/* Glowing Orb Background */}
                    <div className="absolute inset-0 bg-[#C67C5C]/20 rounded-full blur-[80px] animate-pulse-glow"></div>

                    {/* Main Core Sphere */}
                    <div className="absolute inset-0 bg-gradient-to-br from-white to-[#E5E0D0] rounded-full shadow-[0_20px_50px_rgba(198,124,92,0.3)] border border-white/60 backdrop-blur-xl flex items-center justify-center z-10">
                        <div className="w-48 h-48 bg-gradient-to-tr from-[#FFF3E0] to-[#FDFBF7] rounded-full shadow-inner flex items-center justify-center border border-[#E5E0D0] p-6">
                            <img
                                src="/images/amora_logo_circle.png"
                                alt="Amora Core"
                                className="w-full h-full object-contain animate-pulse-glow drop-shadow-md"
                                onError={(e) => e.target.style.display = 'none'} // Fallback if image missing
                            />
                        </div>
                    </div>

                    {/* Orbiting Rings */}
                    <div className="absolute inset-0 border border-[#C67C5C]/20 rounded-full animate-[spin_10s_linear_infinite]"></div>
                    <div className="absolute -inset-4 border border-[#4A6741]/10 rounded-full animate-[spin_15s_linear_infinite_reverse]"></div>
                </div>

                <h1 className="text-5xl lg:text-7xl font-serif font-bold text-[#2A3C2A] mb-4 relative z-20">
                    Mesin Nostalgia
                </h1>
                <p className="text-[#6B7C6B] text-xl max-w-lg mx-auto leading-relaxed relative z-20">
                    Linimasa momen indah Anda, dikurasi secara otomatis.
                </p>
            </div>

            {/* Floating Node: Top Left (Milestones) */}
            <div className="absolute top-[8%] left-[2%] lg:left-[5%] hidden md:block animate-float-delayed z-10">
                <svg
                    className="absolute top-1/2 left-full w-32 h-20 -z-10 text-[#C67C5C]/40 hidden lg:block"
                    style={{ transform: "rotate(15deg)" }}
                >
                    <path
                        d="M0,10 Q60,10 120,80"
                        fill="none"
                        stroke="currentColor"
                        strokeWidth="2"
                        strokeDasharray="4 4"
                    />
                </svg>

                <div className="relative w-80 h-32 rounded-3xl overflow-hidden shadow-[0_15px_40px_rgba(0,0,0,0.2)] transform hover:scale-105 transition-all cursor-pointer group border-2 border-white/30">
                    <img
                        src="https://images.unsplash.com/photo-1530021232320-687d8e3dba54?w=400&q=80"
                        className="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        alt="Milestones"
                    />
                    <div className="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
                    <div className="absolute inset-0 p-6 flex flex-col justify-center">
                        <h3 className="font-serif font-bold text-white text-2xl leading-tight shadow-black/50 drop-shadow-md mb-1">
                            Tonggak Sejarah
                        </h3>
                        <p className="text-xs font-bold text-[#F4A460] uppercase tracking-wider">
                            {yearsJourney} Tahun Perjalanan
                        </p>
                    </div>
                </div>
            </div>

            {/* Floating Node: Top Right (Adventures) */}
            <div className="absolute top-[12%] right-[2%] lg:right-[5%] hidden md:block animate-float z-10">
                <svg className="absolute top-1/2 right-full w-40 h-20 -z-10 text-[#4A6741]/40 hidden lg:block" style={{ transform: "rotate(-15deg)" }}>
                    <path d="M160,10 Q80,10 0,80" fill="none" stroke="currentColor" strokeWidth="2" strokeDasharray="4 4" />
                </svg>

                <div className="relative w-80 h-32 rounded-3xl overflow-hidden shadow-[0_15px_40px_rgba(0,0,0,0.2)] transform hover:scale-105 transition-all cursor-pointer group border-2 border-white/30">
                    <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=400&q=80"
                        className="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        alt="Adventures" />
                    <div className="absolute inset-0 bg-gradient-to-l from-black/80 via-black/40 to-transparent"></div>
                    <div className="absolute inset-0 p-6 flex flex-col justify-center items-end text-right">
                        <h3 className="font-serif font-bold text-white text-2xl leading-tight shadow-black/50 drop-shadow-md mb-1">Petualangan</h3>
                        <p className="text-xs font-bold text-[#90EE90] uppercase tracking-wider">{memoryCount} Terabadikan</p>
                    </div>
                </div>
            </div>

            {/* Floating Node: Bottom Left (Connection) */}
            <div className="absolute bottom-[20%] left-[2%] lg:left-[5%] hidden md:block animate-float z-10">
                <svg className="absolute bottom-1/2 left-full w-32 h-24 -z-10 text-[#D89A7A]/40 hidden lg:block" style={{ transform: "rotate(-15deg)" }}>
                    <path d="M0,80 Q60,80 120,10" fill="none" stroke="currentColor" strokeWidth="2" strokeDasharray="4 4" />
                </svg>

                <div className="relative w-80 h-32 rounded-3xl overflow-hidden shadow-[0_15px_40px_rgba(0,0,0,0.2)] transform hover:scale-105 transition-all cursor-pointer group border-2 border-white/30">
                    <img src="https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=400&q=80"
                        className="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        alt="Connection" />
                    <div className="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
                    <div className="absolute inset-0 p-6 flex flex-col justify-center">
                        <h3 className="font-serif font-bold text-white text-2xl leading-tight shadow-black/50 drop-shadow-md mb-1">Koneksi</h3>
                        <p className="text-xs font-bold text-[#FFB7B2] uppercase tracking-wider">Pertumbuhan Tanpa Batas</p>
                    </div>
                </div>
            </div>

            {/* Floating Node: Bottom Right (Categories) */}
            <div className="absolute bottom-[15%] right-[2%] lg:right-[5%] hidden md:block animate-float-delayed z-10">
                <svg className="absolute bottom-1/2 right-full w-40 h-24 -z-10 text-[#5C7C53]/40 hidden lg:block" style={{ transform: "rotate(15deg)" }}>
                    <path d="M160,80 Q80,80 0,10" fill="none" stroke="currentColor" strokeWidth="2" strokeDasharray="4 4" />
                </svg>

                <div className="relative w-80 h-32 rounded-3xl overflow-hidden shadow-[0_15px_40px_rgba(0,0,0,0.2)] transform hover:scale-105 transition-all cursor-pointer group border-2 border-white/30">
                    <img src="https://images.unsplash.com/photo-1544377193-33dcf4d68fb5?w=400&q=80"
                        className="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        alt="Categories" />
                    <div className="absolute inset-0 bg-gradient-to-l from-black/80 via-black/40 to-transparent"></div>
                    <div className="absolute inset-0 p-6 flex flex-col justify-center items-end text-right">
                        <h3 className="font-serif font-bold text-white text-2xl leading-tight shadow-black/50 drop-shadow-md mb-1">Tema</h3>
                        <p className="text-xs font-bold text-[#A8D5BA] uppercase tracking-wider">{tagsCount} Koleksi</p>
                    </div>
                </div>
            </div>
        </div>
    );
}
