<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BiddingConfig extends Model
{
    use SoftDeletes;

    protected $fillable = ['amount','aux_amount','percentage_amount', 'is_send_notification'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
