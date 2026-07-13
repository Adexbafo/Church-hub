<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'title',
        'category',
        'amount',
        'reference',
        'description',
        'expense_date',
        'recorded_by',
    ];

    protected $casts = [
        'expense_date' => 'date',
    ];

    public function recorder()
    {
        return $this->belongsTo(
            User::class,
            'recorded_by'
        );
    }
}
