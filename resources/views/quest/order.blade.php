@extends('layouts.quest')

@section('h1', 'クエスト')

@section('content')

    <div class="content">
      <div class="quest-width">
        <div class="quest-header">
          <div class="item">
          <a href="quest">クエストTOP</a>
          </div>
          <div class="item main-notice">
          受注クエスト
          </div>
          <div class="item">
          <a href="achievement">達成クエスト</a>
          </div>
        </div>
        <div class="quest-first">
          受注クエスト一覧 <span class="quest-first-item" >{{ $counts }}件受注中</span>
        </div>

        @foreach($orders as $order)
        <div class="quest-second">
          <div class="">
            <div class="quest-title">
              {{ $order->quest->name }}
            </div>
            <div class="quest-level">
              難易度:
              @if($order->quest->point == '10')
              <i class="fas fa-star"></i>
              @elseif($order->quest->point == '20')
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              @elseif($order->quest->point == '30')
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              @elseif($order->quest->point == '40')
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              @elseif($order->quest->point == '50')
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              @elseif($order->quest->point == '60')
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
              条件: {{ $order->quest->condition1 }}
            </div>
            <div class="quest-point">
              達成経験値: {{ $order->quest->point }}pt
            </div>
            <div class="quest-field">
              フィールド: {{ $order->quest->field }}
            </div>
            <div class="order-date">
              受注日: <?php echo date('Y年n月d日', strtotime($order->updated_at)); ?>
            </div>
            <div class="quest-finish-width2">
              <a href="{{ $order->quest->id }}/{{ $order->id }}/report">
                <div class="quest-finish item">達成報告</div>　
              </a>
              <form method="post" action="/order/delete/{{$order->id}}">
              @csrf
              <input class="quest-finish item" type="submit" value="キャンセル" class="btn-danger" onclick='return confirm("受注をキャンセルしますか？");'>
              </form>
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
        <a class="white" href="quest"><i class="fas fa-khanda"></i></a>
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
