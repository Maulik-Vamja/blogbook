<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Followship extends Model
{
    public function user1()
    {
        return $this->belongsTo('App\User');
    }
    public function user2()
    {
        return $this->belongsTo('App\User');
    }
}
