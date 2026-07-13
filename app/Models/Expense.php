<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'fund_category_id',
        'amount',
        'expense_title',
        'description',
        'payment_method',
        'reference',
        'expense_date',
        'recorded_by',
    ];

    protected $casts = [
        'expense_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function fundCategory()
    {
        return $this->belongsTo(FundCategory::class);
    }

    public function recorder()
    {
        return $this->belongsTo(
            User::class,
            'recorded_by'
        );
    }
}
