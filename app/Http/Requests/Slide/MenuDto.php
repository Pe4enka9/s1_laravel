<?php

namespace App\Http\Requests\Slide;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class MenuDto extends Data
{
    public function __construct(
        public ?int $menu,
    )
    {
    }
}
