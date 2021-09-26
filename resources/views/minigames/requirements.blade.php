<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <!-- MOBILE APP META TAGS -->
    <meta name="theme-color" content="#000000">
    <meta name="HandheldFriendly" content="true">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="msapplication-navbutton-color" content="#000000">
    <meta name="apple-mobile-web-app-status-bar-style" content="#000000">

    <meta name="msapplication-TileImage" content="images/favicon/144x144.png">
    <meta name="apple-mobile-web-app-title" content="{{config('app.name')}}">

    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/32x32.png">
    <link rel="icon" type="image/png" sizes="64x64" href="images/favicon/64x64.png">
    <link rel="icon" type="image/png" sizes="128x128" href="images/favicon/128x128.png">

    <title>{{config('app.name')}}</title>
    <meta name="title" content="{{config('app.name')}}">
    <meta name="description" content="{{config('app.description')}}">

    <style>
      html, body{
        margin: 0;
        padding: 0;
        background-color: black;
        color: white;
        font-family: 'Roboto', sans-serif;
      }

      .requirements-container{
        padding: 100px;
        max-width: 400px;
        margin: auto;
        text-align: center;
      }

      .scan-logo{
        max-width: 275px;
        display: block;
        margin: auto;
      }

      a{
        color: #2a63ff !important;
        text-decoration: none;
      }

      .go-back{
        margin-top: 60px;
      }
    </style>
  </head>
  <body>
    <div class="requirements-container">
      <header class="requirements-head">
        <img class="scan-logo" src="/images/logos/logo.svg" alt="SCAN DeFi logo">
        <h1>You don't have enought SCAN to play</h1>
      </header>
      <div class="requirements-content">
        <p>If you want to play any SCAN DeFi minigame, you have to hold at least 1,000 SCAN in your logged in wallet.</p>
      </div>
      <footer class="requirements-foot">
        <h2><strong><a href="https://pancakeswap.finance/swap?outputCurrency=0xccce542413528cb57b5761e061f4683a1247adcb" target="_blank">CLICK HERE TO BUY SCAN</a></strong></h2>

        @php if(isset($_SERVER) && isset($_SERVER["HTTP_REFERER"])): @endphp
          <p class="go-back"><small><a href="{{$_SERVER["HTTP_REFERER"]}}">GO BACK</a></small></p>
        @php endif; @endphp
      </footer>
    </div>
  </body>
</html>