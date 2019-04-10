@extends('main')

@section('custom-script')
    <script src="{{ asset('js/plugins/jquery.fancytree/dist/jquery.fancytree-all.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $("#tree").fancytree({
                icon: false,
                click: function (event, data) {
                    console.log(data.node.key)
                    window.location.href = '/blog/category/' + data.node.key
                },
                activate: function (event, data) {

                }
            });

            setTimeout(() => {
                $('#tree').fancytree('getTree').getNodeByKey('{{$category}}').setActive()
            }, 100)
        });
    </script>
@endsection

@section('custom-style')
    <link rel="stylesheet" href="{{ asset('js/plugins/jquery.fancytree/dist/skin-themeroller/ui.fancytree.min.css') }}">
    <style>
        ul.fancytree-container {
            border: none;
            outline: 0;
        }
        .fancytree-active {
            background-color: #0BA29B;
            border-radius: 5px;
            overflow: hidden;
        }
        .fancytree-active .fancytree-title {
            color: #fff;
        }
        .fancytree-node:hover {
            font-weight: bold;
        }
    </style>
    <style media="screen">
        @foreach (PostView::all(10) as $key => $value)
            #blog-{{$value->postGuid}} {
                background-image: url('{{$value->featureImage}}');
            }
        @endforeach
        .blog-feature-image {
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
@endsection

@section('content')
<div class="container mg-site-thumbnail">
    <div class="col-md-12">
        <a href="/">首頁</a>
        &nbsp;&nbsp;>&nbsp;&nbsp;
        <a href="/blog">最新消息</a>
        &nbsp;&nbsp;>&nbsp;&nbsp;{{CategoryView::get($category)->categoryTitle}}
    </div>
</div>
<div class="container">
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
            @foreach (PostView::getByCategory($category, 10) as $key => $value)
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
        <div class="col-md-12">
            {{PostView::getByCategory($category, 10)}}
        </div>
    </div>
</div>
@endsection
