<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    protected $fillable = [
        'user_id',
        'membership_id',
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
        'next_of_kin_name',
        'next_of_kin_relationship',
        'next_of_kin_phone',
        'next_of_kin_address',
        'band_one',
        'band_two',
        'band_three',
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
