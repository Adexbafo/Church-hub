<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sermon extends Model
{
    protected $fillable = [
        'title',
        'speaker',
        'scripture',
        'sermon_date',
        'description',
        'audio_media_item_id',
        'video_media_item_id',
        'notes_media_item_id',
        'is_featured',
        'is_published',
    ];

    public function audio()
    {
        return $this->belongsTo(MediaItem::class, 'audio_media_item_id');
    }

    public function video()
    {
        return $this->belongsTo(MediaItem::class, 'video_media_item_id');
    }

    public function notes()
    {
        return $this->belongsTo(MediaItem::class, 'notes_media_item_id');
    }

    protected function casts(): array
    {
        return [
            'sermon_date' => 'date',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }
}
