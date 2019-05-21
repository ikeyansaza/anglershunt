<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Follower;
use App\Comment;
use App\Achievement;
use App\Like;
use App\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostController extends Controller
{

  public function index(Request $request)
  {
    if(Auth::user()){
    $user = Auth::user();
    $id = Auth::id();

    //$follower = 'user_id';
    //$follower_posts = Follower::where($follower,$id)->orderBy('created_at', 'desc')->get();

    $followings = Follower::where('user_id', $id)->get(['follows_id']);

    $posts = Post::whereIn('user_id',$followings)
                     ->orWhere('user_id',$id)
                     ->orderBy('created_at', 'desc')
                     ->simplePaginate(5);

    //フォロー数の取得
    $follow_counts = $followings->count();

    //フォロワー数の取得
    $followers = $user->followers;
    $follower_counts = $followers->count();

    $now = Carbon::now();
    Carbon::setLocale('ja');

    $like = Like::where('user_id',$id)
                  ->first(['post_id']);
    }else{
      $user = User::find(25);
      $id = '25';
      $followings = Follower::where('user_id', $id)->get(['follows_id']);
      $posts = Post::orderBy('created_at', 'desc')
                    ->simplePaginate(20);
      $follow_counts = '0';
      $follower_counts = '0';
      $now = Carbon::now();
      Carbon::setLocale('ja');
      $like = Like::where('user_id',$id)
                    ->first(['post_id']);
    }

    return view('index', compact('posts','user','follower_posts','follow_counts','follower_counts','now','like'));
  }

  public function create(Request $request)
     {

        //バリデーションを実装する
        $validate_rule = [
          'post' => 'required',
          'pic1' => 'file|image|max:8000',
          'pic2' => 'file|image|max:8000',
          'pic3' => 'file|image|max:8000',
          'pic4' => 'file|image|max:8000'
        ];

        $this->validate($request, $validate_rule);

         // Postモデルのインスタンスを作成する
         $post = new Post();
         //それぞれのカラムに値を登録する
         //投稿
         $post->post = $request->post;
         //登録ユーザーからidを取得
         $post->user_id = Auth::user()->id;

         $post->save();

         $post_id = $post->id;

         //画像1を登録する
         $image1 = $request->pic1;
         if(!empty($image1)){
         $post->pic1 = $request->pic1->storeAs('images', '_'.$post_id . '.jpg');
         }
         //画像2を登録する
         $image2 = $request->pic2;
         if(!empty($image2)){
         $post->pic2 = $request->pic2->storeAs('images', '_'.$post_id . '-2.jpg');
         }
         //画像3を登録する
         $image3 = $request->pic3;
         if(!empty($image3)){
         $post->pic3 = $request->pic3->storeAs('images', '_'.$post_id . '-3.jpg');
         }
         //画像4を登録する
         $image4 = $request->pic4;
         if(!empty($image4)){
         $post->pic4 = $request->pic4->storeAs('images', '_'.$post_id . '-4.jpg');
         }

         // インスタンスの状態をデータベースに書き込む
         $post->save();

         //「投稿する」をクリックしたら投稿情報表示ページへリダイレクト
         return redirect('index.php')->with('flash_message', '投稿が完了しました');
     }

     public function delete(Request $request){
       $id = Auth::id();

       Post::find($request->id)->delete();

       $point = $request->point;
       if(!empty($point)){
       //ユーザーテーブルのtotal_pointカラムに達成クエストの経験値を追加する
       User::where('id', '=', $id)
           ->decrement('total_point',$request->point);
       Achievement::find($request->achievement_id)->delete();
       }
       return redirect('index.php');
     }

     public function report(Request $request){
       $report = new Report();

       $report->post_id = $request->post_id;
       //登録ユーザーからidを取得
       $report->reporter_id = Auth::user()->id;

       $report->save();

       return redirect('index.php');
     }

}
