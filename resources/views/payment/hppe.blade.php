<head>
        <meta http-equiv="Content-Type" content="text/html; charset=big5">
        <title>易耕網路事業 - 信用卡付款頁面</title>
    </head>
    <body onload="document.HPP.submit();">
        <form name="HPP" method="post" target="HPPFrame" ACTION="{{Config::get('hppe.ServiceURL')}}" style="text-align: center">
            <iframe name="HPPFrame" id="mainFrame" height="600" width="800" Frameborder="0"></iframe>
            <input type="hidden" name="MerchantID" value="{{Config::get('hppe.MerchantID')}}">
            <input type="hidden" name="TerminalID" value="{{Config::get('hppe.TerminalID')}}">
            <input type="hidden" name="OrderID" value="{{$order}}">
            <input type="hidden" name="TransAmt" value="{{$TransAmt}}">
            <input type="hidden" name="TransMode" value="0">
            <input type="hidden" name="PrivateData" value="orderNumber={{$orderNumber}}">
            <input type="hidden" name="Install" value="">
            <input type="hidden" name="NotifyURL" value="https://www.yigeng.com.tw/hppe-callback">
            <input type="hidden" name="CSS_URL" value="">
            <input type="hidden" name="BankNo" value="">
            <input type="hidden" name="TEMPLATE" value="BOTH">
            <input type="hidden" name="TravelLocCode" value="">
            <input type="hidden" name="TravelStartDate" value="">
            <input type="hidden" name="TravelEndDate" value="">
            <input type="hidden" name="Signature" value="{{hash('sha256', 'MerchantID='.Config::get('hppe.MerchantID').
                                                                          '&TerminalID='.Config::get('hppe.TerminalID').
                                                                          '&OrderID='.$order.
                                                                          '&TransAmt='.$TransAmt.
                                                                          '&TransMode=0'.
                                                                          '&Install='.
                                                                          '&NotifyURL=https://www.yigeng.com.tw/hppe-callback'.
                                                                          '&CSS_URL='.
                                                                          '&BankNo='.
                                                                          '&TEMPLATE=BOTH'.
                                                                          '&TravelLocCode='.
                                                                          '&TravelStartDate='.
                                                                          '&TravelEndDate='.
                                                                          '&'.hash('sha256', 'ffc5eea6ff6c873a976730b36e225c5a916861a4658c8288f26d1abf3e360494'))}}">
    
        </form>
    </body>
    
    </html>