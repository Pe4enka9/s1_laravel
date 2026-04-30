@props([
    'status',
])

@php
    $statuses = [
        'pending' => 'bg-[#fbbf2426] text-[#fbbf24]',
        'success' => 'bg-[#22c55e26] text-[#4ade80]',
        'cancelled' => 'bg-[#ef444426] text-[#f87171]',
        'finished' => 'bg-[#6366f126] text-[#818cf8]',
    ];

    $baseClasses = 'w-fit py-1 px-3 text-xs font-semibold rounded-full flex justify-center items-center gap-2';
    $classes = $baseClasses . ' ' . $statuses[$status];
@endphp

<div
    @class($classes)
>
    <div class="w-1.5 h-1.5 rounded-full bg-current"></div>
    {{ $slot }}
</div>
