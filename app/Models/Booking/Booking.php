<?php

namespace App\Models\Booking;

use App\Models\Booking\Enums\BookingStatusEnum;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id'])]
class Booking extends Model
{
    protected $casts = [
        'date' => 'datetime',
        'status' => BookingStatusEnum::class,
    ];

    protected function dateFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->date->format('d.m.Y'),
        );
    }

    protected function timeFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->date->format('H:i'),
        );
    }

    protected function createdAtDateFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->created_at->format('d.m.Y'),
        );
    }
}
