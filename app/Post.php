<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
  /**
   * この投稿を所有するUserを取得
   */
  public function user()
  {
      return $this->belongsTo('App\User');
  }

  public function comment()
  {
      return $this->hasMany('App\Comment');
  }

  public function likeuser()
  {
      return $this->belongsTo('App\User');
  }

  public function likes()
  {
      return $this->hasMany('App\Like');
  }
  public function quest()
  {
      return $this->belongsTo('App\Quest');
  }
  public function achievement()
  {
      return $this->belongsTo('App\Achievement');
  }
}
