<div class="h-full bg-white rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E5E0D0] p-8 flex flex-col justify-between relative overflow-hidden group hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all duration-500" wire:poll.5s>
    <!-- Background element -->
    <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-[#C67C5C]/10 to-[#D89A7A]/10 rounded-full blur-2xl pointer-events-none"></div>

    <!-- Header -->
    <div class="flex justify-between items-start mb-6 relative z-10">
        <div>
            <h3 class="text-2xl font-serif font-bold text-[#2A3C2A] tracking-tight mb-1">Denyut Energi</h3>
            <p class="text-[#8A7A70] text-sm font-medium">Tersinkron dengan Pasangan</p>
        </div>
        <div class="bg-[#C67C5C]/10 p-3 rounded-2xl">
            <svg class="w-6 h-6 text-[#C67C5C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
        </div>
    </div>

    <!-- Partner Status -->
    <div class="flex-grow mb-6 relative z-10">
        @if($partnerStatus)
            <div class="bg-[#FDFBF7] rounded-3xl p-6 border border-[#E5E0D0] relative overflow-hidden">
                <div class="flex items-center justify-between mb-4">
                     <span class="text-xs font-bold uppercase tracking-wider text-[#8A7A70]">Status Pasangan</span>
                     <span class="text-xs font-bold text-[#8A7A70]">{{ $partnerStatus['updated_at'] ?? 'No data' }}</span>
                </div>
                
                <div class="flex items-end space-x-2 mb-4 h-16">
                    @for($i=1; $i<=5; $i++)
                        <div class="flex-1 rounded-t-xl transition-all duration-500 {{ $i <= $partnerStatus['level'] ? 'bg-[#C67C5C] shadow-lg shadow-[#C67C5C]/20 animate-breathing' : 'bg-[#E5E0D0]' }}" style="height: {{ $i * 20 }}%; animation-delay: {{ $i * 150 }}ms"></div>
                    @endfor
                </div>
                
                <p class="text-[#2A3C2A] font-bold text-lg leading-tight font-serif mb-4">
                    "{{ $partnerStatus['message'] }}"
                </p>

                @if(isset($partnerStatus['ai_advice']) && $partnerStatus['ai_advice'])
                    <div class="mt-4 p-4 bg-[#C67C5C]/5 rounded-2xl border border-[#C67C5C]/20">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-4 h-4 text-[#C67C5C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-xs font-bold text-[#C67C5C] uppercase tracking-wider">Saran Amora</span>
                        </div>
                        <h5 class="text-sm font-bold text-[#2A3C2A] mb-1">{{ $partnerStatus['ai_advice']['advice_title'] }}</h5>
                        <p class="text-xs text-[#8A7A70] leading-relaxed">
                            {{ $partnerStatus['ai_advice']['advice_detail'] }}
                        </p>
                        <div class="mt-2 text-[10px] font-bold text-[#C67C5C]/60 uppercase tracking-widest">
                            Tingkat Upaya: {{ $partnerStatus['ai_advice']['effort_level'] }}
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div class="bg-[#FDFBF7] rounded-3xl p-8 border border-[#E5E0D0] border-dashed text-center flex flex-col items-center justify-center h-full">
                <div class="w-12 h-12 bg-[#FDFBF7] border border-[#E5E0D0] rounded-full flex items-center justify-center mb-3 text-[#B0A69D] opacity-40 shadow-inner">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-[#8A7A70] font-bold text-sm">Menunggu update...</p>
            </div>
        @endif
    </div>

    <!-- My Update Section -->
    <div class="relative z-10">
        <div class="mb-6 px-2">
            <input id="energy-slider" type="range" wire:model.live="energyLevel" min="1" max="5" step="1" 
                class="w-full h-4 bg-[#E5E0D0] rounded-full appearance-none cursor-pointer focus:outline-none [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:w-8 [&::-webkit-slider-thumb]:h-8 [&::-webkit-slider-thumb]:bg-[#2A3C2A] [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:shadow-xl [&::-webkit-slider-thumb]:transition-transform [&::-webkit-slider-thumb]:duration-200 hover:[&::-webkit-slider-thumb]:scale-110">
            <div class="flex justify-between mt-2 text-xs font-bold text-[#8A7A70] px-1">
                <span>Lelah</span>
                <span>Berenergi</span>
            </div>
        </div>

        <div class="flex space-x-2">
            <input wire:model="note" type="text" placeholder="Tulis catatan singkat..." 
                class="flex-grow bg-[#FDFBF7] border-0 rounded-xl px-4 text-sm font-semibold text-[#2A3C2A] placeholder-[#8A7A70] focus:ring-2 focus:ring-[#C67C5C]/30 transition-all">
            <button wire:click="save" class="bg-[#2A3C2A] text-white p-3 rounded-xl hover:bg-[#1a261a] hover:scale-105 transition-all shadow-lg flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </button>
        </div>
    </div>
</div>
