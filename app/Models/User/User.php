<?php

namespace App\Models\User;

use App\Models\Booking\Booking;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

#[Guarded(['id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasApiTokens;

    protected $casts = [
        'password' => 'hashed',
        'role' => RoleEnum::class,
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::disk('public')->url($this->avatar),
        );
    }
}
