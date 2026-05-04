<?php

namespace App\Http\Controllers;

use App\Http\Requests\Menu\CreateMenuDto;
use App\Http\Requests\Menu\UpdateMenuDto;
use App\Http\Resources\Menu\MenuResource;
use App\Http\Resources\Menu\SlideResource;
use App\Models\Menu\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index(): JsonResponse
    {
        $menus = Menu::all();

        return response()->json(MenuResource::collection($menus));
    }

    public function show(Menu $menu): JsonResponse
    {
        return response()->json(SlideResource::collection($menu->slides));
    }

    public function store(CreateMenuDto $dto): JsonResponse
    {
        $menu = Menu::create([
            'name' => $dto->name,
            'bg_img' => $dto->bgImg->store('menus/bg', 'public'),
            'icon' => $dto->icon->store('menus/icons', 'public'),
            'is_booking' => $dto->isBooking,
        ]);

        return response()->json(new MenuResource($menu), 201);
    }

    public function update(Menu $menu, UpdateMenuDto $dto): JsonResponse
    {
        if ($dto->bgImg) {
            Storage::disk('public')->delete($menu->getRawOriginal('bg_img'));
        }

        if ($dto->icon) {
            Storage::disk('public')->delete($menu->getRawOriginal('icon'));
        }

        $menu->update([
            'name' => $dto->name,
            'bg_img' => $dto->bgImg?->store('sliders/bg', 'public') ?? $menu->getRawOriginal('bg_img'),
            'icon' => $dto->icon?->store('sliders/icons', 'public') ?? $menu->getRawOriginal('icon'),
            'is_booking' => $dto->isBooking,
        ]);

        return response()->json(new MenuResource($menu));
    }

    public function destroy(Menu $menu): JsonResponse
    {
        Storage::disk('public')->delete($menu->getRawOriginal('bg_img'));
        Storage::disk('public')->delete($menu->getRawOriginal('icon'));
        $menu->delete();

        return response()->json(status: 204);
    }
}
