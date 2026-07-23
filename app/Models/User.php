<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable([
    'name',
    'email',
    'password',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function member(): HasOne
    {
        return $this->hasOne(Member::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function financialTransactions()
    {
        return $this->hasMany(
            FinancialTransaction::class,
            'recorded_by'
        );
    }

    public function mediaAlbums()
    {
        return $this->hasMany(MediaAlbum::class, 'created_by');
    }

    public function mediaUploads()
    {
        return $this->hasMany(MediaItem::class, 'uploaded_by');
    }

    public function mediaTeams()
    {
        return $this->hasMany(MediaTeam::class);
    }
    public function livestreams()
    {
        return $this->hasMany(Livestream::class, 'created_by');
    }

    public function sermons()
    {
        return $this->hasMany(Sermon::class, 'created_by');
    }
}
