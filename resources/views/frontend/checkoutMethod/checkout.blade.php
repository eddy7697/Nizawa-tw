@extends('main')

@section('custom-script')
<script src="/js/checkout.js" charset="utf-8"></script>
@endsection

@section('content')
    <div class="sub-page-banner cart" style="background-image: url('/img/sub-banner.jpg');">
        <div>
            <h2>詢價車</h2>
            <h4>Inquery car</h4>
        </div>
    </div>
    <div class="container mg-business">
        <div class="row">
            <div class="col-md-12 checkout-thumbnail">
                <ul>
                    <li>
                        <img src="/img/icon/cart-01.svg" alt="">
                        &nbsp;&nbsp;
                        <i class="fa fa-caret-down arrow-icon" aria-hidden="true"></i>
                        &nbsp;&nbsp;
                        詢價車
                    </li>
                    <li class="active">
                        <img src="/img/icon/cart-02.svg" alt="">
                        &nbsp;&nbsp;
                        <i class="fa fa-caret-down arrow-icon" aria-hidden="true"></i>
                        &nbsp;&nbsp;
                        結帳資訊
                    </li>
                    <li>
                        <img src="/img/icon/cart-03.svg" alt="">
                        &nbsp;&nbsp;
                        <i class="fa fa-caret-down arrow-icon" aria-hidden="true"></i>
                        &nbsp;&nbsp;
                        購買完成
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
