<?php

namespace App\Models\Booking\Enums;

enum BookingStatusEnum: string
{
    case PENDING = 'pending';
    case SUCCESS = 'success';
    case CANCELLED = 'cancelled';
    case FINISHED = 'finished';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Ожидание',
            self::SUCCESS => 'Подтверждено',
            self::CANCELLED => 'Отменено',
            self::FINISHED => 'Завершено',
        };
    }
}
