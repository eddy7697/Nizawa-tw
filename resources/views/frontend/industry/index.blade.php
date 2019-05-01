@extends('main')

@section('custom-script')
@endsection

@section('custom-style')
@endsection

@section('content')
<div class="sub-page-banner" style="background-image: url('/img/sub-banner.jpg');">
    <div>
        <h2>產業應用</h2>
        <h4>Industry scenario</h4>
        <hr>
        <h5>無論您屬於各行各業，我們均可為您提供最佳產業應用情境</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">首頁</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a href="/">產業應用</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            公司簡介
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto about-content">
            <h3 class="about-section-title">產業應用</h3>
            <div class="about-text">
                <p>日澤國際股份有限公司成立至今服務眾多企業，為其提供檢驗產品最佳解決方案，多年來秉持豐富的經驗與技術，亦彙整各產業類別適用之最佳解決方案，您可依據我們提供的產業應用範例，充分了解檢測相關各項指標與流程，而日澤國際亦可依據您的需求為您量身打造專屬解決方案</p>
            </div>
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
                <a class="learn-more-btn" href="/product">查看其他產品</a>
            </div>
        </div>
    </div>
</div>
@endsection
