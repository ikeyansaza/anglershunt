@extends('layouts.view_sub')

@section('title', 'AnglersHunt')

@section('h1', '退会')

@section('content')
<div style="color: red; font-size: 14px;">
※当サイトの利用は完全無料となっております。
<br>
※再登録された場合も元のデータの復元は行っていないため全て０からのスタートとなります。
</div>
<br>
<form method="post" action="/withdraw/{{$user->id}}">
@csrf
  <input type="submit" value="それでも退会する" class="btn-danger"
  style = "border: 1px solid #e6ecef; border-radius: 20px; padding: 5px 10px;"
  onclick='return confirm("本当に退会しますか？");'>
</form>

@endsection
