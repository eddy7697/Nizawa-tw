<template>
    <div>
        <a style="cursor: pointer" @click="getCart(true)">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            &nbsp;{{i18n.my_cart}}
            <span class="count" v-if="cartContent.length">{{cartContent.length}}</span>
        </a>

        <!-- <div class="litext" @click="getCart(true)">
            <p>&nbsp;&nbsp;詢價車</p>
        </div> -->
        <!--<button class="cart pull-right" @click="getCart(true)">-->
        <!--<img v-bind:src="(isCartEmpty ? 'https://nizawa.shuo-guo.net/img/icon/cart-empty.svg' : 'https://nizawa.shuo-guo.net/img/icon/cart-full.svg')" alt="" width="25" height="25">-->
        <!--&lt;!&ndash; <i class="fa fa-shopping-cart" aria-hidden="true"></i> &ndash;&gt;-->
        <!--</button>-->
        <transition name="fade">
            <div class="cart-section" v-if="displayPanel" @click="togglePanel()"></div>
        </transition>
        <transition name="slide-fade">
            <div class="cart-panel" v-if="displayPanel">
                <button type="button" class="close-panel-btn" @click="togglePanel()">
                    <span></span>
                    <span></span>
                </button>

                <table class="cart-panel-table" v-for="(item, index) in cartContent" v-bind:key="index">
                    <tr v-if="!isCartEmpty">
                        <!-- <td rowspan="2">
                            <button type="button" name="button" @click="removeProduct(item)">x</button>
                        </td> -->
                        <td rowspan="3">
                            <div class="cart-item-img">
                                <img v-bind:src="item.featureImage" alt="">
                            </div>
                        </td>
                        <td align="right">
                            <strong>{{item.title}} x {{item.qty}}</strong><br>
                            <strong>{{i18n.serial_number}}：{{item.serialNumber}}</strong>
                        </td>
                    </tr>
                    <!-- <tr v-if="!isCartEmpty">
                        <td align="right">
                            <strong>NT$ {{item.total}}</strong>
                        </td>
                    </tr> -->
                    <tr v-if="!isCartEmpty">
                        <td align="right">
                            <a href="#" @click="removeProduct(item)">{{i18n.delete_product}}</a>
                            <!-- <button type="button" name="button" @click="removeProduct(item)">x</button> -->
                        </td>
                    </tr>
                </table>

                <hr style="margin-top: 35px;">
                <!-- <h4 v-if="!isCartEmpty" style="text-align: center"><strong>小計 NT$ {{amount}}</strong></h4> -->
                <h4 v-if="isCartEmpty" style="text-align: center"><strong>{{i18n.cart_panel_empty}}</strong></h4>
                <hr>

                <button v-if="!isCartEmpty" type="button" class="btn btn-primary btn-block btn-lg" @click="goToCart()">{{i18n.view_cart}}</button>
                <button type="button" class="btn btn-default btn-block btn-lg" @click="goProductList">{{i18n.back_to_list}}</button>
            </div>
        </transition>
    </div>
</template>



