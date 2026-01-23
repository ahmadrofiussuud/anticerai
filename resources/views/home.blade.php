<x-app-layout>
    <div class="min-h-screen bg-[#FDFBF7]">
        @if(!auth()->user()->couple_id)
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <livewire:pairing-manager />
            </div>
        @else
            <!-- Global Background Mesh Gradient -->
            <div class="fixed inset-0 z-0 pointer-events-none">
                <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-[#C67C5C]/20 blur-[120px] animate-pulse-slow"></div>
                <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-[#4A6741]/20 blur-[120px] animate-pulse-slow delay-1000"></div>
                <div class="absolute top-[40%] left-[40%] w-[30%] h-[30%] rounded-full bg-[#D89A7A]/10 blur-[80px] animate-pulse-slow delay-2000"></div>
                <!-- Glass Overlay -->
                <div class="absolute inset-0 bg-white/40 backdrop-blur-[2px]"></div>
            </div>

            <!-- Hero Section with Feature Carousel -->
            <div class="relative overflow-hidden z-10">
                <div x-data="{ 
                    activeSlide: 0, 
                    slides: 4, 
                    interval: null,
                    startAutoSlide() {
                        this.interval = setInterval(() => {
                            this.activeSlide = (this.activeSlide + 1) % this.slides;
                        }, 5000);
                    },
                    stopAutoSlide() {
                        clearInterval(this.interval);
                    }
                }" 
                x-init="startAutoSlide()"
                @mouseenter="stopAutoSlide()" 
                @mouseleave="startAutoSlide()"
                class="relative min-h-[600px] lg:min-h-[700px] bg-black">
                    <!-- Background Images -->
                    <div class="absolute inset-0">
                        <!-- Slide 1: Nostalgia Engine Background -->
                        <div x-show="activeSlide === 0" 
                             x-transition:enter="transition ease-in-out duration-[2000ms]" 
                             x-transition:enter-start="opacity-0" 
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in-out duration-[2000ms]" 
                             x-transition:leave-start="opacity-100" 
                             x-transition:leave-end="opacity-0" 
                             class="absolute inset-0">
                            <img src="https://images.unsplash.com/photo-1518568814500-bf0f8d125f46?w=1920&h=1080&fit=crop" alt="Nostalgia Engine" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>
                        </div>

                        <!-- Slide 2: Invisible Bridge Background -->
                        <div x-show="activeSlide === 1" 
                             x-transition:enter="transition ease-in-out duration-[2000ms]" 
                             x-transition:enter-start="opacity-0" 
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in-out duration-[2000ms]" 
                             x-transition:leave-start="opacity-100" 
                             x-transition:leave-end="opacity-0" 
                             class="absolute inset-0">
                            <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?w=1920&h=1080&fit=crop" alt="Invisible Bridge" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>
                        </div>

                        <!-- Slide 3: Date Roulette Background -->
                        <div x-show="activeSlide === 2" 
                             x-transition:enter="transition ease-in-out duration-[2000ms]" 
                             x-transition:enter-start="opacity-0" 
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in-out duration-[2000ms]" 
                             x-transition:leave-start="opacity-100" 
                             x-transition:leave-end="opacity-0" 
                             class="absolute inset-0">
                            <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=1920&h=1080&fit=crop" alt="Date Roulette" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>
                        </div>

                        <!-- Slide 4: Growth Space Background -->
                        <div x-show="activeSlide === 3" 
                             x-transition:enter="transition ease-in-out duration-[2000ms]" 
                             x-transition:enter-start="opacity-0" 
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in-out duration-[2000ms]" 
                             x-transition:leave-start="opacity-100" 
                             x-transition:leave-end="opacity-0" 
                             class="absolute inset-0">
                            <img src="https://images.unsplash.com/photo-1556909172-54557c7e4fb7?w=1920&h=1080&fit=crop" alt="Growth Space" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
                        <div class="max-w-3xl">
                            <!-- Slide 1: Nostalgia Engine -->
                            <div x-show="activeSlide === 0" 
                                 x-transition:enter="transition ease-out duration-700 delay-300" 
                                 x-transition:enter-start="opacity-0 transform translate-y-8" 
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-300" 
                                 x-transition:leave-start="opacity-100 transform translate-y-0" 
                                 x-transition:leave-end="opacity-0 transform -translate-y-8">
                                <h1 class="text-5xl lg:text-7xl font-serif font-bold text-white mb-6 leading-tight drop-shadow-2xl">
                                    Kurasi Kenangan <span class="text-[#F4A460]">Indah Anda</span>
                                </h1>
                                <p class="text-xl lg:text-2xl text-white/90 mb-8 leading-relaxed drop-shadow-lg">
                                    Nostalgia Engine membantu Anda mengabadikan dan menghargai momen positif bersama. Bangun linimasa perjalanan hubungan Anda.
                                </p>
                                <a href="{{ route('nostalgia') }}" wire:navigate class="inline-flex items-center gap-2 bg-white text-[#2A3C2A] font-bold px-8 py-4 rounded-full hover:bg-[#E5E0D0] transition-all shadow-2xl">
                                    <span>Jelajahi Kenangan</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>

                            <!-- Slide 2: Invisible Bridge -->
                            <div x-show="activeSlide === 1" 
                                 x-transition:enter="transition ease-out duration-700 delay-300" 
                                 x-transition:enter-start="opacity-0 transform translate-y-8" 
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-300" 
                                 x-transition:leave-start="opacity-100 transform translate-y-0" 
                                 x-transition:leave-end="opacity-0 transform -translate-y-8">
                                <h1 class="text-5xl lg:text-7xl font-serif font-bold text-white mb-6 leading-tight drop-shadow-2xl">
                                    Pahami Kebutuhan <span class="text-[#90EE90]">Mereka</span>
                                </h1>
                                <p class="text-xl lg:text-2xl text-white/90 mb-8 leading-relaxed drop-shadow-lg">
                                    Invisible Bridge menggunakan AI untuk membantu Anda berkomunikasi lebih baik dan memahami keinginan pasangan melalui Komunikasi Non-Kekerasan.
                                </p>
                                <a href="{{ route('bridge') }}" wire:navigate class="inline-flex items-center gap-2 bg-white text-[#2A3C2A] font-bold px-8 py-4 rounded-full hover:bg-[#E5E0D0] transition-all shadow-2xl">
                                    <span>Mulai Percakapan</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>

                            <!-- Slide 3: Date Roulette -->
                            <div x-show="activeSlide === 2" 
                                 x-transition:enter="transition ease-out duration-700 delay-300" 
                                 x-transition:enter-start="opacity-0 transform translate-y-8" 
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-300" 
                                 x-transition:leave-start="opacity-100 transform translate-y-0" 
                                 x-transition:leave-end="opacity-0 transform -translate-y-8">
                                <h1 class="text-5xl lg:text-7xl font-serif font-bold text-white mb-6 leading-tight drop-shadow-2xl">
                                    Ide Kencan <span class="text-[#F4A460]">Spontan</span>
                                </h1>
                                <p class="text-xl lg:text-2xl text-white/90 mb-8 leading-relaxed drop-shadow-lg">
                                    Bingung mau ngapain? Biarkan Date Roulette memilihkan aktivitas seru untukmu. Dari kencan santai di rumah hingga petualangan seru.
                                </p>
                                <a href="{{ route('date-roulette') }}" wire:navigate class="inline-flex items-center gap-2 bg-white text-[#2A3C2A] font-bold px-8 py-4 rounded-full hover:bg-[#E5E0D0] transition-all shadow-2xl">
                                    <span>Putar Roda</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>

                            <!-- Slide 4: Growth Space -->
                            <div x-show="activeSlide === 3" 
                                 x-transition:enter="transition ease-out duration-700 delay-300" 
                                 x-transition:enter-start="opacity-0 transform translate-y-8" 
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-300" 
                                 x-transition:leave-start="opacity-100 transform translate-y-0" 
                                 x-transition:leave-end="opacity-0 transform -translate-y-8">
                                <h1 class="text-5xl lg:text-7xl font-serif font-bold text-white mb-6 leading-tight drop-shadow-2xl">
                                    Tumbuh Bersama, <span class="text-[#90EE90]">Belajar Bersama</span>
                                </h1>
                                <p class="text-xl lg:text-2xl text-white/90 mb-8 leading-relaxed drop-shadow-lg">
                                    Growth Space menawarkan artikel terkurasi dan edukasi mikro untuk membantu Anda membangun hubungan yang lebih kuat dan sehat.
                                </p>
                                <a href="{{ route('growth-space') }}" wire:navigate class="inline-flex items-center gap-2 bg-white text-[#2A3C2A] font-bold px-8 py-4 rounded-full hover:bg-[#E5E0D0] transition-all shadow-2xl">
                                    <span>Mulai Belajar</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Dots -->
                    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 flex justify-center gap-3">
                        <button @click="activeSlide = 0" :class="activeSlide === 0 ? 'bg-white w-12' : 'bg-white/50 w-3'" class="h-3 rounded-full transition-all duration-300 hover:bg-white"></button>
                        <button @click="activeSlide = 1" :class="activeSlide === 1 ? 'bg-white w-12' : 'bg-white/50 w-3'" class="h-3 rounded-full transition-all duration-300 hover:bg-white"></button>
                        <button @click="activeSlide = 2" :class="activeSlide === 2 ? 'bg-white w-12' : 'bg-white/50 w-3'" class="h-3 rounded-full transition-all duration-300 hover:bg-white"></button>
                        <button @click="activeSlide = 3" :class="activeSlide === 3 ? 'bg-white w-12' : 'bg-white/50 w-3'" class="h-3 rounded-full transition-all duration-300 hover:bg-white"></button>
                    </div>

                    <!-- Arrow Navigation -->
                    <button @click="activeSlide = activeSlide > 0 ? activeSlide - 1 : slides - 1" class="absolute left-4 lg:left-8 top-1/2 -translate-y-1/2 z-20 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full shadow-xl flex items-center justify-center hover:bg-white/30 transition-colors">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button @click="activeSlide = activeSlide < slides - 1 ? activeSlide + 1 : 0" class="absolute right-4 lg:right-8 top-1/2 -translate-y-1/2 z-20 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full shadow-xl flex items-center justify-center hover:bg-white/30 transition-colors">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Dashboard Section -->
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
                <!-- Daily Suggestions for Couples -->
                @if(auth()->user()->couple)
                    <div class="mb-12">
                        <!-- Header -->
                        <div class="flex items-center justify-between mb-8 relative">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-white/80 backdrop-blur-md rounded-2xl flex items-center justify-center shadow-lg border border-white/50">
                                    <svg class="w-7 h-7 text-[#2A3C2A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-3xl font-serif font-bold text-[#2A3C2A] tracking-tight">Saran Hari Ini</h3>
                                    <p class="text-sm text-[#6B7C6B] font-medium tracking-wide uppercase">Aksi kecil, dampak besar</p>
                                </div>
                            </div>
                            <!-- Date Badge -->
                            <div class="hidden sm:flex bg-white/60 backdrop-blur-sm px-5 py-2.5 rounded-full shadow-sm border border-white/50">
                                <span class="text-xs font-bold text-[#2A3C2A] tracking-widest uppercase">{{ now()->format('d F Y') }}</span>
                            </div>
                        </div>

                        <!-- Suggestion Cards -->
                        <div class="grid md:grid-cols-3 gap-6" 
                             x-data="{ shown: false }" 
                             x-intersect.threshold.10="shown = true">
                            
                            <!-- Card Template Mixin -->
                            <!-- Suggestion 1: Morning Coffee -->
                            <div :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'" 
                                 class="group relative bg-white/40 backdrop-blur-md rounded-[2rem] p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.1)] transition-all duration-700 ease-out border border-white/60 hover:border-[#C67C5C]/30 overflow-hidden hover:-translate-y-2">
                                <div class="absolute inset-0 bg-gradient-to-br from-white/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                
                                <div class="relative z-10">
                                    <div class="w-14 h-14 bg-[#C67C5C]/10 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#C67C5C] group-hover:text-white transition-all duration-300">
                                        <svg class="w-6 h-6 text-[#C67C5C] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-serif font-bold text-xl text-[#2A3C2A] mb-3">Kopi Pagi</h4>
                                    <p class="text-sm text-[#6B7C6B] leading-relaxed mb-6 font-medium">Awali hari dengan kopi bersama dan bagikan impian kalian.</p>
                                    <div class="flex items-center gap-2 text-xs font-bold text-[#C67C5C] uppercase tracking-wider group-hover:gap-3 transition-all">
                                        <span>Coba Sekarang</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Suggestion 2: Check-in Time -->
                            <div :class="shown ? 'opacity-100 translate-y-0 delay-150' : 'opacity-0 translate-y-8'" 
                                 class="group relative bg-white/40 backdrop-blur-md rounded-[2rem] p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.1)] transition-all duration-700 ease-out border border-white/60 hover:border-[#4A6741]/30 overflow-hidden hover:-translate-y-2">
                                <div class="absolute inset-0 bg-gradient-to-br from-white/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                
                                <div class="relative z-10">
                                    <div class="w-14 h-14 bg-[#4A6741]/10 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#4A6741] group-hover:text-white transition-all duration-300">
                                        <svg class="w-6 h-6 text-[#4A6741] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-serif font-bold text-xl text-[#2A3C2A] mb-3">Waktu Check-in</h4>
                                    <p class="text-sm text-[#6B7C6B] leading-relaxed mb-6 font-medium">Tanya "Gimana perasaanmu hari ini?" dan dengarkan jawabannya.</p>
                                    <div class="flex items-center gap-2 text-xs font-bold text-[#4A6741] uppercase tracking-wider group-hover:gap-3 transition-all">
                                        <span>Mulai Ngobrol</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Suggestion 3: Express Gratitude -->
                            <div :class="shown ? 'opacity-100 translate-y-0 delay-300' : 'opacity-0 translate-y-8'" 
                                 class="group relative bg-white/40 backdrop-blur-md rounded-[2rem] p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.1)] transition-all duration-700 ease-out border border-white/60 hover:border-[#D89A7A]/30 overflow-hidden hover:-translate-y-2">
                                <div class="absolute inset-0 bg-gradient-to-br from-white/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                
                                <div class="relative z-10">
                                    <div class="w-14 h-14 bg-[#D89A7A]/10 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#D89A7A] group-hover:text-white transition-all duration-300">
                                        <svg class="w-6 h-6 text-[#D89A7A] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-serif font-bold text-xl text-[#2A3C2A] mb-3">Ungkapkan Syukur</h4>
                                    <p class="text-sm text-[#6B7C6B] leading-relaxed mb-6 font-medium">Katakan satu hal yang kamu hargai dari pasanganmu hari ini.</p>
                                    <div class="flex items-center gap-2 text-xs font-bold text-[#D89A7A] uppercase tracking-wider group-hover:gap-3 transition-all">
                                        <span>Tunjukkan Cinta</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="text-center mb-16 pt-12 border-t border-black/5">
                    <h2 class="text-4xl font-serif font-bold text-[#2A3C2A] mb-4">Pusat Kendali Hubungan</h2>
                    <p class="text-lg text-[#6B7C6B]">Ringkasan kesehatan hubungan Anda dalam satu pandangan</p>
                </div>

                <!-- Bento Grid for Widgets -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-24"
                     x-data="{ shown: false }" 
                     x-intersect.threshold.10="shown = true">
                    
                    <!-- Widget 1: Energy (Large) -->
                    <div class="lg:col-span-4 transition-all duration-1000 ease-out" 
                         :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-12'">
                        <livewire:energy-meter />
                    </div>

                    <!-- Widget 2: Daily Log (Large) -->
                    <div class="lg:col-span-4 transition-all duration-1000 ease-out delay-150" 
                         :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-12'">
                        <livewire:daily-log-widget />
                    </div>

                    <!-- Widget 3: Partnership Playbook (Large) -->
                    <div class="lg:col-span-4 transition-all duration-1000 ease-out delay-300" 
                         :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-12'">
                        <livewire:partnership-playbook />
                    </div>
                </div>

                <!-- Features Section -->
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-serif font-bold text-[#2A3C2A] mb-4">Fitur Kami</h2>
                    <p class="text-lg text-[#6B7C6B]">Alat bantu untuk memperdalam koneksi Anda</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6"
                     x-data="{ shown: false }" 
                     x-intersect.threshold.10="shown = true">
                    
                    <!-- Nostalgia Engine -->
                    <a href="{{ route('nostalgia') }}" wire:navigate 
                       :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                       class="group relative rounded-[2rem] overflow-hidden shadow-lg h-[400px] cursor-pointer transform transition-all duration-700 ease-out hover:shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=800&h=600&fit=crop" 
                             alt="Nostalgia Engine" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[1.5s]">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                        <div class="absolute inset-0 p-8 flex flex-col justify-end text-white">
                            <div class="transform transition-transform duration-500 group-hover:translate-y-[-10px]">
                                <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <h3 class="text-3xl font-serif font-bold mb-2">Nostalgia Engine</h3>
                                <p class="text-white/80 mb-4 max-w-sm text-lg">Hidupkan kembali momen magis. Kurasi timeline kenangan tak terlupakan bersama pasangan.</p>
                                <div class="flex items-center text-sm font-bold uppercase tracking-widest text-[#F4A460] opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                                    <span>Mulai Menjelajah</span>
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Invisible Bridge -->
                    <a href="{{ route('bridge') }}" wire:navigate
                       :class="shown ? 'opacity-100 translate-y-0 delay-100' : 'opacity-0 translate-y-8'"
                       class="group relative rounded-[2rem] overflow-hidden shadow-lg h-[400px] cursor-pointer transform transition-all duration-700 ease-out hover:shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1516589091380-5d8e87df6999?w=800&h=600&fit=crop" 
                             alt="Invisible Bridge" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[1.5s]">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                        <div class="absolute inset-0 p-8 flex flex-col justify-end text-white">
                            <div class="transform transition-transform duration-500 group-hover:translate-y-[-10px]">
                                <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                </div>
                                <h3 class="text-3xl font-serif font-bold mb-2">Invisible Bridge</h3>
                                <p class="text-white/80 mb-4 max-w-sm text-lg">Pahami bahasa cinta tersembunyi. Gunakan AI untuk menerjemahkan apa yang sebenarnya diinginkan hati.</p>
                                <div class="flex items-center text-sm font-bold uppercase tracking-widest text-[#90EE90] opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                                    <span>Jembatani Hati</span>
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Date Night Roulette -->
                    <a href="{{ route('date-roulette') }}" wire:navigate
                       :class="shown ? 'opacity-100 translate-y-0 delay-200' : 'opacity-0 translate-y-8'"
                       class="group relative rounded-[2rem] overflow-hidden shadow-lg h-[400px] cursor-pointer transform transition-all duration-700 ease-out hover:shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=800&h=600&fit=crop" 
                             alt="Date Night Roulette" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[1.5s]">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                        <div class="absolute inset-0 p-8 flex flex-col justify-end text-white">
                            <div class="transform transition-transform duration-500 group-hover:translate-y-[-10px]">
                                <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h3 class="text-3xl font-serif font-bold mb-2">Date Roulette</h3>
                                <p class="text-white/80 mb-4 max-w-sm text-lg">Kejutan tak terduga. Biarkan takdir memilih petualangan kencan Anda berikutnya.</p>
                                <div class="flex items-center text-sm font-bold uppercase tracking-widest text-[#F4A460] opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                                    <span>Putar Roda</span>
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Growth Space -->
                    <a href="{{ route('growth-space') }}" wire:navigate
                       :class="shown ? 'opacity-100 translate-y-0 delay-300' : 'opacity-0 translate-y-8'"
                       class="group relative rounded-[2rem] overflow-hidden shadow-lg h-[400px] cursor-pointer transform transition-all duration-700 ease-out hover:shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1529390079861-591de354faf5?w=800&h=600&fit=crop" 
                             alt="Growth Space" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[1.5s]">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                        <div class="absolute inset-0 p-8 flex flex-col justify-end text-white">
                            <div class="transform transition-transform duration-500 group-hover:translate-y-[-10px]">
                                <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                <h3 class="text-3xl font-serif font-bold mb-2">Growth Space</h3>
                                <p class="text-white/80 mb-4 max-w-sm text-lg">Tumbuh bersama setiap hari. Edukasi mikro untuk hubungan yang lebih sehat.</p>
                                <div class="flex items-center text-sm font-bold uppercase tracking-widest text-[#90EE90] opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                                    <span>Mulai Belajar</span>
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Floating Action Button -->
            <div x-data="{ open: false }" class="fixed bottom-8 right-8 z-50">
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                     class="absolute bottom-20 right-0 space-y-3 flex flex-col items-end min-w-[220px]">
                    
                    <button onclick="document.getElementById('energy-slider')?.focus()" @click="open = false" 
                        class="flex items-center justify-between gap-3 bg-white text-[#2A3C2A] px-5 py-4 rounded-2xl shadow-xl border border-[#E5E0D0] hover:bg-[#FDFBF7] hover:border-[#C67C5C] group transition-all transform hover:-translate-x-2 w-full">
                        <span class="font-bold group-hover:text-[#C67C5C] transition-colors">Update Energi</span>
                        <span class="bg-[#C67C5C]/10 text-[#C67C5C] w-10 h-10 flex items-center justify-center rounded-lg text-xl">⚡</span>
                    </button>
                    
                    <a href="{{ route('nostalgia') }}" wire:navigate @click="open = false" 
                        class="flex items-center justify-between gap-3 bg-white text-[#2A3C2A] px-5 py-4 rounded-2xl shadow-xl border border-[#E5E0D0] hover:bg-[#FDFBF7] hover:border-[#4A6741] group transition-all transform hover:-translate-x-2 w-full">
                        <span class="font-bold group-hover:text-[#4A6741] transition-colors">Tambah Kenangan</span>
                        <span class="bg-[#4A6741]/10 text-[#4A6741] w-10 h-10 flex items-center justify-center rounded-lg text-xl">📸</span>
                    </a>
                </div>

                <button @click="open = !open" 
                    class="bg-gradient-to-br from-[#2C3E2C] to-[#1E2923] hover:from-[#1E2923] hover:to-[#0F1511] text-white w-16 h-16 rounded-full shadow-2xl flex items-center justify-center transform transition-all duration-300 hover:scale-110 active:scale-95">
                    <svg x-show="!open" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    <svg x-show="open" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        @endif
    </div>
</x-app-layout>
