@extends('main')

@section('custom-script')
@endsection

@section('custom-style')
@endsection

@section('content')
<div class="sub-page-banner" style="background-image: url('/img/sub-banner.jpg');">
    <div>
        <h2>{{ trans('string.industrial_application') }}</h2>
        @if (App::getLocale() !== 'en')
        <h4>Industries</h4>
        @endif
        
        <hr>
        <h5>{{ trans('string.indu_banner_desc') }}</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">{{ trans('string.about2') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a href="/">{{ trans('string.industrial_application') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            {{ trans('string.about2') }}
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto about-content">
            <h3 class="about-section-title">{{ trans('string.industrial_application') }}</h3>
            <div class="about-text">
                <p>{{ trans('string.indu_desc1') }}</p>
            </div>
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
            <p>&nbsp;</p>
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
            <div class="btn-section industry">
                <a class="learn-more-btn" href="/product">{{ trans('string.learn_more_products') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
