<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'created_by',
        'title',
        'message',
        'category',
        'type',
        'audience',
        'link',
        'priority',
        'attachment',
        'published_at',
        'expires_at',
        'read_at',
        'is_active',
        'is_pinned',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'expires_at' => 'datetime',
        'read_at' => 'datetime',
        'is_active' => 'boolean',
        'is_pinned' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopePinned(Builder $query): Builder
    {
        return $query->where('is_pinned', true);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where(function ($query) {

            $query->whereNull('published_at')
                ->orWhere('published_at', '<=', now());
        });
    }

    public function scopeNotExpired(Builder $query): Builder
    {
        return $query->where(function ($query) {

            $query->whereNull('expires_at')
                ->orWhere('expires_at', '>', now());
        });
    }

    public function scopeUnread(Builder $query): Builder
    {
        return $query->whereNull('read_at');
    }
}
