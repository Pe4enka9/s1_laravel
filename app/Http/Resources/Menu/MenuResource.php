<?php

namespace App\Http\Resources\Menu;

use App\Models\Menu\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Menu
 */
class MenuResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'bg_img' => $this->bg_img,
            'icon' => $this->icon,
            'is_booking' => $this->is_booking,
        ];
    }
}
