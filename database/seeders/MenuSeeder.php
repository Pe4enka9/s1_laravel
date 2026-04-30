<?php

namespace Database\Seeders;

use App\Models\Menu\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            [
                'name' => 'Кольцевые гонки',
                'bg_img' => 'seeders/menus/bg/menu-bg-1.webp',
                'icon' => 'seeders/menus/icons/race-track.svg',
            ],
            [
                'name' => 'F1 гонки',
                'bg_img' => 'seeders/menus/bg/menu-bg-2.webp',
                'icon' => 'seeders/menus/icons/race-car.svg',
            ],
            [
                'name' => 'Дрифт',
                'bg_img' => 'seeders/menus/bg/menu-bg-3.jpg',
                'icon' => 'seeders/menus/icons/wheel.svg',
            ],
            [
                'name' => 'Шокирующие события',
                'bg_img' => 'seeders/menus/bg/menu-bg-4.jpg',
                'icon' => 'seeders/menus/icons/news.svg',
            ],
            [
                'name' => 'Sim Racing',
                'bg_img' => 'seeders/menus/bg/menu-bg-5.jpg',
                'icon' => 'seeders/menus/icons/game.svg',
            ],
            [
                'name' => 'Запись в клубе',
                'bg_img' => 'seeders/menus/bg/menu-bg-6.jpg',
                'icon' => 'seeders/menus/icons/calendar.svg',
                'is_booking' => true,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
