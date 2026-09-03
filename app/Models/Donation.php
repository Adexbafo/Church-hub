<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;

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

    protected function casts(): array
    {
        return [
            'donation_date' => 'date',
            'amount' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fundCategory(): BelongsTo
    {
        return $this->belongsTo(FundCategory::class);
    }
}
