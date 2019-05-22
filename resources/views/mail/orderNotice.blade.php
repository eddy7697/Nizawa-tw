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
            <h2>{{ trans('service.deer_1') }} {{$shippingTarget['ReceiverName']}}：</h2>            
            <p>{{ trans('service.cart_sn') }} ：{{$merchantIdCache['MerchantTradeNo']}}
            <br>{{ trans('service.cart_date') }} ：{{date("Y-m-d H:i", time())}}
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><a href="{{env('APP_URL')}}">{{ trans('service.company_name') }}</a>{{ trans('service.thank') }}
            <br>{{ trans('service.contact_phone') }} ：+886-3-4935921 / +886-3-4935900 ({{ trans('service.range') }} 09:00~18:00)</p>
        </td>
    </tr>
    {{-- <tr>
      <td style="padding: 10px;">
        <h3>訂單編號：{{$merchantIdCache['MerchantTradeNo']}}</h3>
      </td>
    </tr> --}}

</table>
