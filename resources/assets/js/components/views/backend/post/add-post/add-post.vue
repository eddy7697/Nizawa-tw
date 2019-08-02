<template>
    <div class="row" v-if="isLoaded">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-8">
                    <el-radio-group v-model="selectedLocale" size="medium" style="margin-bottom: 10px;">
                        <el-radio-button label="zh-TW">繁體中文</el-radio-button>
                        <el-radio-button label="zh-CN">简体中文</el-radio-button>
                        <el-radio-button label="en">英文</el-radio-button>
                    </el-radio-group>
                </div>
                <div class="col-md-4" style="text-align: right">
                    <el-button size="medium" type="primary" @click="duplicateContent">
                        複製內容
                    </el-button>
                </div>
            </div>
            <input type="text" class="form-control ch-product-title" name="title" value="" placeholder="最新消息標題" v-model="postContent[selectedLocale].postTitle">
            <div class="form-group" v-if="false">
                <label for="">{{currentPath}}/blog/</label>
                <input type="text" class="form-control" v-model="postContent[selectedLocale].privatePath" style="width: fit-content; display:inline-block">
                <label v-if="pathUsable">可使用</label>
                <label v-else>已存在</label>
            </div>
            <ckeditor
                v-if="editorShow"
                class="ch-product-description"
                :config="ckConfig"
                v-model="postContent[selectedLocale].content">
            </ckeditor>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        最新消息資訊
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="tabbable ch-tab" id="tabs-865853">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#panel-119853" data-toggle="tab">SEO 設定</a>
                            </li>
                        </ul>
                        <div class="tab-content ch-tab-content">
                            <div class="tab-pane active" id="panel-119853">
                                <table class="table field-table">
                                    <tr>
                                        <td width="130">
                                            <label for="seoTitle">網站標題</label>
                                        </td>
                                        <td>
                                            <input type="text" name="seoTitle" class="form-control" v-model="postContent[selectedLocale].seoTitle">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="seoKeyword">關鍵字 (*以 , 分隔)</label>
                                        </td>
                                        <td>
                                            <input type="text" name="seoKeyword" class="form-control" v-model="postContent[selectedLocale].seoKeyword">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>社群圖片</label>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary" type="button" v-if="(postContent[selectedLocale].socialImage === null) || (postContent[selectedLocale].socialImage === '')" @click="addSeoImage()">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                            <div v-else class="ch-social-image">
                                                <img v-bind:src="postContent[selectedLocale].socialImage" width="50%">
                                                <button type="button" class="btn btn-primary" @click="addSeoImage()"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                                <button type="button" class="btn btn-danger" @click="postContent[selectedLocale].socialImage = null"><i class="fa fa-times" aria-hidden="true"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="seoDescription">社群描述</label>
                                        </td>
                                        <td>
                                            <textarea type="text" name="seoDescription" class="form-control" style="resize: vertical;" v-model="postContent[selectedLocale].seoDescription"></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
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
    				<div class="panel-body">
                        <table width="100%">
                            <tr>
                                <td>
                                    <label for="isPublish">最新消息狀態</label>
                                </td>
                                <td align="right">
                                    <toggle-button v-model="postContent[selectedLocale].isPublish"/>
                                </td>
                            </tr>
                        </table>
                        <div class="tabbable" id="tabs-464193" v-if="false">
            				<ul class="nav nav-tabs ch-tab">
            					<li class="active">
            						<a href="#panel-44467" data-toggle="tab">發布排程</a>
            					</li>
            				</ul>
            				<div class="tab-content ch-tab-content">
            					<div class="tab-pane active" id="panel-44467">
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <label for="isPublish">最新消息狀態</label>
                                            </td>
                                            <td align="right">
                                                <toggle-button v-model="postContent[selectedLocale].isPublish"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="datetime">發布時間</label></td>
                                            <td width="30" align="right">
                                                <i  class="fa fa-times"
                                                    aria-hidden="true"
                                                    @click="postContent[selectedLocale].schedulePost = null"
                                                    v-if="postContent[selectedLocale].schedulePost != null"></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <date-picker
                                                    v-model="postContent[selectedLocale].schedulePost"
                                                    placeholder="選擇最新消息發布時間"
                                                    :config="config">
                                                </date-picker>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="schedule-down">下線時間</label></td>
                                            <td align="right">
                                                <i  class="fa fa-times"
                                                    aria-hidden="true"
                                                    @click="postContent[selectedLocale].scheduleDelete = null"
                                                    v-if="postContent[selectedLocale].scheduleDelete != null"></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <date-picker
                                                    v-model="postContent[selectedLocale].scheduleDelete"
                                                    placeholder="選擇最新消息下線時間"
                                                    :config="scheduleDeleteConfig">
                                                </date-picker>
                                            </td>
                                        </tr>
                                    </table>
            					</div>
            				</div>
            			</div>
    				</div>
    				<div class="panel-footer">
                        <button v-if="isDirty" type="button" class="btn btn-primary btn-sm btn-block" name="button" @click="savePost()">發布最新消息</button>
                        <button v-else type="button" class="btn btn-primary btn-sm btn-block" name="button" disabled>發布最新消息</button>
    				</div>
    			</div>
                <div class="panel panel-default">
    				<div class="panel-heading">
    					<h3 class="panel-title">
    						類別選擇
    					</h3>
    				</div>
    				<div class="panel-body">
                        <select class="form-control" v-model="postContent[selectedLocale].postCategory">
                            <option value="null">--不指定--</option>
                            <option v-for="(item, index) in categories" v-bind:value="item.guid" v-bind:key="index">
                                {{JSON.parse(item.name)['zh-TW']}}
                            </option>
                        </select>
    				</div>
    			</div>
                <div class="panel panel-default">
    				<div class="panel-heading">
    					<h3 class="panel-title">
    						代表圖片
    					</h3>
    				</div>
    				<div class="panel-body">
                        <a v-if="postContent[selectedLocale].featureImage === null" @click="selectFeatureImg()">設定代表圖片</a>
                        <div v-else class="">
                            <img v-bind:src="thumb(postContent[selectedLocale].featureImage)" id="featurePreview" style="width: 100%" @click="selectFeatureImg()">
                            <p>點選圖片以編輯或更新</p>
                            <a @click="deleteFeatureImg()">刪除代表圖片</a>
                        </div>
    				</div>
    			</div>
            </div>

        </div>

    </div>
