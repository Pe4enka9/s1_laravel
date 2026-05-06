<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

#[Guarded(['id'])]
class Slide extends Model
{
    protected function bgImg(): Attribute
    {
        return Attribute::make(
            get: fn($bgImg) => Storage::disk('public')->url($bgImg),
        );
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
}
