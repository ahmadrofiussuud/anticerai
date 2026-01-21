@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-stone-600 mb-1']) }}>
    {{ $value ?? $slot }}
</label>
