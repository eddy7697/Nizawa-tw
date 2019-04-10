@extends('main')

@section('custom-meta')
    <meta property="og:url" content="{{(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"}}"></meta>
    <meta property="og:title" content="{{$product->seoTitle}}" />
    <meta property="og:description" content="{{$product->seoDescription}}" />
    <!--分享用图片在这，一样有保留-->
    <meta property="og:image" content="https://www.meansgood.com.tw{{$product->featureImage}}"/>
    <meta property="fb:app_id" content="1758202757809745" />
    <!--**************************-->
    <meta property="og:type" content="website" />
@endsection

@section('custom-script')
    <script src="/js/product-methods.js"></script>
@endsection

@section('content')
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.11&appId=124798941401730';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>


    <div class="mg-site-thumbnail">
        <div class="container">
            <div class="col-md-12">
                <a href="/">首页</a>
                &nbsp;&nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>&nbsp;&nbsp;
                产品中心
            </div>
        </div>
    </div>

    <div class="container mg-product">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    {{--商品图片轮播--}}
                    <div class="col-md-6 product-gallery">
                        <div class="product-img">
                            <div class="product-item">
                                <img src="{{$product->featureImage}}" alt="">
                            </div>
                            @foreach ($album as $item)
                                <div class="product-item">
                                    <img src="{{$item->imageUrl}}" alt="">
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <ul class="product-thumb">
                                    <li>
                                        <div class="thumb-item">
                                            <img src="{{$product->featureImage}}" alt="">
                                        </div>
                                        
                                    </li>
                                    @foreach ($album as $item)
                                        <li>
                                            <div class="thumb-item">
                                                <img src="{{$item->imageUrl}}" alt="">
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        
                    </div>

                    {{--商品信息以及功能--}}
                    <div class="col-md-6 product-info">
                        <h3>{{$product->productTitle}}</h3>
                        @unless (count($comentList) == 0)
                            <div class="rate-box">
                                <select class="rate-star-comment">
                                    @for ($i=1; $i <= $score; $i++)
                                        <option value="{{$i}}" {{$i == $score ? 'selected' : ''}}>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="comment-box">
                                <span>{{count($comentList)}} 则评价</span>
                            </div>
                        @endunless
                        <div class="clear-left"></div>

                        {{--简短说明--}}
                        <div class="short-description">
                            <h4>形式：{{$product->serialNumber}}</h4>
                            <h4>货号：{{$product->rule}}</h4>
                        </div>

                        <hr>

                        {{--简短说明--}}
                        <div class="short-description">
                            {!!$product->shortDescription!!}
                        </div>

                        <hr>

                        {{--选择数量以及加入购物车--}}
                        <div class="product-function" id="product-methods">
                            <product-methods guid='{{$product->productGuid}}'></product-methods>
                        </div>
                        
                        <hr>
                        <div class="share-section">
                            <span>share this products</span>
                            <img src="/img/icon/icon-03-01.svg" alt="">
                            <img src="/img/icon/icon-03-02.svg" alt="">
                        </div>
                        {{-- 需要协助吗? <a href="#" data-toggle="modal" data-target="#myModal-01">联系我们</a> --}}
                    </div>

                    {{--商品叙述--}}
                    <div class="col-md-12 product-description">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">检测步骤</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">检测项目</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">仪器规格</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            @php
                                $content = json_decode($product->productDescription);
                            @endphp
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                {!!$content->step!!}
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                {!!$content->option!!}
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                {!!$content->spec!!}
                            </div>
                        </div>
                        {{-- <div class="center-hr">
                            <span>
                                商品特色说明
                            </span>
                        </div>
                        <div class="description-detail">
                            {!!$product->productDescription!!}
                        </div> --}}
                    </div>

                    {{-- 评论列表 --}}
                    @if (false)
                    <div class="col-md-12">
                        <hr>
                        <h3>评论列表</h3>
                        <hr>
                        @if (count($comentList) == 0)
                            目前没有评论唷~赶快来添加一个吧!
                        @else
                            @foreach ($comentList as $item)
                                <table class="product-comment">
                                    <tr>
                                        <td>
                                            <strong><span style="font-size:24px">{{$item->commentFrom}}</span></strong>
                                            &nbsp;&nbsp;
                                            {{ date_format($item->created_at, 'Y-m-d H:i:s')}}
                                        </td>
                                        {{-- <td>{{ date_format($item->created_at, 'Y-m-d H:i:s')}} </td> --}}
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding-top: 0; padding-bottom: 9px;">
                                            <select class="rate-star-comment">
                                                @for ($i=1; $i <= $item->rate; $i++)
                                                    <option value="{{$i}}" {{$i == $item->rate ? 'selected' : ''}}>{{$i}}</option>
                                                @endfor
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{$item->content}}</td>
                                    </tr>
                                    @unless (Auth::guest())
                                        @if (Auth::user()->role == 'ADMIN')
                                            <tr>
                                                <td>
                                                    <a href="/product/delete/comment/{{$item->guid}}" onclick="return confirm('确认删除此笔评论?')">删除</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endunless
                                </table>
                                <hr style="width: 60%: margin: 0 auto">
                            @endforeach
                        @endif
                    </div>

                    <div class="col-md-12">
                        <hr>
                        <form action="/product/send/comment/{{$guid}}" method="post">
                            {{ csrf_field() }}
                            <h3>发表评论</h3>
                            <hr>
                            <div class="form-group">
                                <label for="comment-name">暱称</label>
                                @unless (Auth::guest())
                                    <div class="form-control" style="max-width: 150px">
                                        {{Auth::user()->name}}
                                    </div>
                                @endunless
                                <input class="form-control"
                                    style="max-width: 150px; {{ Auth::guest() ? "" : "display: none" }} "
                                    id="comment-name"
                                    name="comment-name"
                                    value="{{ Auth::guest() ? "" : Auth::user()->name }}"
                                    placeholder="请输入暱称"
                                    required>

                            </div>
                            <div class="form-group">
                                <label>评分：</label>
                                <select class="rate-star" id="comment-rate" name="comment-rate">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5" selected>5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="comment-content">请写下您的评语</label>
                                <textarea class="form-control" id="comment-content" name="comment-content" style="width: 100%; min-height: 150px; resize: vertical" required></textarea>
                            </div>
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                    <strong>登录必须通过验证</strong>
                                </span>
                            @endif
                            <hr>
                            <button class="btn btn-primary">发表评论</button>
                        </form>

                    </div>
                    @endif
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div class="center-hr">
                    <span>
                        最新商品
                    </span>
                </div>
                <ul class="product-link-list">
                    @foreach ($productList as $item)
                        <li><a href="//product/detail/{{$item->guid}}">{{$item->productTitle}}</a></li>
                    @endforeach
                </ul>
            </div> --}}
        </div>
    </div>

    {{-- 客服信息 --}}
    <div class="modal fade" id="myModal-01" tabindex="-1" role="dialog" aria-labelledby="myModal-01Label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 style="text-align:center; margin: 10px;">客服信息</h3>

                    <hr />
                    <h4>Email查找</h4>

                    <p>将您的问题以电子邮件寄送至&nbsp;044555@gmail.com，我们将有客服为您解答。</p>
                    <br>
                    <h4>电话查找</h4>

                    <p>在工作日的9:00-16:30，欢迎拨打03-9590903与我们联系查找。</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">关闭窗口</button>
                </div>
            </div>
        </div>
    </div>

    {{-- 购买工具列 --}}
    {{-- <div class="mobile-tool-bar">
        <ul>
            <li>
                <a class="btn btn-primary btn-block" onclick="addSingleProduct('{{$guid}}')"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;加入购物车</a>
            </li>
            <li>
                <a class="btn btn-primary btn-block" onclick="checkoutImmediately('{{$guid}}')"><span class="glyphicon glyphicon-gift"></span>&nbsp;立即购买</a>
            </li>
        </ul>
    </div> --}}

    {{-- Product --}}
    <div class="container product-list">
        <div class="row">
            <div class="col-md-12">
                <h3 style="text-align: center">其他相关产品</h3>
                <hr>
            </div>
        </div>
        <div class="row">
            @php
                $dummyData = array(
                    [
                        'featureImage' => '/img/product-image.jpg',
                        'title' => '污泥浓度MLSS监控仪',
                        'type' => 'MC-700'
                    ],
                    [
                        'featureImage' => '/img/product-image-2.jpg',
                        'title' => '化学药液浓度剂',
                        'type' => 'LQ-5z'
                    ],
                    [
                        'featureImage' => '/img/product-image.jpg',
                        'title' => '携带型水质测定器',
                        'type' => '10-X'
                    ]
                );
                
            @endphp
            @foreach ($dummyData as $item)
                <div class="col-md-4 product-content">
                    <div class="product-box">
                        <a href="">
                            <div class="product-feature-image" style="background-image: url('{{$item['featureImage']}}');"></div>
                            <div class="product-info">
                                <h3 class="product-title">{{$item['title']}}</h3>
                                <h4 class="product-type">型式：{{$item['type']}}</h4>
                                <p>近红外线变频调光式，不受外部光线变化影响。</p> 
                                <p>特殊耐污防水检测组件，确保长期使用稳定性。</p> 
                                <p>4~20mA输出信号，上下限警报各a/b接点。</p> 
                                <br>
                                <p>测定范围： 0~20000 mg/l</p>
                            </div>
                        </a>
                        <a class="product-link" href="">加入询价车</a>
                    </div>
                </div>
            @endforeach
            <div class="col-md-12 btn-section">
                <a href="" class="learn-more-btn">查看更多产品</a>
            </div>
        </div>
    </div>
    
@endsection
