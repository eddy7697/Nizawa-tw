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
