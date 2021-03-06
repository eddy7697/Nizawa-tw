@extends('main')

@section('custom-script')
    <script type="text/javascript">
        function addSingleProduct(guid) {
            CH.addSingleProductToCart(guid);
            return;
        }

        $(function () {
            @foreach (CategoryView::product() as $item)
                $('#link-{{$item->guid}}').on('click', function () {
                    $('html,body').animate({scrollTop:$('#section-{{$item->guid}}').offset().top}, 800);
                });
            @endforeach
        });
    </script>
@endsection

@section('content')
    <div class="container mg-site-thumbnail">
        <div class="col-md-12">
            <a href="/">首頁</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;搜尋結果
        </div>
    </div>
    <div class="container mg-product list">
        <div class="row product-single-category">
            {{-- <form class="" action="/search-option" method="post">
                {{csrf_field()}}
                <input type="text" name="key-word" value="">
                <button type="submit">submit</button>
            </form> --}}
            <br>
            @foreach ($product as $item)
                <div class="col-sm-3 product-box">
                    <div class="product-image">
                        <a href="/product-detail/{{$item->productGuid}}">
                            <img src="{{Helper::thumb($item->featureImage)}}" alt="">
                        </a>
                        <div class="add-to-cart">
                            <img class="add-loading" src="https://nizawa.shuo-guo.net/img/icon/loading.svg" width="15" alt="">
                            @if ($item->productType == 'simple')
                                <a class="add-btn" onclick="addSigleProduct('{{$item->productGuid}}')"><span>{{ trans('cart.add_cart') }}</span></a>
                            @else
                                <a class="add-btn" href="/product-detail/{{$item->productGuid}}"><span>檢視產品</span></a>
                            @endif    
                        </div>
                    </div>
                    <div class="product-title">
                        <a href="/product-detail/{{$item->productGuid}}">{{$item->productTitle}}</a>
                        <span>貨號：{{$item->serialNumber}}</span>
                    </div>
                    <div class="product-price">
                        <span>NT$ {{number_format($item->price)}}</span>
                    </div>
                </div>
            @endforeach
            {{-- <ul>
                @foreach ($product as $item)
                    <li>{{$item->title}}</li>
                @endforeach
            </ul>
            <ul>
                @foreach ($post as $item)
                    <li>{{$item->title}}</li>
                @endforeach
            </ul> --}}
        </div>

    </div>
    {{-- <div class="container">
        <div class="row">
            <div class="col-md-12">


                @foreach ($product as $item)
                    <div class="col-sm-3 product-box">
                        <div class="product-image">
                            <a href="/product-detail/{{$item->guid}}">
                                <img src="{{Helper::thumb($item->featureImage)}}" alt="">
                            </a>
                            <div class="add-to-cart">
                                <img class="add-loading" src="https://nizawa.shuo-guo.net/img/icon/loading.svg" width="15" alt="">
                                <a class="add-btn" onclick="addSingleProduct('{{$item->guid}}')"><span>{{ trans('cart.add_cart') }}</span></a>
                            </div>
                        </div>
                        <div class="product-title">
                            <a href="/product-detail/{{$item->guid}}">{{$item->title}}</a>
                        </div>
                        <div class="product-price">
                            <span>NT$ {{number_format($item->price)}}</span>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div> --}}

@endsection
