<div class="min-h-screen bg-[#FDFBF7]">
    @if(!$selectedActivity)
    <!-- New Hero Section (Split Layout) -->
    <div class="relative bg-[#FDFBF7] min-h-[90vh] flex items-start pt-0 lg:pt-0 pb-12 overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
             <img src="https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=2000&auto=format&fit=crop" 
                 alt="Background" 
                 class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-r from-[#FDFBF7]/90 via-[#FDFBF7]/70 to-[#FDFBF7]/40"></div>
        </div>
        
        <!-- Abstract Background Blobs (Subtle) -->
         <div class="absolute top-0 right-0 w-2/3 h-full bg-[#FAEFED]/30 rounded-l-[100px] -z-10 transform translate-x-1/3"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 w-full pt-4">
            <!-- Main Grid layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-start pt-4 lg:pt-8">
                
                <!-- Left Content -->
                <div class="text-left flex flex-col h-full justify-between space-y-12">
                    <!-- Title Section -->
                    <div class="space-y-8">
                        <h1 class="text-6xl lg:text-8xl font-serif font-bold text-[#4A3427] leading-[0.95] tracking-tight">
                            Creating <br> Forever <br>
                            <span class="text-[#C67C5C] italic">New Beginnings</span>
                        </h1>

                        <!-- Buttons -->
                        <div class="flex flex-wrap gap-4">
                            <button 
                                wire:click="spinWheel" 
                                @if($isSpinning) disabled @endif
                                class="bg-[#EAB89D] hover:bg-[#E2A688] text-[#4A3427] font-bold py-5 px-12 text-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 disabled:opacity-70 disabled:cursor-not-allowed min-w-[200px]">
                                {{ $isSpinning ? 'Selecting...' : 'Spin Roulette' }}
                            </button>
                            
                            <a href="#activities" class="bg-transparent border-2 border-[#EAB89D] text-[#4A3427] font-bold py-5 px-12 text-lg hover:bg-[#FFF5F2] transition-colors min-w-[200px] text-center flex items-center justify-center">
                                Contact Us
                            </a>
                        </div>

                        <!-- Social Proof -->
                        <div class="flex items-center gap-6">
                            <div class="flex -space-x-4">
                                <img class="w-14 h-14 rounded-full border-4 border-[#FDFBF7] object-cover" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop" alt="User">
                                <img class="w-14 h-14 rounded-full border-4 border-[#FDFBF7] object-cover" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=100&h=100&fit=crop" alt="User">
                                <img class="w-14 h-14 rounded-full border-4 border-[#FDFBF7] object-cover" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop" alt="User">
                                <div class="w-14 h-14 rounded-full border-4 border-[#FDFBF7] bg-[#EAB89D] text-[#4A3427] flex items-center justify-center font-bold text-xs">2k+</div>
                            </div>
                            <div class="text-[#4A3427] font-medium">
                                <span class="block font-bold text-lg">2,718 Happy Couples</span>
                                <span class="text-sm text-[#8A7A70]">Trust Amora</span>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Row (Pinned to bottom of left col) -->
                    <div class="grid grid-cols-3 gap-12 pt-8 pb-12">
                        <div>
                            <div class="text-4xl font-serif font-bold text-[#4A3427]">{{ count($activities) }}+</div>
                            <div class="text-sm text-[#8A7A70] uppercase tracking-wide font-bold mt-2">Activities</div>
                        </div>
                        <div>
                            <div class="text-4xl font-serif font-bold text-[#4A3427]">24/7</div>
                            <div class="text-sm text-[#8A7A70] uppercase tracking-wide font-bold mt-2">Available</div>
                        </div>
                        <div>
                            <div class="text-4xl font-serif font-bold text-[#4A3427]">100%</div>
                            <div class="text-sm text-[#8A7A70] uppercase tracking-wide font-bold mt-2">Fun</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content -->
                <div class="flex flex-col h-full lg:pl-12">
                    <!-- Description Text (Top aligned with Title) -->
                    <div class="mb-12 lg:mb-auto pt-2">
                        <p class="text-[#5D544F] text-xl lg:text-xl leading-relaxed max-w-lg font-medium">
                            We believe that crafting the perfect date night goes beyond mere planning – it's about curating an experience that echoes your unique love story and keeps the spark alive.
                        </p>
                    </div>

                    <!-- Images Container (Bottom Aligned) -->
                    <div class="relative h-[500px] w-full mt-8 lg:mt-0">
                         <!-- Paint Brush Background Effect -->
                        <div class="absolute inset-0 bg-[#FAE3D5] opacity-40 blur-3xl rounded-full transform rotate-45 scale-75 -z-10"></div>

                        <!-- Decorative Stars -->
                        <div class="absolute top-0 right-10 text-[#EAB89D] text-5xl animate-pulse">✨</div>
                        <div class="absolute bottom-10 left-0 text-[#EAB89D] text-6xl opacity-50 transform -rotate-12">♡</div>

                         <!-- Images -->
                        @if($isSpinning)
                            <!-- Spinning Animation / Shuffling Cards -->
                             <div class="absolute inset-x-10 inset-y-10 flex items-center justify-center">
                                <div class="relative w-80 h-96 bg-white p-4 shadow-2xl transform transition-all duration-300 animate-[spin_1s_linear_infinite]">
                                    <div class="w-full h-full bg-[#EAB89D] flex items-center justify-center">
                                        <span class="text-6xl">🎰</span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Static Polaroid 1 (Back) -->
                            <div class="absolute top-10 right-0 w-80 h-96 bg-white p-3 pb-12 shadow-2xl transform rotate-6 z-10 border border-[#EBEBEB]">
                                <img src="https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=500&q=80" class="w-full h-full object-cover filter contrast-105" alt="Couple 1">
                            </div>

                            <!-- Static Polaroid 2 (Front) -->
                            <div class="absolute top-24 right-48 w-72 h-80 bg-white p-3 pb-10 shadow-xl transform -rotate-3 z-20 border border-[#EBEBEB]">
                                <img src="https://images.unsplash.com/photo-1621621667797-e06afc217fb0?w=500&q=80" class="w-full h-full object-cover filter sepia-[.1]" alt="Couple 2">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

            <!-- Activity Categories -->
            <div class="border-t-2 border-[#E5E0D0] pt-16">
                <div class="text-center mb-12">
                    <h3 class="text-3xl lg:text-4xl font-serif font-bold text-[#2A3C2A] mb-3">Browse All Activities</h3>
                    <p class="text-[#6B7C6B] text-lg">Or choose an activity manually</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($activities as $activity)
                        <button 
                            wire:click="selectActivity({{ $activity['id'] }})"
                            class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all hover:scale-105 border-2 border-[#E5E0D0] hover:border-[#C67C5C] relative">
                            <!-- Image -->
                            <div class="relative h-40 overflow-hidden">
                                <img src="{{ $activity['image'] }}" 
                                     alt="{{ $activity['title'] }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <!-- Gradient overlay on hover -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </div>
                            
                            <!-- Content -->
                            <div class="p-4">
                                <h4 class="font-bold text-[#2A3C2A] text-base mb-2 group-hover:text-[#C67C5C] transition-colors">{{ $activity['title'] }}</h4>
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-[#6B7C6B]">{{ $activity['category'] }}</span>
                                    <span class="text-[#C67C5C] font-bold">{{ $activity['budget'] }}</span>
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Selected Activity Display -->
            <div class="max-w-4xl mx-auto">
                <!-- Back Button -->
                <button wire:click="resetSelection" class="mb-6 flex items-center gap-2 text-[#6B7C6B] hover:text-[#2A3C2A] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span class="font-bold">Back to Roulette</span>
                </button>

                <!-- Activity Card -->
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-[#E5E0D0]">
                    <!-- Header with Image Background -->
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $selectedActivity['image'] }}" 
                             alt="{{ $selectedActivity['title'] }}" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-8">
                            <h2 class="text-4xl lg:text-5xl font-serif font-bold mb-3 drop-shadow-lg text-center">{{ $selectedActivity['title'] }}</h2>
                            <p class="text-xl text-white/95 drop-shadow-lg text-center max-w-2xl">{{ $selectedActivity['description'] }}</p>
                        </div>
                    </div>

                    <!-- Details Section -->
                    <div class="p-8 lg:p-12">
                        <!-- Tags -->
                        <div class="flex flex-wrap justify-center gap-3 mb-8">
                            <div class="bg-gradient-to-r from-[#C67C5C] to-[#D89A7A] text-white px-6 py-3 rounded-full font-bold shadow-lg">
                                <span class="mr-2">📍</span>{{ $selectedActivity['category'] }}
                            </div>
                            <div class="bg-gradient-to-r from-[#4A6741] to-[#5C7C53] text-white px-6 py-3 rounded-full font-bold shadow-lg">
                                <span class="mr-2">💰</span>{{ $selectedActivity['budget'] }}
                            </div>
                        </div>

                        <!-- Tips Section -->
                        <div class="bg-gradient-to-br from-[#FDFBF7] to-[#E5E0D0] rounded-2xl p-8 mb-8 border-2 border-[#E5E0D0]">
                            <h3 class="font-serif font-bold text-2xl text-[#2A3C2A] mb-6 flex items-center gap-3">
                                <span class="text-4xl">💡</span>
                                Tips to Make it Special
                            </h3>
                            <ul class="space-y-4 text-[#6B7C6B]">
                                <li class="flex items-start gap-4">
                                    <span class="flex-shrink-0 w-8 h-8 bg-[#C67C5C] text-white rounded-full flex items-center justify-center font-bold">1</span>
                                    <span class="text-base">Set the mood with your partner's favorite music or playlist</span>
                                </li>
                                <li class="flex items-start gap-4">
                                    <span class="flex-shrink-0 w-8 h-8 bg-[#C67C5C] text-white rounded-full flex items-center justify-center font-bold">2</span>
                                    <span class="text-base">Turn off phones and notifications - be fully present together</span>
                                </li>
                                <li class="flex items-start gap-4">
                                    <span class="flex-shrink-0 w-8 h-8 bg-[#C67C5C] text-white rounded-full flex items-center justify-center font-bold">3</span>
                                    <span class="text-base">Capture the moment with photos to add to your Nostalgia Engine</span>
                                </li>
                                <li class="flex items-start gap-4">
                                    <span class="flex-shrink-0 w-8 h-8 bg-[#C67C5C] text-white rounded-full flex items-center justify-center font-bold">4</span>
                                    <span class="text-base">Focus on connection and conversation, not perfection</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <button 
                                wire:click="resetSelection"
                                class="flex-1 sm:flex-none bg-white border-2 border-[#E5E0D0] hover:border-[#C67C5C] text-[#2A3C2A] font-bold py-4 px-8 rounded-full transition-all shadow-md hover:shadow-xl flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Try Another
                            </button>
                            <button 
                                class="flex-1 sm:flex-none bg-gradient-to-r from-[#C67C5C] to-[#D89A7A] hover:from-[#D89A7A] hover:to-[#C67C5C] text-white font-bold py-4 px-8 rounded-full transition-all shadow-md hover:shadow-xl flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                </svg>
                                Save This Idea
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Auto-spin script -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('start-spin', () => {
                setTimeout(() => {
                    const randomIndex = Math.floor(Math.random() * {{ count($activities) }});
                    const activityId = {{ json_encode(array_column($activities, 'id')) }}[randomIndex];
                    @this.selectActivity(activityId);
                }, 2000);
            });
        });
    </script>
</div>
