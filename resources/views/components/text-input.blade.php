@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-stone-200 focus:border-primary-400 focus:ring-primary-400 rounded-xl shadow-sm bg-stone-50 placeholder-stone-400 text-stone-700 transition-colors duration-200']) }}>
