<?php

namespace App\Http\Requests;

use App\Models\User;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Support\Validation\References\RouteParameterReference;

#[MapName(SnakeCaseMapper::class)]
class UserDto extends Data
{
    public function __construct(
        #[Max(255), Regex('/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/'), Unique(User::class, 'phone', ignore: new RouteParameterReference('user'))]
        public string $phone,
        #[Max(255)]
        public string $firstName,
        #[Max(255)]
        public string $lastName,
    )
    {
    }
}
