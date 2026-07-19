<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livestream extends Model
{
    protected $fillable = [
        'title',
        'platform',
        'stream_url',
        'scheduled_at',
        'status',
        'description',
        'recording_media_item_id',
        'created_by',
        'is_published',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function recording()
    {
        return $this->belongsTo(MediaItem::class, 'recording_media_item_id');
    }

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
            'is_published' => 'boolean',
        ];
    }
}
