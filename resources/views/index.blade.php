@extends('layouts.main')

@section('content')

<!-- フラッシュメッセージ -->
    <div class="content">
      <div class="left">
        <!-- 左カラム -->
        <div class="left-content">
          <div class="left-first-post">
            <div class="post-first contents">
              <a href="{{ $user->name_address }}/album">
              <div class="item prof-main">
                @if($user->icon_img == null)
                <img class="prof-img2" src="/public/images/noimage.jpg">
                @else
                <img class="prof-img2" src="/public/images/{{$user->id}}icon.jpg">
                @endif
              </div>
              </a>
              <div class="item prof-sub">
                <div class="item prof-sub-main">
                {{ $user->name }}
                </div>
              <div class="item prof-sub-sub">
              {{'@'}}{{ $user->name_address }}
              </div>
            </div>
            </div>
            <div class="post-second contents">
              <div class="item prof-follow-main">
              <a href="/follow">
                フォロー
              </div><span class="prof-follow-sub">
                {{ $follow_counts }}
              </span>
              </a>
              <div class="item prof-follow-main">
              <a href="/follower">　フォロワー
              </div><span class="prof-follow-sub">
                {{ $follower_counts }}
              </span>
              </a>
            </div>
          </div>
          <div class="ad-post">
            <img class="ad" src="images/ad1.png">
          </div>
          <div class="ad-post">
            <img class="ad" src="images/ad2.png">
          </div>
          <div class="ad-post">
            <img class="ad" src="images/ad3.png">
          </div>
          <div class="left-second-post">
            AnglerdHuntについて/
            利用規約<br>
            プライバシーポリシー/
            お問い合わせ<br>
            広告掲載について<br>
          </div>
        </div>
      </div>
      <div class="right">

        <!-- 右カラム -->
        <div class="right-content">
          @if($follow_counts == '0')
          <div style="padding:5px 10px; color: #11cd2b;">
            <div style="font-size: 20px;">
              ユーザーをフォローしてみよう！
            </div>
            <span style="border-bottom: 1px solid #11cd2b">
              <a href="searchUser">エリア検索</a>
            </span><br>
            <span style="border-bottom: 1px solid #11cd2b">
              <a href="rank/main">ランキングから</a>
            </span>
          </div>
          @else
          @foreach($posts as $post)
          <div class="post" data-postid="{{ $post->id }}">
            <div class="post-first contents">
              <a href="{{ $post->user->name_address }}/album">
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
                    　-{{ ($post->updated_at)->diffForHumans($now) }}
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
                          <form class="" action="/report" method="post">
                          @csrf
                          <li>
                          <input type="hidden" name="post_id" value="{{$post->id}}">
                          <input type="hidden" name="reporter_id" value="{{$user->id}}">
                          <input type="submit" value="報告" class="btn-danger" onclick='return confirm("投稿を報告しますか？");'>
                          </li>
                          </form>
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
            @if($post->quest_id)
            <span class="color"><i class="fas fa-crown"></i>{{$post->quest->name}}</span>
            @else
            @endif
            <div class="post-forth forth-content">
              <div class="item">
              <a href="/comment/{{ $post->id }}"><i class="far fa-comment-dots"></i></a>
              </div>
              <div class="item">
                @if(auth()->user())
                @if($post->likes()->where('user_id', Auth::user()->id)->count())
                <input type="hidden" name="post" value="{{$post->id}}">
                <input type="hidden" name="user" value="{{$user->id}}">
                <button type="submit" name="like" id="unlike" data-postid="{{ $post->id }}" data-num="{{ $post->likes()->count() }}">
                <i class="fas fa-heart"></i>
                </button>
                @else
                <input type="hidden" name="post" value="{{ $post->id }}">
                <input type="hidden" name="user" value="{{ $user->id }}">
                <button type="submit" name="like" id="like" data-postid="{{ $post->id }}" data-num="{{ $post->likes()->count() }}">
                <i class="far fa-heart"></i>
                </button>
                @endif
                @endif
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
              <span class="num{{$post->id}}">{{ $post->likes()->count() }}</span>人が「いいね！」しました
              </div>
            </div>
          </div>
          @endforeach
          @endif
        </div>
        <div class="d-flex justify-content-center">
          {{ $posts->links() }}
        </div>
      </div>
    </div>

@endsection
