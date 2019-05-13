<template>
    <div class="row checkout-form">
        <form v-on:submit.prevent="createOrder" style="width: 100%">
            <!-- start -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 form-item">
                        <span class="important">公司名稱</span>
                    </div>
                    <div class="col-md-8 form-item">
                        <input class="form-control" type="text" v-model="customerParametor.ReceiverCompany" required>
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
            <!-- end -->
            <!-- start -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 form-item">
                        <span class="important">聯絡人</span>
                    </div>
                    <div class="col-md-8 form-item">
                        <input class="form-control" name="name" type="text" v-model="customerParametor.ReceiverName" required>
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
            <!-- end -->
            <!-- start -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 form-item">
                        <span class="important">連絡電話</span>
                    </div>
                    <div class="col-md-8 form-item">
                        <input class="form-control" type="text" v-model="customerParametor.ReceiverCellPhone" required>
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
            <!-- end -->
            <!-- start -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 form-item">
                        <span class="important">郵箱</span>
                    </div>
                    <div class="col-md-8 form-item">
                        <input class="form-control" name="email" type="email" v-model="customerParametor.ReceiverEmail" required>
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
            <!-- end -->
            <!-- start -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 form-item">
                        <span class="important">地址</span>
                    </div>
                    <div class="col-md-8 form-item">
                        <input class="form-control" name="ReceiverCity" type="text" placeholder="省份/城鎮/城市/區" v-model="customerParametor.ReceiverCity" required>
                        <!-- <select class="form-control" v-model="customerParametor.ReceiverCity" required>
                            <option :value="null">省份/城鎮/城市/區</option>
                            <option :value="'地址option1'">選項1</option>
                        </select> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
            <!-- end -->
            <!-- start -->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2 form-item">
                        <span class="important">詳細地址</span>
                    </div>
                    <div class="col-md-8 form-item">
                        <input class="form-control" type="text" v-model="customerParametor.ReceiverAddress" placeholder="請輸入詳細地址信息，如道路、門牌號、小區、棟樓號、單元等信息" required>
                    </div>
                </div>
            </div>
            <!-- end -->
            <!-- start -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 form-item">
                        <span>購買需求/應用範疇</span>
                    </div>
                    <div class="col-md-8 form-item">
                        <input class="form-control" v-model="customerParametor.ReceiverUseage" type="text">
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
            <!-- end -->
            <!-- start -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 form-item">
                        <span class="important">預算情況</span>
                    </div>
                    <div class="col-md-8 form-item">
                        <select class="form-control" v-model="customerParametor.ReceiverBudget" required>
                            <option :value="null" disabled>請選擇情況與您最相符的預算情況</option>
                            <option value="已有購買產品的預算">已有購買產品的預算</option>
                            <option value="只是諮詢產品功能">只是諮詢產品功能</option>
                            <option value="只是諮詢產品價格">只是諮詢產品價格</option>
                            <option value="已申報計畫">已申報計畫</option>
                            <option value="準備申報計畫">準備申報計畫</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
            <!-- end -->
            <!-- start -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 form-item">
                        <span class="important">預計購買時間</span>
                    </div>
                    <div class="col-md-8 form-item">
                        <select class="form-control" v-model="customerParametor.ReceiverTime" required>
                            <option :value="null">請選擇您預計購買的時間</option>
                            <option value="3個月內">3個月內</option>
                            <option value="3-6個月">3-6個月</option>
                            <option value="6-12個月">6-12個月</option>
                            <option value="一年以上">一年以上</option>
                            <option value="無法確定">無法確定</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
            <!-- end -->
            <!-- start -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 form-item">
                        <span class="important">所屬產業別</span>
                    </div>
                    <div class="col-md-8 form-item">
                        <select class="form-control" v-model="customerParametor.ReceiverJob" required>
                            <option :value="null">請選擇您的的產業別</option>
                            <option value="政府單位">政府單位</option>
                            <option value="工業">工業</option>
                            <option value="電子業">電子業</option>
                            <option value="污水處理業">污水處理業</option>
                            <option value="食品業">食品業</option>
                            <option value="醫藥業">醫藥業</option>
                            <option value="農業">農業</option>
                            <option value="其他">其他</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
            <!-- end -->
            <!-- start -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 form-item">
                        <span class="important">部門</span>
                    </div>
                    <div class="col-md-8 form-item">
                        <input class="form-control" v-model="customerParametor.ReceiverDepart" type="text" required>
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
            <!-- end -->
            <!-- start -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 form-item">
                        <span class="important">職務</span>
                    </div>
                    <div class="col-md-8 form-item">
                        <input class="form-control" v-model="customerParametor.ReceiverJobTitle" type="text" required>
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
            <!-- end -->
            <!-- start -->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2 form-item">
                        <span>備註</span>
                    </div>
                    <div class="col-md-10 form-item">
                        <textarea class="form-control" v-model="customerParametor.remarks" name="" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <!-- end -->

            <!--  -->
            <div class="col-md-9 mx-auto contact-form-footer">
                <p class="info">我們不會將您輸入的任何個人資訊用於回答查詢以外的目的，您亦可<a href="">點選這裡</a>檢視更多關於日澤提供的隱私權保護政策。</p>
                <p class="info">* 請您務必將日澤的電子郵箱地址或域名設定為可接收的電子郵箱，以免錯過我們的回覆，您亦可直接與我們聯絡，<a href="">(點選這裡檢視聯絡資訊)</a>。</p>
                <div class="captcha-section">
                    <strong>確認碼</strong>
                    <img :src="captchaUrl" id="captcha" alt="">
                    <a @click="refreshCaptcha" style="cursor: pointer">更新確認碼</a>
                    <input type="text" class="form-control captcha" name="captcha" v-model="captchaCode" placeholder="請輸入上方的確認碼..." required title="請輸入驗證碼">                    
                </div>
                <div class="captcha-section submit">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="submit-btn" href="/cart">返回</a>
                        </div>
                        <div class="col-md-6">
                            <button class="submit-btn" type="submit">提交，完成詢價程序</button>
                        </div>
                    </div>
                </div>
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
            let i18n = JSON.parse(document.getElementById('i18n-text').value)
            return {
                i18n: i18n,
                token: $('meta[name="csrf-token"]').attr('content'),
                // shippingMethod: $('#shipping_method').val(),
                // shippingCosts: 60,
                amount: null,
                // amountString: null,
                shippingTag: $('#shipping_method').val(),
                paymentMethod: 'Remit',
                point: null,
                captchaUrl: '/captcha/checkout',
                useUserInfo: true,
                dontUseUserInfo: false,
                percentage: 0,
                pointUsage: 0,
                owner: null,
                isCouponFieldShow: false,
                isCouponUse: false,
                discountType: '',
                couponAmount: null,
                Temperature: 'null',
                cart: [],
                LastFiveChar: '',
                antiFraudNoticeVisible: false,
                couponNumber: '',
                captchaCode: null,
                shippingMethods: [],
                customerParametor: {
                    ReceiverName: '',
                    ReceiverCellPhone: '',
                    ReceiverEmail: '',
                    ReceiverCity: null,
                    ReceiverPort: '',
                    ReceiverAddress: '',
                    remarks: '',
                    newMemberPassword: '',
                    receipt: '',
                    taxId: '',
                    ReceiverUseage: null,
                    ReceiverBudget: null,
                    ReceiverTime: null,
                    ReceiverJob: null,
                    ReceiverDepart: null,
                    ReceiverJobTitle: null,
                    ReceiverCompany: null
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

                axios.get(`/captcha/checkout/check/${this.captchaCode}`)
                    .then(res => {
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
                    }).catch(err => {
                        this.$message.error('驗證碼輸入錯誤。')
                    })

                // if (!this.antiFraudCheck) {
                //     this.antiFraudNoticeVisible = true

                //     setTimeout(() => {
                //         const notice = self.$refs.antiFraudNotice

                //         notice.scrollTop = 0
                //         self.antiFraudCheck = true
                //         // notice.addEventListener('scroll', () => {
                //         //     if ((notice.scrollTop + 400) > notice.scrollHeight) {
                //         //         self.antiFraudCheck = true
                //         //     }
                //         // })
                //     }, 200)
                //     return
                // }

                // this.antiFraudNoticeVisible = true

                // switch (method) {
                //     case 'cvsCod':      // 超商取貨付款
                //         this.cvsCod();
                //         break;
                //     case 'cvs':         // 超商純取貨
                //         this.aoiMethod();
                //         break;
                //     case 'aoi':         //All in one
                //         this.aoiMethod();
                //         break;
                //     default:

                // }
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
                            ReceiverEmail: this.customerParametor.ReceiverEmail,
                            ReceiverUseage: this.customerParametor.ReceiverUseage,
                            ReceiverBudget: this.customerParametor.ReceiverBudget,
                            ReceiverTime: this.customerParametor.ReceiverTime,
                            ReceiverJob: this.customerParametor.ReceiverJob,
                            ReceiverDepart: this.customerParametor.ReceiverDepart,
                            ReceiverJobTitle: this.customerParametor.ReceiverJobTitle,
                            ReceiverCompany: this.customerParametor.ReceiverCompany
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

                // console.log(shippingObject)
                // return

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
            refreshCaptcha() {
                axios.get('/cap_str')
                    .then(res => {
                        this.captchaUrl = `/captcha/checkout?q=${res.data}`
                    });
            },
            showMessage: function (type, string) {
                toastr[type](string);
            }
        }
    }
</script>

<style lang="scss">
@import "../../../../../../../storage/app/scss-variables.scss";
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
.checkout-form {
    .form-item {
        padding: 10px;
        display: -webkit-flex;
        display:         flex;
        -webkit-align-items: center;
                align-items: center;
        -webkit-justify-content: flex-start;
                justify-content: flex-start;
    }
}
.important {
    &::after {
        content: ' *';
        color: red;
    }
}
.contact-form-footer {
    padding-top: 10px;

    .info {
        font-size: 0.85rem;
        color: #999;
        font-weight: bolder;
    }
    .captcha-section {
        margin: 50px auto;
        text-align: center;
        max-width: 300px;

        input.captcha {
            margin: 20px 0 40px;
        }
        .submit-btn {
            padding: 25px 50px;
            color: #FFF;
            font-size: 1.05rem;
            background-color: $second-color;
            border: none;
            font-weight: bolder;
            cursor: pointer;
            display: inline-block;
            width: 100%;
            margin: 10px 0;
        }
        &.submit {
            width: 600px;
            max-width: 100%;
        }
    }
}
select[disabled] { 
    color: #ccc; 
}
</style>
