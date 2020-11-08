<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    public function quest()
    {
        return $this->belongsTo('App\Quest');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
