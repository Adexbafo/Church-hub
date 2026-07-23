<?php

namespace App\Http\Controllers;

use App\Enums\Role as RoleEnum;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole(RoleEnum::SUPER_ADMIN->value)) {
            return redirect()->route('admin.dashboard');
        }

        return view('dashboard');
    }
}
