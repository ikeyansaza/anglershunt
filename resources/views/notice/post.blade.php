@extends('layouts.notice')

@section('content')

    <div class="content">
      <div class="site-width">
        <div class="post-main">
          <div class="prev-img">
            <form class="" action="post" method="post">
            @csrf
            <input type="text" name="name" value="" placeholder="ニュース名"><br><br>
            <textarea class="" name="post" cols="35" rows="5" placeholder="内容を入力する"></textarea><br><br>
            <input type="submit" name="" value="送信">

            </form>
          </div>
        </div>
      </div>
    </div>

@endsection
