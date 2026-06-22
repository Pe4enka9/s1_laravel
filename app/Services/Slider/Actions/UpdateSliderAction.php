<?php

namespace App\Services\Slider\Actions;

use App\Http\Requests\Slider\UpdateSliderDto;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class UpdateSliderAction
{
    public function __invoke(Slider $slider, UpdateSliderDto $dto): Slider
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

        return $slider;
    }
}
