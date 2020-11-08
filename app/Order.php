<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function quest()
    {
        return $this->belongsTo('App\Quest');
    }
}
