@extends('main')

@section('custom-script')
@endsection

@section('content')
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
                    <li>
                        <img src="/img/icon/cart-02.svg" alt="">
                        &nbsp;&nbsp;
                        <i class="fa fa-caret-down arrow-icon" aria-hidden="true"></i>
                        &nbsp;&nbsp;
                        結帳資訊
                    </li>
                    <li class="active">
                        <img src="/img/icon/cart-03.svg" alt="">
                        &nbsp;&nbsp;
                        <i class="fa fa-caret-down arrow-icon" aria-hidden="true"></i>
                        &nbsp;&nbsp;
                        購買完成
                    </li>
                </ul>
            </div>
            <div class="col-md-12" style="text-align: center">
                <h3>感謝您的購買，現在您可以至會員專區查看您的訂單資料。</h3>
            </div>
        </div>
    </div>
@endsection
