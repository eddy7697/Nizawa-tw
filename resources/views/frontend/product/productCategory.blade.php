@extends('main')

@php
    use App\Category;
    use App\Product;

    $root = Category::where('type', 'product')->whereNull('parentId')->get();
    $category = Category::where('categoryGuid', $guid)->first();
    $secLayer = Category::where('categoryGuid', $category->parentId)->first();
    $rootLayer = Category::where('categoryGuid', $secLayer->parentId)->first();
@endphp

@section('custom-style')
@endsection

@section('custom-script')
@endsection

@section('content')
<div class="sub-page-banner" style="background-image: url('https://nizawa.shuo-guo.net/img/sub-banner.jpg');">
    <div>
        <h2>{{ trans('string.product_center') }}</h2>
        @if (App::getLocale() !== 'en')
            <h4>{{ trans('string.product_center') }}</h4>
        @endif
        <hr>
        <h5>{{ trans('string.product_banner_desc') }}</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">{{ trans('string.home') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            {{ trans('string.product_center') }}
        </div>
    </div>
</div>
<div class="container news-list">
    <div class="row">
        <div class="col-md-7 mx-auto news-search-form" style="margin: 50px 0 0 0">
            <form method="GET" action="/product/search">
                <div class="input-group mb-3">
                    <input type="text" class="form-control search-input shadow-none" name="keyword" placeholder="{{ trans('string.search_placeholder_product') }}">
                    <div class="input-group-append">
                        <button class="btn btn-search" type="submit">{{ trans('string.search') }}</button> 
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container product-list sub">
    <div class="row main-category">
        <div class="col-md-10 mx-auto">
            <ul class="row nav nav-tabs">
                @foreach ($root as $key => $item)
                    <li class="col-md-2 mx-auto category-btn-section nav-item">
                    <a class="nav-link category-btn {{$rootLayer->categoryGuid == $item->categoryGuid ? 'active' : ''}}" href="/product/main/{{$item->categoryGuid}}">
                        {{-- <a class="nav-link category-btn {{$rootLayer->categoryGuid == $item->categoryGuid ? 'active' : ''}}" data-toggle="tab" href="#main-tab-{{$key}}"> --}}
                            @include('components.icon.type'.($key + 1), ['title' => json_decode($item->categoryTitle, true)[App::getLocale()]])
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    
    <div class="row sub-category tab-content">
        @foreach ($root as $index => $element)
            <div class="col-md-12 tab-pane {{$rootLayer->categoryGuid == $element->categoryGuid ? 'active' : 'fade'}}" id="main-tab-{{$index}}">
                <!-- Nav tabs -->
                @php
                    // $secLayer->categoryGuid
                    $subCategory = Category::where('parentId', $element->categoryGuid)->get();
                    $activeGuid = $secLayer->parentId == $element->categoryGuid ? $secLayer->categoryGuid : Category::where('parentId', $element->categoryGuid)->first()->categoryGuid;
                @endphp
                <ul class="nav nav-tabs sub-category-tabs">
                    @foreach ($subCategory as $key => $item)
                        <li class="nav-item">
                            <a class="nav-link {{ $activeGuid == $item->categoryGuid ? 'active' : ''}}" href="/product/sub/{{$item->categoryGuid}}">
                            {{-- <a class="nav-link {{ $activeGuid == $item->categoryGuid ? 'active' : ''}}" data-toggle="tab" href="#tab-{{$index}}-{{$key}}"> --}}
                                {{json_decode($item->categoryTitle, true)[App::getLocale()]}}
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
                        @endphp
                        <div class="tab-pane container sub-category-panel {{ $activeGuid == $item->categoryGuid ? 'active' : 'fade'}}" id="tab-{{$index}}-{{$key}}">
                            <ul class="sub-category-list">
                                @foreach ($child as $elm)
                                    <li>
                                        <a class="{{$category->categoryGuid == $elm->categoryGuid ? 'active' : ''}}" href="/product/category/{{$elm->categoryGuid}}">{{json_decode($elm->categoryTitle, true)[App::getLocale()]}}</a>
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
            $pageCount = 9;
            $products = Product::show()->where('productCategory', $guid)->paginate($pageCount);
        @endphp
        @foreach ($products as $item)
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
        <div class="col-md-12 pagination-section">
            @php
                $page = json_decode(json_encode($products));
                $breakPoint = 1;

                function pageNumVisible($item, $current_page, $breakPoint) {	
                    if ($item > $current_page + ($breakPoint - 1)) {
                        return false;
                    }
                    if ($item + ($breakPoint + 1) < $current_page) {
                        return false;
                    }
                    return true;
                }
            @endphp
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    @if ($page->prev_page_url)
                        <li class="page-item">
                            <a class="page-link" href="{{$page->first_page_url}}" tabindex="-1">&#xAB;</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="{{$page->prev_page_url}}" tabindex="-1">&#8249;</a>
                        </li>
                    @endif
                    @if ($breakPoint + 1 < $page->current_page)
                        <li class="page-item">
                            <a class="page-link" href="{{$page->path.'?page='.($page->current_page - $breakPoint - 1)}}">...</a>
                        </li>
                    @endif
                    @for ($i = 0; $i < $page->last_page; $i++)                        
                        @if (pageNumVisible($i, $page->current_page, $breakPoint))
                            <li class="page-item {{$i + 1 == $page->current_page ? 'active' : ''}}">
                                <a class="page-link" href="{{$page->path.'?page='.($i + 1)}}">{{$i + 1}}</a>
                            </li>
                        @endif                        
                    @endfor
                    @if ($page->last_page > $page->current_page + $breakPoint)
                        <li class="page-item">
                            <a class="page-link" href="{{$page->path.'?page='.($page->current_page + $breakPoint + 1)}}">...</a>
                        </li>
                    @endif
                    @if ($page->next_page_url)
                        <li class="page-item">
                            <a class="page-link" href="{{$page->next_page_url}}">&#8250;</a>
                        </li>    
                        <li class="page-item">
                            <a class="page-link" href="{{$page->last_page_url}}" tabindex="-1">&#xBB;</a>
                        </li>
                    @endif
                    
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
