<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialTransaction extends Model
{
    protected $fillable = [
        'fund_category_id',
        'user_id',
        'amount',
        'transaction_type',
        'status',
        'reference',
        'description',
        'transaction_date',
        'recorded_by',
    ];

    protected $casts = [
        'transaction_date' => 'date',
    ];

    public function fundCategory()
    {
        return $this->belongsTo(FundCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recorder()
    {
        return $this->belongsTo(
            User::class,
            'recorded_by'
        );
    }
}
