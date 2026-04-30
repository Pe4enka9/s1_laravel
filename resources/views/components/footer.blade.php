<footer class="bg-[#222] mt-5">
    <div class="container mx-auto flex flex-col gap-6 items-center pt-3 pb-5">
        <div class="container mx-auto flex justify-between items-center">
            <x-logo/>
            <livewire:nav/>
        </div>

        <x-footer.contacts>
            <x-footer.contact-item :icon="asset('icons/location.svg')">
                ул. Гоночная, 15, Москва
            </x-footer.contact-item>

            <x-footer.contact-item :icon="asset('icons/clock.svg')">
                Ежедневно: 10:00 – 22:00
            </x-footer.contact-item>
        </x-footer.contacts>

        <x-footer.contacts>
            <x-footer.contact-item :icon="asset('icons/phone.svg')" href="tel:+74951234567">
                +7 (495) 123-45-67
            </x-footer.contact-item>

            <x-footer.contact-item :icon="asset('icons/email.svg')" href="mailto:info@simrace.ru">
                info@simrace.ru
            </x-footer.contact-item>
        </x-footer.contacts>

        <x-footer.contacts>
            <p class="text-white">Подписывайтесь</p>

            <div class="flex gap-3">
                <a href="#" target="_blank" class="w-8 h-8 block">
                    <img src="{{ asset('icons/telegram.svg') }}" alt=""/>
                </a>

                <a href="#" target="_blank" class="w-8 h-8 block">
                    <img src="{{ asset('icons/telegram.svg') }}" alt=""/>
                </a>

                <a href="#" target="_blank" class="w-8 h-8 block">
                    <img src="{{ asset('icons/telegram.svg') }}" alt=""/>
                </a>

                <a href="#" target="_blank" class="w-8 h-8 block">
                    <img src="{{ asset('icons/telegram.svg') }}" alt=""/>
                </a>
            </div>
        </x-footer.contacts>

        <hr class="w-full border-primary/40"/>

        <div class="flex items-center gap-1.5">
            <p class="text-white text-sm">&copy; 2025 S1</p>

            <div class="bg-white w-1.5 h-1.5 rounded-full"></div>

            <a href="#" class="text-white/70 text-sm hover:text-white transition-colors">Политика конфиденциальности</a>

            <div class="bg-white w-1.5 h-1.5 rounded-full"></div>

            <a href="#" class="text-white/70 text-sm hover:text-white transition-colors">Оферта</a>
        </div>
    </div>
</footer>
