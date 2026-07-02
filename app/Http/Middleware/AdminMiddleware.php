<?php

namespace App\Http\Middleware;

use App\Models\User\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->role === RoleEnum::USER) {
            return response()->json([], 403);
        }

        return $next($request);
    }
}
