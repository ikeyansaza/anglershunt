@extends('layouts.quest')

@section('h1', 'クエスト')

@section('content')

    <div class="content">
      <div class="quest-width">
        <div class="quest-header">
          <div class="item main-notice">
            クエストTOP
          </div>
          <div class="item">
          <a href="order">受注クエスト</a>
          </div>
          <div class="item">
          <a href="achievement">達成クエスト</a>
        </div>
      </div>
        <div class="quest-first">
          <div class="item">
          <a href="/quest/quest">クエスト一覧</a><br>
          <span style="color:#999999; font-size: 12px;">※同じクエストは月に1度だけ受注できます</span>
          </div>
          <form class="" action="/quest/quest" method="post">
          @csrf
          <div class="item quest-select">
            <div class="item">
            難易度別:
            <select name="level" style="cursor:pointer;">
             <option value="">選択する</option>
             <option <?= $level == '10' ? 'selected' : "" ?> value="10">★</option>
             <option <?= $level == '20' ? 'selected' : "" ?> value="20">★★</option>
             <option <?= $level == '30' ? 'selected' : "" ?> value="30">★★★</option>
             <option <?= $level == '40' ? 'selected' : "" ?> value="40">★★★★</option>
             <option <?= $level == '50' ? 'selected' : "" ?> value="50">★★★★★</option>
             <option <?= $level == '60' ? 'selected' : "" ?> value="60">★★★★★★</option>
            </select>
            <input type="submit" value="▼" style="border:none;">
            </div>
            <div class="item">
            魚種別:
            <select name="fish" style="cursor:pointer;">
             <option value="">選択する</option>
             <option <?= $fish == 'アジ' ? 'selected' : "" ?> value="アジ">アジ</option>
             <option <?= $fish == 'アラカブ' ? 'selected' : "" ?> value="アラカブ">アラカブ</option>
             <option <?= $fish == 'イカ' ? 'selected' : "" ?> value="イカ">イカ</option>
             <option <?= $fish == 'イサキ' ? 'selected' : "" ?> value="イサキ">イサキ</option>
             <option <?= $fish == '石鯛' ? 'selected' : "" ?> value="石鯛">石鯛</option>
             <option <?= $fish == 'イワナ' ? 'selected' : "" ?> value="イワナ">イワナ</option>
             <option <?= $fish == 'うなぎ' ? 'selected' : "" ?> value="うなぎ">うなぎ</option>
             <option <?= $fish == 'キジハタ' ? 'selected' : "" ?> value="キジハタ">キジハタ</option>
             <option <?= $fish == 'クエ' ? 'selected' : "" ?> value="クエ">クエ</option>
             <option <?= $fish == 'クロ' ? 'selected' : "" ?> value="クロ">クロ</option>
             <option <?= $fish == 'サバ' ? 'selected' : "" ?> value="アジ">サバ</option>
             <option <?= $fish == 'シイラ' ? 'selected' : "" ?> value="シイラ">シイラ</option>
             <option <?= $fish == 'マゴチ' ? 'selected' : "" ?> value="マゴチ">マゴチ</option>
             <option <?= $fish == '真鯛' ? 'selected' : "" ?> value="真鯛">真鯛</option>
             <option <?= $fish == 'バス' ? 'selected' : "" ?> value="バス">バス</option>
             <option <?= $fish == '平政' ? 'selected' : "" ?> value="平政">平政</option>
             <option <?= $fish == 'ヒラメ' ? 'selected' : "" ?> value="ヒラメ">ヒラメ</option>
             <option <?= $fish == '雷魚' ? 'selected' : "" ?> value="雷魚">雷魚</option>
            </select>
            <input type="submit" value="▼" style="border:none;">
            </div>
            <div class="item">
            フィールド別:
            <select name="field" style="cursor:pointer;">
             <option value="">選択する</option>
             <option <?= $field == '海（陸っぱり）' ? 'selected' : "" ?> value="海（陸っぱり）">海（陸っぱり）</option>
             <option <?= $field == '河川/渓流' ? 'selected' : "" ?> value="河川/渓流">河川/渓流</option>
             <option <?= $field == '沖磯' ? 'selected' : "" ?> value="沖磯">沖磯</option>
             <option <?= $field == '船' ? 'selected' : "" ?> value="船">船</option>
             <option <?= $field == '野池/ダム/クリーク/湖' ? 'selected' : "" ?> value="野池/ダム/クリーク/湖">野池/ダム/クリーク/湖</option>
             <option <?= $field == '自宅' ? 'selected' : "" ?> value="自宅">自宅</option>
            </select>
            <input type="submit" value="▼" style="border:none;">
            </div>
          </div>
         </form>
        </div>

        @foreach($real_quests as $quest)
        <div class="list-second">
          <div class="item">
            <div class="quest-title">
              {{ $quest->name }}<br>
              <span class="quest-title-item">-{{ $quest->order()->count() }}人が受注中<a href="../{{ $quest->id }}/list">{{ $quest->achievement()->count() }}人が達成</a>-</span><br>
            </div>
            <div class="quest-level">
              難易度:
              @if($quest->point == '10')
              <i class="fas fa-star"></i>
              @elseif($quest->point == '20')
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              @elseif($quest->point == '30')
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              @elseif($quest->point == '40')
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              @elseif($quest->point == '50')
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              @elseif($quest->point == '60')
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
              条件: {{ $quest->condition1 }}
            </div>
            <div class="quest-point">
              達成経験値: {{ $quest->point }}pt
            </div>
            <div class="quest-field">
              フィールド: {{ $quest->field }}
            </div>

          <div class="quest-finish-width">
            <form class="" action="/quest" method="post">
            @csrf
            @if(auth()->user())
              <input type="hidden" name="quest_id" value="{{ $quest->id }}">
              <input type="hidden" name="user_id" value="{{ $user->id }}">
            @endif
              <input class="quest-finish" type="submit" name="" value="クエストを受注する"><br>
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
      <a class="white" href="../quest/quest"><i class="fas fa-khanda"></i></a>
      </div>
      <div class="item">
      <a class="white" href="../post"><i class="fas fa-plus-circle"></i></a>
      </div>
      <div class="item">
      <a class="white" href="../../rank/main"><i class="fas fa-crown"></i></a>
      </div>
      <div class="item">
      <a class="white" href="../notice/main"><i class="fas fa-bell"></i></a>
      </div>
  </div>
</footer>

@endsection
