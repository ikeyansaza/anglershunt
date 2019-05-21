<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Quest;
use App\Order;
use App\Like;
use App\Newspost;
use App\Achievement;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminController extends Controller
{
  public function __construct()
  {
      $this->middleware('admin');
  }

  //クエスト追加ページを表示する
  public function add(){
    $user = Auth::user();
    return view('quest/add', compact('user'));
  }

  //管理者ページより新規クエストを追加する
  public function register(Request $request){
    // Postモデルのインスタンスを作成する
    $quest = new Quest();
    //それぞれのカラムに値を登録する
    //クエスト名
    $quest->name = $request->name;

    //条件１
    $quest->condition1 = $request->condition1;
    //条件２
    $quest->condition2 = $request->condition2;
    //条件３
    $quest->condition3 = $request->condition3;
    //条件４
    $quest->condition4 = $request->condition4;
    //ポイント
    $quest->point = $request->point;
    //フィールド
    $quest->field = $request->field;

    //インスタンスの状態をデータベースに書き込む
    $quest->save();

    //「投稿する」をクリックしたら投稿情報表示ページへリダイレクト
    return redirect('quest/add');
  }

  public function news(){
    $user = Auth::user();

    return view('notice/post', compact('user'));
  }

  public function post(Request $request){
     // Postモデルのインスタンスを作成する
     $post = new Newspost();
     //それぞれのカラムに値を登録する
     $post->name = $request->name;
     //投稿
     $post->post = $request->post;
     // インスタンスの状態をデータベースに書き込む
     $post->save();

     //「投稿する」をクリックしたら投稿情報表示ページへリダイレクト
     return redirect('notice/post');
  }


}
