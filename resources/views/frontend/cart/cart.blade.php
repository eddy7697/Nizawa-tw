@extends('main')

@section('custom-script')
    <script src="/js/cart-page.js" charset="utf-8"></script>
@endsection

@section('content')
<div class="sub-page-banner cart" style="background-image: url('/img/sub-banner.jpg');">
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
                    <li class="active">
                        <img src="/img/icon/cart-01.svg" alt="">
                        &nbsp;&nbsp;
                        <i class="fa fa-caret-down arrow-icon" aria-hidden="true"></i>
                        &nbsp;&nbsp;
                        {{ trans('cart.inquery_car') }}
                    </li>
                    <li>
                        <img src="/img/icon/cart-02.svg" alt="">
                        &nbsp;&nbsp;
                        <i class="fa fa-caret-down arrow-icon" aria-hidden="true"></i>
                        &nbsp;&nbsp;
                        {{ trans('cart.contact_info') }}
                    </li>
                    <li>
                        <img src="/img/icon/cart-03.svg" alt="">
                        &nbsp;&nbsp;
                        <i class="fa fa-caret-down arrow-icon" aria-hidden="true"></i>
                        &nbsp;&nbsp;
                        {{ trans('cart.complete_inquiry') }}
                    </li>
                </ul>
            </div>
            <div class="col-md-12" id="cart-page">
                @if (count($cart))
                    <cart-page></cart-page>
                @else
                    <h3 class="center" style="padding: 250px 0;">{{ trans('cart.cart_is_empty') }}</h3>
                @endif
            </div>
        </div>

    </div>



@endsection
