<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaItem extends Model
{
    protected $fillable = [
        'media_category_id',
        'media_album_id',
        'title',
        'description',
        'file_name',
        'original_name',
        'media_type',
        'file_path',
        'mime_type',
        'file_size',
        'thumbnail_path',
        'uploaded_by',
        'views',
        'downloads',
        'is_featured',
        'is_published',
    ];

    public function category()
    {
        return $this->belongsTo(MediaCategory::class, 'media_category_id');
    }

    public function album()
    {
        return $this->belongsTo(MediaAlbum::class, 'media_album_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function audioSermons()
    {
        return $this->hasMany(Sermon::class, 'audio_media_item_id');
    }

    public function videoSermons()
    {
        return $this->hasMany(Sermon::class, 'video_media_item_id');
    }

    public function noteSermons()
    {
        return $this->hasMany(Sermon::class, 'notes_media_item_id');
    }

    public function livestreamRecording()
    {
        return $this->hasOne(Livestream::class, 'recording_media_item_id');
    }

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    public function getFormattedFileSizeAttribute(): string
    {
        $bytes = $this->file_size;

        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2).' GB';
        }

        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2).' MB';
        }

        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 2).' KB';
        }

        return $bytes.' B';
    }

    public function getMediaTypeBadgeAttribute(): string
    {
        return match ($this->media_type) {

            'image' => '🖼️ Image',

            'video' => '🎥 Video',

            'audio' => '🎵 Audio',

            default => '📄 Document',
        };
    }
}
