<?php

namespace App\Services\Slider\Actions;

use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class DeleteSliderAction
{
    public function __invoke(Slider $slider): void
    {
        Storage::disk('public')->delete($slider->getRawOriginal('bg_img'));

        if ($slider->icon) {
            Storage::disk('public')->delete($slider->getRawOriginal('icon'));
        }

        $slider->delete();
    }
}
