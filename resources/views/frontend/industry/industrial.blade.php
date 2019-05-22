@extends('main')

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
            <a href="/">{{ trans('string.home') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a href="/">{{ trans('string.industrial_application') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            {{ trans('string.indu4') }}
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
                            @php
                                use App\CustomField;
                                $indu = CustomField::where('id', 11)->first();
                                $title = json_decode($indu->locale)->{App::getLocale()};
                                $enTitle = json_decode($indu->locale)->en;
                            @endphp
                            <h3>{{$title}}</h3>
                            @if (App::getLocale() !== 'en')
                                <p>{{$enTitle}}</p>    
                            @endif
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
                <img class="flow-image" src="/img/industry/domestic_sewage.jpg" alt="">
            </div>
        </div>
        <section class="industry-map">
            <div class="container">
                <div class="row">
                    @include('components.industryMap', ['id' => 11])
                </div>
            </div>
        </section>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto about-content">
            <div class="btn-section industry" style="padding: 50px 0;">
                <a class="learn-more-btn" href="/product">{{ trans('string.learn_more_products') }}</a>
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
