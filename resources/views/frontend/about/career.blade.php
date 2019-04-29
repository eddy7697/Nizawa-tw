@extends('main')

@php
    use App\Career;
    $careers = Career::where('isShow', 1)->paginate(6);
@endphp

@section('custom-script')
@endsection

@section('custom-style')
@endsection

@section('content')
<div class="sub-page-banner" style="background-image: url('/img/sub-banner.jpg');">
    <div>
        <h2>人才招募</h2>
        <h4>Recruiting</h4>
        <hr>
        <h5>我們正在招募各種優秀人才，歡迎您加入日澤國際</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">首頁</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a href="/">關於日澤</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            人才招募
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 about-content">
            <h3 class="about-section-title">公司簡介</h3>
            <div class="career-list">
                @foreach ($careers as $item)
                    <div class="career-item">
                        <div class="row">
                            <div class="col-md-10 career-info">
                                <h5>{{$item->title}}</h5>
                                <ul class="career-department">
                                    <li>職缺單位：{{$item->department}}</li>
                                    <li>應聘人數：{{$item->number}} 人</li>
                                </ul>
                                <ul class="career-location">
                                    <li>{{$item->location}}</li>
                                    @if (strlen($item->experience) == 0)
                                        <li>經歷不拘</li>
                                    @else
                                        <li>{{$item->experience}}</li>
                                    @endif
                                    @if (strlen($item->education) == 0)
                                        <li>學歷不拘</li>
                                    @else
                                        <li>{{$item->education}}</li>
                                    @endif
                                </ul>
                                <hr>
                                <div class="career-content">
                                    {!!$item->description!!}
                                </div>
                                <hr>
                                <div class="career-pay">
                                    月薪：{{$item->paymentRange}} 元
                                </div>
                            </div>
                            <div class="col-md-2 action-group">
                                <div class="action-group-content">
                                    @if ($item->status)
                                        <a href="/about/job/{{$item->id}}">
                                            <button class="btn btn-block btn-resume">我要應徵</button>
                                        </a>
                                    @else
                                        <button class="btn btn-block btn-resume off">暫不開放</button>
                                    @endif
                                    @if ($item->isTop)
                                        <span class="hot-tag">最火職缺</span>    
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>

        <div class="col-md-12">
            {{$careers}}
        </div>
    </div>
</div>
@endsection
