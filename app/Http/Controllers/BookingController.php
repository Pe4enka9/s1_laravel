<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    // Бронирование
    public function store(BookingRequest $request): JsonResponse
    {
        $booking = Booking::create([
            'phone_number' => $request->input('phone_number'),
            'date' => $request->input('date'),
            'duration' => $request->input('duration'),
            'number_of_people' => $request->input('number_of_people'),
            'total' => $request->input('duration') * 400 * $request->input('number_of_people'),
        ]);

        return response()->json(new BookingResource($booking), 201);
    }

    // Бронирование для авторизованных пользователей
    public function storeAuth(BookingRequest $request): JsonResponse
    {
        $booking = Booking::create([
            'user_id' => $request->user()->id,
            'date' => $request->input('date'),
            'duration' => $request->input('duration'),
            'number_of_people' => $request->input('number_of_people'),
            'total' => $request->input('duration') * 400 * $request->input('number_of_people'),
        ]);

        return response()->json(new BookingResource($booking), 201);
    }
}
