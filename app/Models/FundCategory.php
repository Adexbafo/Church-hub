<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    public function transactions()
    {
        return $this->hasMany(FinancialTransaction::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
