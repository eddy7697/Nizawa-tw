@extends('main')

@section('custom-style')
@endsection

@section('custom-script')
    @yield('sub-script')
@endsection

@section('content')

<div class="sub-page-banner" style="background-image: url('/img/banner-2-1.jpg');">
    <div>
        <h2>授權經銷商</h2>
        <h4>Legal reseller</h4>
        <hr>
        <h5>歡迎透過本業查詢笠原化工於全球各地的授權經銷商</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">首页</a>
            &nbsp;&nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>&nbsp;&nbsp;
            <a href="/contact">联系我们</a> 
            &nbsp;&nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>&nbsp;&nbsp;
            授權經銷商
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 sub-page-content">
        @yield('sub-content')
    </div>
</div>
@endsection
