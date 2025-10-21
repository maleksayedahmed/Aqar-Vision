<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'phone',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the agent record associated with the user.
     */
    public function agent()
    {
        return $this->hasOne(Agent::class);
    }

    /**
     * Get the agency record associated with the user.
     */
    public function agency()
    {
        return $this->hasOne(Agency::class);
    }

    /**
     * Get all of the ads for the user.
     */
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    /**
     * Get all upgrade requests for the user.
     */
    public function upgradeRequests()
    {
        return $this->hasMany(UpgradeRequest::class);
    }

    /**
     * Get the latest upgrade request for the user.
     */
    public function latestUpgradeRequest()
    {
        return $this->hasOne(UpgradeRequest::class)->latestOfMany();
    }

    /**
     * Get all favorite ads for the user.
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Get all favorite ads for the user with ad details.
     */
    public function favoriteAds()
    {
        return $this->belongsToMany(Ad::class, 'favorites')->withTimestamps();
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
