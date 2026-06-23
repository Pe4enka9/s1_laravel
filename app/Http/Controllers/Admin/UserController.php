<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AddCommentDto;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    // Получение всех пользователей
    public function index(): JsonResponse
    {
        $users = User::where('is_admin', false)->get();

        return response()->json(UserResource::collection($users));
    }

    // Оставить комментарий к пользователю
    public function addComment(
        User          $user,
        AddCommentDto $dto,
    ): JsonResponse
    {
        $user->update(['comment' => $dto->comment]);

        return response()->json(['success' => true]);
    }
}
