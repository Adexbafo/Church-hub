<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaTeam extends Model
{
    protected $fillable = [
        'user_id',
        'role',
        'joined_at',
        'is_active',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'joined_at' => 'date',
            'is_active' => 'boolean',
        ];
    }
}
