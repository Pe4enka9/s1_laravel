@props([
    'filter' => null,
    'isActive' => false,
])

@php
    $baseClasses = 'text-sm font-semibold py-1.5 px-4 border rounded-lg cursor-pointer transition-colors duration-300';
    $notActiveClasses = 'text-text-secondary bg-[#1a1a1a] border-my-border hover:border-secondary hover:text-white';
    $activeClasses = 'text-white bg-primary border-primary';
    $classes = $baseClasses . ' ' . ($isActive ? $activeClasses : $notActiveClasses);
@endphp

<button
    type="button"
    @class($classes)
    wire:click="setFilter('{{ $filter }}')"
>
    {{ $slot }}
</button>
