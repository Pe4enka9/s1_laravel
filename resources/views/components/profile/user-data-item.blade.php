@props([
    'icon',
    'label',
    'value',
])

<div class="flex items-center gap-3 border-b border-my-border/40 pb-4">
    <div class="w-10 h-10 p-2 bg-primary/40 rounded-lg">
        <img src="{{ $icon }}" alt="">
    </div>

    <div class="flex flex-col">
        <div class="text-text-secondary text-xs uppercase font-bold">{{ $label }}</div>
        <div class="text-white font-medium">{{ $value }}</div>
    </div>
</div>