</template>

<script>
    import Ckeditor from 'vue-ckeditor2';
    import datePicker from 'vue-bootstrap-datetimepicker';
    import ToggleButton from 'vue-js-toggle-button';
    import ElementUI from 'element-ui';
    import 'element-ui/lib/theme-chalk/index.css';
    import lang from 'element-ui/lib/locale/lang/zh-TW'
    import locale from 'element-ui/lib/locale'

    Vue.use(ToggleButton);
    Vue.use(ElementUI);
    locale.use(lang)

    export default {
        components: {
            Ckeditor,
            datePicker
        },
        data() {
            return {
                pathUsable: false,
                selectedLocale: 'zh-TW',
                isLoaded: false,
                isEdit: false,
                currentPath: window.location.origin,
                guid: $('#row-guid').val(),
                postContent: {
                    'zh-TW': {
                        postTitle: null,
                        postCategory: 'null',
                        content: null,
                        featureImage: null,
                        customPath: 'null',
                        seoTitle: null,
                        seoKeyword: null,
                        socialImage: null,
                        seoDescription: null,
                        isPublish: true,
                        schedulePost: null,
                        scheduleDelete: null
                    },
                    'zh-CN': {
                        postTitle: null,
                        postCategory: 'null',
                        content: null,
                        featureImage: null,
                        customPath: 'null',
                        seoTitle: null,
                        seoKeyword: null,
                        socialImage: null,
                        seoDescription: null,
                        isPublish: true,
                        schedulePost: null,
                        scheduleDelete: null
                    },
                    'en': {
                        postTitle: null,
                        postCategory: 'null',
                        content: null,
                        featureImage: null,
                        customPath: 'null',
                        seoTitle: null,
                        seoKeyword: null,
                        socialImage: null,
                        seoDescription: null,
                        isPublish: true,
                        schedulePost: null,
                        scheduleDelete: null
                    }
                },
                ckConfig: {
                    height: 300,
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=' + $('meta[name="csrf-token"]').attr('content'),
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=' + $('meta[name="csrf-token"]').attr('content')
                },
                categories:[],
                config: {
                    minDate: moment()
                },
                isDirty: false,
                editorShow: true,
                token: $('meta[name="csrf-token"]').attr('content')
            }
        },
        created: function () {
            var self = this;

            if (this.guid) {
                this.getPost();
                this.isEdit = true;
            } else {
                self.isLoaded = true;
            }
            this.getCategories();
            $('.loading-bar').fadeOut('100');
        },
        watch: {
            postContent: {
                handler: function (postContent, oldVal) {
                    var self = this;

                    this.isDirty = true;

                    if (postContent[this.selectedLocale].privatePath) {
                        this.checkPathExist();
                        console.log(postContent[this.selectedLocale].privatePath)
                    }
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
            schedulePostDate: function () {
                if (this.postContent[this.selectedLocale].schedulePost) {
                    return moment(this.postContent[this.selectedLocale].schedulePost).format();
                } else {
                    return null;
                }
            },
            scheduleDeleteDate: function () {
                if (this.postContent[this.selectedLocale].scheduleDelete) {
                    return moment(this.postContent[this.selectedLocale].scheduleDelete).format();
                } else {
                    return null;
                }
            },
            scheduleDeleteConfig: function functionName() {
                if (this.schedulePostDate) {
                    return {
                        minDate: moment(this.schedulePostDate)
                    }
                } else {
                    return {
                        minDate: moment()
                    }
                }
            },
            checkTitle: function () {
                if (!this.postContent[this.selectedLocale].postTitle) {
                    return false;
                } else if (this.postContent[this.selectedLocale].postTitle.trim() === '') {
                    return false;
                } else {
                    return true;
                }
            },
            checkContent: function () {
                if (!this.postContent[this.selectedLocale].content) {
                    return false;
                } else if (this.postContent[this.selectedLocale].content.trim() === '') {
                    return false;
                } else {
                    return true;
                }
            },
            checkTime: function () {
                return true;
                if ((this.productContent.schedulePost !== null) && (this.productContent.scheduleDelete !== null)) {
                    var schedulePost = this.productContent.schedulePost._d.getTime();
                    var scheduleDelete = this.productContent.scheduleDelete._d.getTime();

                    if (schedulePost > scheduleDelete) {
                        return false;
                    } else {
                        return true;
                    }
                } else {
                    return true;
                }

            },
            isAllowToSave: function () {
                return this.checkTitle && this.checkContent && this.checkTime;
            }
        },
        methods: {
            getPost: function () {
                var self = this;

                $.ajax({
                    url: '/admin/post/get/' + this.guid,
                    type: 'GET',
                    cache: false
                })
                .done(function(result) {
                    console.log(result)
                    let localeArr = Object.keys(result);

                    localeArr.forEach(elm => {
                        self.postContent[elm].postTitle = result[elm].postTitle;
                        self.postContent[elm].postCategory = result[elm].postCategory;
                        self.postContent[elm].content = result[elm].content;
                        self.postContent[elm].featureImage = result[elm].featureImage;
                        self.postContent[elm].seoTitle = result[elm].seoTitle;
                        self.postContent[elm].seoKeyword = result[elm].seoKeyword;
                        self.postContent[elm].customPath = result[elm].customPath;
                        self.postContent[elm].socialImage = result[elm].socialImage;
                        self.postContent[elm].seoDescription = result[elm].seoDescription;
                        self.postContent[elm].isPublish = Boolean(result[elm].isPublish);
                        self.postContent[elm].schedulePost = (result[elm].schedulePost != null) ? moment(result[elm].schedulePost) : null;
                        self.postContent[elm].scheduleDelete = (result[elm].scheduleDelete != null) ? moment(result[elm].scheduleDelete) : null;
                    });
                    

                    self.isLoaded = true;
                    self.isDirty = false;
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
            },
            savePost: function () {
                var self = this;
                var token = this.token;

                // if (!this.postContent[this.selectedLocale].customPath) {
                //     this.postContent[this.selectedLocale].customPath = this.clearString(this.postContent[this.selectedLocale].postTitle);
                // }

                axios.post(self.isEdit ? '/admin/post/edit/' + self.guid : '/admin/post/add', this.postContent)
                    .then(res => {
                        this.showMessage('success', '文章儲存成功')
                        setTimeout(() => {
                            window.location.href="/cyberholic-system/post/list";
                        }, 1500)
                        // if (this.isSubmit) {
                        //     this.showMessage('success', '文章儲存成功')
                        //     setTimeout(() => {
                        //         window.location.href="/cyberholic-system/post/list";
                        //     }, 1500)
                        // } else {
                        //     this.isEdit = true
                        //     this.guid = res.data.postGuid
                        // }
                    })
                    
                return

                this.checkPathExist()
                    .then(function (isPath) {
                        if (true) {
                            if (self.isAllowToSave) {
                                
                                $.ajax({
                                    url: self.isEdit ? '/admin/post/edit/' + self.guid : '/admin/post/add',
                                    type: 'POST',
                                    cache: false,
                                    dataType: 'json',
                                    data: {
                                        postTitle: self.postContent.postTitle,
                                        postCategory: self.postContent.postCategory,
                                        content: self.postContent.content,
                                        featureImage: self.postContent.featureImage,
                                        seoTitle: self.postContent.seoTitle,
                                        seoKeyword: self.postContent.seoKeyword,
                                        customPath: self.postContent.customPath,
                                        socialImage: self.postContent.socialImage,
                                        seoDescription: self.postContent.seoDescription,
                                        isPublish: self.postContent.isPublish,
                                        schedulePost: self.schedulePostDate,
                                        scheduleDelete: self.scheduleDeleteDate
                                    },
                                    beforeSend: function(xhr) {
                                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                                    }
                                })
                                .done(function() {
                                    window.location.href="/cyberholic-system/post/list";
                                    console.log("success");
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
            thumb: function (url) {
                var urlArray = url.split('/');
                var newUrl = urlArray[0];

                for (var i = 1; i < (urlArray.length - 1); i++) {
                    newUrl = newUrl + '/' + urlArray[i];
                }

                newUrl = newUrl + '/thumbs/' + urlArray[urlArray.length - 1];

                return newUrl;
            },
            checkPathExist: function () {
                var self = this;

                // axios.post('/admin/post/check/privatePath/' + self.postContent[self.selectedLocale].privatePath)

                return new Promise(function (resolve, reject) {
                    axios.post('/admin/post/check/privatePath/' + self.postContent[self.selectedLocale].privatePath)
                        .then(res => {
                            self.pathUsable = true
                            resolve(true)
                            
                        }).catch(err => {
                            let result = err.response
                            if (result.status === 431) {
                                self.pathUsable = false
                                resolve(false);
                            } else {
                                reject(result);
                            }
                        })
                    // $.ajax({
                    //     url: '/admin/post/check/privatePath/' + self.postContent[self.selectedLocale].privatePath,
                    //     type: 'POST',
                    //     dataType: 'json'
                    // })
                    // .done(function(response) {
                    //     resolve(true);
                    // })
                    // .fail(function(xhr) {
                    //     console.log(xhr.status);
                    //     if (xhr.status === 431) {
                    //         resolve(false);
                    //     } else {
                    //         reject(xhr);
                    //     }
                    // });
                });

            },
            duplicateContent() {
                this.$confirm('確認要將此語系內容複製到其他語系?', '複製內容', {
                    confirmButtonText: '確定',
                    cancelButtonText: '取消',
                    type: 'info'
                }).then(() => {
                    let contentEn = JSON.parse(JSON.stringify(this.postContent['zh-TW'])),
                        contentCn = JSON.parse(JSON.stringify(this.postContent['zh-TW']))

                    contentEn.locale = 'en'
                    this.postContent['en'] = contentEn

                    contentCn.locale = 'zh-CN'
                    this.postContent['zh-CN'] = contentCn

                    this.$message({
                        type: 'success',
                        message: '複製成功!'
                    });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消複製'
                    });          
                });                
            },
            selectFeatureImg: function () {
                var self = this;

                window.open('/laravel-filemanager' + '?type=Images', 'FileManager', 'width=900,height=600');
                window.SetUrl = function (url, file_path) {
                    self.postContent[self.selectedLocale].featureImage = file_path;
                };
            },
            deleteFeatureImg: function () {
                this.postContent[this.selectedLocale].featureImage = null;
            },
            getCategories: function () {
                var self = this;
                var token = this.token;

                $.ajax({
                    url: '/admin/category/get',
                    type: 'POST',
                    cache: false,
                    data: {
                        type: 'post'
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function(result) {
                    self.categories = [];
                    result.forEach(function(item) {
                        self.categories.push({
                            'name': item.categoryTitle,
                            'guid': item.categoryGuid
                        });
                    });

                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });

            },
            addSeoImage: function () {
                var self = this;

                window.open('/laravel-filemanager' + '?type=Images', 'FileManager', 'width=900,height=600');
                window.SetUrl = function (url, file_path) {
                    self.postContent[self.selectedLocale].socialImage = file_path;
                };
            },
            clearString: function (s) {
                var pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）&;|{}【】‘；：”“'。，、？]")
                var rs = "";

                for (var i = 0; i < s.length; i++) {
                    rs = rs+s.substr(i, 1).replace(pattern, '');
                }

                return rs;
            },
            showMessage: function (type, string) {
                toastr[type](string);
            }
        }
    }
</script>
