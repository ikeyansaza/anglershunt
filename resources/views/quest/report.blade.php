@extends('layouts.quest')

@section('style', '../../')

@section('h1', '達成報告')

@section('content')

    <form class="" action="../../../quest/achievement" method="post" enctype="multipart/form-data">
    @csrf
    <div class="content">
      <div class="site-width">
        <div class="post-main">
          <div class="first-post-content first-post">
            <div class="item first-post-item">
            </div>
            <div class="item">
            <span class="done-post">{{ $quests->name }}</span>
            </div>
            <div class="item first-post-item">
            </div>
          </div>
            <div class="contents second-post">
              <div class="item second-post-img">
                @if($user->icon_img == null)
                <img class="prof-img2 "src="/images/noimage.jpg">
                @else
                <img class="prof-img2" src="/public/images/{{$user->id}}icon.jpg">
                @endif
              </div>
              <div class="item caption">
                @if (count($errors) > 0)
                <div>
                  <ul>
                  @foreach ($errors->all() as $error)
                  <li class="error">{{ $error }}</li>
                  @endforeach
                  </ul>
                </div>
                @endif
                <div class="form-content">
                  <textarea class="" name="post" cols="35" rows="5" placeholder="コメントを入力する">{{ old('content') }}</textarea>
                </div>
                <input type="hidden" name="quest_id" value="{{$quest_id}}">
                <input type="hidden" name="report_id" value="{{$report_id}}">
                <input type="hidden" name="year" value="{{$year}}">
                <input type="hidden" name="month" value="{{$month}}">
                <input type="hidden" name="point" value="{{$quests->point}}">

                <div class="item caption-sub">
                  {{--複数画像のアップロード--}}
                  <div class="view">
                    <div class="form-image_url view_box item">
                        <input type="file" class="file" name="pic1">
                    </div>
                    <div class="form-image_url view_box item">
                        <input type="file" class="file" name="pic2">
                    </div>
                    <div class="form-image_url view_box item">
                        <input type="file" class="file" name="pic3">
                    </div>
                    <div class="form-image_url view_box item">
                        <input type="file" class="file" name="pic4"><br><br>
                    </div>
                  </div>
                </div>
                <div class="form-submit">
                  <input class="submit" type="submit" name="" value="投稿する">
                </div>
              </div>
            </div>
        </div>
      </form>
    </div>
  </div>

<footer id="footer">
  <div class="footer-container">
      <div class="item">
        <a class="white" href="../../../index.php"><i class="fas fa-home"></i></a>
      </div>
      <div class="item">
      <a class="white" href="../../../quest/quest"><i class="fas fa-khanda"></i></a>
      </div>
      <div class="item">
      <a class="white" href="../../../post"><i class="fas fa-plus-circle"></i></a>
      </div>
      <div class="item">
      <a class="white" href="../../../rank/main"><i class="fas fa-crown"></i></a>
      </div>
      <div class="item">
      <a class="white" href="../../../notice/main"><i class="fas fa-bell"></i></a>
      </div>
  </div>
</footer>

@endsection
