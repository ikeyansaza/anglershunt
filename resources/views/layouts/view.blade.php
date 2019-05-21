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
    <link rel="stylesheet" href="../css/style.css">
    {{--FontAwesomeを登録--}}
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    {{--swiperを登録--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/css/swiper.min.css">
    {{--favicon設定--}}
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon-180x180.png">　
    @yield('head')
  </head>

  <body>
    <header>
      <div class="header-container">
        <div class="item back-button2">
        <a href="../index.php"><i class="fas fa-angle-left"></i></a>
        </div>
        <div class="item">
          <h1>@yield('h1')</h1>
        </div>
        <div class="item">
          <a href="../{{ $user->name_address }}/album">
          @if($user->icon_img == null)
          <img class="prof-img" src="/images/noimage.jpg">
          @else
          <img class="prof-img" src="/public/images/{{$user->id}}icon.jpg">
          @endif
          </a>
        </div>
      </div>
    </header>

@yield('content')

  {{--Ajaxのライブラリを読み込み--}}
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  {{--Swiperのライブラリを読み込み--}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/js/swiper.min.js"></script>
  {{--1.ドロップダウンメニュー--}}
  <script>
    var mySwiper = new Swiper ('.swiper-container', {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 500,
    centeredSlides : true,
    pagination: '.swiper-pagination',
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
    loop: false
  })
  </script>
  {{--2.ドロップダウンメニュー--}}
  <script>
    $(function(){
      $("ul.menu li").click(function(){
        $("ul.sub:not(:animated)", this).slideToggle();
      });
    });
  </script>
  {{--3.スワイパー機能--}}
  <script>
  $(function(){
  var mySwiper = new Swiper ('.swiper-container', {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 500,
    centeredSlides : true,
    pagination: '.swiper-pagination',
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
    loop: false
  })
  })
  </script>
</body>
</html>
