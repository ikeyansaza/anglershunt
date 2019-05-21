<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Like;
use Auth;
use App\Post;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
      // Postモデルのインスタンスを作成する
      $like = new Like();
      //それぞれのカラムに値を登録する
      $like->user_id = $request->user;
      //投稿
      $like->post_id = $request->post;
      // インスタンスの状態をデータベースに書き込む
      $like->save();

      //「投稿する」をクリックしたら投稿情報表示ページへリダイレクト
      return back();
    }

    public function destroy(Request $request)
    {
      $delete = like::where('user_id',$request->user)
                    ->Where('post_id',$request->post)
                    ->delete();

      return redirect('index.php');
    }
}
