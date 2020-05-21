@extends('main')

@php
    $keyword = $_GET['keyword'];
    $result = PageView::qnaSearch($keyword, "");
@endphp

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
    <script type="text/javascript">
		$(document).ready(function () {
			var url = location.href;
			var ary1 = url.split('?');
			var ary2 = ary1[1].split('=');
			var _keyword = decodeURIComponent(ary2[1]);

			$('.card').each(function () {
				var _this = $(this);
				var _title_target = _this.find('.btn-link');
				var _detail_target = _this.find('.card-body');
				var _title = _title_target.html();
				var _detail = _detail_target.html();
				$(_title_target).html(_title.replace(_keyword, "<span style='color: #ff0000;'>" + _keyword + "</span>"));
				$(_detail_target).html(_detail.replace(_keyword, "<span style='color: #ff0000;'>" + _keyword + "</span>"));
			});
		});
    </script>
@endsection

@section('custom-style')
    <style media="screen">
        .feature-image {
            background-image: url('https://nizawa.shuo-guo.net/img/logo_grey.png');
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
<div class="sub-page-banner" style="background-image: url('https://nizawa.shuo-guo.net/img/sub-banner.jpg');">
    <div>
        <h2>{{ trans('string.faq') }}</h2>
        @if (App::getLocale() !== 'en')
        <h4>FAQ</h4>
        @endif
        
        <hr>
        <h5>{{ trans('string.faq_banner_desc') }}</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">{{ trans('string.home') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a href="/">{{ trans('string.support') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            {{ trans('string.search_result') }} : {{$keyword}}
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 about-content">
            <h3 class="about-section-title">{{ trans('string.search_result') }} : {{$keyword}}</h3>
        </div>
        <div class="col-md-7 mx-auto news-search-form">
            <form method="GET" action="/qna/search">
                <div class="input-group mb-3">
                    <input type="text" class="form-control search-input shadow-none" name="keyword" placeholder="輸入問題關鍵字搜尋...">
                    <div class="input-group-append">
                        <button class="btn btn-search" type="submit">{{ trans('string.search') }}</button> 
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-11 mx-auto qna-container">
            <div class="collapse-container" id="accordion">
                @foreach ($result as $key => $item)
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
    </div>
</div>
@endsection
