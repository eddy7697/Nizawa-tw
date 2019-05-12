<table border="0" width="550">
    <tr>
        <td style="text-align: center" colspan="4">
            <img src="{{env('APP_URL')}}/img/site-logo/logo_header.png" width="200">
        </td>
    </tr>
    <tr>
        <td colspan="4" style="padding: 10px; border: #ccc 10px solid">
            {{-- <h2>感謝您的訂購</h2>
            <hr /> --}}
            <h2>親愛的顧客 {{$shippingTarget['ReceiverName']}} 先生/小姐 您好：</h2>            
            <p>您的訂單編號：{{$merchantIdCache['MerchantTradeNo']}}
            <br>詢價日期：{{date("Y-m-d H:i", time())}}
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><a href="{{env('APP_URL')}}">日澤國際股份有限公司</a>感謝您的惠顧！
            <br>客服聯絡電話：+886-3-4935921 / +886-3-4935900 (週一~週五 09:00~18:00)</p>
        </td>
    </tr>
    {{-- <tr>
      <td style="padding: 10px;">
        <h3>訂單編號：{{$merchantIdCache['MerchantTradeNo']}}</h3>
      </td>
    </tr> --}}

</table>
