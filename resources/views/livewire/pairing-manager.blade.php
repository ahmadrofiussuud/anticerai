<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-primary-400">
        <div class="p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Connect with your Partner</h2>
            <p class="text-gray-600 mb-8">Start your journey of growth together. Pair your accounts to access shared features.</p>

            <div class="grid md:grid-cols-2 gap-8 relative">
                <!-- Divider -->
                <div class="hidden md:block absolute inset-y-0 left-1/2 w-0.5 bg-gray-100 -ml-0.5"></div>

                <!-- Generate Code Section -->
                <div class="bg-primary-50 p-6 rounded-2xl border border-primary-100">
                    <h3 class="text-xl font-semibold text-primary-800 mb-4">I need a code</h3>
                    <p class="text-sm text-primary-600 mb-6">Generate a unique code and share it with your partner.</p>

                    @if($generatedCode)
                        <div class="text-center mb-6">
                            <div class="text-xs text-uppercase tracking-wider text-primary-500 font-bold mb-1">Your Pairing Code</div>
                            <div class="text-4xl font-mono font-bold text-primary-600 tracking-widest bg-white py-3 px-4 rounded-lg border-2 border-primary-200 inline-block select-all">
                                {{ $generatedCode }}
                            </div>
                            <p class="text-xs text-primary-500 mt-2">Waiting for partner to connect...</p>
                        </div>
                    @elseif(auth()->user()->couple_id && auth()->user()->couple->pairing_code && !auth()->user()->couple->wife_id) 
                        <!-- Reshow code if already generated but not paired fully (simple check) -->
                         <div class="text-center mb-6">
                            <div class="text-xs text-uppercase tracking-wider text-primary-500 font-bold mb-1">Your Pairing Code</div>
                            <div class="text-4xl font-mono font-bold text-primary-600 tracking-widest bg-white py-3 px-4 rounded-lg border-2 border-primary-200 inline-block select-all">
                                {{ auth()->user()->couple->pairing_code }}
                            </div>
                         </div>
                    @else
                        <button wire:click="generate" wire:loading.attr="disabled" class="w-full py-3 px-4 bg-primary-500 hover:bg-primary-600 text-white font-bold rounded-xl shadow-lg transform transition hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                            Generate Code
                        </button>
                    @endif

                    @error('generate') 
                        <span class="text-secondary-600 text-sm mt-2 block">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Enter Code Section -->
                <div class="bg-stone-50 p-6 rounded-2xl border border-stone-100">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">I have a code</h3>
                    <p class="text-sm text-gray-500 mb-6">Enter the code displayed on your partner's screen.</p>

                    <div class="space-y-4">
                        <div>
                            <label for="code" class="sr-only">Pairing Code</label>
                            <input wire:model="pairingCode" type="text" id="code" placeholder="ENTER CODE" 
                                class="block w-full text-center text-2xl font-mono uppercase tracking-widest border-gray-300 rounded-xl focus:border-primary-500 focus:ring-primary-500 shadow-sm py-3"
                                maxlength="6">
                            @error('pairingCode') <span class="text-secondary-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <button wire:click="connect" wire:loading.attr="disabled" class="w-full py-3 px-4 bg-white hover:bg-gray-50 text-gray-700 font-bold rounded-xl border-2 border-gray-200 shadow-sm transform transition hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">
                            Connect Partner
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
