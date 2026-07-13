<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'fund_category_id',
        'donor_name',
        'amount',
        'payment_method',
        'reference',
        'receipt_number',
        'notes',
        'donation_date',
    ];

    protected $casts = [
        'donation_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fundCategory()
    {
        return $this->belongsTo(FundCategory::class);
    }
}
