<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;
use App\Services\PublicServiceProvider;
use App\Bonus;
use App\Order;
use App\Product;
use App\SubProduct;
use App\User;
use App\Address;
use Illuminate\Support\Facades\DB;
use Cart;
use Hash;
use Auth;
use Mail;
use Ecpay;
use Hppe;
use Esun;

class CheckoutController extends Controller
{
    /**
     * 检查是否有会员地址存在
     */
    private function checkAddress($guid, $type)
    {
        return count(Address::where('owner', $guid)->where('type', $type)->get());
    }

    /**
     * 写入会员地址
     */
    private function editAddress($type, $data, $mode)
    {
        $shippingTarget = json_decode($data['shippingTarget'], true);

        if ($mode == 'add') {
            if ($data['shippingMethod'] == 'cvs') {
                return Address::create([
                    'guid' => PublicServiceProvider::generateGuid(),
                    'owner' => $data['owner'],
                    'type' => $type,
                    'fullName' => $shippingTarget['ReceiverName'],
                    'cellPhone' => $shippingTarget['ReceiverCellPhone'],
                    'email' => $shippingTarget['ReceiverEmail'],
                ]);
            } else {
                return Address::create([
                    'guid' => PublicServiceProvider::generateGuid(),
                    'owner' => $data['owner'],
                    'type' => $type,
                    'fullName' => $shippingTarget['ReceiverName'],
                    'cellPhone' => $shippingTarget['ReceiverCellPhone'],
                    'address' => $shippingTarget['ReceiverAddress'],
                    'city' => $shippingTarget['ReceiverCity'],
                    'postcode' => $shippingTarget['ReceiverPort'],
                    'email' => $shippingTarget['ReceiverEmail'],
                ]);
            }
        } else {
            if ($data['shippingMethod'] == 'cvs') {
                return Address::where('owner', $data['owner'])->update([
                    'type' => $type,
                    'fullName' => $shippingTarget['ReceiverName'],
                    'cellPhone' => $shippingTarget['ReceiverCellPhone'],
                    'email' => $shippingTarget['ReceiverEmail'],
                ]);
            } else {
                return Address::where('owner', $data['owner'])->update([
                    'type' => $type,
                    'fullName' => $shippingTarget['ReceiverName'],
                    'cellPhone' => $shippingTarget['ReceiverCellPhone'],
                    'address' => $shippingTarget['ReceiverAddress'],
                    'city' => $shippingTarget['ReceiverCity'],
                    'postcode' => $shippingTarget['ReceiverPort'],
                    'email' => $shippingTarget['ReceiverEmail'],
                ]);
            }
        }
    }

