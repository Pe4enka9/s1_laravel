<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

#[Guarded(['id'])]
class Menu extends Model
{
    protected $casts = [
        'is_booking' => 'boolean',
    ];

    protected function bgImg(): Attribute
    {
        return Attribute::make(
            get: fn($bgImg) => Storage::disk('public')->url($bgImg),
        );
    }

    protected function icon(): Attribute
    {
        return Attribute::make(
            get: fn($icon) => Storage::disk('public')->url($icon),
        );
    }

    public function slides(): HasMany
    {
        return $this->hasMany(Slide::class, 'menu_id');
    }
}
