@extends('main')

@php
    use App\Category;
    use App\Product;
    use Illuminate\Support\Facades\Log;

    $root = Category::where('type', 'product')->whereNull('parentId')->get();
    $rootFirst = Category::where('type', 'product')->whereNull('parentId')->first();

    if ($mode == 'main') {
        $rootFirst = Category::where('type', 'product')->where('categoryGuid', $guid)->first();
    }

    if ($mode == 'sub') {
        $category = Category::where('type', 'product')->where('categoryGuid', $guid)->first();
        $rootFirst = Category::where('type', 'product')->where('categoryGuid',$category->parentId)->first();
    }
    
@endphp

@section('custom-style')
@endsection

@section('custom-script')
@endsection

@section('content')
<div class="sub-page-banner" style="background-image: url('/img/sub-banner.jpg');">
    <div>
        <h2>產品中心</h2>
        <h4>Product center</h4>
        <hr>
        <h5>您可於此頁面查詢日澤相關產品，並透過介面完成詢價單填寫</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">首頁</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            產品中心
        </div>
    </div>
</div>
<div class="container product-list">
    <div class="row main-category">
        <div class="col-md-10 mx-auto">
            <ul class="row nav nav-tabs">
                @foreach ($root as $key => $item)
                    <li class="col-md-2 mx-auto category-btn-section nav-item">
                        <a class="nav-link category-btn {{$rootFirst->categoryGuid == $item->categoryGuid ? 'active' : ''}}" href="/product/main/{{$item->categoryGuid}}">
                        {{-- <a class="nav-link category-btn {{$rootFirst->categoryGuid == $item->categoryGuid ? 'active' : ''}}" data-toggle="tab" href="#main-tab-{{$key}}"> --}}
                            @include('components.icon.type'.($key + 1), ['title' => json_decode($item->categoryTitle, true)[App::getLocale()]])
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
                                if ($mode == 'sub') {
                                    $active = $guid == $item->categoryGuid;
                                } else {
                                    $active = $key == 0;
                                }
                            @endphp
                            <a class="nav-link {{ $active ? 'active' : ''}}" href="/product/sub/{{$item->categoryGuid}}">
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

                            if ($mode == 'sub') {
                                $active = $guid == $item->categoryGuid;
                            } else {
                                $active = $key == 0;
                            }
                        @endphp
                        <div class="tab-pane container sub-category-panel {{ $active ? 'active' : 'fade'}}" id="tab-{{$index}}-{{$key}}">
                            <ul class="sub-category-list">
                                @foreach ($child as $elm)
                                    <li>
                                        <a href="/product/category/{{$elm->categoryGuid}}">{{json_decode($elm->categoryTitle, true)[App::getLocale()]}}</a>
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
            $products = Product::show()->paginate($pageCount);

            if ($mode == 'main') {
                $products = Product::show()->where('mainCategory', $guid)->paginate($pageCount);
            }
            if ($mode == 'sub') {
                $products = Product::show()->where('subCategory', $guid)->paginate($pageCount);
            }
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
                    <a class="product-link" style="cursor: pointer" onclick="addSigleProduct('{{$item->productGuid}}')">加入詢價車</a>
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
