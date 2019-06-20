@extends('main')

@section('custom-script')
<script src="/js/post-list.js"></script>
@endsection

@section('custom-style')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 mx-auto" style="text-align: center">
            <img style="max-width: 100%; margin-top: 50px;" class="mx-auto d-block" src="/img/404-pic.jpg" alt="">
            <p>&nbsp;</p>
            <p style="font-size: 24px; font-weight: 900">{!! trans('string.resource_not_found') !!}</p>
        </div>
    </div>
</div>
<div class="container product-list sub"> 
    <div class="row">
        <div class="col-md-12 btn-section">
            <a href="/product" class="learn-more-btn" style="padding: 10px 50px; margin-top: -12;">{{ trans('string.back_to_home') }}</a>
        </div>
    </div>
</div>
@endsection
