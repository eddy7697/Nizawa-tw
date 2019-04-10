<template>
    <div v-if="!isLoaded" class="stage-loading">
        <img src="/img/icon/loading-spinner.svg" alt="">
    </div>
    <div v-else>
        <div v-if="false">
            <strong v-if="choosedSubItem">货号：{{choosedSubItem.subSerialNumber}}</strong>
            <br v-if="choosedSubItem">
            <strong v-if="choosedSubItem" :class="{ 'del-line': choosedSubItem.subDiscountPrice }">建议售价：<span style="color: red">{{choosedSubItem.subPrice}}元</span></strong>
            <strong v-if="choosedSubItem && choosedSubItem.subDiscountPrice" style="font-size: 20px;">特价：<span style="color: red">{{choosedSubItem.subDiscountPrice}}元</span></strong>
        </div>
        <div v-if="false">
            <strong v-if="serialNumber">货号：{{serialNumber}}</strong>
            <br>
            <strong v-if="price" :class="{ 'del-line': discountedPrice }">建议售价：<span style="color: red">{{price}}元</span></strong>
            <strong v-if="discountedPrice && discountedPrice" style="font-size: 20px;">特价：<span style="color: red">{{discountedPrice}}元</span></strong>
        </div>
        <!-- <br> -->
        <el-radio-group 
            v-if="productType == 'variable'" 
            @change="selectSub"
            v-model="chossedSub" 
            size="medium">
            <el-radio 
                border 
                v-for="(item, index) in subProducts" :key="index"
                :label="item.id">{{item.subTitle}}</el-radio>
        </el-radio-group>
        <hr v-if="productType == 'variable' && chossedSub">
        <table class="counter-table">
            <tr>
                <td>
                    数量
                </td>
                <td>
                    <el-input-number 
                        v-if="productType == 'simple' && maxQty > 0" 
                        v-model="qty" size="small" 
                        :min="minQty" :max="maxQty" 
                        label="请选择数量"></el-input-number>
                </td>
            </tr>
        </table>
        
        <strong v-if="productType == 'simple' && maxQty < 1" ><span style="color: red">缺货中</span></strong>
        <el-input-number 
            v-if="productType == 'variable' && choosedSubItem && parseInt(choosedSubItem.subQuantity) > 0" 
            v-model="subQuantity" 
            size="small" 
            :min="1" :max="parseInt(choosedSubItem.subQuantity)" 
            label="请选择数量"></el-input-number>
        <strong v-if="productType == 'variable' && choosedSubItem && parseInt(choosedSubItem.subQuantity) < 1" ><span style="color: red">缺货中</span></strong>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-6">
                <button
                    v-if="productType == 'variable' && choosedSubItem && parseInt(choosedSubItem.subQuantity) > 0" 
                    class="btn btn-default btn-block btn-lg method-btn add-cart" @click="addToCart()">
                    加入询价车
                </button>
                <button v-if="productType == 'simple' && maxQty > 0" 
                    class="btn btn-default btn-block btn-lg method-btn add-cart" @click="addToCart()">
                    加入询价车
                </button>
            </div>
            <div class="col-md-6">
                <button
                    class="btn btn-default btn-block btn-lg method-btn ask-for-more">
                    询问更多产品细节
                </button>
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
        mounted () {
            console.log('Component mounted.')
        },
        props: [
            'guid'
        ],
        data () {
            return {
                isLoaded: false,
                minQty: 1,
                maxQty: 20,
                serialNumber: null,
                price: null,
                discountedPrice: null,
                qty: 1,
                subQuantity: 1,
                productType: 'simple',
                subProducts: [],
                chossedSub: null,
                choosedSubItem: null
            }
        },
        created() {
            this.getProduct()
        },
        watch:{
            choosedSubItem: {
                handler(choosedSubItem, oldVal) {
                    if (choosedSubItem) {
                        if (this.subQuantity > parseInt(this.choosedSubItem.subQuantity)) {
                            this.subQuantity = parseInt(this.choosedSubItem.subQuantity)
                        }
                    }
                    
                }
            }
        },
        methods: {
            getProduct() {
                let self = this

                axios.get(`/products/get/${this.guid}`)
                    .then(res => {
                        let product = res.data.data

                        self.productType = product.productType

                        if (product.productType == "variable") {
                            self.getSubProducts()
                        } else {
                            self.isLoaded = true
                            self.maxQty = product.quantity
                            self.price = product.price
                            self.discountedPrice = product.discountedPrice
                            self.serialNumber = product.serialNumber
                        }

                    }).catch(err => {

                    })
            },
            getSubProducts() {
                let self = this;

                axios.get(`/products/get/sub/${this.guid}`)
                    .then(res => {
                        self.subProducts = res.data
                        self.isLoaded = true
                    }).catch(err => {
                        self.$message.error('Get Subproduct failed.')
                    })
            },
            addToCart() {
                if (this.productType == 'simple') {
                    this.addSimple()
                } else {
                    this.addVariable()
                }
            },
            addSimple() {
                let self = this

                axios.post(`/cart/add/${this.guid}`, {
                    quantity: self.qty
                }).then(res => {
                    self.$message.success('成功加入购物车！')
                }).catch(err => {
                    self.$message.error('加入购物车失败...')
                }).then(arg => {
                    window.updateCount()
                })
            },
            addVariable() {
                let self = this
                let choosed = {
                    id: this.choosedSubItem.id,
                    title: this.choosedSubItem.subTitle,
                    subSerialNumber: this.choosedSubItem.subSerialNumber,
                    subPrice: parseInt(this.choosedSubItem.subPrice),
                    subDiscountPrice: this.choosedSubItem.subDiscountPrice ? parseInt(this.choosedSubItem.subDiscountPrice) : 0,
                    qty: this.subQuantity
                }

                axios.post(`/cart/add/sub/${this.guid}`, choosed)
                    .then(res => {
                        console.log(res.data)
                        self.$message.success('成功加入购物车！')
                    }).catch(err => {
                        self.$message.error('加入购物车失败...')
                    }).then(arg => {
                        window.updateCount()
                    })
            },
            selectSub(arg) {
                let self = this
                let choosed = _.find(this.subProducts, elm => {
                    return elm.id == arg
                })

                this.choosedSubItem = choosed
            }
        }
    }
</script>
<style lang="scss">
    @import "../../../../../../../storage/app/scss-variables.scss";
    // $main-color
    .el-radio__input.is-checked .el-radio__inner {
        border-color: $main-color;
        background: $main-color;
    }
    .el-radio__input.is-checked+.el-radio__label {
        color: $main-color;
    }
    .el-radio.is-bordered.is-checked {
        border-color: $main-color;
    }
    .del-line {
        text-decoration: line-through;
    }
    .stage-loading {
        text-align: center;
    }
    .counter-table {
        tr {
            td {
                padding: 0 30px 0 0;
                
                .el-input-number--small {
                    width: 180px;
                }
            }
        }
    }
    .method-btn {
        border: #ddd solid thin;
        padding: 1.2rem;

        &.add-cart {
            background-color: #1B445A;
            color: #ddd;
        }
        &.ask-for-more {

        }
    }
    
</style>
