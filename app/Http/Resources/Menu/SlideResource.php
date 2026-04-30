<?php

namespace App\Http\Resources\Menu;

use App\Models\Menu\Slide;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Slide
 */
class SlideResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'menu_id' => $this->menu_id,
            'name' => $this->name,
            'description' => $this->description,
            'bg_img' => $this->bg_img,
            'button' => $this->button,
        ];
    }
}
