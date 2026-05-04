<?php

namespace App\Http\Requests\Menu;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Image;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Mimes;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CreateMenuDto extends Data
{
    public function __construct(
        #[Max(255)]
        public string       $name,
        #[Image, Mimes('jpg,jpeg,png,webp'), Max(2048)]
        public UploadedFile $bgImg,
        #[Mimes('svg'), Max(2048)]
        public UploadedFile $icon,
        public bool         $isBooking,
    )
    {
    }
}
