<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AuditHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Expenses\StoreExpenseRequest;
use App\Http\Requests\Expenses\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\FinancialTransaction;
use App\Models\FundCategory;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::with('fundCategory')
            ->latest()
            ->paginate(10);

        return view(
            'admin.expenses.index',
            compact('expenses')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = FundCategory::where(
            'is_active',
            true
        )->orderBy('name')->get();

        return view(
            'admin.expenses.create',
            compact('categories')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreExpenseRequest $request
    ) {
        $validated = $request->validated();

        $validated['recorded_by'] = auth()->id();

        DB::transaction(function () use ($validated) {

            $expense = Expense::create($validated);

            AuditHelper::log(
                'create',
                'Created expense: ' . $expense->expense_title,
                $expense
            );

            FinancialTransaction::create([

                'fund_category_id' => $expense->fund_category_id,

                'amount' => $expense->amount,

                'transaction_type' => 'expense',

                'status' => 'completed',

                'reference' => $expense->reference,

                'description' => 'Expense - ' .
                    $expense->expense_title,

                'transaction_date' => $expense->expense_date,

                'recorded_by' => auth()->id(),

            ]);
        });

        return redirect()
            ->route('admin.expenses.index')
            ->with(
                'success',
                'Expense recorded successfully.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        $expense->load('fundCategory');

        return view(
            'admin.expenses.show',
            compact('expense')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $categories = FundCategory::where(
            'is_active',
            true
        )->orderBy('name')->get();

        return view(
            'admin.expenses.edit',
            compact(
                'expense',
                'categories'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateExpenseRequest $request,
        Expense $expense
    ) {
        $validated = $request->validated();

        DB::transaction(function () use ($expense, $validated) {

            $expense->update($validated);

            AuditHelper::log(
                'update',
                'Updated expense: ' . $expense->expense_title,
                $expense
            );

            FinancialTransaction::where(
                'reference',
                $expense->reference
            )->update([

                'fund_category_id' => $expense->fund_category_id,

                'amount' => $expense->amount,

                'transaction_date' => $expense->expense_date,

                'description' => 'Expense - ' .
                    $expense->expense_title,

            ]);
        });

        return redirect()
            ->route('admin.expenses.index')
            ->with(
                'success',
                'Expense updated successfully.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Expense $expense
    ) {
        DB::transaction(function () use ($expense) {

            FinancialTransaction::where(
                'reference',
                $expense->reference
            )->delete();

            AuditHelper::log(
                'delete',
                'Deleted expense: ' . $expense->expense_title,
                $expense
            );

            $expense->delete();
        });

        return redirect()
            ->route('admin.expenses.index')
            ->with(
                'success',
                'Expense deleted successfully.'
            );
    }
}
