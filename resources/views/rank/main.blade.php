@extends('layouts.rank')

@section('content')

    <div class="content">
      <div class="quest-width">
        <div class="rank-first">
          <div class="rank-first-item">
            AnglersHuntランキング
          </div>
        </div>
        <div class="rank-second">
          <div class="rank-second-item">

          </div>
        </div>
        <div class="rank-third">
          <div class="item rank-third-item1">
            月間獲得経験値ランキング
          </div>
          <div class="item rank-third-item2">
          </div>
        </div>
        <div class="rank-forth">
          (<?php echo date('n月j日'); ?>現在)
        </div>
        @foreach($points as $point)
        <div class="rank-fifth">
          <div class="rank-main">
            <div class="rank-rank">
              {{ $point->user->getMonthlyRanking() }}位
            </div>
            <a href="../{{ $point->user->name_address }}/album">
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
          <div class="item">
          </div>
          <div class="item ranking-sub">
           <a href="history">過去ランキングへ ▼</a>
          </div>
        </div>
<br>
        <div class="rank-third">
          <div class="item rank-third-item1">
            通算獲得経験値ランキング
          </div>
          <div class="item rank-third-item2">
          </div>
        </div>
        <div class="rank-forth">
          (<?php echo date('n月j日'); ?>現在)
        </div>
        @if(auth()->user())
        @foreach($users as $ranker)
        <div class="rank-fifth">
          <div class="rank-main">
            <div class="rank-rank">
              {{ $ranker->getRanking() }}位
            </div>
            <a href="../{{ $ranker->name }}/album">
            <div class="item rank-main-img">
              @if($ranker->icon_img == null)
              <img class="prof-img4" src="/images/noimage.jpg">
              @else
              <img class="prof-img4" src="/public/images/{{ $ranker->id }}icon.jpg">
              @endif
            </div>
            </a>
            <div class="item rank-main-main">
              <span class="rank-name">{{ $ranker->name }}</span><br>
              @if($ranker->total_point == null)
              0pt
              @else
              <span>{{ $ranker->total_point }}pt</span><br>
              @endif
              <a href="../{{ $ranker->name }}/quests"><span class="rank">達成クエスト一覧</span></a><br>
            </div>
          </div>
        </div>
        @endforeach
        @else
         <div class="rank-main" style="color: #999999;">
           このコンテンツはユーザー登録後に閲覧できます
         </div>
        @endif
        <div class="rank-sixth rank-sixth-bottom">
          <div class="item">
          </div>
          <div class="item ranking-sub">
          </div>
        </div>
      </div>
    </div>

@endsection
