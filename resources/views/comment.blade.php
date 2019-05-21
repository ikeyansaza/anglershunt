@extends('layouts.view')

@section('head')
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@ikeyansaza">
<meta property="og:url" content="https://anglershunt.com/comment/{{$posts->id}}">
<meta property="og:title" content="AnglersHunt | 釣果投稿SNSサイト">
<meta property="og:description" content="{{ $posts->post }}">
<meta property="og:image" content="https://anglershunt.com/public/images/_{{$posts->id}}.jpg" />
@endsection

@section('h1', 'AnglersHunt')

@section('content')

    <div class="reply-body">
    <div class="mypage-reply-post">
      <div class="post-first contents">
        <div class="item">
          <a href="../{{ $posts->user->name_address }}/album">
          @if($user->icon_img == null)
          <img class="prof-img" src="/images/noimage.jpg">
          @else
          <img class="prof-img2" src="/public/images/{{$posts->user->id}}icon.jpg">
          @endif
          </a>
        </div>
        <div class="item post-main-content">
          <div class="item post-sub-content">
            <div class="item post-name">
              {{ $posts->user->name }}
            </div>
            <div class="item post-time">
              　-<?php echo ($posts->updated_at)->diffForHumans($now); ?>
            </div>
          </div>
          <div class="twitter">
            <a href="https://twitter.com/intent/tweet?url=https://anglershunt.com/comment/{{$posts->id}}&text=AnglersHuntより" style="color: #55acee">
              <i class="fab fa-twitter-square"></i>シェア
            </a>
          </div>
          <div class="item report" id="main">
            <ul class="menu">
              <li>
                <i class="fas fa-chevron-down"></i>
                  <ul class="sub">
                    @if($posts->user_id == $user->id)
                    <form method="post" action="/post/delete/{{$posts->id}}">
                    @csrf
                    <li>
                      @if($posts->quest_id)
                      <input type="hidden" name="point" value="{{$posts->quest->point}}" class="btn-danger";>
                      <input type="hidden" name="achievement_id" value="{{$posts->achievement->id}}">
                      @else
                      @endif
                      <input type="submit" value="削除" class="btn-danger" onclick='return confirm("投稿を削除しますか？");'>
                    </li>
                    </form>
                    @else
                    <li><a href="">報告</a></li>
                    @endif
                  </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="post-second">
        <div class="swiper-container">
          <div class="swiper-wrapper">
          @if ($posts->pic1)
          <p class="swiper-slide"><img src ="/public/images/_{{$posts->id}}.jpg"></p><br><br>
          @endif
          @if ($posts->pic2)
          <p class="swiper-slide"><img src ="/public/images/_{{$posts->id}}-2.jpg"></p><br><br>
          @endif
          @if ($posts->pic3)
          <p class="swiper-slide"><img src ="/public/images/_{{$posts->id}}-3.jpg"></p><br><br>
          @endif
          @if ($posts->pic4)
          <p class="swiper-slide"><img src ="/public/images/_{{$posts->id}}-4.jpg"></p><br><br>
          @endif
          </div>

          @if(!($posts->pic2 == null))
          <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

          <!-- If we need navigation buttons -->
            <div class="swiper-button-prev swiper-button-white"></div>
            <div class="swiper-button-next swiper-button-white"></div>
          @endif
        </div>

      </div>
      <div class="post-third">
        {{ $posts->post }}
      </div>
      <div class="post-time">
      <?php echo date('Y年n月d日 G時i分', strtotime($posts->updated_at)); ?>
      </div>
    </div>

  <div class="comment-width">
    @if(auth()->user())
    <div class="post-main">
        <div class="contents second-post">
          <div class="item second-post-img">
            @if($user->icon_img == null)
            <img class="prof-img "src="/images/noimage.jpg">
            @else
            <img class="prof-img2" src="/public/images/{{$user->id}}icon.jpg">
            @endif
          </div>

          <div class="item caption">
            <form class="" action="/comment/{{$id}}" method="post">
            @csrf
              @if (count($errors) > 0)
              <div>
                <ul>
                @foreach ($errors->all() as $error)
                <li class="error">{{ $error }}</li>
                @endforeach
                </ul>
              </div>
              @endif
              <input type="text" name="comment" value="">
              <input class="submit" type="submit" name="" value="コメント">
            </form>
          </div>
        </div>
    </div>
    @endif
    <div class="comment-body">
      @foreach($comments as $comment)
      <div class="comment-now-body">
      <div class="item">
        <a href="../{{ $comment->user->name_address }}/album">
        @if($user->icon_img == null)
        <img class="prof-img2 "src="/images/noimage.jpg">
        @else
        <img class="prof-img2" src="/public/images/{{$comment->user->id}}icon.jpg">
        @endif
        </a>
      </div>
      <div class="item comment-main-item">
        <span class="comment-main-name">
          {{ $comment->user->name }}
        </span>:
        {{ $comment->comment }}
        <span class="comment-main-time">
          <span class="post-time">
            -<?php echo ($comment->updated_at)->diffForHumans($now); ?>
          </span>
        </span>
        <span class="item report" id="main">
          <ul class="menu">
            <li>
              <i class="fas fa-chevron-down"></i>
                <ul class="sub">
                  @if($comment->user_id == $user->id)
                  <form method="post" action="/comment/delete/{{$comment->id}}">
                  @csrf
                  <li>
                    <input type="submit" value="削除" class="btn-danger" onclick='return confirm("コメントを削除しますか？");'>
                  </li>
                  </form>
                  @else
                  <li><a href="">報告</a></li>
                  @endif
                </ul>
            </li>
          </ul>
        </span>
        <br>
      </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection
