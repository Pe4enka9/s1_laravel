<?php

namespace Database\Seeders;

use App\Models\Menu\Slide;
use Illuminate\Database\Seeder;

class SlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'menu_id' => 1,
                'name' => 'Адреналин',
                'description' => 'Гул моторов — это битва сердца. Вираж — это танец на грате сцепления. Здесь нет места полутонам, только чистая скорость.',
                'bg_img' => 'seeders/slides/bg/card-bg-1.jpg',
            ],
            [
                'menu_id' => 1,
                'name' => 'Тактика',
                'description' => 'Не просто быстрее всех. Это шахматы на 300 км/ч. Каждый круг, каждый пит-стоп — расчетливый ход к победе.',
                'bg_img' => 'seeders/slides/bg/card-bg-2.webp',
            ],
            [
                'menu_id' => 1,
                'name' => 'Технологии',
                'description' => 'Каждая деталь — продукт инженерной мысли. Аэродинамика, сцепление, выносливость. Мощь, которую можно приручить.',
                'bg_img' => 'seeders/slides/bg/card-bg-3.jpg',
            ],
            [
                'menu_id' => 1,
                'name' => 'История',
                'description' => 'От гравийных трасс до современных автодромов. Здесь писались легенды, которые вдохновляют и сегодня.',
                'bg_img' => 'seeders/slides/bg/card-bg-4.jpg',
            ],
            [
                'menu_id' => 1,
                'name' => 'Твоя очередь',
                'description' => 'Хочешь почувствовать драйв на себе? Узнай, как оказаться по ту сторону трека.',
                'bg_img' => 'seeders/slides/bg/card-bg-5.webp',
                'button' => 'Записаться',
            ],
        ];

        foreach ($slides as $slide) {
            Slide::create($slide);
        }
    }
}
