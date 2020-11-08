<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\Post;
use App\User;
use Carbon\Carbon;

class CommentController extends Controller
{
    public function index($comment_id)
    {
        if (Auth::user()) {
            $user = Auth::user();
            $id = $comment_id;
            $posts = Post::find($id);
            $comments = Comment::Where('post_id', $id)
                         ->orderBy('created_at', 'desc')
                         ->get();

            $counts = Comment::Where('post_id', $id)
                       ->count();

            $now = Carbon::now();
            Carbon::setLocale('ja');
        } else {
            $user = User::find(25);
            $id = $comment_id;
            $posts = Post::find($id);
            $comments = Comment::Where('post_id', $id)
                         ->orderBy('created_at', 'desc')
                         ->get();

            $counts = Comment::Where('post_id', $id)
                       ->count();

            $now = Carbon::now();
            Carbon::setLocale('ja');
        }

        return view('comment', compact('user', 'posts', 'id', 'comments', 'counts', 'now'));
    }

    public function store(Request $request, $comment_id)
    {
        //バリデーションを実装する
        $validate_rule = [
            'comment' => 'required'
        ];

        $this->validate($request, $validate_rule);

        $comments = new Comment();
        $comments->post_id = $comment_id;
        $comments->comment = $request->comment;
        $comments->user_id = Auth::user()->id;
        $comments->save();

        return redirect()->route('comment.index', ['id' => $comment_id]);
    }

    public function delete(Request $request)
    {
        Comment::find($request->id)->delete();

        return back();
    }
}
