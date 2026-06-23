<?php

namespace App\Http\Requests\User;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AddAvatarDto extends Data
{
    public function __construct(
        public UploadedFile $avatar,
    )
    {
    }
}
