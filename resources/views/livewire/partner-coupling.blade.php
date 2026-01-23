<div class="bg-white rounded-3xl p-8 shadow-sm border border-[#E5E0D0] text-center">
    <div class="w-16 h-16 bg-[#FDFBF7] rounded-full flex items-center justify-center mx-auto mb-6">
        <span class="text-3xl">🔗</span>
    </div>
    
    <h2 class="text-2xl font-serif font-bold text-[#2A3C2A] mb-2">Connect with Partner</h2>
    <p class="text-[#2A3C2A]/70 mb-8">Enter your partner's code to unlock shared features.</p>

    <!-- Your Code -->
    <div class="bg-[#FDFBF7] p-4 rounded-xl mb-8 border border-[#E5E0D0]">
        <p class="text-sm text-[#2A3C2A]/60 mb-1 uppercase tracking-wider font-bold">Your Connection Code</p>
        <div class="text-4xl font-mono font-bold text-[#D86C58] tracking-widest select-all">
            {{ auth()->user()->pairing_code ?? 'Generating...' }}
        </div>
    </div>

    <!-- Partner Code Input -->
    <form wire:submit.prevent="connect">
        <div class="mb-6 text-left">
            <label class="block text-sm font-bold text-[#2A3C2A] mb-2">Enter Partner's Code</label>
            <input type="text" 
                   wire:model="partnerCode"
                   class="w-full px-4 py-3 rounded-xl border border-[#D4CEBC] focus:border-[#4A6741] focus:ring-2 focus:ring-[#4A6741]/20 outline-none text-[#2A3C2A] placeholder-[#2A3C2A]/30 text-center font-mono text-xl uppercase"
                   placeholder="XXXXXX"
                   maxlength="6">
            @error('partnerCode') <span class="text-[#D86C58] text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <button type="submit" 
                class="w-full py-4 bg-[#2C3E2C] hover:bg-[#1E2923] text-white rounded-xl font-bold transition-all transform hover:scale-[1.02] active:scale-[0.98]">
            Connect Accounts
        </button>
    </form>
</div>
