<div class="h-full bg-white rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 p-8 flex flex-col justify-between relative overflow-hidden group hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all duration-500" wire:poll.5s>
    <!-- Header -->
    <div class="flex justify-between items-start mb-6">
        <div>
            <h3 class="text-2xl font-display font-bold text-slate-800 tracking-tight mb-1">Energy Pulse</h3>
            <p class="text-slate-400 text-sm font-medium">Synced with Partner</p>
        </div>
        <div class="bg-rose-50 p-3 rounded-2xl">
            <svg class="w-6 h-6 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
        </div>
    </div>

    <!-- Partner Status -->
    <div class="flex-grow mb-6">
        @if($partnerStatus)
            <div class="bg-slate-50 rounded-3xl p-6 border border-slate-100 relative overflow-hidden">
                <div class="flex items-center justify-between mb-4">
                     <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Partner Status</span>
                     <span class="text-xs font-bold text-slate-400">{{ $partnerStatus['updated_at'] ?? 'No data' }}</span>
                </div>
                
                <div class="flex items-end space-x-2 mb-4 h-16">
                    @for($i=1; $i<=5; $i++)
                        <div class="flex-1 rounded-t-xl transition-all duration-500 {{ $i <= $partnerStatus['level'] ? 'bg-'.$partnerStatus['color'].'-500 shadow-lg shadow-'.$partnerStatus['color'].'-200' : 'bg-slate-200' }}" style="height: {{ $i * 20 }}%"></div>
                    @endfor
                </div>
                
                <p class="text-slate-700 font-bold text-lg leading-tight">
                    "{{ $partnerStatus['message'] }}"
                </p>
            </div>
        @else
            <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 border-dashed text-center flex flex-col items-center justify-center h-full">
                <div class="w-12 h-12 bg-slate-200 rounded-full flex items-center justify-center mb-3 text-2xl grayscale opacity-50">😴</div>
                <p class="text-slate-400 font-bold text-sm">Waiting for partner...</p>
            </div>
        @endif
    </div>

    <!-- My Update Section -->
    <div>
        <div class="mb-6 px-2">
            <input id="energy-slider" type="range" wire:model.live="energyLevel" min="1" max="5" step="1" 
                class="w-full h-4 bg-slate-100 rounded-full appearance-none cursor-pointer focus:outline-none [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:w-8 [&::-webkit-slider-thumb]:h-8 [&::-webkit-slider-thumb]:bg-slate-900 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:shadow-xl [&::-webkit-slider-thumb]:transition-transform [&::-webkit-slider-thumb]:duration-200 hover:[&::-webkit-slider-thumb]:scale-110">
            <div class="flex justify-between mt-2 text-xs font-bold text-slate-400 px-1">
                <span>Drained</span>
                <span>Energized</span>
            </div>
        </div>

        <div class="flex space-x-2">
            <input wire:model="note" type="text" placeholder="Add a quick note..." 
                class="flex-grow bg-slate-50 border-0 rounded-xl px-4 text-sm font-semibold text-slate-700 placeholder-slate-400 focus:ring-2 focus:ring-rose-200 transition-all">
            <button wire:click="save" class="bg-slate-900 text-white p-3 rounded-xl hover:bg-black hover:scale-105 transition-all shadow-lg flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </button>
        </div>
    </div>
</div>
