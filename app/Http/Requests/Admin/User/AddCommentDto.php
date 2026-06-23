<?php

namespace App\Http\Requests\Admin\User;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AddCommentDto extends Data
{
    public function __construct(
        public string $comment,
    )
    {
    }
}
