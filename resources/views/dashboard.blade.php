<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(!auth()->user()->couple_id)
                <livewire:pairing-manager />
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-secondary-400">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-bold mb-2">Welcome Back!</h3>
                        <p class="text-gray-600">You are connected with your partner. Your journey continues here.</p>
                        <div class="mt-4 p-4 bg-stone-50 rounded-lg border border-stone-100">
                            <strong>Status:</strong> <span class="text-green-600">Happily Paired</span>
                            <!-- Placeholder for future couple dashboard stats -->
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
