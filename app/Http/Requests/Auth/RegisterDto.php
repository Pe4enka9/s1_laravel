<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Confirmed;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class RegisterDto extends Data
{
    public function __construct(
        #[Max(255), Regex('/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/'), Unique(User::class, 'phone')]
        public string $phone,
        #[Max(255), Regex('/^[a-zA-Zа-яА-ЯёЁ]{2,}([-\'][a-zA-Zа-яА-ЯёЁ]{2,})*$/u')]
        public string $firstName,
        #[Max(255), Regex('/^[a-zA-Zа-яА-ЯёЁ]{2,}([-\'][a-zA-Zа-яА-ЯёЁ]{2,})*$/u')]
        public string $lastName,
        #[Min(6), Max(255), Confirmed]
        public string $password,
    )
    {
    }
}
