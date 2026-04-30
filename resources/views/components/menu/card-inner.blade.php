@props([
    'icon',
    'title',
])

<div class="absolute inset-0 bg-linear-to-t from-black/80 to-transparent"></div>

<div class="relative h-full flex flex-col justify-between">
    <div class="w-9 h-9 bg-black/30 rounded-lg p-1">
        <img src="{{ $icon }}" alt=""/>
    </div>

    <div class="flex justify-end items-center gap-2">
        <h3 class="text-white text-xl font-medium">{{ $title }}</h3>

        <button type="button" class="w-7 h-7 bg-secondary rounded-md p-1.5">
            <img src="{{ asset('icons/play.svg') }}" alt=""/>
        </button>
    </div>
</div>
