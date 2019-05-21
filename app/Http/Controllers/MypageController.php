<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Follower;
use App\Newspost;
use App\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MypageController extends Controller
{

  //ルーティングでパラメータを引き渡し
  public function album($user_address){
    if(Auth::user()){
    $user = Auth::user();
    $currentUserInfo = DB::table('users')->where('name_address', $user_address)->first();
    $data['userInfo'] = $currentUserInfo;

    //マイページでフォロー機能利用
    $users = User::where('id', '!=', auth()->user()->id)->get();

    $id = $currentUserInfo->id;

    //フォロー数の取得
    $follows = Follower::where('user_id', $id)->get(['follows_id'])->count();
    $followers = Follower::where('follows_id', $id)->get(['user_id'])->count();

    //アルバム画像の取得
    $photos = Post::where('user_id',$id)
                     ->orderBy('created_at', 'desc')
                     ->get();

    }else{
      $user = User::find(25);
      $currentUserInfo = DB::table('users')->where('name_address', $user_address)->first();
      $data['userInfo'] = $currentUserInfo;

      $id = $currentUserInfo->id;

      //フォロー数の取得
      $follows = Follower::where('user_id', $id)->get(['follows_id'])->count();
      $followers = Follower::where('follows_id', $id)->get(['user_id'])->count();

      //アルバム画像の取得
      $photos = Post::where('user_id',$id)
                       ->orderBy('created_at', 'desc')
                       ->get();
    }

    return view('mypage/album', compact('user','currentUserInfo','data','users','followers','follows','photos'));
  }
  public function quest($user_address){
    if(Auth::user()){
    $user = Auth::user();
    $id = Auth::id();
    $currentUserInfo = DB::table('users')->where('name_address', $user_address)->first();
    $data['userInfo'] = $currentUserInfo;

    //マイページでフォロー機能利用
    $users = User::where('id', '!=', auth()->user()->id)->get();

    $id = $currentUserInfo->id;

    //フォロー数の取得
    $follows = Follower::where('user_id', $id)->get(['follows_id'])->count();
    $followers = Follower::where('follows_id', $id)->get(['user_id'])->count();

    //投稿の取得
    $posts = Post::Where('user_id',$id)
                   ->whereNotNull('quest_id')
                   ->orderBy('created_at', 'desc')
                   ->simplePaginate(5);

    $now = Carbon::now();
    Carbon::setLocale('ja');

    $like = Like::where('user_id',$id)
                  ->first(['post_id']);
    }else{
    $user = User::find(25);
    $id = '25';
    $currentUserInfo = DB::table('users')->where('name_address', $user_address)->first();
    $data['userInfo'] = $currentUserInfo;

    //マイページでフォロー機能利用
    $users = User::where('id', '!=', $id)->get();

    $id = $currentUserInfo->id;

    //フォロー数の取得
    $follows = Follower::where('user_id', $id)->get(['follows_id'])->count();
    $followers = Follower::where('follows_id', $id)->get(['user_id'])->count();

    //投稿の取得
    $posts = Post::Where('user_id',$id)
                   ->whereNotNull('quest_id')
                   ->orderBy('created_at', 'desc')
                   ->simplePaginate(5);

    $now = Carbon::now();
    Carbon::setLocale('ja');

    $like = Like::where('user_id',$id)
                  ->first(['post_id']);
    }

    return view('mypage/quest', compact('user','currentUserInfo','data','users','followers','follows','posts','now','like'));
  }

  public function post($user_address){
    if(Auth::user()){
    $user = Auth::user();
    $id = Auth::id();
    $currentUserInfo = DB::table('users')->where('name_address', $user_address)->first();
    $data['userInfo'] = $currentUserInfo;

    //マイページでフォロー機能利用
    $users = User::where('id', '!=', auth()->user()->id)->get();

    $id = $currentUserInfo->id;

    //フォロー数の取得
    $follows = Follower::where('user_id', $id)->get(['follows_id'])->count();
    $followers = Follower::where('follows_id', $id)->get(['user_id'])->count();

    //投稿の取得
    $posts = Post::Where('user_id',$id)
                   ->whereNull('quest_id')
                   ->orderBy('created_at', 'desc')
                   ->simplePaginate(5);

    $now = Carbon::now();
    Carbon::setLocale('ja');

    $like = Like::where('user_id',$id)
                  ->first(['post_id']);
    }else{
    $user = User::find(25);
    $id = '25';
    $currentUserInfo = DB::table('users')->where('name_address', $user_address)->first();
    $data['userInfo'] = $currentUserInfo;

    //マイページでフォロー機能利用
    $users = User::where('id', '!=', $id)->get();

    $id = $currentUserInfo->id;

    //フォロー数の取得
    $follows = Follower::where('user_id', $id)->get(['follows_id'])->count();
    $followers = Follower::where('follows_id', $id)->get(['user_id'])->count();

    //投稿の取得
    $posts = Post::Where('user_id',$id)
                   ->whereNull('quest_id')
                   ->orderBy('created_at', 'desc')
                   ->simplePaginate(5);

    $now = Carbon::now();
    Carbon::setLocale('ja');

    $like = Like::where('user_id',$id)
                  ->first(['post_id']);
    }

    return view('mypage/post', compact('user','currentUserInfo','data','users','followers','follows','posts','now','like'));
    }

  public function favorite($user_address){
    $user = Auth::user();
    $currentUserInfo = DB::table('users')->where('name_address', $user_address)->first();
    $data['userInfo'] = $currentUserInfo;

    //マイページでフォロー機能利用
    $users = User::where('id', '!=', auth()->user()->id)->get();

    $id = $currentUserInfo->id;

    //フォロー数の取得
    $follows = Follower::where('user_id', $id)->get(['follows_id'])->count();
    $followers = Follower::where('follows_id', $id)->get(['user_id'])->count();

    //アルバム画像の取得
    $photos = Post::where('user_id',$id)
                    ->where('quest_id','NULL')
                     ->orderBy('created_at', 'desc')
                     ->get();

    $like = Like::where('user_id',$id)->get();

    $posts = Post::whereIn('id',$like)
                     ->orderBy('created_at', 'desc')
                     ->get();

    return view('mypage/favorite', compact('user','currentUserInfo','data','users','followers','follows','photos','like','posts'));
  }

  public function follow($user_address){
    $user = Auth::user();

    $now_user = User::where('name_address',$user_address)->first();

    $id = $now_user->id;

    $follows_id = Follower::where('user_id', $id)->get(['follows_id']);

    $followings = User::whereIn('id',$follows_id)
                     ->orderBy('created_at', 'desc')
                     ->get();

    return view('mypage/follow', compact('user','followings'));
  }

  public function follower($user_address){
    $user = Auth::user();

    $now_user = User::where('name_address',$user_address)->first();

    $id = $now_user->id;

    $follower_id = Follower::where('follows_id', $id)->get(['user_id']);

    $followers = User::whereIn('id',$follower_id)
                     ->orderBy('created_at', 'desc')
                     ->get();


    return view('mypage/follower', compact('user','followers'));
  }

}
