<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    // Logout logic moved to standard POST route 'logout'
}; ?>

<nav x-data="{ open: false }" class="bg-[#2C3E2C] border-b border-[#3A4A3A] shadow-sm relative z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo (Left) -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-2">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <img src="{{ asset('images/logo_transparent.png') }}" alt="Amora Logo" class="w-full h-full object-contain">
                    </div>
                    <span class="text-xl font-serif font-bold text-[#FDFBF7]">Amora</span>
                </a>
            </div>

            <!-- Navigation Links (Center) -->
            <div class="hidden sm:flex absolute left-1/2 transform -translate-x-1/2 space-x-1">
                <a href="{{ route('home') }}" wire:navigate class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('home') ? 'text-[#FDFBF7] bg-[#3A4A3A]' : 'text-[#B5C4B5] hover:text-[#FDFBF7] hover:bg-[#3A4A3A]/50' }}">
                    Home
                </a>
                <a href="{{ route('nostalgia') }}" wire:navigate class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('nostalgia') ? 'text-[#FDFBF7] bg-[#3A4A3A]' : 'text-[#B5C4B5] hover:text-[#FDFBF7] hover:bg-[#3A4A3A]/50' }}">
                    Nostalgia
                </a>
                <a href="{{ route('bridge') }}" wire:navigate class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('bridge') ? 'text-[#FDFBF7] bg-[#3A4A3A]' : 'text-[#B5C4B5] hover:text-[#FDFBF7] hover:bg-[#3A4A3A]/50' }}">
                    Bridge
                </a>
                <a href="{{ route('date-roulette') }}" wire:navigate class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('date-roulette') ? 'text-[#FDFBF7] bg-[#3A4A3A]' : 'text-[#B5C4B5] hover:text-[#FDFBF7] hover:bg-[#3A4A3A]/50' }}">
                    Date Roulette
                </a>
                <a href="{{ route('growth-space') }}" wire:navigate class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('growth-space') ? 'text-[#FDFBF7] bg-[#3A4A3A]' : 'text-[#B5C4B5] hover:text-[#FDFBF7] hover:bg-[#3A4A3A]/50' }}">
                    Growth Space
                </a>
            </div>

            <!-- Settings Dropdown (Right) -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-[#3A4A3A] text-sm leading-4 font-medium rounded-lg text-[#FDFBF7] bg-[#3A4A3A]/50 hover:bg-[#3A4A3A] focus:outline-none transition ease-in-out duration-150">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#B5C4B5] hover:text-[#FDFBF7] hover:bg-[#3A4A3A] focus:outline-none focus:bg-[#3A4A3A] focus:text-[#FDFBF7] transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" wire:navigate class="block px-4 py-2 text-base font-medium {{ request()->routeIs('home') ? 'text-[#FDFBF7] bg-[#3A4A3A]' : 'text-[#B5C4B5] hover:text-[#FDFBF7] hover:bg-[#3A4A3A]/50' }} transition-colors">
                Home
            </a>
            <a href="{{ route('nostalgia') }}" wire:navigate class="block px-4 py-2 text-base font-medium {{ request()->routeIs('nostalgia') ? 'text-[#FDFBF7] bg-[#3A4A3A]' : 'text-[#B5C4B5] hover:text-[#FDFBF7] hover:bg-[#3A4A3A]/50' }} transition-colors">
                Nostalgia
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-[#3A4A3A]">
            <div class="px-4">
                <div class="font-medium text-base text-[#FDFBF7]" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-[#B5C4B5]">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile') }}" wire:navigate class="block px-4 py-2 text-base font-medium text-[#B5C4B5] hover:text-[#FDFBF7] hover:bg-[#3A4A3A]/50 transition-colors">
                    {{ __('Profile') }}
                </a>

                <!-- Authentication -->
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" 
                            class="w-full text-start block px-4 py-2 text-base font-medium text-[#B5C4B5] hover:text-[#FDFBF7] hover:bg-[#3A4A3A]/50 transition-colors">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
