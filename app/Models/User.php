<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Scopes\VerifiedUsersScope;

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
        'full_name',  
        'email',
        'password',
        'email_verified_at',
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

    public function address()
    {
        return $this->hasOne(Address::class);
    }
    
        public static function booted(): void
    {

        static::addGlobalScope(new VerifiedUsersScope);

        static::creating(function ($user) {
            // Only set full_name if it's empty
            if (empty($user->full_name) && !empty($user->first_name) && !empty($user->last_name)) {
                $user->full_name = trim($user->first_name . ' ' . $user->last_name);
            }

            // Only set name if it's empty
            if (empty($user->name)) {
                $user->name = $user->full_name ?? ($user->first_name ?? 'Unknown');
            }
        });
    }

        public function getInitialsAttribute()
    {
        $firstInitial = strtoupper(substr($this->first_name, 0, 1));
        $lastInitial = strtoupper(substr($this->last_name, 0, 1));

        return $firstInitial . $lastInitial;
    }
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = strtoupper($value);
    }

    public function scopeActiveSince($query, $date)
    {
        return $query->whereNotNull('email_verified_at')
                    ->where('created_at', '>=', $date);
    }

    
}