    /**
     * 添加新帐号
     */
    public function createAccount($data)
    {
        // return $data;
        $bonus = Bonus::all()->first();

        $shippingTarget = json_decode($data['shippingTarget'], true);

        try {
            $defaultPoint = Bonus::all()->first()['defaultPoint'];
        } catch (\Exception $e) {
            $defaultPoint = 25;
        }

        try {
            $subscriptable = $data['subscriptable'];
            $subscriptable = true;
        } catch (\Exception $e) {
            $subscriptable = false;
        }

        try {
            event(new Registered($user = User::create([
                'guid' => PublicServiceProvider::generateGuid(),
                'name' => $shippingTarget['ReceiverName'],
                'email' => $shippingTarget['ReceiverEmail'],
                'role' => 'NORMAL',
                'point' => $defaultPoint,
                'password' => bcrypt($data['password']),
                'subscriptable' => $subscriptable,
            ])));

            if (env('APP_ENV') === 'prod') {
                Mail::send('mail.welcomeMail', [
                    'name' => $shippingTarget['ReceiverName'],
                    'account' => $shippingTarget['ReceiverEmail'],
                    'point' => $bonus['defaultPoint'],
                    'percentage' => $bonus['percentage']
                ], function($message) use ($shippingTarget) {
                    $message->to([ $shippingTarget['ReceiverEmail'], ])->subject(env('APP_NAME').'在线购物加入会员通知');
                    $message->from(env('MAIL_USERNAME'), $name = env('APP_NAME'));
                });
            }

            $this->guard()->login($user);

            return $user;
        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    /**
     * 信用卡 OR ATM转帐付款
     */
    public function orderPayment(Request $request)
    {
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

        $data = $request->all();

        $sender = env('MAIL_USERNAME');

        $cartInfo = json_decode($data['cartInfo']);
        $shippingTarget = json_decode($data['shippingTarget'], true);

        $totalAmount = (int)$data['TotalAmount'] + (int)$data['shippingCosts'] - (int)$data['pointUsage'];

        $merchantIdCache = array(
            'MerchantTradeNo' => env('APP_NAME').time()
        );

        if ($data['addNewMember'] == 'true') {
            $newUser = $this->createAccount($data);
        } else {
            $newUser = false;
        }

        // return $data;

        // return Hppe::send();

        //基本参数(可依系统规划自行调整)
        Ecpay::instance()->Send['ReturnURL']             = $actual_link."/ecpay-return" ;        //交易结果回报的网址
        Ecpay::instance()->Send['ClientBackURL']         = $actual_link."/order-success" ;       //交易结束，让user导回的网址
        Ecpay::instance()->Send['MerchantTradeNo']       = $merchantIdCache['MerchantTradeNo'] ; //订单编号
        Ecpay::instance()->Send['MerchantTradeDate']     = date('Y/m/d H:i:s');                  //交易时间
        Ecpay::instance()->Send['TotalAmount']           = $totalAmount;                         //交易金额
        Ecpay::instance()->Send['TradeDesc']             = env('APP_NAME')." - 商品交易" ;        //交易描述
        Ecpay::instance()->Send['EncryptType']           = '1' ;
        Ecpay::instance()->Send['ChoosePayment']         = $data['ChoosePayment'] ;              //付款方式
        Ecpay::instance()->Send['PaymentType']           = 'aio' ;
        Ecpay::instance()->Send['CustomField1']          = $merchantIdCache['MerchantTradeNo'];
        Ecpay::instance()->Send['CustomField2']          = Hash::make($merchantIdCache['MerchantTradeNo']);

        if ($data['ChoosePayment'] == 'ATM') {
            Ecpay::instance()->SendExtend['ExpireDate']        = 7;
            Ecpay::instance()->SendExtend['PaymentInfoURL']    = $actual_link."/payment_info";
            // Ecpay::instance()->SendExtend['ClientRedirectURL'] = $actual_link."/payment_info";
        }

        //订单的商品数据
        foreach ($cartInfo as $item) {
            array_push(Ecpay::instance()->Send['Items'],
                    array('Name' => $item->Name,
                    'Price' => (int)($item->price),
                    'Currency' => "元",
                    'Quantity' => (int) ($item->qty),
                    'URL' => "http://www.yourwebsites.com.tw/Product"));
        }

        // return date("Y-m-d h:m", time());

        return DB::transaction(function () use ($data, $merchantIdCache, $cartInfo, $shippingTarget, $totalAmount, $sender, $newUser)
        {
            if (Auth::guest()) {
                $pointUsage = 0;
                $owner = 'guest';
            } else {
                $pointUsage = (int)$data['pointUsage'];
                if ($newUser) {
                    $owner = $newUser['guid'];
                } else {
                    $owner = $data['owner'];
                }

                // Log::info($owner);
                $data['owner'] = $owner;

                if ($data['useUserInfo'] == 'true') {
                    if ($this->checkAddress($owner, 'shipping')) {
                        $this->editAddress('shipping', $data, 'edit');
                    } else {
                        $this->editAddress('shipping', $data, 'add');
                    }
                }
                

                if ($pointUsage > Auth::user()->point) {
                    DB::rollback();
                    return "<h1 style='text-align: center; margin-top: 100px;'>点数错误，请重新下订。</h1>";
                } else {
                    try {
                        User::where('guid', $owner)->update([
                            'point' => (int)Auth::user()->point - $pointUsage,
                        ]);
                    } catch (\Exception $e) {
                        Log::error($e);
                        DB::rollback();
                        return "<h1 style='text-align: center; margin-top: 100px;'>点数错误，请重新下订。</h1>";
                    }
                }
            }

            foreach ($cartInfo as $item) {
                $productType = Product::where('productGuid', $item->id->guid)->first()['productType'];

                if ($productType == 'variable') {
                    $subQuantity = SubProduct::where('id', $item->id->subProductId)->first()['subQuantity'];
                    $checkOrderStockAndQty = (int)$item->qty > (int)$subQuantity;

                    if ($checkOrderStockAndQty) {
                        DB::rollback();
                        return "<h1 style='text-align: center; margin-top: 100px;'>商品数量有误，请重新创建订单。1</h1>";
                    } else {
                        try {
                            SubProduct::where('id', $item->id->subProductId)->update([
                                'subQuantity' => (int)$subQuantity - (int)$item->qty
                            ]);
                        } catch(\Exception $e) {
                            Log::error($e);
                            DB::rollback();
                            return "<h1 style='text-align: center; margin-top: 100px;'>商品数量有误，请重新创建订单。2</h1>";
                        }
                    }
                } else {
                    $reserveStatus = Product::where('productGuid', $item->id->guid)->first()['reserveStatus'];
                    $checkDataStockAndQty = (Product::where('productGuid', $item->id->guid)->first()['status'] == 'outofstock') ||
                                        ((int)Product::where('productGuid', $item->id->guid)->first()['quantity'] == 0);
                    $checkOrderStockAndQty = (int)$item->qty > (int)Product::where('productGuid', $item->id->guid)->first()['quantity'];

                    if ($reserveStatus) {

                        if ($checkDataStockAndQty) {
                            DB::rollback();
                            return "<h1 style='text-align: center; margin-top: 100px;'>商品数量有误，请重新创建订单。3</h1>";
                        } else {
                            if ($checkOrderStockAndQty) {
                                return "<h1 style='text-align: center; margin-top: 100px;'>商品数量有误，请重新创建订单。4</h1>";
                                DB::rollback();
                            } else {
                                try {
                                    Product::where('productGuid', $item->id->guid)->update([
                                        'quantity' => (int)Product::where('productGuid', $item->id->guid)->first()['quantity'] - (int)$item->qty,
                                    ]);
                                } catch (\Exception $e) {
                                    Log::error($e);
                                    DB::rollback();
                                    return "<h1 style='text-align: center; margin-top: 100px;'>商品数量有误，请重新创建订单。5</h1>";
                                }
                            }
                        }
                    } else {
                        try {
                            Product::where('productGuid', $item->id->guid)->update([
                                'quantity' => (int)Product::where('productGuid', $item->id->guid)->first()['quantity'] - (int)$item->qty,
                            ]);
                        } catch (\Exception $e) {
                            Log::error($e);
                            DB::rollback();
                            return "<h1 style='text-align: center; margin-top: 100px;'>商品数量有误，请重新创建订单。6</h1>";
                        }
                    }
                }               
                
            }

            // 清除购物车
            Cart::destroy();

            try {
                $createorder = Order::create([
                    'guid'              => str_random(6),
                    'content'           => $data['cartInfo'],
                    'amount'            => $totalAmount,
                    'merchantID'        => $merchantIdCache['MerchantTradeNo'],
                    'pointUsage'        => $pointUsage,
                    'status'            => 'unpaid',
                    'owner'             => $owner,
                    'paymentMethod'     => $data['ChoosePayment'],
                    'shippingMethod'    => $data['shippingMethod'],
                    'shippingTarget'    => $data['shippingTarget'],
                    'usedCoupon'        => $data['usedCoupon'],
                    'Temperature'       => $data['Temperature'],
                    'receipt'           => $data['receipt'],
                    'taxId'             => $data['taxId'],
                    'orderFlag'         => Hash::make($merchantIdCache['MerchantTradeNo']),
                    'remarks'           => $data['Remark'],
                ]);

                // Log::info($createorder);
            } catch (\Exception $e) {
                Log::error($e);
                Log::info('rollback 6');
                DB::rollback();
                return "<h1 style='text-align: center; margin-top: 100px;'>订单创建失败，请联系商家。</h1>";
            }

            //Go to EcPay
            // echo "<h1 style='text-align: center; margin-top: 100px;'>交易信息传输中，请勿刷新或者关闭窗口，以免重复下订。</h1>";

            if (env('APP_ENV') === 'local') {
                Mail::send('mail.orderNotice', [
                    'data' => $data,
                    'cartInfo' => $cartInfo,
                    'shippingTarget' => $shippingTarget,
                    'merchantIdCache' => $merchantIdCache
                ], function($message) use ($sender, $shippingTarget) {
                    $message->to([
                        'info@nizawa-int.com.tw', 'vincent7697@gmail.com'
                    ])->subject('詢價單成立通知 - 來自 '.$shippingTarget['ReceiverName'].' 的詢價');
                    $message->from('info@nizawa-int.com.tw', $name = env('APP_NAME'));
                });

                // Mail::send('mail.notice', [
                //     'data' => $data,
                //     'cartInfo' => $cartInfo,
                //     'shippingTarget' => $shippingTarget,
                //     'merchantIdCache' => $merchantIdCache
                // ], function($message) use ($sender, $shippingTarget) {
                //     $message->to([
                //         $shippingTarget['ReceiverEmail'],
                //         $sender,
                //     ])->subject(env('APP_NAME').' 订单成立通知信');
                //     $message->from($sender, $name = env('APP_NAME'));
                // });
            }

            // echo Ecpay::instance()->CheckOutString();

            if ($data['ChoosePayment'] == 'Remit') {
                return redirect('/checkout-success');
            } else {
                // return Hppe::send([
                //     'order' => str_random(6),
                //     'amount' => $totalAmount,
                //     'orderNumber' => $merchantIdCache['MerchantTradeNo']
                // ]);
    
                return Esun::send([
                    'amount' => $totalAmount,
                    'orderNumber' => $merchantIdCache['MerchantTradeNo'].'.'.strtoupper(str_random(6))
                ]);
            }
        });
    }

    /**
     * 超商取货物流单创建
     */
    public function shopReply(Request $request)
    {
        $data = $request->all();

        $sender = env('MAIL_USERNAME');

        $cartInfo = json_decode($data['cartInfo']);
        $shippingTarget = json_decode($data['shippingTarget'], true);

        $totalAmount = (int)$data['TotalAmount'] + (int)$data['shippingCosts'] - (int)$data['pointUsage'];

        $merchantIdCache = array(
            'MerchantTradeNo' => "MG".time(),
        );

        if ($data['addNewMember'] == 'true') {
            $newUser = $this->createAccount($data);
        } else {
            $newUser = false;
        }

//        return $data['usedCoupon'];
//        return $data;

        return DB::transaction(function () use ($data, $merchantIdCache, $cartInfo, $shippingTarget, $sender, $totalAmount, $newUser)
        {
            if (Auth::guest()) {
                $pointUsage = 0;
                $owner = 'guest';
                Log::info('guest');
            } else {
                Log::info('member');
                $pointUsage = (int)$data['pointUsage'];
                if ($newUser) {
                    $owner = $newUser['guid'];
                } else {
                    $owner = $data['owner'];
                }

                Log::info($owner);
                $data['owner'] = $owner;
                if ($this->checkAddress($owner, 'shipping')) {
                    $this->editAddress('shipping', $data, 'edit');
                    // return 1;
                } else {
                    $this->editAddress('shipping', $data, 'add');
                    // return 0;
                }

                if ($pointUsage > Auth::user()->point) {
                    DB::rollback();
                    return "<h1 style='text-align: center; margin-top: 100px;'>点数错误，请重新下订。</h1>";
                } else {
                    try {
                        User::where('guid', $owner)->update([
                            'point' => (int)Auth::user()->point - $pointUsage,
                        ]);
                    } catch (\Exception $e) {
                        Log::error($e);
                        DB::rollback();
                        return "<h1 style='text-align: center; margin-top: 100px;'>点数错误，请重新下订。</h1>";
                    }
                }
            }

            foreach ($cartInfo as $item) {
                $reserveStatus = Product::where('productGuid', $item->id->productGuid)->first()['reserveStatus'];
                $checkDataStockAndQty = (Product::where('productGuid', $item->id->productGuid)->first()['status'] == 'outofstock') ||
                                    ((int)Product::where('productGuid', $item->id->productGuid)->first()['quantity'] == 0);
                $checkOrderStockAndQty = (int)$item->qty > (int)Product::where('productGuid', $item->id->productGuid)->first()['quantity'];

                if ($reserveStatus) {

                    if ($checkDataStockAndQty) {
                        DB::rollback();
                        return "<h1 style='text-align: center; margin-top: 100px;'>商品数量有误，请重新创建订单。</h1>";
                    } else {
                        if ($checkOrderStockAndQty) {
                            return "<h1 style='text-align: center; margin-top: 100px;'>商品数量有误，请重新创建订单。</h1>";
                            DB::rollback();
                        } else {
                            try {
                                Product::where('productGuid', $item->id->productGuid)->update([
                                    'quantity' => (int)Product::where('productGuid', $item->id->productGuid)->first()['quantity'] - (int)$item->qty,
                                ]);
                            } catch (\Exception $e) {
                                Log::error($e);
                                DB::rollback();
                                return "<h1 style='text-align: center; margin-top: 100px;'>商品数量有误，请重新创建订单。</h1>";
                            }
                        }
                    }
                } else {
                    try {
                        Product::where('productGuid', $item->id->productGuid)->update([
                            'quantity' => (int)Product::where('productGuid', $item->id->productGuid)->first()['quantity'] - (int)$item->qty,
                        ]);
                    } catch (\Exception $e) {
                        Log::error($e);
                        DB::rollback();
                        return "<h1 style='text-align: center; margin-top: 100px;'>商品数量有误，请重新创建订单。</h1>";
                    }
                }
            }

            try {
            	// Ecpay::logistics() =Ecpay::logistics();
              	Ecpay::logistics()->HashKey = config('ecpay.HashKey');
              	Ecpay::logistics()->HashIV = config('ecpay.HashIV');

                Ecpay::logistics()->Send = array(
                    'MerchantID'            => config('ecpay.MerchantID'),
                    'MerchantTradeNo'       => $merchantIdCache['MerchantTradeNo'],
                    'MerchantTradeDate'     => date('Y/m/d H:i:s'),
                    'LogisticsType'         => 'CVS',
                    'LogisticsSubType'      => $data['LogisticsSubType'],
                    'GoodsAmount'           => $totalAmount,
                    'CollectionAmount'      => $totalAmount,
                    'IsCollection'          => $data['IsCollection'],    //是否代收货款
                    'GoodsName'             => env('APP_NAME').' - 商品订单',
                    'SenderName'            => env('APP_NAME'),
                    'SenderPhone'           => '035679463',
                    'SenderCellPhone'       => '0976059292',
                    'ReceiverName'          => $data['ReceiverName'],
                    'ReceiverCellPhone'     => $data['ReceiverCellPhone'],
                    'ReceiverEmail'         => $data['ReceiverEmail'],
                    'TradeDesc'             => '测试交易叙述',
                    'ServerReplyURL'        => url('logistics-return'),        //物流状态回复网址
                    'LogisticsC2CReplyURL'  => url('logistics_order_C2C_reply'),    //到付店若有异动消息回复网址
                    'Remark'                => $data['Remark'],
                    'PlatformID'            => '',
                );

                Ecpay::logistics()->SendExtend = array(
                     'ReceiverStoreID'  => $data['CVSStoreID'],     //到付店id
                     'ReturnStoreID'    => $data['CVSStoreID']        //回退店id,一般与寄件店id同
                );

                // 清除购物车
                Cart::destroy();

            	$Result = Ecpay::logistics()->BGCreateShippingOrder();   //超商系统回复内容

                $cvsResult = array(
                    'MerchantID'        => $Result['MerchantID'],
                    'AllPayLogisticsID' => $Result['AllPayLogisticsID'],
                    'CVSPaymentNo'      => $Result['CVSPaymentNo'],
                    'CVSValidationNo'   => $Result['CVSValidationNo'],
                );

                $newShippingTarget = array_merge(json_decode($data['shippingTarget'], true), $cvsResult);

                if (env('APP_ENV') === 'prod') {
                    Mail::send('mail.orderNotice', [
                        'data'              => $data,
                        'cartInfo'          => $cartInfo,
                        'shippingTarget'    => $shippingTarget,
                        'merchantIdCache'   => $merchantIdCache
                    ], function($message) use ($sender, $shippingTarget) {
                        $message->to([
                            'info@nizawa-int.com.tw', 'vincent7697@gmail.com'
                        ])->subject('订单成立通知 - 来自 '.$shippingTarget['ReceiverName'].' 的订购');
                        $message->from('info@nizawa-int.com.tw', $name = env('APP_NAME'));
                    });

                    // Mail::send('mail.notice', [
                    //     'data'              => $data,
                    //     'cartInfo'          => $cartInfo,
                    //     'shippingTarget'    => $shippingTarget,
                    //     'merchantIdCache'   => $merchantIdCache
                    // ], function($message) use ($sender, $shippingTarget) {
                    //     $message->to([
                    //         $shippingTarget['ReceiverEmail'],
                    //         $sender,
                    //     ])->subject(env('APP_NAME').' 订单成立通知信');
                    //     $message->from($sender, $name = env('APP_NAME'));
                    // });
                }

                try {
                    Order::create([
                        'guid'              => str_random(6),
                        'content'           => $data['cartInfo'],
                        'amount'            => $totalAmount,
                        'merchantID'        => $merchantIdCache['MerchantTradeNo'],
                        'pointUsage'        => (int)$data['pointUsage'],
                        'status'            => 'cod',
                        'owner'             => $owner,
                        'paymentMethod'     => 'cod',
                        'shippingMethod'    => 'cvs',
                        'usedCoupon'        => $data['usedCoupon'],
                        'receipt'           => $data['receipt'],
                        'taxId'             => $data['taxId'],
                        'shippingTarget'    => json_encode($newShippingTarget),
                        'orderFlag'         => Hash::make($merchantIdCache['MerchantTradeNo']),
                        'remarks'           => $data['Remark'],
                    ]);
                } catch (\Exception $e) {
                    Log::error($e);
                    DB::rollback();
                }

                Log::info(json_encode($Result));

                if ($owner == 'guest') {
                    return PublicServiceProvider::exception('感谢您的选购，请至信箱查找您的订单明细。');
                } else {
                    return redirect('/order-success');
                }

            	// echo '<pre>' . print_r($Result, true) . '</pre>';
              	if($Result['RtnCode'] == 300){
              	}
            } catch(Exception $e) {
                $Result = $e->getMessage();
              	echo $e->getMessage();
                DB::rollback();
        	}
        });
    }

    /**
     * 会员专区继续付款
     */
    public function orderPaymentDashboard($guid)
    {

        try {
            $order = Order::where('guid', $guid)->first();
        } catch (\Exception $e) {
            return "Can not find order.";
        }

        $orderParametor = array(
            'merchantID'        => $order['merchantID'],
            'cartInfo'          => json_decode($order['content']),
            'amount'            => $order['amount'],
            'pointUsage'        => $order['pointUsage'],
            'paymentMethod'     => $order['paymentMethod'],
            'shippingMethod'    => $order['shippingMethod'],
        );

        Log::info($order);

        Log::info((int)$orderParametor['amount'] - (int)$orderParametor['pointUsage']);

        // return Hppe::send([
        //     'order' => str_random(6),
        //     'amount' => $order['amount'],
        //     'orderNumber' => $order['merchantID']
        // ]);

        return Esun::send([
            'amount' => $order['amount'],
            'orderNumber' => $order['merchantID'].'.'.strtoupper(str_random(6))
        ]);

        // $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

        // Ecpay::instance()->Send['ReturnURL']         = $actual_link."/ecpay-return";
        // Ecpay::instance()->Send['ClientBackURL']     = $actual_link."/user";
        // Ecpay::instance()->Send['MerchantTradeNo']   = "MG".time();
        // Ecpay::instance()->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');
        // Ecpay::instance()->Send['TotalAmount']       = (int)$orderParametor['amount'];
        // Ecpay::instance()->Send['TradeDesc']         = "明谷生机 - 商品交易";
        // Ecpay::instance()->Send['EncryptType']       = '1';
        // Ecpay::instance()->Send['ChoosePayment']     = $orderParametor['paymentMethod'] ;
        // Ecpay::instance()->Send['PaymentType']       = 'aio';
        // Ecpay::instance()->Send['CustomField1']      = $orderParametor['merchantID'];

        // //订单的商品数据
        // foreach ($orderParametor['cartInfo'] as $item) {
        //     array_push(Ecpay::instance()->Send['Items'],
        //             array(
        //                 'Name' => $item->Name,
        //                 'Price' => (int)($item->price),
        //                 'Currency' => "元",
        //                 'Quantity' => (int) ($item->qty),
        //                 'URL' => "http://www.yourwebsites.com.tw/Product",
        //             ));
        // }

        // //Go to EcPay
        // echo "<h1 style='text-align: center; margin-top: 100px;'>交易信息传输中...</h1>";
        // echo Ecpay::instance()->CheckOut();
    }

    /**
     * 后台已产生ATM订单，但没有选择银行，所以没有虚拟帐号，此为重新产生帐号的流程
     */
    public function reGenerateVAccount($guid)
    {
        try {
            $order = Order::where('guid', $guid)->get();
            $cartInfo = json_decode($order[0]->content);
        } catch (\Exception $e) {
            return "Can not find order.";
        }

        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

        Ecpay::instance()->Send['ReturnURL']             = $actual_link."/ecpay-return";
        Ecpay::instance()->Send['ClientBackURL']         = $actual_link."/user";
        Ecpay::instance()->Send['MerchantTradeNo']       = "MG".time();
        Ecpay::instance()->Send['MerchantTradeDate']     = date('Y/m/d H:i:s');
        Ecpay::instance()->Send['TotalAmount']           = (int)$order[0]['amount'] - (int)$order[0]['pointUsage'];
        Ecpay::instance()->Send['TradeDesc']             = env('APP_NAME')." - 商品交易";
        Ecpay::instance()->Send['EncryptType']           = '1';
        Ecpay::instance()->Send['ChoosePayment']         = $order[0]['paymentMethod'] ;
        Ecpay::instance()->Send['PaymentType']           = 'aio';
        Ecpay::instance()->Send['CustomField1']          = $order[0]['merchantID'];
        Ecpay::instance()->SendExtend['ExpireDate']      = 7;
        Ecpay::instance()->SendExtend['PaymentInfoURL']  = $actual_link."/payment_info";

        //订单的商品数据
        foreach ($cartInfo as $item) {
            array_push(Ecpay::instance()->Send['Items'],
                array(
                    'Name' => $item->Name,
                    'Price' => (int)($item->price),
                    'Currency' => "元",
                    'Quantity' => (int) ($item->qty),
                    'URL' => "http://www.yourwebsites.com.tw/Product",
                ));
        }

        //Go to EcPay
        echo "<h1 style='text-align: center; margin-top: 100px;'>交易信息传输中...</h1>";
        echo Ecpay::instance()->CheckOut();
    }

    /**
     * 后台手动产生物流订单
     * Parameter:
     *
     * IsCollection,        是否代收货款
     * LogisticsType,       运送方式
     * LogisticsSubType,    若运送方式为CVS的话，指定这个参数即为超商的标的
     * TotalAmount,
     * ReceiverName,
     * ReceiverCellPhone,
     * ReceiverEmail,
     * CVSStoreID
     */
    public function generateCvs(Request $request)
    {
        $data = $request->all();

        $merchantIdCache = array(
            'MerchantTradeNo' => "MG".time(),
        );

        try {
          	Ecpay::logistics()->HashKey = config('ecpay.HashKey');
          	Ecpay::logistics()->HashIV = config('ecpay.HashIV');

            Ecpay::logistics()->Send = array(
                'MerchantID'            => config('ecpay.MerchantID'),
                'MerchantTradeNo'       => 'mic-' . date('YmdHis'),
                'MerchantTradeDate'     => date('Y/m/d H:i:s'),
                'LogisticsType'         => $data['LogisticsType'],
                'LogisticsSubType'      => $data['LogisticsSubType'],
                'GoodsAmount'           => (int)$data['TotalAmount'],
                'CollectionAmount'      => (int)$data['TotalAmount'],
                'IsCollection'          => 'N',
                'GoodsName'             => env('APP_NAME').' - 商品订单',
                'SenderName'            => env('APP_NAME'),
                'SenderPhone'           => '035679463',
                'SenderCellPhone'       => '0976059292',
                'ReceiverName'          => $data['ReceiverName'],
                'ReceiverCellPhone'     => $data['ReceiverCellPhone'],
                'TradeDesc'             => '测试交易叙述',
                'ServerReplyURL'        => url('logistics-return'),        //物流状态回复网址
                'LogisticsC2CReplyURL'  => url('logistics_order_C2C_reply'),    //到付店若有异动消息回复网址
                'Remark'                => $data['Remark'],
                'PlatformID'            => '',
            );

            if ($data['LogisticsType'] == 'Home') {
                Ecpay::logistics()->SendExtend = array(
                    'SenderZipCode'         => '30844',
                    'SenderAddress'         => '新竹县宝山乡园区二路356巷51-7号',
                    'Temperature'           => $request->all()['Temperature'],
                    'ReceiverZipCode'       => $request->all()['ReceiverPort'],
                    'ReceiverAddress'       => $request->all()['ReceiverAddress'],
                );
            } else {
                Ecpay::logistics()->SendExtend = array(
                    'ReceiverStoreID'  => $request->all()['CVSStoreID'],     //到付店id
                    'ReturnStoreID'    => $request->all()['CVSStoreID']        //回退店id,一般与寄件店id同
                );
            }

        	$Result = Ecpay::logistics()->BGCreateShippingOrder();   //超商系统回复内容
            Log::info(json_encode($Result));
            // return redirect('/order-success');
        	// echo '<pre>' . print_r($Result, true) . '</pre>';
            if($Result['RtnCode'] == 300){
                $order = Order::where('guid', $data['guid'])->first();
                $shippingTarget = json_decode($order['shippingTarget'], true);

                $cvsResult = array(
                    'MerchantID' => $Result['MerchantID'],
                    'AllPayLogisticsID' => $Result['AllPayLogisticsID'],
                    'CVSPaymentNo' => $Result['CVSPaymentNo'],
                    'CVSValidationNo' => $Result['CVSValidationNo'],
                );

                $newShippingTarget = array_merge($shippingTarget, $cvsResult);

                Order::where('guid', $data['guid'])->update([
                    'status' => 'shippingGenerated',
                    'shippingTarget' => json_encode($newShippingTarget),
                ]);
          	}
            return $Result;

        } catch(Exception $e) {
            $Result = $e->getMessage();
          	echo $e->getMessage();
    	}
    }

    /**
     * 产生缴费单
     * Parameter
     *
     * LogisticsSubType
     */
    public function generateSheet(Request $request)
    {
        $data = $request->all();

        Ecpay::logistics()->HashKey = config('ecpay.HashKey');
        Ecpay::logistics()->HashIV = config('ecpay.HashIV');

        $LogisticsSubType = $data['LogisticsSubType'];

        switch ($LogisticsSubType) {
            case 'Home':
                Ecpay::logistics()->Send = array(
                    'MerchantID' => $data['MerchantID'],
                    'AllPayLogisticsID' => $data['AllPayLogisticsID'],
                );

                $printBill = Ecpay::logistics()->PrintTradeDoc();
                break;
            case 'UNIMARTC2C':
                Ecpay::logistics()->Send = array(
                    'MerchantID' => $data['MerchantID'],
                    'AllPayLogisticsID' => $data['AllPayLogisticsID'],
                    'CVSPaymentNo' => $data['CVSPaymentNo'],
                    'CVSValidationNo' => $data['CVSValidationNo'],
                );

                $printBill = Ecpay::logistics()->PrintUnimartC2CBill();
                break;
            case 'FAMIC2C':
                Ecpay::logistics()->Send = array(
                    'MerchantID' => $data['MerchantID'],
                    'AllPayLogisticsID' => $data['AllPayLogisticsID'],
                    'CVSPaymentNo' => $data['CVSPaymentNo'],
                );

                $printBill = Ecpay::logistics()->PrintFamilyC2CBill();
                break;
            case 'HILIFEC2C':
                Ecpay::logistics()->Send = array(
                    'MerchantID' => $data['MerchantID'],
                    'AllPayLogisticsID' => $data['AllPayLogisticsID'],
                    'CVSPaymentNo' => $data['CVSPaymentNo'],
                );

                $printBill = Ecpay::logistics()->PrintHiLifeC2CBill();
                break;
        }

        echo $printBill;
    }

    /**
     * 取得超商店家参数
     */
    public function getCvsTarget(Request $request)
    {
        $data = $request->all();

        Ecpay::logistics()->Send['MerchantTradeNo']   = 'MGCVS_'.date('YmdHis');
        Ecpay::logistics()->Send['LogisticsSubType']  = $data['shop'];
        Ecpay::logistics()->Send['IsCollection']      = 'N';//是否代收货款
        Ecpay::logistics()->Send['ServerReplyURL']    = url('cvs_map_callback'); //超商系统回复路径post
        Ecpay::logistics()->Send['ExtraData']         = ''; //附带数据
        Ecpay::logistics()->Send['Device']            = '0';

        $logisticsForm = Ecpay::logistics()->CvsMap();
        echo $logisticsForm;
    }

    public function callBackCvs(Request $request)
    {
        return view('frontend.logistics.cvsMap', [
            'logisticsForm' => $request->all(),
        ]);
    }

    public function logistics_order_reply(Request $request)
    {
        Log::info('test');
        // return json_encode($request->all());
        // return view('checkoutSuccess')
        // return redirect('/');
        return view('frontend.checkoutMethod.checkoutSuccess', [
            'atmData' => json_decode($request->all()),
        ]);
    }

    public function checkoutTest(Request $request)
    {
        // $buyqty = 25;
        // $prodqty = Product::where('id', 4)->first()['quantity'];
        //
        // return $prodqty;

        $price = 1580;
        $qty = 25;

        return DB::transaction(function() use ($qty, $price) {

            DB::table('products')->where('id', 4)->update([
                'price' => $price,
            ]);
            $product = DB::table('products')->where('id', 4)->update([
                'quantity' => $qty,
            ]);

            if (Product::where('id', 4)->first()['quantity'] < 0) {
                DB::rollback();
                return 0;
            } else {
                return 1;
            }
        });
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
