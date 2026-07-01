<?php

namespace App\Models\Booking;

use App\Models\Booking\Enums\BookingStatusEnum;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id'])]
class Booking extends Model
{
    protected $casts = [
        'date' => 'datetime',
        'status' => BookingStatusEnum::class,
    ];
}
