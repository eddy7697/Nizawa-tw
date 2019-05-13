@extends('main')

@php
    use App\Category;
    use App\Product;
    use Illuminate\Support\Facades\Log;
    
    $labels = Category::where('type', 'label')->get();
@endphp

@section('custom-style')
@endsection

@section('custom-script')
@endsection

@section('content')
<div class="sub-page-banner" style="background-image: url('/img/sub-banner.jpg');">
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
            {{ trans('string.label_center') }}
        </div>
    </div>
</div>
<div class="container product-list sub">
    <div class="row label-list">
        @foreach ($labels as $item)
            <div class="col-md-2 label-item">
                <div class="label-box">
                    <img class="label-featureImage" src="{{$item->featureImage}}" alt="{{json_decode($item->categoryTitle, true)[App::getLocale()]}}">
                    <div class="label-info">
                        <div class="label-text">
                            <h4>{{json_decode($item->categoryTitle, true)[App::getLocale()]}}</h4>
                            <div class="click-me">
                                點我查看相關產品
                            </div>    
                        </div>
                    </div>
                </div>
                <a href="/label/{{$item->categoryGuid}}" class="link-mask"></a>
            </div>    
        @endforeach
    </div>
</div>
@endsection
