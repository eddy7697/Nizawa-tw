@extends('main')

@php
    $albumPath = public_path('img/about/album');

    $album = preg_grep('~\.(jpeg|jpg|png)$~', scandir($albumPath));
    $album = array(
        [
            'image' => '/img/about/album/about-1.jpg',
            'title' => '自來水業',
            'link' => '/industry/water'
        ],[
            'image' => '/img/about/album/about-2.jpg',
            'title' => '電子行業',
            'link' => '/industry/electronics'
        ],[
            'image' => '/img/about/album/about-3.jpg',
            'title' => '生活汙水',
            'link' => '/industry/life'
        ],[
            'image' => '/img/about/album/about-4.jpg',
            'title' => '工業汙水',
            'link' => '/industry/industrial'
        ],[
            'image' => '/img/about/album/about-5.jpg',
            'title' => '養殖漁業',
            'link' => '/industry/fishery'
        ],[
            'image' => '/img/about/album/about-6.jpg',
            'title' => '食品行業',
            'link' => '/industry/food'
        ],[
            'image' => '/img/about/album/about-7.jpg',
            'title' => '藥妝行業',
            'link' => '/industry/cosmeceutical'
        ],[
            'image' => '/img/about/album/about-8.jpg',
            'title' => '工業工程',
            'link' => '/industry/industrialEngineering'
        ]
    );
@endphp

@section('custom-script')
<script>
    $(function () {
        $('.card').each(function (e) {
            if (!$(this).find('.collapse').hasClass('show')) {
                $(this).find('.card-link').addClass('collapsed')
            }
        });

        $('.about-album').slick({
            dots: false,
            infinite: true,
            speed: 300,
            arrow: true,
            centerMode: true,
            slidesToShow: 6,
            slidesToScroll: 1,
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
    });
</script>
@endsection

@section('custom-style')
@endsection

@section('content')
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">首頁</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a href="/">產業應用</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            生活汙水
        </div>
    </div>
</div>
<!-- Nav tabs -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs industry-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">
                        <div class="industry-tab-item">
                            <i class="fa fa-caret-down"></i>
                            <h3>生活汙水</h3>
                            <p>Domestic sewage</p>
                        </div>
                    </a>
                </li>
            </ul>
            <hr>
        </div>
    </div>
</div>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="home">
        <div class="container">
            <div class="col-md-12 industry-container">
                <img class="flow-image" src="/img/industry/drinking_water.jpg" alt="">
            </div>
        </div>
        <section class="industry-map">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 mx-auto">
                        <h3>原廢水</h3>
                        <hr>
                        @include('components.industryMap', ['data' => config('industry.drinking_flow')])                        
                    </div>
                    <div class="col-md-2 mx-auto">
                        <h3>初沉池</h3>
                        <hr>
                        @include('components.industryMap', ['data' => config('industry.drinking_mix')])                        
                    </div>
                    <div class="col-md-2 mx-auto">
                        <h3>曝氣池</h3>
                        <hr>
                        @include('components.industryMap', ['data' => config('industry.drinking_precipitation')])                        
                    </div>
                    <div class="col-md-2 mx-auto">
                        <h3>終沉池</h3>
                        <hr>
                        @include('components.industryMap', ['data' => config('industry.drinking_filter')])                        
                    </div>
                    <div class="col-md-2 mx-auto">
                        <h3>放流口</h3>
                        <hr>
                        @include('components.industryMap', ['data' => config('industry.drinking_disinfection')])                        
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto about-content">
            <div class="btn-section industry" style="padding: 50px 0;">
                <a class="learn-more-btn" href="/product">查看其他產品</a>
            </div>
        </div>
    </div>
</div>
<div class="about-content">
    <div class="about-album bottom">
        @foreach ($album as $item)
            <div class="album-item">
                <div class="album-image">
                    <img class="feature" src="{{$item['image']}}" alt="">
                    <a class="link-mask" href="{{$item['link']}}">
                        <div>
                            <img class="icon" src="/img/about/link_icon.svg" alt=""><br>
                            <span class="read-more">read more</span>
                        </div>
                    </a>
                </div>
                <p class="album-title">{{$item['title']}}</p>               
            </div>
        @endforeach
    </div>
</div>
@endsection
