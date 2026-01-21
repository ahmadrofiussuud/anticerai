<div class="min-h-screen bg-[#FDFBF7]">
    <!-- New Hero Section -->
    <div class="relative bg-[#FDFBF7] pt-8 pb-16 lg:pt-14 lg:pb-24 overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?q=80&w=2000&auto=format&fit=crop" 
                 alt="Background" 
                 class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-r from-[#FDFBF7]/85 via-[#FDFBF7]/60 to-[#FDFBF7]/30"></div>
        </div>

        <!-- Abstract Background Blobs (Kept for depth) -->
        <div class="absolute top-0 right-0 w-1/2 h-full bg-[#EAB89D]/10 rounded-l-[100px] -z-10"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <!-- Left Content -->
                <div class="text-left space-y-8">
                    <div class="space-y-4">
                        <span class="text-[#C67C5C] font-bold tracking-widest uppercase text-sm">Amora Knowledge Base</span>
                        <h1 class="text-5xl lg:text-7xl font-serif font-bold text-[#4A3427] leading-[1.1]">
                            Grow Together, <br>
                            <span class="text-[#C67C5C] italic">One Step at a Time</span>
                        </h1>
                    </div>
                    
                    <p class="text-[#8A7A70] text-lg leading-relaxed max-w-xl">
                        Explore micro-education tailored to strengthen your unique bond. From communication mastery to intimacy building, discover insights that truly matter.
                    </p>

                    <!-- Buttons -->
                    <div class="flex flex-wrap gap-4 pt-2">
                        <button onclick="document.getElementById('articles-grid').scrollIntoView({behavior: 'smooth'})"
                            class="bg-[#4A6741] hover:bg-[#3A5233] text-white font-bold py-4 px-10 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 text-lg">
                            Start Learning
                        </button>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-8 pt-8 border-t border-[#DCCBC4]/50">
                        <div>
                            <div class="text-3xl font-serif font-bold text-[#4A3427]">50+</div>
                            <div class="text-xs text-[#8A7A70] uppercase font-bold mt-1">Topics</div>
                        </div>
                        <div>
                            <div class="text-3xl font-serif font-bold text-[#4A3427]">10m</div>
                            <div class="text-xs text-[#8A7A70] uppercase font-bold mt-1">Reads</div>
                        </div>
                        <div>
                            <div class="text-3xl font-serif font-bold text-[#4A3427]">Expert</div>
                            <div class="text-xs text-[#8A7A70] uppercase font-bold mt-1">Curated</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content (Visuals) -->
                <div class="relative hidden lg:block h-[500px]">
                    <!-- Main Image Card -->
                    <div class="absolute top-10 right-10 w-80 bg-white p-3 pb-8 rounded-2xl shadow-2xl transform rotate-3 hover:rotate-6 transition-all duration-500 border border-[#EBEBEB]">
                        <div class="h-64 overflow-hidden rounded-xl mb-4 relative">
                            <img src="https://images.unsplash.com/photo-1493863641943-9b68992a8d07?w=600&auto=format&fit=crop" 
                                 alt="Growth" 
                                 class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-700">
                             <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-[#4A6741] shadow-sm">
                                New
                             </div>
                        </div>
                        <h3 class="font-serif font-bold text-[#4A3427] text-xl px-2">Nurturing Growth</h3>
                        <p class="text-xs text-[#8A7A70] px-2 mt-1">Daily relationship insights</p>
                    </div>

                    <!-- Secondary Image Card (Overlapping) -->
                    <div class="absolute bottom-20 left-10 w-64 bg-white p-3 rounded-2xl shadow-xl transform -rotate-6 hover:-rotate-3 transition-all duration-500 border border-[#EBEBEB]">
                         <div class="h-40 overflow-hidden rounded-xl mb-3 relative">
                            <img src="https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?w=600&auto=format&fit=crop" 
                                 alt="Connection" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="flex items-center justify-between px-2">
                            <div>
                                <h4 class="font-bold text-[#4A3427] text-sm">Deep Connection</h4>
                                <div class="flex items-center gap-1 mt-1">
                                    <div class="w-2 h-2 rounded-full bg-[#C67C5C]"></div>
                                    <span class="text-[10px] text-[#8A7A70]">Trending Topic</span>
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-[#FDFBF7] flex items-center justify-center text-[#4A3427]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Side - Article List -->
            <div class="space-y-6">
                @foreach($articles as $article)
                    <div wire:click="selectArticle({{ $article['id'] }})" 
                         class="flex gap-4 p-4 bg-white rounded-2xl shadow-md hover:shadow-xl transition-all cursor-pointer border border-[#E5E0D0] hover:border-[#C67C5C] group">
                        <!-- Article Thumbnail -->
                        <div class="flex-shrink-0">
                            <img src="{{ $article['image'] }}" 
                                 alt="{{ $article['title'] }}" 
                                 class="w-20 h-20 rounded-xl object-cover shadow-sm">
                        </div>
                        
                        <!-- Article Info -->
                        <div class="flex-1">
                            <h3 class="text-[#2A3C2A] font-bold text-base mb-1 group-hover:text-[#C67C5C] transition-colors">
                                {{ $article['title'] }}
                            </h3>
                            <p class="text-[#6B7C6B] text-xs">{{ $article['subtitle'] }}</p>
                        </div>

                        <!-- Arrow Icon -->
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-[#6B7C6B] group-hover:text-[#C67C5C] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Right Side - Article Detail / Placeholder -->
            <div class="lg:sticky lg:top-8 h-fit">
                @if($selectedArticle)
                    <div class="bg-gradient-to-br from-[#C67C5C] to-[#D89A7A] rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
                        <!-- Close Button -->
                        <button wire:click="closeArticle" 
                                class="absolute top-4 right-4 w-8 h-8 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>

                        <!-- Article Image -->
                        <div class="mb-6">
                            <img src="{{ $selectedArticle['image'] }}" 
                                 alt="{{ $selectedArticle['title'] }}" 
                                 class="w-full h-48 rounded-2xl object-cover shadow-lg">
                        </div>

                        <!-- Article Title -->
                        <h2 class="text-2xl font-serif font-bold mb-3">{{ $selectedArticle['title'] }}</h2>
                        
                        <!-- Article Content -->
                        <div class="prose prose-invert">
                            <p class="text-white/90 leading-relaxed">{{ $selectedArticle['content'] }}</p>
                        </div>

                        <!-- Read More Button -->
                        <button class="mt-6 bg-white text-[#C67C5C] font-bold py-3 px-8 rounded-full hover:bg-white/90 transition-colors shadow-lg">
                            Read Full Article
                        </button>
                    </div>
                @else
                    <div class="bg-gradient-to-br from-[#C67C5C] to-[#D89A7A] rounded-3xl p-12 text-white shadow-2xl h-[500px] flex flex-col items-center justify-center text-center">
                        <svg class="w-20 h-20 mb-6 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <h3 class="text-2xl font-serif font-bold mb-3">Select an Article</h3>
                        <p class="text-white/80 max-w-sm">
                            Choose an article from the list to read micro-education content about relationship growth
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
