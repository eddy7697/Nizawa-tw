@extends('main')

@section('custom-script')
<script src="/js/checkout.js" charset="utf-8"></script>
@endsection

@section('content')
    <div class="sub-page-banner cart" style="background-image: url('https://nizawa.shuo-guo.net/img/sub-banner.jpg');">
        <div>
            <h2>{{ trans('cart.inquery_car') }}</h2>
            @if (App::getLocale() !== 'en')
                <h4>Inquery car</h4>    
            @endif
            
        </div>
    </div>
    <div class="container mg-business">
        <div class="row">
            <div class="col-md-12 checkout-thumbnail">
                <ul>
                    <li>
                        <img src="https://nizawa.shuo-guo.net/img/icon/cart-01.svg" alt="">
                        &nbsp;&nbsp;
                        <i class="fa fa-caret-down arrow-icon" aria-hidden="true"></i>
                        &nbsp;&nbsp;
                        {{ trans('cart.inquery_car') }}
                    </li>
                    <li class="active">
                        <img src="https://nizawa.shuo-guo.net/img/icon/cart-02.svg" alt="">
                        &nbsp;&nbsp;
                        <i class="fa fa-caret-down arrow-icon" aria-hidden="true"></i>
                        &nbsp;&nbsp;
                        {{ trans('cart.contact_info') }}
                    </li>
                    <li>
                        <img src="https://nizawa.shuo-guo.net/img/icon/cart-03.svg" alt="">
                        &nbsp;&nbsp;
                        <i class="fa fa-caret-down arrow-icon" aria-hidden="true"></i>
                        &nbsp;&nbsp;
                        {{ trans('cart.complete_inquiry') }}
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 mx-auto" id="checkout">
                <input type="hidden" id="shipping_method" value="{{$shippingMethod}}">
                <checkout></checkout>
            </div>
            <div id="anti-fraud-notice-info">
                {!!SiteMetaView::noticeAntiFraud()!!}
            </div>
        </div>
    </div>
@endsection
