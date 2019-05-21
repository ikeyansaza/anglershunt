@extends('layouts.viewSub')

@section('title', 'AnglersHunt')

@section('h1', '退会')

@section('content')

<form method="post" action="/withdraw/{{$user->id}}">
@csrf
  <input type="submit" value="退会する" class="btn-danger" onclick='return confirm("本当に退会しますか？");'>
</form>

@endsection
