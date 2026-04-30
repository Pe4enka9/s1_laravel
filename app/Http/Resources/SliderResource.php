<?php

namespace App\Http\Resources;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Slider
 */
class SliderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'bg_img' => $this->bg_img,
            'icon' => $this->icon,
            'icon_text' => $this->icon_text,
            'button' => $this->button,
        ];
    }
}
