@extends('layouts.rank')

@section('content')

    <div class="content">
      <div class="quest-width">
        <div class="rank-first">
          <div class="rank-first-item">
            過去TOP5
          </div>
        </div>
        <div class="rank-second">
          <div class="rank-second-item">

          </div>
        </div>
        <div class="rank-third">
          <div class="item rank-third-item1">
            月間獲得経験値 TOP5
          </div>
          <div class="item rank-third-item2">

          <form class="" action="/rank/history" method="post">
          @csrf
          <select id="select" name="month">
            <option <?= $dt == '5' ? 'selected' : "" ?> value="5">2019年5月</option>
            <option <?= $dt == '4' ? 'selected' : "" ?> value="4">2019年4月</option>
            <option <?= $dt == '3' ? 'selected' : "" ?> value="3">2019年3月</option>
            <option <?= $dt == '2' ? 'selected' : "" ?> value="2">2019年2月</option>
          </select>
          <button type="submit">送信</button>
          </form>
          </div>
        </div>
        <div class="rank-forth">
           ({{$dt}}月度)
        </div>
        @foreach($points as $point)
        <div class="rank-fifth">
          <div class="rank-main">
            <div class="rank-rank">
            </div>
            <a href="../{{ $point->user->name }}/album">
            <div class="item rank-main-img">
              @if($point->user->icon_img == null)
              <img class="prof-img4" src="/images/noimage.jpg">
              @else
              <img class="prof-img4" src="/public/images/{{ $point->user->id }}icon.jpg">
              @endif
            </div>
            </a>
            <div class="item rank-main-main">
              <span class="rank-name">{{ $point->user->name }}</span><br>
              @if($point->monthly_point == null)
              0pt
              @else
              <span>{{ $point->monthly_point }}pt</span><br>
              @endif
              <a href="../{{ $point->user->name }}/quests"><span class="rank">達成クエスト一覧</span></a><br>
            </div>
          </div>
        </div>
        @endforeach

        <div class="rank-sixth rank-sixth-bottom">
          <div class="item ranking-sub">
          </div>
        </div>
      </div>
    </div>

@endsection
