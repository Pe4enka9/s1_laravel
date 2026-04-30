<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'name' => 'Скидка 30%',
                'description' => 'На все симуляторы до воскресенья',
                'bg_img' => 'seeders/sliders/bg/banner.jpg',
                'icon' => 'seeders/sliders/icons/fire.svg',
                'icon_text' => 'Акция',
                'button' => 'Записаться',
            ],
            [
                'name' => 'Скидка 20%',
                'description' => 'На все симуляторы до воскресенья',
                'bg_img' => 'seeders/sliders/bg/menu-bg-1.webp',
                'icon' => 'seeders/sliders/icons/fire.svg',
                'icon_text' => 'Акция',
                'button' => 'Записаться',
            ],
            [
                'name' => 'Скидка 10%',
                'description' => 'На все симуляторы до воскресенья',
                'bg_img' => 'seeders/sliders/bg/menu-bg-2.webp',
                'icon' => 'seeders/sliders/icons/fire.svg',
                'icon_text' => 'Акция',
                'button' => 'Записаться',
            ],
        ];

        foreach ($slides as $slide) {
            Slider::create($slide);
        }
    }
}
