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
    {{--FontAwesomeの登録--}}
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  </head>

  <body>
    <header>
      <div class="login-header-container">
        <div class="item unlogin-title">
          <h1 style="color: #11cf2d">AnglersHunt</h1>
        </div>
        <div class="item unlogin-sub">
        <a href="/@yield('link')">
          <span class="unlogin-item">
            @yield('span')
          </span>
        </a>
        </div>
      </div>
    </header>

    @yield('content')


  </body>
</html>
