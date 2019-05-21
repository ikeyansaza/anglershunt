<?php

namespace App\Http\Controllers;
use App\Notifications\UserFollowed;
use Illuminate\Http\Request;
use App\User;
use App\Follower;
use Carbon\Carbon;

class UsersController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function notifications()
    {
      $notices = auth()->user()->unreadNotifications()->limit(5)->get();
      $oldnotices = auth()->user()->readNotifications()->limit(5)->get();

      $now = Carbon::now();
      Carbon::setLocale('ja');

      return view('notice/notice', compact('notices','now','oldnotices'));
    }

  public function index()
   {
       $users = User::where('id', '!=', auth()->user()->id)->get();
       return view('users.index', compact('users'));
   }

  public function follow(User $user)
   {
       $follower = auth()->user();
       if ($follower->id == $user->id) {
           return back()->withError("You can't follow yourself");
       }
       if(!$follower->isFollowing($user->id)) {
           $follower->follow($user->id);

           $user->notify(new UserFollowed($follower));

           return back()->withSuccess("You are now friends with {$user->name}");
       }
       return back()->withError("You are already following {$user->name}");
   }

   public function unfollow(User $user)
   {
       $follower = auth()->user();
       if($follower->isFollowing($user->id)) {
           $follower->unfollow($user->id);
           return back()->withSuccess("You are no longer friends with {$user->name}");
       }
       return back()->withError("You are not following {$user->name}");
   }

   public function delete(Request $request)
   {
     Follower::where('user_id',$request->id)
             ->Orwhere('follows_id',$request->id)
             ->delete();

     User::find($request->id)->delete();

     return redirect('login');
   }

}
