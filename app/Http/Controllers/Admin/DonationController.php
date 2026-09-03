<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Helpers\AuditHelper;
use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\FinancialTransaction;
use App\Models\FundCategory;
use Illuminate\Http\Request;
use App\Http\Requests\Donations\StoreDonationRequest;
use App\Http\Requests\Donations\UpdateDonationRequest;
use Illuminate\Support\Str;

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
    public function store(StoreDonationRequest $request)
    {

        $validated = $request->validated();


        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
        }

        $validated['receipt_number'] = $this->generateReceiptNumber();
        $validated['reference'] = $validated['receipt_number'];

        DB::transaction(function () use ($validated) {

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

                'description' => 'Donation - ' .
                    $donation->fundCategory->name,

                'transaction_date' => $donation->donation_date,

                'recorded_by' => auth()->id(),

            ]);
        });

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
        UpdateDonationRequest $request,
        Donation $donation
    ) {

        $validated = $request->validated();

        DB::transaction(function () use ($donation, $validated) {

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

                'fund_category_id' => $donation->fund_category_id,

                'amount' => $donation->amount,

                'transaction_date' => $donation->donation_date,

                'description' => 'Donation - ' .
                    $donation->fundCategory->name,

            ]);
        });

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
        DB::transaction(function () use ($donation) {

            FinancialTransaction::where('reference', $donation->reference)
                ->first()?->delete();

            AuditHelper::log(
                'delete',
                'Deleted donation: ' . $donation->donor_name,
                $donation
            );

            $donation->delete();
        });

        return redirect()
            ->route('admin.donations.index')
            ->with(
                'success',
                'Donation deleted successfully.'
            );
    }

    private function generateReceiptNumber(): string
    {
        $today = now()->format('Ymd');

        $lastReceipt = Donation::whereDate('created_at', today())
            ->orderByDesc('id')
            ->value('receipt_number');

        $sequence = 1;

        if (
            $lastReceipt &&
            preg_match('/REC-\d{8}-(\d{6})/', $lastReceipt, $matches)
        ) {
            $sequence = (int) $matches[1] + 1;
        }

        return sprintf(
            'REC-%s-%06d',
            $today,
            $sequence
        );
    }
}
