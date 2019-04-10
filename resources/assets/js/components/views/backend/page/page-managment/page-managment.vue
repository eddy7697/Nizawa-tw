<template>
    <div class="row">
        <div class="col-md-6">
            <table class="table field-table">
                <tr>
                    <td><label>網站標題</label></td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" v-model="siteMeta.title"></td>
                </tr>
                <tr>
                    <td><label>網站關鍵字</label></td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" v-model="siteMeta.keyword"></td>
                </tr>
                <tr>
                    <td>網站描述</td>
                </tr>
                <tr>
                    <td><textarea class="form-control" v-model="siteMeta.description" style="resize: vertical;"></textarea></td>
                </tr>
                <tr>
                    <td><label>網站縮圖</label></td>
                </tr>
                <tr>
                    <td>
                        <button class="btn btn-primary" type="button" v-if="(siteMeta.shortcut === null) || (siteMeta.shortcut === '')" @click="addShortCut()">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                        <img width="50%" @click="addShortCut()" v-bind:src="siteMeta.shortcut" v-else>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div v-if="isDirty" class="pull-left">
                            <button type="button" class="btn btn-primary" v-if="isEdit" @click="editMeta()">儲存設定</button>
                            <button type="button" class="btn btn-primary" v-else @click="newMeta()">新增設定</button>
                        </div>
                        <div v-else class="pull-left">
                            <button type="button" class="btn btn-primary" v-if="isEdit" disabled>儲存設定</button>
                            <button type="button" class="btn btn-primary" v-else disabled>新增設定</button>
                        </div>
                    </td>
                </tr>
            </table>
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
                picUrl: null,
                picLink: null,
                isEdit: false,
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
                        url: this.picUrl,
                        link: this.picLink
                    });

                    this.picTitle = null;
                    this.picUrl = null;
                    this.picLink = null;
                } else {
                    alert('請選擇圖片');
                }

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
                })
                .fail(function() {
                    // console.log("error");
                })
                .always(function() {
                    $('.loading-bar').fadeOut('fast');
                    // console.log("complete");
                });
            }
        }
    }
</script>
