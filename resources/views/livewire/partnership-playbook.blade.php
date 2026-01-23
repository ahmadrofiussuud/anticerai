<div class="h-full bg-[#FDFBF7] rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E5E0D0] p-8 flex flex-col relative overflow-hidden group text-[#2A3C2A] transition-all duration-500 hover:shadow-[0_20px_40px_rgb(0,0,0,0.1)] hover:-translate-y-1">
    <!-- Natural Background Elements -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-[#E8F5E9] rounded-full blur-[60px] opacity-40 pointer-events-none -mr-16 -mt-16"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-[#FFF3E0] rounded-full blur-[60px] opacity-40 pointer-events-none -ml-16 -mb-16"></div>

    <!-- Header -->
    <div class="flex justify-between items-start mb-8 relative z-10">
        <div>
            <h3 class="text-3xl font-serif font-bold tracking-tight mb-2 text-[#2A3C2A]">Hikmah Harian</h3>
            <p class="text-[#6B7C6B] text-sm font-medium tracking-wide uppercase">Dipilih untukmu</p>
        </div>
        <button wire:click="toggleSave" class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 {{ $isSaved ? 'bg-[#D86C58] text-white shadow-lg shadow-[#D86C58]/30' : 'bg-[#E5E0D0] text-[#6B7C6B] hover:bg-[#D4CEBC]' }}">
            <svg class="w-5 h-5 {{ $isSaved ? 'fill-current' : '' }}" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
        </button>
    </div>

    @if($insight)
        <div class="flex-grow flex flex-col relative z-10">
            <span class="inline-block py-1.5 px-4 rounded-full text-[10px] font-bold uppercase tracking-widest mb-6 w-fit border {{ $insight->trigger_context === 'low_energy' ? 'bg-[#D86C58]/10 text-[#D86C58] border-[#D86C58]/20' : 'bg-[#4A6741]/10 text-[#4A6741] border-[#4A6741]/20' }}">
                {{ $insight->trigger_context === 'low_energy' ? 'Istirahat & Pemulihan' : 'Pemicu Semangat' }}
            </span>

            <h4 class="text-3xl font-serif font-medium leading-tight mb-4 text-[#1E2923]">{{ $insight->title }}</h4>
            <p class="text-[#5C6B5C] text-base leading-relaxed mb-8 font-medium">{{ $insight->brief_text }}</p>

            @if($insight->type === 'audio')
                <div class="bg-white/60 backdrop-blur-md rounded-2xl p-4 flex items-center gap-4 border border-[#E5E0D0] hover:bg-white/80 transition-colors cursor-pointer group/audio shadow-sm">
                    <div class="w-12 h-12 bg-[#D86C58] rounded-full flex items-center justify-center shadow-lg group-hover/audio:scale-110 transition-transform text-white">
                        <svg class="w-5 h-5 ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                    <div class="flex-grow">
                        <div class="text-xs font-bold text-[#2A3C2A] mb-1 uppercase tracking-wider">Putar Audio</div>
                        <div class="h-1 bg-[#E5E0D0] rounded-full w-full overflow-hidden">
                            <div class="h-full bg-[#D86C58] w-1/3 rounded-full"></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @else
        <div class="flex-grow flex items-center justify-center">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#2A3C2A]/30"></div>
        </div>
    @endif


    <!-- Amora AI Section (Refined) -->
    <div class="mt-auto relative z-20 pt-8">
        <!-- Main Container -->
        <div class="bg-[#1E2923] rounded-[1.5rem] p-1 shadow-xl overflow-hidden">
            <!-- Top Controls -->
            <div class="flex bg-[#2C3E2C] rounded-[1.2rem] p-1 relative z-10">
                <button wire:click="setAmoraMode('INTERPRETER')" 
                    class="flex-1 py-3 rounded-xl text-xs font-bold tracking-widest uppercase transition-all duration-300 flex items-center justify-center gap-2 {{ $amoraMode === 'INTERPRETER' ? 'bg-[#FDFBF7] text-[#1E2923] shadow-md' : 'text-[#8F9E8F] hover:text-[#E8E6D9] hover:bg-[#1E2923]' }}">
                    <span>👁️</span> Penerjemah
                </button>
                <button wire:click="setAmoraMode('SPARK')" 
                    class="flex-1 py-3 rounded-xl text-xs font-bold tracking-widest uppercase transition-all duration-300 flex items-center justify-center gap-2 {{ $amoraMode === 'SPARK' ? 'bg-[#D86C58] text-white shadow-md' : 'text-[#8F9E8F] hover:text-[#E8E6D9] hover:bg-[#1E2923]' }}">
                    <span>✨</span> Ide
                </button>
            </div>

            <!-- Content Area -->
            <div class="p-5 text-[#E8E6D9]">
                @if($amoraMode)
                    <div class="relative transition-all duration-500 min-h-[140px] flex flex-col justify-center">
                        @if(!$amoraResponse && !$isLoading)
                            @if($amoraMode === 'INTERPRETER')
                                <div class="space-y-3">
                                    <textarea wire:model="userComplaint" class="w-full bg-[#2C3E2C]/50 rounded-xl border-none text-sm text-[#E8E6D9] placeholder-[#5C6B5C] focus:ring-1 focus:ring-[#8F9E8F] resize-none h-16 p-3" placeholder="Analisis situasi..."></textarea>
                                    <button wire:click="askAmora" class="w-full bg-[#4A6741] hover:bg-[#5C7C53] text-white font-bold py-3 rounded-xl text-xs uppercase tracking-wider transition-all shadow-lg flex items-center justify-center gap-2">
                                        Analisis <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </button>
                                </div>
                            @elseif($amoraMode === 'SPARK')
                                <div class="text-center">
                                    <p class="text-sm text-[#8F9E8F] mb-4 font-medium italic">"Small gestures build big bridges."</p>
                                    <button wire:click="askAmora" class="w-full bg-[#D86C58] hover:bg-[#E57D6B] text-white font-bold py-3 rounded-xl text-xs uppercase tracking-wider shadow-lg flex items-center justify-center gap-2 transition-all hover:scale-[1.02]">
                                        Cari Ide <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                    </button>
                                </div>
                            @endif
                        @elseif($isLoading)
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <div class="w-8 h-8 border-2 border-[#4A6741] border-t-[#E5E0D0] rounded-full animate-spin"></div>
                                <p class="text-[10px] font-bold text-[#8F9E8F] uppercase tracking-widest animate-pulse">Berkonsultasi...</p>
                            </div>
                        @elseif($amoraResponse)
                            @if($amoraMode === 'INTERPRETER')
                                <div class="animate-fadeIn">
                                    <div class="flex items-center gap-2 mb-3">
                                         <span class="w-2 h-2 rounded-full {{ strtolower($amoraResponse['risk_level'] ?? '') === 'high' ? 'bg-red-500' : (strtolower($amoraResponse['risk_level'] ?? '') === 'medium' ? 'bg-amber-500' : 'bg-green-500') }}"></span>
                                         <span class="text-[10px] font-bold uppercase tracking-wider text-[#8F9E8F]">Risiko: {{ $amoraResponse['risk_level'] ?? 'Low' }}</span>
                                    </div>
                                    <p class="text-[#E8E6D9] text-sm leading-relaxed font-serif italic mb-4">"{{ $amoraResponse['analysis'] ?? '...' }}"</p>
                                    <div class="bg-[#2C3E2C] p-3 rounded-lg border-l-2 border-[#4A6741]">
                                        <p class="text-xs font-bold text-[#E8E6D9]">{{ $amoraResponse['suggestion'] ?? '...' }}</p>
                                    </div>
                                    <button wire:click="setAmoraMode('INTERPRETER')" class="mt-4 text-[10px] font-bold text-[#5C6B5C] hover:text-[#E8E6D9] uppercase tracking-widest flex items-center gap-1 mx-auto">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> Reset
                                    </button>
                                </div>
                            @elseif($amoraMode === 'SPARK')
                                <div class="text-center animate-fadeIn">
                                    <div class="inline-block p-2 bg-[#2C3E2C] rounded-lg mb-3 shadow-lg">
                                        <span class="text-2xl">
                                            @switch(strtolower($amoraResponse['icon'] ?? ''))
                                                @case('coffee') ☕ @break
                                                @case('gift') 🎁 @break
                                                @case('hug') 🤗 @break
                                                @case('chat') 💬 @break
                                                @case('date') 🎬 @break
                                                @default ✨
                                            @endswitch
                                        </span>
                                    </div>
                                    <h5 class="font-serif font-bold text-lg text-[#FDFBF7] mb-2">{{ $amoraResponse['spark_title'] ?? 'Daily Spark' }}</h5>
                                    <p class="text-[#8F9E8F] text-sm mb-4">{{ $amoraResponse['spark_text'] ?? '...' }}</p>
                                    <button wire:click="askAmora" class="text-[10px] font-bold text-[#5C6B5C] hover:text-[#E8E6D9] uppercase tracking-widest flex items-center justify-center gap-1 mx-auto">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> Ide Baru
                                    </button>
                                </div>
                            @endif
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
