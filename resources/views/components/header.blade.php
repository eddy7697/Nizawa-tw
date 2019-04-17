@php
    $language = '';

    foreach (Config::get('languages') as $key => $value) {
        if ($key == App::getLocale()) {
            $language = $value;
        }
    }
@endphp

<section class="site-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 site-header-container">
                <div class="site-logo">
                    <a href="/"><img src="/img/site-logo/logo_header.png" alt=""></a>
                </div>
                <ul class="site-func">
                    <li id="cart-panel">
                        <cart-panel />
                    </li>
                    <li>
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown"><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;{{$language}}&nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>&nbsp;</a>    
                            <div class="dropdown-menu">
                                @foreach (Config::get('languages') as $lang => $language)
                                    @if ($lang != App::getLocale())
                                        <a class="dropdown-item" style="color: #aaa; font-weight: light; margin-top: 5px; text-decoration: none; padding: 5px 10px;" href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                                    @else
                                        <a class="dropdown-item" style="color: #004471; font-weight: bolder; margin-top: 5px; text-decoration: none; padding: 5px 10px;" href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="site-menu">
                    <li><a class="mega-btn" data-menu-target="about">關於日澤&nbsp;&nbsp;<i class="fa fa-caret-down mega-arrow" aria-hidden="true"></i></a></li>
                    <li><a href="/product">產品中心</a></li>
                    <li><a href="">產業應用</a></li>
                    <li><a href="">新聞中心</a></li>
                    <li><a href="">服務支援</a></li>
                    <li><a href="" class="active">聯絡我們</a></li>
                </ul>
            </div>
        </div>
    </div>    
</section>

{{-- Mega menu --}}
<div class="mega-menu-overlay"></div>
<section class="mega-menu">
    <div class="container">
        <div class="row">
            <div class="col-md-2 left-col">
                <div class="menu-header">
                    <h3>關於日澤</h3>
                    <hr>
                    <p>About Nizawa</p>
                </div>
            </div>
            <div class="col-md-10 right-col">
                <ul class="mega-menu-container">
                    <li class="mega-menu-item">
                        <a href="/about" class="mega-menu-link">
                            <img src="/img/menu/about.jpg" alt="關於日澤">
                            <p class="header-job-txt">關於日澤</p>
                        </a>
                    </li>
                    <li class="mega-menu-item">
                        <a href="/about/responsibility" class="mega-menu-link">
                            <img src="/img/menu/res.jpg" alt="企業社會責任">
                            <p class="header-job-txt">企業社會責任</p>
                        </a>
                    </li>
                    <li class="mega-menu-item">
                        <a href="/about/recruiting" class="mega-menu-link">
                            <img src="/img/menu/hr.jpg" alt="人才招募">
                            <p class="header-job-txt">人才招募</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="mobile-site-header">
    <div id="menu-btn" class="menu-btn"></div>
    <img class="header-logo" src="/img/site-logo/logo_footer.png" alt="">
    <img src="/img/icon/burger-open.svg" style="display: none">
    <img src="/img/icon/burger-close.svg" style="display: none">
</section>
<section class="mobile-site-menu hide">
    <ul class="menu-item">
        <li><a href="">關於日澤</a></li>
        <li><a href="/product">產品中心</a></li>
        <li><a href="">產業應用</a></li>
        <li><a href="">新聞中心</a></li>
        <li><a href="">服務支援</a></li>
        <li><a href="" class="active">聯絡我們</a></li>
    </ul>
</section>