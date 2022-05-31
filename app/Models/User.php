<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bids()
    {
        return $this->hasMany(Auction::class);
    }

    public function awardedItems()
    {
        return $this->hasMany(Item::class,'item_owner');
    }

    public function findForPassport($identifier) {
        return $this->orWhere('email', $identifier)->orWhere('name', $identifier)->first();
    }

    public function config()
    {
        return $this->hasOne(BiddingConfig::class,'user_id');
    }
    public function automaticItems()
    {
        return $this->hasMany(AutomaticOffer::class,'user_id');
    }
}
