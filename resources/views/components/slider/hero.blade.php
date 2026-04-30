@props([
    'bgImg',
    'icon',
    'iconText',
    'title',
    'description',
    'button',
])

<div
    class="relative pb-12 h-full bg-no-repeat bg-cover bg-center"
    @style("background-image: url('$bgImg');")
>
    <div class="absolute inset-0 bg-linear-to-t from-black/80 to-transparent"></div>

    <div class="relative z-10 flex flex-col justify-end items-center gap-5 h-full">
        @if($icon || $iconText)
            <div class="flex items-center gap-2 bg-secondary rounded-full py-1 px-2">
                @if($icon)
                    <div class="w-5 h-5">
                        <img src="{{ $icon }}" alt=""/>
                    </div>
                @endif

                @if($iconText)
                    <span class="text-white font-bold uppercase">{{ $iconText }}</span>
                @endif
            </div>
        @endif

        <div class="flex flex-col items-center gap-2">
            <h2 class="text-white font-bold text-4xl">{{ $title }}</h2>

            @if($description)
                <p class="text-white">{{ $description }}</p>
            @endif
        </div>

        @if($button)
            <x-buttons.cta>{{ $button }}</x-buttons.cta>
        @endif
    </div>
</div>
