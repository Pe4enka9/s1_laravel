<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int|null $user_id
 * @property string|null $phone_number
 * @property Carbon $date
 * @property int $duration
 * @property int $number_of_people
 *
 * @property-read User $user
 */
class Booking extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
