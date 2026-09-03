<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sermon extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'speaker',
        'scripture',
        'sermon_date',
        'description',
        'audio_media_item_id',
        'video_media_item_id',
        'notes_media_item_id',
        'created_by',
        'is_featured',
        'is_published',
    ];

    public function audio(): BelongsTo
    {
        return $this->belongsTo(MediaItem::class, 'audio_media_item_id');
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(MediaItem::class, 'video_media_item_id');
    }

    public function notes(): BelongsTo
    {
        return $this->belongsTo(MediaItem::class, 'notes_media_item_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
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
