<?php

namespace App\Http\Requests;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\AfterOrEqual;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class BookingDto extends Data
{
    public function __construct(
        #[Max(255), Regex('/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/')]
        public string $phone,
        #[AfterOrEqual('today')]
        public string $date,
        #[Min(1), Max(10)]
        public int    $duration,
        #[Min(1), Max(5)]
        public int    $peoples,
    )
    {
    }
}
