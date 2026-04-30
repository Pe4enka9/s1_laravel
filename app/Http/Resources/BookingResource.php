<?php

namespace App\Http\Resources;

use App\Models\Booking\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Booking
 */
class BookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'phone' => $this->phone,
            'date' => $this->date,
            'date_formatted' => $this->date_formatted,
            'time_formatted' => $this->time_formatted,
            'duration' => $this->duration,
            'peoples' => $this->peoples,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_at_date_formatted' => $this->created_at_date_formatted,
        ];
    }
}
