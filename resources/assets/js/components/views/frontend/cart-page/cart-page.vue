<template>
    <div class="row" v-if="isCartEmpty && isLoaded">
        <div class="col-md-12">
            <h3 class="center" style="padding: 250px 0; text-align: center">詢價車裡面沒有商品，趕快去逛逛吧~</h3>
        </div>
    </div>
    <div class="row" v-else>
        <div class="col-md-11 mx-auto">
            <table class="cart-list">
                <thead>
                    <tr>
                        <th></th>
                        <th style="text-align: center" colspan="2">
                            產品名稱
                        </th>
                        <th style="text-align: center">
                            數量
                        </th>
                        <th style="text-align: center">
                            型號
                        </th>
                        <th style="text-align: center">
                            貨號
                        </th>
                        <th style="text-align: right">
                           
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in cart" v-bind:key="index">
                        <td class="product-remove">
                            {{paddingLeft(index + 1, 2)}}
                        </td>

                        <td class="product-thumbnail">
                            <a v-bind:href="productLink(item.id.guid)">
                                <img width="100" v-bind:src="item.id.featureImage" >
                            </a>
                        </td>

                        <td class="product-name" data-title="商品">
                            <a v-bind:href="productLink(item.id.guid)">{{item.id.title}}</a>
                        </td>

                        <td class="product-quantity" width="125" data-title="數量" style="text-align: center">
                            <el-input-number size="mini" v-model="item.qty"></el-input-number>
                        </td>

                        <td class="product-price" data-title="型號" style="text-align: center">
                            <span>{{item.id.serialNumber}}</span>
                        </td>

                        <td class="product-price" data-title="貨號" style="text-align: center">
                            <span>{{item.id.rule}}</span>
                        </td>

                        <td class="product-subtotal" data-title="總計" align="right">
                            <!-- <button>
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button> -->
                            <a href="#" class="remove" aria-label="移除這項商品" style="text-decoration: none;" @click="deleteProduct(item)">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
            <button v-if="isDirty" class="btn btn-custom" name="button" @click="updateCart">更新詢價車</button>
            <button v-else class="btn btn-custom" name="button" disabled>更新詢價車</button>
            <button class="btn btn-custom" name="button" @click="deleteAll">清空詢價車</button>
        </div>
        <div class="col-md-12" style="text-align: center;">
            <form class="" action="/checkout/billing" method="post">
                <input type="hidden" name="_token" v-bind:value="token">
                <input type="hidden" name="shipping_method" value="1">
                <button type="submit" class="btn btn-custom btn-xl">送出，前往下一步</button>
            </form>
        </div>
        <div class="col-md-4" v-if="false">
            <div class="cart-sidebar">
                <div class="cart_totals calculated_shipping">

                    <table cellspacing="0" class="cart-list">
                        <thead>
                            <tr>
                                <th class="product-name" colspan="2" style="border-width:3px;">詢價車總計</th>
                            </tr>
                        </thead>
                    </table>

                    <form class="" action="/checkout/billing" method="post">
                        <input type="hidden" name="_token" v-bind:value="token">
                        <table cellspacing="0" class="shop_table shop_table_responsive cart-list">

                            <tbody>
                                <tr class="cart-subtotal">
                                    <th>小計</th>
                                    <td data-title="小計"><span><span>NT$</span> {{amount}}</span>
                                    </td>
                                </tr>

                                <input type="hidden" name="shipping_method" value="1">
                                <!-- <tr class="shipping">
                                    <th>運送方式</th>
                                    <td data-title="運送方式 1">
                                        <ul id="shipping_method">
                                            <li v-for="(item, index) in methodsTranslate" v-bind:key="index">
                                                <input type="radio" name="shipping_method" v-bind:id="item.id" v-bind:value="item.id" class="shipping_method" v-model="choosedShipping" required>
                                                <label
                                                    v-if="item.freeShipping && (amountNum >= item.freeShippingMininum)"
                                                    v-bind:for="item.id">{{item.shippingTitle}}: 滿額免運</label>
                                                <label
                                                    v-else
                                                    v-bind:for="item.id">{{item.shippingTitle}}: <span><span>NT$</span>{{item.shippingPrice}}</span></label>
                                                <div v-if="amount < item.freeShippingMininum && choosedShipping === item.id">
                                                    購物滿 {{item.freeShippingMininum}} 元即可享有免運費的優惠唷！
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr> -->

                                <tr class="order-total">
                                    <th>總計</th>
                                    <td data-title="總計"><strong><span><span>NT$</span> </span></strong> {{totalAmount}}</td>
                                </tr>

                            </tbody>
                        </table>
                        <div style="text-align: center;">
                            <button type="submit" class="btn btn-primary btn-block check-btn">前往結帳</button>
                        </div>
                    </form>

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
    
    $('.loading-bar').fadeOut('100');
    export default {
        data() {
            return {
                token: $('meta[name="csrf-token"]').attr('content'),
                cart: [],
                isLoaded: false,
                choosedShipping: 1,
                shippingMethods: [],
                amount: null,
                isDirty: false,
                isCartEmpty: true
            }
        },
        watch: {
            cart: {
                handler: function (cart, oldVal) {
                    var self = this;
                    this.isDirty = true;
                },
                deep: true
            },
            choosedShipping: {
                handler: function (choosedShipping, oldVal) {
                    localStorage.setItem('choosedShipping', choosedShipping);
                },
                deep: true
            },
            shippingMethods: {
                handler(shippingMethods, oldVal) {
                    if (shippingMethods.length > 0) {
                        this.choosedShipping = shippingMethods[0].id
                    }
                }
            }
        },
        computed: {
            amountNum: function () {
                if (this.amount == null) {
                    return 0;
                } else {
                    var amount = this.amount.split(',');
                    var amountNum = '';

                    for (var i = 0; i < amount.length; i++) {
                        amountNum = amountNum + amount[i];
                    }

                    return parseInt(amountNum);
                }

            },
            totalAmount: function () {
                if (this.amount) {
                    var self = this;
                    var totalAmount = 0;
                    var amount = this.amount.split(',');
                    var amountNum = '';

                    for (var i = 0; i < amount.length; i++) {
                        amountNum = amountNum + amount[i];
                    }

                    this.shippingMethods.forEach(function (item) {
                        if (item.id == self.choosedShipping) {
                            if ((item.freeShipping == '1') && (amountNum >= parseInt(item.freeShippingMininum))) {
                                totalAmount = parseInt(amountNum);
                            } else {
                                totalAmount = parseInt(amountNum) + parseInt(item.shippingPrice);
                            }

                        }
                    });

                    return totalAmount;
                }

                return this.amount;
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
            }
        },
        created: function () {
            var self = this;

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
                getShippingMethodPromise,
                checkCartTempPromise
            ]).then(function (results) {

                results[0].forEach(function (item) {
                    if (item.shippingTemperature === results[1].Temperature) {
                        self.shippingMethods.push(item);
                    }
                });

            });


            this.getCart();
        },
        methods: {
            updateCart: function () {
                var self = this;
                let vo = {
                    cart: JSON.stringify(this.cart)
                }

                $('.loading-bar').fadeIn('100');

                axios.post('/cart/update', vo)
                    .then(res => {
                        this.getCart();
                        this.showMessage('success', '更新詢價車成功');
                        $('.loading-bar').fadeOut('100');
                    })
            },
            getCart: function () {
                var self = this;
                $('.loading-bar').fadeIn('100');

                $.ajax({
                    url: '/cart/get',
                    type: 'GET',
                    dataType: 'json'
                })
                .done(function(response) {
                    self.cart = [];
                    self.cart = response.cart;
                    self.amount = response.amount;

                    setTimeout(function () {
                        self.isDirty = false;
                    }, 100);

                    if (response.cart.length === 0) {
                        $('button.cart').removeClass('full');
                        self.isCartEmpty = true;
                        $('button.cart').find('img').attr('src', '/img/icon/cart-empty.svg');
                    } else {
                        self.isCartEmpty = false;
                        $('button.cart').find('img').attr('src', '/img/icon/cart-full.svg');
                    }

                    self.isLoaded = true
                })
                .fail(function() {
                    // console.log("error");
                })
                .always(function() {
                    $('.loading-bar').fadeOut('100');
                    // console.log("complete");
                });

            },
            deleteProduct: function (item) {
                var check = confirm('確認要刪除此商品?');
                var self = this;

                if (check) {
                    $('.loading-bar').fadeIn('100');
                    axios.post(`/cart/delete/single/${item.rowId}`)
                        .then(res => {
                            this.getCart()
                            updateCount()
                        }).catch(err => {

                        }).then(arg => {
                            $('.loading-bar').fadeOut('100');
                        })

                } else {
                    return;
                }
            },
            deleteAll: function () {
                var check = confirm('確認要刪除所有商品?');
                var self = this;

                if (check) {
                    $('.loading-bar').fadeIn('100');
                    $.ajax({
                        url: '/cart/delete/all',
                        type: 'GET',
                        dataType: 'json',
                    })
                    .done(function(response) {
                        // console.log(response);
                        self.getCart();
                    })
                    .fail(function() {
                        // console.log("error");
                    })
                    .always(function() {
                        $('.loading-bar').fadeOut('100');
                        self.getCart();
                        // console.log("complete");
                    });

                } else {
                    return;
                }
            },
            changeQty: function (method, item) {
                if (method == 'up') {
                    item.qty = parseInt(item.qty) + 1;
                } else {
                    if (!(item.qty <= 0)) {
                        item.qty = parseInt(item.qty) - 1;
                    }
                }
            },
            productLink: function (guid) {
                return "/product-detail/" + guid;
            },
            paddingLeft(str,lenght){
                if(str.length >= lenght)
                return str;
                else
                return this.paddingLeft("0" +str,lenght);
            },
            showMessage: function (type, string) {
                toastr[type](string);
            }
        }
    }
</script>

<style lang="scss">
@import "../../../../../../../storage/app/scss-variables.scss";
.btn-custom {
    background-color: $second-color;
    border-color: $second-color;
    color: #fff;
    opacity: 1;

    &.btn-xl {
        padding: 20px 50px;
    }
    &:hover {
        color: #fff;
        opacity: 0.9;
    }
}
</style>
