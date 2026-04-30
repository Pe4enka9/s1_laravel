@props([
    'label',
    'type',
    'name',
    'id',
    'placeholder' => '',
    'min' => '',
])

<div class="flex flex-col gap-1.5">
    <label for="{{ $id }}" class="text-white font-medium">{{ $label }}</label>

    <div
        class="relative"
        x-data="{ showPassword: false }"
    >
        <input
            :type="showPassword ? 'text' : '{{ $type }}'"
            name="{{ $name }}"
            id="{{ $id }}"
            placeholder="{{ $placeholder }}"
            min="{{ $min }}"
            class="w-full bg-[#222] text-white border-2 border-my-border rounded-lg px-2.5 py-1.5 outline-none focus:border-secondary transition-colors duration-300"
            wire:model.live.debounce.250ms="{{ $name }}"
        >

        @if($type === 'password')
            <button
                type="button"
                class="absolute top-1/2 right-3 -translate-y-1/2 w-6 h-6 bg-no-repeat bg-center bg-contain cursor-pointer"
                :style="`background-image: url('${showPassword ? '{{ asset('icons/eye-password-visible.svg') }}' : '{{ asset('icons/eye-password-hidden.svg') }}'}')`;"
                @click="showPassword = !showPassword"
            ></button>
        @endif
    </div>

    @error($name)
    <div class="text-secondary text-sm">{{ $message }}</div>
    @enderror
</div>
