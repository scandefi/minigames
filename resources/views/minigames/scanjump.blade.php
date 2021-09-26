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

    <meta name="msapplication-TileImage" content="{{url('minigames/'.$minigame->slug.'/images/favicon/144x144.png')}}">
    <meta name="apple-mobile-web-app-title" content="{{$minigame->name}} | {{config('app.name')}}">

    <link rel="icon" type="image/png" sizes="16x16" href="{{url('minigames/'.$minigame->slug.'/images/favicon/16x16.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('minigames/'.$minigame->slug.'/images/favicon/32x32.png')}}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{url('minigames/'.$minigame->slug.'/images/favicon/64x64.png')}}">
    <link rel="icon" type="image/png" sizes="128x128" href="{{url('minigames/'.$minigame->slug.'/images/favicon/128x128.png')}}">

    <title>{{$minigame->name}} | {{config('app.name')}}</title>
    <meta name="title" content="{{$minigame->name}} | {{config('app.name')}}">
    <meta name="description" content="{{config('app.description')}}">

    <!-- Robots -->
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <link rel="canonical" href="{{url($minigame->slug)}}" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{url($minigame->slug)}}">
    <meta property="og:title" content="{{$minigame->name}} | {{config('app.name')}}">
    <meta property="og:description" content="{{config('app.description')}}">
    <meta property="og:image:secure_url" content="{{url('minigames/'.$minigame->slug.'/images/rrss/203x136.jpg')}}">
    <meta property="og:image" content="{{url('minigames/'.$minigame->slug.'/images/rrss/203x136.jpg')}}">
    <meta property="og:image:alt" content="{{$minigame->name}} | {{config('app.name')}}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{url($minigame->slug)}}">
    <meta property="twitter:title" content="{{$minigame->name}} | {{config('app.name')}}">
    <meta property="twitter:description" content="{{config('app.description')}}">
    <meta property="twitter:image" content="{{url('minigames/'.$minigame->slug.'/images/rrss/203x136.jpg')}}">

    <link rel="stylesheet" href="{{url('minigames/'.$minigame->slug.'/TemplateData/style.css')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/web3@1.2.11/dist/web3.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/web3modal@1.9.3/dist/index.js"></script>
    <script type="text/javascript" src="https://unpkg.com/evm-chains@0.2.0/dist/umd/index.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider@1.5.2/dist/umd/index.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/fortmatic@2.0.6/dist/fortmatic.js"></script>
    <script type="text/javascript" src="https://unpkg.com/ethers@4.0.16/dist/ethers.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="minigames/{{$minigame->slug}}/TemplateData/UnityProgress.js"></script>
    <script src="minigames/{{$minigame->slug}}/Build/UnityLoader.js"></script>
    <script src="minigames/{{$minigame->slug}}/js/app.js"></script>
    <script>
      window.App.unityInstance = UnityLoader.instantiate("unityContainer", "minigames/{{$minigame->slug}}/Build/Build.json", {onProgress: UnityProgress});
      window.App.unityInstance.compatibilityCheck=function(e,t,r){t();};
    </script>
  </head>
  <body>
    <div class="webgl-content" style="width:100vw;height:100vh;">
      <div id="unityContainer" style="width:100vw;height:100vh;"></div>
  </body>
</html>
