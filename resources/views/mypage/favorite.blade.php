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
          <span class="mypage-name">{{ $currentUserInfo->name }}</span><br>
          @if($user->id == $currentUserInfo->id)
            <a href="/mypage/edit"><span class="mypage-edit">プロフィール変更</span></a><span class="mypage-new-edit">▼</span><br>
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
        <span class="mypage-comment">宜しくおねがします。</span><br>
        <span class="mypage-follow"><a href="follow">フォロー<span class="color">{{ $follows }}</span></a> <a href="follower">フォロワー<span class="color">{{ $followers }}</span></a></span><br>
        <span class="mypage-point">クエスト獲得経験値 {{ $currentUserInfo->total_point }}pt</span>
      </div>
    </div>

    <div class="prof-nav">
      <div class="item">
      <a href="album">アルバム</a>
      </div>
      <div class="item">
      <a href="quests">クエスト投稿</a>
      </div>
      <div class="item">
      <a href="mypost">投稿</a>
      </div>
      <div class="item prof-nav-item">
      お気に入り
      </div>
    </div>
@foreach($like as $likes)
{{$likes->id}}
@endforeach
    <div class="prof-album-main">
    @foreach($photos as $photo)
      <div class="item">
      @if ($photo->pic1)
      <img class="album-img"  src ="/public/images/_{{ $photo->id }}.jpg">
      @endif
      </div>
    @endforeach
    </div>

  </div>
</div>

@endsection
