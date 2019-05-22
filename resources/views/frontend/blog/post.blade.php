@extends('main')

@php
    use Carbon\Carbon;

    // $post = PostView::getByPath($path);
    $previous = PostView::previous($post->id);
    $next = PostView::next($post->id);
@endphp

@section('custom-meta')
    <meta property="og:url" content="{{(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"}}"></meta>
    <meta property="og:title" content="{{$post->seoTitle}}" />
    <meta property="og:description" content="{{$post->seoDescription}}" />
    <!--分享用圖片在這，一樣有保留-->
    {{-- <meta property="og:image" content="https://www.meansgood.com.tw{{$post->featureImage}}"/>
    <meta property="fb:app_id" content="1758202757809745" />
    <!--**************************-->
    <meta property="og:type" content="website" /> --}}
@endsection

@section('custom-script')
    <script>
    jQuery('#line-share').on('click', function() {
      window.open("http://line.me/R/msg/text/?" + document.title + '%0D%0A' + window.location.href);
    });

    jQuery('#facebook-share').on('click', function() {
      window.open("https://www.facebook.com/sharer/sharer.php?u=" + window.location.href + '&src=sdkpreparse');
    });

    function lineShare(url, text) {
        var link = "http://line.naver.jp/R/msg/text/?";
        link += encodeURIComponent(text);
        link += "%0D%0A";
        link += encodeURIComponent(url);
        window.open(link);
        return false;
    }
    function facebookShare(url, text) {
        var text;

        text += encodeURIComponent(text);
        text += "%0D%0A";
        text += encodeURIComponent(url);

        window.open("https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(url) + '&src=sdkpreparse');
        return false;
    }
    </script>
@endsection

@section('custom-style')
@endsection

@section('content')
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">{{ trans('string.home') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a href="/blog">{{ trans('string.news_center') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            {{$post->postTitle}}
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 blog-container">
            <p class="create-time"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;{{Carbon::parse($post->created_at)->format('Y.m.d')}}</p>
            <div class="row">
                <div class="col-md-9">
                    <h2>{{$post->postTitle}}</h2>
                </div>
                <div class="col-md-3">
                    <div class="share-section">
                        <span>share this posts</span>
                        <img onclick="facebookShare('{{env('APP_URL')}}/blog/{{$post->customPath}}', '{{$post->postTitle}}')" src="/img/icon/fb.svg" alt="">
                        <img onclick="lineShare('{{env('APP_URL')}}/blog/{{$post->customPath}}', '{{$post->postTitle}}')" src="/img/icon/line.svg" alt="">
                    </div>
                    {{-- <table style="width: 80px;">
                        <tr>

                            <td width="50%" align="left" style="border-bottom: none;"><img id="facebook-share" class="alignleft" src="/img/icon/facebook-icon.svg" alt="" width="80%" /></td>
                            <td width="50%" align="left" style="border-bottom: none;"><img id="line-share" class="aligncenter" src="/img/icon/line-icon.svg" alt="" width="80%" /></td>
                        </tr>
                    </table> --}}
                </div>
            </div>
            <hr>
            <div class="blog-content">
                {!!$post->content!!}
            </div>
            <hr>
            <div class="post-detail-methods">
                <a class="btn" href="/blog">{{ trans('string.return_to_prev') }}</a>
                @if ($previous)
                    <a class="btn" href="/blog/{{$previous->customPath}}">{{ trans('string.view_preivous') }}</a>
                @endif
                @if ($next)
                    <a class="btn" href="/blog/{{$next->customPath}}">{{ trans('string.view_next') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
