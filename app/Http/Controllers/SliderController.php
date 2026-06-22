<?php

namespace App\Http\Controllers;

use App\Http\Requests\Slider\CreateSliderDto;
use App\Http\Requests\Slider\UpdateSliderDto;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use App\Services\Slider\Actions\CreateSliderAction;
use App\Services\Slider\Actions\DeleteSliderAction;
use App\Services\Slider\Actions\UpdateSliderAction;
use Illuminate\Http\JsonResponse;

class SliderController extends Controller
{
    // Все слайды слайдера
    public function index(): JsonResponse
    {
        $sliders = Slider::all();

        return response()->json(SliderResource::collection($sliders));
    }

    // Создание слайда в слайдер
    public function store(
        CreateSliderDto    $dto,
        CreateSliderAction $createSliderAction,
    ): JsonResponse
    {
        $slider = $createSliderAction($dto);

        return response()->json(new SliderResource($slider), 201);
    }

    // Обновление слайда в слайдере
    public function update(
        Slider             $slider,
        UpdateSliderDto    $dto,
        UpdateSliderAction $updateSliderAction,
    ): JsonResponse
    {
        $slider = $updateSliderAction($slider, $dto);

        return response()->json(new SliderResource($slider));
    }

    // Удаление слайда в слайдере
    public function destroy(
        Slider             $slider,
        DeleteSliderAction $deleteSliderAction,
    ): JsonResponse
    {
        $deleteSliderAction($slider);

        return response()->json(status: 204);
    }
}
