@props([
    'event',
    'icon',
    'title',
    'stepLabels',
    'endButtonText',
])

<div
    class="fixed inset-0 z-50"
    x-data="{ open: false }"
    x-show="open"
    x-effect="document.body.style.overflow = open ? 'hidden' : ''"
    @open-{{ $event }}-form.window="open = true"
    @close-{{ $event }}-form.window="open = false"
>
    <div
        class="absolute inset-0 bg-black/50"
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-1000"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    ></div>

    <div
        class="relative h-screen flex justify-center items-center"
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-1000"
        x-transition:enter-start="translate-y-full"
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-in duration-1000"
        x-transition:leave-start="translate-y-0"
        x-transition:leave-end="translate-y-full"
    >
        <form
            class="bg-main flex flex-col items-center gap-8 p-5 w-full h-full sm:w-1/3 sm:h-2/3 sm:border sm:border-my-border sm:rounded-lg"
            wire:submit.prevent="nextStep"
            @click.outside="open = false"
        >
            <div class="flex flex-col gap-3 w-full">
                <div class="flex justify-between">
                    @foreach($stepLabels as $index => $stepLabel)
                        <div
                            @class(['text-sm', 'transition-colors', 'duration-500', $this->step >= $index + 1 ? 'text-white' : 'text-my-border'])
                        >
                            {{ $stepLabel }}
                        </div>
                    @endforeach
                </div>

                <div class="bg-my-border rounded-full h-1">
                    <div
                        @class(['bg-secondary', 'rounded-full', 'h-1', 'transition-all', 'duration-1000', 'w-1/5' => $this->step === 1, 'w-1/2' => $this->step === 2, 'w-full' => $this->step === 3])
                    ></div>
                </div>
            </div>

            <div class="flex flex-col items-center gap-3">
                <div class="w-16 h-16 rounded-full bg-secondary p-4">
                    <img src="{{ $icon }}" alt=""/>
                </div>

                <h4 class="text-white font-medium text-2xl">{{ $title }}</h4>
            </div>

            <div class="w-screen relative h-full overflow-hidden sm:w-[33vw]">
                <div
                    @class(['absolute', 'inset-0', 'transition-transform', 'duration-700', 'flex', '-translate-x-full' => $this->step === 2, '-translate-x-[200%]' => $this->step === 3])
                >
                    {{ $slot }}
                </div>
            </div>

            <div class="flex flex-col gap-4 w-full mt-auto sm:flex-row-reverse">
                <x-buttons.btn type="submit">
                    {{ $this->step === 3 ? $endButtonText : 'Продолжить' }}
                </x-buttons.btn>

                <x-buttons.btn class="border" click="prevStep">
                    {{ $this->step === 1 ? 'Отмена' : 'Назад' }}
                </x-buttons.btn>
            </div>
        </form>
    </div>
</div>
