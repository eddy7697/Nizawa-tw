@extends('frontend.dashboard.dashboard')

@section('dashboard-content')
    <div class="container mg-site-thumbnail">
        <div class="col-md-12">
            <a href="/">首頁</a>
            &nbsp;&nbsp;>&nbsp;&nbsp;
            訂單狀態
        </div>
    </div>
    <table class="order-list">
        <thead>
            <tr>
                <th><span>訂單</span></th>
                <th><span>日期</span></th>
                <th><span>狀態</span></th>
                <th><span>進度</span></th>
                <th><span>總計</span></th>
                <th><span>動作</span></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($order as $item)
                <tr>
                    <td data-title="訂單">
                        <a href="#">{{$item->merchantID}}</a>
                    </td>
                    <td data-title="日期">
                        <time datetime="2017-11-07T00:57:55+00:00">{{$item->created_at}}</time>
                    </td>
                    <td data-title="狀態">
                        @unless ($item->paymentMethod == 'cod')
                            @if ($item->paymentStatus == 'unpaid')
                                未付款
                            @else
                                已付款
                            @endif
                        @else
                            超商取貨付款
                        @endunless

                    </td>
                    <td data-title="進度">
                        @php
                            switch ($item->orderStatus) {
                                case 'undisposed':
                                    echo '<span style="color: brown; font-weight: bold">未處理</span>';
                                    break;
                                case 'disposing':
                                    echo '<span style="color: brown; font-weight: bold">處理中</span>';
                                    break;
                                case 'disposed':
                                    echo '<span style="color: green; font-weight: bold">已出貨</span>';
                                    break;
                                case 'canceled':
                                    echo '<span style="color: red; font-weight: bold">已取消</span>';
                                    break;
                                case 'success':
                                    echo '<span style="color: blue; font-weight: bold">完成</span>';
                                    break;

                                default:
                                    // code...
                                    break;
                            }
                        @endphp

                    </td>
                    <td data-title="總計">
                        <span><span>NT$</span>{{$item->amount}}</span>
                    </td>
                    <td data-title="動作">
                        <a href="#" class="woocommerce-button button view" data-toggle="modal" data-target="#myModal-{{$item->merchantID}}">查看</a>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal-{{$item->merchantID}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">訂單資訊</h4>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <tr>
                                                <td>訂單編號</td>
                                                <td>{{$item->merchantID}}</td>
                                            </tr>
                                            <tr>
                                                <td>商品內容</td>
                                                <td>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>商品</th>
                                                                <th>數量</th>
                                                                <th>單價</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach (json_decode($item->content) as $product)
                                                                <tr>
                                                                    <td>{{$product->Name}}</td>
                                                                    <td>{{$product->qty}}</td>
                                                                    <td>{{number_format($product->price)}}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>訂單金額</td>
                                                <td>NT$ {{$item->amount + $item->pointUsage}}</td>
                                            </tr>
                                            @if ((int)$item->pointUsage > 0)
                                                <tr>
                                                    <td>點數使用扣除</td>
                                                    <td>NT$ {{$item->pointUsage}}</td>
                                                </tr>
                                            @endif
                                            {{-- @if ($item->usedCoupon)
                                                <td>優惠券使用</td>
                                                <td>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>優惠券類型</th>
                                                                <th>折抵金額</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    @php
                                                                        switch (json_decode($item->usedCoupon)->discountType) {
                                                                            case 'percentage':
                                                                                echo '百分比折抵';
                                                                                break;
                                                                            case 'cartDiscount':
                                                                                echo '總額折抵';
                                                                                break;
                                                                            default:
                                                                                // code...
                                                                                break;
                                                                        }
                                                                    @endphp
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        switch (json_decode($item->usedCoupon)->discountType) {
                                                                            case 'percentage':
                                                                                echo json_decode($item->usedCoupon)->couponAmount.'%';
                                                                                break;
                                                                            case 'cartDiscount':
                                                                                echo 'NT$'.json_decode($item->usedCoupon)->couponAmount;
                                                                                break;
                                                                            default:
                                                                                // code...
                                                                                break;
                                                                        }
                                                                    @endphp
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            @endif --}}
                                            <tr>
                                                <td>應付金額</td>
                                                <td>NT$ {{$item->amount}}</td>
                                            </tr>
                                            <tr>
                                                <td>付款方式</td>
                                                <td>
                                                    @php
                                                        switch ($item->paymentMethod) {
                                                            case 'Credit':
                                                                echo "信用卡";
                                                                break;
                                                            case 'cod':
                                                                echo "超商取貨付款";
                                                                break;
                                                            case 'ATM':
                                                                echo "ATM 轉帳";
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                            @unless ($item->orderStatus =='canceled')
                                                @unless ($item->paymentMethod == 'cod')
                                                    <tr>
                                                        <td>付款資訊</td>
                                                        <td>
                                                            @if ($item->paymentMethod == 'Credit')
                                                                @if ($item->paymentStatus == 'unpaid')
                                                                    <form class="" action="/order-payment-dashboard/{{urlencode($item->guid)}}" method="post">
                                                                        {{csrf_field()}}
                                                                        <button type="submit" class="btn btn-xs btn-primary" name="button">尚未付款，點我付款去</button>
                                                                    </form>
                                                                @else
                                                                    已付款
                                                                @endif
                                                            @elseif($item->paymentMethod == 'Remit')
                                                                <a class="btn btn-xs btn-primary" href="/remittance-information" target="_blank">點我查看匯款資訊</a>
                                                            @else
                                                                @if ($item->paymentStatus == 'unpaid')
                                                                    @if ($item->BankCode)
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>銀行別</td>
                                                                                    <td>{{$item->BankCode}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>虛擬帳號</td>
                                                                                    <td>{{$item->vAccount}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>虛擬帳號到期日</td>
                                                                                    <td>{{$item->ExpireDate}}</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    @else
                                                                        <form action="/re-generate-vAccount/{{$item->guid}}" method="post">
                                                                            {{csrf_field()}}
                                                                            <button class="btn btn-xs btn-primary" name="button">此筆ATM訂單沒有虛擬帳號，點我產生</button>
                                                                        </form>
                                                                    @endif
                                                                @else
                                                                    已付款
                                                                @endif
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endunless
                                            @endunless
                                            <tr>
                                                <td>運送方式</td>
                                                <td>
                                                    @if ($item->shippingMethod == 'cvs')
                                                        超商取貨
                                                    @elseif ($item->shippingMethod == 'delivery')
                                                        國內宅配
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>運送標的</td>
                                                <td>
                                                    <table class="table">
                                                        @if ($item->shippingMethod == 'cvs')
                                                            <tr>
                                                                <td>取貨店家</td>
                                                                <td>{{json_decode($item->shippingTarget)->CVSStoreName}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>店家地址</td>
                                                                <td>
                                                                    {{json_decode($item->shippingTarget)->CVSAddress}}
                                                                </td>
                                                            </tr>
                                                        @else
                                                            {{json_decode($item->shippingTarget)->ReceiverPort}}&nbsp;
                                                            {{-- {{json_decode($item->shippingTarget)->ReceiverCity}}&nbsp; --}}
                                                            {{json_decode($item->shippingTarget)->ReceiverAddress}}
                                                        @endif
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    訂單備註
                                                </td>
                                                <td>
                                                    {{$item->remarks}}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
