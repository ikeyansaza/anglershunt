@extends('layouts.view')

@section('h1', 'フォロワーリスト')

@section('content')

    <div class="follow-content">
    @foreach($followers as $follower)
      <div class="follow-user">
      <a href="{{ $follower->name }}/album">
      <div class="follow-user-prof">
        @if($follower->icon_img == null)
        <img class="prof-img2 "src="/images/noimage.jpg">
        @else
        <img class="prof-img2" src="/public/images/{{$follower->id}}icon.jpg">
        @endif
      </div>
      </a>
      <div class="follow-user-content">
        <span class="follow-content-name">{{ $follower->name }}</span><br>
        <span class="follow-content-add">{{'@'}}{{ $follower->name_address }}</span>
      </div>
      <div class="follow-user-button item">
        <span class="follow-button">

          @if (auth()->user()->isFollowing($follower->id))
            <form action="{{route('unfollow', ['id' => $follower->id])}}" method="POST">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}

              <button type="submit" id="delete-follow-{{ $follower->id }}" class="btn btn-danger">
                フォロー解除
              </button>
            </form>
          @else
            <form action="{{route('follow', ['id' => $follower->id])}}" method="POST">
            {{ csrf_field() }}

            <button type="submit" id="follow-user-{{ $follower->id }}" class="btn btn-success">
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
