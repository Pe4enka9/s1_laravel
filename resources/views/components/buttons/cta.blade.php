<button
    type="button"
    class="text-white bg-primary font-medium rounded-2xl text-xl py-2.5 px-4 cursor-pointer shadow-sm shadow-primary/70 hover:shadow-md transition-shadow duration-300"
    @click="$dispatch('open-booking-form')"
>
    {{ $slot }}
</button>
