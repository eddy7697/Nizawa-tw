<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Ixudra\Curl\Facades\Curl;
use App\Http\Controllers\Controller;
use App\Order;
use App\Shipping;
use App\Bonus;
Use App\User;
use Hash;
use Mail;
use PublicServiceProvider;

class OrderController extends Controller
{
    /**
     * 接收金流回傳的資訊
     */
    public function ecpayReturn(Request $request)
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $originIP = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $originIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $originIP= $_SERVER['REMOTE_ADDR'];
        }

        Log::info('Connection from : '.$originIP);

        if ($originIP == '175.99.72.1' ||
            $originIP == '175.99.72.11' ||
            $originIP == '175.99.72.24' ||
            $originIP == '175.99.72.28' ||
            $originIP == '175.99.72.32') {

            $data = $request->all();

            try {
                $bonusPercentage = (int)Bonus::all()->first()['percentage'] / 100;
            } catch (\Exception $e) {
                $bonusPercentage = 0;
            }

            $order = Order::where('merchantID', $data['CustomField1'])->first();
            $orderFlag = $order->orderFlag;
            $orderOwner = $order->owner;

            if (Hash::check($data['CustomField1'], $orderFlag))
            {
                if ($data['RtnCode'] == '1') {
                    Log::info("callback validation success");

                    $targetOrder = Order::where('merchantID', $data['CustomField1'])->first();

                    if ($order->paymentStatus === 'paid') {
                        Log::info('Payment multi callback!!');
                        return "1|OK";
                    }

                    if ($data['SimulatePaid'] == '1') {
                        DB::table('orders')
                            ->where('merchantID', $data['CustomField1'])
                            ->update([
                                'isSimulate' => '1',
                                'paymentStatus' => 'paid'
                            ]);
                    } else {
                        DB::table('orders')
                            ->where('merchantID', $data['CustomField1'])
                            ->update([
                                'paymentStatus' => 'paid'
                            ]);
                    }

                    try {
                        if ($orderOwner !== 'guest') {
                            $originPoint = User::where('guid', $orderOwner)->first()->point;
                            User::where('guid', $orderOwner)->update([
                                'point' => (int)$originPoint + $order->amount * $bonusPercentage,
                            ]);
                        }
                    } catch (\Exception $e) {
                        Log::error($e);
                    }

                    Log::info(json_encode($data));

                    Mail::send('mail.paymentSuccess', [
                        'MerchantTradeNo' => $data['CustomField1'],
                    ], function($message) {
                        $message->to([
                            'vincent7697@gmail.com',
                            env('MAIL_USERNAME')
                        ])->subject('付款成功');
                        $message->from(env('MAIL_USERNAME'), $name = env('APP_NAME'));
                    });

                    return "1|OK";
                } else {
                    return "0|FAIL";
                }
            } else {
                Log::info("callback validation fail");
                return 0;
            }

            Log::info($orderFlag);
            Log::info(json_encode($data));

        } else {
            Log::error('The request origin are not from ecpay, please check.');
        }
    }

    /**
     * 物流狀態更新
     */
    public function logisticsReturn(Request $request)
    {
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $originIP = $_SERVER['HTTP_CLIENT_IP'];
        }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $originIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $originIP= $_SERVER['REMOTE_ADDR'];
        }

        Log::info('Connection from : '.$originIP);

        if ($originIP == '175.99.72.1' ||
            $originIP == '175.99.72.11' ||
            $originIP == '175.99.72.24' ||
            $originIP == '175.99.72.28' ||
            $originIP == '175.99.72.32') {

            $data = $request->all();

            Log::info(json_encode($data));

            try {
                $bonusPercentage = (int)Bonus::all()->first()['percentage'] / 100;
            } catch (\Exception $e) {
                $bonusPercentage = 0;
            }

            $order = Order::where('merchantID', $data['MerchantTradeNo'])->first();
            $orderFlag = $order->orderFlag;
            $orderOwner = $order->owner;

            if (Hash::check($data['MerchantTradeNo'], $orderFlag))
            {
                if (($data['RtnCode'] == '2067') || $data['RtnCode'] == '3022') {
                    Log::info("callback validation success");

                    if ($order->paymentStatus === 'paid') {
                        Log::info('Logistic multi callback!!');
                        return "1|OK";
                    }

                    DB::table('orders')
                        ->where('merchantID', $data['MerchantTradeNo'])
                        ->update([
                            'paymentStatus' => 'paid'
                        ]);

                    try {
                        if ($orderOwner !== 'guest') {
                            $originPoint = User::where('guid', $orderOwner)->first()->point;
                            User::where('guid', $orderOwner)->update([
                                'point' => (int)$originPoint + $order->amount * $bonusPercentage,
                            ]);
                        }
                    } catch (\Exception $e) {
                        Log::error($e);
                    }

                    Log::info(json_encode($data));

                    Mail::send('mail.paymentSuccess', [
                        'MerchantTradeNo' => $data['MerchantTradeNo'],
                    ], function($message) {
                        $message->to([
                            'vincent7697@gmail.com',
                            env('MAIL_USERNAME')
                        ])->subject('取貨成功');
                        $message->from(env('MAIL_USERNAME'), $name = env('APP_NAME'));
                    });

                    return "1|OK";
                } else {
                    return "0|FAIL";
                }
            } else {
                Log::info("callback validation fail");
                return 0;
            }

            Log::info($orderFlag);
            Log::info(json_encode($data));

        } else {
            Log::error('The request origin are not from ecpay, please check.');
        }
    }
    /**
     * ATM 資訊更新
     */

    public function paymentInfo(Request $request)
    {
        $data = $request->all();

        try {
            $order = Order::where('merchantID', $data['CustomField1'])->first();

            DB::table('orders')
                ->where('merchantID', $data['CustomField1'])
                ->update([
                    'ExpireDate' => $data['ExpireDate'],
                    'BankCode' => $data['BankCode'],
                    'PaymentType' => $data['PaymentType'],
                    'vAccount' => $data['vAccount'],
                ]);

            Log::info('Update order sucess');

            return view('frontend.checkoutMethod.atmReport', [
                'atmData' => json_encode($request->all())
            ]);
        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    /**
     * 取得所有訂單
     */
    public function getOrders($status)
    {
        if ($status == 'all') {
            return Order::orderBy('created_at', 'DESC')
                        ->leftJoin('users', 'orders.owner', '=', 'users.guid')
                        ->select('orders.*', 'users.email')
                        ->paginate(15);
        } else {
            return Order::where('paymentStatus', $status)
                        ->leftJoin('users', 'orders.owner', '=', 'users.guid')
                        ->select('orders.*', 'users.email')
                        ->orderBy('created_at', 'DESC')
                        ->paginate(15);
        }
    }

    /**
     * 搜尋訂單
     */
    public function searchOrders($merchantID)
    {
        return Order::where('merchantID', 'like', '%'.$merchantID.'%')->paginate(15);
    }

    /**
     * 訂單完成頁面
     */
    public function orderSuccess()
    {
        return view('frontend.checkoutMethod.checkoutSuccess', [
            'isThumbShow' => false,
            'thumb' => ''
        ]);
    }

    /**
     * 更改訂單備註
     */
    public function updateOrderRemark(Request $request)
    {
        $data = $request->all();
        
        try {
            $order = Order::where('guid', $data['guid'])->update([
                'remarks' => $data['remarks'],
            ]);
            $status = 200;
            $message = 'Modify order remarks success.';
        } catch (\Exception $e) {
            $order = $e->getMessage();
            $status = 500;
            $message = 'Internal server error.';
        }


        return response()->json([ 'status' => $status, 'message' => $message, 'data' => $order ], $status);
    }

    /**
     * 更改訂單狀態
     */
    public function updateOrderStatus(Request $request)
    {
        $data = $request->all();

        $pointUsage = Order::where('guid', $data['guid'])->first()['pointUsage'];
        $ownerPoint = User::where('guid', $data['owner'])->first()['point'];

        return DB::transaction(function () use ($data, $pointUsage, $ownerPoint){

            if ($data['orderStatus'] === 'canceled') {
                try {
                    $pointRollback = User::where('guid', $data['owner'])->update([
                        'point' => (int)$ownerPoint + (int)$pointUsage
                    ]);
                } catch (\Exception $e) {
                    $status = 201;
                    $message = $e->getMessage();
                    DB::rollback();
                    $data = 'point rollback success';
                }
            }

            try {
                $order = Order::where('guid', $data['guid'])->update([
                    'orderStatus' => $data['orderStatus'],
                    'paymentStatus' => $data['paymentStatus'],
                ]);
                $status = 200;
                $message = 'Modify order status success.';
            } catch (\Exception $e) {
                $order = null;
                $status = 500;
                $message = 'Internal server error.';
            }


            return response()->json([ 'status' => $status, 'message' => $message, 'data' => $order ], $status);
        });

    }

    /**
     * add shipping method
     */
    public function addShippingMethod(Request $request)
    {
        $data = $request->all();

        try {
            $shipping = Shipping::create($data);
            $status = 200;
            $message = 'Add shipping methods success.';
        } catch (\Exception $e) {
            $shipping = null;
            $status = 500;
            $message = 'Internal server error.';
        }

        return response()->json([ 'status' => $status, 'message' => $message, 'data' => $shipping ], $status);

    }

    /**
     * Edit shipping method
     */
    public function editShippingMethod(Request $request)
    {
        $data = $request->all();

        try {
            $shipping = Shipping::where('id', $data['id'])->update($data);
            $status = 200;
            $message = 'Edit shipping methods success.';
        } catch (\Exception $e) {
            $shipping = null;
            $status = 500;
            $message = 'Internal server error.';
        }

        return response()->json([ 'status' => $status, 'message' => $message, 'data' => $shipping ], $status);

    }

    /**
     * Delete shipping method
     */
    public function deleteShippingMethod($id)
    {

        try {
            $shipping = Shipping::where('id', $id)->delete();
            $status = 200;
            $message = 'Edit shipping methods success.';
        } catch (\Exception $e) {
            $shipping = null;
            $status = 500;
            $message = 'Internal server error.';
        }

        return response()->json([ 'status' => $status, 'message' => $message, 'data' => $shipping ], $status);

    }

    /** 
     * 
     */
    public function hppeOrder(Request $request)
    {
        $data = $request->all();

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $originIP = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $originIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $originIP= $_SERVER['REMOTE_ADDR'];
        }

        Log::info('Connection from : '.$originIP);

        $order = Order::where('merchantID', $data['orderNumber'])->first();

        if ($data['ResponseCode'] == '00' ||
            $data['ResponseCode'] == '08' ||
            $data['ResponseCode'] == '11') {
            
            if ($order->paymentStatus === 'paid') {
                Log::info('Payment multi callback!!');
                return;
            }

            try {
                DB::table('orders')
                  ->where('merchantID', $data['orderNumber'])
                  ->update([
                        'paymentStatus' => 'paid'
                    ]);

                return PublicServiceProvider::exception('付款成功，感謝您的選購。');
            } catch (\Exception $e) {
                return PublicServiceProvider::exception('付款失敗。');
            }
            
        } else {
            Log::info($data);
            return PublicServiceProvider::exception('付款失敗，拒絕交易。');
        }
    }

    /**
     * Get all shipping methods
     */
    public function getShippingMethods()
    {

        try {
            $shipping = Shipping::all();
            $status = 200;
            $message = "Get shipping methods success.";
        } catch (\Exception $e) {
            $shipping = null;
            $status = 500;
            $message = "Internal server error.";
        }

        return response()->json([ 'status' => $status, 'message' => $message, 'data' => $shipping ], $status);
    }

    /**
     * 玉山金流確認訂單
     */
    public function esunCheckOrder(Request $request)
    {
        // Parse order message
        $returnStr = $request->DATA;
        $firstParse = str_replace(",", '","', $returnStr);
        $secondParse = str_replace("=", '":"', $firstParse);
        $thirdParse = '{"'.$secondParse.'"}';
        $finalParse = json_decode($thirdParse);

        // return $finalParse->ONO[0];
        // return $finalParse->RC;
        if ($finalParse->RC == '00') {
            try {
                $targetOrder = Order::where('merchantID', explode('.' ,$finalParse->ONO)[0]);

                if ($targetOrder->first()['paymentStatus'] == 'paid') {
                    return redirect('/');
                } else {
                    $targetOrder->update([
                                    'paymentStatus' => 'paid'
                                ]);
                }

                return PublicServiceProvider::exception('付款成功，感謝您的購買。');     
            } catch (\Exception $e) {
                return PublicServiceProvider::exception('系統無此訂單，查詢失敗。');
            }
        } else {
            return PublicServiceProvider::exception('付款失敗，拒絕交易。<br/>錯誤代碼：'.$finalParse->RC);
        }
        

        return explode('.' ,$finalParse->ONO)[0];

        // build the request data & sent request
        $orderObj = '{"MID":"'.$finalParse->MID.'","ONO":"'.$finalParse->ONO.'"}';
        $mac = hash('sha256', $orderObj.'B88BM8GZW8HZ5PW21OJVFICNDXMSI3QR');
        $requestData = array(
            'data' => $orderObj,
            'mac' => $mac,
            'ksn' => '1'
        );

        $orderQuery = Curl::to('https://acqtest.esunbank.com.tw/ACQQuery/esuncard/txnf0180')
                            ->withData( $requestData )
                            ->withResponseHeaders()
                            ->returnResponseObject()
                            ->post(); 

        $orderResult = json_decode(str_replace("DATA=", "", $orderQuery->content));
        $orderStatus = $orderResult->txnData->RC;

        if ($orderStatus == '00') {
            try {
                $targetOrder = Order::where('merchantID', $finalParse->ONO);

                if ($targetOrder->first()['paymentStatus'] == 'paid') {
                    return redirect('/');
                } else {
                    $targetOrder->update([
                                    'paymentStatus' => 'paid'
                                ]);
                }

                return PublicServiceProvider::exception('付款成功，感謝您的購買。');     
            } catch (\Exception $e) {
                return PublicServiceProvider::exception('系統無此訂單，查詢失敗。');
            }
        } else {
            return PublicServiceProvider::exception('付款失敗，拒絕交易。<br/>錯誤代碼：'.$orderStatus);
        }
        
    }

    /**
     * 取得目前最新的訂單
     */
    public function getNewOrder()
    {
        return Order::orderBy('id', 'desc')
                    ->take(10)->get();
    }
    
}
