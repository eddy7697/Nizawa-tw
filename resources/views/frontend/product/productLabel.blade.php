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
        <h5>您可於此頁面查詢日澤相關產品，並透過介面完成詢價單填寫</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">{{ trans('string.home') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            {{ trans('string.label_center') }}
        </div>
    </div>
</div>
<div class="container product-list">
    <div class="row label-list">
        @foreach ($labels as $item)
            <div class="col-md-4 label-item">
                <div class="label-featureImage"></div>
                <div class="label-info">
                    <h4>{{json_decode($item->categoryTitle, true)[App::getLocale()]}}</h4>
                    <p>
                        {!!nl2br(json_decode($item->categoryDescription, true)[App::getLocale()])!!}
                    </p>
                </div>
            </div>    
        @endforeach
        
    </div>
    
</div>
@endsection
