<template>
    <div class="row" v-if="isLoaded">
        <form v-on:submit.prevent="saveProduct()">
            <div class="col-md-9">
                <el-radio-group v-model="selectedLocale" size="medium" style="margin-bottom: 10px;">
                    <el-radio-button label="zh-TW">繁體中文</el-radio-button>
                    <el-radio-button label="zh-CN">简体中文</el-radio-button>
                    <el-radio-button label="en">英文</el-radio-button>
                </el-radio-group>
                <input type="text" class="form-control ch-product-title" name="title" value="" placeholder="商品名稱" v-model="productContent[selectedLocale].productTitle" required>
                <!-- <div class="form-group">
                    <label for="">{{currentPath}}/product-detail/</label>
                    <input type="text" class="form-control" placeholder="" v-model="productContent[selectedLocale].customPath" style="width: fit-content; display:inline-block">
                </div> -->
                <div v-if="editorShow">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">檢測步驟</a></li>
                        <li><a data-toggle="tab" href="#menu1">檢測項目</a></li>
                        <li><a data-toggle="tab" href="#menu2">儀器規格</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <ckeditor
                                class="ch-product-description-step"
                                :config="ckConfig"
                                v-model="productContent[selectedLocale].productDescription.step">
                            </ckeditor>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <ckeditor
                                class="ch-product-description-option"
                                :config="ckConfig"
                                v-model="productContent[selectedLocale].productDescription.option">
                            </ckeditor>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <ckeditor
                                class="ch-product-description-spec"
                                :config="ckConfig"
                                v-model="productContent[selectedLocale].productDescription.spec">
                            </ckeditor>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            商品資訊 
                            <select v-if="false" class="form-control product-type-field" v-model="productContent[selectedLocale].productType" @change="switchType()">
                                <option value="simple">一般商品</option>
                                <option value="variable">多規格商品</option>
                            </select>
                            <el-dialog title="新增商品規格" :visible.sync="showSwitchTips">
                                <div>建立多規格商品時，將會預先儲存商品。</div>
                                <br>
                                <el-checkbox label="以後不再顯示" name="type" v-model="noShow"></el-checkbox>
                                <div slot="footer" class="dialog-footer">
                                    <el-button type="primary" @click="checkToolTip()">確定</el-button>
                                </div>
                            </el-dialog>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="tabbable ch-tab" id="tabs-865853">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#panel-817886" data-toggle="tab">資訊設定</a>
                                </li>
                                <li>
                                    <a href="#panel-119853" data-toggle="tab">SEO 設定</a>
                                </li>
                            </ul>
                            <div class="tab-content ch-tab-content">
                                <div class="tab-pane active" id="panel-817886">
                                    <div  v-if="productContent[selectedLocale].productType == 'variable'">
                                        <el-collapse accordion v-if="productContent[selectedLocale].subProduct.length > 0">
                                            <el-collapse-item v-for="(item, index) in productContent[selectedLocale].subProduct" :key="index" :title="item.subTitle" :name="index">
                                                <el-form :model="item" :ref="`subProduct-${item.subProductGuid}`">
                                                    <el-form-item label="規格名稱" :label-width="'120px'">
                                                        <el-input v-model="item.subTitle" autocomplete="on"></el-input>
                                                    </el-form-item>
                                                    <el-form-item label="貨號" :label-width="'120px'">
                                                        <el-input v-model="item.subSerialNumber" autocomplete="off"></el-input>
                                                    </el-form-item>
                                                    <el-form-item label="庫存" :label-width="'120px'">
                                                        <el-input-number v-model="item.subQuantity" :min="0" label="庫存"></el-input-number>
                                                    </el-form-item>
                                                    <el-form-item label="價格" :label-width="'120px'">
                                                        <el-input v-model="item.subPrice" autocomplete="off"></el-input>
                                                    </el-form-item>
                                                    <el-form-item label="促銷價" :label-width="'120px'">
                                                        <el-input v-model="item.subDiscountPrice" autocomplete="off"></el-input>
                                                    </el-form-item>
                                                    <el-form-item align="right">                                                        
                                                        <el-button type="danger" @click="deleteSubProduct(item.subProductGuid)">刪除</el-button>
                                                        <el-button type="primary" @click="saveSubProduct(`subProduct-${item.subProductGuid}`)">儲存</el-button>
                                                    </el-form-item>
                                                </el-form>
                                                
                                            </el-collapse-item>
                                        </el-collapse>
                                        <el-dialog title="新增商品規格" :visible.sync="subproductFormVisible">
                                            <el-form :model="subProductForm" ref="subProductForm">
                                                <el-form-item label="規格名稱" :label-width="'120px'">
                                                    <el-input v-model="subProductForm.subTitle" autocomplete="on"></el-input>
                                                </el-form-item>
                                                <el-form-item label="貨號" :label-width="'120px'">
                                                    <el-input v-model="subProductForm.subSerialNumber" autocomplete="off"></el-input>
                                                </el-form-item>
                                                <el-form-item label="庫存" :label-width="'120px'">
                                                    <el-input-number v-model="subProductForm.subQuantity" :min="0" label="庫存"></el-input-number>
                                                </el-form-item>
                                                <el-form-item label="價格" :label-width="'120px'">
                                                    <el-input v-model="subProductForm.subPrice" autocomplete="off"></el-input>
                                                </el-form-item>
                                                <el-form-item label="促銷價" :label-width="'120px'">
                                                    <el-input v-model="subProductForm.subDiscountPrice" autocomplete="off"></el-input>
                                                </el-form-item>
                                            </el-form>
                                            <div slot="footer" class="dialog-footer">
                                                <el-button @click="subproductFormVisible = false">取消</el-button>
                                                <el-button type="primary" @click="addSubProduct()">確定</el-button>
                                            </div>
                                        </el-dialog>
                                        <button class="btn btn-default btn-block" type="submit" @click="isSubmit = false">新增商品規格&nbsp;<i class="el-icon-plus"></i></button>
                                    </div>
                                    <table class="table field-table" v-if="productContent[selectedLocale].productType == 'simple'">
                                        <tr>
                                            <td width="130"><label for="serialNumber">型號</label></td>
                                            <td><input class="form-control" type="text" name="serialNumber" v-model="productContent[selectedLocale].serialNumber"></td>
                                        </tr>
                                        <tr>
                                            <td width="130"><label for="rule">貨號</label></td>
                                            <td><input class="form-control" type="text" name="rule" v-model="productContent[selectedLocale].rule"></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="tab-pane" id="panel-119853">
                                    <table class="table field-table">
                                        <tr>
                                            <td width="130">
                                                <label for="seoTitle">網站標題</label>
                                            </td>
                                            <td>
                                                <input type="text" name="seoTitle" class="form-control" v-model="productContent[selectedLocale].seoTitle">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="seoKeyword">關鍵字 (*以 , 分隔)</label>
                                            </td>
                                            <td>
                                                <input type="text" name="seoKeyword" class="form-control" v-model="productContent[selectedLocale].seoKeyword">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>社群圖片</label>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" type="button" v-if="(productContent[selectedLocale].socialImage === null) || (productContent[selectedLocale].socialImage === '')" @click="addSeoImage()">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                                <div v-else class="ch-social-image">
                                                    <img v-bind:src="productContent[selectedLocale].socialImage" width="50%">
                                                    <button type="button" class="btn btn-primary" @click="addSeoImage()"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                                    <button type="button" class="btn btn-danger" @click="productContent[selectedLocale].socialImage = null"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="seoDescription">社群描述</label>
                                            </td>
                                            <td>
                                                <textarea type="text" name="seoDescription" class="form-control" style="resize: vertical;" v-model="productContent[selectedLocale].seoDescription"></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            商品簡述
                        </h3>
                    </div>
                    <div class="panel-body">
                        <ckeditor
                            v-if="editorShow"
                            class="ch-product-description"
                            :config="ckConfig"
                            v-model="productContent[selectedLocale].shortDescription">
                        </ckeditor>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel-group" id="panel-77874">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                發表
                            </h3>
                        </div>
                        <div class="panel-body" v-if="false">
                            <div class="tabbable" id="tabs-464193">
                                <label for="price">會員優惠 NT$:</label>
                                <input type="number" class="form-control" name="price" v-model="productContent[selectedLocale].price" required>
                                <label for="discountedPrice">促銷價 NT$:</label>
                                <input type="number" class="form-control" name="discountedPrice" v-model="productContent[selectedLocale].discountedPrice">
                        
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button v-if="isDirty" type="submit" class="btn btn-primary btn-sm btn-block" @click="isSubmit = true">
                                <span v-if="isEdit">編輯商品</span>
                                <span v-else>發布商品</span>
                            </button>
                            <button v-else type="button" class="btn btn-primary btn-sm btn-block" name="button" disabled>
                                <span v-if="isEdit">編輯商品</span>
                                <span v-else>發布商品</span>
                            </button>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                發布狀態
                            </h3>
                        </div>
                        <div class="panel-body">
                            <table width="100%" class="table field-table">
                                <tr>
                                    <td><label>繁體中文</label></td>
                                    <td>
                                        <el-switch
                                            v-model="productContent['zh-TW'].isPublish"
                                            active-color="#13ce66"
                                            inactive-color="#ff4949">
                                        </el-switch>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>簡體中文</label></td>
                                    <td>
                                        <el-switch
                                            v-model="productContent['zh-CN'].isPublish"
                                            active-color="#13ce66"
                                            inactive-color="#ff4949">
                                        </el-switch>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>英文</label></td>
                                    <td>
                                        <el-switch
                                            v-model="productContent['en'].isPublish"
                                            active-color="#13ce66"
                                            inactive-color="#ff4949">
                                        </el-switch>
                                    </td>
                                </tr>
                                <tr v-if="false">
                                    <td><label for="datetime">上架時間</label></td>
                                    <td width="30" align="right">
                                        <i  class="fa fa-times"
                                            aria-hidden="true"
                                            @click="productContent[selectedLocale].schedulePost = null"
                                            v-if="productContent[selectedLocale].schedulePost != null"></i>
                                    </td>
                                </tr>
                                <tr v-if="false">
                                    <td colspan="2">
                                        <el-date-picker
                                            v-model="productContent[selectedLocale].schedulePost"
                                            type="datetime"
                                            placeholder="選擇商品上架時間">
                                        </el-date-picker>
                                    </td>
                                </tr>
                                <tr v-if="false">
                                    <td><label for="schedule-down">下架時間</label></td>
                                    <td align="right">
                                        <i  class="fa fa-times"
                                            aria-hidden="true"
                                            @click="productContent[selectedLocale].scheduleDelete = null"
                                            v-if="productContent[selectedLocale].scheduleDelete != null"></i>
                                    </td>
                                </tr>
                                <tr v-if="false">
                                    <td colspan="2">
                                        <el-date-picker
                                            v-model="productContent[selectedLocale].scheduleDelete"
                                            type="datetime"
                                            placeholder="選擇商品下架時間">
                                        </el-date-picker>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                類別選擇
                            </h3>
                        </div>
                        <div class="panel-body">
                            <table class="table field-table">
                                <tr>
                                    <td>
                                        主類別
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="form-control" v-model="productContent[selectedLocale].mainCategory" required>
                                            <option :value="null">--不指定--</option>
                                            <option v-for="item in rootLayer" v-bind:key="item.guid" v-bind:value="item.guid">{{item.name}}</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        產品類型
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="form-control" v-model="productContent[selectedLocale].subCategory" required>
                                            <option :value="null">--不指定--</option>
                                            <option v-for="item in secLayer" v-bind:key="item.guid" v-bind:value="item.guid">{{item.name}}</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        產品型式
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="form-control" v-model="productContent[selectedLocale].productCategory">
                                            <option :value="null">--不指定--</option>
                                            <option v-for="item in thirdLayer" v-bind:key="item.guid" v-bind:value="item.guid">{{item.name}}</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                商品圖片
                            </h3>
                        </div>
                        <div class="panel-body">
                            <a v-if="productContent[selectedLocale].featureImage === null" @click="selectFeatureImg()">設定商品圖片</a>
                            <div v-else class="">
                                <img id="featurePreview" style="width: 100%" v-bind:src="thumb(productContent[selectedLocale].featureImage)" @click="selectFeatureImg()">
                                <p>點選圖片以編輯或更新</p>
                                <a @click="deleteFeatureImg()">刪除商品圖片</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                商品圖庫
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div
                                    class="col-md-6 pruduct-image"
                                    v-bind:key="item.guid"
                                    v-for="(item, index) in productContent[selectedLocale].album">
                                    <img v-bind:src="thumb(item.imageUrl)" width="100%">
                                    <button class="btn btn-danger remove-pruduct-image" @click="productContent[selectedLocale].album.splice(index, 1)">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="col-md-12">
                                    <a @click="addImage()">新增商品圖庫圖片</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
        

    </div>
