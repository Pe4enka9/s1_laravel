@props([
    'type' => 'button',
    'class' => 'primary',
    'click' => null,
])

<button
    type="{{ $type }}"
    @class(['text-primary border-2 border-primary hover:text-white hover:bg-primary' => $class === 'outline', 'text-white bg-secondary hover:bg-secondary/70' => $class === 'primary', 'text-white bg-transparent border border-my-border hover:bg-my-border/50' => $class === 'border', 'font-medium rounded-lg p-2.5 cursor-pointer transition-all duration-300 active:scale-95 sm:w-full'])
    wire:click="{{ $click }}"
>
    {{ $slot }}
</button>
