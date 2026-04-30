<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingDto;
use App\Http\Resources\BookingResource;
use App\Models\Booking\Booking;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(BookingDto $dto): JsonResponse
    {
        $booking = Booking::create([
            'user_id' => Auth::id() ?? null,
            'phone' => $dto->phone,
            'date' => $dto->date,
            'duration' => $dto->duration,
            'peoples' => $dto->peoples,
        ]);

        return response()->json(new BookingResource($booking), 201);
    }
}
