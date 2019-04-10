<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ SiteMetaView::title() }}</title>

    <link rel="shortcut icon" href="{{SiteMetaView::shortcut()}}" type="image/x-icon">

    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('js/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/plugins/jquery.fancytree/dist/skin-themeroller/ui.fancytree.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style media="screen">
        .loading-bar {
            position: fixed;
            display: block;
            z-index: 999999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255,255,255,0);
        }
        .loading-bar img.loading-icon {
            width: 100px;
            position: absolute;
            left: 50%;
            top: 50%;
            margin-top: -50px;
            margin-left: -50px;
        }
    </style>
    @yield('custom-style-section')



</head>
<body class="nav-md">
    <div class="loading-bar">
        <img class="loading-icon" src="/img/icon/Ripple.svg" alt="">
    </div>
    @yield('content')
    @yield('main-panel-script') 

    {{-- / setting value to your CSRFglobal variables  --}}
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            ]); ?>
    </script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://d3js.org/d3.v3.min.js"></script>
    <script src="{{ asset('js/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/plugins/moment/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.fancytree/dist/jquery.fancytree-all.min.js') }}"></script>
    <script src="{{ asset('js/customFunction.js') }}"></script>
    <script src="/js/plugins/ckeditor/ckeditor.js"></script>
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script src="/js/jquery.print.js"></script>
    @unless (Auth::guest())
    @endunless
    <script src="/js/plugins/AOS/aos.js" charset="utf-8"></script>

    <script type="text/javascript">
        AOS.init();
    </script>
    @yield('custom-js-script')

    @if(config('app.env') == 'local')
        <script src="http://localhost:35729/livereload.js"></script>
    @endif
</body>
</html>
