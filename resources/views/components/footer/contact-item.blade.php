@props([
    'icon',
    'href' => null,
])

@php
    $tag = $href ? 'a' : 'div';
    $attributes = $href ? "href=$href" : '';
@endphp

<{{ $tag }} {{ $attributes }} @class(['flex', 'items-center', 'gap-2'])>
<div class="w-5 h-5">
    <img src="{{ $icon }}" alt=""/>
</div>

<span class="text-white">{{ $slot }}</span>
</{{ $tag }}>
