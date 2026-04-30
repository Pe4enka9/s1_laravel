<?php

use App\Models\Menu\Menu;
use App\Models\Slider;
use Illuminate\Support\Collection;
use Livewire\Component;

new class extends Component {
    public Collection $slides;
    public Collection $menus;

    public function mount(): void
    {
        $this->slides = Slider::all();
        $this->menus = Menu::all();
    }
};
?>

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
@endpush

<div>
    <div class="swiper mySwiper h-[50vh] rounded-lg mb-5">
        <div class="swiper-wrapper">
            @php /** @var Slider $slide */ @endphp

            @foreach($this->slides as $slide)
                <div class="swiper-slide" wire:key="{{ $slide->id }}">
                    <x-slider.hero
                        :bg-img="$slide->bg_img"
                        :icon="$slide->icon"
                        :icon-text="$slide->icon_text"
                        :title="$slide->name"
                        :description="$slide->description"
                        :button="$slide->button"
                    />
                </div>
            @endforeach
        </div>

        <div class="swiper-pagination"></div>
    </div>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 md:grid-cols-3">
        @php /** @var Menu $menu */ @endphp

        @foreach($this->menus as $menu)
            <x-menu.card :menu="$menu"/>
        @endforeach
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/slider/home.js') }}"></script>
@endpush
