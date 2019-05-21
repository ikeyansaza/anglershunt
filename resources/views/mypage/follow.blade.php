@extends('layouts.mypageSub')

@section('content')
  <body>
    <header>
      <div class="header-container">
        <div class="item back-button2">
        <a href="../index.php"><i class="fas fa-angle-left"></i></a>
        </div>
        <div class="item">
          <h1>フォローリスト</h1>
        </div>
        <a href="../{{ $user->name_address }}/album">
        <div class="item">
          @if($user->icon_img == null)
          <img class="prof-img "src="/images/noimage.jpg">
          @else
          <img class="prof-img" src="/public/images/{{$user->id}}icon.jpg">
          @endif
        </div>
        </a>
      </div>
    </header>

    <div class="follow-content">
    @foreach($followings as $following)
      <div class="follow-user">
      <a href="../../{{ $following->name }}/album">
      <div class="follow-user-prof">
        @if($following->icon_img == null)
        <img class="prof-img2 "src="/images/noimage.jpg">
        @else
        <img class="prof-img2" src="/public/images/{{$following->id}}icon.jpg">
        @endif
      </div>
      </a>
      <div class="follow-user-content">
        <span class="follow-content-name">{{ $following->name }}</span><br>
        <span class="follow-content-add">{{'@'}}{{ $following->name_address }}</span>
      </div>
      <div class="follow-user-button item">
        <span class="follow-button">

          @if (auth()->user()->isFollowing($following->id))
            <form action="{{route('unfollow', ['id' => $following->id])}}" method="POST">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}

              <button type="submit" id="delete-follow-{{ $following->id }}" class="btn btn-danger">
                フォロー解除
              </button>
            </form>
          @else
            <form action="{{route('follow', ['id' => $following->id])}}" method="POST">
            {{ csrf_field() }}

            <button type="submit" id="follow-user-{{ $following->id }}" class="btn btn-success">
              フォローする
            </button>
            </form>
          @endif

        </span>
      </div>
      </div>
    @endforeach
    </div>

@endsection
