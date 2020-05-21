@extends('main')

@section('custom-style')
@endsection

@section('custom-script')
    @yield('sub-script')
@endsection

@section('content')

<div class="sub-page-banner" style="background-image: url('https://nizawa.shuo-guo.net/img/banner-2-1.jpg');">
    <div>
        <h2>{{ trans('string.legal_reseller') }}</h2>
        @if (App::getLocale() !== 'en')
        <h4>Legal reseller</h4>    
        @endif
        <hr>
        <h5>{{ trans('string.reseller_banner_desc') }}</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">{{ trans('string.home') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a href="/contact">{{ trans('string.about4') }}</a> 
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            {{ trans('string.legal_reseller') }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 sub-page-content">
        @yield('sub-content')
    </div>
</div>
@endsection
