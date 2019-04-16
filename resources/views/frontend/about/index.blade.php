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
        <h2>關於日澤</h2>
        <h4>About KASAHARA</h4>
        <hr>
        <h5>優秀的產品與專業的銷售和技術團隊 努力為您做到最好</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">首頁</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a href="/">關於日澤</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            公司簡介
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 about-content">
            <img src="/img/about/logo.png" class="about-logo" alt="">
            <h3 class="about-section-title">公司簡介</h3>
            <div class="about-text">
                <p class="title">卓越的客戶合作關係 深耕環衛分析與檢測</p>
                <p>日澤國際股份有限公司成立於1987年，為臺灣環衛食安分析解決方案的前衛供應商。</p>
                <p>逾三十年的經驗，我們秉持『專業、誠信、創新』之熱忱理念，提供客戶全方位的服務,一同為臺灣的環衛食安把關。</p>

                <p class="title">代理全球知名品牌 豐富多元的產品組合</p>
                <p>引進代理眾多歐、美、日、領導品牌，目前主要著重於環保、工安、食品、生化等相關分析儀器、檢驗設備、試驗耗材等產品。</p>
                <p>為了更貼近臺灣用戶的需求與協助解決檢測所遭遇的問題，我們成立專業強大的技術服務團，積極為客戶提供最完善的產品與諮詢服務。</p>

                <p class="title">國際級的產品認證 為使用者層層把關</p>
                <p>除了提供客戶高品質的產品與專家級服務外，亦注重產品技術革新，旗下多項產品擁有USEPA、JIS、AOAC、MicroVal等認證許可，符合國內相關水質檢測，食品安全及生技品管的法規標準。</p>
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
<div class="container">
    <div class="row">
        <div class="col-md-12 about-content">
            @php
                $albumPath = public_path('img/about/album');
        
                $album = preg_grep('~\.(jpeg|jpg|png)$~', scandir($albumPath));
                $album = array(
                    [
                        'image' => '/img/about/album/about-1.jpg',
                        'title' => '自來水業',
                        'link' => ''
                    ],[
                        'image' => '/img/about/album/about-2.jpg',
                        'title' => '電子行業',
                        'link' => ''
                    ],[
                        'image' => '/img/about/album/about-3.jpg',
                        'title' => '生活汙水',
                        'link' => ''
                    ],[
                        'image' => '/img/about/album/about-4.jpg',
                        'title' => '工業汙水',
                        'link' => ''
                    ],[
                        'image' => '/img/about/album/about-5.jpg',
                        'title' => '養殖漁業',
                        'link' => ''
                    ],[
                        'image' => '/img/about/album/about-6.jpg',
                        'title' => '食品行業',
                        'link' => ''
                    ],[
                        'image' => '/img/about/album/about-7.jpg',
                        'title' => '藥妝行業',
                        'link' => ''
                    ],[
                        'image' => '/img/about/album/about-8.jpg',
                        'title' => '工業工程',
                        'link' => ''
                    ]
                );
            @endphp
            <h3 class="about-section-title">公司簡介</h3>
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
            <h3 class="about-section-title">地理位置</h3>
            <div class="row">
                <div class="col-md-4 about-text">
                    <p>聯絡電話：+886-3-4935921 / +886-3-4935900</p>
                    <p>傳真電話：+886-3-4928654</p>
                    <p>電子郵件：info@nizawa-int.com.tw</p>
                    <p>地址：台灣桃園市中壢區三光路60號3F之1</p>
                    <p>郵遞區號：32047</p>
                    <p>服務時間：09:00 ~ 18:00 (Mon - Fri)</p>
                </div>
                <div class="col-md-8">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3617.1539186723194!2d121.20859441544611!3d24.96087734737173!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346823c9f9eda163%3A0x6f46857d42a84497!2z5pel5r6k5ZyL6Zqb6IKh5Lu95pyJ6ZmQ5YWs5Y-4!5e0!3m2!1szh-TW!2stw!4v1555439354866!5m2!1szh-TW!2stw" style="width: 100%; height: 300px" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <div class="col-md-12 btn-section">
                    <a class="learn-more-btn" href="">聯絡我們</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
