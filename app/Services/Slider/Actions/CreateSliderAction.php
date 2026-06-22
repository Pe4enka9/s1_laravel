<?php

namespace App\Services\Slider\Actions;

use App\Http\Requests\Slider\CreateSliderDto;
use App\Models\Slider;

class CreateSliderAction
{
    public function __invoke(CreateSliderDto $dto): Slider
    {
        return Slider::create([
            'name' => $dto->name,
            'description' => $dto->description,
            'bg_img' => $dto->bgImg->store('sliders/bg', 'public'),
            'icon' => $dto->icon?->store('sliders/icons', 'public'),
            'icon_text' => $dto->iconText,
            'button' => $dto->button,
        ]);
    }
}
