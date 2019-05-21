<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

    public function following(){
      $id = Auth::id();
      $user = User::find($id);
      $followers = $user->followers;
      $followings = $user->follows;
      $counts = $followings->count();

      return view('follow', compact('user','followers','followings','counts'));
    }

    public function follower(){
      $id = Auth::id();
      $user = User::find($id);
      $followers = $user->followers;
      $followings = $user->follows;
      $counts = $followers->count();

      return view('follower', compact('user','followers','followings','counts'));
    }
}
