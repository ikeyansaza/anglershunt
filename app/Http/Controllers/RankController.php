<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Achievement;
use App\Follower;
use App\Newspost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class RankController extends Controller
{

  public function index(){
    if(Auth::user()){
    $user = Auth::user();
    $users = User::orderBy('total_point', 'desc')
                   ->limit(5)
                   ->get();

    $dt = Carbon::now();
    $dt = $dt->month;

    $archievements = Achievement::whereMonth('created_at','=',$dt)
                                  ->get();

    $points = Achievement::select('user_id',DB::raw('SUM(point) as monthly_point'))
                ->whereMonth('created_at','=',$dt)
                ->groupBy('user_id')
                ->orderBy('monthly_point','desc')
                ->get();
    }else{
      $user = User::find(25);
      $users = User::find(25);
      $id = '25';
      $dt = Carbon::now();
      $archievements = Achievement::whereMonth('created_at','=',$dt)
                                    ->get();
      $points = Achievement::select('user_id',DB::raw('SUM(point) as monthly_point'))
                  ->whereMonth('created_at','=',$dt)
                  ->groupBy('user_id')
                  ->orderBy('monthly_point','desc')
                  ->get();
    }

    return view('rank/main', compact('user','users','points','archievements'));
  }

  public function history(Request $request){
    $user = Auth::user();
    $users = User::orderBy('total_point', 'desc')
                   ->limit(5)
                   ->get();

    $dt = $request->month;

    $archievements = Achievement::whereMonth('created_at','=',$dt)
                                  ->get();


    $points = Achievement::select('user_id',DB::raw('SUM(point) as monthly_point'))
                ->whereMonth('created_at','=',$dt)
                ->groupBy('user_id')
                ->orderBy('monthly_point','desc')
                ->get();

    return view('rank/history', compact('user','users','points','archievements','dt'));
  }

}
