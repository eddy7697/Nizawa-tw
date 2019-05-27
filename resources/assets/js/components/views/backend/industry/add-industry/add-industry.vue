<template>
    <div class="row">
        <div class="col-md-12">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-position="top" label-width="100px" class="demo-ruleForm">
                <div class="row">
                    <div class="col-md-9">
                        <ul class="nav nav-tabs">
                            <li :class="{active: activedTab == item.id}" v-for="(item, index) in ruleForm.content" :key="index">
                                <a href="#" @click="activedTab = item.id">{{item.title['zh-TW']}}</a>
                            </li>
                            <li>
                                <a href="#" @click="addFlow"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                        <el-card class="box-card" v-for="(item, index) in ruleForm.content" :key="index" :class="{hidden: activedTab !== item.id}">
                            <div slot="header" class="clearfix">
                                <div style="width: calc(100% - 103px); display: inline-block">
                                    <el-input v-model="item.title['zh-TW']" style="width: 33%" placeholder="繁中"></el-input>
                                    <el-input v-model="item.title['zh-CN']" style="width: 33%" placeholder="簡中"></el-input>
                                    <el-input v-model="item.title.en" style="width: 33%" placeholder="英文"></el-input>
                                </div>
                                
                                <el-button @click="translateTitle(item.title)">一鍵翻譯</el-button>
                            </div>
                            <div class="row content-box outter" v-for="(elm, id) in item.flow" :key="id">
                                <div class="col-md-12">
                                    <label>項目標題</label>
                                </div>
                                <div class="col-md-12">
                                    <div style="width: calc(100% - 103px); display: inline-block">
                                        <el-input v-model="elm.title['zh-TW']" style="width: 32.8%" placeholder="繁中"></el-input>
                                        <el-input v-model="elm.title['zh-CN']" style="width: 32.8%" placeholder="簡中"></el-input>
                                        <el-input v-model="elm.title.en" style="width: 32.8%" placeholder="英文"></el-input>
                                    </div>
                                    
                                    <el-button @click="translateTitle(elm.title)">一鍵翻譯</el-button>
                                </div>
                                <div class="col-md-12">
                                    <label>項目產品</label>
                                </div>
                                <div class="col-md-12">
                                    <div class="content-box inner">
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
                                                    <el-button type="danger" circle icon="el-icon-delete" @click="deleteProduct(elm, scope.row)" size="mini"></el-button>
                                                </template>
                                            </el-table-column>
                                        </el-table>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-default btn-block" @click="addOption(item.flow)">新增項目</button>
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
                            <el-button @click="translateTitle(ruleForm.locale)">一鍵翻譯應用標題</el-button>
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
                    <div class="input-group">
                        <input type="keyword" class="form-control" v-model="keyword" placeholder="請輸入產品名稱" required>
                        <span class="input-group-btn">
                        <button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true">
                        </span> 搜尋產品</button>
                        </span>
                    </div>
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
        props: ['editmode', 'id'],
        data () {
            return {
                activedTab: null,
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
                    content: []
                }
            }
        },
        created() {
            if (this.editmode == 'edit') {
                this.getIndustry()
            }
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.saveIndustry();
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            saveIndustry() {
                let vo = JSON.parse(JSON.stringify(this.ruleForm))
                let url = this.editmode == 'add' ? '/admin/custom/add' : `/admin/custom/update/${this.id}`

                vo.locale = JSON.stringify(vo.locale)
                vo.content = JSON.stringify(vo.content)

                axios.post(url, vo)
                    .then(res => {
                        this.$message.success('儲存成功')
                    })
            },
            getIndustry() {
                axios.get(`/admin/custom/getByid/${this.id}`)
                    .then(res => {
                        this.ruleForm.locale = JSON.parse(res.data.locale)
                        this.ruleForm.content = JSON.parse(res.data.content)

                        this.activedTab = this.ruleForm.content[0].id
                    })
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
                    this.selectedRow.id = this.selectedProductItem.productGuid
                    this.selectedRow.title = this.selectedProductItem.productTitle
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
            deleteProduct(elm, row) {
                let check = confirm('確認要刪除此商品?')

                if (check) {
                    elm.product.splice(elm.product.indexOf(row), 1)
                }
            },
            addFlow() {
                let newID = this.makeid(6)

                this.ruleForm.content.push({
                    title: {
                        'zh-TW': '',
                        'zh-CN': '',
                        en: ''
                    },
                    id: newID,
                    flow: []
                })
                this.activedTab = newID
            },
            addOption(row) {
                row.push({
                    title: {
                        'zh-TW': '',
                        'zh-CN': '',
                        en: ''
                    },
                    product: []
                })
            },
            translateTitle(form) {
                let count = 0
                $('.loading-bar').show()

                axios.post(`/api/translate/zh-CN/${form['zh-TW']}`)
                    .then(res => {
                        form['zh-CN'] = res.data
                        count += 1

                        if (count > 1) {
                            $('.loading-bar').hide()
                        }
                    })
                axios.post(`/api/translate/en/${form['zh-TW']}`)
                    .then(res => {
                        form['en'] = res.data
                        count += 1

                        if (count > 1) {
                            $('.loading-bar').hide()
                        }
                    })
            },
            handleClose() {
                this.dialogVisible = false
            },
            makeid(length) {
                var result           = '';
                var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                var charactersLength = characters.length;
                for ( var i = 0; i < length; i++ ) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                return result;
            }
        }
    }
</script>

<style lang="scss">
.content-box {
    border: #ddd solid thin;
    border-radius: 5px;
    padding: 10px;

    &.outter {
        margin: 0px 0 10px
    }
    &.inner {
        border: none;
        margin: 0;
        padding: 10px 0;
    }
}
.button-position-fixed {
    position: absolute;
    top: 20px;
    right: 23px;
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
.hidden {
    display: none;
}
</style>
