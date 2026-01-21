<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="animate-fade-in-up">
    <h2 class="text-2xl font-bold text-stone-800 text-center mb-2">Join Anticerai</h2>
    <p class="text-stone-500 text-center mb-6 text-sm">Create an account to start your journey.</p>

    <form wire:submit="register" class="space-y-4">
        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-stone-600 mb-1">Name</label>
            <div class="relative">
                <input wire:model="name" id="name" type="text" name="name" required autofocus autocomplete="name"
                    class="block w-full px-4 py-2.5 border border-stone-200 rounded-xl leading-5 bg-stone-50 placeholder-stone-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary-400 focus:border-primary-400 sm:text-sm transition duration-150 ease-in-out">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-stone-600 mb-1">Email</label>
            <div class="relative">
                <input wire:model="email" id="email" type="email" name="email" required autocomplete="username"
                    class="block w-full px-4 py-2.5 border border-stone-200 rounded-xl leading-5 bg-stone-50 placeholder-stone-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary-400 focus:border-primary-400 sm:text-sm transition duration-150 ease-in-out">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-stone-600 mb-1">Password</label>
            <div class="relative">
                <input wire:model="password" id="password" type="password" name="password" required autocomplete="new-password"
                    class="block w-full px-4 py-2.5 border border-stone-200 rounded-xl leading-5 bg-stone-50 placeholder-stone-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary-400 focus:border-primary-400 sm:text-sm transition duration-150 ease-in-out">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-stone-600 mb-1">Confirm Password</label>
            <div class="relative">
                <input wire:model="password_confirmation" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="block w-full px-4 py-2.5 border border-stone-200 rounded-xl leading-5 bg-stone-50 placeholder-stone-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary-400 focus:border-primary-400 sm:text-sm transition duration-150 ease-in-out">
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all transform hover:scale-[1.02] active:scale-95">
                {{ __('Register') }}
            </button>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-stone-500">
                Already registered? 
                <a href="{{ route('login') }}" class="font-bold text-stone-700 hover:text-black transition-colors" wire:navigate>
                    Log in
                </a>
            </p>
        </div>
    </form>
</div>
