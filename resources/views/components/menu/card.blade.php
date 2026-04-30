@props([
    'menu',
])

@php
    $classes = 'relative p-3 rounded-lg bg-no-repeat bg-center bg-cover h-40 shadow-md shadow-black/40 overflow-hidden hover:shadow-primary/50 active:scale-95 transition-all duration-500 ease-initial cursor-pointer';
    $styles = "background-image: url('$menu->bg_img');";
    $key = $menu->id;
@endphp

@if($menu->is_booking)
    <div
        @class($classes)
        @style($styles)
        @click="$dispatch('open-booking-form')"
        wire:key="{{ $key }}"
    >
        <x-menu.card-inner
            :icon="$menu->icon"
            :title="$menu->name"
        />
    </div>
@else
    <a
        href="{{ route('menus.show', $menu) }}"
        @class($classes)
        @style($styles)
        wire:key="{{ $key }}"
    >
        <x-menu.card-inner
            :icon="$menu->icon"
            :title="$menu->name"
        />
    </a>
@endif
