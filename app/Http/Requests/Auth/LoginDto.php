<?php

namespace App\Http\Requests\Auth;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class LoginDto extends Data
{
    public function __construct(
        #[Max(255), Regex('/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/')]
        public string $phone,
        #[Max(255)]
        public string $password,
    )
    {
    }
}
