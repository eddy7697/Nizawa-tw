<template>
    <div class="row">
        <div class="col-md-12">
            <form v-on:submit.prevent="searchOrder">
                <div class="input-group" style="width: 250px;">
                  <input type="text" class="form-control" placeholder="訂單編號" v-model="merchantID">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">搜尋訂單</button>
                  </span>
                </div><!-- /input-group -->
            </form>
        </div>
        <div class="col-md-12">
            <ul class="order-cate-list">
                <li v-bind:class="{ active: (orderStatus == 'all') }" @click="statusViewChange('all')">全部</li>
                <li v-bind:class="{ active: (orderStatus == 'unpaid') }" @click="statusViewChange('unpaid')">未付款</li>
                <li v-bind:class="{ active: (orderStatus == 'paid') }" @click="statusViewChange('paid')">已付款</li>
            </ul>
        </div>
        <div class="col-md-12">
            <table class="table field-table">
                <thead>
                    <tr>
                        <th>訂單編號</th>
                        <th>購買日期時間</th>
                        <th>會員帳號</th>
                        <th>客戶名稱</th>
                        <th>付款狀態</th>
                        <th>付款方式</th>
                        <th>訂單內容</th>
                        <th>訂單狀態</th>
                        <th style="text-align: center">訂單金額</th>
                        <th style="text-align: center">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in orderList" v-bind:key="index">
                        <td>{{item.merchantID}}</td>
                        <td>{{item.created_at}}</td>
                        <td v-if="item.owner !== 'guest'">{{item.email}}</td>
                        <td v-else><span style="color: brown; font-weight: bold">訪客</span></td>
                        <td>{{item.shippingTarget.ReceiverName}}</td>
                        <td>
                            <span style="color: brown; font-weight: bold" v-if="item.paymentStatus === 'uncheck'">未對帳</span>
                            <span style="color: red; font-weight: bold" v-if="item.paymentStatus === 'unpaid'">未付款</span>
                            <span style="color: green; font-weight: bold" v-if="item.paymentStatus === 'paid'">已付款</span>
                        </td>
                        <td>
                            <span v-if="item.paymentMethod == 'Credit'">信用卡</span>
                            <span v-else>轉帳付款</span>
                            <!-- {{item.paymentMethod}} -->
                        </td>
                        <td>
                            <span v-if="item.content.length">{{item.content[0].Name}} x {{item.content[0].qty}} ...</span>                            
                        </td>
                        <td>
                            <span style="color: brown; font-weight: bold" v-if="item.orderStatus == 'undisposed'">未處理</span>
                            <span style="color: brown; font-weight: bold" v-if="item.orderStatus == 'disposing'">處理中</span>
                            <span style="color: green; font-weight: bold" v-if="item.orderStatus == 'contacted'">已聯絡</span>
                            <span style="color: green; font-weight: bold" v-if="item.orderStatus == 'disposed'">已出貨</span>
                            <span style="color: red; font-weight: bold" v-if="item.orderStatus == 'canceled'">已取消</span>
                            <span style="color: blue; font-weight: bold" v-if="item.orderStatus == 'success'">完成</span>
                        </td>
                        <td style="text-align: center">{{item.amount}}</td>
                        <td align="center">
                            <button class="btn btn-default btn-sm" @click="openModal(item)">查看</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <ul class="pagination">
                <li v-if="prev_page_url">
                    <a href="#" @click="prevPage()">上一頁</a>
                </li>
                <li v-for="(item, index) in eachPage" v-bind:key="index" v-bind:class="{ active: current_page == item.pageNumber }">
                    <a href="#" @click="gotoPage(item)">{{item.pageNumber}}</a>
                </li>
                <li v-if="next_page_url">
                    <a href="#" @click="nextPage()">下一頁</a>
                </li>
            </ul>
            <div class="modal fade" id="detail-modal" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">訂單詳細資訊</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table product-detail-table">
                                <tr>
                                    <td>訂單編號</td>
                                    <td>{{itemShowed.merchantID}}</td>
                                </tr>
                                <tr>
                                    <td>商品內容</td>
                                    <td>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>商品</th>
                                                    <th>貨號</th>
                                                    <th>數量</th>
                                                    <th>單價</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in itemShowed.content" v-bind:key="index">
                                                    <td>{{item.Name}}</td>
                                                    <td>{{item.id.serialNumber}}</td>
                                                    <td>{{item.qty}}</td>
                                                    <td>{{item.price}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>訂單金額</td>
                                    <td>NT$ {{itemShowed.amount}}</td>
                                </tr>
                                <!-- <tr>
                                    <td>點數使用</td>
                                    <td>NT$ {{itemShowed.pointUsage}}</td>
                                </tr> -->
                                <!-- <tr v-if="itemShowed.usedCoupon">
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
                                                        <span v-if="itemShowed.usedCoupon.discountType === 'percentage'">百分比折抵</span>
                                                        <span v-if="itemShowed.usedCoupon.discountType === 'cartDiscount'">總額折抵</span>
                                                    </td>
                                                    <td>
                                                        <span v-if="itemShowed.usedCoupon.discountType === 'percentage'">{{itemShowed.usedCoupon.couponAmount}} %</span>
                                                        <span v-if="itemShowed.usedCoupon.discountType === 'cartDiscount'">NT$ {{itemShowed.usedCoupon.couponAmount}}</span>                                                        
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr> -->
                                <tr>
                                    <td>付款方式</td>
                                    <td>
                                        <span v-if="itemShowed.paymentMethod === 'ATM'">ATM轉帳</span>
                                        <span v-if="itemShowed.paymentMethod === 'Credit'">信用卡付款</span>
                                        <span v-if="itemShowed.paymentMethod === 'cod'">貨到付款</span>
                                        <span v-if="itemShowed.paymentMethod === 'Remit'">轉帳付款</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        付款狀態
                                    </td>
                                    <td>
                                        <div v-if="itemShowed.patmentStatusModify">
                                            <select v-model="itemShowed.paymentStatus">
                                                <option value="uncheck" v-if="itemShowed.orderStatus == 'uncheck'" selected>未對帳</option>
                                                <option value="uncheck" v-else>未對帳</option>
                                                <option value="unpaid" v-if="itemShowed.orderStatus == 'unpaid'" selected>未付款</option>
                                                <option value="unpaid" v-else>未付款</option>
                                                <option value="paid" v-if="itemShowed.orderStatus == 'paid'" selected>已付款</option>
                                                <option value="paid" v-else>已付款</option>
                                            </select>
                                            <button type="button" name="button" @click="modifyOrderStatus()"><i class="fa fa-check" aria-hidden="true"></i></button>
                                        </div>
                                        <div v-else>
                                            <span style="color: brown; font-weight: bold" v-if="itemShowed.paymentStatus === 'uncheck'">未對帳</span>
                                            <span style="color: red; font-weight: bold" v-if="itemShowed.paymentStatus === 'unpaid'">未付款</span>
                                            <span style="color: green; font-weight: bold" v-if="itemShowed.paymentStatus === 'paid'">已付款</span>
                                            <button class="btn btn-primary btn-sm" v-if="itemShowed.paymentMethod == 'Remit'" type="button" name="button" @click="togglePaymentStatusModify()">更改狀態</button>
                                        </div>
                                        

                                        
                                        
                                        <!-- <button
                                            type="button"
                                            style="margin-left: 10px;"
                                            class="btn btn-primary btn-xs"
                                            v-if="(itemShowed.paymentMethod !== 'cod') && (itemShowed.paymentStatus === 'paid') && (itemShowed.status === 'unpaid') && (itemShowed.shippingMethod === 'delivery')"
                                            @click="generateCvs('0001')">已付款，產生常溫物流單</button>
                                        <button
                                            type="button"
                                            style="margin-left: 10px;"
                                            class="btn btn-primary btn-xs"
                                            v-if="(itemShowed.paymentMethod !== 'cod') && (itemShowed.paymentStatus === 'paid') && (itemShowed.status === 'unpaid') && (itemShowed.shippingMethod === 'delivery')"
                                            @click="generateCvs('0002')">已付款，產生低溫物流單</button>
                                        <button
                                            type="button"
                                            style="margin-left: 10px;"
                                            class="btn btn-primary btn-xs"
                                            v-if="(itemShowed.paymentMethod !== 'cod') && (itemShowed.paymentStatus === 'paid') && (itemShowed.status === 'unpaid') && (itemShowed.shippingMethod === 'cvs')"
                                            @click="generateCvs('0002')">已付款，產生超商物流單</button>
                                        <button
                                            type="button"
                                            style="margin-left: 10px;"
                                            v-if="(itemShowed.paymentMethod !== 'cod') && (itemShowed.paymentStatus === 'paid') && (itemShowed.status === 'shippingGenerated')"
                                            class="btn btn-primary btn-xs"
                                            @click="generateSheet()">已產生物流單，點我列印繳費單</button>
                                        <button type="button"
                                            style="margin-left: 10px;"
                                            v-if="itemShowed.paymentMethod === 'cod'"
                                            class="btn btn-primary btn-xs"
                                            @click="generateSheet()">已產生貨到付款物流單，點我列印繳費單</button> -->
                                    </td>
                                </tr>
                                <tr>
                                    <td>訂單狀態</td>
                                    <td>
                                        <div v-if="itemShowed.statusModify">
                                            <select v-model="itemShowed.orderStatus">
                                                <option value="undisposed" v-if="itemShowed.orderStatus == 'undisposed'" selected>未處理</option>
                                                <option value="undisposed" v-else>未處理</option>
                                                <option value="disposing" v-if="itemShowed.orderStatus == 'disposing'" selected>處理中</option>
                                                <option value="disposing" v-else>處理中</option>
                                                <!-- <option value="contacted" v-if="itemShowed.orderStatus == 'contacted'" selected>已聯絡</option>
                                                <option value="contacted" v-else>已聯絡</option> -->
                                                <option value="disposed" v-if="itemShowed.orderStatus == 'disposed'" selected>已出貨</option>
                                                <option value="disposed" v-else>已出貨</option>
                                                <option value="canceled" v-if="itemShowed.orderStatus == 'canceled'" selected>已取消</option>
                                                <option value="canceled" v-else>已取消</option>
                                                <!-- <option value="success" v-if="itemShowed.orderStatus == 'success'" selected>完成</option>
                                                <option value="success" v-else>完成</option> -->
                                            </select>
                                            <button type="button" name="button" @click="modifyOrderStatus()"><i class="fa fa-check" aria-hidden="true"></i></button>
                                        </div>
                                        <div v-else>
                                            <span style="color: brown; font-weight: bold" v-if="itemShowed.orderStatus == 'undisposed'">未處理</span>
                                            <span style="color: brown; font-weight: bold" v-if="itemShowed.orderStatus == 'disposing'">處理中</span>
                                            <span style="color: green; font-weight: bold" v-if="itemShowed.orderStatus == 'contacted'">已聯絡</span>
                                            <span style="color: green; font-weight: bold" v-if="itemShowed.orderStatus == 'disposed'">已出貨</span>
                                            <span style="color: red; font-weight: bold" v-if="itemShowed.orderStatus == 'canceled'">已取消</span>
                                            <span style="color: blue; font-weight: bold" v-if="itemShowed.orderStatus == 'success'">完成</span>


                                            <button class="btn btn-primary btn-sm" v-if="itemShowed.orderStatus == 'canceled'" type="button" name="button" disabled>更改狀態</button>
                                            <button class="btn btn-primary btn-sm" v-else type="button" name="button" @click="toggleStatusModify()">更改狀態</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>運送方式</td>
                                    <td>
                                        <span v-if="itemShowed.shippingMethod === 'delivery'">國內宅配</span>
                                        <span v-if="itemShowed.shippingMethod === 'cvs'">超商取貨</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>客戶資訊</td>
                                    <td>
                                        <!-- <span v-if="itemShowed.shippingTarget">{{itemShowed.shippingTarget.ReceiverName}}</span> -->
                                        <!-- {{itemShowed.shippingTarget.ReceiverName}} -->
                                        <table v-if="itemShowed.shippingTarget" class="table">
                                            <tr>
                                                <td>客戶名稱</td>
                                                <td>{{itemShowed.shippingTarget.ReceiverName}}</td>
                                            </tr>
                                            <tr>
                                                <td>客戶電話</td>
                                                <td>{{itemShowed.shippingTarget.ReceiverCellPhone}}</td>
                                            </tr>
                                            <tr>
                                                <td>電子郵件</td>
                                                <td>{{itemShowed.shippingTarget.ReceiverEmail}}</td>
                                            </tr>
                                            <tr v-if="itemShowed.paymentMethod == 'Remit'">
                                                <td>帳號末五碼</td>
                                                <td>{{itemShowed.shippingTarget.LastFiveChar}}</td>
                                            </tr>
                                            <tr v-if="itemShowed.receipt">
                                                <td>發票抬頭</td>
                                                <td>{{itemShowed.receipt}}</td>
                                            </tr>
                                            <tr v-if="itemShowed.taxId">
                                                <td>統一編號</td>
                                                <td>{{itemShowed.taxId}}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>運送標的</td>
                                    <td>
                                        <table class="table" v-if="itemShowed.shippingMethod === 'cvs'">
                                            <tr>
                                                <td>取貨店家</td>
                                                <td>{{itemShowed.shippingTarget.CVSStoreName}}</td>
                                            </tr>
                                            <tr>
                                                <td>店家地址</td>
                                                <td>{{itemShowed.shippingTarget.CVSAddress}}</td>
                                            </tr>
                                        </table>                                        
                                        <!-- <span v-if="itemShowed.shippingMethod === 'delivery'">
                                            {{itemShowed.shippingTarget.ReceiverPort + itemShowed.shippingTarget.ReceiverCity + itemShowed.shippingTarget.ReceiverAddress}}
                                        </span> -->                                        
                                        <div v-if="itemShowed.shippingMethod === 'delivery'" id="ready-to-print" style="border: 1px #ccc dashed; padding: 10px; width: max-content ">
                                            <!-- <span style="font-size: 12px;">269宜蘭縣冬山鄉香城路15巷6號 (易耕事業有限公司 03-9590903)</span>
                                            <br> -->
                                            <span style="font-size: 16px;">
                                                {{`${itemShowed.shippingTarget.ReceiverPort}  ${itemShowed.shippingTarget.ReceiverAddress}`}}
                                            </span>
                                            <br>
                                            <span style="font-size: 16px;">
                                                {{itemShowed.shippingTarget.ReceiverName}} 收 ({{itemShowed.shippingTarget.ReceiverCellPhone}})
                                            </span>                                      
                                        </div>
                                        <!-- <button v-if="itemShowed.shippingMethod === 'delivery'" class="btn btn-primary btn-sm" style="margin-top: 10px;" @click="printAddress()">列印</button> -->
                                    </td>
                                </tr>
                                <tr>
                                    <td>備註</td>
                                    <td>
                                        <div v-if="!itemShowed.remarkModify">
                                            <div class="remark-info" v-if="itemShowed.remarks" v-html="breakLine(itemShowed.remarks)"></div>                                            
                                            <button type="button" class="btn btn-primary btn-sm" @click="toggleRemarkModify()">更改備註</button>
                                        </div>
                                        <div v-else>
                                            <textarea class="form-control" rows="3" v-model="itemShowed.remarks"></textarea>
                                            <button style="margin-top: 10px;" class="btn btn-primary btn-sm" @click="modifyOrderRemark()">儲存備註</button>
                                        </div>
                                        
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="sheet-modal" role="dialog" data-backdrop="static">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">配送單資訊</h4>
                        </div>
                        <div class="modal-body" id="sheet-frame-container">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ElementUI from 'element-ui';
    import 'element-ui/lib/theme-chalk/index.css';
    import lang from 'element-ui/lib/locale/lang/zh-TW'
    import locale from 'element-ui/lib/locale'    

    Vue.use(ElementUI);
    locale.use(lang)

    export default {
        data() {
            return {
                merchantID: '',
                orderList: [],
                next_page_url: null,
                prev_page_url: null,
                total: null,
                current_page: null,
                eachPage: [],
                itemShowed: {},
                orderStatus: 'all',
                token: $('meta[name="csrf-token"]').attr('content'),
            }
        },
        watch: {
            orderStatus: function (val) {
                this.getOrders('/order/get/' + val);
            }
        },
        created: function () {
            this.getOrders('/order/get/' + this.orderStatus);
            $('.loading-bar').fadeOut('100');
        },
        methods: {
            toggleStatusModify: function () {
                this.itemShowed.statusModify = this.itemShowed.statusModify ? false : true;
            },
            togglePaymentStatusModify() {
                this.itemShowed.patmentStatusModify = this.itemShowed.patmentStatusModify ? false : true;
            },
            toggleRemarkModify() {
                this.itemShowed.remarkModify = this.itemShowed.remarkModify ? false : true;
            },
            searchOrder: function () {
                this.getOrders('/order/search/' + this.merchantID);
            },
            statusViewChange: function (status) {
                this.orderStatus = status;
            },
            getOrders: function (url) {
                var self = this;

                $('.loading-bar').show();

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                })
                .done(function(response) {
                    self.orderList = [];
                    self.next_page_url = response.next_page_url;
                    self.prev_page_url = response.prev_page_url;
                    self.current_page = response.current_page;
                    self.total = response.total;
                    self.eachPage = [];

                    response.data.forEach(function (item) {
                        self.orderList.push({
                            guid: item.guid,
                            owner: item.owner,
                            email: item.email,
                            merchantID: item.merchantID,
                            content: JSON.parse(item.content),
                            amount: item.amount,
                            pointUsage: item.pointUsage,
                            status: item.status,
                            orderStatus: item.orderStatus,
                            paymentStatus: item.paymentStatus,
                            paymentMethod: item.paymentMethod,
                            shippingMethod: item.shippingMethod,
                            usedCoupon: JSON.parse(item.usedCoupon),
                            ExpireDate: item.ExpireDate,
                            BankCode: item.BankCode,
                            PaymentType: item.PaymentType,
                            vAccount: item.vAccount,
                            shippingTarget: JSON.parse(item.shippingTarget),
                            remarks: item.remarks,
                            receipt: item.receipt,
                            taxId: item.taxId,
                            created_at: item.created_at,
                            statusModify: false,
                            remarkModify: false,
                            patmentStatusModify: false
                        });
                    });

                    for (var i = 0; i < response.last_page; i++) {
                        self.eachPage.push({
                            pageNumber: i + 1,
                        });
                    }
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    $('.loading-bar').hide();
                });

            },
            openModal: function (item) {
                this.itemShowed = {};
                this.itemShowed = JSON.parse(JSON.stringify(item));

                if (this.itemShowed.statusModify) {
                    this.itemShowed.statusModify = false;
                }

                if (this.itemShowed.patmentStatusModify) {
                    this.itemShowed.patmentStatusModify = false;
                }
                
                if (this.itemShowed.remarkModify) {
                    this.itemShowed.remarkModify = false;
                }

                $('#detail-modal').modal('show');
            },
            generateCvs: function (temp) {
                var self = this;
                var token = this.token;

                $('.loading-bar').show();

                $.ajax({
                    url: '/order/generate-cvs',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        LogisticsType: (self.itemShowed.shippingMethod === 'cvs') ? 'CVS' : 'Home',
                        LogisticsSubType: (self.itemShowed.shippingMethod === 'cvs') ? self.itemShowed.shippingTarget.LogisticsSubType : 'TCAT',
                        ReceiverPort: (self.itemShowed.shippingMethod !== 'cvs') ? self.itemShowed.shippingTarget.ReceiverPort : '',
                        Temperature: temp,
                        ReceiverAddress: (self.itemShowed.shippingMethod !== 'cvs') ? self.itemShowed.shippingTarget.ReceiverCity + self.itemShowed.shippingTarget.ReceiverAddress : '',
                        TotalAmount: self.itemShowed.amount,
                        guid: self.itemShowed.guid,
                        ReceiverName: self.itemShowed.shippingTarget.ReceiverName,
                        ReceiverCellPhone: self.itemShowed.shippingTarget.ReceiverCellPhone,
                        ReceiverEmail: 'vincent7697@gmail.com',
                        CVSStoreID: self.itemShowed.shippingTarget.CVSStoreID,
                        Remark: self.itemShowed.remarks,
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function(response) {
                    if (response.RtnCode === '300') {
                        self.itemShowed.status = 'shippingGenerated';
                        self.itemShowed.shippingTarget.MerchantID = response.MerchantID;
                        self.itemShowed.shippingTarget.AllPayLogisticsID = response.AllPayLogisticsID;
                        self.itemShowed.shippingTarget.CVSPaymentNo = response.CVSPaymentNo;
                        self.itemShowed.shippingTarget.CVSValidationNo = response.CVSValidationNo;

                        self.orderList.forEach(function (item) {
                            if (item.guid === self.itemShowed.guid) {
                                item.status = 'shippingGenerated';
                                item.shippingTarget.MerchantID = response.MerchantID;
                                item.shippingTarget.AllPayLogisticsID = response.AllPayLogisticsID;
                                item.shippingTarget.CVSPaymentNo = response.CVSPaymentNo;
                                item.shippingTarget.CVSValidationNo = response.CVSValidationNo;
                            }
                        });


                    }
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    $('.loading-bar').hide();
                    console.log("complete");
                });

            },
            modifyOrderRemark() {
                let self = this

                axios.post('/order/updateRemark', {
                    guid: self.itemShowed.guid,
                    remarks: self.itemShowed.remarks
                }).then(res => {
                    self.$message.success('更新備註成功')
                    self.itemShowed.remarkModify = false
                    self.getOrders('/order/get/' + self.orderStatus);
                }).catch(err => {
                    self.$message.error('更新備註失敗')
                }).then(arg => {
                    
                })
            },
            modifyOrderStatus: function () {
                var self = this;
                var token = this.token;
                var checkModify = self.itemShowed.orderStatus == 'canceled' ? confirm('訂單狀態變更後將無法再次改變，請確認。\n\n是否要繼續?') : true

                if (!checkModify) {
                    return
                }

                $('.loading-bar').fadeIn('100');

                $.ajax({
                    url: '/order/updateStatus',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        guid: self.itemShowed.guid,
                        orderStatus: self.itemShowed.orderStatus,
                        paymentStatus: self.itemShowed.paymentStatus,
                        owner: self.itemShowed.owner
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function(response) {
                    console.log(response);
                    self.getOrders('/order/get/' + self.orderStatus);
                    $('#detail-modal').modal('hide');
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    $('.loading-bar').fadeOut('100');
                    console.log("complete");
                });

            },
            generateSheet: function () {
                var self = this;
                var token = this.token;

                $('.loading-bar').show();

                $.ajax({
                    url: '/order/generate-sheet',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        LogisticsSubType: (self.itemShowed.shippingMethod !== 'cvs') ? 'Home' : self.itemShowed.shippingTarget.LogisticsSubType,
                        MerchantID: self.itemShowed.shippingTarget.MerchantID,
                        AllPayLogisticsID: self.itemShowed.shippingTarget.AllPayLogisticsID,
                        CVSPaymentNo: self.itemShowed.shippingTarget.CVSPaymentNo,
                        CVSValidationNo: self.itemShowed.shippingTarget.CVSValidationNo
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function(response) {
                })
                .fail(function(xhr, status, error) {
                    var ifrm = document.createElement("iframe");

                    ifrm.id = 'sheet-iframe';
                    ifrm.style.width = "100%";
                    ifrm.style.height = "200px";
                    ifrm.style.border = "0";

                    document.getElementById('sheet-frame-container').appendChild(ifrm);
                    document.getElementById('sheet-iframe').contentDocument.write(xhr.responseText);
                    $('#sheet-modal').modal('show');

                    $('body').on('click', function () {
                        $('#sheet-iframe').remove();
                    });
                })
                .always(function() {
                    $('.loading-bar').hide();
                    console.log("complete");
                });
            },
            printAddress() {
                $('#ready-to-print').print()
            },
            nextPage: function () {
                this.getOrders(this.next_page_url);
            },
            prevPage: function () {
                this.getOrders(this.prev_page_url);
            },
            gotoPage: function (item) {
                this.getOrders(`/order/get/${this.orderStatus}?page=${item.pageNumber}`);
            },
            breakLine(str) {
                return str.replace(/\n/g,"<br />")
            }
        }
    }
</script>

<style lang="scss" scoped>
.remark-info {
    width: 480px;
    max-height: 300px;
    overflow: auto;
    margin-bottom: 10px;
}
</style>
