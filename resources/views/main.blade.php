<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    @yield('custom-meta')

    @include('components.meta')

    {{-- Custom stylesheet --}}
    @yield('custom-style')

</head>
<body>
    

    {{-- Loading --}}
    <div class="loading-bar">
        <img src="https://nizawa.shuo-guo.net/img/icon/loading-spinner.svg">
    </div>

    {{-- Header --}}
    @include('components.header')

    {{-- Content --}}
    <section class="site-content">
        @yield('content')
    </section>
    
    <a class="contact-btn" href="/contact">
        <div class="inner">
            <img src="https://nizawa.shuo-guo.net/img/site-logo/small-logo.png" alt="">
            <p>{{ trans('string.about4') }}</p>
        </div>
        
    </a>
    {{-- Footer --}}
    @include('components.footer')

    @php
        $string = json_encode(trans('string'));
        $cart = json_encode(trans('cart'));

        $res = array_merge(json_decode($string, true), json_decode($cart, true));
    @endphp
    
    <textarea id="i18n-text" cols="30" rows="10">{{ json_encode($res) }}</textarea>
    <!-- Scripts -->
    <script src="https://nizawa.shuo-guo.net/js/frontend.js"></script>

    <script src="https://nizawa.shuo-guo.net/js/plugins/popper/popper.min.js"></script>

    <script src="https://nizawa.shuo-guo.net/js/plugins/b4/js/bootstrap.min.js"></script>    

    <script src="https://nizawa.shuo-guo.net/js/cart-panel.js"></script>
    
    <script src="https://nizawa.shuo-guo.net/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script src="https://nizawa.shuo-guo.net/js/plugins/AOS/aos.js" charset="utf-8"></script>

    <script type="text/javascript">
        AOS.init();


        var headerHeight = $('.site-header').height();
        var footerHeight = $('.site-footer').height();
        var windowHeight = $(window).height();

        $('.site-content').css({'min-height': windowHeight - footerHeight - headerHeight});

        function updateFooterLayout() {
            if ($(window).width() <= 768) {
                $('.site-footer .site-footer-content .footer-section .footer-logo').removeAttr('style');
            } else {
                $('.site-footer .site-footer-content .footer-section .footer-logo').css('left', $('.site-footer .site-footer-content .footer-section .footer-info .left-col ul.info').css("margin-left"))    
            }
            
        };

        function openCartPanel() {
            $('.shopping-Cart-Icon').click()
        }

        updateFooterLayout();

        $(window).resize(function (e) {
            updateFooterLayout();
        });

        $('#subscribes-form').on('submit', function (e) {
            e.preventDefault();
            
            axios.post('/subscription', {
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: $('input[name="name"]').val(),
                email: $('input[name="email"]').val(),
            }).then(function (res) {
                alert('訂閱成功!');
            }).catch(function (err) {
                alert('您已訂閱!');
            });
        });
        
        $('#toggle-search-btn').on('click', function () {
            $('.header-search').toggleClass('active') 
        });
    </script>

    {{-- Custom scripts --}}
    @yield('custom-script')

    @if(config('app.env') == 'local')
        <script src="http://localhost:35729/livereload.js"></script>
    @endif

</body>
</html>
