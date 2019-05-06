@extends('main')

@section('custom-script')
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
            工業工程
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 about-content">
            <h3 style="text-align: center;margin-top: 50px;">{{ trans('string.content_construction') }}</h3>
            <img src="/img/site-logo/findmore.png" style="max-width: 768px;margin-top: 0" class="about-logo" alt="">
        </div>
    </div>
</div>
@endsection
