<template lang="html">
    <div class="row">
        <div class="col-md-4">
            <searchBar 
                :keyword="keyword"
                :btnTitle="'搜尋產品'"
                @newKeyword="newKeyword($event)"
                @searchPost="searchPost($event)"/>
        </div>
        <div class="col-md-3">
            <categoryList 
                :btnTitle="'變更產品類別'"
                :selectedCategoryName="selectedCategoryName"
                :data="categories"
                :selectedCategoryKey="selectedCategoryKey"
                @changeCategory="changeCategory($event)"/>
        </div>
        <div class="col-md-12" style="margin-bottom: 5px;">
            <el-radio-group v-model="productType" size="small">
                <el-radio-button label="all">所有類型</el-radio-button>
                <el-radio-button label="simple">一般商品</el-radio-button>
                <el-radio-button label="variable">變化商品</el-radio-button>
            </el-radio-group>
            <el-radio-group v-model="productQtyStatus" size="small" v-if="productType != 'variable'">
                <el-radio-button label="all">全部</el-radio-button>
                <el-radio-button label="lowq">低庫存</el-radio-button>
                <el-radio-button label="ot">無庫存</el-radio-button>
            </el-radio-group>
        </div>
        <!-- <div class="col-md-2">
            <select class="form-control" v-model="locale">
                <option value="zh-TW">繁體中文</option>
                <option value="en">英文</option>
            </select>
        </div> -->
        <div class="col-md-12" v-if="!isEmpty">        
            <el-table
                v-loading="listLoading"
                :data="products"
                style="width: 100%"                
                @header-click="sortAction"
                @selection-change="handleSelectionChange"
                :default-sort = "{prop: 'groupTitle', order: 'descending'}">
                <el-table-column
                    align="center"
                    type="selection"
                    width="45">
                </el-table-column>
                <el-table-column
                    prop="serialNumber"
                    width="120"
                    label="型號">
                    <template slot-scope="scope">
                        <div v-if="scope.row.serialNumber">
                            {{scope.row.serialNumber}}
                        </div>
                        <div v-else>
                            <strong style="color: #ccc">(未編輯)</strong>
                        </div>
                    </template>
                </el-table-column>
                <el-table-column
                    prop="locale"
                    width="120"
                    label="語系">
                    <template slot-scope="scope">
                        <div>
                            {{parseLoacle(scope.row.locale)}}
                        </div>
                    </template>
                </el-table-column>
                <el-table-column
                    prop="productTitle"
                    label="產品名稱">
                    <template slot-scope="scope">
                        <div v-if="scope.row.productTitle">
                            {{scope.row.productTitle}}
                        </div>
                        <div v-else>
                            <strong style="color: #ccc">(未編輯)</strong>
                        </div>
                    </template>
                </el-table-column>                
                <el-table-column
                    prop="categoryTitle"
                    width="200"
                    label="類別">
                    <template slot-scope="scope">
                        <div v-if="scope.row.categoryTitle">
                            {{scope.row.categoryTitle}}
                        </div>
                        <div v-else>
                            <strong style="color: #ccc">(未指定)</strong>
                        </div>
                    </template>
                </el-table-column>                
                <el-table-column
                    v-if="false"
                    prop="price"
                    width="120"
                    label="價格">
                    <template slot-scope="scope">
                        <div v-if="scope.row.productType == 'simple'">
                            <span v-if="scope.row.quantity < 1" style="color: red">缺貨中</span>
                            <span v-else>{{scope.row.price}}</span>
                        </div>
                        <div v-else>
                            <el-button size="mini" @click="showSubProduct(scope.row.subProduct)">查看子商品</el-button>
                        </div>
                    </template>
                </el-table-column>
                <el-table-column
                    prop="created_at"
                    width="170"
                    label="建立時間">
                </el-table-column>
                <el-table-column
                    width="50"
                    align="center"
                    fixed="right"
                    label="狀態">
                    <template slot-scope="scope">
                        <el-switch
                            v-model="scope.row.isPublish"
                            active-color="#13ce66"
                            @change="togglePublish(scope.row)"
                            inactive-color="#ff4949">
                        </el-switch>
                        <!-- <i v-if="scope.row.isPublish" @click="togglePublish(scope.row)" class="fa fa-toggle-on pointer" aria-hidden="true"></i>
                        <i v-else @click="togglePublish(scope.row)" class="fa fa-toggle-off pointer" aria-hidden="true"></i> -->
                    </template>
                </el-table-column>
                <el-table-column 
                    label="編輯"
                    type="edit"
                    align="center" 
                    fixed="right"
                    width="50">
                    <template slot-scope="scope">
                        <i class="el-icon-edit pointer" @click="editProduct(scope.row)"></i>
                    </template>
                </el-table-column>
            </el-table>
            <table style="margin-top: 10px;">
                <tr>
                    <td>
                        <select class="form-control" v-model="listFunction" style="width:120px">
                            <option v-for="(item, index) in listConfig.listFunction" v-bind:key="index" v-bind:value="item.method">{{item.title}}</option>
                        </select>
                    </td>
                    <td>
                        <button class="btn btn-primary" @click="doListFunction()" style="margin-left: 10px;">執行</button>
                    </td>
                </tr>
            </table>
            <div class="block">
                <el-pagination
                    layout="prev, pager, next"
                    :page-size="15"
                    :current-page.sync="current_page"
                    @current-change="gotoPage"
                    :total="total">
                </el-pagination>
            </div>
            <el-dialog
            title="子商品庫存檢視"
            :visible.sync="subDialogVisible"
            width="300"
            center
            :before-close="handleClose">
            <el-table
                :data="subProductCache"
                style="width: 100%">
                <el-table-column
                    prop="subTitle"
                    label="名稱"
                    width="180">
                </el-table-column>
                <el-table-column
                    prop="name"
                    label="金額"
                    width="180">
                    <template slot-scope="scope">
                        <span v-if="scope.row.subDiscountPrice">特價：{{scope.row.subDiscountPrice}}</span>
                        <span v-else>{{scope.row.subPrice}}</span>
                    </template>
                </el-table-column>
                <el-table-column
                    prop="subQuantity"
                    label="庫存">
                    <template slot-scope="scope">
                        <span v-if="parseInt(scope.row.subQuantity) > 4">{{scope.row.subQuantity}}</span>
                        <span v-else style="color: red">{{scope.row.subQuantity}}</span>
                    </template>
                </el-table-column>
            </el-table>
            <span slot="footer" class="dialog-footer">
                <el-button @click="subDialogVisible = false">取 消</el-button>
                <el-button type="primary" @click="subDialogVisible = false">確 定</el-button>
            </span>
            </el-dialog>
        </div>
    </div>
