<template>
    <div class="row" v-if="isLoaded">
        <div class="col-md-9">
            <ckeditor
                class="ch-product-description"
                :config="ckConfig"
                v-model="pageContent.content">
            </ckeditor>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title">
    					儲存頁面區塊
    				</h3>
    			</div>
    			<!-- <div class="panel-body">
                    <select class="form-control" v-model="pageContent.locale">
                        <option value="en">英文</option>
                        <option value="zh-TW">繁體中文</option>
                    </select>
    			</div> -->
                <div class="panel-footer">
                    <button class="btn btn-success" type="button" name="button" @click="savePrivacy">儲存頁面</button>
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
                isLoaded: false,
                isEdit: false,
                guid: $('#row-guid').val(),
                isPrivacyExist: false,
                pageContent: {
                    type: 'PRIVACY',
                    content: null,
                    locale: 'zh-tw'
                },
                ckConfig: {
                    height: 300,
                    allowedContent: true,
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=' + $('meta[name="csrf-token"]').attr('content'),
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=' + $('meta[name="csrf-token"]').attr('content')
                },
                token: $('meta[name="csrf-token"]').attr('content'),
            }
        },
        created: function () {
            this.getPrivacy();
            
            $('.loading-bar').fadeOut('100')
        },
        computed: {
        },
        methods: {
            savePrivacy: function () {
                var self = this
                var apiUrl = this.isPrivacyExist ? '/admin/privacy/update' : '/admin/privacy/create'

                $('.loading-bar').fadeIn('100')

                axios.post(apiUrl, this.pageContent)
                    .then(res => {
                        console.log(res)
                        self.getPrivacy()
                    }).catch(err => {
                        console.log(err)
                    }).then(() => {
                        $('.loading-bar').fadeOut('100')
                    })
            },
            getPrivacy: function (guid) {
                var self = this;

                axios.get('/admin/privacy/get')
                    .then(res => {
                        var result = res.data
                        console.log(res)
                        if (result) {
                            self.isPrivacyExist = true
                            self.pageContent.type = result.type
                            self.pageContent.content = result.content
                            self.pageContent.locale = result.locale
                        } else {
                            self.isPrivacyExist = false
                        }
                    }).catch(err => {

                    }).then(() => {
                        self.isLoaded = true;
                    })

            },
            showMessage: function (type, string) {
                toastr[type](string);
            }
        }
    }
</script>
