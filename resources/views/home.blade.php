<x-app-layout>
    <div class="min-h-screen bg-[#FDFBF7]">
        @if(!auth()->user()->couple_id)
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <livewire:pairing-manager />
            </div>
        @else
            <!-- Hero Section with Feature Carousel -->
            <div class="relative overflow-hidden">
                <div x-data="{ activeSlide: 0, slides: 4 }" class="relative min-h-[600px] lg:min-h-[700px]">
                    <!-- Background Images -->
                    <div class="absolute inset-0">
                        <!-- Slide 1: Nostalgia Engine Background -->
                        <div x-show="activeSlide === 0" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0">
                            <img src="https://images.unsplash.com/photo-1518568814500-bf0f8d125f46?w=1920&h=1080&fit=crop" alt="Nostalgia Engine" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>
                        </div>

                        <!-- Slide 2: Invisible Bridge Background -->
                        <div x-show="activeSlide === 1" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0">
                            <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?w=1920&h=1080&fit=crop" alt="Invisible Bridge" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>
                        </div>

                        <!-- Slide 3: Date Roulette Background -->
                        <div x-show="activeSlide === 2" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0">
                            <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=1920&h=1080&fit=crop" alt="Date Roulette" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>
                        </div>

                        <!-- Slide 4: Growth Space Background -->
                        <div x-show="activeSlide === 3" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0">
                            <img src="https://images.unsplash.com/photo-1556909172-54557c7e4fb7?w=1920&h=1080&fit=crop" alt="Growth Space" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
                        <div class="max-w-3xl">
                            <!-- Slide 1: Nostalgia Engine -->
                            <div x-show="activeSlide === 0" x-transition:enter="transition ease-out duration-500 delay-200" x-transition:enter-start="opacity-0 transform translate-y-8" x-transition:enter-end="opacity-100 transform translate-y-0">
                                <h1 class="text-5xl lg:text-7xl font-serif font-bold text-white mb-6 leading-tight drop-shadow-2xl">
                                    Curate Your <span class="text-[#F4A460]">Beautiful Memories</span>
                                </h1>
                                <p class="text-xl lg:text-2xl text-white/90 mb-8 leading-relaxed drop-shadow-lg">
                                    Nostalgia Engine helps you preserve and cherish positive moments together. Build a timeline of your relationship journey.
                                </p>
                                <a href="{{ route('nostalgia') }}" wire:navigate class="inline-flex items-center gap-2 bg-white text-[#2A3C2A] font-bold px-8 py-4 rounded-full hover:bg-[#E5E0D0] transition-all shadow-2xl">
                                    <span>Explore Memories</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>

                            <!-- Slide 2: Invisible Bridge -->
                            <div x-show="activeSlide === 1" x-transition:enter="transition ease-out duration-500 delay-200" x-transition:enter-start="opacity-0 transform translate-y-8" x-transition:enter-end="opacity-100 transform translate-y-0">
                                <h1 class="text-5xl lg:text-7xl font-serif font-bold text-white mb-6 leading-tight drop-shadow-2xl">
                                    Understand What They <span class="text-[#90EE90]">Truly Need</span>
                                </h1>
                                <p class="text-xl lg:text-2xl text-white/90 mb-8 leading-relaxed drop-shadow-lg">
                                    Invisible Bridge uses AI to help you communicate better and understand your partner's desires through Non-Violent Communication.
                                </p>
                                <a href="{{ route('bridge') }}" wire:navigate class="inline-flex items-center gap-2 bg-white text-[#2A3C2A] font-bold px-8 py-4 rounded-full hover:bg-[#E5E0D0] transition-all shadow-2xl">
                                    <span>Start Conversation</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>

                            <!-- Slide 3: Date Roulette -->
                            <div x-show="activeSlide === 2" x-transition:enter="transition ease-out duration-500 delay-200" x-transition:enter-start="opacity-0 transform translate-y-8" x-transition:enter-end="opacity-100 transform translate-y-0">
                                <h1 class="text-5xl lg:text-7xl font-serif font-bold text-white mb-6 leading-tight drop-shadow-2xl">
                                    Spontaneous <span class="text-[#F4A460]">Date Ideas</span>
                                </h1>
                                <p class="text-xl lg:text-2xl text-white/90 mb-8 leading-relaxed drop-shadow-lg">
                                    Can't decide what to do? Let Date Roulette choose a fun activity for you. From cozy indoor dates to exciting adventures.
                                </p>
                                <a href="{{ route('date-roulette') }}" wire:navigate class="inline-flex items-center gap-2 bg-white text-[#2A3C2A] font-bold px-8 py-4 rounded-full hover:bg-[#E5E0D0] transition-all shadow-2xl">
                                    <span>Spin the Wheel</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>

                            <!-- Slide 4: Growth Space -->
                            <div x-show="activeSlide === 3" x-transition:enter="transition ease-out duration-500 delay-200" x-transition:enter-start="opacity-0 transform translate-y-8" x-transition:enter-end="opacity-100 transform translate-y-0">
                                <h1 class="text-5xl lg:text-7xl font-serif font-bold text-white mb-6 leading-tight drop-shadow-2xl">
                                    Grow Together, <span class="text-[#90EE90]">Learn Together</span>
                                </h1>
                                <p class="text-xl lg:text-2xl text-white/90 mb-8 leading-relaxed drop-shadow-lg">
                                    Growth Space offers curated articles and micro-education to help you build a stronger, healthier relationship.
                                </p>
                                <a href="{{ route('growth-space') }}" wire:navigate class="inline-flex items-center gap-2 bg-white text-[#2A3C2A] font-bold px-8 py-4 rounded-full hover:bg-[#E5E0D0] transition-all shadow-2xl">
                                    <span>Start Learning</span>
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
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <!-- Daily Suggestions for Couples -->
                @if(auth()->user()->couple)
                    <div class="mb-12">
                        <!-- Header -->
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-[#C67C5C] to-[#D89A7A] rounded-2xl flex items-center justify-center shadow-lg">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-serif font-bold text-[#2A3C2A]">Today's Suggestions</h3>
                                    <p class="text-sm text-[#6B7C6B]">Small actions, big impact on your relationship</p>
                                </div>
                            </div>
                            <div class="bg-gradient-to-r from-[#E5E0D0] to-[#D4CEBC] px-4 py-2 rounded-full shadow-md">
                                <span class="text-xs font-bold text-[#2A3C2A]">{{ now()->format('M d, Y') }}</span>
                            </div>
                        </div>

                        <!-- Suggestion Cards -->
                        <div class="grid md:grid-cols-3 gap-6">
                            <!-- Suggestion 1: Morning Coffee -->
                            <div class="group relative bg-gradient-to-br from-[#FDFBF7] via-white to-[#E5E0D0] rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all hover:scale-105 border-2 border-[#E5E0D0] hover:border-[#C67C5C] overflow-hidden">
                                <!-- Decorative circle -->
                                <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-[#C67C5C]/10 to-[#D89A7A]/10 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>
                                
                                <div class="relative">
                                    <!-- Icon -->
                                    <div class="w-16 h-16 bg-gradient-to-br from-[#C67C5C] to-[#D89A7A] rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                                        </svg>
                                    </div>
                                    
                                    <!-- Content -->
                                    <h4 class="font-serif font-bold text-xl text-[#2A3C2A] mb-2 group-hover:text-[#C67C5C] transition-colors">Morning Coffee</h4>
                                    <p class="text-sm text-[#6B7C6B] leading-relaxed mb-4">Start the day with a coffee together and share your dreams</p>
                                    
                                    <!-- Action hint -->
                                    <div class="flex items-center gap-2 text-xs text-[#C67C5C] font-bold opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span>Try this today</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Suggestion 2: Check-in Time -->
                            <div class="group relative bg-gradient-to-br from-[#FDFBF7] via-white to-[#E5E0D0] rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all hover:scale-105 border-2 border-[#E5E0D0] hover:border-[#4A6741] overflow-hidden">
                                <!-- Decorative circle -->
                                <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-[#4A6741]/10 to-[#5C7C53]/10 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>
                                
                                <div class="relative">
                                    <!-- Icon -->
                                    <div class="w-16 h-16 bg-gradient-to-br from-[#4A6741] to-[#5C7C53] rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                    
                                    <!-- Content -->
                                    <h4 class="font-serif font-bold text-xl text-[#2A3C2A] mb-2 group-hover:text-[#4A6741] transition-colors">Check-in Time</h4>
                                    <p class="text-sm text-[#6B7C6B] leading-relaxed mb-4">Ask "How are you feeling today?" and truly listen to the answer</p>
                                    
                                    <!-- Action hint -->
                                    <div class="flex items-center gap-2 text-xs text-[#4A6741] font-bold opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span>Connect deeper</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Suggestion 3: Express Gratitude -->
                            <div class="group relative bg-gradient-to-br from-[#FDFBF7] via-white to-[#E5E0D0] rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all hover:scale-105 border-2 border-[#E5E0D0] hover:border-[#D89A7A] overflow-hidden">
                                <!-- Decorative circle -->
                                <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-[#D89A7A]/10 to-[#C67C5C]/10 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>
                                
                                <div class="relative">
                                    <!-- Icon -->
                                    <div class="w-16 h-16 bg-gradient-to-br from-[#D89A7A] to-[#C67C5C] rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                                        <img src="{{ asset('images/custom_heart_icon.png') }}" class="w-10 h-10 object-contain drop-shadow-sm opacity-90" alt="Gratitude">
                                    </div>
                                    
                                    <!-- Content -->
                                    <h4 class="font-serif font-bold text-xl text-[#2A3C2A] mb-2 group-hover:text-[#D89A7A] transition-colors">Express Gratitude</h4>
                                    <p class="text-sm text-[#6B7C6B] leading-relaxed mb-4">Say one thing you appreciate about your partner today</p>
                                    
                                    <!-- Action hint -->
                                    <div class="flex items-center gap-2 text-xs text-[#D89A7A] font-bold opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span>Show love</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="text-center mb-12">
                    <h2 class="text-4xl font-serif font-bold text-[#2A3C2A] mb-3">Your Dashboard</h2>
                    <p class="text-lg text-[#6B7C6B]">Track your relationship health in real-time</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-20">
                    <livewire:energy-meter />
                    <livewire:daily-log-widget />
                    <livewire:partnership-playbook />
                </div>

                <!-- Features Section -->
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-serif font-bold text-[#2A3C2A] mb-3">Our Features</h2>
                    <p class="text-lg text-[#6B7C6B]">Everything you need to nurture your relationship</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Nostalgia Engine -->
                    <a href="{{ route('nostalgia') }}" wire:navigate 
                       class="group relative rounded-3xl overflow-hidden shadow-lg h-72 cursor-pointer transform transition-all hover:scale-105 hover:shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=400&h=300&fit=crop" 
                             alt="Nostalgia Engine" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
                        <div class="absolute inset-0 p-6 flex flex-col justify-end text-white">
                            <div class="transform transition-transform group-hover:translate-y-[-8px]">
                                <h3 class="text-2xl font-serif font-bold mb-2">Nostalgia Engine</h3>
                                <p class="text-sm text-white/90 mb-3">Curate positive memories</p>
                                <div class="flex items-center text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span>Explore</span>
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Invisible Bridge -->
                    <a href="{{ route('bridge') }}" wire:navigate
                       class="group relative rounded-3xl overflow-hidden shadow-lg h-72 cursor-pointer transform transition-all hover:scale-105 hover:shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1516589091380-5d8e87df6999?w=400&h=300&fit=crop" 
                             alt="Invisible Bridge" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
                        <div class="absolute inset-0 p-6 flex flex-col justify-end text-white">
                            <div class="transform transition-transform group-hover:translate-y-[-8px]">
                                <h3 class="text-2xl font-serif font-bold mb-2">Invisible Bridge</h3>
                                <p class="text-sm text-white/90 mb-3">Know what your partner desires</p>
                                <div class="flex items-center text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span>Explore</span>
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Date Night Roulette -->
                    <a href="{{ route('date-roulette') }}" wire:navigate
                       class="group relative rounded-3xl overflow-hidden shadow-lg h-72 cursor-pointer transform transition-all hover:scale-105 hover:shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=400&h=300&fit=crop" 
                             alt="Date Night Roulette" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
                        <div class="absolute inset-0 p-6 flex flex-col justify-end text-white">
                            <div class="transform transition-transform group-hover:translate-y-[-8px]">
                                <h3 class="text-2xl font-serif font-bold mb-2">Date Night Roulette</h3>
                                <p class="text-sm text-white/90 mb-3">Spontaneous activity generator</p>
                                <div class="flex items-center text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span>Explore</span>
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Growth Space -->
                    <a href="{{ route('growth-space') }}" wire:navigate
                       class="group relative rounded-3xl overflow-hidden shadow-lg h-72 cursor-pointer transform transition-all hover:scale-105 hover:shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1529390079861-591de354faf5?w=400&h=300&fit=crop" 
                             alt="Growth Space" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
                        <div class="absolute inset-0 p-6 flex flex-col justify-end text-white">
                            <div class="transform transition-transform group-hover:translate-y-[-8px]">
                                <h3 class="text-2xl font-serif font-bold mb-2">Growth Space</h3>
                                <p class="text-sm text-white/90 mb-3">Micro-Education</p>
                                <div class="flex items-center text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span>Explore</span>
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
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
                        <span class="font-bold group-hover:text-[#C67C5C] transition-colors">Update Energy</span>
                        <span class="bg-[#C67C5C]/10 text-[#C67C5C] w-10 h-10 flex items-center justify-center rounded-lg text-xl">⚡</span>
                    </button>
                    
                    <a href="{{ route('nostalgia') }}" wire:navigate @click="open = false" 
                        class="flex items-center justify-between gap-3 bg-white text-[#2A3C2A] px-5 py-4 rounded-2xl shadow-xl border border-[#E5E0D0] hover:bg-[#FDFBF7] hover:border-[#4A6741] group transition-all transform hover:-translate-x-2 w-full">
                        <span class="font-bold group-hover:text-[#4A6741] transition-colors">Add Memory</span>
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
