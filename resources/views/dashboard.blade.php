<x-app-layout>
    <div class="min-h-screen bg-[#FDFBF7]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if(!auth()->user()->couple_id)
                <livewire:partner-coupling />
            @else
                <!-- Hero Section - "Your Memories" -->
                <div class="text-center mb-12 animate-fade-in-up">
                    <h1 class="text-5xl font-serif font-bold text-[#2A3C2A] mb-3">Your Memories</h1>
                    <p class="text-[#6B7C6B] text-lg font-medium">remember special moments with your partner</p>
                </div>

                <!-- Featured Memory Carousel -->
                <div class="mb-16 relative">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Left Memory -->
                        <div class="rounded-3xl overflow-hidden shadow-lg h-64 opacity-60 relative">
                            <img src="https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=600&h=400&fit=crop" 
                                 alt="Couple Memory" 
                                 class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Center Featured Memory -->
                        <div class="rounded-3xl overflow-hidden shadow-2xl h-80 relative">
                            <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&h=600&fit=crop" 
                                 alt="Featured Memory" 
                                 class="w-full h-full object-cover">
                            <div class="absolute top-4 left-4 bg-white/90 px-3 py-1 rounded-full text-xs font-bold text-[#2A3C2A]">
                                20 January 2016
                            </div>
                        </div>
                        
                        <!-- Right Memory -->
                        <div class="rounded-3xl overflow-hidden shadow-lg h-64 opacity-60 relative">
                            <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=600&h=400&fit=crop" 
                                 alt="Couple Memory" 
                                 class="w-full h-full object-cover">
                        </div>
                    </div>
                    
                    <!-- Carousel Dots -->
                    <div class="flex justify-center gap-2 mt-6">
                        <div class="w-2 h-2 rounded-full bg-[#2A3C2A]"></div>
                        <div class="w-2 h-2 rounded-full bg-[#D4CEBC]"></div>
                        <div class="w-2 h-2 rounded-full bg-[#D4CEBC]"></div>
                    </div>
                </div>

                <!-- Feature Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Nostalgia Engine -->
                    <div class="group relative rounded-3xl overflow-hidden shadow-lg h-64 cursor-pointer transform transition-all hover:scale-105">
                        <img src="https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=400&h=300&fit=crop" 
                             alt="Nostalgia Engine" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        <div class="absolute inset-0 p-6 flex flex-col justify-end text-white">
                            <h3 class="text-xl font-bold mb-1">Nostalgia Engine</h3>
                            <p class="text-xs text-white/90">Curate positive memories</p>
                        </div>
                    </div>

                    <!-- Invisible Bridge -->
                    <div class="group relative rounded-3xl overflow-hidden shadow-lg h-64 cursor-pointer transform transition-all hover:scale-105">
                        <img src="https://images.unsplash.com/photo-1516589091380-5d8e87df6999?w=400&h=300&fit=crop" 
                             alt="Invisible Bridge" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        <div class="absolute inset-0 p-6 flex flex-col justify-end text-white">
                            <h3 class="text-xl font-bold mb-1">Invisible Bridge</h3>
                            <p class="text-xs text-white/90">Know what your partner desires</p>
                        </div>
                    </div>

                    <!-- Date Night Roulette -->
                    <div class="group relative rounded-3xl overflow-hidden shadow-lg h-64 cursor-pointer transform transition-all hover:scale-105">
                        <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=400&h=300&fit=crop" 
                             alt="Date Night Roulette" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        <div class="absolute inset-0 p-6 flex flex-col justify-end text-white">
                            <h3 class="text-xl font-bold mb-1">Date Night Roulette</h3>
                            <p class="text-xs text-white/90">Spontaneous activity generator</p>
                        </div>
                    </div>

                    <!-- Growth Space -->
                    <div class="group relative rounded-3xl overflow-hidden shadow-lg h-64 cursor-pointer transform transition-all hover:scale-105">
                        <img src="https://images.unsplash.com/photo-1529390079861-591de354faf5?w=400&h=300&fit=crop" 
                             alt="Growth Space" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        <div class="absolute inset-0 p-6 flex flex-col justify-end text-white">
                            <h3 class="text-xl font-bold mb-1">Growth Space</h3>
                            <p class="text-xs text-white/90">Micro-Education</p>
                        </div>
                    </div>
                </div>

                <!-- Bento Grid Layout - Actual Functional Components -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-12">
                    <!-- 1. Energy Sync -->
                    <div class="h-[400px]">
                        <livewire:energy-meter />
                    </div>

                    <!-- 2. Partnership Playbook -->
                    <div class="h-[400px]">
                        <livewire:partnership-playbook />
                    </div>

                    <!-- 3. Date Roulette -->
                    <div class="h-[400px]">
                         <livewire:date-night-roulette />
                    </div>

                    <!-- 4. Nostalgia Engine -->
                    <div class="h-[400px]">
                         <livewire:memory-flashback />
                    </div>
                </div>

                <!-- Floating Quick Action Button -->
                <div x-data="{ open: false }" class="fixed bottom-10 right-10 z-[100]">
                    <!-- Menu Options -->
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                         class="absolute bottom-24 right-0 mb-2 space-y-3 flex flex-col items-end min-w-[200px]">
                        
                        <button onclick="document.getElementById('energy-slider').focus()" @click="open = false" 
                            class="flex items-center space-x-3 bg-white text-[#2A3C2A] pl-5 pr-3 py-4 rounded-xl shadow-xl border border-[#E5E0D0] hover:bg-[#FDFBF7] group transition-all transform hover:-translate-x-1">
                            <span class="font-bold group-hover:text-[#D86C58] transition-colors">Update Energy</span>
                            <span class="bg-[#D86C58]/10 text-[#D86C58] w-10 h-10 flex items-center justify-center rounded-lg shadow-sm text-xl">⚡</span>
                        </button>
                        
                        <button wire:click="$dispatch('open-memory-form')" @click="open = false" 
                            class="flex items-center space-x-3 bg-white text-[#2A3C2A] pl-5 pr-3 py-4 rounded-xl shadow-xl border border-[#E5E0D0] hover:bg-[#FDFBF7] group transition-all transform hover:-translate-x-1">
                            <span class="font-bold group-hover:text-[#4A6741] transition-colors">Log Memory</span>
                            <span class="bg-[#4A6741]/10 text-[#4A6741] w-10 h-10 flex items-center justify-center rounded-lg shadow-sm text-xl">📸</span>
                        </button>
                    </div>

                    <!-- Main Button -->
                    <button @click="open = !open" 
                        class="bg-[#2C3E2C] hover:bg-[#1E2923] text-white w-20 h-20 rounded-full shadow-2xl flex items-center justify-center transform transition-all duration-300 hover:scale-110 active:scale-95 z-[101]">
                        <svg x-show="!open" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        <svg x-show="open" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
