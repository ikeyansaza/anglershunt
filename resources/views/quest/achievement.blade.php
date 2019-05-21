@extends('layouts.quest')

@section('h1', 'クエスト')

@section('content')

    <div class="content">
      <div class="quest-width">
        <div class="quest-header">
          <div class="item">
          <a href="quest">クエストTOP</a>
          </div>
          <div class="item">
          <a href="order">受注クエスト</a>
          </div>
          <div class="item main-notice">
          達成クエスト
          </div>
        </div>
        <div class="quest-first">
          達成クエスト一覧 <span class="quest-first-item" >達成: {{$counts}}件/獲得経験値: {{ $user->total_point }}pt</span>
        </div>

        @foreach($achievements as $achievement)
        <div class="done-second">
          <div class="item">
            <div class="quest-title">
              {{ $achievement->quest->name }}
            </div>
            <div class="quest-level">
              難易度:
              @if($achievement->quest->point == '10')
              <i class="fas fa-star"></i>
              @elseif($achievement->quest->point == '20')
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              @elseif($achievement->quest->point == '30')
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              @elseif($achievement->quest->point == '40')
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              @elseif($achievement->quest->point == '50')
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              @elseif($achievement->quest->point == '60')
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              @else
              なし
              @endif
            </div>
            <div class="quest-condition">
              条件: {{ $achievement->quest->condition1 }}
            </div>
            <div class="achievement-date">
              達成日: <?php echo date('Y年n月d日', strtotime($achievement->updated_at)); ?>
            </div>
            <div class="quest-point">
              達成経験値: {{ $achievement->quest->point }}pt
            </div>
            <div class="quest-field">
              フィールド: {{ $achievement->quest->field }}
            </div>
          <div class="quest-finish-width">
            <a href="../comment/{{ $achievement->post_id }}">
            　<span class="quest-finish">投稿を見る</span>
            </a>
          </div>
          </div>
        </div>
        @endforeach
        </div>
      </div>

<footer id="footer">
  <div class="footer-container">
      <div class="item">
        <a class="white" href="../index.php"><i class="fas fa-home"></i></a>
      </div>
      <div class="item">
      <a class="white" href="../quest/achievement"><i class="fas fa-khanda"></i></a>
      </div>
      <div class="item">
      <a class="white" href="../post"><i class="fas fa-plus-circle"></i></a>
      </div>
      <div class="item">
      <a class="white" href="../../rank/main"><i class="fas fa-crown"></i></a>
      </div>
      <div class="item">
      <a class="white" href="../../notice/main"><i class="fas fa-bell"></i></a>
      </div>
  </div>
</footer>

@endsection
