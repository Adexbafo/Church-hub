<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaAlbum extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image_path',
        'event_date',
        'created_by',
        'is_published',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function mediaItems()
    {
        return $this->hasMany(MediaItem::class);
    }

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'is_published' => 'boolean',
        ];
    }
}
