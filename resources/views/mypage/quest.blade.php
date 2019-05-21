@extends('layouts.mypage')

@section('content')
<div class="mypage-content">
  <div class="prof-header">
    <div class="prof-header-main">
      <div class="item">
        @if($currentUserInfo->icon_img == null)
        <img class="prof-img5" src="/images/noimage.jpg">
        @else
        <img class="prof-img5" src="/public/images/{{$currentUserInfo->id}}icon.jpg">
        @endif
      </div>

      <div class="item mypage-item">
          <div class="mypage-name">{{ $currentUserInfo->name }}</span><br>
          @if(auth()->user())
          @if($user->id == $currentUserInfo->id)
            <a href="/mypage/edit">
              <div class="mypage-edit item">プロフィール変更</div>
            </a>
            <div id="main" class="item">
              <ul class="menu">
                <li>
                  <span class="sankaku">▼</span>
                    <ul class="sub">
                      <li><a href="../logout">ログアウト</a></li>
                    </ul>
                </li>
              </ul>
            </div>
          @else(!($user->id == $currentUserInfo->id ))
          @if (auth()->user()->isFollowing($currentUserInfo->id))
            <form class="follow-edit" action="{{route('unfollow', ['id' => $currentUserInfo->id])}}" method="POST">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" id="delete-follow-{{ $currentUserInfo->id }}" class="btn btn-danger">
                <span class="mypage-edit">フォロー解除</span>
              </button>
            </form>
          @else
            <form class="follow-edit" action="{{route('follow', ['id' => $currentUserInfo->id])}}" method="POST">
            {{ csrf_field() }}
            <button type="submit" id="follow-user-{{ $currentUserInfo->id }}" class="btn btn-success">
              <span class="mypage-edit">フォロー</span>
            </button>
            </form>
          @endif
          @endif
          @endif
        </div>
        <span class="mypage-comment">宜しくおねがします。</span><br>
        <span class="mypage-follow"><a href="follow">フォロー<span class="color">{{ $follows }}</span></a> <a href="follower">フォロワー<span class="color">{{ $followers }}</span></a></span><br>
        <span class="mypage-point">クエスト獲得経験値 {{ $currentUserInfo->total_point }}pt</span>
    </div>
  </div>

    <div class="prof-nav">
      <div class="item">
      <a href="album">アルバム</a>
      </div>
      <div class="item prof-nav-item new">
      クエスト投稿
      </div>
      <div class="item">
      <a href="mypost">投稿</a>
      </div>
    </div>
    <div class="right-content" id="infinite-scroll">
      @foreach($posts as $post)
      <div class="post">
        <div class="post-first contents">
          <a href="../{{ $post->user->name_address }}/quests">
          <div class="item">
            @if($post->user->icon_img == null)
            <img class="prof-img2 "src="/images/noimage.jpg">
            @else
            <img class="prof-img2" src="/public/images/{{$post->user->id}}icon.jpg">
            @endif
          </div>
          </a>
          <div class="item post-main-content">
            <div class="item post-sub-content">
              <div class="item post-name">
                {{--モデルのリレーションを利用--}}
                {{ $post->user->name }}
              </div>
              <div class="item post-time">
                　-<?php echo ($post->updated_at)->diffForHumans($now); ?>
              </div>
            </div>
            <div class="item report" id="main">
              <ul class="menu">
                <li>
                  <i class="fas fa-chevron-down"></i>
                    <ul class="sub">
                      @if($post->user_id == $user->id)
                      <form method="post" action="/post/delete/{{$post->id}}">
                      @csrf
                      <li>
                        @if($post->quest_id)
                        <input type="hidden" name="point" value="{{$post->quest->point}}" class="btn-danger";>
                        <input type="hidden" name="achievement_id" value="{{$post->achievement->id}}">
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
            @if ($post->pic1)
            <p class="swiper-slide"><img src ="/public/images/_{{$post->id}}.jpg"></p><br><br>
            @endif
            @if ($post->pic2)
            <p class="swiper-slide"><img src ="/public/images/_{{$post->id}}-2.jpg"></p><br><br>
            @endif
            @if ($post->pic3)
            <p class="swiper-slide"><img src ="/public/images/_{{$post->id}}-3.jpg"></p><br><br>
            @endif
            @if ($post->pic4)
            <p class="swiper-slide"><img src ="/public/images/_{{$post->id}}-4.jpg"></p><br><br>
            @endif
            </div>

            @if(!($post->pic2 == null))
            <!-- If we need pagination -->
              <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
              <div class="swiper-button-prev swiper-button-white"></div>

              <div class="swiper-button-next swiper-button-white"></div>
            @endif
          </div>
        </div>
        <div class="post-third">
          {{ $post->post }}
        </div>
        <div class="quest-title-color">
          #{{ $post->quest->name }}
        </div>
        <div class="post-forth forth-content">
          <div class="item">
          <a href="/comment/{{ $post->id }}"><i class="far fa-comment-dots"></i></a>
          </div>
          <div class="item">

          </div>
        </div>
        <div class="post-fifth fifth-content">
          @if(!($post->comment->count() == '0'))
          <div class="item">
            {{ $post->comment->count() }}件のコメントがあります
          </div>
          @else
          <div class="item">
            {{--表示調整用--}}
          </div>
          @endif
          <div class="item">
            {{ $post->likes()->count() }}人が「いいね！」しました
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="d-flex justify-content-center">
      {{ $posts->links() }}<br><br>
    </div>

  </div>
</div>

@endsection
