<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuDto;
use App\Http\Requests\Slide\CreateSlideDto;
use App\Http\Requests\Slide\UpdateSlideDto;
use App\Http\Resources\Menu\SlideResource;
use App\Models\Menu\Slide;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index(MenuDto $dto): JsonResponse
    {
        $menuId = $dto->menu;

        $slides = Slide::with('menu')
            ->when($menuId, function (Builder $query) use ($menuId) {
                $query->where('menu_id', $menuId);
            })
            ->latest()
            ->get();

        return response()->json(SlideResource::collection($slides));
    }

    public function store(CreateSlideDto $dto): JsonResponse
    {
        $slide = Slide::create([
            'menu_id' => $dto->menuId,
            'name' => $dto->name,
            'description' => $dto->description,
            'bg_img' => $dto->bgImg->store('slides/bg', 'public'),
            'button' => $dto->button,
        ]);

        return response()->json(new SlideResource($slide), 201);
    }

    public function update(Slide $slide, UpdateSlideDto $dto): JsonResponse
    {
        if ($dto->bgImg) {
            Storage::disk('public')->delete($slide->getRawOriginal('bg_img'));
        }

        $slide->update([
            'menu_id' => $dto->menuId,
            'name' => $dto->name,
            'description' => $dto->description,
            'bg_img' => $dto->bgImg?->store('slides/bg', 'public') ?? $slide->getRawOriginal('bg_img'),
            'button' => $dto->button,
        ]);

        return response()->json(new SlideResource($slide));
    }

    public function destroy(Slide $slide): JsonResponse
    {
        Storage::disk('public')->delete($slide->getRawOriginal('bg_img'));
        $slide->delete();

        return response()->json(status: 204);
    }
}
