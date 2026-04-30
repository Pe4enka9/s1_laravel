@props([
    'event' => '',
    'link' => null,
])

@php
    $classes = 'text-sm text-text-secondary cursor-pointer px-2.5 py-1.5 rounded-md hover:bg-primary/20 transition-colors duration-300';
@endphp

@if($link)
    <a
        href="{{ $link }}"
        @class($classes)
    >
        {{ $slot }}
    </a>
@else
    <button
        type="button"
        @class($classes)
        @if($event)
            x-data
        @click="$dispatch('{{ $event }}')"
        @endif
    >
        {{ $slot }}
    </button>
@endif
