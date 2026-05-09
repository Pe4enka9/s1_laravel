<?php

namespace App\Http\Requests;

use App\Models\Booking\Enums\BookingStatusEnum;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class StatusDto extends Data
{
    public function __construct(
        public ?BookingStatusEnum $status,
    )
    {
    }
}
