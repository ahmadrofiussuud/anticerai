<div class="min-h-screen bg-[#FDFBF7]" x-data="{ showFilters: false }">
    <!-- Isometric Hero Section -->
    <div class="relative w-full min-h-[700px] flex items-center justify-center overflow-hidden pt-20 pb-20">
        
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1490730141103-6cac27aaab94?w=1920&q=80" 
                 alt="Nostalgic Sky" 
                 class="w-full h-full object-cover opacity-90">
            <div class="absolute inset-0 bg-gradient-to-b from-[#FDFBF7]/90 via-[#FDFBF7]/80 to-[#FDFBF7]"></div>
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoNDIsIDYwLCA0MiwgMC4wNSkiLz48L3N2Zz4=')] opacity-30"></div>
        </div>

        <!-- Central Core (Memory Hub) -->
        <div class="relative z-10 flex flex-col items-center justify-center text-center animate-float">
            <div class="relative w-64 h-64 mb-8">
                <!-- Glowing Orb Background -->
                <div class="absolute inset-0 bg-[#C67C5C]/20 rounded-full blur-[80px] animate-pulse-glow"></div>
                
                <!-- Main Core Sphere -->
                <div class="absolute inset-0 bg-gradient-to-br from-white to-[#E5E0D0] rounded-full shadow-[0_20px_50px_rgba(198,124,92,0.3)] border border-white/60 backdrop-blur-xl flex items-center justify-center z-10">
                    <div class="w-48 h-48 bg-gradient-to-tr from-[#FFF3E0] to-[#FDFBF7] rounded-full shadow-inner flex items-center justify-center border border-[#E5E0D0] p-6">
                         <img src="{{ asset('images/amora_logo_circle.png') }}" alt="Amora Core" class="w-full h-full object-contain animate-pulse-glow drop-shadow-md">
                    </div>
                </div>

                <!-- Orbiting Rings -->
                <div class="absolute inset-0 border border-[#C67C5C]/20 rounded-full animate-[spin_10s_linear_infinite]"></div>
                <div class="absolute -inset-4 border border-[#4A6741]/10 rounded-full animate-[spin_15s_linear_infinite_reverse]"></div>
            </div>

            <h1 class="text-5xl lg:text-7xl font-serif font-bold text-[#2A3C2A] mb-4 relative z-20">Mesin Nostalgia</h1>
            <p class="text-[#6B7C6B] text-xl max-w-lg mx-auto leading-relaxed relative z-20">
                Linimasa momen indah Anda, dikurasi secara otomatis.
            </p>
        </div>

        <!-- Floating Node: Top Left (Milestones) -->
        <div class="absolute top-[8%] left-[2%] lg:left-[5%] hidden md:block animate-float-delayed z-10">
            <!-- Connector Line -->
            <svg class="absolute top-1/2 left-full w-32 h-20 -z-10 text-[#C67C5C]/40 hidden lg:block" style="transform: rotate(15deg);">
                 <path d="M0,10 Q60,10 120,80" fill="none" stroke="currentColor" stroke-width="2" stroke-dasharray="4 4" />
            </svg>

            <div class="relative w-80 h-32 rounded-3xl overflow-hidden shadow-[0_15px_40px_rgba(0,0,0,0.2)] transform hover:scale-105 transition-all cursor-pointer group border-2 border-white/30">
                <img src="https://images.unsplash.com/photo-1530021232320-687d8e3dba54?w=400&q=80" 
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                     alt="Milestones">
                <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
                <div class="absolute inset-0 p-6 flex flex-col justify-center">
                    <h3 class="font-serif font-bold text-white text-2xl leading-tight shadow-black/50 drop-shadow-md mb-1">Tonggak Sejarah</h3>
                    <p class="text-xs font-bold text-[#F4A460] uppercase tracking-wider">{{ now()->year - 2016 }} Tahun Perjalanan</p>
                </div>
            </div>
        </div>

        <!-- Floating Node: Top Right (Adventures) -->
        <div class="absolute top-[12%] right-[2%] lg:right-[5%] hidden md:block animate-float z-10">
             <!-- Connector Line -->
             <svg class="absolute top-1/2 right-full w-40 h-20 -z-10 text-[#4A6741]/40 hidden lg:block" style="transform: rotate(-15deg);">
                 <path d="M160,10 Q80,10 0,80" fill="none" stroke="currentColor" stroke-width="2" stroke-dasharray="4 4" />
            </svg>

            <div class="relative w-80 h-32 rounded-3xl overflow-hidden shadow-[0_15px_40px_rgba(0,0,0,0.2)] transform hover:scale-105 transition-all cursor-pointer group border-2 border-white/30">
                <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=400&q=80" 
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                     alt="Adventures">
                <div class="absolute inset-0 bg-gradient-to-l from-black/80 via-black/40 to-transparent"></div>
                <div class="absolute inset-0 p-6 flex flex-col justify-center items-end text-right">
                     <h3 class="font-serif font-bold text-white text-2xl leading-tight shadow-black/50 drop-shadow-md mb-1">Petualangan</h3>
                     <p class="text-xs font-bold text-[#90EE90] uppercase tracking-wider">{{ count($memories) }} Terabadikan</p>
                </div>
            </div>
        </div>

        <!-- Floating Node: Bottom Left (Connection) -->
        <div class="absolute bottom-[20%] left-[2%] lg:left-[5%] hidden md:block animate-float z-10">
            <!-- Connector Line -->
            <svg class="absolute bottom-1/2 left-full w-32 h-24 -z-10 text-[#D89A7A]/40 hidden lg:block" style="transform: rotate(-15deg);">
                 <path d="M0,80 Q60,80 120,10" fill="none" stroke="currentColor" stroke-width="2" stroke-dasharray="4 4" />
            </svg>

            <div class="relative w-80 h-32 rounded-3xl overflow-hidden shadow-[0_15px_40px_rgba(0,0,0,0.2)] transform hover:scale-105 transition-all cursor-pointer group border-2 border-white/30">
                <img src="https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=400&q=80" 
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                     alt="Connection">
                <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
                <div class="absolute inset-0 p-6 flex flex-col justify-center">
                    <h3 class="font-serif font-bold text-white text-2xl leading-tight shadow-black/50 drop-shadow-md mb-1">Koneksi</h3>
                    <p class="text-xs font-bold text-[#FFB7B2] uppercase tracking-wider">Pertumbuhan Tanpa Batas</p>
                </div>
            </div>
        </div>

         <!-- Floating Node: Bottom Right (Categories) -->
         <div class="absolute bottom-[15%] right-[2%] lg:right-[5%] hidden md:block animate-float-delayed z-10">
             <!-- Connector Line -->
            <svg class="absolute bottom-1/2 right-full w-40 h-24 -z-10 text-[#5C7C53]/40 hidden lg:block" style="transform: rotate(15deg);">
                 <path d="M160,80 Q80,80 0,10" fill="none" stroke="currentColor" stroke-width="2" stroke-dasharray="4 4" />
            </svg>

            <div class="relative w-80 h-32 rounded-3xl overflow-hidden shadow-[0_15px_40px_rgba(0,0,0,0.2)] transform hover:scale-105 transition-all cursor-pointer group border-2 border-white/30">
                <img src="https://images.unsplash.com/photo-1544377193-33dcf4d68fb5?w=400&q=80" 
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                     alt="Categories">
                <div class="absolute inset-0 bg-gradient-to-l from-black/80 via-black/40 to-transparent"></div>
                <div class="absolute inset-0 p-6 flex flex-col justify-center items-end text-right">
                    <h3 class="font-serif font-bold text-white text-2xl leading-tight shadow-black/50 drop-shadow-md mb-1">Tema</h3>
                    <p class="text-xs font-bold text-[#A8D5BA] uppercase tracking-wider">{{ count($this->allTags) }} Koleksi</p>
                </div>
            </div>
        </div>

    </div>


        <!-- Main Content Wrapper -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-20 pb-20">
            
            <!-- Toolbar -->
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-sm border border-white/50 p-6 mb-8 transform hover:scale-[1.005] transition-all duration-300">
                <div class="flex flex-col md:flex-row gap-6 items-center justify-between">
                    <!-- Left: Search & Filter -->
                    <div class="flex items-center gap-3 flex-1 w-full">
                        <!-- Search -->
                        <div class="relative flex-1 max-w-xl">
                            <input type="text" wire:model.live.debounce.300ms="searchQuery" 
                                   placeholder="Cari kenangan..." 
                                   class="w-full pl-10 pr-4 py-3 rounded-xl border border-[#E5E0D0] focus:ring-2 focus:ring-[#C67C5C] focus:border-transparent bg-white/50 focus:bg-white transition-all shadow-sm">
                            <svg class="w-5 h-5 text-[#6B7C6B] absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>

                        <!-- Filter Toggle -->
                        <button @click="showFilters = !showFilters" 
                                class="px-5 py-3 rounded-xl border-2 border-[#E5E0D0] hover:border-[#C67C5C] hover:text-[#C67C5C] transition-all flex items-center gap-2 bg-white/50 font-bold text-[#6B7C6B] shadow-sm whitespace-nowrap">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            <span>Filter</span>
                        </button>
                    </div>

                    <!-- Right: View Mode & Add Button -->
                    <div class="flex items-center gap-3 w-full md:w-auto justify-end">
                        <!-- View Mode Toggle -->
                        <div class="bg-[#F2EFE5] rounded-xl p-1 flex gap-1">
                            <button wire:click="$set('viewMode', 'grid')" 
                                    class="px-3 py-2 rounded-lg transition-all {{ $viewMode === 'grid' ? 'bg-white shadow text-[#C67C5C]' : 'text-[#6B7C6B] hover:bg-white/50' }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                </svg>
                            </button>
                            <button wire:click="$set('viewMode', 'timeline')" 
                                    class="px-3 py-2 rounded-lg transition-all {{ $viewMode === 'timeline' ? 'bg-white shadow text-[#C67C5C]' : 'text-[#6B7C6B] hover:bg-white/50' }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Add Memory Button -->
                        <button wire:click="toggleUploadForm" 
                                class="bg-gradient-to-r from-[#C67C5C] to-[#D89A7A] text-white font-bold px-6 py-2.5 rounded-xl hover:shadow-lg hover:from-[#B56B4B] hover:to-[#C67C5C] transition-all transform hover:-translate-y-0.5 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span class="hidden sm:inline">Tambah Memori</span>
                        </button>
                    </div>
                </div>

                <!-- Filters Panel (Collapsible) -->
                <div x-show="showFilters" x-collapse class="mt-0">
                    <div class="pt-6 mt-6 border-t border-[#E5E0D0] flex flex-wrap items-center gap-4">
                        <!-- Tag Filter -->
                        <div class="flex-1 min-w-[200px]">
                            <label class="block text-xs font-bold text-[#6B7C6B] uppercase tracking-wider mb-2">Filter Tag</label>
                            <select wire:model.live="filterTag" class="w-full px-4 py-2 rounded-xl border border-[#E5E0D0] focus:ring-2 focus:ring-[#C67C5C] focus:border-transparent bg-white">
                                <option value="">Semua Tag</option>
                                @foreach($this->allTags as $tag)
                                    <option value="{{ $tag }}">{{ ucfirst($tag) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sort By -->
                        <div class="flex-1 min-w-[200px]">
                            <label class="block text-xs font-bold text-[#6B7C6B] uppercase tracking-wider mb-2">Urutkan</label>
                            <select wire:model.live="sortBy" class="w-full px-4 py-2 rounded-xl border border-[#E5E0D0] focus:ring-2 focus:ring-[#C67C5C] focus:border-transparent bg-white">
                                <option value="date_desc">Terbaru</option>
                                <option value="date_asc">Terlama</option>
                                <option value="title">Judul (A-Z)</option>
                            </select>
                        </div>

                        <!-- Clear Filters -->
                        @if($searchQuery || $filterTag)
                            <div class="flex items-end pb-1">
                                <button wire:click="$set('searchQuery', ''); $set('filterTag', '')" 
                                        class="px-4 py-2 text-sm font-bold text-[#C67C5C] hover:text-[#B56B4B] hover:underline transition-colors">
                                    Hapus Filter
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Grid View -->
            @if($viewMode === 'grid')
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($this->filteredMemories as $memory)
                    <div wire:click="selectMemory({{ $memory->id }})" 
                         class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-[1.02] cursor-pointer border border-[#E5E0D0] flex flex-col h-full">
                        <!-- Memory Photo -->
                        <div class="relative h-64 overflow-hidden bg-[#F2EFE5]">
                            <!-- Main Image -->
                            <img src="{{ $memory->image_path }}" 
                                 alt="{{ $memory->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 text-[0px]"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            
                            <!-- Fallback Container (Hidden by default, shown on error) -->
                            <div class="absolute inset-0 hidden items-center justify-center bg-[#F7F5F0] -z-10 group-hover:scale-110 transition-transform duration-700">
                                <svg class="w-16 h-16 text-[#D4CEBC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>

                            <!-- Overlay Gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-60"></div>

                            <!-- Date Badge -->
                            <div class="absolute top-5 left-5 bg-white/95 backdrop-blur-md px-3 py-1.5 rounded-full text-xs font-bold text-[#2A3C2A] shadow-md z-10 transition-transform group-hover:-translate-y-1">
                                {{ \Carbon\Carbon::parse($memory->memory_date)->format('d M Y') }}
                            </div>

                            <!-- Tags -->
                            <div class="absolute bottom-5 left-5 right-5 flex flex-wrap gap-2 z-10">
                                @if($memory->tags)
                                    @foreach(array_slice($memory->tags, 0, 3) as $tag)
                                        <span class="bg-[#4A6741]/90 backdrop-blur-md text-white text-[10px] px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                    @if(count($memory->tags) > 3)
                                        <span class="bg-black/30 backdrop-blur-md text-white text-[10px] px-2 py-1 rounded-full shadow-sm">+{{ count($memory->tags) - 3 }}</span>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <!-- Memory Info -->
                        <div class="p-6 flex-grow flex flex-col">
                            <h3 class="text-xl font-serif font-bold text-[#2A3C2A] mb-3 leading-tight group-hover:text-[#C67C5C] transition-colors">{{ $memory->title }}</h3>
                            <p class="text-[#6B7C6B] text-sm leading-relaxed line-clamp-3">{{ $memory->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Timeline View -->
        @if($viewMode === 'timeline')
            <div class="max-w-4xl mx-auto">
                @foreach($this->filteredMemories as $index => $memory)
                    <div class="relative pl-8 pb-12 {{ $loop->last ? 'pb-0' : '' }}">
                        <!-- Timeline Line -->
                        @if(!$loop->last)
                            <div class="absolute left-[15px] top-8 bottom-0 w-0.5 bg-[#E5E0D0]"></div>
                        @endif

                        <!-- Timeline Dot -->
                        <div class="absolute left-0 top-2 w-8 h-8 bg-gradient-to-br from-[#C67C5C] to-[#D89A7A] rounded-full border-4 border-white shadow-lg flex items-center justify-center">
                            <span class="text-white text-xs font-bold">{{ $index + 1 }}</span>
                        </div>

                        <!-- Memory Card -->
                        <div wire:click="selectMemory({{ $memory->id }})" 
                             class="bg-white rounded-2xl shadow-lg border border-[#E5E0D0] overflow-hidden hover:shadow-2xl transition-all cursor-pointer">
                            <div class="md:flex">
                                <!-- Photo -->
                                <div class="md:w-1/3 h-48 md:h-auto overflow-hidden bg-[#F2EFE5] relative">
                                    <img src="{{ $memory->image_path }}" 
                                         alt="{{ $memory->title }}" 
                                         class="w-full h-full object-cover hover:scale-110 transition-transform duration-500 text-[0px]"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                         
                                    <!-- Fallback Icon if Image Fails -->
                                    <div class="absolute inset-0 hidden items-center justify-center bg-[#F7F5F0]">
                                        <svg class="w-12 h-12 text-[#D4CEBC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="md:w-2/3 p-6">
                                    <div class="flex items-start justify-between mb-3">
                                        <div>
                                            <h3 class="text-2xl font-serif font-bold text-[#2A3C2A] mb-1">{{ $memory->title }}</h3>
                                            <p class="text-sm text-[#6B7C6B]">{{ \Carbon\Carbon::parse($memory->memory_date)->format('F d, Y') }}</p>
                                        </div>
                                    </div>
                                    <p class="text-[#6B7C6B] leading-relaxed mb-4">{{ $memory->description }}</p>
                                    <div class="flex gap-2">
                                        @if($memory->tags)
                                            @foreach($memory->tags as $tag)
                                                <span class="bg-[#E5E0D0] text-[#2A3C2A] text-xs px-3 py-1 rounded-full font-bold">
                                                    {{ $tag }}
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Empty State -->
        @if(count($this->filteredMemories) === 0)
            <div class="text-center py-20">
                <svg class="w-24 h-24 mx-auto text-[#D4CEBC] mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="text-2xl font-serif font-bold text-[#2A3C2A] mb-3">Tidak Ada Kenangan Ditemukan</h3>
                <p class="text-[#6B7C6B] mb-6">Coba sesuaikan filter Anda atau tambahkan kenangan baru</p>
                <button wire:click="$set('searchQuery', ''); $set('filterTag', '')" 
                        class="text-[#C67C5C] font-bold hover:text-[#D89A7A] transition-colors">
                    Hapus Filter
                </button>
            </div>
        @endif
    </div>

    <!-- Upload Form Modal -->
    @if($showUploadForm)
        <div class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full p-8 relative max-h-[90vh] overflow-y-auto">
                <button wire:click="toggleUploadForm" 
                        class="absolute top-4 right-4 w-10 h-10 bg-[#E5E0D0] hover:bg-[#D4CEBC] rounded-full flex items-center justify-center transition-colors">
                    <svg class="w-6 h-6 text-[#2A3C2A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <h2 class="text-3xl font-serif font-bold text-[#2A3C2A] mb-6">Tambah Kenangan Baru</h2>
                
                <form wire:submit.prevent="saveMemory" class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-[#2A3C2A] mb-2">Judul Kenangan</label>
                        <input type="text" wire:model="newMemory.title" 
                               class="w-full px-4 py-3 rounded-xl border border-[#E5E0D0] focus:ring-2 focus:ring-[#4A6741] focus:border-transparent"
                               placeholder="Contoh: Kencan Pertama di Kafe">
                         @error('newMemory.title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#2A3C2A] mb-2">Tanggal</label>
                        <input type="date" wire:model="newMemory.date" 
                               class="w-full px-4 py-3 rounded-xl border border-[#E5E0D0] focus:ring-2 focus:ring-[#4A6741] focus:border-transparent">
                        @error('newMemory.date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#2A3C2A] mb-2">Deskripsi</label>
                        <textarea wire:model="newMemory.description" rows="3"
                                  class="w-full px-4 py-3 rounded-xl border border-[#E5E0D0] focus:ring-2 focus:ring-[#4A6741] focus:border-transparent"
                                  placeholder="Ceritakan kisahnya..."></textarea>
                         @error('newMemory.description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                     <div>
                        <label class="block text-sm font-bold text-[#2A3C2A] mb-2">Tag</label>
                        <input type="text" wire:model="newMemory.tags" 
                               class="w-full px-4 py-3 rounded-xl border border-[#E5E0D0] focus:ring-2 focus:ring-[#4A6741] focus:border-transparent"
                               placeholder="Contoh: kencan, jalan-jalan, anniversary (pisahkan dengan koma)">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#2A3C2A] mb-2">Unggah Foto</label>
                        <div class="border-2 border-dashed border-[#E5E0D0] rounded-xl p-8 text-center hover:border-[#4A6741] transition-colors cursor-pointer relative">
                             <input type="file" wire:model="photo" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <svg class="w-12 h-12 mx-auto text-[#6B7C6B] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-[#6B7C6B] text-sm">
                                @if($photo) 
                                    {{ $photo->getClientOriginalName() }} 
                                @else 
                                    Klik untuk unggah atau seret dan lepas 
                                @endif
                            </p>
                        </div>
                        @error('photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-[#4A6741] to-[#5C7C53] text-white font-bold py-3 rounded-xl hover:opacity-90 transition-opacity">
                            Simpan Kenangan
                        </button>
                        <button type="button" wire:click="toggleUploadForm"
                                class="px-6 bg-[#E5E0D0] text-[#2A3C2A] font-bold py-3 rounded-xl hover:bg-[#D4CEBC] transition-colors">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Lightbox Modal -->
    @if($selectedMemory)
        <div class="fixed inset-0 bg-black/95 z-50 flex items-center justify-center p-4">
            <!-- Close Button -->
            <button wire:click="closeMemory" 
                    class="absolute top-4 right-4 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors backdrop-blur-sm">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Previous Button -->
            <button wire:click="previousMemory" 
                    class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors backdrop-blur-sm">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <!-- Next Button -->
            <button wire:click="nextMemory" 
                    class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors backdrop-blur-sm">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <!-- Content -->
            <div class="max-w-6xl w-full">
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <!-- Photo -->
                    <div class="rounded-2xl overflow-hidden shadow-2xl">
                        <img src="{{ $selectedMemory->image_path }}" 
                             alt="{{ $selectedMemory->title }}" 
                             class="w-full h-auto">
                    </div>

                    <!-- Details -->
                    <div class="text-white">
                        <div class="mb-4">
                            <p class="text-sm text-white/60 mb-2">{{ \Carbon\Carbon::parse($selectedMemory->memory_date)->format('F d, Y') }}</p>
                            <h2 class="text-4xl font-serif font-bold mb-4">{{ $selectedMemory->title }}</h2>
                            <p class="text-lg text-white/90 leading-relaxed mb-6">{{ $selectedMemory->description }}</p>
                        </div>

                        <div class="flex gap-2 mb-6">
                            @if($selectedMemory->tags)
                                @foreach($selectedMemory->tags as $tag)
                                    <span class="bg-white/20 backdrop-blur-sm text-white text-sm px-4 py-2 rounded-full font-bold">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            @endif
                        </div>

                        <div class="text-sm text-white/60">
                            Kenangan {{ $this->filteredMemories->search(fn($m) => $m->id === $selectedMemory->id) + 1 }} dari {{ $this->filteredMemories->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
