<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'description', 'auction_end', 'image_url','item_owner'];

    public function bids()
    {
        return $this->hasMany(Auction::class);
    }

    public function itemOwner()
    {
        return $this->belongsTo(User::class,'item_owner');
    }

    public function automaticItems()
    {
        return $this->hasMany(AutomaticOffer::class, 'item_id');
    }
}
