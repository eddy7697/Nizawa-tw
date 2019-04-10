<template>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-default" @click="openDialog()">編輯精選商品</button>
            <div ref="featureModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">編輯精選商品</h4>
                        </div>

                        <div class="modal-body">
                            <div class="alert alert-info" role="alert">
                                第一排序：
                                <strong v-if="feature.first">{{feature.first.productTitle}}</strong>
                                <button class="btn btn-primary pull-right" style="margin-top: -5px;" @click="openProductModal('feature_1')">編輯</button>
                            </div>
                            <div class="alert alert-info" role="alert">
                                第二排序：
                                <strong v-if="feature.second">{{feature.second.productTitle}}</strong>
                                <button class="btn btn-primary pull-right" style="margin-top: -5px;" @click="openProductModal('feature_2')">編輯</button>
                            </div>
                            <div class="alert alert-info" role="alert">
                                第三排序：
                                <strong v-if="feature.third">{{feature.third.productTitle}}</strong>
                                <button class="btn btn-primary pull-right" style="margin-top: -5px;" @click="openProductModal('feature_3')">編輯</button>
                            </div>
                            <div class="alert alert-info" role="alert">
                                第四排序：
                                <strong v-if="feature.fourth">{{feature.fourth.productTitle}}</strong>
                                <button class="btn btn-primary pull-right" style="margin-top: -5px;" @click="openProductModal('feature_4')">編輯</button>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Select product -->
            <div ref="productModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">選擇商品</h4>
                        </div>

                        <div class="modal-body">
                            <form v-on:submit.prevent="searchProduct">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="搜尋產品..." v-model="keyword" autofocus>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit">搜尋產品</button>
                                    </span>
                                </div>
                                <div v-if="products.length">
                                    <ul class="nav nav-pills nav-stacked">
                                        <li v-for="(item, index) in products" :key="index"><a @click="saveFeature(item)">{{item.productTitle}}</a></li>
                                    </ul>
                                </div>
                            </form>
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
    export default {
        mounted () {
            console.log('Component mounted.')
        },
        data () {
            return {
                feature: {
                    first: null,
                    fourth: null,
                    second: null,
                    third: null
                },
                products: [],
                type: null,
                target: null,
                keyword: null
            }
        },
        created() {
            this.getFeature()
        },
        methods: {
            getFeature() {
                var self = this

                axios.get('/admin/product/getFeature')
                    .then(res => {
                        self.feature = res.data.data
                    })
            },
            searchProduct() {
                var self = this

                axios.get(`/admin/product/search/${this.keyword}`, {
                    params: {
                        flag: 'id',
                        order: 'asc'
                    }
                }).then(res => {
                    self.products = res.data.data
                })
            },
            saveFeature(item) {
                var self = this
                
                $('.loading-bar').fadeIn('100');
                axios.post('/admin/feature/create', {
                    type: self.type,
                    guid: item.productGuid
                }).then(res => {
                    self.showMessage('success', '設定焦點商品完成')
                    $('.loading-bar').fadeOut('100');
                    $(this.$refs.productModal).modal('hide')
                }).catch(err => {
                    self.showMessage('error', '設定焦點商品失敗')
                }).then(() => {
                    self.getFeature()
                    $('.loading-bar').fadeOut('100');
                })
            },
            openProductModal(type) {
                this.type = type
                $(this.$refs.productModal).modal('show')
            },
            openDialog() {
                $(this.$refs.featureModal).modal('show')
            },
            showMessage: function (type, string) {
                toastr[type](string)
                this.message = string;
            }
        }
    }
</script>

<style scoped>
.alert {
    font-size: 18px;
}
</style>
