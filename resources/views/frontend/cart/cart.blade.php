@extends('main')

@section('custom-script')
    <script src="/js/cart-page.js" charset="utf-8"></script>
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
                    <li class="active">
                        <img src="/img/icon/cart-01.svg" alt="">
                        &nbsp;&nbsp;
                        <i class="fa fa-caret-down arrow-icon" aria-hidden="true"></i>
                        &nbsp;&nbsp;
                        詢價車
                    </li>
                    <li>
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
            <div class="col-md-12" id="cart-page">
                @if (count($cart))
                    <cart-page></cart-page>
                @else
                    <h3 class="center" style="padding: 250px 0;">詢價車裡面沒有產品，趕快去逛逛吧~</h3>
                @endif
            </div>
        </div>

    </div>



@endsection
