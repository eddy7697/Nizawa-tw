@extends('main')

@section('custom-style')
<style>
    ul.payment-notice {
        padding: 0;
    }
    ul.payment-notice li {
        list-style-type: disc;
        margin-left: 30px;
        line-height: 30px;
    }
</style>
@endsection

@section('custom-script')
@endsection

@section('content')
    <div class="container mg-business">
        <div class="row">
            <div class="col-md-12 checkout-thumbnail">
                <ul>
                    <li>購物車</li>
                    <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                    <li>結帳資訊</li>
                    <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                    <li class="active">購買完成</li>
                </ul>
            </div>
            <div class="col-md-6 col-md-offset-3" style="text-align: left">
                @if (Auth::guest())
                    <p>先生/小姐，您好：</p>
                @else
                    <p><strong>{{Auth::user()->name}}</strong> 先生/小姐，您好：</p>
                @endif
                

                <p>感謝您購買易耕事業相關產品，由於您選擇為 ATM / 銀行匯款，</p>

                <p>請您依據下列資訊完成付款後與我們聯繫：</p>

                <hr>

                <h3><strong>ATM / 銀行匯款 - 付款方式</strong></h3>

                <p>玉山銀行 羅東分行 (808)</p>

                <p>帳 號 : 0451-940-007618</p>

                <p>戶 名 :易耕事業有限公司</p>

                <p>當您完成匯款後，請於您所填寫的電子郵件信箱中找尋易耕的訂單信件，</p>

                <p>並直接回覆 EMail 或 來電 03-9590903 告知匯款帳號後5碼，</p>

                <p>若您於下單當日下午2點前完成付款，我們將於當日會完成出貨，</p>

                <p>感謝您的訂購。</p>

                <br>

                <ul class="payment-notice">備註：
                    <li>若您訂購的是手工製品，請先來電確認是否有商品，</li>
                    <li>若您購買商品滿3000元以上為免運費，一般購買運費則為80元。</li>
                    <li>若您指定運送地區為台灣本島外之其他地區，請先來電確認郵資。</li>
                </ul>

            </div>
        </div>
    </div>
@endsection
