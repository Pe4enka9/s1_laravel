<?php

use App\Models\Menu\Menu;
use App\Models\Menu\Slide;
use Illuminate\Support\Collection;
use Livewire\Component;

new class extends Component {
    public Collection $slides;

    public function mount(Menu $menu): void
    {
        $this->slides = $menu->slides;
    }
};
?>

<div>
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
    @endpush

    <div class="fixed inset-0">
        <div class="swiper mySwiper w-full h-full">
            <div class="swiper-wrapper">
                @php /** @var Slide $slide */ @endphp

                @foreach($this->slides as $index => $slide)
                    <div class="swiper-slide">
                        <x-menu.slides.slide
                            :key="$slide->id"
                            :number="$index + 1"
                            :bg-img="$slide->bg_img"
                            :title="$slide->name"
                            :description="$slide->description"
                        />
                    </div>
                @endforeach
            </div>

            <div class="swiper-pagination vertical"></div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
        <script src="{{ asset('js/slider/menu-show.js') }}"></script>
    @endpush
</div>
