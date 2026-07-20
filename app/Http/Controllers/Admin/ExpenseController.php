<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AuditHelper;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\FinancialTransaction;
use App\Models\FundCategory;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $validated = $request->validate([

            'fund_category_id' => [
                'required',
                'exists:fund_categories,id',
            ],

            'expense_title' => [
                'required',
                'string',
                'max:255',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'payment_method' => [
                'nullable',
                'string',
            ],

            'reference' => [
                'nullable',
                'string',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'expense_date' => [
                'required',
                'date',
            ],
        ]);

        $validated['recorded_by'] = auth()->id();

        $expense = Expense::create($validated);

        AuditHelper::log(
            'create',
            'Created expense: '.$expense->expense_title,
            $expense
        );

        FinancialTransaction::create([

            'fund_category_id' => $expense->fund_category_id,

            'amount' => $expense->amount,

            'transaction_type' => 'expense',

            'status' => 'completed',

            'reference' => $expense->reference,

            'description' => 'Expense - '.
                $expense->expense_title,

            'transaction_date' => $expense->expense_date,

            'recorded_by' => auth()->id(),
        ]);

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
        Request $request,
        Expense $expense
    ) {
        $validated = $request->validate([

            'expense_title' => [
                'required',
                'string',
                'max:255',
            ],

            'fund_category_id' => [
                'required',
                'exists:fund_categories,id',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'payment_method' => [
                'required',
                'string',
            ],

            'reference' => [
                'nullable',
                'string',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'expense_date' => [
                'required',
                'date',
            ],
        ]);

        $expense->update($validated);

        AuditHelper::log(
            'update',
            'Updated expense: '.$expense->expense_title,
            $expense
        );

        FinancialTransaction::where(
            'reference',
            $expense->reference
        )->update([

            'fund_category_id' => $expense->fund_category_id,

            'amount' => $expense->amount,

            'transaction_date' => $expense->expense_date,

            'description' => 'Expense - '.
                $expense->expense_title,
        ]);

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
        FinancialTransaction::where(
            'reference',
            $expense->reference
        )->delete();

        AuditHelper::log(
            'delete',
            'Deleted expense: '.$expense->expense_title,
            $expense
        );

        $expense->delete();

        return redirect()
            ->route('admin.expenses.index')
            ->with(
                'success',
                'Expense deleted successfully.'
            );
    }
}
