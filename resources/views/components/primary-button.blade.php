<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-3 bg-gradient-to-r from-primary-500 to-primary-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:from-primary-600 hover:to-primary-700 active:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md hover:shadow-lg transform hover:scale-[1.02] active:scale-95']) }}>
    {{ $slot }}
</button>
