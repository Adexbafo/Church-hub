<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\FundCategory;
use App\Models\FinancialTransaction;
use App\Helpers\AuditHelper;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donations = Donation::with('fundCategory')
            ->latest()
            ->paginate(10);

        return view(
            'admin.donations.index',
            compact('donations')
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
            'admin.donations.create',
            compact('categories')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'user_id' => 'nullable|exists:users,id',

            'donor_name' => [
                'nullable',
                'string',
                'max:255'
            ],

            'fund_category_id' => [
                'required',
                'exists:fund_categories,id'
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0'
            ],

            'payment_method' => [
                'required',
                'string'
            ],

            'reference' => [
                'nullable',
                'string'
            ],

            'notes' => [
                'nullable',
                'string'
            ],

            'donation_date' => [
                'required',
                'date'
            ],

        ]);

        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
        }

        $validated['receipt_number'] =
            'REC-' . now()->format('YmdHis');

        $validated['reference'] = $validated['receipt_number'];

        $donation = Donation::create($validated);

        AuditHelper::log(
            'create',
            'Created donation: ' . $donation->donor_name,
            $donation
        );

        FinancialTransaction::create([

            'fund_category_id' => $donation->fund_category_id,

            'user_id' => $donation->user_id,

            'amount' => $donation->amount,

            'transaction_type' => 'income',

            'status' => 'completed',

            'reference' => $donation->reference,

            'description' =>
            'Donation - ' .
                $donation->fundCategory->name,

            'transaction_date' =>
            $donation->donation_date,

            'recorded_by' => auth()->id(),

        ]);

        return redirect()
            ->route('admin.donations.index')
            ->with(
                'success',
                'Donation recorded successfully.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(Donation $donation)
    {
        $donation->load('fundCategory', 'user');

        return view(
            'admin.donations.show',
            compact('donation')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donation $donation)
    {
        $categories = FundCategory::where(
            'is_active',
            true
        )->orderBy('name')->get();

        return view(
            'admin.donations.edit',
            compact(
                'donation',
                'categories'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        Donation $donation
    ) {

        $validated = $request->validate([
            'donor_name' => 'nullable|string|max:255',

            'fund_category_id' => 'required|exists:fund_categories,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'reference' => 'nullable|string',
            'notes' => 'nullable|string',
            'donation_date' => 'required|date',

        ]);

        $donation->update($validated);

        AuditHelper::log(
            'update',
            'Updated donation: ' . $donation->donor_name,
            $donation
        );

        FinancialTransaction::where(
            'reference',
            $donation->reference
        )->update([

            'fund_category_id' =>
            $donation->fund_category_id,

            'amount' =>
            $donation->amount,

            'transaction_date' =>
            $donation->donation_date,

            'description' =>
            'Donation - ' .
                $donation->fundCategory->name,

        ]);

        return redirect()
            ->route('admin.donations.index')
            ->with(
                'success',
                'Donation updated successfully.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Donation $donation
    ) {
        FinancialTransaction::where(
            'reference',
            $donation->reference
        )->delete();

        AuditHelper::log(
            'delete',
            'Deleted donation: ' . $donation->donor_name,
            $donation
        );

        $donation->delete();

        return redirect()
            ->route('admin.donations.index')
            ->with(
                'success',
                'Donation deleted successfully.'
            );
    }
}
