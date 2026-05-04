<?php

namespace App\Http\Controllers;

use App\Http\Requests\Slider\CreateSliderDto;
use App\Http\Requests\Slider\UpdateSliderDto;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index(): JsonResponse
    {
        $sliders = Slider::all();

        return response()->json(SliderResource::collection($sliders));
    }

    public function store(CreateSliderDto $dto): JsonResponse
    {
        $slider = Slider::create([
            'name' => $dto->name,
            'description' => $dto->description,
            'bg_img' => $dto->bgImg->store('sliders/bg', 'public'),
            'icon' => $dto->icon?->store('sliders/icons', 'public'),
            'icon_text' => $dto->iconText,
            'button' => $dto->button,
        ]);

        return response()->json(new SliderResource($slider), 201);
    }

    public function update(Slider $slider, UpdateSliderDto $dto): JsonResponse
    {
        if ($dto->bgImg) {
            Storage::disk('public')->delete($slider->getRawOriginal('bg_img'));
        }

        if ($dto->icon && $slider->icon) {
            Storage::disk('public')->delete($slider->getRawOriginal('icon'));
        }

        $slider->update([
            'name' => $dto->name,
            'description' => $dto->description,
            'bg_img' => $dto->bgImg?->store('sliders/bg', 'public') ?? $slider->getRawOriginal('bg_img'),
            'icon' => $dto->icon?->store('sliders/icons', 'public') ?? $slider->getRawOriginal('icon'),
            'icon_text' => $dto->iconText,
            'button' => $dto->button,
        ]);

        return response()->json(new SliderResource($slider));
    }

    public function destroy(Slider $slider): JsonResponse
    {
        Storage::disk('public')->delete($slider->getRawOriginal('bg_img'));
        if ($slider->icon) Storage::disk('public')->delete($slider->getRawOriginal('icon'));
        $slider->delete();

        return response()->json(status: 204);
    }
}
