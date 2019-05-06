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
                    <li><a class="mega-btn" data-menu-target="industry">產業應用&nbsp;&nbsp;<i class="fa fa-caret-down mega-arrow" aria-hidden="true"></i></a></li>
                    <li><a href="/blog">新聞中心</a></li>
                    <li><a class="mega-btn" data-menu-target="support">服務支援&nbsp;&nbsp;<i class="fa fa-caret-down mega-arrow" aria-hidden="true"></i></a></li>
                    <li><a href="/contact">聯絡我們</a></li>
                </ul>
            </div>
        </div>
    </div>    
</section>

{{-- Mega menu --}}
<div class="site-mega-menu-overlay"></div>
<section class="site-mega-menu" id="site-mega-menu">
    <div class="container mega-nav">

        {{-- about --}}
        <div class="row mega-nav-item" id="about">
            <div class="col-md-2 left-col">
                <div class="menu-header">
                    <h3>關於日澤</h3>
                    <hr>
                    <p>About Nizawa</p>
                </div>
            </div>
            <div class="col-md-10 right-col">
                <ul class="site-mega-menu-container">
                    <li class="site-mega-menu-item">
                        <a href="/about" class="site-mega-menu-link">
                            <img src="/img/menu/about.jpg" alt="關於日澤">
                            <p class="header-job-txt">關於日澤</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/about/responsibility" class="site-mega-menu-link">
                            <img src="/img/menu/res.jpg" alt="企業社會責任">
                            <p class="header-job-txt">企業社會責任</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/about/career" class="site-mega-menu-link">
                            <img src="/img/menu/hr.jpg" alt="人才招募">
                            <p class="header-job-txt">人才招募</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- 服務支援 --}}
        <div class="row mega-nav-item" id="support">
            <div class="col-md-2 left-col">
                <div class="menu-header">
                    <h3>服務支援</h3>
                    <hr>
                    <p>Support</p>
                </div>
            </div>
            <div class="col-md-10 right-col">
                <ul class="site-mega-menu-container">
                    <li class="site-mega-menu-item">
                        <a href="/service" class="site-mega-menu-link">
                            <img src="/img/menu/service.jpg" alt="售後服務">
                            <p class="header-job-txt">售後服務</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/qna" class="site-mega-menu-link">
                            <img src="/img/menu/qna.jpg" alt="常見問題">
                            <p class="header-job-txt">常見問題</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/download" class="site-mega-menu-link">
                            <img src="/img/menu/download.jpg" alt="資料下載">
                            <p class="header-job-txt">資料下載</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- 產業應用 --}}
        <div class="row mega-nav-item" id="industry">
            <div class="col-md-2 left-col">
                <div class="menu-header">
                    <h3>產業應用</h3>
                    <hr>
                    <p>Industrial application</p>
                    <a href="/industry" class="link-mask"></a>
                </div>
            </div>
            <div class="col-md-10 right-col">
                <ul class="site-mega-menu-container">
                    <li class="site-mega-menu-item">
                        <a href="/industry/water" class="site-mega-menu-link">
                            <img src="/img/about/album/about-1.jpg" alt="自來水業">
                            <p class="header-job-txt">自來水業</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/industry/electronics" class="site-mega-menu-link">
                            <img src="/img/about/album/about-2.jpg" alt="電子行業">
                            <p class="header-job-txt">電子行業</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/industry/life" class="site-mega-menu-link">
                            <img src="/img/about/album/about-3.jpg" alt="生活污水">
                            <p class="header-job-txt">生活污水</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/industry/industrial" class="site-mega-menu-link">
                            <img src="/img/about/album/about-4.jpg" alt="工業污水">
                            <p class="header-job-txt">工業污水</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/industry/fishery" class="site-mega-menu-link">
                            <img src="/img/about/album/about-5.jpg" alt="養殖漁業">
                            <p class="header-job-txt">養殖漁業</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/industry/food" class="site-mega-menu-link">
                            <img src="/img/about/album/about-6.jpg" alt="食品行業">
                            <p class="header-job-txt">食品行業</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/industry/cosmeceutical" class="site-mega-menu-link">
                            <img src="/img/about/album/about-7.jpg" alt="藥妝行業">
                            <p class="header-job-txt">藥妝行業</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/industry/industrialEngineering" class="site-mega-menu-link">
                            <img src="/img/about/album/about-8.jpg" alt="工業工程">
                            <p class="header-job-txt">工業工程</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="mobile-site-header">
    <div id="menu-btn" class="menu-btn"></div>
    <a class="header-logo" href="/"><img src="/img/site-logo/logo_footer.png" alt=""></a>    
    <img src="/img/icon/burger-open.svg" style="display: none">
    <img src="/img/icon/burger-close.svg" style="display: none">
</section>
<section class="mobile-site-menu hide">
    <ul class="menu-item">
        <li><a href="">關於日澤</a></li>
        <li><a href="/product">產品中心</a></li>
        <li><a href="">產業應用</a></li>
        <li><a href="/blog">新聞中心</a></li>
        <li><a href="">服務支援</a></li>
        <li><a href="/contact" class="active">聯絡我們</a></li>
    </ul>
</section>