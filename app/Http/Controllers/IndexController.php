<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Follower;
use App\Newspost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('index', compact('user', 'currentUserInfo'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('mypage/edit', compact('user'));
    }

    public function follow()
    {
        $user = Auth::user();
        return view('follow', compact('user'));
    }

    public function follower()
    {
        $user = Auth::user();
        return view('follow', compact('user'));
    }

    public function post()
    {
        $user = Auth::user();
        return view('post', compact('user'));
    }

    public function withdraw()
    {
        $user = Auth::user();
        return view('withdraw', compact('user', 'area'));
    }

    public function notifications()
    {
        $user = Auth::user();
        $notices = auth()->user()->unreadNotifications()->limit(5)->get();
        $oldnotices = auth()->user()->readNotifications()->limit(5)->get();

        $now = Carbon::now();
        Carbon::setLocale('ja');

        return view('notice/main', compact('notices', 'now', 'oldnotices', 'user'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $now = Carbon::now();
        Carbon::setLocale('ja');

        //キーワード受け取り
        $keyword = $request->input('keyword');

        //クエリ生成
        $query = Post::query();

        //もしキーワードがあったら
        if (!empty($keyword)) {
            $query->where('post', 'like', '%'.$keyword.'%');
        }
        //ページネーション
        $data = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('search', compact('user', 'data', 'keyword', 'now'));
    }

    public function searchUser(Request $request)
    {
        $user = Auth::user();
        //キーワード受け取り
        $keyword = $request->input('keyword');
        //クエリ生成
        $query = User::query();
        //もしキーワードがあったら
        if (!empty($keyword)) {
            $query->where('name', 'like', '%'.$keyword.'%');
        }
        //ページネーション
        $data = $query->orderBy('created_at', 'desc')->paginate(10);

        $area = $request->area;

        if (!empty($area)) {
            $query->where('area', 'like', '%'.$area.'%');
            $data = $query->orderBy('created_at', 'desc')->paginate(10);
        }

        $id = Auth::id();
        $user = User::find($id);
        $followers = $user->followers;
        $followings = $user->follows;

        return view('search_user', compact('user', 'data', 'keyword', 'area', 'followings', 'followers'));
    }

    public function manage()
    {
        $user = Auth::user();

        return view('manage', compact('user'));
    }
    public function official()
    {
        $user = Auth::user();

        $newsposts = Newspost::orderBy('created_at', 'desc')
                     ->limit(10)
                     ->get();

        return view('notice/official', compact('user', 'newsposts'));
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('login');
    }
}
