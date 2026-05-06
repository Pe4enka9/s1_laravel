<?php

namespace App\Http\Requests\Slide;

use App\Models\Menu\Menu;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Image;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Mimes;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class UpdateSlideDto extends Data
{
    public function __construct(
        #[Exists(Menu::class, 'id')]
        public int           $menuId,
        #[Max(255)]
        public string        $name,
        public string        $description,
        #[Image, Mimes('jpg,jpeg,png,webp'), Max(2048)]
        public ?UploadedFile $bgImg,
        public ?string       $button,
    )
    {
    }
}
