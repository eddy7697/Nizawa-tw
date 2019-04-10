<template>
    <div class="row">
        <form v-on:submit.prevent="createOrder">
            <div class="col-md-7">
                <div class="shipping-form">
                    <h4>商品寄送資訊</h4>
                    <hr>
                    <div class="row" v-if="useUserInfo">
                        <div class="col-md-6">
                            <div class="form-row">
                                <label for="shipping-name">收件人姓名 *</label>
                                <strong v-if="!formValidation.ReceiverName" style="color: #600000">&nbsp;&nbsp;此欄位為必填 *</strong>
                                <input class="form-control" type="text" id="shipping-name" placeholder="" v-model="customerParametor.ReceiverName" required>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shipping-phone">收件人行動電話 *</label>
                                <strong v-if="!formValidation.ReceiverCellPhone" style="color: #600000">&nbsp;&nbsp;此欄位為必填 *</strong>
                                <input class="form-control" type="text" id="shipping-phone" placeholder="" v-model="customerParametor.ReceiverCellPhone" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="shipping-email">收件人電子郵件 *</label>
                                <strong v-if="!formValidation.ReceiverEmail" style="color: #600000">&nbsp;&nbsp;此欄位為必填 *</strong>
                                <input class="form-control" type="email" id="shipping-email" placeholder="" v-model="customerParametor.ReceiverEmail" required>
                            </div>
                        </div>
                    </div>
                    <div class="row" v-else>
                        <div class="col-md-6">
                            <div class="form-row">
                                <label for="shipping-name">收件人姓名 *</label>
                                <strong v-if="!formValidation.ReceiverName" style="color: #600000">&nbsp;&nbsp;此欄位為必填 *</strong>
                                <input class="form-control" type="text" id="shipping-name" placeholder="" v-model="customerParametorForShipping.ReceiverName" required>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shipping-phone">收件人行動電話 *</label>
                                <strong v-if="!formValidation.ReceiverCellPhone" style="color: #600000">&nbsp;&nbsp;此欄位為必填 *</strong>
                                <input class="form-control" type="text" id="shipping-phone" placeholder="" v-model="customerParametorForShipping.ReceiverCellPhone" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="shipping-email">收件人電子郵件 *</label>
                                <strong v-if="!formValidation.ReceiverEmail" style="color: #600000">&nbsp;&nbsp;此欄位為必填 *</strong>
                                <input class="form-control" type="email" id="shipping-email" placeholder="" v-model="customerParametorForShipping.ReceiverEmail" required>
                            </div>
                        </div>
                    </div>

                    <div class="row" v-if="shippingMethod == 'delivery' && useUserInfo">
                        <hr>
                        <!-- <div class="col-md-6">
                            <div class="form-row">
                                <label for="shipping-city">縣市 *</label>
                                <strong v-if="!formValidation.ReceiverCity" style="color: #600000">&nbsp;&nbsp;此欄位為必填 *</strong>
                                <input class="form-control" type="text" id="shipping-city" placeholder="" v-model="customerParametor.ReceiverCity" required>
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shipping-port">郵遞區號 *</label>&nbsp;&nbsp;
                                <a target="_blank" href="https://www.post.gov.tw/post/internet/SearchZone/index.jsp?ID=130107">郵遞區號查詢</a>
                                <strong v-if="!formValidation.ReceiverPort" style="color: #600000">&nbsp;&nbsp;此欄位為必填 *</strong>
                                <input class="form-control" type="text" id="shipping-port" placeholder="" v-model="customerParametor.ReceiverPort" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="shipping-address">地址 *</label>
                                <strong v-if="!formValidation.ReceiverAddress" style="color: #600000">&nbsp;&nbsp;此欄位為必填 *</strong>
                                <input class="form-control" type="text" id="shipping-address" placeholder="" v-model="customerParametor.ReceiverAddress" required>
                            </div>
                        </div>
                    </div>
                    <div class="row" v-if="shippingMethod == 'delivery' && !useUserInfo">
                        <hr>
                        <!-- <div class="col-md-6">
                            <div class="form-row">
                                <label for="shipping-city">縣市 *</label>
                                <strong v-if="!formValidation.ReceiverCity" style="color: #600000">&nbsp;&nbsp;此欄位為必填 *</strong>
                                <input class="form-control" type="text" id="shipping-city" placeholder="" v-model="customerParametorForShipping.ReceiverCity" required>
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shipping-port">郵遞區號 *</label>&nbsp;&nbsp;
                                <a target="_blank" href="https://www.post.gov.tw/post/internet/SearchZone/index.jsp?ID=130107">郵遞區號查詢</a>
                                <strong v-if="!formValidation.ReceiverPort" style="color: #600000">&nbsp;&nbsp;此欄位為必填 *</strong>
                                <input class="form-control" type="text" id="shipping-port" placeholder="" v-model="customerParametorForShipping.ReceiverPort" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="shipping-address">地址 *</label>
                                <strong v-if="!formValidation.ReceiverAddress" style="color: #600000">&nbsp;&nbsp;此欄位為必填 *</strong>
                                <input class="form-control" type="text" id="shipping-address" placeholder="" v-model="customerParametorForShipping.ReceiverAddress" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" v-if="isAuth">
                        <input v-if="dontUseUserInfo" type="checkbox" id="use-user-info" v-model="useUserInfo">
                        <label v-if="dontUseUserInfo" for="use-user-info">代入會員資料</label>
                        <input v-if="useUserInfo" type="checkbox" id="dont-use-user-info" v-model="dontUseUserInfo">
                        <label v-if="useUserInfo" for="dont-use-user-info">這不是我的收件資訊</label>
                    </div>
                    <hr>
                    <div class="form-group" v-if="paymentMethod == 'Remit'">
                        <!-- <label for="shipping-city">匯款帳號末五碼</label>
                        <input class="form-control" type="text" id="shipping-city" placeholder="" v-model="customerParametor.ReceiverCity" required> -->
                        <label for="last-five-char">匯款帳號末五碼</label>
                        <el-popover
                            placement="top-start"
                            title="匯款帳號末五碼"
                            width="200"
                            trigger="hover"
                            content="預先填入此欄位，可加速您選用轉帳付款的後續驗證流程。">
                            <el-button slot="reference" class="tooltip-btn">
                                <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                            </el-button>
                        </el-popover>
                        <input class="form-control" type="text" id="last-five-char" placeholder="" v-model="LastFiveChar">
                    </div>
                    <div class="form-group">
                        <label for="shipping-note">訂單備註</label>
                        <textarea style="resize: vertical; min-height: 100px" class="form-control" name="name" id="shipping-note" v-model="customerParametor.remarks"></textarea>
                    </div>
                    <hr>
                    <div v-if="!isAuth" class="form-group">
                        <input type="checkbox" id="check-add-user" placeholder="" v-model="addNewMember">
                        <label for="check-add-user">非會員申請加入會員</label>
                    </div>
                    <div v-if="!isAuth && addNewMember" class="form-group">
                        <p>您輸入的Email即為帳號名稱，請在下方設定密碼，立即完成您的帳號建立。如果您已經建立過帳號，可直接在網頁上方登入。</p>
                        <label for="new-member-password">設定密碼 *</label>
                        <input class="form-control" type="password" id="new-member-password" placeholder="" v-model="customerParametor.newMemberPassword" required>
                    </div>
                </div>
                <br>
                <h4>三聯式發票資訊</h4>
                <p>您的發票會與訂單一併寄出，若您需要索取三聯式發票，請於下方欄位輸入即可。</p>
                <hr>
                <div class="form-group">
                    <label for="shipping-receipt">發票抬頭</label>
                    <input class="form-control" type="text" id="shipping-receipt" placeholder="" v-model="customerParametor.receipt">
                </div>
                <div class="form-group">
                    <label for="shipping-taxid">統一編號</label>
                    <input class="form-control" type="text" id="shipping-taxid" placeholder="" v-model="customerParametor.taxId">
                </div>
            </div>
            <div class="col-md-5 checkout-method">
                <h4>訂單資訊</h4>
                <hr>
                <div class="payment-gateway">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>商品</th>
                                <th style="text-align: right; min-width:50px;">價格</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in cart" v-bind:key="index">
                                <td>{{item.id.title}} x {{item.qty}}</td>
                                <td style="text-align: right; min-width:50px;">NT$ {{item.total}}</td>
                            </tr>
                            <tr>
                                <td>小計</td>
                                <td style="text-align: right; min-width:50px;">NT$ {{amountString}}</td>
                            </tr>
                            <tr>
                                <td>運送方式</td>
                                <td>
                                    <ul class="shipping-method-list">
                                        <li v-for="(item, index) in methodsTranslate" v-bind:key="index">
                                            <input style="width: initial" type="radio" name="shipping-method" v-bind:id="item.shippingType + item.shippingTemperature + item.id" v-bind:value="item.id" v-model="shippingTag">

                                            <label
                                                v-if="item.freeShipping && (amount >= item.freeShippingMininum)"
                                                v-bind:for="item.shippingType + item.shippingTemperature + item.id">{{item.shippingTitle}} 滿額免運</label>
                                            <label
                                                v-else
                                                v-bind:for="item.shippingType + item.shippingTemperature + item.id">{{item.shippingTitle}} NT$ {{item.shippingPrice}}</label>
                                            <div v-if="amount < item.freeShippingMininum && shippingTag === item.id">
                                                購物滿 {{item.freeShippingMininum}} 元即可享有免運費的優惠唷！
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <!-- <tr v-if="owner !== 'guest'">
                                <td>購物金使用：剩餘 {{point}}元</td>
                                <td align="right">
                                    <div class="form-group" style="width:125px">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button" @click="changePointUse('down')"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                            </span>
                                            <input type="number" id="point-input" class="form-control" style="text-align: center; padding: 0px 10px;"
                                                v-model="pointUsage"
                                                v-bind:class="{ 'has-error': (pointUsage > point) }"
                                                :blur="pointInputValid()"
                                                min="0">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button" @click="changePointUse('up')"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr> -->
                            <tr v-if="shippingMethod == 'cvs'">
                                <td colspan="2">
                                    <div class="form-group">
                                        <strong>配送門市選擇 *</strong>
                                        <br>
                                        <span class="cvs-btn mg-icon mg-icon-cvs-7-11" @click="chooseCvs('UNIMARTC2C')"></span>
                                        <span class="cvs-btn mg-icon mg-icon-cvs-familymart" @click="chooseCvs('FAMIC2C')"></span>
                                        <span class="cvs-btn mg-icon mg-icon-cvs-hilife" @click="chooseCvs('HILIFEC2C')"></span>
                                        <span class="form-control">{{cvsParametor.CVSStoreName}}</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>總計</strong></td>
                                <td style="text-align: right; min-width:50px;">NT$ {{(finalAmount - pointUsage) + parseInt(shippingCosts)}}</td>
                            </tr>
                            <!-- <tr v-if="owner == 'guest'">
                                <td colspan="2">
                                    <br>
                                    <strong><a href="/register">加入會員即可獲得購物金50元，並享有購物金額10%紅利累積回饋</a></strong>
                                </td>
                            </tr>
                            <tr v-else>
                                <td>
                                    <strong>可累計購物金</strong>
                                </td>
                                <td style="text-align: right; min-width:50px;">
                                    {{Math.ceil(((parseInt(finalAmount) - parseInt(pointUsage))) * (parseInt(percentage) / 100)) }} 元
                                </td>
                            </tr> -->
                            <!-- <tr>
                                <td colspan="2">有優惠券嗎? <a @click="typeCoupon()" style="cursor: pointer">點我輸入優惠碼</a></td>
                            </tr> -->
                            <tr v-if="isCouponFieldShow">
                                <td colspan="2">
                                    <input style="margin-bottom: 10px;" type="text" class="form-control" id="coupon-field" v-model="couponNumber" placeholder="優惠券號碼">
                                    <a class="btn btn-primary btn-block" @click="useCoupon()">使用優惠券</a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="col-md-12" v-if="shippingMethod == 'cvs'">

                </div>
                <h4>付款方式</h4>
                <hr>
                <div class="payment-methods">
                    <div class="form-group" v-if="shippingMethod == 'cvs'">
                        <label for="payment-cod">
                            <input type="radio" id="payment-cod" name="payment-method-option" value="cod" v-model="paymentMethod">
                            <strong>貨到付款</strong>
                            <div v-if="paymentMethod == 'cod'">
                                <p>貨到付款，若運送方式為超商取貨的話，付款方式即為到店取貨付款。</p>
                            </div>
                        </label>
                    </div>
                    <!-- <div class="form-group">
                        <label for="payment-ATM">
                            <input type="radio" id="payment-ATM" name="payment-method-option" value="ATM" v-model="paymentMethod">
                            <strong>ATM轉帳付款</strong>
                            <div v-if="paymentMethod == 'ATM'">
                                <p>提供線上或者實體ATM轉帳付款的服務，確認付款完成後將會進行後續出貨的動作。</p>
                            </div>
                        </label>
                    </div> -->
                    <div class="form-group">
                        <label for="payment-Credit">
                            <input type="radio" id="payment-Credit" name="payment-method-option" value="Credit" v-model="paymentMethod" style="width: initial">
                            <strong>信用卡付款</strong>
                            <div v-if="paymentMethod == 'Credit'">
                                <p>提供線上刷卡的服務，確認付款完成後將會進行後續出貨的動作。</p>
                            </div>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="payment-Remit">
                            <input type="radio" id="payment-Remit" name="payment-method-option" value="Remit" v-model="paymentMethod" style="width: initial">
                            <strong>轉帳付款</strong>
                            <div v-if="paymentMethod == 'Remit'">
                                <p>提供轉帳付款的服務，確認付款完成後將會進行後續出貨的動作。</p>
                            </div>
                        </label>
                    </div>
                </div>
                <button type="submit" v-if="(paymentMethod == 'cod') && (shippingMethod == 'cvs')" class="btn btn-primary btn-lg btn-block" name="button">超商取貨付款</button>
                <button type="submit" v-if="(shippingMethod == 'cvs') && (paymentMethod !== 'cod')" class="btn btn-primary btn-lg btn-block" name="button">超商取貨</button>
                <button type="submit" v-if="shippingMethod !== 'cvs'" class="btn btn-primary btn-lg btn-block" name="button">確認購買</button>
            </div>
        </form>
        <el-dialog
            title="反詐騙提醒"
            :visible.sync="antiFraudNoticeVisible"
            width="30%"
            center>
            <div id="anti-fraud-notice" ref="antiFraudNotice" v-html="antiFraudNoticeInfo">
            </div>
            
            <span slot="footer" class="dialog-footer">
                <el-button @click="closeAntiFraudNotice()">取 消</el-button>
                <el-button type="primary" @click="checkAntiFraudNotice()">確 認</el-button>
            </span>
        </el-dialog>

    </div>
