<div class="min-h-screen bg-[#FDFBF7]">
    @if(!$selectedActivity)
    <!-- Hero Section -->
    <div class="relative bg-[#FDFBF7] min-h-[90vh] flex items-start pt-0 lg:pt-0 pb-12 overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
             <img src="https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=2000&auto=format&fit=crop" 
                 alt="Background" 
                 class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-r from-[#FDFBF7]/90 via-[#FDFBF7]/70 to-[#FDFBF7]/40"></div>
        </div>
        
        <!-- Abstract Background Blobs -->
         <div class="absolute top-0 right-0 w-2/3 h-full bg-[#FAEFED]/30 rounded-l-[100px] -z-10 transform translate-x-1/3"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 w-full pt-4">
            <!-- Main Grid layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-start pt-4 lg:pt-8">
                
                <!-- Left Content -->
                <div class="text-left flex flex-col h-full justify-between space-y-12">
                    <!-- Title Section -->
                    <div class="space-y-8">
                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-serif font-bold text-[#4A3427] leading-[0.95] tracking-tight">
                            Ciptakan <br> Momen <br>
                            <span class="text-[#C67C5C] italic">Tak Terlupakan</span>
                        </h1>

                        <!-- Buttons -->
                        <div class="flex flex-col sm:flex-row flex-wrap gap-4">
                            <a href="#preferences" class="bg-[#EAB89D] hover:bg-[#E2A688] text-[#4A3427] font-bold py-3 px-8 text-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 min-w-[180px] text-center">
                                Mulai Rencanakan
                            </a>
                            
                            <a href="#activities" class="bg-transparent border-2 border-[#EAB89D] text-[#4A3427] font-bold py-3 px-8 text-lg hover:bg-[#FFF5F2] transition-colors min-w-[180px] text-center flex items-center justify-center">
                                Lihat Ide
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
                                <span class="block font-bold text-lg">2,718 Pasangan Bahagia</span>
                                <span class="text-sm text-[#8A7A70]">Mempercayai Amora</span>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Row -->
                    <div class="grid grid-cols-3 gap-3 sm:gap-12 pt-8 pb-12">
                        <div>
                            <div class="text-2xl sm:text-4xl font-serif font-bold text-[#4A3427]">{{ count($activities) }}+</div>
                            <div class="text-[10px] sm:text-sm text-[#8A7A70] uppercase tracking-wide font-bold mt-2">Aktivitas</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-4xl font-serif font-bold text-[#4A3427]">24/7</div>
                            <div class="text-[10px] sm:text-sm text-[#8A7A70] uppercase tracking-wide font-bold mt-2">Tersedia</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-4xl font-serif font-bold text-[#4A3427]">100%</div>
                            <div class="text-[10px] sm:text-sm text-[#8A7A70] uppercase tracking-wide font-bold mt-2">Seru</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Images -->
                <div class="flex flex-col h-full lg:pl-12">
                    <div class="mb-12 lg:mb-auto pt-2">
                        <p class="text-[#5D544F] text-xl lg:text-xl leading-relaxed max-w-lg font-medium">
                            Kami percaya bahwa merancang kencan yang sempurna lebih dari sekadar perencanaan – ini tentang mengkurasi pengalaman yang mencerminkan kisah cinta unik Anda dan menjaga api asmara tetap menyala.
                        </p>
                    </div>

                    <!-- Images Container -->
                    <div class="relative h-[500px] w-full mt-8 lg:mt-0">
                         <div class="absolute inset-0 bg-[#FAE3D5] opacity-40 blur-3xl rounded-full transform rotate-45 scale-75 -z-10"></div>
                        <div class="absolute top-0 right-10 text-[#EAB89D] text-5xl animate-pulse">✨</div>
                        <div class="absolute bottom-10 left-0 text-[#EAB89D] text-6xl opacity-50 transform -rotate-12">♡</div>

                        <!-- Static Polaroid 1 (Back) -->
                        <div class="absolute top-10 right-0 w-80 h-96 bg-white p-3 pb-12 shadow-2xl transform rotate-6 z-10 border border-[#EBEBEB]">
                            <img src="https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=500&q=80" class="w-full h-full object-cover filter contrast-105" alt="Couple 1">
                        </div>

                        <!-- Static Polaroid 2 (Front) -->
                        <div class="absolute top-24 right-48 w-72 h-80 bg-white p-3 pb-10 shadow-xl transform -rotate-3 z-20 border border-[#EBEBEB]">
                            <img src="https://images.unsplash.com/photo-1621621667797-e06afc217fb0?w=500&q=80" class="w-full h-full object-cover filter sepia-[.1]" alt="Couple 2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Categories Grid - Now directly below hero -->
    <div id="activities" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 mt-56 border-t-2 border-[#E5E0D0] mb-24">
        <div class="text-center mb-12">
            <h3 class="text-3xl lg:text-4xl font-serif font-bold text-[#2A3C2A] mb-3">Lihat Semua Aktivitas</h3>
            <p class="text-[#6B7C6B] text-lg">Pilih aktivitas atau dapatkan rekomendasi AI berdasarkan preferensi Anda</p>
        </div>

        <!-- Compact Preference Filter Bar -->
        <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-lg border border-[#E5E0D0] mb-12">
            <div class="flex flex-col sm:flex-row sm:flex-wrap items-stretch sm:items-end gap-4">
                <div class="flex-1 sm:min-w-[200px] w-full">
                    <label class="block text-xs font-bold text-[#8A7A70] uppercase tracking-wider mb-2">Suasana</label>
                    <select wire:model="atmosphere" class="w-full bg-[#FDFBF7] border-[#E5E0D0] rounded-lg focus:ring-[#C67C5C] focus:border-[#C67C5C] font-bold text-[#2A3C2A] py-2 px-3">
                        <option value="Romantis">Romantis</option>
                        <option value="Keluarga">Keluarga</option>
                        <option value="Ngobrol Santai">Ngobrol Santai</option>
                        <option value="Petualangan">Petualangan</option>
                        <option value="Hemat">Hemat & Seru</option>
                    </select>
                </div>

                <div class="flex-1 sm:min-w-[180px] w-full">
                    <label class="block text-xs font-bold text-[#8A7A70] uppercase tracking-wider mb-2">Lokasi</label>
                    <div class="grid grid-cols-2 gap-2">
                        <button wire:click="$set('location', 'Indoor')" class="py-2 px-3 rounded-lg border-2 font-bold text-sm transition-all {{ $location === 'Indoor' ? 'bg-[#4A6741] text-white border-[#4A6741]' : 'bg-white text-[#8A7A70] border-[#E5E0D0] hover:border-[#4A6741]' }}">Indoor</button>
                        <button wire:click="$set('location', 'Outdoor')" class="py-2 px-3 rounded-lg border-2 font-bold text-sm transition-all {{ $location === 'Outdoor' ? 'bg-[#4A6741] text-white border-[#4A6741]' : 'bg-white text-[#8A7A70] border-[#E5E0D0] hover:border-[#4A6741]' }}">Outdoor</button>
                    </div>
                </div>

                <div class="flex-1 sm:min-w-[200px] w-full">
                    <label class="block text-xs font-bold text-[#8A7A70] uppercase tracking-wider mb-2">Anggaran</label>
                    <div class="flex gap-2">
                        @foreach(['Low', 'Medium', 'High'] as $b)
                            <button wire:click="$set('budget', '{{ $b }}')" 
                                class="flex-1 py-2 px-2 rounded-lg border-2 font-bold text-xs transition-all {{ $budget === $b ? 'bg-[#C67C5C] text-white border-[#C67C5C]' : 'bg-white text-[#8A7A70] border-[#E5E0D0]' }}">
                                {{ $b }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="flex-shrink-0 w-full sm:w-auto">
                    <button wire:click="getRecommendation" wire:loading.attr="disabled"
                            class="w-full sm:w-auto bg-[#2A3C2A] text-white font-bold py-2 px-8 rounded-lg border-2 border-[#2A3C2A] hover:bg-[#1a261a] transition-all shadow-lg flex items-center justify-center gap-2">
                        <span wire:loading.remove>Saran AI</span>
                        <span wire:loading>Berpikir...</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($this->filteredActivities as $activity)
                <button 
                    wire:click="selectActivity({{ $activity['id'] }})"
                    class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all hover:scale-105 border-2 border-[#E5E0D0] hover:border-[#C67C5C] relative">
                    <!-- Image -->
                    <div class="relative h-40 overflow-hidden">
                        <img src="{{ $activity['image'] }}" 
                             alt="{{ $activity['title'] }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
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
            @empty
                <div class="col-span-full text-center py-16">
                    <div class="text-6xl mb-4">🔍</div>
                    <h3 class="text-2xl font-bold text-[#2A3C2A] mb-2">Tidak Ada Aktivitas yang Cocok</h3>
                    <p class="text-[#6B7C6B] mb-6">Coba ubah filter atau gunakan "Saran AI" untuk rekomendasi yang dipersonalisasi!</p>
                    <button wire:click="getRecommendation" class="bg-[#4A6741] text-white font-bold py-3 px-8 rounded-lg hover:bg-[#3A5233] transition-all">
                        Gunakan Saran AI
                    </button>
                </div>
            @endforelse
        </div>
    </div>
    @else
        <!-- Selected Activity Display -->
        <div class="max-w-4xl mx-auto px-4 py-6">
            <!-- Back Button -->
            <button wire:click="resetSelection" class="mb-6 flex items-center gap-2 text-[#6B7C6B] hover:text-[#2A3C2A] transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span class="font-bold">Kembali ke Aktivitas</span>
            </button>

            <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-2xl border border-[#E5E0D0]">
                <div class="relative h-[180px]">
                    <img src="{{ $selectedActivity['image'] }}" class="w-full h-full object-cover" alt="Date Idea">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8">
                        <span class="bg-[#C67C5C] text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-3 inline-block">Rekomendasi Pintar</span>
                        <h2 class="text-3xl md:text-4xl font-serif font-bold text-white mb-2">{{ $selectedActivity['title'] }}</h2>
                        <div class="flex items-center gap-4 text-white/80 text-sm font-bold">
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6z"></path></svg> {{ $selectedActivity['category'] }}</span>
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg> Anggaran {{ $selectedActivity['budget'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="p-4 md:p-6">
                    <h4 class="text-xs font-bold text-[#C67C5C] uppercase tracking-widest mb-4">Kenapa ini cocok untuk kalian?</h4>
                    <p class="text-[#2A3C2A] text-base leading-relaxed font-serif mb-4 italic">
                        "{{ $selectedActivity['description'] }}"
                    </p>
                    
                    @if(isset($selectedActivity['tips']) && $selectedActivity['tips'])
                    <div class="bg-[#FDFBF7] p-6 rounded-2xl border-l-4 border-[#4A6741]">
                        <h5 class="text-[#4A6741] font-bold text-sm uppercase tracking-wider mb-2">Tips Pro untuk Pasangan</h5>
                        <p class="text-[#8A7A70] text-sm">{{ $selectedActivity['tips'] }}</p>
                    </div>
                    @endif

                    <div class="mt-10 flex flex-col sm:flex-row gap-4">
                        <button wire:click="resetSelection" class="flex-1 py-4 px-6 border-2 border-[#E5E0D0] text-[#2A3C2A] font-bold rounded-2xl hover:bg-[#FDFBF7] transition-all">Cari Ide Lain</button>
                        <button class="flex-1 py-4 px-6 bg-[#4A6741] text-white font-bold rounded-2xl hover:bg-[#3A5233] shadow-lg shadow-[#4A6741]/20 transition-all">Simpan Rencana</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
