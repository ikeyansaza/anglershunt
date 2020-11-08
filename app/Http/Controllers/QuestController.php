<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Quest;
use App\Order;
use App\Like;
use App\Achievement;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QuestController extends Controller
{
    //クエスト一覧を表示する
    public function quest(Request $request)
    {
        if (Auth::user()) {
            $user = Auth::user();
            $id = Auth::id();
            $dt = Carbon::now();
            $dt = $dt->month;

            //全てのクエストを取得
            $quests = Quest::orderBy('created_at', 'asc')
                   ->get();

            //受注クエストにてユーザーIDが一致するクエストを取得
            $orders = Order::where('user_id', $id)->get(['quest_id']);

            //達成クエストにてユーザーIDが一致し、かつ当月達成したクエストを取得
            $achievements = Achievement::where('user_id', $id)
                                ->where('month', $dt)
                                ->get(['quest_id']);

            //上で取得した２つのクエストIDと一致しないものをクエスト一覧から取得
            $real_quests = Quest::whereNotIn('id', $achievements)
                          ->whereNotIn('id', $orders)
                          ->orderBy('point', 'asc')
                          ->get();
        } else {
            $id = '25';
            $orders = Order::where('user_id', $id)->get(['quest_id']);
            $achievements = Achievement::where('user_id', $id)
                                  ->get(['quest_id']);

            $real_quests = Quest::orderBy('point', 'asc')
                            ->get();
            $user = User::find(25);
        }

        $level = null;
        $fish = null;
        $field = null;

        //クエスト難易度のみの検索
        if ($request->level) {
            $level = $request->level;
            $real_quests = Quest::whereNotIn('id', $achievements)
                            ->whereNotIn('id', $orders)
                            ->Where('point', $request->level)
                            ->orderBy('point', 'asc')
                            ->get();
        }
        //対象魚のみの検索
        if ($request->fish) {
            $fish = $request->fish;
            $real_quests = Quest::whereNotIn('id', $achievements)
                            ->whereNotIn('id', $orders)
                            ->Where('condition1', 'like', '%'.$request->fish.'%')
                            ->orderBy('point', 'asc')
                            ->get();
        }
        //フィールドのみの検索
        if ($request->field) {
            $field = $request->field;
            $real_quests = Quest::whereNotIn('id', $achievements)
                            ->whereNotIn('id', $orders)
                            ->Where('field', $request->field)
                            ->orderBy('point', 'asc')
                            ->get();
        }
        //クエスト難易度と対象魚併せた検索
        if ($request->level and $request->fish) {
            $level = $request->level;
            $fish = $request->fish;
            $real_quests = Quest::whereNotIn('id', $achievements)
                            ->whereNotIn('id', $orders)
                            ->Where('point', $request->level)
                            ->Where('condition1', 'like', '%'.$request->fish.'%')
                            ->orderBy('point', 'asc')
                            ->get();
        }
        //クエスト難易度とフィールド併せた検索
        if ($request->level and $request->field) {
            $level = $request->level;
            $field = $request->field;
            $real_quests = Quest::whereNotIn('id', $achievements)
                            ->whereNotIn('id', $orders)
                            ->Where('point', $request->level)
                            ->Where('field', $request->field)
                            ->orderBy('point', 'asc')
                            ->get();
        }
        //対象魚とフィールド併せた検索
        if ($request->fish and $request->field) {
            $fish = $request->fish;
            $field = $request->field;
            $real_quests = Quest::whereNotIn('id', $achievements)
                            ->whereNotIn('id', $orders)
                            ->Where('condition1', 'like', '%'.$request->fish.'%')
                            ->Where('field', $request->field)
                            ->orderBy('point', 'asc')
                            ->get();
        }
        //クエスト難易度と対象魚とフィールド併せた検索
        if ($request->level and $request->fish and $request->field) {
            $level = $request->level;
            $fish = $request->fish;
            $field = $request->field;
            $real_quests = Quest::whereNotIn('id', $achievements)
                            ->whereNotIn('id', $orders)
                            ->Where('point', $request->level)
                            ->Where('condition1', 'like', '%'.$request->fish.'%')
                            ->Where('field', $request->field)
                            ->orderBy('point', 'asc')
                            ->get();
        }
        return view('quest/quest', compact('user', 'quests', 'orders', 'id', 'real_quests', 'level', 'field', 'fish'));
    }

    //受注一覧を表示する
    public function order()
    {
        $user = Auth::user();
        $id = Auth::id();

        //ユーザーIDが一致するクエストを取得
        $orders = Order::where('user_id', $id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        $counts = $orders->count();

        return view('quest/order', compact('user', 'orders', 'counts'));
    }

    //達成一覧を表示する
    public function achievement()
    {
        $user = Auth::user();
        $id = Auth::id();

        $achievements = Achievement::where('user_id', $id)
                                ->orderBy('created_at', 'desc')
                                ->get();

        $counts = $achievements->count();

        return view('quest/achievement', compact('user', 'achievements', 'counts'));
    }

    //クエスト達成者ページを表示する
    public function list($list_id)
    {
        $user = Auth::user();
        $id = Auth::id();

        //投稿の取得
        $posts = Post::Where('quest_id', $list_id)
                   ->orderBy('created_at', 'desc')
                   ->simplePaginate(5);

        $now = Carbon::now();
        Carbon::setLocale('ja');

        $like = Like::where('user_id', $id)
                  ->first(['post_id']);

        return view('quest/list', compact('user', 'posts', 'now', 'like'));
    }

    //クエスト達成報告ページを表示する
    public function report($quest_id, $report_id)
    {
        $user = Auth::user();

        $quests = Quest::find($quest_id);

        $year = date('Y');
        $month = date('n');

        return view('quest/report', compact('user', 'quests', 'quest_id', 'report_id', 'year', 'month'));
    }

    //クエスト一覧から受注する
    public function juchu(Request $request)
    {
        $user = Auth::user();
        $order = new Order();
        $order->user_id = $request->user_id;
        $order->quest_id = $request->quest_id;
        $order->save();

        return redirect('quest/order')->with('flash_message', 'クエストを受注しました');
    }

    //達成報告をする。
    //1.達成テーブルより重複データの確認
    //2.達成テーブルへ保存
    //3.POSTテーブルへ保存
    public function tassei(Request $request)
    {
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
        //ポストにクエストidを追加する
        $post->quest_id = $request->quest_id;

        $post->save();

        $post_id = $post->id;

        //画像1を登録する
        $image1 = $request->pic1;
        if (!empty($image1)) {
            $post->pic1 = $request->pic1->storeAs('images', '_'.$post_id . '.jpg');
        }
        //画像2を登録する
        $image2 = $request->pic2;
        if (!empty($image2)) {
            $post->pic2 = $request->pic2->storeAs('images', '_'.$post_id . '-2.jpg');
        }
        //画像3を登録する
        $image3 = $request->pic3;
        if (!empty($image3)) {
            $post->pic3 = $request->pic3->storeAs('images', '_'.$post_id . '-3.jpg');
        }
        //画像4を登録する
        $image4 = $request->pic4;
        if (!empty($image4)) {
            $post->pic4 = $request->pic4->storeAs('images', '_'.$post_id . '-4.jpg');
        }

        // インスタンスの状態をデータベースに書き込む
        $post->save();

        $id = Auth::id();

        //ユーザーテーブルのtotal_pointカラムに達成クエストの経験値を追加する
        User::where('id', '=', $id)
        ->increment('total_point', $request->point);

        //Achievementモデルのインスタンスを作成する
        $achievements = new Achievement();

        $achievements->quest_id = $request->quest_id;

        $achievements->user_id = Auth::user()->id;

        $achievements->year = $request->year;

        $achievements->month = $request->month;

        $achievements->point = $request->point;

        $achievements->post_id = $post->id;

        $achievements->save();

        $delete = $request->report_id;

        $post->achievement_id = $achievements->id;

        $post->save();

        Order::find($delete)->delete();


        //「投稿する」をクリックしたら投稿情報表示ページへリダイレクト
        return redirect('index.php')->with('flash_message', 'クエスト達成おめでとうございます');
    }

    public function delete(Request $request)
    {
        Order::find($request->id)->delete();
        return redirect('quest/order');
    }
}
