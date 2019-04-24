@extends('main')

@section('custom-script')
<script src="/js/post-list.js"></script>
@endsection

@section('custom-style')
@endsection

@section('content')
<div class="sub-page-banner" style="background-image: url('/img/sub-banner.jpg');">
    <div>
        <h2>新聞中心</h2>
        <h4>News & Informationa</h4>
        <hr>
        <h5>我們將不定時更新關於日澤各種最新動態，歡迎您隨時關注我們</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">首页</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            新聞中心
        </div>
    </div>
</div>
<div id="post-list">
<post-list></post-list>
</div>
{{-- <div class="container">
    <div class="row">
        <div class="col-md-3" id="tree">   
            <ul id="treeData" style="display: none;">
                @foreach (CategoryView::postRoot() as $index => $item)
                    <li id="{{$item->categoryGuid}}" class="expanded"><a href="#">{{$item->categoryTitle}}</a>
                        @if (CategoryView::getProductByParent($item->categoryGuid))
                            <ul>
                                @foreach (CategoryView::getProductByParent($item->categoryGuid) as $key => $value)
                                    <li id="{{$value->categoryGuid}}">
                                        <a href="#">{{$value->categoryTitle}}</a>
                                    </li>
                                @endforeach                                    
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-9" id="post-list">
            @foreach (PostView::allasc(10) as $key => $value)
                <div class="row blog-list-section" onclick="window.location.href = '/blog/{{$value->customPath}}'" style="cursor: pointer">
                    <div class="col-md-4 blog-feature-image" id="blog-{{$value->postGuid}}">
                        <img src="/img/4x3.png" alt="">
                    </div>
                    <div class="col-md-8 blog-content">
                        <h3>{{$value->postTitle}}</h3>
                        <hr>
                        {{mb_strimwidth(preg_replace('#<[^>]+>#', ' ', $value->content), 0, 300, "...")}}
                        <br>
                        <br>
                        <a href="/blog/{{$value->customPath}}">繼續閱讀 ></a>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div> --}}
@endsection
