<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusDto;
use App\Http\Resources\BookingResource;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(new UserResource(Auth::user()));
    }

    public function bookings(StatusDto $dto): JsonResponse
    {
        $status = $dto->status;

        $bookings = Auth::user()->bookings()
            ->when($status, function (Builder $query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(4);

        return response()->json([
            'data' => BookingResource::collection($bookings),
            'pagination' => [
                'current_page' => $bookings->currentPage(),
                'last_page' => $bookings->lastPage(),
            ],
        ]);
    }
}
