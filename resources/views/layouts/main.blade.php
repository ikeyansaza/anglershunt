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
    {{--viewpointの設定--}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--js用token生成--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AnglersHunt | 釣果投稿SNS</title>
    {{--style.cssを登録--}}
    <link rel="stylesheet" href="css/style.css">
    {{--FontAwesomeを登録--}}
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    {{--swiperを登録--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/css/swiper.min.css">
    {{--Flashメッセージを登録--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    {{--SEO対策--}}
    <meta content="AnglersHuntは釣り人向けの釣果投稿サイトです。
    釣果投稿機能に加えてクエスト機能やランキング機能など従来のSNSにはなかった機能も充実。利用は完全無料です。" name="description">
    {{--favicon設定--}}
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon-180x180.png">
    {{--TwitterCard設定--}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@ikeyansaza">
    <meta property="og:url" content="https://anglershunt.com">
    <meta property="og:title" content="AnglersHunt | 釣果投稿SNSサイト">
    <meta property="og:description" content="AnglersHuntは釣り人向けのSNSサイトです。現在β版運営中です。">
    <meta property="og:image" content="https://anglershunt.com/public/images/_32.jpg" />
  </head>
  <body>
    <header>
      <div class="header-container">
        <div class="item search">
        <a href="search"><i class="fas fa-search search-icon"></i></a>
        </div>
        <div class="item">
         <a href="#"><h1>AnglersHunt</h1></a>
        </div>
        <div class="item">
        @if($user->id == '25')
        <span style="border: solid 1px #e6ecef; border-radius: 20px; font-size: 14px; padding: 5px 10px;line-height:45px;margin-right: 10px;"><a href="/register">登録</a></span>
        @else
        <a href="{{ $user->name_address }}/album">
          @if($user->icon_img == null)
          <img class="prof-img "src="/images/noimage.jpg">
          @else
          <img class="prof-img" src="/public/images/{{ $user->id }}icon.jpg">
          @endif
        </a>
        @endif
        </div>
      </div>
    </header>

@yield('content')

<footer id="footer">
  <div class="footer-container">
      <div class="item">
        <a class="white" href="/"><i class="fas fa-home"></i></a>
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
      <div class="item badgemain">
      <a class="white" href="notice/main">
        <i class="fas fa-bell"></i>
        @if(auth()->user())
        @if(auth()->user()->unReadNotifications->count())
        <span class="badge">{{auth()->user()->unReadNotifications->count()}}</span>
        @endif
        @endif
      </a>
      </div>
  </div>

</footer>
{{--Ajaxのライブラリを読み込み--}}
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
{{--Swiperのライブラリを読み込み--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/js/swiper.min.js"></script>
{{--Toastrのライブラリを読み込み--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
{{--2.ページナビカラー追加--}}
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
{{--3.画像投稿プレビュー--}}
<script>
$(document).ready(function () {
  $(".file").on('change', function(){
     var fileprop = $(this).prop('files')[0],
         find_img = $(this).parent().find('img'),
         filereader = new FileReader(),
         view_box = $(this).parent('.view_box');

    if(find_img.length){
       find_img.nextAll().remove();
       find_img.remove();
    }

    var img = '<div class="img_view"><img alt="" class="img"><p><a href="#" class="img_del">画像を削除する</a></p></div>';

    view_box.append(img);

    filereader.onload = function() {
      view_box.find('img').attr({
        src: filereader.result,
        width: "150px"
      });
      img_del(view_box);
    }
    filereader.readAsDataURL(fileprop);
  });

  function img_del(target){
    target.find("a.img_del").on('click',function(){
      var self = $(this),
          parentBox = self.parent().parent().parent();
      if(window.confirm('画像を削除します。\nよろしいですか？')){
        setTimeout(function(){
          parentBox.find('input[type=file]').val('');
          parentBox.find('.img_view').remove();
        } , 0);
      }
      return false;
    });
  }

});
</script>
{{--4.無限スクロール機能（Ajax）--}}
<script>
// 3.1使用する要素名
var IScontentItems = '.post';
var IScontent = '.right-content';
var ISlink = 'a[rel=next]';
var ISlinkarea = '.pagination';
var loadingFlag = false;

$(window).on('load scroll', function() {

  if(!loadingFlag) {
      var winHeight = $(window).height();
      var scrollPos = $(window).scrollTop();
      var linkPos = $(ISlink).offset().top;

      if(winHeight + scrollPos > linkPos) {
          loadingFlag = true;

          var nextPage = $(ISlink).attr('href');
          $(ISlink).remove();

          $.ajax({
              type: 'GET',
              url: nextPage,
              dataType: 'html'
          }).done(function(data) {
              var nextLink = $(data).find(ISlink);
              var contentItems = $(data).find(IScontentItems);

              $(IScontent).append(contentItems);

              if(nextLink.length > 0) {
                  $(ISlinkarea).append(nextLink);
                  loadingFlag = false;
              }

              jQuery(function($){
              $("button[id=like]").on('click',function(){

                  var id =  $(this).data('postid');
                  var num =  $(this).data('num');
                  console.log(id);
                  console.log(num);

                  $.ajaxSetup({
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                  });
                  var $this = $(this);
                  var data = {'post' : id,
                              'user' : {{ $user->id }}
                             };
                  $.ajax({
                      url: "like",
                      type: 'post',
                      data : data,
                  //通信に成功した場合
                  success : function(json,data) {
                  $this.children('i').addClass('fas');
                  $this.closest('button[id=like]').attr('id', 'unlike');
                  $('.num'+id).text(num+1);
                  console.log('成功しました');
                  $("button[id=unlike]").on('click',function(){
                      var id =  $(this).data('postid');
                      var num =  $(this).data('num');
                      console.log(id);
                      console.log(num);

                      $.ajaxSetup({
                          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                      });
                      var $this = $(this);

                      var data = {'post' : id,
                                  'user' : {{ $user->id }}
                                 };

                      $.ajax({
                          url: "unlike",
                          type: 'post',
                          data : data,

                      //通信に成功した場合
                      success : function(json,data) {
                      $this.children('i').removeClass('fas');
                      $this.children('i').addClass('far');
                      $this.closest('button[id=unlike]').attr('id', 'like');
                      $('.num'+id).text(num);
                      console.log('成功しました');
                      },

                      //失敗した場合
                      error : function(XMLHttpRequest, textStatus, errorThrown) {
                      alert("エラーが発生しました：" + textStatus + ":\n" + errorThrown);
                      }
                    })
                  });
                  },
                  //失敗した場合
                  error : function(XMLHttpRequest, textStatus, errorThrown) {
                  alert("エラーが発生しました：" + textStatus + ":\n" + errorThrown);
                  }
                })
              });
            });

            jQuery(function($){
            $("button[id=unlike]").on('click',function(){
                var id =  $(this).data('postid');
                var num =  $(this).data('num');
                console.log(id);
                console.log(num);

                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                });
                var $this = $(this);

                var data = {'post' : id,
                            'user' : {{ $user->id }}
                           };

                $.ajax({
                    url: "unlike",
                    type: 'post',
                    data : data,

                //通信に成功した場合
                success : function(json,data) {
                $this.children('i').removeClass('fas');
                $this.children('i').addClass('far');
                $('.num'+id).text(num-1);
                console.log('成功しました');
                },
                //失敗した場合
                error : function(XMLHttpRequest, textStatus, errorThrown) {
                alert("エラーが発生しました：" + textStatus + ":\n" + errorThrown);
                }
              })
            });
            });

              jQuery(function($){
                $("ul.menu li").click(function(){
                $("ul.sub:not(:animated)", this).slideToggle();
              });
              });

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
              })
              })
              })
          }).fail(function () {
              alert('ページの取得に失敗しました。');
          });
      }
    }
});
</script>
{{--5.お気に入り登録機能--}}
<script>
$("button[id=like]").on('click',function(){

    var id =  $(this).data('postid');
    var num =  $(this).data('num');
    console.log(id);
    console.log(num);
    console.log('likeボタン');

    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
    var $this = $(this);

    var data = {'post' : id,
                'user' : {{ $user->id }}
               };

    $.ajax({
        url: "like",
        type: 'post',
        data : data,

    //通信に成功した場合
    success : function(json,data) {
    $this.children('i').addClass('fas');
    $this.closest('button[id=like]').attr('id', 'unlike');

    $('.num'+id).text(num+1);
    console.log('成功しました');

    $("button[id=unlike]").on('click',function(){
        event.preventDefault();

        var id =  $(this).data('postid');
        var num =  $(this).data('num');
        console.log(id);
        console.log(num);
        console.log('unlikeボタン');

        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        var $this = $(this);

        var data = {'post' : id,
                    'user' : {{ $user->id }}
                   };

        $.ajax({
            url: "unlike",
            type: 'post',
            data : data,

        //通信に成功した場合
        success : function(json,data) {
        $this.children('i').removeClass('fas');
        $('.num'+id).text(num);
        console.log('成功しました');
        },
        //失敗した場合
        error : function(XMLHttpRequest, textStatus, errorThrown) {
        alert("エラーが発生しました：" + textStatus + ":\n" + errorThrown);
        }
      })
    });
    },

    //失敗した場合
    error : function(XMLHttpRequest, textStatus, errorThrown) {
    alert("エラーが発生しました：" + textStatus + ":\n" + errorThrown);
    }
  })
});
</script>
{{--6.お気に入り解除機能--}}
<script>
$("button[id=unlike]").on('click',function(){

    var id =  $(this).data('postid');
    var num =  $(this).data('num');
    console.log(id);
    console.log(num);

    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
    var $this = $(this);

    var data = {'post' : id,
                'user' : {{ $user->id }}
               };

    $.ajax({
        url: "unlike",
        type: 'post',
        data : data,

    //通信に成功した場合
    success : function(json,data) {
    $this.children('i').removeClass('fas');
    $this.children('i').addClass('far');
    $this.closest('button[id=unlike]').attr('id', 'like');
    $('.num'+id).text(num-1);
    console.log('成功しました');
    },

    //失敗した場合
    error : function(XMLHttpRequest, textStatus, errorThrown) {
    alert("エラーが発生しました：" + textStatus + ":\n" + errorThrown);
    }
  })
});
</script>
{{--7.swiper機能--}}
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
})
})
</script>
{{--8.ドロップダウンメニュー--}}
<script>
  $(function(){
    $("ul.menu li").click(function(){
      $("ul.sub:not(:animated)", this).slideToggle();
    });
  });
</script>
{{--9.toastrメッセージ機能--}}
<script>
  @if (session('flash_message'))
    $(function () {
        toastr.options.timeOut = 2000;
        toastr.success('{{ session('flash_message') }}');
    });
  @endif
</script>
</body>
</html>