</template>

<script>
    import Ckeditor from 'vue-ckeditor2';
    import ElementUI from 'element-ui';
    import 'element-ui/lib/theme-chalk/index.css';
    import lang from 'element-ui/lib/locale/lang/zh-TW'
    import locale from 'element-ui/lib/locale'

    var dateTimePick = require('../../../../common/dateTimePick.vue');
    var productMethod = require('../../../../lib/product.js').default;
    var common = require('../../../../lib/common.js').default;

    Vue.use(ElementUI);
    locale.use(lang)

    export default {
        components: {
            Ckeditor,
            dateTimePick
        },
        data() {
            return {
                editorShow: true,
                isLoaded: false,
                isEdit: false,
                guid: $('#row-guid').val(),                
                categories:[],
                selectedLocale: 'zh-TW',
                config: {
                    minDate: moment()
                },
                isDirty: false,
                ...common.conf(),
                ...productMethod.data()
            }
        },
        beforeCreate() {

        },
        created() {
            let self = this
            if (this.guid) {
                this.getCategories().then(val => {
                    self.getProduct();
                })
                this.isEdit = true;
            } else {
                this.getCategories();
                this.isLoaded = true;

            }
            

            $('.loading-bar').fadeOut('100');
        },
        watch: {
            productContent: {
                handler(productContent, oldVal) {
                    var self = this;

                    this.isDirty = true;
                },
                deep: true
            },
            selectedLocale() {
                this.editorShow = false

                setTimeout(() => {
                    this.editorShow = true
                }, 500);
            }
        },
        computed: {
            ...productMethod.compute()
        },
        methods: {
            thumb(url) {
                var urlArray = url.split('/');
                var newUrl = urlArray[0];

                for (var i = 1; i < (urlArray.length - 1); i++) {
                    newUrl = newUrl + '/' + urlArray[i];
                }

                newUrl = newUrl + '/thumbs/' + urlArray[urlArray.length - 1];

                return newUrl;
            },
            selectFeatureImg() {
                var self = this;

                window.open('/laravel-filemanager' + '?type=Images', 'FileManager', 'width=900,height=600');
                window.SetUrl = function (url, file_path) {
                    self.productContent[self.selectedLocale].featureImage = file_path;
                };
            },
            deleteFeatureImg() {
                this.productContent.featureImage = null;
            },
            addImage() {
                var self = this;

                window.open('/laravel-filemanager' + '?type=Images', 'FileManager', 'width=900,height=600');
                window.SetUrl = function (url, file_path) {
                    self.productContent[self.selectedLocale].album.push({
                        imageUrl: file_path
                    });
                };
            },
            addSeoImage() {
                var self = this;

                window.open('/laravel-filemanager' + '?type=Images', 'FileManager', 'width=900,height=600');
                window.SetUrl = function (url, file_path) {
                    self.productContent[self.selectedLocale].socialImage = file_path;
                };
            },
            saveProduct() {
                var self = this;
                var token = this.token;
                var schedulePost;
                var scheduleDelete;

                if (this.isEdit && !this.isSubmit) {
                    self.openSubProductModal()
                    return
                }

                console.log(delete this.productContent.subProduct)

                axios.post(this.isEdit ? '/admin/product/edit/' + this.guid : '/admin/product/add', this.productContent)
                    .then(res => {
                        if (this.isSubmit) {
                            this.showMessage('success', '商品儲存成功')
                            setTimeout(() => {
                                // window.location.href="/cyberholic-system/product/list";
                            }, 1500)
                        } else {
                            this.isEdit = true
                            this.guid = result.data.productGuid
                            this.openSubProductModal()
                        }
                    })
                    
                return

                this.checkPathExist()
                    .then(function (isPath) {
                        console.log(isPath);
                        if (true) {
                            if (self.isAllowToSave) {
                                $.ajax({
                                    url: self.isEdit ? '/admin/product/edit/' + self.guid : '/admin/product/add',
                                    type: 'POST',
                                    cache: false,
                                    dataType: 'json',
                                    data: {
                                        productTitle: self.productContent.productTitle,
                                        productDescription: JSON.stringify(self.productContent.productDescription),
                                        shortDescription: self.productContent.shortDescription,
                                        serialNumber: self.productContent.serialNumber,
                                        rule: self.productContent.rule,
                                        quantity: self.productContent.quantity,
                                        productCategory: self.productContent.productCategory,
                                        mainCategory: self.productContent.mainCategory,
                                        subCategory: self.productContent.subCategory,
                                        price: self.productContent.price,
                                        Temperature: self.productContent.Temperature,
                                        isPublish: self.productContent.isPublish,
                                        customPath: self.productContent.customPath,
                                        reserveStatus: self.productContent.reserveStatus,
                                        productType: self.productContent.productType,
                                        discountedPrice: self.productContent.discountedPrice,
                                        socialImage: self.productContent.socialImage,
                                        seoTitle: self.productContent.seoTitle,
                                        seoDescription: self.productContent.seoDescription,
                                        seoKeyword: self.productContent.seoKeyword,
                                        featureImage: self.productContent.featureImage,
                                        productInformation: JSON.stringify(self.productContent.productInformation),
                                        album: JSON.stringify(self.productContent.album),
                                        productStatus: self.productContent.productStatus,
                                        schedulePost: self.schedulePostDate,
                                        scheduleDelete: self.scheduleDeleteDate
                                    },
                                    beforeSend: function(xhr) {
                                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                                    }
                                })
                                .done(function(result) {
                                    if (self.isSubmit) {
                                        self.showMessage('success', '商品儲存成功')
                                        setTimeout(() => {
                                            window.location.href="/cyberholic-system/product/list";
                                        }, 1500)
                                    } else {
                                        self.isEdit = true
                                        self.guid = result.data.productGuid
                                        self.openSubProductModal()
                                    }
                                    
                                })
                                .fail(function() {
                                    console.log("error");
                                })
                                .always(function() {
                                    console.log("complete");
                                });
                            } else {
                                console.log('not allow');
                            }
                        } else {
                            self.showMessage('warning', '自定義路徑已經存在，請使用其他路徑');
                        }
                    });
            },
            getSubProduct() {
                var self = this;

                axios.get(`/admin/product/sub/get/${this.guid}`)
                    .then(res => {
                        self.productContent.subProduct = res.data.data
                    })
                },
            getProduct() {
                var self = this;

                // this.getSubProduct()

                $.ajax({
                    url: '/admin/product/get/' + this.guid,
                    type: 'GET',
                    cache: false
                })
                .done(function(result) {
                    let localeArr = Object.keys(result);
                    // console.log(result);
                    // return 
                    localeArr.forEach(elm => {
                        self.productContent[elm].productTitle = result[elm].productTitle;
                        self.productContent[elm].serialNumber = result[elm].serialNumber;
                        self.productContent[elm].rule = result[elm].rule;
                        self.productContent[elm].price = result[elm].price;
                        self.productContent[elm].discountedPrice = result[elm].discountedPrice;
                        self.productContent[elm].productCategory = result[elm].productCategory;
                        self.productContent[elm].mainCategory = result[elm].mainCategory;
                        self.productContent[elm].subCategory = result[elm].subCategory;
                        self.productContent[elm].featureImage = result[elm].featureImage;
                        self.productContent[elm].album = JSON.parse(result[elm].album);
                        self.productContent[elm].productDescription = JSON.parse(result[elm].productDescription);
                        self.productContent[elm].shortDescription = result[elm].shortDescription;
                        self.productContent[elm].customPath = result[elm].customPath;
                        self.productContent[elm].productStatus = result[elm].productStatus;
                        self.productContent[elm].Temperature = result[elm].Temperature;
                        self.productContent[elm].reserveStatus = Boolean(result[elm].reserveStatus);
                        self.productContent[elm].isPublish = Boolean(result[elm].isPublish);
                        self.productContent[elm].productType = result[elm].productType;
                        self.productContent[elm].quantity = result[elm].quantity;
                        self.productContent[elm].seoKeyword = result[elm].seoKeyword;
                        self.productContent[elm].seoTitle = result[elm].seoTitle;
                        self.productContent[elm].productInformation = JSON.parse(result[elm].productInformation);
                        self.productContent[elm].seoDescription = result[elm].seoDescription;
                        self.productContent[elm].socialImage = result[elm].socialImage;
                        self.productContent[elm].schedulePost = (result[elm].schedulePost != null) ? moment(result[elm].schedulePost) : null;
                        self.productContent[elm].scheduleDelete = (result[elm].scheduleDelete != null) ? moment(result[elm].scheduleDelete) : null;
                    });

                    self.config = {
                        minDate: (result.schedulePost != null) ? moment(result.schedulePost) : null
                    }
                    self.isLoaded = true;
                    // console.log(sec) 
                    setTimeout(function () {
                        self.isDirty = false;
                    }, 50);
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
            },
            openSubProductModal() {
                this.subproductFormVisible = true

                this.subProductForm = {
                    subTitle: null,
                    subSerialNumber: null,
                    subQuantity: null,
                    subPrice: null,
                    subDiscountPrice: null
                }
            },
            saveSubProduct(form) {
                let self = this
                let model = this.$refs[form][0].model

                $('.loading-bar').show()
                axios.post(`/admin/product/sub/update/${model.subProductGuid}`, model)
                    .then(res => {
                        self.$message.success('編輯子商品成功')
                    }).catch(err => {
                        self.$message.error('編輯子商品失敗')
                    }).then(arg => {
                        self.getSubProduct()
                        $('.loading-bar').hide()
                    })
            },
            deleteSubProduct(guid) {
                let self = this

                this.$confirm('此操作將會永久刪除子商品, 是否繼續?', '提示', {
                    confirmButtonText: '確定',
                    cancelButtonText: '取消',
                    type: 'warning',
                    center: true
                }).then(() => {
                    $('.loading-bar').show()
                    axios.post(`/admin/product/sub/delete/${guid}`)
                        .then(res => {
                            self.$message.success('刪除子商品成功')
                        }).catch(err => {
                            self.$message.error('刪除子商品失敗')
                        }).then(arg => {
                            self.getSubProduct()
                            $('.loading-bar').hide()
                        })
                }).catch(() => {
                    console.log(guid)
                });

                
            },
            addSubProduct() {
                let self = this

                this.subProductForm.productParent = this.guid

                axios.post('/admin/product/sub/add', this.subProductForm)
                    .then(res => {
                        self.$message
                        self.$message({
                            message: '建立子商品成功',
                            type: 'success'
                        });
                        self.getSubProduct()
                    }).catch(err => {
                        self.$message.error('建立子商品失敗');
                    }).then(arg => {
                        self.subproductFormVisible = false
                    })
            },
            checkPathExist() {
                var self = this;

                return new Promise(function (resolve, reject) {
                    resolve(true)
                });

            },
            switchType() {
                if (this.productContent.productType == 'variable') {
                    if (!localStorage.switchProductType) {
                        this.showSwitchTips = true
                    }
                }                
            },
            checkToolTip() {
                if (this.noShow) {
                    localStorage.setItem('switchProductType', 'checked')
                }
                this.showSwitchTips = false
            },
            getCategories() {
                var self = this;
                var token = this.token;

                return new Promise(function (resolve, reject) {
                    let vo = {
                        type: 'product'
                    }
                    axios.post('/admin/category/get', vo)
                        .then(res => {
                            let rootLayer = _.filter(res.data, ['parentId', null])
                            let secLayer = [];
                            let finalResult = []
                            // console.log(rootLayer)
                            // self.categories = [];

                            self.rootLayer = _.filter(res.data, ['parentId', null]).map(elm => {
                                return {
                                    'name': elm.categoryTitle,
                                    'guid': elm.categoryGuid,
                                    'parentId': elm.parentId
                                }
                            })

                            res.data.forEach(function(item) {
                                if (_.find(rootLayer, ['categoryGuid', item.parentId])) {
                                    secLayer.push({
                                        'name': item.categoryTitle,
                                        'guid': item.categoryGuid,
                                        'parentId': item.parentId
                                    }); 
                                } else {
                                    if (item.parentId) {
                                        finalResult.push({
                                            'name': item.categoryTitle,
                                            'guid': item.categoryGuid,
                                            'parentId': item.parentId
                                        }); 
                                    }
                                }
                            });

                            // finalResult.forEach(elm => {
                            //     let sec = _.find(secLayer, ['guid', elm.parentId])
                            //     let root = _.find(rootLayer, ['categoryGuid', sec.parentId])

                            //     elm.name = `${root.categoryTitle} / ${sec.name} / ${elm.name}`
                            // })

                            self.allCategories = res.data
                            self.categories = finalResult;

                            self.$nextTick(() => {
                                resolve(true)
                            })
                        }).catch(err => {
                            reject(err)
                        })
                })

            },
            clearString(s) {
                var pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）&;|{}【】‘；：”“'。，、？]")
                var rs = "";

                for (var i = 0; i < s.length; i++) {
                    rs = rs+s.substr(i, 1).replace(pattern, '');
                }

                return rs;
            },
            showMessage(type, string) {
                toastr[type](string);
            }
        }
    }
</script>

<style>
.el-date-editor.el-input, .el-date-editor.el-input__inner {
    width: 100%;
    margin-bottom: 5px;
}

.el-date-picker__editor-wrap .el-time-panel {
    left: -20px;
}
</style>
