<!DOCTYPE html>
<html lang="ja">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-135296207-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-135296207-3');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ">
    <title>AnglersHunt</title>
    <link rel="stylesheet" href="css/style.css">
    {{--FontAwesomeを登録--}}
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  </head>

  <body>
    <header>
      <div class="header-container">
        <div class="item back-button2">
        <a href="index.php"><i class="fas fa-angle-left"></i></a>
        </div>
        <div class="item">
          <h1>投稿</h1>
        </div>
        <div class="item">
          <a href="{{ $user->name_address }}/album">
          @if($user->icon_img == null)
          <img class="prof-img "src="/images/noimage.jpg">
          @else
          <img class="prof-img" src="/public/images/{{$user->id}}icon.jpg">
          @endif
          </a>
        </div>
      </div>
    </header>

<form method="post" action="/post" enctype="multipart/form-data">
@csrf

<div class="content">
  <div class="site-width">
    <div class="post-main">
      <div class="first-post-content first-post">
        <div class="item">
        </div>
        <div class="item">
        </div>
      </div>
        <div class="contents second-post">
          <div class="item second-post-img">
            @if($user->icon_img == null)
            <img class="prof-img2" src="/images/noimage.jpg">
            @else
            <img class="prof-img2" src="/public/images/{{$user->id}}icon.jpg">
            @endif
          </div>
          <div class="item caption">
            <div class="form">
                <div class="form-title">
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
          </div>
        </div>
        <div class="form-submit">
          <input class="submit" type="submit" name="" value="投稿する">
        </div>
    </div>
  </div>
</div>

</div>
</form>

<footer id="footer">
  <div class="footer-container">
      <div class="item">
        <a class="white" href="index.php"><i class="fas fa-home"></i></a>
      </div>
      <div class="item">
      <a class="white" href="quest/quest"><i class="fas fa-khanda"></i></a>
      </div>
      <div class="item">
      <a class="white" href="post"><i class="fas fa-plus-circle"></i></a>
      </div>
      <div class="item">
      <a class="white" href="rank/main"><i class="fas fa-crown"></i></a>
      </div>
      <div class="item">
      <a class="white" href="notice/main"><i class="fas fa-bell"></i></a>
      </div>
  </div>
</footer>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
{{--1.フッターの高さを固定--}}
<script>
$(function(){
  var $ftr = $('#footer');
  if($('#footer').length){
    if( window.innerHeight > $ftr.offset().top + $ftr.outerHeight() ){
      $ftr.attr({'style': 'position:fixed; top:' + (window.innerHeight - $ftr.outerHeight()) +'px;' });
    }
  }});
</script>
{{--2.フッターナビ--}}
<script>
$(function(){
  $('footer .item a').each(function(){
    var $href = $(this).attr('href');
    if(location.href.match($href)) {
      $(this).parent().addClass('current');
    } else {
      $(this).parent().removeClass('current');
    }
  });
});
</script>

</body>
</html>
