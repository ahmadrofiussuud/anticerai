<div class="min-h-screen bg-cover bg-center bg-fixed relative" style="background-image: url('https://images.unsplash.com/photo-1518621736915-f3b1c41bfd00?q=80&w=2540&auto=format&fit=crop');">
    <div class="min-h-screen bg-[#FDFBF7]/80 backdrop-blur-sm">


    <!-- Hero Section with Gradient -->
    <div class="bg-gradient-to-r from-[#C67C5C] to-[#D89A7A] text-white py-8 shadow-lg">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-serif font-bold mb-2">Invisible Bridge</h1>
            <p class="text-white/90 text-sm">Private Encrypted Chat</p>
        </div>
    </div>

    <!-- Chat Container -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-3xl shadow-xl border border-[#E5E0D0] overflow-hidden relative" style="height: calc(100vh - 280px);">
            <!-- Subtle Interior Pattern -->
            <div class="absolute inset-0 opacity-[0.35] pointer-events-none bg-repeat bg-[length:400px]" 
                 style="background-image: url('https://images.unsplash.com/photo-1574169208507-84376144848b?q=80&w=2079&auto=format&fit=crop');">
            </div>

            <!-- Messages Area -->
            <div class="h-full flex flex-col relative z-10">
                <div class="flex-1 overflow-y-auto p-6 space-y-4">
                    @foreach($messages as $message)
                        @if($message['type'] === 'user')
                            <!-- User Message (Right side, green) -->
                            <div class="flex justify-end">
                                <div class="max-w-md">
                                    <div class="bg-[#4A6741] text-white rounded-2xl rounded-tr-sm px-5 py-3 shadow-md">
                                        <div class="text-xs font-bold mb-1 opacity-80">You</div>
                                        <p class="text-sm leading-relaxed">{{ $message['content'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @elseif($message['type'] === 'amora')
                            <!-- Amora AI Message (Left side, dark green) -->
                            <div class="flex justify-start">
                                <div class="max-w-md">
                                    <div class="bg-[#2C3E2C] text-[#E8E6D9] rounded-2xl rounded-tl-sm px-5 py-3 shadow-md">
                                        <div class="text-xs font-bold mb-1 text-[#B5C4B5]">Amora AI</div>
                                        <div class="text-sm leading-relaxed" 
                                             x-data="{ content: @js($message['content']) }"
                                             x-init="
                                                $el.innerHTML = window.renderMarkdown(content);
                                                if (window.mermaid) {
                                                    setTimeout(() => {
                                                        const nodes = $el.querySelectorAll('.mermaid');
                                                        if (nodes.length > 0) {
                                                            window.mermaid.run({ nodes: nodes });
                                                        }
                                                    }, 100);
                                                }
                                             ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- System Message (Center) -->
                            <div class="flex justify-center">
                                <div class="bg-[#E5E0D0] text-[#2A3C2A] rounded-xl px-4 py-2 text-xs text-center max-w-sm">
                                    {{ $message['content'] }}
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @if($isLoading)
                        <div class="flex justify-start">
                            <div class="bg-[#2C3E2C] text-[#E8E6D9] rounded-2xl rounded-tl-sm px-5 py-3 shadow-md">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-[#B5C4B5] rounded-full animate-bounce"></div>
                                    <div class="w-2 h-2 bg-[#B5C4B5] rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                                    <div class="w-2 h-2 bg-[#B5C4B5] rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- NVC Guide Button -->
                <div class="px-6 py-3 border-t border-[#E5E0D0]">
                    <button class="w-full bg-gradient-to-r from-[#C67C5C] to-[#D89A7A] hover:from-[#B56B4B] hover:to-[#C7896A] text-white font-bold py-3 rounded-xl text-sm shadow-lg transition-all">
                        Read The NVC Communication Guide
                    </button>
                </div>

                <!-- Input Area -->
                <div class="p-4 bg-[#FDFBF7]">
                    <form wire:submit.prevent="sendMessage" class="flex gap-3">
                        <input 
                            type="text" 
                            wire:model="userMessage"
                            placeholder="Type a message..."
                            class="flex-1 bg-gradient-to-r from-[#C67C5C] to-[#D89A7A] text-white placeholder-white/70 border-none rounded-full px-6 py-3 focus:ring-2 focus:ring-[#C67C5C] focus:ring-offset-2 text-sm"
                        >
                        <button 
                            type="submit"
                            class="bg-gradient-to-r from-[#C67C5C] to-[#D89A7A] hover:from-[#B56B4B] hover:to-[#C7896A] text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-all hover:scale-105"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
