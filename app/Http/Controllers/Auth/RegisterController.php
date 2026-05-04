<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterDto;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterDto $dto): JsonResponse
    {
        $user = User::create([
            'phone' => $dto->phone,
            'password' => Hash::make($dto->password),
        ]);

        Auth::guard('web')->login($user);

        request()->session()->regenerate();

        return response()->json(new UserResource($user), 201);
    }
}
