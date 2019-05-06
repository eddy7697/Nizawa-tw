@extends('main')

@section('custom-script')
    <script type="text/javascript">
        $(function () {
            $('.card').each(function (e) {
                if (!$(this).find('.collapse').hasClass('show')) {
                    $(this).find('.btn-link').addClass('collapsed')
                }
            });
        });
    </script>
@endsection

@section('custom-style')
    <style media="screen">
        .feature-image {
            background-image: url('/img/logo_grey.png');
            background-position: center;
            background-size: cover;
            padding-bottom: 41.6%;
        }
        .feature-content {
           
        }
        .feature-content p{
            line-height: 2em;
            text-indent : 2em;
        }
    </style>
@endsection

@section('content')
<div class="sub-page-banner" style="background-image: url('/img/sub-banner.jpg');">
    <div>
        <h2>常見問題</h2>
        <h4>FAQ</h4>
        <hr>
        <h5>任何產品常見問題，或想了解詢價流程，都在這裡為您詳加介紹</h5>
    </div>
</div>
@if (App::getLocale() == 'en')
<div class="container">
    <div class="row">
        <div class="col-md-12 about-content">
            <h3 style="text-align: center;margin-top: 50px;">{{ trans('string.content_construction') }}</h3>
            <img src="/img/site-logo/findmore.png" style="max-width: 768px;margin-top: 0" class="about-logo" alt="">
        </div>
    </div>
