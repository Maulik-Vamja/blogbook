<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads_offer extends Model
{
    public function ads_post()
    {
        return $this->hasMany('App\Ads_post','offer_id','id');
    }
}
