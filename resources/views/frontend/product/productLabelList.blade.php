@extends('main')

@php
    use App\Product;
    use App\Category;

    $category = Category::where('categoryGuid', $guid)->first();
    $categoryTitle = json_decode($category->categoryTitle, true)[App::getLocale()]
@endphp

@section('custom-style')
@endsection

@section('custom-script')
@endsection

@section('content')
<div class="sub-page-banner" style="background-image: url('https://nizawa.shuo-guo.net/img/sub-banner.jpg');">
    <div>
        <h2>{{ trans('string.label_center') }}</h2>
        @if (App::getLocale() !== 'en')
            <h4>Label center</h4>
        @endif
        <hr>
        <h5>{{ trans('string.label_banner_desc') }}</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">{{ trans('string.home') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a href="/product">{{ trans('string.product_center') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a href="/label">{{ trans('string.label_center') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            {{$categoryTitle}}
        </div>
    </div>
</div>
<div class="container product-list sub">
        <div class="row">
        @php
            $pageCount = 9;
            $products = Product::show()->where('authorName', $guid)->paginate($pageCount);
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
