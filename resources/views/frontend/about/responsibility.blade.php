@extends('main')

@section('custom-script')
<script src="/js/plugins/countup/countUp.min.js" type="module"></script>
@endsection

@section('custom-style')
@endsection

@section('content')
<div class="sub-page-banner" style="background-image: url('/img/sub-banner.jpg');">
    <div>
        <h2>{{ trans('string.responsibility') }}</h2>
        @if (App::getLocale() !== 'en')
        <h4>CSR</h4>
        @endif
        <hr>
        <h5>{{ trans('string.csr_banner_desc') }}</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-11 mx-auto">
            <a href="/">{{ trans('string.home') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a href="/">{{ trans('string.about') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            {{ trans('string.responsibility') }}
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-11 mx-auto about-content">
            <h3 class="about-section-title">{{ trans('string.csr_title_1') }}</h3>
            <div class="about-text">
                <p>{{ trans('string.csr_desc_1') }}</p>
            </div>
        </div>
        <div class="col-md-11 mx-auto image-section">
            <img src="/img/about/企業社會責任.jpg" alt="">
        </div>
        <div class="col-md-11 mx-auto about-content">
            <h3 class="about-section-title">{{ trans('string.csr_title_2') }}</h3>
            <div class="about-text">
                {!! trans('string.csr_desc_2') !!}
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
                {!! trans('string.csr_desc_3') !!}
            </div>
        </div>
    </div>
</div>
@endsection
