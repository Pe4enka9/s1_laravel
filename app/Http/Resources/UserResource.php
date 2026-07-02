<?php

namespace App\Http\Resources;

use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'phone' => $this->phone,
            'name' => $this->name,
            'role' => $this->role,
            'avatar' => $this->avatar ? $this->avatar_url : null,
        ];
    }
}
