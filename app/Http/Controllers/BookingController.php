<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingDto;
use App\Http\Requests\StatusDto;
use App\Http\Resources\BookingResource;
use App\Models\Booking\Booking;
use App\Models\Booking\Enums\BookingStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(StatusDto $dto): JsonResponse
    {
        $status = $dto->status;

        $bookings = Booking::when($status, function (Builder $query) use ($status) {
            $query->where('status', $status);
        })->latest()->paginate(5);

        return response()->json([
            'data' => BookingResource::collection($bookings),
            'pagination' => [
                'current_page' => $bookings->currentPage(),
                'last_page' => $bookings->lastPage(),
            ],
        ]);
    }

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

    public function update(Booking $booking, StatusDto $dto): JsonResponse
    {
        $booking->update(['status' => $dto->status]);

        return response()->json(new BookingResource($booking));
    }

    public function getStats(): JsonResponse
    {
        $stats = Booking::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $result = [];

        foreach (BookingStatusEnum::cases() as $status) {
            $result[$status->value] = $stats[$status->value] ?? 0;
        }

        return response()->json($result);
    }
}
