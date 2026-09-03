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
    private const PERMISSION_MAP = [
        'dashboard' => Permission::FINANCIAL_DASHBOARD_VIEW,
        'donations' => Permission::DONATIONS_VIEW,
        'expenses' => Permission::EXPENSES_VIEW,
        'reports' => Permission::FINANCIAL_REPORTS_VIEW,
        'exports' => Permission::FINANCIAL_REPORTS_EXPORT,
        'audit' => Permission::AUDIT_LOGS_VIEW,
    ];
    public function handle(
        Request $request,
        Closure $next,
        string $permission
    ): Response {
        /** @var User $user */
        $user = Auth::user();

        abort_if(! $user, 403);

        $permissionEnum = self::PERMISSION_MAP[$permission] ?? null;

        abort_if(
            ! $permissionEnum || ! $user->can($permissionEnum->value),
            403
        );

        return $next($request);
    }
}