</template>

<script>
    import ElementUI from 'element-ui';
    import 'element-ui/lib/theme-chalk/index.css';
    import lang from 'element-ui/lib/locale/lang/zh-TW'
    import locale from 'element-ui/lib/locale'

    Vue.use(ElementUI);
    locale.use(lang)

    
    $('.loading-bar').fadeOut('100');
    export default {
        data() {
            return {
                token: $('meta[name="csrf-token"]').attr('content'),
                // shippingMethod: $('#shipping_method').val(),
                // shippingCosts: 60,
                amount: null,
                // amountString: null,
                shippingTag: $('#shipping_method').val(),
                paymentMethod: 'Credit',
                point: null,
                useUserInfo: true,
                dontUseUserInfo: false,
                percentage: 0,
                pointUsage: 0,
                owner: null,
                isCouponFieldShow: false,
                isCouponUse: false,
                discountType: '',
                couponAmount: null,
                Temperature: null,
                cart: [],
                LastFiveChar: '',
                antiFraudNoticeVisible: false,
                couponNumber: '',
                shippingMethods: [],
                customerParametor: {
                    ReceiverName: '',
                    ReceiverCellPhone: '',
                    ReceiverEmail: '',
                    ReceiverCity: '',
                    ReceiverPort: '',
                    ReceiverAddress: '',
                    remarks: '',
                    newMemberPassword: '',
                    receipt: '',
                    taxId: '',
                },
                customerParametorForShipping: {
                    ReceiverName: '',
                    ReceiverCellPhone: '',
                    ReceiverEmail: '',
                    ReceiverCity: '',
                    ReceiverPort: '',
                    ReceiverAddress: '',
                    remarks: '',
                    newMemberPassword: '',
                    receipt: '',
                    taxId: '',
                },
                formValidation: {
                    ReceiverName: true,
                    ReceiverCellPhone: true,
                    ReceiverEmail: true,
                    ReceiverPort: true,
                    ReceiverCity: true,
                    ReceiverAddress: true
                },
                cvsParametor: {
                    MerchantTradeNo: null,
                    LogisticsSubType: '',
                    CVSStoreID: '',
                    CVSStoreName: null,
                    CVSAddress: null,
                    CVSTelephone: null
                },
                usedCouponContent: {
					discountType: 'NONE',
					couponAmount: 0
                },
                antiFraudNoticeInfo: document.getElementById('anti-fraud-notice-info').innerHTML,
                antiFraudCheck: false,
                isAuth: false,
                isAllow: true,
                addNewMember: false
            }
        },
        created: function () {
            var self = this;
            var token = this.token;

            var checkAuthPromise = new Promise(function (resolve, reject) {
                $.ajax({
                    url: '/checkAuth',
                    type: 'POST',
                    cache: false,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function(response) {
                    resolve(response);
                })
                .fail(function(error) {
                    reject(error);
                });
            });

            var getShippingMethodPromise = new Promise(function (resolve, reject) {
                $.ajax({
                    url: '/shipping/get',
                    type: 'GET',
                    cache: false,
                    dataType: 'json',
                })
                .done(function(response) {
                    resolve(response.data);
                })
                .fail(function(error) {
                    reject(error);
                });

            });

            var getCartContentPromise = new Promise(function (resolve, reject) {
                $.ajax({
                    url: '/cart/get',
                    type: 'GET',
                    cache: false,
                    dataType: 'json'
                })
                .done(function(response) {
                    resolve(response);
                })
                .fail(function(error) {
                    reject(error);
                });
            });

            var checkCartTempPromise = new Promise(function (resolve, reject) {
                $.ajax({
                    url: '/cart/checkTemp',
                    type: 'GET',
                    cache: false,
                    dataType: 'json'
                })
                .done(function(response) {
                    resolve(response);
                })
                .fail(function(error) {
                    reject(error);
                });

            });

            Promise.all([
                checkAuthPromise,
                getShippingMethodPromise,
                getCartContentPromise,
                checkCartTempPromise
            ]).then(function (results) {
                var authStatus = results[0];
                var shippingMethods = results[1];
                var cartContent = results[2];
                var cartTemp = results[3];

                // 確認登入狀態
                self.isAuth = authStatus.auth;

                if (authStatus.auth) {
                    self.getPoint();
                } else {
                    self.point = 0;
                    self.owner = 'guest';
                }

                // 區分訂單溫層
                self.Temperature = cartTemp.Temperature;

                shippingMethods.forEach(function (item) {
                    if (item.shippingTemperature === cartTemp.Temperature) {
                        self.shippingMethods.push(item);
                    }
                });

                self.amount = parseInt(cartContent.amount.replace(/,/g, ''));
                // self.amountString = cartContent.amount;

                if (cartContent.cart.length === 0) {
                    window.location.href = '/';
                }

                cartContent.cart.forEach(function (item) {
                    self.cart.push({
                        id: item.id,
                        Name: item.id.title,
                        price: item.price,
                        qty: item.qty,
                        rowId: item.rowId,
                        total: item.total
                    });
                });

                if (typeof(localStorage.logistic_cache) === 'undefined') {
                    console.log('no set');
                } else {
                    // 寫入暫存的超商資訊，帶訂單送出後，移除暫存
                    var cvs = JSON.parse(localStorage.logistic_cache);
                    var shop;

                    switch (cvs.LogisticsSubType) {
                        case 'FAMIC2C':
                            shop = '全家店到店 - ';
                            break;
                        case 'UNIMARTC2C':
                            shop = '7-11 店到店 - ';
                            break;
                        case 'HILIFEC2C':
                            shop = '萊爾富店到店 - ';
                            break;
                        default:

                    }
                    self.cvsParametor.MerchantTradeNo = cvs.MerchantTradeNo;
                    self.cvsParametor.LogisticsSubType = cvs.LogisticsSubType;
                    self.cvsParametor.CVSStoreID = cvs.CVSStoreID;
                    self.cvsParametor.CVSStoreName = shop + cvs.CVSStoreName;
                    self.cvsParametor.CVSAddress = cvs.CVSAddress;
                    self.cvsParametor.CVSTelephone = cvs.CVSTelephone;

                }

            });
        },
        watch: {
            dontUseUserInfo: {
                handler(dontUseUserInfo, oldVal) {
                    this.useUserInfo = !dontUseUserInfo
                }
            },
            useUserInfo: {
                handler(useUserInfo, oldVal) {
                    this.dontUseUserInfo = !useUserInfo
                }
            }
        },
        computed: {
            shippingCosts: function () {
                var self = this;

                var shippingPrice = 0;

                this.methodsTranslate.forEach(function (item) {
                    if (self.shippingTag == item.id) {
                        if (item.freeShipping && (self.amount >= item.freeShippingMininum)) {
                            // console.log(item);
                            shippingPrice = 0;
                        } else {
                            shippingPrice = item.shippingPrice;
                        }
                    }
                });

                return shippingPrice;
            },
            shippingMethod: function () {
                var self = this;

                var shippingMethod = 'delivery';

                this.shippingMethods.forEach(function (item) {
                    if (self.shippingTag == item.id) {
                        shippingMethod = item.shippingType;
                    }
                });

                return shippingMethod;
            },
            methodsTranslate: function () {
                var shippingMethods = this.shippingMethods;
                var cache = [];

                shippingMethods.forEach(function (item) {
                    cache.push({
                        freeShipping: (item.freeShipping == 1) ? true : false,
                        freeShippingMininum: item.freeShippingMininum,
                        id: item.id,
                        shippingPrice: item.shippingPrice,
                        shippingTemperature: item.shippingTemperature,
                        shippingTitle: item.shippingTitle,
                        shippingType: item.shippingType
                    });
                });
                return cache;
            },
            finalAmount: function () {
                var isCouponUse = this.isCouponUse;
                var discountType = this.discountType;
                var couponAmount = this.couponAmount;
                var amount;

                if (isCouponUse) {
                    switch (discountType) {
                        case 'percentage':
                            amount = this.amount - (this.amount / couponAmount);
                            break;
                        case 'cartDiscount':
                            amount = this.amount - couponAmount;
                            break;
                        default:

                    }
                    // amount = this.amount;
                } else {
                    amount = this.amount;
                }

                return Math.ceil(amount);
            },
            amountString: function () {
                var finalAmount = parseInt(this.finalAmount);

                return finalAmount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        },
        methods: {
            getAddress: function () {
                var self = this;

                $.ajax({
                    url: '/getAddress/' + self.owner,
                    type: 'GET',
                    dataType: 'json'
                })
                .done(function(response) {
                    let shippingAddr = localStorage.getItem('shipping_address')

                    self.customerParametor.ReceiverName = response.fullName;
                    self.customerParametor.ReceiverCellPhone = response.cellPhone;
                    // self.customerParametor.ReceiverEmail = response.email;
                    self.customerParametor.ReceiverCity = response.city;
                    self.customerParametor.ReceiverPort = response.postcode;
                    self.customerParametor.ReceiverAddress = response.address;

                    if (shippingAddr) {
                        let shippingAddress = JSON.parse(shippingAddr)
                        self.customerParametorForShipping.ReceiverName = shippingAddress.ReceiverName;
                        self.customerParametorForShipping.ReceiverCellPhone = shippingAddress.ReceiverCellPhone;
                        self.customerParametorForShipping.ReceiverEmail = shippingAddress.ReceiverEmail;
                        self.customerParametorForShipping.ReceiverCity = shippingAddress.ReceiverCity;
                        self.customerParametorForShipping.ReceiverPort = shippingAddress.ReceiverPort;
                        self.customerParametorForShipping.ReceiverAddress = shippingAddress.ReceiverAddress;
                    }

                })
                .fail(function() {
                })
                .always(function() {
                });

            },
            getPoint: function () {
                var self = this;

                $.ajax({
                    url: '/checkout/getPoint',
                    type: 'GET',
                    dataType: 'json'
                })
                .done(function(response) {
                    self.point = response.data.point;
                    self.percentage = response.data.percentage;
                    self.owner = response.data.guid;
                    self.customerParametor.ReceiverEmail = response.data.email;

                    // console.log(response);
                    self.getAddress();
                    $('#point-input').attr('max', response.data.point);
                })
                .fail(function(error) {
                    var status = error.status;

                    if (status === 401) {
                        self.point = 0;
                        self.percentage = 0;
                        self.owner = 'guest';
                    }
                })
                .always(function() {
                });
            },
            closeAntiFraudNotice() {
                this.antiFraudCheck = false
                this.antiFraudNoticeVisible = false
            },
            checkAntiFraudNotice() {
                this.antiFraudNoticeVisible = false
                this.createOrder()
            },
            createOrder: function () {
                var self = this;
                var emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
                var method;

                // return console.log(this.usedCouponContent);

                if ((this.paymentMethod == 'cod') && (this.shippingMethod == 'cvs')) {
                    method = 'cvsCod';
                } else if ((this.shippingMethod == 'cvs') && (this.paymentMethod !== 'cod')) {
                    method = 'cvs';
                } else if (this.shippingMethod !== 'cvs') {
                    method = 'aoi';
                }


                if (this.customerParametor.taxId.length > 0) {
                    if (this.customerParametor.taxId.length !== 8) {
                        return this.showMessage('warning', '統一編號錯誤');
                    }
                }

                // this.validateForm();

                if (!Number.isInteger(parseInt(this.customerParametor.ReceiverCellPhone)) ||
                    (this.customerParametor.ReceiverCellPhone.length < 10) ||
                    (this.customerParametor.ReceiverCellPhone.length > 10)) {
                    this.showMessage('warning', '請確認行動電話格式正確。');
                    return;
                }

                // return console.log(emailRule.test(this.customerParametor.ReceiverEmail));
                if (!emailRule.test(this.customerParametor.ReceiverEmail)) {
                    this.showMessage('warning', '請確認電子郵件格式正確。');
                    return;
                }

                if (!this.isAllow) {
                    this.showMessage('warning', '請確認運送資訊填寫是否完整。');
                    return;
                }

                if (!this.antiFraudCheck) {
                    this.antiFraudNoticeVisible = true

                    setTimeout(() => {
                        const notice = self.$refs.antiFraudNotice

                        notice.scrollTop = 0
                        self.antiFraudCheck = true
                        // notice.addEventListener('scroll', () => {
                        //     if ((notice.scrollTop + 400) > notice.scrollHeight) {
                        //         self.antiFraudCheck = true
                        //     }
                        // })
                    }, 200)
                    return
                }

                // this.antiFraudNoticeVisible = true

                switch (method) {
                    case 'cvsCod':      // 超商取貨付款
                        this.cvsCod();
                        break;
                    case 'cvs':         // 超商純取貨
                        this.aoiMethod();
                        break;
                    case 'aoi':         //All in one
                        this.aoiMethod();
                        break;
                    default:

                }
            },
            aoiMethod: function () {
                if ((this.paymentMethod === 'cod') || (this.paymentMethod === null)) {
                    alert('請選擇付款方式');
                    return;
                }
                var self = this;
                var form = document.createElement("form");
                var _token = document.createElement("input");
                var ChoosePayment = document.createElement("input");
                var TotalAmount = document.createElement("input");
                var cartInfo = document.createElement("textArea");
                var pointUsage = document.createElement("input");
                var owner = document.createElement("input");
                var shippingMethod = document.createElement("input");
                var shippingCosts = document.createElement("input");
                var shippingTarget = document.createElement("textArea");
                var addNewMember = document.createElement("input");
                var password = document.createElement("input");
                var Temperature = document.createElement("input");
                var taxId = document.createElement("input");
                var receipt = document.createElement("input");
                var pointCount = document.createElement("input");
                var useUserInfo = document.createElement("input");
                var Remark = document.createElement("textArea");
                var usedCoupon = document.createElement("textArea");
                var shippingObject = {}

                // 目前累計點數的倍率
                var pointMag = parseInt(this.percentage) / 100;
                var amountLessPoint = parseInt(this.amount) - parseInt(this.pointUsage);


                // form.id = "checkout-form";

                _token.setAttribute("type", "hidden");

                form.method = "POST";
                form.action = "/order-payment";

                _token.value = this.token;
                _token.name = "_token";
                form.appendChild(_token);

                pointCount.value = Math.ceil(pointMag * amountLessPoint);
                pointCount.name = "pointCount";
                form.appendChild(pointCount);

                taxId.value = this.customerParametor.taxId;
                taxId.name = "taxId";
                form.appendChild(taxId);

                receipt.value = this.customerParametor.receipt;
                receipt.name = "receipt";
                form.appendChild(receipt);

                useUserInfo.value = this.useUserInfo ? 'true' : 'false';
                useUserInfo.name = "useUserInfo";
                form.appendChild(useUserInfo);

                ChoosePayment.value = this.paymentMethod;
                ChoosePayment.name = "ChoosePayment";
                form.appendChild(ChoosePayment);

                Temperature.value = this.Temperature;
                Temperature.name = "Temperature";
                form.appendChild(Temperature);

                pointUsage.value = this.pointUsage;
                pointUsage.name = "pointUsage";
                form.appendChild(pointUsage);

                owner.value = this.owner;
                owner.name = "owner";
                form.appendChild(owner);

                // TotalAmount.value = (this.amount - this.pointUsage) + this.shippingCosts;
                TotalAmount.value = this.finalAmount;
                TotalAmount.name = "TotalAmount";
                form.appendChild(TotalAmount);

                cartInfo.value = JSON.stringify(this.cart);
                cartInfo.name = "cartInfo";
                form.appendChild(cartInfo);

                shippingMethod.value = this.shippingMethod;
                shippingMethod.name = "shippingMethod";
                form.appendChild(shippingMethod);

                shippingCosts.value = this.shippingCosts;
                shippingCosts.name = "shippingCosts";
                form.appendChild(shippingCosts);

                Remark.value = this.customerParametor.remarks;
                Remark.name = "Remark";
                form.appendChild(Remark);

                if (this.usedCouponContent) {
                    usedCoupon.value = JSON.stringify(this.usedCouponContent);
                    usedCoupon.name = "usedCoupon";
                    form.appendChild(usedCoupon);
                }

                if (this.shippingMethod === 'cvs') {
                    if (this.cvsParametor.MerchantTradeNo === null) {
                        alert('請先選擇取貨超商。')
                        return
                    }

                    if (this.useUserInfo) {
                        shippingObject = {
                            MerchantTradeNo: this.cvsParametor.MerchantTradeNo,
                            LogisticsSubType: this.cvsParametor.LogisticsSubType,
                            CVSStoreID: this.cvsParametor.CVSStoreID,
                            CVSStoreName: this.cvsParametor.CVSStoreName,
                            CVSAddress: this.cvsParametor.CVSAddress,
                            CVSTelephone: this.cvsParametor.CVSTelephone,
                            ReceiverName: this.customerParametor.ReceiverName,
                            ReceiverCellPhone: this.customerParametor.ReceiverCellPhone,
                            ReceiverEmail: this.customerParametor.ReceiverEmail
                        }
                    } else {
                        shippingObject = {
                            MerchantTradeNo: this.cvsParametor.MerchantTradeNo,
                            LogisticsSubType: this.cvsParametor.LogisticsSubType,
                            CVSStoreID: this.cvsParametor.CVSStoreID,
                            CVSStoreName: this.cvsParametor.CVSStoreName,
                            CVSAddress: this.cvsParametor.CVSAddress,
                            CVSTelephone: this.cvsParametor.CVSTelephone,
                            ReceiverName: this.customerParametorForShipping.ReceiverName,
                            ReceiverCellPhone: this.customerParametorForShipping.ReceiverCellPhone,
                            ReceiverEmail: this.customerParametorForShipping.ReceiverEmail
                        }
                    }
                } else {

                    if (this.useUserInfo) {
                        shippingObject = {
                            ReceiverName: this.customerParametor.ReceiverName,
                            ReceiverCellPhone: this.customerParametor.ReceiverCellPhone,
                            ReceiverEmail: this.customerParametor.ReceiverEmail,
                            ReceiverCity: this.customerParametor.ReceiverCity,
                            ReceiverPort: this.customerParametor.ReceiverPort,
                            ReceiverAddress: this.customerParametor.ReceiverAddress,
                            ReceiverEmail: this.customerParametor.ReceiverEmail
                        }
                    } else {
                        shippingObject = {
                            ReceiverName: this.customerParametorForShipping.ReceiverName,
                            ReceiverCellPhone: this.customerParametorForShipping.ReceiverCellPhone,
                            ReceiverEmail: this.customerParametorForShipping.ReceiverEmail,
                            ReceiverCity: this.customerParametorForShipping.ReceiverCity,
                            ReceiverPort: this.customerParametorForShipping.ReceiverPort,
                            ReceiverAddress: this.customerParametorForShipping.ReceiverAddress,
                            ReceiverEmail: this.customerParametorForShipping.ReceiverEmail
                        }
                    }
                }

                if (this.paymentMethod == 'Remit') {
                    shippingObject.LastFiveChar = this.LastFiveChar
                }

                shippingTarget.value = JSON.stringify(shippingObject)
                shippingTarget.name = "shippingTarget"
                form.appendChild(shippingTarget)

                addNewMember.value = this.addNewMember;
                addNewMember.name = "addNewMember";
                form.appendChild(addNewMember);

                password.value = this.customerParametor.newMemberPassword;
                password.name = "password";
                form.appendChild(password);

                document.body.appendChild(form);

                // 移除暫存的超商資訊
                localStorage.removeItem('logistic_cache');
                localStorage.setItem('shipping_address', JSON.stringify(this.customerParametorForShipping))
                // console.log(form)
                // return;
                
                form.submit();
                $('.loading-bar').fadeIn('100');
            },
            cvsCod: function () {
                var self = this;
                var form = document.createElement("form");
                var LogisticsSubType = document.createElement("input");
                var ReceiverName = document.createElement("input");
                var ReceiverCellPhone = document.createElement("input");
                var ReceiverEmail = document.createElement("input");
                var ChoosePayment = document.createElement("input");
                var CVSStoreID = document.createElement("input");
                var TotalAmount = document.createElement("input");
                var IsCollection = document.createElement("input");
                var cartInfo = document.createElement("textArea");
                var pointUsage = document.createElement("input");
                var shippingMethod = document.createElement("input");
                var shippingTarget = document.createElement("textArea");
                var owner = document.createElement("input");
                var shippingCosts = document.createElement("input");
                var _token = document.createElement("input");
                var addNewMember = document.createElement("input");
                var password = document.createElement("input");
                var Temperature = document.createElement("input");
                var taxId = document.createElement("input");
                var receipt = document.createElement("input");
                var pointCount = document.createElement("input");
                var Remark = document.createElement("textArea");
                var usedCoupon = document.createElement("textArea");

                // 目前累計點數的倍率
                var pointMag = parseInt(this.percentage) / 100;
                var amountLessPoint = parseInt(this.amount) - parseInt(this.pointUsage);

                if (this.amount > 4000) {
                    this.showMessage('warning', '超商取貨付款最高代收金額為4000元，請更新您的訂單。');
                    return;
                }

                form.id = "checkout-form";

                _token.setAttribute("type", "hidden");

                form.method = "POST";
                form.action = "/shop_option_reply";

                _token.value = this.token;
                _token.name = "_token";
                form.appendChild(_token);

                pointCount.value = Math.ceil(pointMag * amountLessPoint);
                pointCount.name = "pointCount";
                form.appendChild(pointCount);

                taxId.value = this.customerParametor.taxId;
                taxId.name = "taxId";
                form.appendChild(taxId);

                receipt.value = this.customerParametor.receipt;
                receipt.name = "receipt";
                form.appendChild(receipt);

                LogisticsSubType.value = this.cvsParametor.LogisticsSubType;
                LogisticsSubType.name = "LogisticsSubType";
                form.appendChild(LogisticsSubType);

                Temperature.value = this.Temperature;
                Temperature.name = "Temperature";
                form.appendChild(Temperature);

                IsCollection.value = 'Y';
                IsCollection.name = "IsCollection";
                form.appendChild(IsCollection);

                CVSStoreID.value = this.cvsParametor.CVSStoreID;
                CVSStoreID.name = "CVSStoreID";
                form.appendChild(CVSStoreID);

                ReceiverName.value = this.useUserInfo ? this.customerParametor.ReceiverName : this.customerParametorForShipping.ReceiverName;
                ReceiverName.name = "ReceiverName";
                form.appendChild(ReceiverName);

                ReceiverCellPhone.value = this.useUserInfo ? this.customerParametor.ReceiverCellPhone : this.customerParametorForShipping.ReceiverCellPhone;
                ReceiverCellPhone.name = "ReceiverCellPhone";
                form.appendChild(ReceiverCellPhone);

                ChoosePayment.value = this.paymentMethod;
                ChoosePayment.name = "ChoosePayment";
                form.appendChild(ChoosePayment);

                pointUsage.value = this.pointUsage;
                pointUsage.name = "pointUsage";
                form.appendChild(pointUsage);

                ReceiverEmail.value = this.useUserInfo ? this.customerParametor.ReceiverEmail : this.customerParametorForShipping.ReceiverEmail;
                ReceiverEmail.name = "ReceiverEmail";
                form.appendChild(ReceiverEmail);

                owner.value = this.owner;
                owner.name = "owner";
                form.appendChild(owner);

                TotalAmount.value = this.finalAmount;
                TotalAmount.name = "TotalAmount";
                form.appendChild(TotalAmount);

                shippingMethod.value = this.shippingMethod;
                shippingMethod.name = "shippingMethod";
                form.appendChild(shippingMethod);

                shippingCosts.value = this.shippingCosts;
                shippingCosts.name = "shippingCosts";
                form.appendChild(shippingCosts);

                cartInfo.value = JSON.stringify(this.cart);
                cartInfo.name = "cartInfo";
                form.appendChild(cartInfo);

                Remark.value = this.customerParametor.remarks;
                Remark.name = "Remark";
                form.appendChild(Remark);

                if (this.usedCouponContent) {
                    usedCoupon.value = JSON.stringify(this.usedCouponContent);
                    usedCoupon.name = "usedCoupon";
                    form.appendChild(usedCoupon);
                }

                if (this.cvsParametor.MerchantTradeNo === null) {
                    alert('請先選擇取貨超商。');
                    return;
                }

                shippingTarget.value = JSON.stringify({
                    MerchantTradeNo: this.cvsParametor.MerchantTradeNo,
                    LogisticsSubType: this.cvsParametor.LogisticsSubType,
                    CVSStoreID: this.cvsParametor.CVSStoreID,
                    CVSStoreName: this.cvsParametor.CVSStoreName,
                    CVSAddress: this.cvsParametor.CVSAddress,
                    CVSTelephone: this.cvsParametor.CVSTelephone,
                    ReceiverName: this.customerParametor.ReceiverName,
                    ReceiverCellPhone: this.customerParametor.ReceiverCellPhone,
                    ReceiverEmail: this.customerParametor.ReceiverEmail
                });
                shippingTarget.name = "shippingTarget";
                form.appendChild(shippingTarget);

                addNewMember.value = this.addNewMember;
                addNewMember.name = "addNewMember";
                form.appendChild(addNewMember);

                password.value = this.customerParametor.newMemberPassword;
                password.name = "password";
                form.appendChild(password);

                document.body.appendChild(form);
                // 移除暫存的超商資訊
                localStorage.removeItem('logistic_cache');
                // 訂單送出
                form.submit();
                $('.loading-bar').fadeIn('100');
            },
            changePointUse: function (action) {
                switch (action) {
                    case 'up':
                        if (this.pointUsage >= this.point) {
                            this.pointUsage = this.point;
                            return;
                        } else if (this.pointUsage < 0) {
                            this.pointUsage = 0;
                            return;
                        } else {
                            this.pointUsage = parseInt(this.pointUsage) + 1;
                        }

                        break;
                    case 'down':
                        if (this.pointUsage <= 0) {
                            this.pointUsage = 0;
                            return;
                        } else if (this.pointUsage > this.point) {
                            this.pointUsage = this.point;
                        } else {
                            this.pointUsage = parseInt(this.pointUsage) - 1;
                        }

                        break;
                    default:

                }
            },
            pointInputValid: function () {
                if (this.pointUsage > this.point) {
                    this.pointUsage = this.point;
                } else if(this.pointUsage < 0) {
                    this.pointUsage = 0;
                } else if (this.pointUsage == "") {
                    this.pointUsage = 0;
                }
            },
            validateForm: function () {
                var self = this;

                if (this.shippingMethod === 'cvs') {
                    if (this.formValidation.ReceiverName &&
                        this.formValidation.ReceiverCellPhone &&
                        this.customerParametor.ReceiverEmail ) {
                        this.isAllow = true;
                    } else {
                        this.isAllow = false;
                    }
                } else {
                    if (this.formValidation.ReceiverName &&
                        this.formValidation.ReceiverCellPhone &&
                        this.customerParametor.ReceiverEmail &&
                        this.customerParametor.ReceiverPort &&
                        this.customerParametor.ReceiverCity &&
                        this.customerParametor.ReceiverAddress ) {
                        this.isAllow = true;
                    } else {
                        this.isAllow = false;
                    }
                }
            },
            chooseCvs: function (shop) {
                var self = this;

                window.location.href = '/getCvsTarget?shop=' + shop;

                return;

                window.open('/getCvsTarget?shop=' + shop, 'cvsmap', 'width=1002,height=589');
                window.GetCvs = function (cvs) {
                    var shop;

                    switch (cvs.LogisticsSubType) {
                        case 'FAMIC2C':
                            shop = '全家店到店 - ';
                            break;
                        case 'UNIMARTC2C':
                            shop = '7-11 店到店 - ';
                            break;
                        case 'HILIFEC2C':
                            shop = '萊爾富店到店 - ';
                            break;
                        default:

                    }
                    self.cvsParametor.MerchantTradeNo = cvs.MerchantTradeNo;
                    self.cvsParametor.LogisticsSubType = cvs.LogisticsSubType;
                    self.cvsParametor.CVSStoreID = cvs.CVSStoreID;
                    self.cvsParametor.CVSStoreName = shop + cvs.CVSStoreName;
                    self.cvsParametor.CVSAddress = cvs.CVSAddress;
                    self.cvsParametor.CVSTelephone = cvs.CVSTelephone;
                }
            },
            typeCoupon: function () {
                this.isCouponFieldShow = !this.isCouponFieldShow;
            },
            useCoupon: function () {
                var self = this;
                var token = this.token;

                if (this.couponNumber === '') {
                    $('#coupon-field').focus();
                    return;
                }

                $.ajax({
                    url: '/coupon/get/' + this.couponNumber,
                    type: 'POST',
                    dataType: 'json',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function(result) {
                    var isPublish = result.data.isPublish === 1 ? true : false;
                    var maximumAmount = result.data.maximumAmount;
                    var minimumAmount = result.data.minimumAmount;
                    var discountType = result.data.discountType;
                    var couponAmount = result.data.couponAmount;


                    if (!isPublish) {
                        self.showMessage('warning', '此優惠券尚未發佈。');
                        return;
                    }

                    self.usedCouponContent = {
                        discountType: self.isCouponUse,
                        couponAmount: couponAmount
                    }

                    if (maximumAmount || maximumAmount === "") {
                        if (self.amount > maximumAmount) {
                            self.showMessage('warning', '訂單金額已超出優惠券的限制金額。');
                            return;
                        }
                    }

                    if (minimumAmount || minimumAmount === "") {
                        if (self.amount < minimumAmount) {
                            self.showMessage('warning', '訂單金額小於優惠券的最低使用金額。');
                            return;
                        }
                    }

                    self.isCouponUse = true;
                    self.discountType = discountType;
                    self.couponAmount = couponAmount;

                    self.showMessage('success', '優惠券使用成功');
                })
                .fail(function(xhr) {
                    console.log(xhr.status);
                    if (xhr.status === 404) {
                        self.showMessage('error', '此優惠券無效。');
                    }
                    // console.log("error");
                })
                .always(function() {
                    // console.log("complete");
                });

            },
            showMessage: function (type, string) {
                toastr[type](string);
            }
        }
    }
</script>

<style lang="scss" scoped>
.tooltip-btn {
    border: none;
    padding: 0;
}
#anti-fraud-notice {
    width: 100%;
    height: 400px;
    padding: 10px;
    border-radius: 5px;
    border: #eee thin solid;
    background-color: #eee;
    overflow: auto;
}
</style>
