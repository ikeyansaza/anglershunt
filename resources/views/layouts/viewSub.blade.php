<!DOCTYPE html>
<html lang="ja" dir="ltr">
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
    <title>@yield('title')</title>
    <link rel="stylesheet" href="../css/style.css">
    {{--favicon設定--}}
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon-180x180.png">
  </head>
  <body>
    <div class="others">
    <h1>@yield('h1')</h1>

    @yield('content')

  </div>

  </body>
</html>
