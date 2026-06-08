<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'gender',
        'date_of_birth',
        'address',
        'occupation',
        'marital_status',
        'profile_picture',
        'joined_at',
        'is_baptized',
        'membership_status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'joined_at' => 'date',
        'is_baptized' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}