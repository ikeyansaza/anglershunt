@extends('layouts.quest')

@section('h1', '達成者一覧')

@section('content')

    <div class="right-content" id="infinite-scroll">
      @foreach($posts as $post)
      <div class="new-post">
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
                　-<?php echo ($post->updated_at)->diffForHumans($now); ?>
              </div>
            </div>
            <div class="item report">
              報告
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

            @if($post->likes()->where('user_id', Auth::user()->id)->count())
            <form class="" action="unlike" method="post">
            @csrf
            <input type="hidden" name="post" value="{{$post->id}}">
            <input type="hidden" name="user" value="{{$user->id}}">
            <button type="submit" name="like">
            <i class="fas fa-heart"></i>
            </button>
            </form>

            @else
            <form class="" action="like" method="post">
            @csrf
            <input type="hidden" name="post" value="{{$post->id}}">
            <input type="hidden" name="user" value="{{$user->id}}">
            <button type="submit" name="like" id="like">
            <i class="far fa-heart"></i>
            </button>
            </form>
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
            {{ $post->likes()->count() }}人が「いいね！」しました
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="d-flex justify-content-center">
      {{ $posts->links() }}<br><br>
    </div>

@endsection
