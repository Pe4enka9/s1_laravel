<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingDto;
use App\Http\Requests\SlotDto;
use App\Http\Requests\StatusDto;
use App\Http\Resources\BookingResource;
use App\Models\Booking\Booking;
use App\Models\Booking\Enums\BookingStatusEnum;
use Carbon\Carbon;
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

    public function getSlots(SlotDto $dto): JsonResponse
    {
        $maxCapacity = 5;
        $startHour = 10;
        $endHour = 22;
        $hours = $dto->duration;

        $now = now();
        $isToday = $dto->date === $now->toDateString();

        $bookings = Booking::whereDate('date', $dto->date)
            ->whereNot('status', BookingStatusEnum::CANCELLED)
            ->get(['date', 'duration', 'peoples']);

        $availableSlots = [];
        $baseDate = Carbon::parse($dto->date);

        for ($h = $startHour; $h + $hours <= $endHour; $h++) {
            $slotStart = $baseDate->copy()->setTime($h, 0);
            $slotEnd = $slotStart->copy()->addHours($hours);

            if ($isToday && $slotStart->lt($now)) {
                continue;
            }

            $occupied = 0;

            foreach ($bookings as $booking) {
                $bStart = Carbon::parse($booking->date);
                $bEnd = $bStart->copy()->addHours($booking->duration);

                if ($slotStart->lt($bEnd) && $slotEnd->gt($bStart)) {
                    $occupied += $booking->peoples;
                }
            }

            $freeSpots = $maxCapacity - $occupied;

            if ($freeSpots >= $dto->peoples) {
                $availableSlots[] = [
                    'time' => $slotStart->format('H:i'),
                    'free_spots' => $freeSpots,
                ];
            }
        }

        return response()->json($availableSlots);
    }
}
