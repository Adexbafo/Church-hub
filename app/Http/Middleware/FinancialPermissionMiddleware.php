<?php

namespace App\Http\Middleware;

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
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user) {
            abort(403);
        }

        $allowed = match ($permission) {
            'dashboard' => $user->hasFinancialAccess(),
            'donations' => $user->canManageDonations(),
            'expenses' => $user->canManageExpenses(),
            'reports' => $user->hasFinancialAccess(),
            'exports' => $user->canExportFinancialReports(),
            'audit' => $user->canViewAuditLogs(),
            default => false,
        };

        abort_unless($allowed, 403);

        return $next($request);
    }
}
