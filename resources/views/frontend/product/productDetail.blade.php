@extends('main')

@section('custom-meta')
    <meta property="og:url" content="{{(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"}}"></meta>
    <meta property="og:title" content="{{$product->seoTitle}}" />
    <meta property="og:description" content="{{$product->seoDescription}}" />
    <!--分享用圖片在這，一樣有保留-->
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

    @php
        use App\Category; 
        use App\Product;

        $mainCate = Category::where('categoryGuid', $product->mainCategory)->first();
        $subCate = Category::where('categoryGuid', $product->subCategory)->first();
        $content = json_decode($product->productDescription);
    @endphp
    <div class="mg-site-thumbnail">
        <div class="container">
            <div class="col-md-12">
                <a href="/">首頁</a>
                &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
                <a href="/product">產品中心</a>
                &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
                {{-- <a href="/product?main={{$mainCate->categoryGuid}}">{{$mainCate->categoryTitle}}</a>
                &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
                <a href="/product?sub={{$mainCate->categoryGuid}}">{{$subCate->categoryTitle}}</a>
                &nbsp;&nbsp;<a>></a>&nbsp;&nbsp; --}}
                {{$product->productTitle}}
            </div>
        </div>
    </div>

    <div class="container mg-product">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    {{--產品圖片輪播--}}
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

                    {{--產品資訊以及功能--}}
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
                                <span>{{count($comentList)}} 則評價</span>
                            </div>
                        @endunless
                        <div class="clear-left"></div>

                        {{--簡短說明--}}
                        <div class="short-description">
                            <h4>型號：{{$product->serialNumber}}</h4>
                            <h4>貨號：{{$product->rule}}</h4>
                        </div>

                        <hr>

                        {{--简短说明--}}
                        <h4 style="color: #000; font-weight: bolder">產品特色</h4>
                        <div class="short-description">
                            {!!$product->shortDescription!!}
                        </div>

                        <hr>

                        {{--简短说明--}}
                        <h4 style="color: #000; font-weight: bolder">產品特色</h4>
                        <div class="short-description">
                            {!!$content->industry!!}
                        </div>

                        <hr>

                        {{--選擇數量以及加入購物車--}}
                        <div class="product-function" id="product-methods">
                            <product-methods guid='{{$product->productGuid}}'></product-methods>
                        </div>
                        
                        <hr>
                        <div class="share-section">
                            <span>share this products</span>
                            <img src="/img/icon/icon-03-01.svg" alt="">
                            <img src="/img/icon/icon-03-02.svg" alt="">
                        </div>
                        {{-- 需要協助嗎? <a href="#" data-toggle="modal" data-target="#myModal-01">聯絡我們</a> --}}
                    </div>

                    {{--產品敘述--}}
                    <div class="col-md-12 product-description">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="intro-tab" data-toggle="tab" href="#intro" role="tab" aria-controls="intro" aria-selected="true">產品介紹</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">檢測步驟</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">檢測項目</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">儀器規格</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="intro" role="tabpanel" aria-labelledby="intro-tab">
                                {!!$content->intro!!}
                            </div>
                            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                                產品特色說明
                            </span>
                        </div>
                        <div class="description-detail">
                            {!!$product->productDescription!!}
                        </div> --}}
                    </div>

                    {{-- 評論列表 --}}
                    @if (false)
                    <div class="col-md-12">
                        <hr>
                        <h3>評論列表</h3>
                        <hr>
                        @if (count($comentList) == 0)
                            目前沒有評論唷~趕快來新增一個吧!
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
                                                    <a href="/product/delete/comment/{{$item->guid}}" onclick="return confirm('確認刪除此筆評論?')">刪除</a>
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
                            <h3>發表評論</h3>
                            <hr>
                            <div class="form-group">
                                <label for="comment-name">暱稱</label>
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
                                    placeholder="請輸入暱稱"
                                    required>

                            </div>
                            <div class="form-group">
                                <label>評分：</label>
                                <select class="rate-star" id="comment-rate" name="comment-rate">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5" selected>5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="comment-content">請寫下您的評語</label>
                                <textarea class="form-control" id="comment-content" name="comment-content" style="width: 100%; min-height: 150px; resize: vertical" required></textarea>
                            </div>
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                    <strong>登入必須通過驗證</strong>
                                </span>
                            @endif
                            <hr>
                            <button class="btn btn-primary">發表評論</button>
                        </form>

                    </div>
                    @endif
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div class="center-hr">
                    <span>
                        最新產品
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

    {{-- 客服資訊 --}}
    <div class="modal fade" id="myModal-01" tabindex="-1" role="dialog" aria-labelledby="myModal-01Label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 style="text-align:center; margin: 10px;">客服資訊</h3>

                    <hr />
                    <h4>Email查詢</h4>

                    <p>將您的問題以電子郵件寄送至&nbsp;044555@gmail.com，我們將有客服為您解答。</p>
                    <br>
                    <h4>電話查詢</h4>

                    <p>在工作日的9:00-16:30，歡迎撥打03-9590903與我們聯絡查詢。</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">關閉視窗</button>
                </div>
            </div>
        </div>
    </div>

    {{-- 購買工具列 --}}
    {{-- <div class="mobile-tool-bar">
        <ul>
            <li>
                <a class="btn btn-primary btn-block" onclick="addSingleProduct('{{$guid}}')"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;加入購物車</a>
            </li>
            <li>
                <a class="btn btn-primary btn-block" onclick="checkoutImmediately('{{$guid}}')"><span class="glyphicon glyphicon-gift"></span>&nbsp;立即購買</a>
            </li>
        </ul>
    </div> --}}

    {{-- Product --}}
    <div class="container product-list">
        <div class="row">
            <div class="col-md-12">
                <h3 style="text-align: center">其他相關產品</h3>
                <hr>
            </div>
        </div>
        <div class="row">
            @foreach (ProductView::getPopularProductsByCount(3) as $item)
                <div class="col-md-4 product-content" data-aos="fade-up">
                    <div class="product-box">
                        <a href="/product-detail/{{$item->productGuid}}">
                            <div class="product-feature-image" style="background-image: url('{{$item->featureImage}}');"></div>
                            <div class="product-info">
                                <h3 class="product-title">{{$item->productTitle}}</h3>
                                <h4 class="product-type">型式：{{$item->serialNumber}}</h4>
                                <p>近紅外線變頻調光式，不受外部光線變化影響。</p> 
                                <p>特殊耐汙防水檢測元件，確保長期使用穩定性。</p> 
                                <p>4~20mA輸出訊號，上下限警報各a/b接點。</p> 
                                <br>
                                <p>測定範圍： 0~20000 mg/l</p>
                            </div>
                        </a>
                        <a class="product-link" style="cursor: pointer" onclick="addSigleProduct('{{$item->productGuid}}')">加入詢價車</a>
                    </div>
                </div>
            @endforeach
            <div class="col-md-12 btn-section">
                <a href="" class="learn-more-btn">檢視更多產品</a>
            </div>
        </div>
    </div>
    
@endsection