</template>

<script>
    import ToggleButton from 'vue-js-toggle-button';
    import ElementUI from 'element-ui';
    import 'element-ui/lib/theme-chalk/index.css';
    import lang from 'element-ui/lib/locale/lang/zh-TW'
    import locale from 'element-ui/lib/locale'    

    var itemList = require('../../../../common/itemList.vue');
    var categoryList = require('../../../../common/categoryList.vue');
    var searchBar = require('../../../../common/searchBar.vue');

    Vue.use(ToggleButton);
    Vue.use(ElementUI);
    locale.use(lang)

    export default {
        data() {
            return {
                isLoaded: false,
                products: [],
                next_page_url: null,
                prev_page_url: null,
                total: null,
                current_page: null,
                eachPage: [],
                allSelect: false,
                keyword: null,
                isEmpty: false,
                defaultOrder: 'asc',
                listFunction: 'default',
                token: $('meta[name="csrf-token"]').attr('content'),
                listFunction: 'default',
                flag: 'schedulePost',
                locale: 'zh-TW',
                selectedCategoryName: '全部類別',
                selectedCategoryKey: 'ALL',
                categories: [],
                listLoading: true,
                multipleSelection: [],
                productType: 'all',
                productQtyStatus: 'all',
                urlPath: '/admin/product/get',
                subDialogVisible: false,
                subProductCache: [],
                listConfig: {
                    checkBox: true,
                    listFunction: [
                        {
                            title: '請選擇動作',
                            method: 'default'
                        },{
                            title: '刪除產品',
                            method: 'deleteProducts'
                        },{
                            title: '上架產品',
                            method: 'publishProducts'
                        }                        
                    ]
                }
            }
        },
        components: {
            itemList,
            searchBar,
            categoryList
        },
        created: function () {
            var self = this;

            if (localStorage.getItem('productQtyStatus')) {
                this.productQtyStatus = localStorage.getItem('productQtyStatus')
            }

            if (localStorage.getItem('pageCache')) {
                this.getProductData(localStorage.getItem('pageCache'));
            } else {
                this.getProductData('/admin/product/get');
            }
            
            this.keyword = localStorage.getItem('keywordCache')
            // this.getProductData('/admin/product/get');
            this.getCategories();
        },
        watch: {
            isAllSelected: {
                handler: function (isAllSelected, oldVal) {
                    var self = this;

                    this.allSelect = isAllSelected;
                }
            },
            locale: {
                handler(locale, oldVal) {
                    this.getProductData(this.urlPath);
                }
            },
            productQtyStatus: {
                handler(productQtyStatus, oldVal) {
                    this.getProductData(this.urlPath);
                    localStorage.setItem('productQtyStatus', productQtyStatus)
                }
            },
            productType: {
                handler(productType, oldVal) {
                    this.getProductData(this.urlPath);
                    localStorage.setItem('productType', productType)
                }
            },
            urlPath: {
                handler(urlPath, oldVal) {
                    this.getProductData(urlPath);
                    localStorage.setItem('pageCache', urlPath)
                }
            },
            keyword: {
                handler(keyword, oldVal) {
                    localStorage.setItem('keywordCache', keyword)
                }
            }
        },
        computed: {
            isAllSelected: function () {
                var status = true;

                this.products.forEach(function (item) {
                    if (!item.isSelect) {
                        status = false;
                    }
                });

                return status;
            },
            selectedProducts: function () {
                var selectedRows = [];

                this.products.forEach(function (item) {
                    if (item.isSelect) {
                        selectedRows.push(item.productGuid);
                    }
                });

                return selectedRows;
            }
        },
        methods: {
            analyzePlacement (val) {
                console.log(val)
            },
            togglePublish: function (item) {
                var self = this;
                var token = this.token;
                var itemIndex = this.products.indexOf(item);

                $('.loading-bar').fadeIn('100');

                $.ajax({
                    url: '/admin/product/update/' + item.productGuid,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        isPublish: item.isPublish ? '0' : '1'
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function() {
                    self.showMessage('success', '變更發布狀態成功');
                    item.isPublish = !item.isPublish
                })
                .fail(function() {
                    console.log(itemIndex);
                    self.showMessage('error', '變更發布狀態失敗');
                })
                .always(function() {
                    $('.loading-bar').fadeOut('100');
                });
            },
            toggleAllSelect: function () {
                if (this.isAllSelected) {
                    this.products.forEach(function (item) {
                        item.isSelect = false;
                    });
                } else {
                    this.products.forEach(function (item) {
                        item.isSelect = true;
                    });
                }
            },
            doListFunction: function (item) {
                var self = this;

                switch (this.listFunction) {
                    case "deleteProducts":
                        this.deleteProducts(item);
                        break;
                    case "publishProducts":
                        this.publishProducts(item)
                        break;
                    default:
                        console.log(this.listFunction);
                }
            },
            editProduct: function (item) {
                window.location = '/cyberholic-system/product/edit/' + item.productGuid;
            },
            searchPost() {
                var self = this;

                $('.loading-bar').fadeIn('100');

                if (self.keyword) {
                    this.urlPath = `/admin/product/search/${self.keyword}`
                    // this.getProductData(`/admin/product/search/${self.keyword}`);
                } else {
                    this.urlPath = '/admin/product/get';
                    // this.getProductData('/admin/product/get');
                }
            },
            changeCategory (key) {
                $('.loading-bar').fadeIn('100')

                this.selectedCategoryKey = key

                if (key == 'ALL') {
                    this.selectedCategoryName = '全部類別'
                    this.urlPath = '/admin/product/get';
                    // this.getProductData('/admin/product/get');
                } else {
                    var selectedCategory = _.find(this.categories, ['guid', key])

                    this.selectedCategoryName = selectedCategory.name
                    this.urlPath = `/admin/product/get/category/${key}`;
                    // this.getProductData(`/admin/product/get/category/${key}`);
                }
            },
            getCategories () {
                var self = this;

                axios.get('/products/category')
                    .then(result => {
                        // console.log(result)
                        self.categories = [];
                        result.data.data.forEach(function(item) {
                            self.categories.push({
                                'categoryParent': item.parentId,
                                'name': item.categoryTitle,
                                'guid': item.categoryGuid,
                                'parentId': item.parentId,
                                'isEdit': false,
                                'description': item.categoryDescription,
                                'featureImage': item.featureImage
                            });
                        });
                    }).catch(err => {
                        console.log(err)
                    })
            },
            newKeyword (item) {
                this.keyword = item
            },
            publishProducts(item) {
                var self = this;
                var token = this.token;
                var checkPublish = confirm('確認要發布所有已選取的產品嗎?');

                if (!checkPublish) {
                    return
                }

                $('.loading-bar').fadeIn('100');

                axios.post('/admin/product/publish', {
                    data: self.multipleSelection
                }).then(res => {
                    self.$message.success('產品批量發布成功');
                    self.getProductData(self.urlPath);
                }).catch(err => {
                    self.$message.error('產品批量發布失敗')
                }).then(arg => {
                    $('.loading-bar').fadeOut('100');  
                })
            },
            deleteProducts: function (items) {
                var self = this;
                var token = this.token;
                var checkDelete = confirm('確認要刪除所有已選取的產品嗎?');

                if (!checkDelete) {
                    return
                }

                $('.loading-bar').fadeIn('100');

                $.ajax({
                    url: '/admin/product/delete',
                    type: 'POST',
                    dataType: 'json',
                    cache: false,
                    data: {
                        data: self.multipleSelection
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function(result) {
                    self.showMessage('success', '產品刪除成功');
                    self.getProductData(self.urlPath);
                })
                .fail(function() {
                    self.showMessage('success', '產品刪除失敗');
                })
                .always(function() {
                    $('.loading-bar').fadeOut('100');
                });

            },
            parseLoacle(str) {
                switch (str) {
                    case 'zh-TW':
                        return '繁體中文'
                        break;
                    case 'zh-CN':
                        return '簡體中文'
                        break;
                    case 'en':
                        return '英文'
                        break;
                    default:
                        break;
                }
            },
            nextPage: function () {
                this.urlPath = this.next_page_url
                // this.getProductData(this.next_page_url);
            },
            prevPage: function () {
                this.urlPath = this.prev_page_url
                // this.getProductData(this.prev_page_url);
            },
            gotoPage(page) {
                let checkPage = this.urlPath.match('page=')

                if (checkPage) {
                    let pathArray = this.urlPath.split('?')
                    let pageStrIndex

                    pathArray.forEach(elm => {
                        if (elm.match('page=')) {
                            pageStrIndex = pathArray.indexOf(elm)
                        }
                    })

                    pathArray[pageStrIndex] = `page=${page}`
                    
                    this.urlPath = pathArray.join('?')
                } else {
                    const url = `${this.urlPath}?page=${page}`

                    this.urlPath = url
                }
            },
            sortAction (col) {
                if (col.type == "selection" || col.type == "edit") {
                    return
                }
                this.defaultOrder = this.defaultOrder == 'asc' ? 'desc' : 'asc';
                this.flag = col.property
                this.getProductData(this.urlPath);
            },
            getProductData: function (url) {
                var self = this;

                this.listLoading = true
                
                axios.get(url, {
                    params: {
                        flag: self.flag,
                        order: self.defaultOrder,
                        locale: self.locale,
                        productType: self.productType,
                        qty: self.productQtyStatus
                    }
                }).then(result => {
                    var productData = result.data;

                    self.products = [];
                    self.next_page_url = productData.next_page_url;
                    self.prev_page_url = productData.prev_page_url;
                    self.current_page = productData.current_page;
                    self.total = productData.total;
                    self.eachPage = []; 

                    result.data.data.forEach(item => {
                        let itemVO = {
                            productGuid: item.productGuid,
                            productTitle: item.productTitle,
                            authorName: item.authorName,
                            categoryTitle: item.categoryTitle,
                            serialNumber: item.serialNumber,
                            price: item.price,
                            productType: item.productType,
                            quantity: item.quantity,
                            locale: item.locale,
                            isPublish: Boolean(item.isPublish),
                            isSelect: false,
                            created_at: item.created_at
                        }

                        if (itemVO.productType == "variable") {
                            itemVO.subProduct = item.subProduct
                        }

                        self.products.push(itemVO)
                    });

                    for (var i = 0; i < productData.last_page; i++) {
                        self.eachPage.push({
                            pageNumber: i + 1,
                        });
                    }

                    self.isLoaded = true;
                    $('.loading-bar').fadeOut('100');
                }).catch(err => {
                    console.log(err)
                }).then(arg => {
                    self.listLoading = false
                })

            },
            handleSelectionChange(val) {
                this.multipleSelection = val;
            },
            thumb: function (url) {
                var urlArray = url.split('/');
                var newUrl = urlArray[0];

                for (var i = 1; i < (urlArray.length - 1); i++) {
                    newUrl = newUrl + '/' + urlArray[i];
                }

                newUrl = newUrl + '/thumbs/' + urlArray[urlArray.length - 1];

                return newUrl;
            },
            handleClose() {
                this.subDialogVisible = false
                this.subProductCache = []
            },
            showSubProduct(item) {
                let self = this
                
                this.subDialogVisible = true
                this.subProductCache = JSON.parse(JSON.stringify(item))
            },
            showMessage: function (type, string) {
                toastr[type](string)
                this.message = string;
            }
        }
    }
</script>

<style>
.el-table .cell {
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}
.block {
    margin-top: 10px;
}
.el-pagination {
    padding-left: 0;
}
.el-checkbox {
    margin-bottom: 0;
}
</style>