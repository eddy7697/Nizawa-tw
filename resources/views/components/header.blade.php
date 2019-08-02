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
                    <li>
                        <form action="/product/search" method="get">
                            <i class="fa fa-search" id="toggle-search-btn" aria-hidden="true" style="cursor: pointer"></i>&nbsp;&nbsp;
                            <input type="text" class="header-search" name="keyword" placeholder="{{ trans('string.search_placeholder_product') }}">
                        </form>
                    </li>
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
                <ul class="site-menu {{App::getLocale()}}">
                    <li><a class="mega-btn" data-menu-target="about">{{ trans('string.about') }}&nbsp;&nbsp;<i class="fa fa-caret-down mega-arrow" aria-hidden="true"></i></a></li>
                    <li><a class="mega-btn" data-menu-target="product">{{ trans('string.product_center') }}&nbsp;&nbsp;<i class="fa fa-caret-down mega-arrow" aria-hidden="true"></i></a></li>
                    <li><a class="mega-btn" data-menu-target="industry">{{ trans('string.industrial_application') }}&nbsp;&nbsp;<i class="fa fa-caret-down mega-arrow" aria-hidden="true"></i></a></li>
                    <li><a href="/blog">{{ trans('string.news_center') }}</a></li>
                    <li><a class="mega-btn" data-menu-target="support">{{trans('string.support')}}&nbsp;&nbsp;<i class="fa fa-caret-down mega-arrow" aria-hidden="true"></i></a></li>
                    <li><a href="/contact">{{ trans('string.about4') }}</a></li>
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
                    <h3>{{ trans('string.about') }}</h3>
                    <hr>
                    @unless (App::getLocale() == 'en')
                        <p>About NIZAWA</p>    
                    @endunless
                    
                </div>
            </div>
            <div class="col-md-10 right-col">
                <ul class="site-mega-menu-container">
                    <li class="site-mega-menu-item">
                        <a href="/about" class="site-mega-menu-link">
                            <img src="/img/menu/about.jpg" alt="{{ trans('string.company_profile') }}">
                            <p class="header-job-txt">{{ trans('string.company_profile') }}</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/about/responsibility" class="site-mega-menu-link">
                            <img src="/img/menu/res.jpg" alt="{{ trans('string.responsibility') }}">
                            <p class="header-job-txt">{{ trans('string.responsibility') }}</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/about/career" class="site-mega-menu-link">
                            <img src="/img/menu/hr.jpg" alt="{{ trans('string.recruiting') }}">
                            <p class="header-job-txt">{{ trans('string.recruiting') }}</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- product --}}
        <div class="row mega-nav-item" id="product">
            <div class="col-md-2 left-col">
                <div class="menu-header">
                    <h3>{{ trans('string.product_center') }}</h3>
                    <hr>
                    @unless (App::getLocale() == 'en')
                        <p>Product center</p>    
                    @endunless
                    
                </div>
            </div>
            <div class="col-md-10 right-col">
                <ul class="site-mega-menu-container">
                    <li class="site-mega-menu-item">
                        <a href="/product" class="site-mega-menu-link">
                            <img src="/img/menu/about.jpg" alt="{{ trans('string.product_center') }}">
                            <p class="header-job-txt">{{ trans('string.product_center') }}</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/label" class="site-mega-menu-link">
                            <img src="/img/menu/res.jpg" alt="{{ trans('string.label_center') }}">
                            <p class="header-job-txt">{{ trans('string.label_center') }}</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- {{trans('string.support')}} --}}
        <div class="row mega-nav-item" id="support">
            <div class="col-md-2 left-col">
                <div class="menu-header">
                    <h3>{{ trans('string.support') }}</h3>
                    <hr>
                    @unless (App::getLocale() == 'en')
                    <p>Support</p>    
                    @endunless
                    
                </div>
            </div>
            <div class="col-md-10 right-col">
                <ul class="site-mega-menu-container">
                    <li class="site-mega-menu-item">
                        <a href="/service" class="site-mega-menu-link">
                            <img src="/img/menu/service.jpg" alt="{{trans('string.service')}}">
                            <p class="header-job-txt">{{trans('string.service')}}</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/qna" class="site-mega-menu-link">
                            <img src="/img/menu/qna.jpg" alt="{{trans('string.faq')}}">
                            <p class="header-job-txt">{{trans('string.faq')}}</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/download" class="site-mega-menu-link">
                            <img src="/img/menu/download.jpg" alt="{{trans('string.download')}}">
                            <p class="header-job-txt">{{trans('string.download')}}</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- {{ trans('string.industrial_application') }} --}}
        <div class="row mega-nav-item" id="industry">
            <div class="col-md-2 left-col">
                <div class="menu-header">
                    <h3>{{ trans('string.industrial_application') }}</h3>
                    <hr>
                    @unless (App::getLocale() == 'en')
                    <p>Industrial application</p>    
                    @endunless
                    
                    <a href="/industry" class="link-mask"></a>
                </div>
            </div>
            <div class="col-md-10 right-col">
                <ul class="site-mega-menu-container">
                    <li class="site-mega-menu-item">
                        <a href="/industry/water" class="site-mega-menu-link">
                            <img src="/img/about/album/about-1.jpg" alt="{{trans('string.indu1')}}">
                            <p class="header-job-txt">{{trans('string.indu1')}}</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/industry/electronics" class="site-mega-menu-link">
                            <img src="/img/about/album/about-2.jpg" alt="{{trans('string.indu2')}}">
                            <p class="header-job-txt">{{trans('string.indu2')}}</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/industry/life" class="site-mega-menu-link">
                            <img src="/img/about/album/about-3.jpg" alt="{{trans('string.indu3')}}">
                            <p class="header-job-txt">{{trans('string.indu3')}}</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/industry/industrial" class="site-mega-menu-link">
                            <img src="/img/about/album/about-4.jpg" alt="{{trans('string.indu4')}}">
                            <p class="header-job-txt">{{trans('string.indu4')}}</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/industry/fishery" class="site-mega-menu-link">
                            <img src="/img/about/album/about-5.jpg" alt="{{trans('string.indu5')}}">
                            <p class="header-job-txt">{{trans('string.indu5')}}</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/industry/food" class="site-mega-menu-link">
                            <img src="/img/about/album/about-6.jpg" alt="{{trans('string.indu6')}}">
                            <p class="header-job-txt">{{trans('string.indu6')}}</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/industry/cosmeceutical" class="site-mega-menu-link">
                            <img src="/img/about/album/about-7.jpg" alt="{{trans('string.indu7')}}">
                            <p class="header-job-txt">{{trans('string.indu7')}}</p>
                        </a>
                    </li>
                    <li class="site-mega-menu-item">
                        <a href="/industry/industrialEngineering" class="site-mega-menu-link">
                            <img src="/img/about/album/about-8.jpg" alt="{{trans('string.indu8')}}">
                            <p class="header-job-txt">{{trans('string.indu8')}}</p>
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
        <li>
            <a class="menu-item-dropdown">{{ trans('string.about') }}</a>
            <ul id="about-menu">
                <li><a href="/about">{{ trans('string.company_profile') }}</a></li>
                <li><a href="/about/responsibility">{{ trans('string.responsibility') }}</a></li>
                <li><a href="/about/career">{{ trans('string.recruiting') }}</a></li>
            </ul>
        </li>
        <li>
            <a class="menu-item-dropdown">{{ trans('string.product_center') }}</a>
            <ul>
                <li><a href="/product">{{ trans('string.product_center') }}</a></li>
                <li><a href="/label">{{ trans('string.label_center') }}</a></li>
            </ul>
        </li>
        <li>
            <a class="menu-item-dropdown">{{ trans('string.industrial_application') }}</a>
            <ul>
                <li><a href="/industry/water">{{trans('string.indu1')}}</a></li>
                <li><a href="/industry/electronics">{{trans('string.indu2')}}</a></li>
                <li><a href="/industry/life">{{trans('string.indu3')}}</a></li>
                <li><a href="/industry/industrial">{{trans('string.indu4')}}</a></li>
                <li><a href="/industry/fishery">{{trans('string.indu5')}}</a></li>
                <li><a href="/industry/food">{{trans('string.indu6')}}</a></li>
                <li><a href="/industry/cosmeceutical">{{trans('string.indu7')}}</a></li>
                <li><a href="/industry/industrialEngineering">{{trans('string.indu8')}}</a></li>
            </ul>
        </li>
        <li><a href="/blog">{{ trans('string.news_center') }}</a></li>
        <li>
            <a class="menu-item-dropdown">{{trans('string.support')}}</a>
            <ul>
                <li><a href="/service">{{trans('string.service')}}</p></a></li>
                <li><a href="/qna">{{trans('string.faq')}}</p></a></li>
                <li><a href="/download">{{trans('string.download')}}</p></a></li>
            </ul>
        </li>
        <li><a href="/contact">{{ trans('string.about4') }}</a></li>
    </ul>
</section>