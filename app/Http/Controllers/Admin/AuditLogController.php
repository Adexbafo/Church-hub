<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = AuditLog::with('user')

            ->when($request->filled('action'), function ($query) use ($request) {
                $query->where('action', $request->action);
            })

            ->when($request->filled('user'), function ($query) use ($request) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->user . '%');
                });
            })

            ->when($request->filled('from'), function ($query) use ($request) {
                $query->whereDate('created_at', '>=', $request->from);
            })

            ->when($request->filled('to'), function ($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->to);
            })

            ->latest()

            ->paginate(20)

            ->withQueryString();

        return view(
            'admin.audit-logs.index',
            compact('logs')
        );
    }
}
