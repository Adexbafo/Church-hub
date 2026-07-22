<?php

namespace App\Http\Middleware;

use App\Enums\Role as RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (
            ! auth()->check() ||
            ! auth()->user()->hasRole(RoleEnum::SUPER_ADMIN->value)
        ) {
            abort(403);
        }

        return $next($request);
    }
}
