<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('home', absolute: false), navigate: false);
    }
}; ?>

<div class="animate-fade-in-up">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="text-2xl font-bold text-stone-800 text-center mb-2">Welcome Back</h2>
    <p class="text-stone-500 text-center mb-6 text-sm">Please enter your details to sign in.</p>

    <form wire:submit="login" class="space-y-4">
        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-stone-600 mb-1">Email</label>
            <div class="relative">
                 <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                 </div>
                <input wire:model="form.email" 
                       wire:loading.attr="disabled" 
                       wire:target="login"
                       id="email" type="email" name="email" required autofocus autocomplete="username"
                       class="block w-full pl-10 pr-3 py-2.5 border border-stone-200 rounded-xl leading-5 bg-stone-50 placeholder-stone-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary-400 focus:border-primary-400 sm:text-sm transition duration-150 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed">
            </div>
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
             <label for="password" class="block text-sm font-semibold text-stone-600 mb-1">Password</label>
             <div class="relative">
                 <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                 </div>
                <input wire:model="form.password" 
                       wire:loading.attr="disabled" 
                       wire:target="login"
                       id="password" type="password" name="password" required autocomplete="current-password"
                       class="block w-full pl-10 pr-3 py-2.5 border border-stone-200 rounded-xl leading-5 bg-stone-50 placeholder-stone-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary-400 focus:border-primary-400 sm:text-sm transition duration-150 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed">
            </div>
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-stone-300 text-primary-600 shadow-sm focus:ring-primary-500 bg-stone-50">
                <span class="ms-2 text-sm text-stone-500">{{ __('Remember me') }}</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-sm text-primary-600 hover:text-primary-800 font-medium transition-colors" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="mt-6">
            <button type="submit" 
                    wire:loading.attr="disabled"
                    wire:target="login"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-gradient-to-r from-stone-800 to-stone-900 hover:from-black hover:to-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-stone-900 transition-all transform hover:scale-[1.02] active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                <span wire:loading.remove wire:target="login">{{ __('Log in') }}</span>
                <span wire:loading wire:target="login" class="flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Logging in...
                </span>
            </button>
        </div>
        
        <div class="mt-6 text-center">
            <p class="text-sm text-stone-500">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-bold text-primary-600 hover:text-primary-800 transition-colors" wire:navigate>
                    Sign up
                </a>
            </p>
        </div>
    </form>
</div>
