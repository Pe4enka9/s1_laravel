<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Guarded(['id'])]
class Slider extends Model
{
    protected function bgImg(): Attribute
    {
        return Attribute::make(
            get: fn($bgImg) => Storage::disk('public')->url($bgImg),
        );
    }

    protected function icon(): Attribute
    {
        return Attribute::make(
            get: fn($icon) => $icon ? Storage::disk('public')->url($icon) : null,
        );
    }
}
