<?php

use App\Models\Booking\Enums\BookingStatusEnum;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->nullable()->constrained();
            $table->string('phone');
            $table->dateTime('date');
            $table->unsignedTinyInteger('duration');
            $table->unsignedTinyInteger('peoples');
            $table->string('status')->default(BookingStatusEnum::PENDING);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