</div>
@else
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">首頁</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a href="/">服務支持</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            常見問題
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 about-content">
            <h3 class="about-section-title">最常見的{{count(PageView::qnaTop())}}個問題</h3>
            <div class="collapse-container top" id="accordion-top">
                @foreach (PageView::qnaTop() as $key => $item)
                    <div class="card">
                        <div class="card-header" id="heading_top_{{$key}}">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_top_{{$key}}" aria-expanded="true" aria-controls="collapse_top_{{$key}}">
                            {{json_decode($item->qatitle, true)[App::getLocale()]}}
                            </button>
                        </h5>
                        </div>
                    
                        <div id="collapse_top_{{$key}}" class="collapse" aria-labelledby="heading_top_{{$key}}" data-parent="#accordion-top">
                        <div class="card-body">
                            {!!nl2br(json_decode($item->qacontent, true)[App::getLocale()])!!}
                        </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-12 about-content">
            <h3 class="about-section-title">常見問題查詢</h3>
        </div>
        <div class="col-md-7 mx-auto news-search-form">
            <form method="GET" action="/qna/search">
                <div class="input-group mb-3">
                    <input type="text" class="form-control search-input shadow-none" name="keyword" placeholder="輸入問題關鍵字搜尋...">
                    <div class="input-group-append">
                        <button class="btn btn-search" type="submit">搜尋</button> 
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-11 mx-auto qna-container">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs qna-tabs" style="margin-bottom: 10px;">
                <li class="nav-item">
                    <a class="nav-link btn site-btn active" data-toggle="tab" href="#home">一般產品問題</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn site-btn" data-toggle="tab" href="#menu1">詢價問題</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn site-btn" data-toggle="tab" href="#menu2">服務支持</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn site-btn" data-toggle="tab" href="#menu3">運送相關</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn site-btn" data-toggle="tab" href="#menu4">支付相關</a>
                </li>
            </ul>
            <ul class="nav nav-tabs qna-tabs">
                <li class="nav-item">
                    <a class="nav-link btn site-btn" data-toggle="tab" href="#menu5">水質檢測相關產品</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn site-btn" data-toggle="tab" href="#menu5">食品安全相關產品</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn site-btn" data-toggle="tab" href="#menu6">生技藥妝相關產品</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn site-btn" data-toggle="tab" href="#menu7">試劑相關產品</a>
                </li>
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane container active" id="home">
                    <div class="collapse-container" id="accordion">
                        @foreach (PageView::qna('一般產品問題') as $key => $item)
                            <div class="card">
                                <div class="card-header" id="heading_1_{{$key}}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_1_{{$key}}" aria-expanded="true" aria-controls="collapse_1_{{$key}}">
                                        {{json_decode($item->qatitle, true)[App::getLocale()]}}
                                        </button>
                                    </h5>
                                </div>
                            
                                <div id="collapse_1_{{$key}}" class="collapse" aria-labelledby="heading_1_{{$key}}" data-parent="#accordion">
                                <div class="card-body">
                                    {!!nl2br(json_decode($item->qacontent, true)[App::getLocale()])!!}
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="tab-pane container fade" id="menu1">
                    <div class="collapse-container" id="accordion_1">
                        @foreach (PageView::qna('詢價問題') as $key => $item)
                            <div class="card">
                                <div class="card-header" id="heading_2_{{$key}}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_2_{{$key}}" aria-expanded="true" aria-controls="collapse_2_{{$key}}">
                                        {{json_decode($item->qatitle, true)[App::getLocale()]}}
                                        </button>
                                    </h5>
                                </div>
                            
                                <div id="collapse_2_{{$key}}" class="collapse" aria-labelledby="heading_2_{{$key}}" data-parent="#accordion_1">
                                <div class="card-body">
                                    {!!nl2br(json_decode($item->qacontent, true)[App::getLocale()])!!}
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane container fade" id="menu2">
                    <div class="collapse-container" id="accordion_2">
                        @foreach (PageView::qna('服務支持') as $key => $item)
                            <div class="card">
                                <div class="card-header" id="heading_3_{{$key}}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_3_{{$key}}" aria-expanded="true" aria-controls="collapse_3_{{$key}}">
                                        {{json_decode($item->qatitle, true)[App::getLocale()]}}
                                        </button>
                                    </h5>
                                </div>
                            
                                <div id="collapse_3_{{$key}}" class="collapse" aria-labelledby="heading_3_{{$key}}" data-parent="#accordion_2">
                                <div class="card-body">
                                    {!!nl2br(json_decode($item->qacontent, true)[App::getLocale()])!!}
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane container fade" id="menu3">
                    <div class="collapse-container"id="accordion_3">
                        @foreach (PageView::qna('運送相關') as $key => $item)
                            <div class="card">
                                <div class="card-header" id="heading_4_{{$key}}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_4_{{$key}}" aria-expanded="true" aria-controls="collapse_4_{{$key}}">
                                        {{json_decode($item->qatitle, true)[App::getLocale()]}}
                                        </button>
                                    </h5>
                                </div>
                            
                                <div id="collapse_4_{{$key}}" class="collapse" aria-labelledby="heading_4_{{$key}}" data-parent="#accordion_3">
                                <div class="card-body">
                                    {!!nl2br(json_decode($item->qacontent, true)[App::getLocale()])!!}
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane container fade" id="menu4">
                    <div class="collapse-container" id="accordion_4">
                        @foreach (PageView::qna('支付相關') as $key => $item)
                            <div class="card">
                                <div class="card-header" id="heading_5_{{$key}}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_5_{{$key}}" aria-expanded="true" aria-controls="collapse_5_{{$key}}">
                                        {{json_decode($item->qatitle, true)[App::getLocale()]}}
                                        </button>
                                    </h5>
                                </div>
                            
                                <div id="collapse_5_{{$key}}" class="collapse" aria-labelledby="heading_5_{{$key}}" data-parent="#accordion_4">
                                <div class="card-body">
                                    {!!nl2br(json_decode($item->qacontent, true)[App::getLocale()])!!}
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane container fade" id="menu5">
                    <div class="collapse-container" id="accordion_5">
                        @foreach (PageView::qna('水質檢測相關產品') as $key => $item)
                            <div class="card">
                                <div class="card-header" id="heading_6_{{$key}}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_6_{{$key}}" aria-expanded="true" aria-controls="collapse_6_{{$key}}">
                                        {{json_decode($item->qatitle, true)[App::getLocale()]}}
                                        </button>
                                    </h5>
                                </div>
                            
                                <div id="collapse_6_{{$key}}" class="collapse" aria-labelledby="heading_6_{{$key}}" data-parent="#accordion_5">
                                <div class="card-body">
                                    {!!nl2br(json_decode($item->qacontent, true)[App::getLocale()])!!}
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane container fade" id="menu6">
                    <div class="collapse-container" id="accordion_6">
                        @foreach (PageView::qna('食品安全相關產品') as $key => $item)
                            <div class="card">
                                <div class="card-header" id="heading_7_{{$key}}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_7_{{$key}}" aria-expanded="true" aria-controls="collapse_7_{{$key}}">
                                        {{json_decode($item->qatitle, true)[App::getLocale()]}}
                                        </button>
                                    </h5>
                                </div>
                            
                                <div id="collapse_7_{{$key}}" class="collapse" aria-labelledby="heading_7_{{$key}}" data-parent="#accordion_6">
                                <div class="card-body">
                                    {!!nl2br(json_decode($item->qacontent, true)[App::getLocale()])!!}
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane container fade" id="menu7">
                    <div class="collapse-container" id="accordion_7">
                        @foreach (PageView::qna('生技藥妝相關產品') as $key => $item)
                            <div class="card">
                                <div class="card-header" id="heading_8_{{$key}}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_8_{{$key}}" aria-expanded="true" aria-controls="collapse_8_{{$key}}">
                                        {{json_decode($item->qatitle, true)[App::getLocale()]}}
                                        </button>
                                    </h5>
                                </div>
                            
                                <div id="collapse_8_{{$key}}" class="collapse" aria-labelledby="heading_8_{{$key}}" data-parent="#accordion_7">
                                <div class="card-body">
                                    {!!nl2br(json_decode($item->qacontent, true)[App::getLocale()])!!}
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane container fade" id="menu8">
                    <div class="collapse-container" id="accordion_8">
                        @foreach (PageView::qna('試劑相關產品') as $key => $item)
                            <div class="card">
                                <div class="card-header" id="heading_9_{{$key}}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_9_{{$key}}" aria-expanded="true" aria-controls="collapse_9_{{$key}}">
                                        {{json_decode($item->qatitle, true)[App::getLocale()]}}
                                        </button>
                                    </h5>
                                </div>
                            
                                <div id="collapse_9_{{$key}}" class="collapse" aria-labelledby="heading_9_{{$key}}" data-parent="#accordion_8">
                                <div class="card-body">
                                    {!!nl2br(json_decode($item->qacontent, true)[App::getLocale()])!!}
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
