<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AddCommentDto;
use App\Http\Requests\Booking\StatusDto;
use App\Http\Resources\Admin\UserResource;
use App\Http\Resources\BookingResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Получение всех пользователей
    public function index(Request $request): JsonResponse
    {
        $users = User::when($request->phone, function (Builder $query) use ($request) {
            $query->where('phone', 'like', "%$request->phone%");
        })
            ->where('is_admin', false)
            ->get();

        return response()->json(UserResource::collection($users));
    }

    // Получение пользователя
    public function show(User $user, StatusDto $dto): JsonResponse
    {
        $bookings = $user->bookings()
            ->when($dto->status, function (Builder $query) use ($dto) {
                $query->where('status', $dto->status);
            })
            ->paginate(5);

        return response()->json([
            'user' => new UserResource($user),
            'bookings' => BookingResource::collection($bookings),
            'pagination' => [
                'current_page' => $bookings->currentPage(),
                'last_page' => $bookings->lastPage(),
            ],
        ]);
    }

    // Оставить комментарий к пользователю
    public function addComment(
        User          $user,
        AddCommentDto $dto,
    ): JsonResponse
    {
        $user->update(['comment' => $dto->comment]);

        return response()->json(new UserResource($user));
    }
}
