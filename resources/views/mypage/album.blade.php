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
          <div class="mypage-name">{{ $currentUserInfo->name }}
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
                      <li><a href="../help">ヘルプ</a></li>
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
                <span>フォロー解除</span>
              </button>
            </form>
          @else
            <form class="follow-edit" action="{{route('follow', ['id' => $currentUserInfo->id])}}" method="POST">
            {{ csrf_field() }}
            <button type="submit" id="follow-user-{{ $currentUserInfo->id }}" class="btn btn-success">
              <span>フォロー</span>
            </button>
            </form>
          @endif
          @endif
          @endif
          </div>
        <span class="mypage-comment">{{ $currentUserInfo->comment }}</span><br>
        <span class="mypage-follow"><a href="follow">フォロー<span class="color">{{ $follows }}</span></a> <a href="follower">フォロワー<span class="color">{{ $followers }}</span></a></span><br>
        <span class="mypage-point">クエスト獲得経験値 {{ $currentUserInfo->total_point }}pt</span>
      </div>
    </div>

    <div class="prof-nav">
      <div class="item prof-nav-item">アルバム</div>
      <div class="item new"><a href="quests">クエスト投稿</a></div>
      <div class="item"><a href="mypost">投稿</a></div>
    </div>

    <div class="prof-album-main">
    @foreach($photos as $photo)
      <button id="openModal{{$photo->id}}" data-target="{{$photo->id}}">
      <div class="item">
      @if ($photo->pic1)
      <img class="album-img"  src ="/public/images/_{{ $photo->id }}.jpg">
      @endif
      </div>
      </button>

    <!-- モーダルエリアここから -->
    <section id="modalArea{{$photo->id}}" class="modalArea" data-target="modal{{$photo->id}}">
      <div id="modalBg" class="modalBg"></div>
      <div class="modalWrapper">
        <div class="modalContents">
          <div class="swiper-container">
            <div class="swiper-wrapper">
            @if ($photo->pic1)
            <p class="swiper-slide"><img src ="/public/images/_{{$photo->id}}.jpg"></p><br><br>
            @endif
            @if ($photo->pic2)
            <p class="swiper-slide"><img src ="/public/images/_{{$photo->id}}-2.jpg"></p><br><br>
            @endif
            @if ($photo->pic3)
            <p class="swiper-slide"><img src ="/public/images/_{{$photo->id}}-3.jpg"></p><br><br>
            @endif
            @if ($photo->pic4)
            <p class="swiper-slide"><img src ="/public/images/_{{$photo->id}}-4.jpg"></p><br><br>
            @endif
            </div>

            @if(!($photo->pic2 == null))
            <!-- If we need pagination -->
              <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
              <div class="swiper-button-prev swiper-button-white"></div>

              <div class="swiper-button-next swiper-button-white"></div>
            @endif
          </div>
        </div>
        <div id="closeModal" class="closeModal">
          ×
        </div>
      </div>
    </section>
    <!-- モーダルエリアここまで -->

    @endforeach
    </div>
  </div>
  </div>

@endsection

{{--
<div class="modalContents">
  <div class="swiper-container">
    <div class="swiper-wrapper">
    @if ($photo->pic1)
    <p class="swiper-slide"><img src ="/public/images/_{{$photo->id}}.jpg"></p><br><br>
    @endif
    @if ($photo->pic2)
    <p class="swiper-slide"><img src ="/public/images/_{{$photo->id}}-2.jpg"></p><br><br>
    @endif
    @if ($photo->pic3)
    <p class="swiper-slide"><img src ="/public/images/_{{$photo->id}}-3.jpg"></p><br><br>
    @endif
    @if ($photo->pic4)
    <p class="swiper-slide"><img src ="/public/images/_{{$photo->id}}-4.jpg"></p><br><br>
    @endif
    </div>

    @if(!($photo->pic2 == null))
    <!-- If we need pagination -->
      <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
      <div class="swiper-button-prev swiper-button-white"></div>

      <div class="swiper-button-next swiper-button-white"></div>
    @endif
  </div>
</div>
--}}
