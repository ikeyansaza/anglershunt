<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    public function order()
    {
        return $this->hasMany('App\Order');
    }

    public function achievement()
    {
        return $this->hasMany('App\Achievement');
    }
}
