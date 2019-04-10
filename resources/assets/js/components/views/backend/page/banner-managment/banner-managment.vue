<template>
    <div class="row">
        <div class="col-md-6">
            <table class="table field-table">
                <tr>
                    <td>
                        <label for="pic-title">圖片標題</label>
                        <div v-if="isDirty" class="pull-right">
                            <button type="button" class="btn btn-primary" v-if="isEdit" @click="editMeta()">儲存設定</button>
                            <button type="button" class="btn btn-primary" v-else @click="newMeta()">新增設定</button>
                        </div>
                        <div v-else class="pull-right">
                            <button type="button" class="btn btn-primary" v-if="isEdit" disabled>儲存設定</button>
                            <button type="button" class="btn btn-primary" v-else disabled>新增設定</button>
                        </div>
                        <button v-if="isBannerEdit" type="button" class="btn btn-primary pull-right" @click="saveBanner()">儲存Banner</button>
                        <button v-else type="button" class="btn btn-primary pull-right" @click="addBanner()">新增至輪播區</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea name="pic-title" id="pic-title" v-model="picTitle" class="form-control" style="resize: vertical"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="picContent">圖片資訊內容</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea name="picContent" id="picContent" v-model="picContent" class="form-control" style="resize: vertical"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="pic-link">按鈕名稱</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="pic-link" type="text" class="form-control" v-model="picBtnTitle">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="pic-link">圖片連結</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="pic-link" type="text" class="form-control" v-model="picLink">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>圖片</label>
                        <button class="btn btn-primary pull-right" type="button" @click="addImage()">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td><img width="100%" v-bind:src="picUrl"></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default" v-for="(item, index) in siteMeta.index_album" v-bind:key="index">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                {{ item.title }}                                
                                <a class="pull-right" @click="siteMeta.index_album.splice(index, 1)" style="margin-left: 10px;"><i class="fa fa-times" aria-hidden="true"></i></a>                                
                                <a class="pull-right" @click="editBanner(index)" style="margin-left: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <img width="100%" v-bind:src="item.url">
                            <textarea v-model="item.content" class="form-control" style="resize: vertical"></textarea>
                        </div>
                        <div class="panel-footer">
                            <div class="form-control">
                                <p>{{item.link}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                siteMeta: {
                    title: null,
                    keyword: null,
                    description: null,
                    shortcut: null,
                    pageTopContent: null,
                    pageTopLink: null,
                    pageTopButton: null,
                    index_album: []
                },
                picTitle: null,
                picContent: null,
                picUrl: null,
                picLink: null,
                picBtnTitle: null,
                isEdit: false,
                isBannerEdit: false,
                editBannerIndex: null,
                isDirty: false,
                token: $('meta[name="csrf-token"]').attr('content'),
            }
        },
        created: function () {
            this.getMeta();
            $('.loading-bar').fadeOut('100');
        },
        watch: {
            siteMeta: {
                handler: function (siteMeta, oldVal) {
                    this.isDirty = true;
                },
                deep: true
            }
        },
        methods: {
            getMeta: function () {
                var self = this;
                $.ajax({
                    url: '/admin/page/meta/get',
                    type: 'GET',
                    cache: false,
                    dataType: 'json'
                })
                .done(function(result) {
                    // console.log(result.data);

                    self.siteMeta.title = result.data.title;
                    self.siteMeta.keyword = result.data.keyword;
                    self.siteMeta.description = result.data.description;
                    self.siteMeta.shortcut = result.data.shortcut;
                    self.siteMeta.pageTopContent = result.data.pageTopContent;
                    self.siteMeta.pageTopButton = result.data.pageTopButton;
                    self.siteMeta.pageTopLink = result.data.pageTopLink;
                    self.siteMeta.index_album = JSON.parse(result.data.index_album);

                    self.isEdit = true;
                    self.isDirty = false;
                })
                .fail(function() {
                    self.isEdit = false;
                });

            },
            addShortCut: function () {
                var self = this;

                window.open('/laravel-filemanager' + '?type=Images', 'FileManager', 'width=900,height=600');
                window.SetUrl = function (url, file_path) {
                    self.siteMeta.shortcut = file_path;
                };
            },
            addImage: function () {
                var self = this;

                window.open('/laravel-filemanager' + '?type=Images', 'FileManager', 'width=900,height=600');
                window.SetUrl = function (url, file_path) {
                    self.picUrl = file_path;
                };
            },
            addBanner: function () {
                var self = this;

                if (this.picUrl) {
                    this.siteMeta.index_album.push({
                        title: this.picTitle,
                        content: this.picContent,
                        url: this.picUrl,
                        link: this.picLink,
                        button: this.picBtnTitle
                    });

                    this.picTitle = null;
                    this.picContent = null;
                    this.picUrl = null;
                    this.picLink = null;
                    this.picBtnTitle = null;
                } else {
                    alert('請選擇圖片');
                }

            },
            editBanner(index) {
                let item = this.siteMeta.index_album[index]

                this.editBannerIndex = index
                this.isBannerEdit = true
                this.picTitle = item.title
                this.picContent = item.content
                this.picUrl = item.url
                this.picLink = item.link
                this.picBtnTitle = item.button
            },
            saveBanner() {
                let item = this.siteMeta.index_album[this.editBannerIndex]

                item.title = this.picTitle
                item.content = this.picContent
                item.url = this.picUrl
                item.link = this.picLink
                item.button = this.picBtnTitle

                this.editBannerIndex = null
                this.isBannerEdit = false

                this.picTitle = null
                this.picContent = null
                this.picUrl = null
                this.picLink = null
                this.picBtnTitle = null

                this.editMeta()
            },
            newMeta: function () {
                var self = this;
                var token = this.token;

                $('.loading-bar').fadeIn('fast');

                $.ajax({
                    url: '/admin/page/meta/set',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        title: self.siteMeta.title,
                        keyword: self.siteMeta.keyword,
                        description: self.siteMeta.description,
                        shortcut: self.siteMeta.shortcut,
                        pageTopLink: self.siteMeta.pageTopLink,
                        pageTopButton: self.siteMeta.pageTopButton,
                        pageTopContent: self.siteMeta.pageTopContent,
                        index_album: JSON.stringify(self.siteMeta.index_album)
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function() {
                    self.getMeta();
                })
                .fail(function() {
                    // console.log("error");
                })
                .always(function() {
                    $('.loading-bar').fadeOut('fast');
                    // console.log("complete");
                });

            },
            editMeta: function () {
                var self = this;
                var token = this.token;

                $('.loading-bar').fadeIn('fast');

                $.ajax({
                    url: '/admin/page/meta/edit',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        title: self.siteMeta.title,
                        keyword: self.siteMeta.keyword,
                        description: self.siteMeta.description,
                        shortcut: self.siteMeta.shortcut,
                        pageTopLink: self.siteMeta.pageTopLink,
                        pageTopButton: self.siteMeta.pageTopButton,
                        pageTopContent: self.siteMeta.pageTopContent,
                        index_album: JSON.stringify(self.siteMeta.index_album)
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function() {
                    self.getMeta();
                    self.showMessage('success', '編輯成功')
                })
                .fail(function() {
                    // console.log("error");
                })
                .always(function() {
                    $('.loading-bar').fadeOut('fast');
                    // console.log("complete");
                });
            },
            showMessage: function (type, string) {
                toastr[type](string);
            }
        }
    }
</script>
