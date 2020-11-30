<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads_post extends Model
{
    public function offer()
    {
        return $this->hasOne('App\Ads_offer','id','offer_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','author_id','id');
    }
    public function scopePaid($query)
    {
        return $query->where('trans_status', true);
    }
}

