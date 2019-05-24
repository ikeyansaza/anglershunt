@extends('layouts.view')

@section('h1', '検索')

@section('content')

    <div class="search-word">
      <form class="" action="/search">
        <button type="submit" name="button">
          <i class="fas fa-search"></i>
        </button>
        <input type="text" name="keyword" value="{{ $keyword }}" class="form-control" placeholder="検索">
      </form>
      <div class="search-user">
        <a href="/searchUser" style="border-bottom: 1px solid #11cb2d;">ユーザー検索はこちら</a>
      </div>
    </div>

    <div class="right-content">
    @foreach($data as $datas)
    <div class="post">
      <div class="post-first contents">
        <a href="{{ $datas->user->name_address }}/album">
        <div class="item">
          @if($datas->user->icon_img == null)
          <img class="prof-img2 "src="/images/noimage.jpg">
          @else
          <img class="prof-img2" src="/public/images/{{$datas->user->id}}icon.jpg">
          @endif
         </div>
        </a>
        <div class="item post-main-content">
          <div class="item post-sub-content">
            <div class="item post-name">
              {{ $datas->user->name }}
            </div>
            <div class="item post-time">
              　- <?php echo ($datas->updated_at)->diffForHumans($now); ?>
            </div>
          </div>
          <div class="item report" id="main">
            <ul class="menu">
              <li>
                <i class="fas fa-chevron-down"></i>
                  <ul class="sub">
                    @if($datas->user_id == $user->id)
                    <form method="post" action="/post/delete/{{$datas->id}}">
                    @csrf
                    <li>
                      @if($datas->quest_id)
                      <input type="hidden" name="point" value="{{$datas->quest->point}}" class="btn-danger";>
                      <input type="hidden" name="achievement_id" value="{{$datas->achievement->id}}">
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
          @if ($datas->pic1)
          <p class="swiper-slide"><img src ="/public/images/_{{$datas->id}}.jpg"></p><br><br>
          @endif
          @if ($datas->pic2)
          <p class="swiper-slide"><img src ="/public/images/_{{$datas->id}}-2.jpg"></p><br><br>
          @endif
          @if ($datas->pic3)
          <p class="swiper-slide"><img src ="/public/images/_{{$datas->id}}-3.jpg"></p><br><br>
          @endif
          @if ($datas->pic4)
          <p class="swiper-slide"><img src ="/public/images/_{{$datas->id}}-4.jpg"></p><br><br>
          @endif
          </div>

          @if(!($datas->pic2 == null))
          <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

          <!-- If we need navigation buttons -->
            <div class="swiper-button-prev swiper-button-white"></div>

            <div class="swiper-button-next swiper-button-white"></div>
          @endif
        </div>
      </div>
      <div class="post-third">
        {{ $datas->post }}
      </div>
      <div class="post-forth forth-content">
        <div class="item">
        @if(auth()->user())
        <a href="/comment/{{ $datas->id }}"><i class="far fa-comment-dots"></i></a>
        @endif
        </div>
        <div class="item">
          @if(auth()->user())
          @if($datas->likes()->where('user_id', Auth::user()->id)->count())
          <input type="hidden" name="post" value="{{$datas->id}}">
          <input type="hidden" name="user" value="{{$user->id}}">
          <button type="submit" name="like" id="unlike" data-postid="{{ $datas->id }}" data-num="{{ $datas->likes()->count() }}">
          <i class="fas fa-heart"></i>
          </button>
          @else
          <input type="hidden" name="post" value="{{ $datas->id }}">
          <input type="hidden" name="user" value="{{ $user->id }}">
          <button type="submit" name="like" id="like" data-postid="{{ $datas->id }}" data-num="{{ $datas->likes()->count() }}">
          <i class="far fa-heart"></i>
          </button>
          @endif
          @endif
        </div>
      </div>
      <div class="post-fifth fifth-content">
        @if(!($datas->comment->count() == '0'))
        <div class="item">
          {{ $datas->comment->count() }}件のコメントがあります
        </div>
        @else
        <div class="item">
          {{--表示調整用--}}
        </div>
        @endif
        <div class="item">
        <span class="num{{$datas->id}}">{{ $datas->likes()->count() }}</span>人が「いいね！」しました
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="d-flex justify-content-center">
    {{ $data->links() }}<br><br>
  </div>

@endsection
