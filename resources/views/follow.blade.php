@extends('layouts.view')

@section('h1', 'フォローリスト')

@section('content')

    <div class="follow-content">
    @foreach($followings as $following)
      <div class="follow-user">
      <a href="{{ $following->name }}/album">
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
