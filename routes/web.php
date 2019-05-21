<?php
use App\User;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//viewの引き渡し
//Route::get('/', 'IndexController@index');
Route::get('/', 'PostController@index');
Route::get('/{user_address}/album', 'MypageController@album');
Route::get('/{user_address}/quests', 'MypageController@quest');
Route::get('/{user_address}/mypost', 'MypageController@post');
Route::get('/{user_address}/favorite', 'MypageController@favorite');
Route::get('/mypage/edit', 'IndexController@edit');
Route::get('/follow', 'IndexController@follow')->middleware('auth');
Route::get('/follower', 'IndexController@follower')->middleware('auth');
Route::get('/follow', 'FollowController@following')->middleware('auth');
Route::get('/follower', 'FollowController@follower')->middleware('auth');
Route::get('/post', 'IndexController@post');
Route::get('/comment/{comment_id}', 'CommentController@index')->name('comment.index');
Route::get('/quest/quest', 'QuestController@quest');
Route::get('/quest/order', 'QuestController@order')->middleware('auth');
Route::get('/quest/achievement', 'QuestController@achievement')->middleware('auth');
Route::get('/{list_id}/list', 'QuestController@list')->middleware('auth');
Route::get('/quest/{quest_id}/{report_id}/report', 'QuestController@report');
Route::get('/rank/main', 'RankController@index');
Route::get('/rank/history', 'RankController@history')->middleware('auth');
Route::get('/notice/main', 'IndexController@notifications');
Route::get('/search', 'IndexController@search');
Route::get('/searchUser', 'IndexController@searchUser');
Route::get('/manage', 'IndexController@manage');
Route::get('/{user_address}/follow', 'MypageController@follow')->middleware('auth');
Route::get('/{user_address}/follower', 'MypageController@follower')->middleware('auth');
Route::get('/logout', 'IndexController@getLogout');
Route::get('/notice/official', 'IndexController@official');
Route::get('/notifications', 'UsersController@notifications');

Route::get('/policy', function(){
  return view('policy');
});

Route::get('/description', function(){
  return view('description');
});

Route::get('/privacy', function(){
  return view('privacy');
});

Route::get('/help', function(){
  return view('help');
});

Route::get('/contact', function(){
  return view('contact');
});

Route::get('/question', function(){
  return view('question');
});

Route::get('/withdraw', 'IndexController@withdraw');

//管理者用
Route::get('/quest/add', 'AdminController@add');
Route::get('/notice/post', 'AdminController@news');
//クエスト登録機能
Route::post('/quest/add', 'AdminController@register');
//ニュース追加機能
Route::post('/notice/post', 'AdminController@post');

//Auth機能一覧
Auth::routes();
//Laravelホーム画面
Route::get('/home', 'HomeController@index')->name('home');
//POST受け取り
Route::post('/mypage/album', 'EditController@update');
//フォロー機能
Route::group(['middleware' => 'auth'], function () {
    Route::get('users', 'UsersController@index')->name('users');
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
});
//投稿機能
Route::post('/post', 'PostController@create');
//コメント機能
Route::post('/comment/{comment_id}', 'CommentController@store');
//クエスト受注機能
Route::post('/quest', 'QuestController@juchu')->middleware('auth');
//達成報告機能
Route::post('/quest/achievement', 'QuestController@tassei');
//お気に入り追加機能
Route::post('/like', 'LikesController@store');
//お気に入り削除機能
Route::post('/unlike', 'LikesController@destroy');
//過去ランキング表示
Route::post('/rank/history', 'RankController@history');
//投稿削除
Route::post('/post/delete/{id}', 'PostController@delete');
//コメント削除
Route::post('/comment/delete/{id}', 'CommentController@delete');
//ユーザー削除
Route::post('/withdraw/{id}', 'UsersController@delete');
//受注キャンセル
Route::post('/order/delete/{id}', 'QuestController@delete');
//通知を既読にする処理
Route::get('markAsRead', function(){
  auth()->user()->unReadNotifications->markAsRead();
  return redirect()->back();
})->name('markRead');
Route::post('/quest/quest', 'QuestController@quest');

//お問い合わせ
Route::get('contact', 'ContactController@index')->name('contact');
Route::post('contact/confirm', 'ContactController@confirm')->name('confirm');
Route::post('contact/sent', 'ContactController@sent')->name('sent');
