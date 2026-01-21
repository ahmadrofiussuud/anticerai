<div>
    <div class="bg-white rounded-[2rem] shadow-xl shadow-[#E5E0D0]/50 border border-[#E5E0D0] p-6 h-full flex flex-col relative overflow-hidden group">
        <!-- Background decoration -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[#4A6741]/5 to-[#5C7C53]/5 rounded-bl-full -mr-8 -mt-8 pointer-events-none"></div>

        <!-- Header -->
        <div class="relative z-10 flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-[#FDFBF7] border border-[#E5E0D0] rounded-2xl flex items-center justify-center shadow-sm">
                    <span class="text-xl">📝</span>
                </div>
                <div>
                    <h3 class="text-2xl font-serif font-bold text-[#2A3C2A]">Daily Log</h3>
                    <p class="text-xs font-medium text-[#6B7C6B] tracking-wide uppercase">Wellness Tracker</p>
                </div>
            </div>
            <!-- Current Count Badge -->
            <div class="bg-[#FDFBF7] border border-[#E5E0D0] px-3 py-1 rounded-full text-xs font-bold text-[#2A3C2A]">
                {{ $logs->count() }} Entries
            </div>
        </div>

        <!-- Input Form -->
        <form wire:submit.prevent="save" class="relative z-10 space-y-5 mb-auto">
            <!-- Main Input -->
            <div class="relative">
                <input type="text" wire:model="activity" 
                    class="w-full pl-4 pr-12 py-4 bg-[#FDFBF7] border-2 border-[#E5E0D0] rounded-2xl focus:border-[#4A6741] focus:ring-0 text-[#2A3C2A] placeholder-[#6B7C6B]/50 transition-all font-medium" 
                    placeholder="What did you do today?">
                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-[#D4CEBC]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                </div>
            </div>
            @error('activity') <span class="text-xs text-red-500 font-bold ml-1 block mt-1">{{ $message }}</span> @enderror

            <!-- Controls Grid -->
            <div class="grid grid-cols-2 gap-4">
                <!-- Category Toggle -->
                <div class="bg-[#FDFBF7] p-1.5 rounded-2xl border border-[#E5E0D0] flex">
                    <button type="button" wire:click="setCategory('physical')" 
                        class="flex-1 py-2 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2 {{ $category === 'physical' ? 'bg-[#4A6741] text-white shadow-md transform scale-[1.02]' : 'text-[#6B7C6B] hover:text-[#2A3C2A]' }}">
                        <span>💪</span> Phy
                    </button>
                    <button type="button" wire:click="setCategory('mental')" 
                        class="flex-1 py-2 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2 {{ $category === 'mental' ? 'bg-[#C67C5C] text-white shadow-md transform scale-[1.02]' : 'text-[#6B7C6B] hover:text-[#2A3C2A]' }}">
                        <span>🧠</span> Men
                    </button>
                </div>

                <!-- Intensity Toggle -->
                <div class="bg-[#FDFBF7] p-1.5 rounded-2xl border border-[#E5E0D0] flex items-center justify-between px-3">
                    <span class="text-xs font-bold text-[#6B7C6B] uppercase">Intensity</span>
                    <div class="flex gap-1" x-data="{ level: '{{ $intensity }}' }">
                        <button type="button" wire:click="setIntensity('low')" class="w-2 h-6 rounded-full transition-all duration-300 {{ $intensity === 'low' ? 'bg-[#4A6741] scale-110' : ($intensity === 'medium' || $intensity === 'high' ? 'bg-[#4A6741]/40' : 'bg-[#E5E0D0]') }} hover:bg-[#4A6741]/60"></button>
                        <button type="button" wire:click="setIntensity('medium')" class="w-2 h-8 rounded-full transition-all duration-300 {{ $intensity === 'medium' ? 'bg-[#C67C5C] scale-110' : ($intensity === 'high' ? 'bg-[#C67C5C]/40' : 'bg-[#E5E0D0]') }} hover:bg-[#C67C5C]/60"></button>
                        <button type="button" wire:click="setIntensity('high')" class="w-2 h-10 rounded-full transition-all duration-300 {{ $intensity === 'high' ? 'bg-[#D89A7A] scale-110' : 'bg-[#E5E0D0]' }} hover:bg-[#D89A7A]/60"></button>
                    </div>
                </div>
            </div>

            <button type="submit" 
                class="w-full bg-[#2A3C2A] text-white font-serif font-bold py-3 rounded-2xl hover:bg-[#1a261a] transition-all transform hover:scale-[1.01] shadow-lg hover:shadow-xl flex items-center justify-center gap-3">
                <span>Add Entry</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            </button>
        </form>

        <!-- Success Toast -->
        @if (session()->has('success'))
            <div class="absolute top-20 left-6 right-6 z-20 bg-[#4A6741] text-white px-4 py-3 rounded-xl shadow-lg flex items-center gap-3 animate-fade-in-down"
                 x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="text-sm font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Recent Logs (Mini Timeline) -->
        <div class="mt-8 border-t border-[#E5E0D0] pt-6 relative z-10">
            <h4 class="text-xs font-bold text-[#6B7C6B] uppercase mb-4 tracking-wider">Today's Timeline</h4>
            
            <div class="space-y-4 max-h-[160px] overflow-y-auto pr-2 custom-scrollbar">
                @forelse($logs as $log)
                    <div class="group relative pl-4 border-l-2 {{ $log->category === 'physical' ? 'border-[#4A6741]/20' : 'border-[#C67C5C]/20' }} hover:border-[#2A3C2A] transition-colors">
                        <!-- Dot -->
                        <div class="absolute -left-[5px] top-1.5 w-2 h-2 rounded-full {{ $log->category === 'physical' ? 'bg-[#4A6741]' : 'bg-[#C67C5C]' }}"></div>
                        
                        <div class="flex items-start justify-between">
                            <div>
                                <h5 class="font-bold text-[#2A3C2A] text-sm leading-tight">{{ $log->activity }}</h5>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-[10px] bg-[#FDFBF7] border border-[#E5E0D0] px-1.5 py-0.5 rounded text-[#6B7C6B] uppercase tracking-wide">{{ $log->intensity }}</span>
                                    <span class="text-[10px] text-[#D4CEBC]">{{ $log->created_at->format('g:i A') }}</span>
                                </div>
                            </div>
                            
                            <button wire:click="delete({{ $log->id }})" class="w-6 h-6 flex items-center justify-center text-[#D4CEBC] hover:text-red-500 hover:bg-red-50 rounded-lg transition-all opacity-0 group-hover:opacity-100">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6">
                        <div class="w-12 h-12 bg-[#FDFBF7] rounded-full flex items-center justify-center mx-auto mb-3 text-2xl opacity-50">✨</div>
                        <p class="text-sm text-[#6B7C6B]">No activities logged yet.</p>
                        <p class="text-xs text-[#D4CEBC] mt-1">Start tracking your journey!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #E5E0D0; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #C67C5C; }
    </style>
</div>
