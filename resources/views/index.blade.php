@extends('main')

@php
    use Carbon\Carbon;
@endphp

@section('custom-style')
    <link rel="stylesheet" href="/js/plugins/swipe/swiper.min.css">
    <style>
        .swiper-container {
            width: 100%;
            padding-bottom: 41.5%;
            /* z-index: -1; */
        }
        .swiper-container .swiper-wrapper {
            position: absolute;
        }
        .swiper-container .swiper-wrapper .swiper-slide {
            text-align: center;
            font-size: 18px;
            width: 100%;
            height: 100%;
            background: #fff;
            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }
        .swiper-pagination-bullet {
            width: 20px;
            height: 20px;
            text-align: center;
            line-height: 20px;
            font-size: 12px;
            color:#000;
            opacity: 1;
            border-radius: 5px;
            margin: 0 10px !important;
            background: rgba(0,0,0,0.2);
            box-shadow: 2px 2px 12px -2px rgba(0, 0, 0, 1);
        }
        .swiper-pagination-bullet-active {
            color: #fff;
            background: #FFF;
            box-shadow: 2px 2px 12px -2px rgba(0, 0, 0, 0.5);
        }
        .swiper-container-horizontal>.swiper-pagination-bullets {
            bottom: 20px;
        }
    </style>
@endsection

