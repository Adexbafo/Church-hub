<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'start_time',
        'end_time',
        'venue',
        'category',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];
}
