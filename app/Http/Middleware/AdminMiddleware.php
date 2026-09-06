<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        if (! auth()->check()) {
            abort(403);
        }

        if (! auth()->user()->hasAnyRole(Role::administrative())) {
            abort(403);
        }

        return $next($request);
    }
}
