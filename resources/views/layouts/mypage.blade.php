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

  </head>
  <body>
    <section>
      <div class="header-top">
        <div class="back-button">
        <a href="../index.php"><i class="fas fa-angle-left"></i></a>
        </div>
        <div class="header-img">
          @if($user->header_img == null)
          <img class="header-img-item" src="/public/images/header-img.jpg">
          @else
          <img class="header-img-item" src="/public/images/{{$user->id}}.jpg">
          @endif
        </div>
      </div>
    </section>

@yield('content')

<footer id="footer">
  <div class="footer-container">
      <div class="item">
        <a class="white" href="../index.php"><i class="fas fa-home"></i></a>
      </div>
      <div class="item">
      <a class="white" href="../quest/quest"><i class="fas fa-khanda"></i></a>
      </div>
      <div class="item">
      <a class="white" href="../post"><i class="fas fa-plus-circle"></i></a>
      </div>
      <div class="item">
      <a class="white" href="../rank/main"><i class="fas fa-crown"></i></a>
      </div>
      <div class="item">
      <a class="white" href="../notice/main"><i class="fas fa-bell"></i></a>
      </div>
  </div>

</footer>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
{{--Swiperのライブラリを読み込み--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/js/swiper.min.js"></script>
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
{{--2.フッターナビにマーク--}}
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
{{--3.ドロワーメニューを装備--}}
<script>
  $(function(){
    $("ul.menu li").click(function(){
      $("ul.sub:not(:animated)", this).slideToggle();
    });
  });
</script>
{{--4.モーダルウィンドウ--}}
<script>
  $(function () {
    $('button').on('click', function(){
    var id =  $(this).data('target');
    console.log( id );
    $('#modalArea'+id).fadeIn();

    jQuery(function($){
    $(function(){
    var mySwiper = new Swiper ('.swiper-container', {
      loop: true,
      slidesPerView: 1,
      spaceBetween: 500,
      centeredSlides : false,
      pagination: '.swiper-pagination',
      nextButton: '.swiper-button-next',
      prevButton: '.swiper-button-prev',
      loop: false
    })
    })
    })

    $('#closeModal , #modalBg').click(function(){
      $('#modalArea'+id).fadeOut();
    });
    });
  });
</script>
{{--5.お気に入り機能--}}
{{--6.無限スクロール機能--}}
{{--7.スワイパー機能--}}
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
