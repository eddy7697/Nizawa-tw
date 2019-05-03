@extends('main')

@section('custom-script')
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
@endsection

@section('custom-style')
@endsection

@section('content')
<div class="sub-page-banner" style="background-image: url('/img/sub-banner.jpg');">
    <div>
        <h2>{{ trans('string.about') }}</h2>
        <h4>About KASAHARA</h4>
        <hr>
        <h5>{{ trans('string.aboutDesc') }}</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">{{ trans('string.home') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a href="/">{{ trans('string.about') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            {{ trans('string.about2') }}
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 about-content">
            <img src="/img/about/logo.png" class="about-logo" alt="">
            <h3 class="about-section-title">{{ trans('string.about2') }}</h3>
            <div class="about-text">
                {!! trans('string.about1') !!}
            </div>
        </div>
    </div>
</div>
{{-- Count down --}}
<div class="container index-count-down about">
    <div class="row count-down-row">
        <div class="col-sm-6 col-md-3">
            <div class="count-down-box">
                <div class="type-icon drop"></div>
                <div class="flex-column">
                    <div class="number" id="count-year">
                        0
                    </div>
                    <div class="text">
                        {{ trans('string.count_create') }}
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
                        {{ trans('string.count_product') }}
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
                        {{ trans('string.count_mem') }}
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
                        {{ trans('string.count_retrun') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 about-content">
            @php
                $albumPath = public_path('img/about/album');
        
                $album = preg_grep('~\.(jpeg|jpg|png)$~', scandir($albumPath));
                $album = array(
                    [
                        'image' => '/img/about/album/about-1.jpg',
                        'title' => trans('string.indu1'),
                        'link' => '/industry/water'
                    ],[
                        'image' => '/img/about/album/about-2.jpg',
                        'title' => trans('string.indu2'),
                        'link' => '/industry/electronics'
                    ],[
                        'image' => '/img/about/album/about-3.jpg',
                        'title' => trans('string.indu3'),
                        'link' => '/industry/life'
                    ],[
                        'image' => '/img/about/album/about-4.jpg',
                        'title' => trans('string.indu4'),
                        'link' => '/industry/industrial'
                    ],[
                        'image' => '/img/about/album/about-5.jpg',
                        'title' => trans('string.indu5'),
                        'link' => '/industry/fishery'
                    ],[
                        'image' => '/img/about/album/about-6.jpg',
                        'title' => trans('string.indu6'),
                        'link' => '/industry/food'
                    ],[
                        'image' => '/img/about/album/about-7.jpg',
                        'title' => trans('string.indu7'),
                        'link' => '/industry/cosmeceutical'
                    ],[
                        'image' => '/img/about/album/about-8.jpg',
                        'title' => trans('string.indu8'),
                        'link' => '/industry/industrialEngineering'
                    ]
                );
            @endphp
            <h3 class="about-section-title">{{ trans('string.about2') }}</h3>
            <div class="about-album">
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
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 about-content">
            <h3 class="about-section-title">{{ trans('string.about3') }}</h3>
            <div class="row">
                <div class="col-md-4 about-text">
                    <p>{{ trans('string.phone') }}：+886-3-4935921 / +886-3-4935900</p>
                    <p>{{ trans('string.fax') }} ：+886-3-4928654</p>
                    <p>{{ trans('string.email') }}：info@nizawa-int.com.tw</p>
                    <p>{{ trans('string.address') }}：{{ trans('string.fullAddress') }}</p>
                    <p>{{ trans('string.postcode') }}：32047</p>
                    <p>{{ trans('string.working') }}：09:00 ~ 18:00 (Mon - Fri)</p>
                </div>
                <div class="col-md-8">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3617.1539186723194!2d121.20859441544611!3d24.96087734737173!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346823c9f9eda163%3A0x6f46857d42a84497!2z5pel5r6k5ZyL6Zqb6IKh5Lu95pyJ6ZmQ5YWs5Y-4!5e0!3m2!1szh-TW!2stw!4v1555439354866!5m2!1szh-TW!2stw" style="width: 100%; height: 300px" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <div class="col-md-12 btn-section">
                    <a class="learn-more-btn" href="">{{ trans('string.about4') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
