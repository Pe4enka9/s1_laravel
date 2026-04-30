@props([
    'key',
    'number',
    'bgImg',
    'title',
    'description',
    'button' => '',
])

<div
    class="relative h-full flex flex-col justify-center items-center gap-8"
    wire:key="{{ $key }}"
>
    <div
        class="absolute inset-0 bg-no-repeat bg-center bg-cover"
        @style("background-image: linear-gradient(rgba(0, 0 , 0, .3), rgba(0, 0, 0, .3)), url('$bgImg')")
    ></div>

    <div
        class="w-24 h-24 flex justify-center items-center font-bold text-text-secondary text-5xl bg-black/50 rounded-full z-10"
    >
        {{ $number < 10 ? "0$number" : $number }}
    </div>

    <div class="flex flex-col items-center gap-6 z-10">
        <h2 class="text-white uppercase font-medium text-4xl font-oswald">{{ $title }}</h2>
        <p class="text-white">{{ $description }}</p>

        @if($button)
            <x-buttons.cta>{{ $button }}</x-buttons.cta>
        @endif
    </div>
</div>