<script>
    // import ElementUI from 'element-ui';
    // import 'element-ui/lib/theme-chalk/index.css';
    // import lang from 'element-ui/lib/locale/lang/zh-TW'
    // import locale from 'element-ui/lib/locale'

    // Vue.use(ElementUI);
    // locale.use(lang)
    $('.loading-bar').fadeOut('100');
    export default {
        data() {
            let i18n = JSON.parse(document.getElementById('i18n-text').value)
            return {
                i18n: i18n,
                displayPanel: false,
                amount: null,
                cartContent: [],
                isCartEmpty: true
            }
        },
        created: function () {
            this.getCart(false);

            window.updateCount = this.getCart
            window.addSigleProduct = this.addSigleProduct
        },
        methods: {
            getCart: function (status) {
                var self = this;

                $.ajax({
                    url: '/cart/get',
                    type: 'GET',
                    dataType: 'json',
                })
                .done(function(response) {
                    self.amount = response.amount;

                    self.cartContent = [];

                    response.cart.forEach(function (item) {
                        self.cartContent.push({
                            title: item.id.title,
                            guid: item.id.guid,
                            featureImage: item.id.featureImage,
                            serialNumber: item.id.serialNumber,
                            role: item.id.role,
                            qty: item.qty,
                            price: item.price,
                            total: item.total,
                            rowId: item.rowId
                        });
                    });

                    if (response.cart.length === 0) {
                        self.isCartEmpty = true;
                        $('button.cart').removeClass('full');
                    } else {
                        self.isCartEmpty = false;
                        $('button.cart').addClass('full');
                    }

                    if (status) {
                        self.displayPanel = self.displayPanel ? false : true;
                    }


                })
                .fail(function() {
                })
                .always(function() {
                });

            },
            removeProduct: function (item) {
                var self = this;
                var checkDelete = confirm(this.i18n.confirm_delete);

                if (checkDelete) {
                    axios.post(`/cart/delete/single/${item.rowId}`)
                        .then(res => {
                            
                            axios.get('/cart/get')
                                .then(result => {
                                    self.amount = result.data.amount;
                                    self.cartContent = [];

                                    result.data.cart.forEach(function (item) {
                                        self.cartContent.push({
                                            title: item.id.title,
                                            guid: item.id.guid,
                                            featureImage: item.id.featureImage,
                                            qty: item.qty,
                                            price: item.price,
                                            total: item.total,
                                            rowId: item.rowId
                                        });
                                    });

                                    if (result.data.cart.length === 0) {
                                        self.isCartEmpty = true;
                                        $('button.cart').removeClass('full');
                                    } else {
                                        self.isCartEmpty = false;
                                    }
                                })
                        }).catch(err => {
                            toastr["error"](this.i18n.delete_fail);
                        })
                }

                

                return 

                // return;
                var removePromise = new Promise(function (resolve, reject) {
                    var checkDelete = confirm("確認要移除此產品");

                    if (checkDelete) {
                        
                        $.ajax({
                            url: '/cart/delete/single/' + item.rowId,
                            type: 'POST',
                            dataType: 'json',
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('X-CSRF-TOKEN', window.token);
                            }
                        })
                        .done(function(response) {
                            resolve(response);
                        })
                        .fail(function(error) {
                            reject(error);
                            toastr["error"]("移除產品失敗");
                        });
                    }
                });

                removePromise.then(function (value) {


                    $.ajax({
                        url: '/cart/get',
                        type: 'GET',
                        dataType: 'json',
                    })
                    .done(function(response) {
                        self.amount = response.amount;
                        self.cartContent = [];

                        response.cart.forEach(function (item) {
                            self.cartContent.push({
                                title: item.id.title,
                                guid: item.id.guid,
                                featureImage: item.id.featureImage,
                                qty: item.qty,
                                price: item.price,
                                total: item.total,
                                rowId: item.rowId
                            });
                        });

                        if (response.cart.length === 0) {
                            self.isCartEmpty = true;
                            $('button.cart').removeClass('full');
                        } else {
                            self.isCartEmpty = false;
                        }
                    });
                });
            },
            goToCart: function () {
                window.location.href = '/cart';
            },
            addSigleProduct(guid) {
                this.addSigle(guid)
            },
            addSigle(guid) {
                let self = this

                axios.post(`/cart/add/single/${guid}`
                    ).then(res => {
                        toastr.success(this.i18n.add_success)
                        // self.$message.success(this.i18n.add_success)
                    }).catch(err => {
                        toastr.error(this.i18n.add_fail)
                        // self.$message.error(this.i18n.add_fail)
                    }).then(arg => {
                        self.getCart()
                    })
            },
            thumb: function (url) {
                
                try {
                    var urlArray = url.split('/');
                    var newUrl = urlArray[0];

                    for (var i = 1; i < (urlArray.length - 1); i++) {
                        newUrl = newUrl + '/' + urlArray[i];
                    }

                    newUrl = newUrl + '/thumbs/' + urlArray[urlArray.length - 1];

                    return newUrl;
                } catch (error) {
                    console.log(url)
                    return url
                }
            },
            togglePanel: function () {
                if (this.displayPanel) {
                    this.displayPanel = this.displayPanel ? false : true;
                }
            },
            goProductList() {
                window.location.href = '/product'
            }
        }
    }
</script>

<style media="screen">
    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .3s ease;
    }
    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */ {
        transform: translateX(10px);
        opacity: 0;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
    .shopping-Cart-Icon {
        position: relative;
    }
    .shopping-Cart-Icon img{
        width: 30px;
        height: 30px;
    }
    .shopping-Cart-Icon, .litext{
        display: inline-block;
    }
    .count{
        /* position: absolute; */
        font-size: 12px;
        background-color: red;
        color: white;
        padding: 0 6px 0 6px;
        border-radius: 50%;
        /* bottom: 0;
        right: -10px; */
        box-shadow: 2px 2px 12px -2px #666;
    }
</style>