@section('custom-script')
    <script src="/js/plugins/swipe/swiper.min.js"></script>
    <script src="/js/plugins/countup/countUp.min.js" type="module"></script>
    <script type="module">
        import { CountUp } from '/js/plugins/countup/countUp.min.js';

        window.onload = function() {
            var countUpYear = new CountUp('count-year', 1987, {
                useGrouping: false
            });
            var countUpProd = new CountUp('count-prod', 108);
            var countUpMem = new CountUp('count-mem', 9435);
            var countUpReturn = new CountUp('count-return', 307);

            countUpYear.start();
            countUpProd.start();
            countUpMem.start();
            countUpReturn.start();
        }
    </script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                renderBullet: function (index, className) {
                return '<span class="' + className + '"></span>';
                },
            },
        });

        $('.scrollDown').on('click', function () {
            $("html, body").animate({
                scrollTop: $('.swiper-wrapper').height() + 1 
            }, 2000);
        });

        $('.witness-container').slick({
            dots: false,
            infinite: true,
            speed: 300,
            arrow: true,
            prevArrow: $('#prev-arrow'),
            nextArrow: $('#next-arrow'),
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        arrow: true,
                        infinite: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        arrow: true
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrow: true
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

        $('.product-list-container').slick({
            dots: false,
            infinite: true,
            speed: 300,
            arrow: true,
            prevArrow: $('#product-prev-arrow'),
            nextArrow: $('#product-next-arrow'),
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 916,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        arrow: true,
                        infinite: true
                    }
                },
                {
                    breakpoint: 916,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        arrow: true
                    }
                },
                {
                    breakpoint: 512,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrow: true
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    </script>
@endsection

@section('content')

    {{-- banner --}}
    <div class="swiper-container" data-aos="fade-in">
        <div class="swiper-wrapper">
            @foreach (SiteMetaView::album() as $item)
                <div class="swiper-slide" style="background-image: url('{{$item->url}}')">
                    <div class="slide-item">
                        <h2>{{$item->title}}</h2>
                        <div class="slide-info">
                            {!!$item->content!!}
                        </div>
                        <a class="slide-btn" href="{{$item->link}}">{{$item->button}}</a>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Add Pagination -->
        {{-- <div class="swiper-pagination"></div> --}}
        <div class="scrollDown">
            <div class="chevron"></div>
            <div class="chevron"></div>
            <div class="chevron"></div>
            <span class="text">Scroll down</span>
        </div>
    </div>

    {{-- Count down --}}
    <div class="container-fluid index-count-down" data-aos="fade-in">
        <div class="row count-down-row">
            <div class="col-sm-6 col-md-3">
                <div class="count-down-box">
                    <div class="type-icon drop"></div>
                    <div class="flex-column">
                        <div class="number" id="count-year">
                            0
                        </div>
                        <div class="text">
                            成立於
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="count-down-box">
                    <div class="type-icon box"></div>
                    <div class="flex-column">
                        <div class="number" id="count-prod">
                            0
                        </div>
                        <div class="text">
                            產品數量
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="count-down-box">
                    <div class="type-icon mem"></div>
                    <div class="flex-column">
                        <div class="number" id="count-mem">
                            0
                        </div>
                        <div class="text">
                            客戶累積
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="count-down-box">
                    <div class="type-icon back"></div>
                    <div class="flex-column">
                        <div class="number" id="count-return">
                            0
                        </div>
                        <div class="text">
                            客戶回單率
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Product --}}
    <div class="index-banner-divider product" data-aos="fade-in">
        <h2>產品中心</h2>
    </div>
    <div class="container product-list mobile">
        <button class="product-arrow" id="product-prev-arrow">
            <i class="fa fa-caret-left" aria-hidden="true"></i>
        </button>
        <button class="product-arrow" id="product-next-arrow">
            <i class="fa fa-caret-right" aria-hidden="true"></i>
        </button>
        <div class="row product-list-container">
            @foreach (ProductView::getPopularProductsByCount(3) as $item)
                @php
                    $content = json_decode($item->productDescription);
                @endphp
                <div class="col-md-4 product-content" data-aos="fade-up">
                    <div class="product-box">
                        <a href="/product-detail/{{$item->productGuid}}">
                            <div class="product-feature-image" style="background-image: url('{{$item->featureImage}}');"></div>
                            <div class="product-info">
                                <h3 class="product-title">{{$item->productTitle}}</h3>
                                <h4 class="product-type">型式：{{$item->serialNumber}}</h4>
                                <div class="product-text">
                                    {{mb_strimwidth(preg_replace('#<[^>]+>#', ' ', $content->intro), 0, 100, "...")}}
                                </div>
                            </div>
                        </a>
                        <a class="product-link" style="cursor: pointer" onclick="addSigleProduct('{{$item->productGuid}}')">加入詢價車</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12 btn-section">
                <a href="/product" class="learn-more-btn">檢視更多產品</a>
            </div>
        </div>
    </div>
    <div class="container product-list">
        <div class="row">
            @foreach (ProductView::getPopularProductsByCount(3) as $item)
                @php
                    $content = json_decode($item->productDescription);
                @endphp
                <div class="col-md-4 product-content" data-aos="fade-up">
                    <div class="product-box">
                        <a href="/product-detail/{{$item->productGuid}}">
                            <div class="product-feature-image" style="background-image: url('{{$item->featureImage}}');"></div>
                            <div class="product-info">
                                <h3 class="product-title">{{$item->productTitle}}</h3>
                                <h4 class="product-type">型式：{{$item->serialNumber}}</h4>
                                <div class="product-text">
                                    {{mb_strimwidth(preg_replace('#<[^>]+>#', ' ', $content->intro), 0, 100, "...")}}
                                </div>
                            </div>
                        </a>
                        <a class="product-link" style="cursor: pointer" onclick="addSigleProduct('{{$item->productGuid}}')">加入詢價車</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12 btn-section">
                <a href="/product" class="learn-more-btn">檢視更多產品</a>
            </div>
        </div>
    </div>

    {{-- News --}}
    <div class="index-banner-divider news" data-aos="fade-in">
        <h2>新聞中心</h2>
    </div>
    <div class="container new-tabs" data-aos="fade-in">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">全部文章</a>
            </li>
            @foreach (CategoryView::post() as $item)
                <li class="nav-item">
                    <a class="nav-link" id="{{$item->categoryGuid}}-tab" data-toggle="tab" href="#{{$item->categoryGuid}}" role="tab" aria-controls="{{$item->categoryGuid}}" aria-selected="false">
                        {{json_decode($item->categoryTitle, true)[App::getLocale()]}}    
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="container new-list">
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card-columns">
                            @foreach (PostView::allasc(15) as $item)
                                <a href="" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                                    <div class="card">
                                        <div class="featureImage" style="background-image: url('{{$item->featureImage}}');"></div>
                                        {{-- <img class="card-img-top" src="{{$item->featureImage}}" alt="{{$item->postTitle}}"> --}}
                                        <div class="card-body">
                                            <h4 class="card-title">{{$item->postTitle}}</h4>
                                            <p><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;{{Carbon::parse($item->created_at)->format('Y.m.d')}}</p>
                                            <div class="card-info">
                                                <p class="card-text">{{mb_strimwidth(preg_replace('#<[^>]+>#', ' ', $item->content), 0, 300, "...")}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>                        
                            @endforeach
                        </div>
                    </div>
                    @foreach (CategoryView::post() as $value)
                        <div class="tab-pane fade" id="{{$value->categoryGuid}}" role="tabpanel" aria-labelledby="{{$value->categoryGuid}}-tab">
                            <div class="card-columns">
                                @foreach (PostView::getByCategory($value->categoryGuid, 15) as $item)
                                    <a href="" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                                        <div class="card">
                                            <div class="featureImage" style="background-image: url('{{$item->featureImage}}');"></div>
                                            {{-- <img class="card-img-top" src="{{$item->featureImage}}" alt="{{$item->postTitle}}"> --}}
                                            <div class="card-body">
                                                <h4 class="card-title">{{$item->postTitle}}</h4>
                                                <p><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;{{Carbon::parse($item->created_at)->format('Y.m.d')}}</p>
                                                <div class="card-info">
                                                    <p class="card-text">{{mb_strimwidth(preg_replace('#<[^>]+>#', ' ', $item->content), 0, 300, "...")}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>                        
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-12 btn-section">
                <a href="" class="learn-more-btn">檢視更多歷史訊息</a>
            </div>
        </div>
    </div>
    <div class="container new-list mobile">
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card-columns">
                            @foreach (PostView::allasc(3) as $item)
                                <a href="" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                                    <div class="card">
                                        <div class="featureImage" style="background-image: url('{{$item->featureImage}}');"></div>
                                        {{-- <img class="card-img-top" src="{{$item->featureImage}}" alt="{{$item->postTitle}}"> --}}
                                        <div class="card-body">
                                            <h4 class="card-title">{{$item->postTitle}}</h4>
                                            <p><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;{{Carbon::parse($item->created_at)->format('Y.m.d')}}</p>
                                            <div class="card-info">
                                                <p class="card-text">{{mb_strimwidth(preg_replace('#<[^>]+>#', ' ', $item->content), 0, 300, "...")}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>                        
                            @endforeach
                        </div>
                    </div>
                    @foreach (CategoryView::post() as $value)
                        <div class="tab-pane fade" id="{{$value->categoryGuid}}" role="tabpanel" aria-labelledby="{{$value->categoryGuid}}-tab">
                            <div class="card-columns">
                                @foreach (PostView::getByCategory($value->categoryGuid, 3) as $item)
                                    <a href="" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                                        <div class="card">
                                            <div class="featureImage" style="background-image: url('{{$item->featureImage}}');"></div>
                                            {{-- <img class="card-img-top" src="{{$item->featureImage}}" alt="{{$item->postTitle}}"> --}}
                                            <div class="card-body">
                                                <h4 class="card-title">{{$item->postTitle}}</h4>
                                                <p><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;{{Carbon::parse($item->created_at)->format('Y.m.d')}}</p>
                                                <div class="card-info">
                                                    <p class="card-text">{{mb_strimwidth(preg_replace('#<[^>]+>#', ' ', $item->content), 0, 300, "...")}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>                        
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-12 btn-section">
                <a href="" class="learn-more-btn">檢視更多歷史訊息</a>
            </div>
        </div>
    </div>

    {{-- Witness --}}
    <div class="index-banner-divider witness">
        <h2>我們的客戶</h2>
    </div>
    <div style="width: 85%; margin: 0 auto">
        <div class="container witness-list" data-aos="fade-up">
            <div class="row">
                <div class="col-md-11 mx-auto">
                    <button class="witness-arrow" id="prev-arrow">
                        <i class="fa fa-caret-left" aria-hidden="true"></i>
                    </button>
                    <button class="witness-arrow" id="next-arrow">
                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                    </button>
                    <div class="witness-container">
    
                        <div class="witness-item">
                            <div class="witness-image">
                                <img src="/img/partner1.jpg" alt="">
                            </div>
                            {{-- <div class="withess-info">
                                統一企業股份有限公司
                                <br>
                                <span>Uni-President Enterprises Corporation</span>
                            </div> --}}
                        </div>
                        
                        <div class="witness-item">
                            <div class="witness-image">
                                <img src="/img/partner2.png" alt="">
                            </div>
                            {{-- <div class="withess-info">
                                金車股份有限公司
                                <br>
                                <span>King Car Industrial Co., Ltd</span>
                            </div> --}}
                        </div>
                            
                        <div class="witness-item">
                            <div class="witness-image">
                                <img src="/img/partner3.jpg" alt="">
                            </div>
                            {{-- <div class="withess-info">
                                黑松股份有限公司
                                <br>
                                <span>HeySong Corporation</span>
                            </div> --}}
                        </div>
                            
                        <div class="witness-item">
                            <div class="witness-image">
                                <img src="/img/partner4.jpg" alt="">
                            </div>
                            {{-- <div class="withess-info">
                                好市多股份有限公司
                                <br>
                                <span>Costco Wholesale Corporation</span>
                            </div> --}}
                        </div>
                            
                        <div class="witness-item">
                            <div class="witness-image">
                                <img src="/img/partner5.png" alt="">
                            </div>
                            {{-- <div class="withess-info">
                                鼎泰豐小吃店股份有限公司
                                <br>
                                <span>Din Tai Fung</span>
                            </div> --}}
                        </div>
                            
                        <div class="witness-item">
                            <div class="witness-image">
                                <img src="/img/partner6.png" alt="">
                            </div>
                            {{-- <div class="withess-info">
                                東京牛角股份有限公司
                                <br>
                                <span>REINS International</span>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection