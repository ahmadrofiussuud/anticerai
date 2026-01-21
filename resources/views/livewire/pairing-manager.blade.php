<div class="max-w-4xl mx-auto p-6">
    <div class="bg-gradient-to-br from-[#E5E0D0] to-[#FDFBF7] overflow-hidden shadow-2xl sm:rounded-3xl border border-[#D4CEBC]">
        <div class="p-8">
            <h2 class="text-4xl font-serif font-bold text-[#2A3C2A] mb-2">Connect with your Partner</h2>
            <p class="text-[#6B7C6B] mb-8 text-lg">Start your journey of growth together. Pair your accounts to access shared features.</p>

            <div class="grid md:grid-cols-2 gap-8 relative">
                <!-- Divider -->
                <div class="hidden md:block absolute inset-y-0 left-1/2 w-0.5 bg-[#D4CEBC] -ml-0.5"></div>

                <!-- Generate Code Section -->
                <div class="bg-white p-6 rounded-2xl border-2 border-[#C67C5C] shadow-lg">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-3xl">🔑</span>
                        <h3 class="text-2xl font-serif font-bold text-[#2A3C2A]">Generate Code</h3>
                    </div>
                    <p class="text-sm text-[#6B7C6B] mb-6">Create a unique code and share it with your partner.</p>

                    @if($pairingCode)
                        <div class="text-center mb-6">
                            <div class="text-xs uppercase tracking-wider text-[#C67C5C] font-bold mb-2">Your Pairing Code</div>
                            <div class="relative">
                                <div class="text-5xl font-mono font-bold text-[#2A3C2A] tracking-widest bg-[#FDFBF7] py-4 px-6 rounded-xl border-4 border-[#C67C5C] inline-block select-all">
                                    {{ $pairingCode }}
                                </div>
                                <button onclick="navigator.clipboard.writeText('{{ $pairingCode }}')" class="absolute -top-2 -right-2 bg-[#C67C5C] text-white p-2 rounded-full shadow-lg hover:bg-[#D89A7A] transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                </button>
                            </div>
                            <p class="text-xs text-[#6B7C6B] mt-3">Code expires in 24 hours</p>
                            <button wire:click="cancelPairingCode" class="mt-4 text-sm text-[#C67C5C] hover:text-[#D89A7A] font-bold">
                                Cancel Code
                            </button>
                        </div>
                    @else
                        <button wire:click="generatePairingCode" wire:loading.attr="disabled" 
                            class="w-full py-4 px-6 bg-gradient-to-r from-[#C67C5C] to-[#D89A7A] hover:from-[#D89A7A] hover:to-[#C67C5C] text-white font-bold rounded-xl shadow-lg transform transition hover:scale-105 focus:outline-none focus:ring-4 focus:ring-[#C67C5C]/50">
                            <span wire:loading.remove>Generate Pairing Code</span>
                            <span wire:loading>Generating...</span>
                        </button>
                    @endif

                    @if(session('success'))
                        <div class="mt-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>

                <!-- Enter Code Section -->
                <div class="bg-white p-6 rounded-2xl border-2 border-[#4A6741] shadow-lg">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-3xl">🔗</span>
                        <h3 class="text-2xl font-serif font-bold text-[#2A3C2A]">Enter Code</h3>
                    </div>
                    <p class="text-sm text-[#6B7C6B] mb-6">Have a code from your partner? Enter it here to connect.</p>

                    <div class="space-y-4">
                        <div>
                            <label for="code" class="sr-only">Pairing Code</label>
                            <input wire:model="partnerCode" type="text" id="code" placeholder="ABCD12" 
                                class="block w-full text-center text-3xl font-mono uppercase tracking-widest border-2 border-[#4A6741] rounded-xl focus:border-[#5C7C53] focus:ring-4 focus:ring-[#4A6741]/20 shadow-sm py-4"
                                maxlength="6">
                            @error('partnerCode') 
                                <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span> 
                            @enderror
                        </div>

                        <button wire:click="connectWithCode" wire:loading.attr="disabled" 
                            class="w-full py-4 px-6 bg-gradient-to-r from-[#4A6741] to-[#5C7C53] hover:from-[#5C7C53] hover:to-[#4A6741] text-white font-bold rounded-xl shadow-lg transform transition hover:scale-105 focus:outline-none focus:ring-4 focus:ring-[#4A6741]/50">
                            <span wire:loading.remove>Connect with Partner</span>
                            <span wire:loading>Connecting...</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="mt-8 p-6 bg-[#FDFBF7] rounded-xl border border-[#D4CEBC]">
                <h4 class="font-bold text-[#2A3C2A] mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#C67C5C]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    How it works
                </h4>
                <ol class="text-sm text-[#6B7C6B] space-y-2 list-decimal list-inside">
                    <li>One partner generates a pairing code</li>
                    <li>Share the code with your partner (via WhatsApp, SMS, etc.)</li>
                    <li>Your partner enters the code on their account</li>
                    <li>Both accounts are now connected and can access shared features!</li>
                </ol>
            </div>
        </div>
    </div>
</div>
