<table border="0" width="550">
    <tr>
        <td style="text-align: center" colspan="4">
            <img src="https://www.yigeng.com.tw/img/logo_grey.png" width="200">
        </td>
    </tr>
    <tr>
        <td colspan="4" style="padding: 10px; border: #ccc 10px solid">
            {{-- <h2>感謝您的訂購</h2>
            <hr /> --}}
            <h2>親愛的顧客 {{$shippingTarget['ReceiverName']}} 先生/小姐 您好：</h2>            
            <p>您的訂單編號：{{$merchantIdCache['MerchantTradeNo']}}
            <br>訂購日期：{{date("Y-m-d h:m", time())}}
            <br>訂單總金額： {{number_format((int)$data['TotalAmount'] - (int)$data['pointUsage'] + (int)$data['shippingCosts'])}}</p>
            <p>&nbsp;</p>
            <p>感謝您的訂購，您可以隨時登入 <a href="{{env('APP_URL')}}/user">會員專區</a> 查看訂單狀態，當您完成付款後，請直接回復MAIL並填上您匯款帳號的末5碼，我們會儘快完成出貨，非常感謝您的惠顧。 
            <br><span style="color: red">溫馨提醒：在我們收到訂單後七日內還未完成付款，系統會自動取消該訂單</span></p>
            <p>&nbsp;</p>
            <p><a href="{{env('APP_URL')}}">易耕事業線上商城</a>感謝您的惠顧！
            <br>客服聯絡電話：03-9590903 (週一~週五 09:00~17:00)</p>
        </td>
    </tr>
    {{-- <tr>
      <td style="padding: 10px;">
        <h3>訂單編號：{{$merchantIdCache['MerchantTradeNo']}}</h3>
      </td>
    </tr> --}}

</table>

{{-- <table border="0" width="550">
    <tr>
        <td style="text-align: center" colspan="4">
            <img src="{{env('APP_URL')}}/img/logo_grey.png" width="200">
        </td>
    </tr>
    <tr>
        <td colspan="4" style="padding: 10px; border: #ccc 10px solid">
            <h2>感謝您的訂購</h2>
            <hr />
            <p>親愛的顧客您好。</p>
            <p>您的訂單我們已經著手處理，感謝您訂購本公司的商品服務。<br />
                以下是您的訂購商品清單資料，<br />
                請於7日內匯款，超過時間麻煩請重新訂購，<br />
                收到您的款項以後我們會盡速處理您的商品寄送事宜。
            </p>
            <h2>親愛的顧客 {{$shippingTarget['ReceiverName']}} 先生/小姐 您好：</h2>            
            <p>您的訂單編號：{{$merchantIdCache['MerchantTradeNo']}}</p>
            <p>訂購日期：{{date("Y-m-d h:m", time())}}</p>
            <p>訂單總金額： {{$data['pointCount']}}</p>
            <p>&nbsp;</p>
            <p>感謝您的訂購，您可以隨時登入會員專區 <a href="{{env('APP_URL')}}">{{env('APP_URL')}}</a> 查看訂單狀態，當您完成付款後，請直接回復MAIL並填上您匯款帳號的末5碼，我們會儘快完成出貨，非常感謝您的惠顧。 溫馨提醒：在我們收到訂單後七日內還未完成付款，系統會自動取消該訂單</p>
            <p>&nbsp;</p>
            <p>易耕事業線上商城 (←請加入網站連結) 感謝您的惠顧！</p>
            <p>客服聯絡電話：03-9590903 (週一~週五 09:00~17:00)</p>
        </td>
    </tr>
    <tr>
      <td colspan="4" style="padding: 10px;">
        <h3>訂單編號：{{$merchantIdCache['MerchantTradeNo']}}</h3>
      </td>
    </tr>
    <tr>
      <td style="padding: 10px; background: #ccc">
        商品名稱
      </td>
      <td style="padding: 10px; background: #ccc">
        數量
      </td>
      <td style="padding: 10px; background: #ccc">
        單價
      </td>
      <td style="padding: 10px; background: #ccc">
        小計
      </td>
    </tr>
    @foreach ($cartInfo as $item)
        <tr>
          <td style="padding: 10px;">
            {{$item->Name}}
          </td>
          <td style="padding: 10px;">
            {{$item->qty}}
          </td>
          <td style="padding: 10px;">
            {{number_format($item->price)}}
          </td>
          <td style="padding: 10px;">
            {{number_format($item->total)}}
          </td>
        </tr>
    @endforeach


     <tr>
      <td colspan="1" style="padding: 10px; border-top: #ccc thin solid">
        購物金折抵：
      </td>
      <td colspan="3" style="padding: 10px; border-top: #ccc thin solid">
        NT$ {{number_format($data['pointUsage'])}}
      </td>
    </tr> 
    <tr>
      <td colspan="1" style="padding: 10px; border-top: #ccc thin solid">
        運費計算
        @php
            switch ($data['shippingMethod']) {
                case 'delivery':
                    echo ' (國內宅配)';
                    break;
                case 'cvs':
                    echo ' (超商取貨)';
                    break;
            }
        @endphp
        ：
      </td>
      <td colspan="3" style="padding: 10px; border-top: #ccc thin solid">
        NT$ {{number_format($data['shippingCosts'])}}
      </td>
    </tr>
    <tr>
        <td colspan="1" style="padding: 10px; border-top: #ccc thin solid">付款方式：</td>
        <td colspan="3" style="padding: 10px; border-top: #ccc thin solid">
            @php
                switch ($data['ChoosePayment']) {
                    case 'Credit':
                        echo '信用卡付款';
                        break;
                    case 'ATM':
                        echo 'ATM轉帳付款';
                        break;
                    case 'cod':
                        echo '超商取貨付款';
                        break;
                }
            @endphp
        </td>
    </tr>
    <tr>
        <td colspan="1" style="padding: 10px; border-top: #ccc 5px solid">
            總計：
        </td>
        <td colspan="3" style="padding: 10px; border-top: #ccc 5px solid">
            NT$ {{number_format((int)$data['TotalAmount'] - (int)$data['pointUsage'] + (int)$data['shippingCosts'])}}
        </td>
    </tr>
    @if ($data['pointCount'])
        <tr>
            <td colspan="1" style="padding: 10px; border-top: #ccc 5px solid">
                可累積購物金：
            </td>
            <td colspan="3" style="padding: 10px; border-top: #ccc 5px solid">
                {{$data['pointCount']}}元
            </td>
        </tr>
    @endif

</table> --}}
