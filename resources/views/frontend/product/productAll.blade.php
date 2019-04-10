@extends('main')

@php
    use App\Category;
    use App\Product;
    use Illuminate\Support\Facades\Log;

    $root = Category::where('type', 'product')->whereNull('parentId')->get();
    $rootFirst = Category::where('type', 'product')->whereNull('parentId')->first();

    if (isset($_GET['main'])) {
        Log::info($_GET['main']);
        $rootFirst = Category::where('type', 'product')->where('categoryGuid', $_GET['main'])->first();
    }

    if (isset($_GET['sub'])) {
        $category = Category::where('type', 'product')->where('categoryGuid', $_GET['sub'])->first();
        $rootFirst = Category::where('type', 'product')->where('categoryGuid',$category->parentId)->first();
    }
    
@endphp

@section('custom-style')
@endsection

@section('custom-script')
@endsection

@section('content')
<div class="sub-page-banner" style="background-image: url('/img/banner-2-1.jpg');">
    <div>
        <h2>产品中心</h2>
        <h4>Product center</h4>
        <hr>
        <h5>您可于此页面查找科尔客相关产品，并透过界面完成询价单填写</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">首页</a>
            &nbsp;&nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>&nbsp;&nbsp;
            产品中心
        </div>
    </div>
</div>
<div class="container product-list">
    <div class="row main-category">
        <div class="col-md-7 mx-auto">
            <ul class="row nav nav-tabs">
                @foreach ($root as $key => $item)
                    <li class="col-md-4 category-btn-section nav-item">
                        <a class="nav-link category-btn {{$rootFirst->categoryGuid == $item->categoryGuid ? 'active' : ''}}" href="/product?main={{$item->categoryGuid}}">
                        {{-- <a class="nav-link category-btn {{$rootFirst->categoryGuid == $item->categoryGuid ? 'active' : ''}}" data-toggle="tab" href="#main-tab-{{$key}}"> --}}
                            @include('components.icon.type'.($key + 1))
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    
    <div class="row sub-category tab-content">
        @foreach ($root as $index => $element)
            <div class="col-md-12 tab-pane {{$rootFirst->categoryGuid == $element->categoryGuid ? 'active' : 'fade'}}" id="main-tab-{{$index}}">
                <!-- Nav tabs -->
                @php
                    $subCategory = Category::where('parentId', $element->categoryGuid)->get();
                @endphp
                <ul class="nav nav-tabs sub-category-tabs">
                    @foreach ($subCategory as $key => $item)
                        
                        <li class="nav-item">
                            @php
                                if (isset($_GET['sub'])) {
                                    $active = $_GET['sub'] == $item->categoryGuid;
                                } else {
                                    $active = $key == 0;
                                }
                            @endphp
                            <a class="nav-link {{ $active ? 'active' : ''}}" href="/product?sub={{$item->categoryGuid}}">
                                {{$item->categoryTitle}}
                                <div class="bar"></div>
                            </a>
                        </li>
                    @endforeach
                </ul>
                
                <!-- Tab panes -->
                <div class="tab-content sub-category-tabs-content">
                    @foreach ($subCategory as $key => $item)
                        @php
                            $child = Category::where('parentId', $item->categoryGuid)->get();

                            if (isset($_GET['sub'])) {
                                $active = $_GET['sub'] == $item->categoryGuid;
                            } else {
                                $active = $key == 0;
                            }
                        @endphp
                        <div class="tab-pane container sub-category-panel {{ $active ? 'active' : 'fade'}}" id="tab-{{$index}}-{{$key}}">
                            <ul class="sub-category-list">
                                @foreach ($child as $elm)
                                    <li>
                                        <a href="/product/category/{{$elm->categoryGuid}}">{{$elm->categoryTitle}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach        
    </div>
    <div class="row">
        @php
            $pageCount = 3;
            $products = Product::show()->paginate($pageCount);

            if (isset($_GET['main'])) {
                $products = Product::show()->where('mainCategory', $_GET['main'])->paginate($pageCount);
            }
            if (isset($_GET['sub'])) {
                $products = Product::show()->where('mainCategory', $_GET['sub'])->paginate($pageCount);
            }

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
        @foreach ($products as $item)
            <div class="col-md-4 product-content">
                <div class="product-box">
                    <a href="/product-detail/{{$item->productGuid}}">
                        <div class="product-feature-image" style="background-image: url('{{$item->featureImage}}');"></div>
                        <div class="product-info">
                            <h3 class="product-title">{{$item->productTitle}}</h3>
                            <h4 class="product-type">型式：{{$item->serialNumber}}</h4>
                            <div>
                                {!!$item->shortDescription!!}
                            </div>
                            
                        </div>
                    </a>
                    <a class="product-link" href="">加入询价车</a>
                </div>
            </div>
        @endforeach
        <div class="col-md-12 pagination-section">
            {{-- {{$products}} --}}
        </div>
    </div>
</div>
@endsection
