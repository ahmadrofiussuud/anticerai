@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-bold text-sm text-emerald-700 bg-emerald-100 border border-emerald-200 px-4 py-3 rounded-xl shadow-sm mb-4 animate-fade-in-up']) }}>
        {{ $status }}
    </div>
@endif
