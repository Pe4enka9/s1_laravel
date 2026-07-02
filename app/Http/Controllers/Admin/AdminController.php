<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddAvatarDto;
use App\Http\Resources\UserResource;
use App\Models\User\RoleEnum;
use App\Models\User\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Получить всех администраторов
    public function index(): JsonResponse
    {
        $admins = User::whereIn('role', [RoleEnum::ADMIN, RoleEnum::OWNER])
            ->latest()
            ->get();

        return response()->json(UserResource::collection($admins));
    }

    // Установить аватар администратору
    public function update(
        User         $user,
        AddAvatarDto $dto,
    ): JsonResponse
    {
        $path = $dto->avatar->store('admins/avatars', 'public');

        $user->update(['avatar' => $path]);

        return response()->json(new UserResource($user));
    }

    // Получить текущего администратора
    public function current(): JsonResponse
    {
        $admin = User::firstWhere('is_current_admin', true);

        return response()->json([
            'avatar' => $admin->avatar_url,
            'name' => $admin->name,
        ]);
    }

    // Установить текущего администратора
    public function setCurrent(Request $request): JsonResponse
    {
        $request->validate(['admin' => ['required']]);

        $admins = User::where('is_current_admin', true)->get();

        foreach ($admins as $admin) {
            $admin->update(['is_current_admin' => false]);
        }

        $currentAdmin = User::find($request->admin);
        $currentAdmin->update(['is_current_admin' => true]);

        return response()->json([
            'avatar' => $currentAdmin->avatar_url,
            'name' => $currentAdmin->name,
        ]);
    }
}
