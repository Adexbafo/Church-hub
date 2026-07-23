<?php

namespace App\Http\Middleware;

use App\Enums\Permission;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FinancialPermissionMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        string $permission
    ): Response {
        /** @var User $user */
        $user = Auth::user();

        if (! $user) {
            abort(403);
        }

        $allowed = match ($permission) {
            'dashboard' => $user->can(Permission::FINANCIAL_DASHBOARD_VIEW->value),

            'donations' => $user->can(Permission::DONATIONS_VIEW->value),

            'expenses' => $user->can(Permission::EXPENSES_VIEW->value),

            'reports' => $user->can(Permission::FINANCIAL_REPORTS_VIEW->value),

            'exports' => $user->can(Permission::FINANCIAL_REPORTS_EXPORT->value),

            'audit' => $user->can(Permission::AUDIT_LOGS_VIEW->value),

            default => false,
        };

        abort_unless($allowed, 403);

        return $next($request);
    }
}
