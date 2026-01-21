<div class="h-full bg-white rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 p-8 flex flex-col relative overflow-hidden group hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all duration-500">
    <!-- Decorative Circle -->
    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-amber-50 rounded-full z-0 group-hover:scale-150 transition-transform duration-700 ease-in-out"></div>

    <div class="flex justify-between items-center mb-6 z-10">
        <div>
            <h3 class="text-2xl font-display font-bold text-slate-800 tracking-tight mb-1">Flashback</h3>
            <p class="text-slate-400 text-sm font-medium">Memory Lane</p>
        </div>
        <button wire:click="toggleForm" class="bg-amber-100 text-amber-600 hover:bg-amber-200 px-4 py-2 rounded-xl text-xs font-bold transition-colors">
            {{ $showForm ? 'Cancel' : '+ New' }}
        </button>
    </div>

    <div class="flex-grow relative z-10">
        @if($showForm)
            <div class="h-full flex flex-col animate-fade-in-up">
                <input wire:model="title" type="text" placeholder="Title..." class="w-full bg-slate-50 border-0 border-b-2 border-slate-100 focus:border-amber-400 focus:ring-0 px-0 py-2 text-lg font-bold bg-transparent placeholder-slate-300 mb-4 transition-colors">
                
                <textarea wire:model="description" placeholder="Write about this moment..." class="flex-grow w-full bg-slate-50 rounded-2xl border-0 p-4 text-sm resize-none focus:ring-2 focus:ring-amber-200 transition-shadow mb-4 placeholder-slate-400"></textarea>
                
                <button wire:click="save" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 rounded-xl shadow-lg shadow-amber-200 transition-all transform active:scale-95">Save Memory</button>
            </div>
        @else
            @if($randomMemory)
                <div class="relative h-full flex items-center justify-center p-4">
                    <!-- Stack Effect -->
                    <div class="absolute inset-0 bg-white border border-slate-200 shadow-sm rounded-xl rotate-[-4deg] scale-95 opacity-60 z-0"></div>
                    <div class="absolute inset-0 bg-white border border-slate-200 shadow-md rounded-xl rotate-[2deg] scale-98 opacity-80 z-10"></div>
                    
                    <!-- Main Card -->
                    <div class="w-full h-full bg-white border border-slate-100 shadow-2xl rounded-xl p-4 flex flex-col relative z-20 transform transition-transform hover:-translate-y-1">
                        <div class="aspect-video bg-amber-50 rounded-lg mb-4 overflow-hidden relative group/img">
                            @if($randomMemory->image_path)
                                <img src="{{ $randomMemory->image_path }}" class="w-full h-full object-cover grayscale-[20%] group-hover/img:grayscale-0 transition-all duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-amber-200 text-4xl">🎞️</div>
                            @endif
                            <div class="absolute top-2 right-2 bg-black/50 backdrop-blur text-white text-[10px] font-bold px-2 py-1 rounded">
                                {{ $randomMemory->memory_date->format('M d, Y') }}
                            </div>
                        </div>
                        <div class="flex-grow">
                            <h4 class="font-bold text-slate-800 text-lg mb-1 leading-tight">{{ $randomMemory->title }}</h4>
                            <p class="text-slate-500 text-xs leading-relaxed line-clamp-3">{{ $randomMemory->description }}</p>
                        </div>
                        <button wire:click="loadRandomMemory" class="absolute bottom-4 right-4 text-slate-300 hover:text-amber-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </button>
                    </div>
                </div>
            @else
                <div class="h-full flex flex-col items-center justify-center text-center opacity-50">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4 text-2xl">📸</div>
                    <p class="font-bold text-slate-400">No memories yet</p>
                </div>
            @endif
        @endif
    </div>
</div>
