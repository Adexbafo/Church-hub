<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Expense;
use App\Models\FinancialTransaction;

class FinancialDashboardController extends Controller
{
    public function index()
    {
        $totalIncome = FinancialTransaction::where(
            'transaction_type',
            'income'
        )->sum('amount');

        $totalExpenses = FinancialTransaction::where(
            'transaction_type',
            'expense'
        )->sum('amount');

        $currentBalance = $totalIncome - $totalExpenses;

        $thisMonthGiving = Donation::whereMonth(
            'donation_date',
            now()->month
        )
            ->whereYear(
                'donation_date',
                now()->year
            )
            ->sum('amount');

        $recentTransactions = FinancialTransaction::latest()
            ->take(5)
            ->get();

        $recentDonations = Donation::latest()
            ->take(5)
            ->get();

        $recentExpenses = Expense::latest()
            ->take(5)
            ->get();

        return view(
            'admin.financial.dashboard',
            compact(
                'totalIncome',
                'totalExpenses',
                'currentBalance',
                'thisMonthGiving',
                'recentTransactions',
                'recentDonations',
                'recentExpenses'
            )
        );
    }
}
