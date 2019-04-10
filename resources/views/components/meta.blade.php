<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="{{SiteMetaView::keyword()}}">
<meta name="description" content="{{SiteMetaView::description()}}">
{{--  <link rel="alternate" href="https://www.meansgood.com.tw/" hreflang="zh-TW" />  --}}
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
<title>{{ SiteMetaView::title() }}</title>

<link rel="shortcut icon" href="{{ SiteMetaView::shortcut() }}">

<!-- Fonts -->
<link rel="stylesheet" href="/js/plugins/b4/css/bootstrap.min.css">
<link href="/css/frontend.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="/js/plugins/AOS/aos.css">
<link rel="stylesheet" href="/css/animate.css">

<!-- Styles -->
<style>
    .paytest {
        display: block;
        font-size: 50pt;
    }
</style>