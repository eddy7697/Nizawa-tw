@extends('main')

@section('custom-script')
<script src="/js/plugins/countup/countUp.min.js" type="module"></script>
@endsection

@section('custom-style')
@endsection

@section('content')
<div class="sub-page-banner" style="background-image: url('/img/sub-banner.jpg');">
    <div>
        <h2>企業社會責任</h2>
        <h4>Corporate social responsibility</h4>
        <hr>
        <h5>您可於此處瞭解日澤企業社會責任理念，我們期待付出更大的努力為社會付出</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-11 mx-auto">
            <a href="/">首頁</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a href="/">關於日澤</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            企業會社責任
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-11 mx-auto about-content">
            <h3 class="about-section-title">企業社會責任 CSR</h3>
            <div class="about-text">
                <p>日澤旗下主要有三個戰略平臺，分別為水質檢測、食品安全及生技藥妝，與全球眾多的合作伙伴，一同為大中華區的環衛食安把關。公司主要
                    管理及技日澤將企業社會責任作為公司永續發展的核心，立足宏觀環境、產業發展的背景和趨勢，從滿足社會、行業需求出發，結合自身優勢
                    確定社會責任策略。日澤將企業社會責任深化為企業承諾、環境保護與社會參與等面向，且持續提供創新、高質量的產品，同時兼顧環境、員
                    工健康與人權，並積極維護利害關係人權益。</p>
            </div>
        </div>
        <div class="col-md-11 mx-auto image-section">
            <img src="/img/about/企業社會責任.jpg" alt="">
        </div>
        <div class="col-md-11 mx-auto about-content">
            <h3 class="about-section-title">社會責任管理體系</h3>
            <div class="about-text">
                <p>日澤深耕環衛及食安領域已超過三十年，我們重視的不僅是公司的治理與運營，更看重企業的社會責任。</p>
                <p>我們以公司永續發展為核心，持續深化企業承諾、環境保護與社會參與等面向，且持續提供創新、高質量的產品，同時兼顧環境、員工健康與人權，並積極維護利害關係人權益。</p>
                <p>為了將企業社會責任的理念完全融入於經營理念與組織文化，日澤已在公司內部成立企業社會責任小組，由董事長擔任總召集人，總經理擔任副召集人，負責全公司社會責任策略擬訂及績效監督。</p>
                <p>另外，總經理室與其他相關管理部門，則積極推動並落實公司治理、環境保護、員工關懷等相關業務，努力實踐社會責任。</p>
            </div>
            @if (false)
            <div class="row cofounder-section">
                <div class="col-md-6 cofounder">
                    <div class="image">
                        <img src="/img/about/總召集人.png" alt="">
                    </div>
                    <div class="job-title">
                        總召集人 董事長
                    </div>
                    <div class="name">
                        王大明 先生
                    </div>
                </div>
                <div class="col-md-6 cofounder">
                    <div class="image">
                        <img src="/img/about/副召集人.png" alt="">
                    </div>
                    <div class="job-title">
                        副總召集人 總經理
                    </div>
                    <div class="name">
                        班傑明‧小明 先生
                    </div>
                </div>
            </div>
            @endif
            
            <div class="about-text" style="margin-bottom: 50px;">
                <p>豐富的產業經驗及專業的技術團隊，日澤非常清楚台灣使用者於環衛及食安領域的需求與發展，因此我們更加努力滿足客戶的需求，希望提供最
                    完善的檢測產品，為提升國人的環衛食安質量努力不懈。</p>
                <p>「綠能、環保、永續」是我們企業社會責任的理念，除了以此理念肩負環衛食安檢測產
                    品的領導者外，我們更期望能透過持續的付出，來成就美好的社會。</p>
            </div>
        </div>
    </div>
</div>
@endsection
