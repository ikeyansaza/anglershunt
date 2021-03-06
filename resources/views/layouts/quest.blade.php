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
    <!--Google Adsense-->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({
              google_ad_client: "ca-pub-3225344914379866",
              enable_page_level_ads: true
         });
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ">
    <title>AnglersHunt</title>
    <link rel="stylesheet" href="@yield('style')../css/style.css">
    {{--FontAwesomeを登録--}}
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    {{--Flashメッセージを登録--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    {{--favicon設定--}}
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon-180x180.png">
  </head>
  <body>
    <header>
      <div class="header-container">
        <div class="item back-button2">
        <a href="../../index.php"><i class="fas fa-angle-left"></i></a>
        </div>
        <div class="item">
          <h1>@yield('h1')</h1>
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

@yield('content')

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$(function(){
  // 1.フッターの高さを固定（コンテンツが少ない場合にもデザインが崩れないよう）
  var $ftr = $('#footer');
  if($('#footer').length){
    if( window.innerHeight > $ftr.offset().top + $ftr.outerHeight() ){
      $ftr.attr({'style': 'position:fixed; top:' + (window.innerHeight - $ftr.outerHeight()) +'px;' });
    }
  }});
</script>
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
<script>
  @if (session('flash_message'))
      $(function () {
              toastr.success('{{ session('flash_message') }}');
      });
  @endif
</script>

</body>
</html>
