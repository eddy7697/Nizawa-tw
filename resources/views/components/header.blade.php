@php
    $language = '';

    foreach (Config::get('languages') as $key => $value) {
        if ($key == App::getLocale()) {
            $language = $value;
        }
    }
@endphp

<div id="cart-panel" style="position:absolute">
    <cart-panel />
</div>
<section class="site-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 site-header-container">
                <div class="site-logo">
                    <a href="/"><img src="/img/site-logo/logo_header.png" alt=""></a>
                </div>
                <ul class="site-func">
                    <li>
                        <a style="cursor: pointer" onclick="openCartPanel()"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;我的询价车</a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown"><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;{{$language}}&nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i></a>    
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
                    <li><a href="">关于科尔客</a></li>
                    <li><a href="/product">产品中心</a></li>
                    <li><a href="">产业应用</a></li>
                    <li><a href="">新闻中心</a></li>
                    <li><a href="">服务支持</a></li>
                    <li><a href="" class="active">联系我们</a></li>
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
        <li><a href="">关于科尔客</a></li>
        <li><a href="/product">产品中心</a></li>
        <li><a href="">产业应用</a></li>
        <li><a href="">新闻中心</a></li>
        <li><a href="">服务支持</a></li>
        <li><a href="" class="active">联系我们</a></li>
    </ul>
</section>