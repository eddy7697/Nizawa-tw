<head>
    <meta http-equiv="Content-Type" content="text/html; charset=big5">
    <title>易耕網路事業 - 信用卡付款頁面</title>
    <style>
        body {
            text-align: center;
        }
    </style>
</head>
{{-- <body> --}}
<body onload="document.ESUN.submit()">
    <h1>資料傳輸中．．．請稍候</h1>
    <form name="ESUN" method="post" ACTION="{{config('esun.ServiceURL')}}" style="text-align: center">
        <table border="1" align="center" style="display:none">
            <tr>
                <td>DATA</td>
                <td><input type="text" name="data" value='{"ONO":"{{$ONO}}","U":"{{url('esun_callback')}}","MID":"{{config('esun.MID')}}","TA":"{{$TA}}","TID":"{{config('esun.TID')}}"}'></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="text" name="mac" value="{{hash('sha256', '{"ONO":"'.$ONO.'","U":"'.url('esun_callback').'","MID":"'.config('esun.MID').'","TA":"'.$TA.'","TID":"'.config('esun.TID').'"}'.config('esun.mac'))}}">
                    <input type="text" name="ksn" value="1">
                    <input type="submit" value="送出">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>