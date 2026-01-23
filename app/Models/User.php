<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'couple_id',
        'love_language',
        'favorites',
        'pairing_code',
        'pairing_code_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    public function couple()
    {
        return $this->belongsTo(Couple::class);
    }

    public function energyLogs()
    {
        return $this->hasMany(EnergyLog::class);
    }

    public function savedInsights()
    {
        return $this->belongsToMany(Insight::class, 'insight_user')->withTimestamps();
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            // Set static pairing code for all users
            $user->pairing_code = 'ABCD1234';
        });
    }
}
