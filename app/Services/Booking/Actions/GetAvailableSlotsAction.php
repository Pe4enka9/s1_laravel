<?php

namespace App\Services\Booking\Actions;

use App\Http\Requests\SlotDto;
use App\Models\Booking\Booking;
use App\Models\Booking\Enums\BookingStatusEnum;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class GetAvailableSlotsAction
{
    private const int MAX_CAPACITY = 5;

    public function __invoke(SlotDto $dto): array
    {
        $now = now();

        $selectedDate = Carbon::parse($dto->date)->startOfDay();
        $isToday = $selectedDate->isSameDay($now);

        $bookings = Booking::whereDate('date', $dto->date)
            ->whereNot('status', BookingStatusEnum::CANCELLED)
            ->get(['date', 'duration', 'peoples']);

        $availableSlots = [];

        $dayStart = $selectedDate->copy();
        $dayEnd = $selectedDate->copy()->endOfDay();

        for (
            $slotStart = $dayStart->copy();
            $slotStart->lt($dayEnd);
            $slotStart->addMinutes(30)
        ) {
            if (!$this->isSlotAvailableForBooking(
                $slotStart,
                $selectedDate,
                $now,
                $isToday,
            )) {
                continue;
            }

            $slotEnd = $slotStart->copy()->addHours($dto->duration);

            $occupied = $this->calculateOccupiedPlaces(
                $slotStart,
                $slotEnd,
                $bookings,
            );

            $freeSpots = self::MAX_CAPACITY - $occupied;

            if ($freeSpots < $dto->peoples) {
                continue;
            }

            $availableSlots[] = [
                'time' => $slotStart->format('H:i'),
                'free_spots' => $freeSpots,
            ];
        }

        return $availableSlots;
    }

    private function isSlotAvailableForBooking(
        Carbon $slotStart,
        Carbon $selectedDate,
        Carbon $now,
        bool   $isToday,
    ): bool
    {
        if (!$isToday) {
            return true;
        }

        if ($slotStart->lt($now)) {
            return false;
        }

        if (
            $this->isPreBookingSlot($slotStart) &&
            $now->greaterThanOrEqualTo(
                $selectedDate->copy()->setTime(3, 0)
            )
        ) {
            return false;
        }

        return true;
    }

    private function isPreBookingSlot(Carbon $slot): bool
    {
        return $slot->hour >= 3
            && $slot->hour < 14;
    }

    private function calculateOccupiedPlaces(
        Carbon     $slotStart,
        Carbon     $slotEnd,
        Collection $bookings,
    ): int
    {
        $occupied = 0;

        foreach ($bookings as $booking) {
            $bookingStart = Carbon::parse($booking->date);
            $bookingEnd = $bookingStart->copy()->addHours($booking->duration);

            if (
                $slotStart->lt($bookingEnd) &&
                $slotEnd->gt($bookingStart)
            ) {
                $occupied += $booking->peoples;
            }
        }

        return $occupied;
    }
}
