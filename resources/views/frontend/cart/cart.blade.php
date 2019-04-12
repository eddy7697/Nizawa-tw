@extends('main')

@section('custom-script')
    <script src="/js/cart-page.js" charset="utf-8"></script>
@endsection

@section('content')

    <div class="container mg-business">
        <div class="row">
            <div class="col-md-12 checkout-thumbnail">
                <ul>
                    <li class="active">詢價車</li>
                    <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                    <li>結帳資訊</li>
                    <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                    <li>購買完成</li>
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
