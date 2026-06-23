<?php

namespace App\Http\Requests\Booking;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\AfterOrEqual;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class SlotDto extends Data
{
    public function __construct(
        #[AfterOrEqual('today')]
        public string $date,
        #[Min(1), Max(5)]
        public int    $peoples,
        #[Min(1), Max(10)]
        public int    $duration,
    )
    {
    }
}
