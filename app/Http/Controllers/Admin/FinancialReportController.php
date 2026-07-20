<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinancialTransaction;
use App\Models\FundCategory;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinancialReportController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->from
            ? Carbon::parse($request->from)
            : now()->startOfMonth();

        $to = $request->to
            ? Carbon::parse($request->to)
            : now()->endOfMonth();

        $income = FinancialTransaction::where(
            'transaction_type',
            'income'
        )
            ->whereBetween(
                'transaction_date',
                [$from, $to]
            )
            ->sum('amount');

        $expenses = FinancialTransaction::where(
            'transaction_type',
            'expense'
        )
            ->whereBetween(
                'transaction_date',
                [$from, $to]
            )
            ->sum('amount');

        $balance = $income - $expenses;

        $transactions = FinancialTransaction::with(
            'fundCategory'
        )
            ->whereBetween(
                'transaction_date',
                [$from, $to]
            )
            ->latest()
            ->paginate(20);

        $categoryReports = FundCategory::withSum(
            [
                'financialTransactions as income_total' => function ($query) {
                    $query->where(
                        'transaction_type',
                        'income'
                    );
                },
            ],
            'amount'
        )
            ->withSum(
                [
                    'financialTransactions as expense_total' => function ($query) {
                        $query->where(
                            'transaction_type',
                            'expense'
                        );
                    },
                ],
                'amount'
            )
            ->get();

        $incomeByCategory = FinancialTransaction::select(
            'fund_category_id'
        )
            ->selectRaw('SUM(amount) as total')
            ->where('transaction_type', 'income')
            ->whereBetween(
                'transaction_date',
                [$from, $to]
            )
            ->groupBy('fund_category_id')
            ->with('fundCategory')
            ->get();

        $expenseByCategory = FinancialTransaction::select(
            'fund_category_id'
        )
            ->selectRaw('SUM(amount) as total')
            ->where('transaction_type', 'expense')
            ->whereBetween(
                'transaction_date',
                [$from, $to]
            )
            ->groupBy('fund_category_id')
            ->with('fundCategory')
            ->get();

        $chartData = [
            'income' => $income,
            'expenses' => $expenses,
        ];

        return view(
            'admin.financial.reports.index',
            compact(
                'from',
                'to',
                'income',
                'expenses',
                'balance',
                'transactions',
                'categoryReports',
                'chartData'
            )
        );
    }

    public function exportCsv(Request $request)
    {
        $from = $request->from
            ? Carbon::parse($request->from)
            : now()->startOfMonth();

        $to = $request->to
            ? Carbon::parse($request->to)
            : now()->endOfMonth();

        $transactions = FinancialTransaction::with('fundCategory')
            ->whereBetween('transaction_date', [$from, $to])
            ->latest()
            ->get();

        $filename = 'financial-report-'.now()->format('Y-m-d-His').'.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function () use ($transactions) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Date',
                'Description',
                'Category',
                'Type',
                'Amount',
            ]);

            foreach ($transactions as $transaction) {
                fputcsv($file, [
                    $transaction->transaction_date->format('Y-m-d'),
                    $transaction->description,
                    $transaction->fundCategory?->name,
                    ucfirst($transaction->transaction_type),
                    $transaction->amount,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $from = $request->from
            ? Carbon::parse($request->from)
            : now()->startOfMonth();

        $to = $request->to
            ? Carbon::parse($request->to)
            : now()->endOfMonth();

        $transactions = FinancialTransaction::with('fundCategory')
            ->whereBetween(
                'transaction_date',
                [$from, $to]
            )
            ->latest()
            ->get();

        $income = $transactions
            ->where('transaction_type', 'income')
            ->sum('amount');

        $expenses = $transactions
            ->where('transaction_type', 'expense')
            ->sum('amount');

        $balance = $income - $expenses;

        $pdf = Pdf::loadView(
            'admin.financial.reports.pdf',
            compact(
                'transactions',
                'from',
                'to',
                'income',
                'expenses',
                'balance'
            )
        );

        return $pdf->download(
            'financial-report-'.
                now()->format('Y-m-d-His').
                '.pdf'
        );
    }
}
