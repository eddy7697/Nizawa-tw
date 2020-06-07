@extends('main')

@section('custom-script')
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
            {{ trans('string.indu6') }}
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 about-content">
            {{-- <h3 style="text-align: center;margin-top: 50px;">{{ trans('string.content_construction') }}</h3> --}}
            <img src="https://nizawa.shuo-guo.net/img/industry/food.jpg" style="max-width: 1024px;margin-top: 50px" class="about-logo" alt="">
        </div>
    </div>
</div>
@endsection
