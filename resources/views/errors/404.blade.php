@extends('main')

@section('custom-script')
<script src="/js/post-list.js"></script>
@endsection

@section('custom-style')
@endsection

@section('content')
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">{{ trans('string.home') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            {{ trans('string.404') }}
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9 mx-auto">
            <img style="max-width: 100%;" class="mx-auto d-block" src="/img/404--page.png" alt="">
        </div>
    </div>
</div>
<div class="container product-list"> 
    <div class="row">
        <div class="col-md-12 btn-section">
            <a href="/product" class="learn-more-btn">{{ trans('string.home') }}</a>
        </div>
    </div>
</div>
@endsection
