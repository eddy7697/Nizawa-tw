<template>
    <div class="row">
        <div class="col-md-12">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-position="top" label-width="100px" class="demo-ruleForm">
                <div class="row">
                    <div class="col-md-9">
                        <el-card class="box-card" v-for="(item, index) in ruleForm.content" :key="index">
                            <div slot="header" class="clearfix">
                                <span>{{item.title}}</span>
                                <el-button style="float: right; padding: 3px 0" type="text">操作按钮</el-button>
                            </div>
                            <div class="row content-box" v-for="(elm, id) in item.flow" :key="id">
                                <div class="col-md-12">
                                    <label>項目標題</label>
                                </div>
                                <div class="col-md-12">
                                    <el-input v-model="elm.title"></el-input>
                                </div>
                                <div class="col-md-12">
                                    <label>項目產品</label>
                                </div>
                                <div class="col-md-12">
                                    <div class="content-box">
                                        <el-button class="button-position-fixed" type="primary" @click="addProduct(index, id)" circle icon="el-icon-plus" size="mini"></el-button>
                                        <el-table
                                            :data="elm.product"
                                            style="width: 100%">
                                            <el-table-column
                                                prop="title"
                                                label="商品">
                                            </el-table-column>
                                            <el-table-column
                                                width="50">
                                                <template slot-scope="scope">
                                                    <el-button type="success" circle icon="el-icon-edit" @click="editProduct(index, id, scope.row)" size="mini"></el-button>
                                                </template>
                                            </el-table-column>
                                            <el-table-column
                                                width="50">
                                                <template slot-scope="scope">
                                                    <el-button type="danger" circle icon="el-icon-delete" @click="deleteProduct(index, id, scope.row)" size="mini"></el-button>
                                                </template>
                                            </el-table-column>
                                        </el-table>
                                    </div>
                                </div>
                            </div>
                        </el-card>
                    </div>
                    <div class="col-md-3">
                        <el-form-item label="應用標題(繁體)" prop="locale">
                            <el-input v-model="ruleForm.locale['zh-TW']"></el-input>
                        </el-form-item>
                        <el-form-item label="應用標題(繁體)" prop="locale">
                            <el-input v-model="ruleForm.locale['zh-CN']"></el-input>
                        </el-form-item>
                        <el-form-item label="應用標題(英文)" prop="locale">
                            <el-input v-model="ruleForm.locale.en"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="primary" @click="submitForm('ruleForm')">儲存</el-button>
                        </el-form-item>
                    </div>
                </div>
            </el-form>
            <el-dialog
                title="選擇產品"
                :visible.sync="dialogVisible"
                width="600px"
                :before-close="handleClose">
                <form v-on:submit.prevent="searchProduct">
                    <input class="form-control" v-model="keyword" placeholder="請輸入產品名稱" required/>
                    
                </form>
                <div class="selected-product-list">
                    <label v-for="(item, index) in productData.data" :key="index">
                        <input type="radio" name="selectedProduct" :value="item.productGuid" v-model="selectedProduct"> {{item.productTitle}}
                    </label>
                </div>
                <span v-if="true" slot="footer" class="dialog-footer">
                    <el-button @click="dialogVisible = false">關閉視窗</el-button>
                    <el-button type="primary" @click="selectPtoduct">選擇產品</el-button>
                </span>
            </el-dialog>
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
            $('.loading-bar').hide()
        },
        data () {
            return {
                dialogVisible: false,
                urlPath: '',
                rules: {},
                keyword: null,
                productData: {},
                selectedProduct: null,
                selectedProductItem: null,
                mode: null,
                selectedIndex: null,
                selectedFlow: null,
                selectedRow: {},
                ruleForm: {
                    type: 'industry',
                    locale: {
                        'zh-TW': null,
                        'zh-CN': null,
                        en: null
                    },
                    content: [
                        {
                            title: '原廢水',
                            flow: [{
                                title: '鹼度',
                                product: [
                                    {
                                        'title': 'MD610',
                                        'id': 'MD610'
                                    },{
                                        'title': 'MultiDirect',
                                        'id': 'MD610'
                                    },{
                                        'title': 'XD分光光度計',
                                        'id': 'MD610'
                                    }
                                ]
                            }]
                        }                        
                    ]
                }
            }
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                if (valid) {
                    alert('submit!');
                } else {
                    console.log('error submit!!');
                    return false;
                }
                });
            },
            searchProduct(e) {
                this.urlPath = `/admin/product/search/${this.keyword}`

                axios.get(this.urlPath, {
                    params: {
                        flag: 'id',
                        order: 'desc'
                    }
                }).then(result => {
                    var productData = result.data;

                    this.productData = productData
                    $('.loading-bar').fadeOut('100');
                }).catch(err => {
                    console.log(err)
                }).then(arg => {
                    self.listLoading = false
                })
            },
            addProduct(index, id) {
                this.mode = 'add'
                this.selectedIndex = index
                this.selectedFlow = id

                this.$nextTick(() => {
                    this.dialogVisible = true
                })
            },
            selectPtoduct() {
                this.selectedProductItem = _.find(this.productData.data, ['productGuid', this.selectedProduct])
                // console.log(this.selectedProductItem)
                // return
                if (this.mode == 'add') {
                    this.ruleForm.content[this.selectedIndex].flow[this.selectedFlow].product.push({
                        id: this.selectedProductItem.productGuid,
                        title: this.selectedProductItem.productTitle,
                    })
                } else {

                }

                this.$nextTick(() => {
                    this.dialogVisible = false
                    this.mode = null
                    this.selectedProduct = null
                    this.selectedProductItem = null
                    this.selectedIndex = null
                    this.selectedFlow = null
                    this.selectedRow = {}
                })
                
            },
            editProduct(index, id, row) {
                this.mode = 'edit'
                this.selectedIndex = index
                this.selectedFlow = id
                this.selectedRow = row

                this.$nextTick(() => {
                    this.dialogVisible = true
                })
            },
            deleteProduct(index, id, row) {
                
            },
            handleClose() {
                this.dialogVisible = false
            }
        }
    }
</script>

<style lang="scss">
.content-box {
    border: #ccc solid thin;
    padding: 10px;
}
.button-position-fixed {
    position: absolute;
    top: 20px;
    right: 32px;
    z-index: 1;
}
.selected-product-list {
    label {
        width: 100%;
        margin: 8px 0;
        padding: 10px;
        border: #eee solid thin;
    }
}
</style>
