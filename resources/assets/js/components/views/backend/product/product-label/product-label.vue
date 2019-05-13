<template>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        品牌管理
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table field-table">
                        <thead>
                            <tr>
                                <!-- <th width="50"></th> -->
                                <th>品牌名稱</th>
                                <th width="50" style="text-align: center">編輯</th>
                                <th width="50" style="text-align: center">刪除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in categories" :key="index">
                                <!-- <td>
                                    <img width="40" v-bind:src="item.featureImage">
                                </td> -->
                                <td>
                                    <span>{{ parseTitle(item.name) }}</span>
                                </td>
                                <td align="center">
                                    <span style="cursor: pointer" @click="openEditModal(item)" class="glyphicon glyphicon-pencil"></span>
                                </td>
                                <td align="center">
                                    <span style="cursor: pointer" @click="deleteCategory(item.guid)" class="glyphicon glyphicon-trash"></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        新增品牌
                    </h3>
                    <button style="margin-top: 10px;" class="btn btn-primary" @click="translateTitle('addCategoryForm')">一鍵翻譯</button> <span style="color: #73879C; position: absolute; top: 45px;">當前版本僅支援中翻英</span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">
                            品牌名稱 (繁體)
                        </label>
                        <input type="email" class="form-control" v-model="addCategoryForm.name['zh-TW']"/>
                    </div>
                    <div class="form-group" v-if="false">
                        <label for="exampleInputEmail1">
                            品牌名稱 (簡體)
                        </label>
                        <input type="email" class="form-control" v-model="addCategoryForm.name['zh-CN']"/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">
                            品牌名稱 (英文)
                        </label>
                        <input type="email" class="form-control" v-model="addCategoryForm.name['en']"/>
                    </div>
                    <!-- <div class="form-group">
                        <label for="exampleInputEmail1">
                            品牌語系
                        </label>
                        <select class="form-control" v-model="addCategoryForm.locale">
                            <option value="en">英文</option>
                            <option value="zh-TW">繁體中文</option>
                        </select>
                    </div> -->
                    <!-- 暫不使用子父品牌功能 -->


                    <!-- <div class="form-group">
                        <label for="exampleInputPassword1">
                            上層
                        </label>
                        <select class="form-control" id="parent-select" name="" v-model="addCategoryForm.parentId" >
                            <option value="null">--不指定--</option>
                            <option v-for="item in categories" v-bind:value="item.guid"> {{ item.name }}</option>
                        </select>
                    </div> -->
                    <div class="form-group" v-if="false">
                        <label for="exampleInputEmail1">
                            品牌描述
                        </label>
                        <!-- <ckeditor
                            id="add-area"
                            class="ch-product-description"
                            :config="ckConfig"
                            v-model="addCategoryForm.description">
                        </ckeditor> -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">繁體中文</a></li>
                            <li><a data-toggle="tab" href="#menu1">簡體中文</a></li>
                            <li><a data-toggle="tab" href="#menu2">英文</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <!-- <ckeditor
                                    id="edit-area1"
                                    class="ch-product-description"
                                    :config="ckConfig"
                                    v-model="addCategoryForm.description['zh-TW']">
                                </ckeditor> -->
                                <textarea class="form-control" name="name" rows="10" style="resize: vertical" v-model="addCategoryForm.description['zh-TW']"></textarea>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <!-- <ckeditor
                                    id="edit-area2"
                                    class="ch-product-description"
                                    :config="ckConfig"
                                    v-model="addCategoryForm.description['zh-CN']">
                                </ckeditor> -->
                                <textarea class="form-control" name="name" rows="10" style="resize: vertical" v-model="addCategoryForm.description['zh-CN']"></textarea>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <!-- <ckeditor
                                    id="edit-area3"
                                    class="ch-product-description"
                                    :config="ckConfig"
                                    v-model="addCategoryForm.description['en']">
                                </ckeditor> -->
                                <textarea class="form-control" name="name" rows="10" style="resize: vertical" v-model="addCategoryForm.description.en"></textarea>
                            </div>
                        </div>
                        
                    </div>
                    <button class="btn btn-success" type="button" name="button" @click="addImage()">選擇圖片</button>
                    <div style="text-align: center">
                        <img v-bind:src="addCategoryForm.featureImage" width="50%">
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary" @click="addCategory()">
                        新增
                    </button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">編輯品牌</h4>
                        <button style="margin-top: 10px;" class="btn btn-primary" @click="translateTitle('editCategoryForm')">一鍵翻譯</button> <span style="color: #73879C; position: absolute; top: 60px;">當前版本僅支援中翻英</span>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                                品牌名稱 (繁體)
                            </label>
                            <input type="email" class="form-control" v-model="editCategoryForm.name['zh-TW']"/>
                        </div>
                        <div class="form-group" v-if="false">
                            <label for="exampleInputEmail1">
                                品牌名稱 (簡體)
                            </label>
                            <input type="email" class="form-control" v-model="editCategoryForm.name['zh-CN']"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                                品牌名稱 (英文)
                            </label>
                            <input type="email" class="form-control" v-model="editCategoryForm.name['en']"/>
                        </div>
                        <div class="form-group" v-if="false">
                            <label for="exampleInputEmail1">
                                品牌語系
                            </label>
                            <select class="form-control" v-model="editCategoryForm.locale">
                                <option value="en">英文</option>
                                <option value="zh-TW">繁體中文</option>
                            </select>
                        </div>
                        <div class="form-group" v-if="false">
                            <label for="exampleInputEmail1">
                                品牌描述
                            </label>
                                <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#home_">繁體中文</a></li>
                                <li><a data-toggle="tab" href="#menu1_">簡體中文</a></li>
                                <li><a data-toggle="tab" href="#menu2_">英文</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="home_" class="tab-pane fade in active">
                                    <textarea class="form-control" name="name" rows="10" style="resize: vertical" v-model="editCategoryForm.description['zh-TW']"></textarea>
                                </div>
                                <div id="menu1_" class="tab-pane fade">
                                    <textarea class="form-control" name="name" rows="10" style="resize: vertical" v-model="editCategoryForm.description['zh-CN']"></textarea>
                                </div>
                                <div id="menu2_" class="tab-pane fade">
                                    <textarea class="form-control" name="name" rows="10" style="resize: vertical" v-model="editCategoryForm.description.en"></textarea>
                                </div>
                            </div>
                            <!-- <ckeditor
                                id="edit-area"
                                class="ch-product-description"
                                :config="ckConfig"
                                v-model="editCategoryForm.description">
                            </ckeditor> -->
                            <!-- <textarea class="form-control" name="name" rows="10" style="resize: vertical" v-model="editCategoryForm.description"></textarea> -->
                        </div>
                        <button class="btn btn-success" type="button" name="button" @click="editImage()">選擇圖片</button>
                        <div style="text-align: center">
                            <img v-bind:src="editCategoryForm.featureImage" width="50%">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" @click="editCategory(editCategoryForm)">儲存品牌</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
    import Ckeditor from 'vue-ckeditor2';

    export default {
        components: {
            Ckeditor
        },
        data() {
            return {
                addCategoryForm: {
                    name: {
                        en: null,
                        'zh-TW': null,
                        'zh-CN': null
                    },
                    parentId: null,
                    type: 'label',
                    featureImage: null,
                    description: {
                        en: null,
                        'zh-TW': null,
                        'zh-CN': null
                    }
                },
                editCategoryForm: {
                    guid: null,
                    name: {
                        en: null,
                        'zh-TW': null,
                        'zh-CN': null
                    },
                    parentId: null,
                    type: 'label',
                    featureImage: null,
                    description: {
                        en: null,
                        'zh-TW': null,
                        'zh-CN': null
                    }
                },
                ckConfig: {
                    height: 300,
                    allowedContent: true,
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=' + $('meta[name="csrf-token"]').attr('content'),
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=' + $('meta[name="csrf-token"]').attr('content')
                },
                categories: [],
                token: $('meta[name="csrf-token"]').attr('content'),
            }
        },
        created: function () {
            this.getCategories();
            $('.loading-bar').fadeOut('100');
        },
        methods: {
            addCategory: function () {
                var self = this;
                var token = this.token;
                let vo = this.addCategoryForm

                vo.name = JSON.stringify(vo.name)
                vo.description = JSON.stringify(vo.description)

                if (self.addCategoryForm.parentId === undefined) {
                    self.addCategoryForm.parentId = null;
                }

                // if (self.addCategoryForm.name.trim() === '') {
                //     this.showMessage('warning', '欄位名稱不可為空白');
                //     return;
                // }

                $('.loading-bar').fadeIn('100');

                $.ajax({
                    url: '/admin/category/add',
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    data: vo,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function(result) {
                    self.showMessage('success', '新增品牌成功');
                    self.addCategoryForm.parentId = null;
                    self.addCategoryForm.featureImage = null;
                    self.addCategoryForm.name = {
                        en: null,
                        'zh-TW': null,
                        'zh-CN': null
                    };
                    self.addCategoryForm.description = {
                        en: null,
                        'zh-TW': null,
                        'zh-CN': null
                    };
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    self.getCategories();
                    $('.loading-bar').fadeOut('100');
                });

            },
            addImage: function () {
                var self = this;

                window.open('/laravel-filemanager' + '?type=Images', 'FileManager', 'width=1280,height=1024');
                window.SetUrl = function (url, file_path) {
                    self.addCategoryForm.featureImage = file_path;
                };
            },
            editImage: function () {
                var self = this;

                window.open('/laravel-filemanager' + '?type=Images', 'FileManager', 'width=1280,height=1024');
                window.SetUrl = function (url, file_path) {
                    self.editCategoryForm.featureImage = file_path;
                };
            },
            editCategory: function (item) {
                var self = this;
                var token = this.token;
                let vo = item

                vo.name = JSON.stringify(vo.name)
                vo.description = JSON.stringify(vo.description)

                // if (item.name.trim() === '') {
                //     this.showMessage('warning', '欄位名稱不可為空白');
                //     return;
                // }

                $('.loading-bar').fadeIn('100');

                $.ajax({
                    url: '/admin/category/update',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        category: item.guid,
                        name: vo.name,
                        locale: item.locale,
                        parentId: item.parentId,
                        featureImage: item.featureImage,
                        description: vo.description
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function(result) {
                    self.getCategories();
                    self.showMessage('success', '品牌編輯成功');
                    $('#myModal').modal('hide');
                })
                .fail(function(errorData) {
                    console.log("error");
                })
                .always(function() {
                    $('.edit-category-input').blur();
                    $('.loading-bar').fadeOut('100');
                    console.log("complete");
                });

            },
            deleteCategory: function (item) {
                var self = this;
                var token = this.token;
                var checkProperty = confirm("是否刪除品牌?");

                if (checkProperty) {
                    $.ajax({
                        url: '/admin/category/delete',
                        type: 'POST',
                        dataType: 'json',
                        data: {category: item},
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    })
                    .done(function(result) {
                        self.showMessage('success', '刪除品牌成功');
                    })
                    .fail(function(errorData) {
                        self.showMessage('error', '刪除品牌失敗');
                    })
                    .always(function() {
                        self.getCategories();
                    });
                }


            },
            openEditModal: function (item) {

                this.editCategoryForm.name = JSON.parse(item.name);
                this.editCategoryForm.parentId = item.parentId;
                this.editCategoryForm.description = JSON.parse(item.description);
                this.editCategoryForm.featureImage = item.featureImage;
                this.editCategoryForm.guid = item.guid;

                $('#myModal').modal('show');
            },
            toggleEditMode: function (item) {
                var self = this;
                var isEdit = item.isEdit;

                if (isEdit) {
                    item.isEdit = false;
                } else {
                    item.isEdit = true;
                    setTimeout(function () {
                        $('.edit-category-input').focus();
                    }, 50);

                }

            },
            getCategories: function () {
                var self = this;
                var token = this.token;

                $.ajax({
                    url: '/admin/category/get',
                    type: 'POST',
                    cache: false,
                    data: {
                        type: 'label'
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function(result) {
                    self.categories = [];
                    result.forEach(function(item) {
                        self.categories.push({
                            'parentId': item.parentId,
                            'name': item.categoryTitle,
                            'guid': item.categoryGuid,
                            'featureImage': item.featureImage,
                            'isEdit': false,
                            'description': item.categoryDescription
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
            translateTitle(form) {
                let count = 0
                $('.loading-bar').show()

                axios.post(`/api/translate/zh-CN/${this[form].name['zh-TW']}`)
                    .then(res => {
                        this[form].name['zh-CN'] = res.data
                        count += 1

                        if (count > 1) {
                            $('.loading-bar').hide()
                        }
                    })
                axios.post(`/api/translate/en/${this[form].name['zh-TW']}`)
                    .then(res => {
                        this[form].name['en'] = res.data
                        count += 1

                        if (count > 1) {
                            $('.loading-bar').hide()
                        }
                    })
                // axios.post(`/api/translate/zh-CN/${encodeURIComponent(this[form].description['zh-TW'])}`)
                //     .then(res => {
                //         this[form].description['zh-CN'] = res.data
                //         count += 1

                //         if (count > 3) {
                //             $('.loading-bar').hide()
                //         }
                //     })
                // axios.post(`/api/translate/en/${encodeURIComponent(this[form].description['zh-TW'])}`)
                //     .then(res => {
                //         this[form].description['en'] = res.data
                //         count += 1

                //         if (count > 3) {
                //             $('.loading-bar').hide()
                //         }
                //     })
            },
            parseTitle(str) {
                let obj = JSON.parse(str)

                return `${obj['zh-TW']} | ${obj.en}`
            },
            showMessage: function (type, string) {
                toastr[type](string);
            }
        }
    }
</script>
