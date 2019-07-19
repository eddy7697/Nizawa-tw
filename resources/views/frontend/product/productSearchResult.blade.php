@extends('main')

@php
    use App\Product;
    use Illuminate\Support\Facades\Log;
    
    $keyword = $_GET['keyword'];
    $results = Product::where('productTitle', 'like', "%$keyword%")->paginate(12);
@endphp

@section('custom-style')
@endsection

@section('custom-script')
@endsection

@section('content')
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">{{ trans('string.home') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a href="/product">{{ trans('string.product_center') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            {{ trans('string.search_result') }} : <span style="color: red; font-weight: 700">{{$keyword}}</span> 
        </div>
    </div>
</div>

<div class="container product-list sub">
    <div class="row label-list">
        @foreach ($results as $item)
            @php
                $content = json_decode($item->productDescription);
            @endphp
            <div class="col-md-4 product-content">
                <div class="product-box">
                    <a href="/product-detail/{{$item->productGuid}}">
                        <div class="product-feature-image" style="background-image: url('{{$item->featureImage}}');"></div>
                        <div class="product-info">
                            <h3 class="product-title">{{$item->productTitle}}</h3>
                            <h4 class="product-type">型式：{{$item->serialNumber}}</h4>
                            <div class="product-text">
                                {{mb_strimwidth(preg_replace('#<[^>]+>#', ' ', $content->intro), 0, 100, "...")}}
                            </div>
                        </div>
                    </a>
                    <a class="product-link" style="cursor: pointer" onclick="addSigleProduct('{{$item->productGuid}}')">{{ trans('cart.add_cart') }}</a>
                </div>
            </div> 
        @endforeach
    </div>
</div>
@endsection
