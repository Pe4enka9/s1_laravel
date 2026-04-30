<?php

namespace App\Http\Controllers;

use App\Http\Resources\Menu\MenuResource;
use App\Http\Resources\Menu\SlideResource;
use App\Models\Menu\Menu;
use Illuminate\Http\JsonResponse;

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
}
