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
            <div class="col-md-12 check-success" style="text-align: center">
                <h2>您以完成詢價單送出手續</h2>

                <div class="text">
                    <p>我們已經正在處理您的詢價單並將於三個工作日內回覆給您，若您有任何進一步需求</p>
                    <p>歡迎您直接 <a href="">聯絡我們</a>，我們將隨時以提供您更多支持。</p>
                </div>
                <img src="/img/site-logo/findmore.png" class="find-more" alt="">
                <br>
                <a class="find-more-btn" href="/product">查看其他產品</a>
            </div>
        </div>
    </div>
@endsection
