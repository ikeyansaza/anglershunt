@extends('layouts.quest')

@section('h1', 'クエスト追加')

@section('content')

    <div class="content">
      <div class="site-width">
        <div class="post-main">
          <div class="prev-img">
            <form class="" action="add" method="post">
            @csrf

            クエスト名:  <input type="text" name="name" value=""><br>
            条件１:  <input type="text" name="condition1" value=""><br>
            条件２:  <input type="text" name="condition2" value=""><br>
            条件３:  <input type="text" name="condition3" value=""><br>
            条件４:  <input type="text" name="condition4" value=""><br>
            ポイント:  <input type="text" name="point" value=""><br>
            フィールド:  <input type="text" name="field" value=""><br>

            <input type="submit" name="" value="送信">

            </form>
          </div>
        </div>
      </div>
    </div>

<footer id="footer">
  <div class="footer-container">
      <div class="item">
        <a class="white" href="index.php"><i class="fas fa-home"></i></a>
      </div>
      <div class="item">
      <a class="white" href="quest"><i class="fas fa-khanda"></i></a>
      </div>
      <div class="item">
      <a class="white" href="post.php"><i class="fas fa-plus-circle"></i></a>
      </div>
      <div class="item">
      <a class="white" href="ranking/main.rank.php"><i class="fas fa-crown"></i></a>
      </div>
      <div class="item">
      <a class="white" href="notice/main.notice.php"><i class="fas fa-bell"></i></a>
      </div>
  </div>
</footer>

@endsection
