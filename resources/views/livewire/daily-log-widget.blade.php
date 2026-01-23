<div class="h-full bg-white rounded-[2rem] border border-[#E5E0D0] p-6 lg:p-8 flex flex-col relative transition-all duration-300 shadow-sm hover:shadow-md">
    <!-- Header -->
    <div class="mb-6">
        <h3 class="text-2xl font-serif font-bold text-[#2A3C2A] mb-1">Kabar Hari Ini</h3>
        <p class="text-sm text-[#8A7A70] font-medium leading-tight">Beri tahu Amora kondisimu agar pasanganmu dapat mendukungmu.</p>
    </div>

    <!-- Main Input Form -->
    <form wire:submit.prevent="save" class="space-y-5 flex-grow flex flex-col">
        <div class="space-y-4">
            <!-- Activity Input -->
            <div>
                <label class="block text-[11px] font-bold text-[#B0A69D] uppercase tracking-wider mb-2 ml-1">Kesibukanmu</label>
                <div class="relative group">
                    <input type="text" wire:model="activity" 
                        class="w-full pl-5 pr-12 py-3.5 bg-[#FDFBF7] border border-[#E5E0D0] rounded-2xl focus:bg-white focus:ring-2 focus:ring-[#4A6741]/20 focus:border-[#4A6741] transition-all text-[#2A3C2A] text-sm font-semibold shadow-sm" 
                        placeholder="Sedang apa sekarang?">
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 text-[#D4CEBC] group-focus-within:text-[#4A6741] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </div>
                </div>
                @error('activity') <span class="text-[10px] text-red-500 font-bold mt-1 ml-2">{{ $message }}</span> @enderror
            </div>

            <!-- Notes -->
            <div>
                <label class="block text-[11px] font-bold text-[#B0A69D] uppercase tracking-wider mb-2 ml-1">Perasaan (Opsional)</label>
                <textarea wire:model="note" 
                    class="w-full px-5 py-3 bg-[#FDFBF7] border border-[#E5E0D0] rounded-2xl focus:bg-white focus:ring-2 focus:ring-[#4A6741]/20 focus:border-[#4A6741] transition-all text-[#2A3C2A] text-sm font-medium resize-none shadow-sm" 
                    rows="2"
                    placeholder="Ceritakan sedikit..."></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <!-- Category -->
                <div>
                    <label class="block text-[11px] font-bold text-[#B0A69D] uppercase tracking-wider mb-2 ml-1 text-center">Kategori</label>
                    <div class="bg-[#FDFBF7] p-1 rounded-2xl border border-[#E5E0D0] flex gap-1 shadow-inner overflow-hidden">
                        <button type="button" 
                            wire:click="setCategory('physical')" 
                            wire:key="cat-physical"
                            class="flex-1 py-3 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-2 relative {{ $category === 'physical' ? 'bg-white text-[#4A6741] shadow-md' : 'text-[#8A7A70] hover:bg-white/50' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            <span>Fisik</span>
                            <div wire:loading wire:target="setCategory('physical')" class="absolute inset-0 bg-white/50 flex items-center justify-center rounded-xl">
                                <div class="w-3 h-3 border-2 border-[#4A6741] border-t-transparent rounded-full animate-spin"></div>
                            </div>
                        </button>
                        <button type="button" 
                            wire:click="setCategory('mental')" 
                            wire:key="cat-mental"
                            class="flex-1 py-3 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-2 relative {{ $category === 'mental' ? 'bg-white text-[#C67C5C] shadow-md' : 'text-[#8A7A70] hover:bg-white/50' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            <span>Mental</span>
                            <div wire:loading wire:target="setCategory('mental')" class="absolute inset-0 bg-white/50 flex items-center justify-center rounded-xl">
                                <div class="w-3 h-3 border-2 border-[#C67C5C] border-t-transparent rounded-full animate-spin"></div>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Intensity Bars -->
                <div>
                    <label class="block text-[11px] font-bold text-[#B0A69D] uppercase tracking-wider mb-2 ml-1 text-center">Beban</label>
                    <div class="bg-[#FDFBF7] h-[50px] px-2 rounded-2xl border border-[#E5E0D0] flex items-center justify-between gap-1 overflow-hidden shadow-inner">
                        @foreach(['low' => 'h-3', 'medium' => 'h-5', 'high' => 'h-7'] as $key => $height)
                            <button type="button" 
                                wire:click="setIntensity('{{ $key }}')" 
                                wire:key="int-{{ $key }}"
                                class="flex-1 h-full flex items-center justify-center transition-all duration-200 group relative">
                                <div class="absolute inset-0 bg-white/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl"></div>
                                <div class="w-3 {{ $height }} rounded-full transition-all duration-300 {{ $intensity === $key ? ($category === 'physical' ? 'bg-[#4A6741] scale-125 shadow-sm' : 'bg-[#C67C5C] scale-125 shadow-sm') : 'bg-[#E5E0D0] group-hover:bg-[#B0A69D]' }}"></div>
                                <div wire:loading wire:target="setIntensity('{{ $key }}')" class="absolute inset-0 flex items-center justify-center">
                                    <div class="w-2 h-2 bg-[#2A3C2A] rounded-full animate-ping"></div>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" 
            class="w-full bg-[#2A3C2A] text-white font-bold py-4 rounded-2xl hover:bg-[#1f2d1f] transition-all transform hover:scale-[1.01] active:scale-[0.99] shadow-md flex items-center justify-center gap-2 mt-2">
            <svg class="w-5 h-5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
            <span class="text-sm tracking-wide">Tambah Kegiatan</span>
        </button>
    </form>

    <!-- History Timeline -->
    <div class="mt-8 border-t border-[#F0EBE0] pt-6 overflow-hidden">
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-[11px] font-bold text-[#B0A69D] uppercase tracking-wider">Aktivitas Hari Ini ({{ $logs->count() }})</h4>
        </div>
        
        <div class="space-y-3 max-h-[160px] overflow-y-auto pr-1 custom-scrollbar">
            @forelse($logs as $log)
                <div class="flex items-center gap-3 group animate-slide-in-right opacity-0" style="animation-fill-mode: forwards; animation-delay: {{ $loop->index * 100 }}ms">
                    <div class="w-8 h-8 rounded-xl {{ $log->category === 'physical' ? 'bg-[#4A6741]/10 text-[#4A6741]' : 'bg-[#C67C5C]/10 text-[#C67C5C]' }} flex items-center justify-center flex-shrink-0">
                        @if($log->category === 'physical')
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        @else
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        @endif
                    </div>
                    <div class="flex-grow min-w-0">
                        <h5 class="font-bold text-[#2A3C2A] text-xs truncate">{{ $log->activity }}</h5>
                        <p class="text-[9px] text-[#B0A69D] font-bold uppercase tracking-tight">{{ $log->intensity }} • {{ $log->created_at->diffForHumans() }}</p>
                    </div>
                    <button wire:click="delete({{ $log->id }})" class="opacity-0 group-hover:opacity-100 p-1.5 text-[#D4CEBC] hover:text-red-500 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>
            @empty
                <div class="text-center py-6 mt-4">
                    <div class="w-10 h-10 bg-[#FDFBF7] border border-[#E5E0D0] rounded-full flex items-center justify-center mx-auto mb-3 opacity-30">
                        <svg class="w-5 h-5 text-[#8A7A70]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-[11px] text-[#B0A69D] font-bold uppercase tracking-widest italic">Belum ada kabar</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Feedback Overlay -->
    @if (session()->has('success'))
        <div class="absolute inset-0 z-50 bg-[#4A6741]/90 backdrop-blur-sm rounded-[2rem] flex flex-col items-center justify-center p-6 text-center animate-fade-in"
             x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)">
            <svg class="w-12 h-12 text-white mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            <h4 class="text-xl font-serif font-bold text-white mb-1">Berhasil!</h4>
            <p class="text-white/80 text-sm font-medium">Sinyal terkirim ke pasangan.</p>
        </div>
    @endif

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 3px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #E5E0D0; border-radius: 10px; }
        .animate-fade-in { animation: fadeIn 0.3s ease-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideInRight { 
            from { opacity: 0; transform: translateX(20px); } 
            to { opacity: 1; transform: translateX(0); } 
        }
        .animate-slide-in-right { animation: slideInRight 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards; }
    </style>
</div>
