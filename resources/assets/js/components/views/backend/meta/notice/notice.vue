<template>
    <div class="row" v-if="isLoaded">
        <div class="col-md-9">
            <el-radio-group v-model="locale" size="medium" style="margin-bottom: 10px;">
                <el-radio-button label="zh-TW">繁體中文</el-radio-button>
                <el-radio-button label="zh-CN">简体中文</el-radio-button>
                <el-radio-button label="en">英文</el-radio-button>
            </el-radio-group>
            <ckeditor
                v-if="editorShow"
                class="ch-product-description"
                :config="ckConfig"
                v-model="pageContent.content[locale]">
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
                    <button class="btn btn-success" type="button" name="button" @click="saveNotice">儲存頁面</button>
                </div>
    		</div>
        </div>

    </div>
</template>

<script>
    import Ckeditor from 'vue-ckeditor2';
    import ElementUI from 'element-ui';
    import 'element-ui/lib/theme-chalk/index.css';
    import lang from 'element-ui/lib/locale/lang/zh-TW'
    import locale from 'element-ui/lib/locale'

    Vue.use(ElementUI);
    locale.use(lang)


    export default {
        components: {
            Ckeditor
        },
        props: ['pagetype'],
        data() {
            let pageType = this.pagetype == 'notice' ? 'ECNOTICE' : 'PRIVACY'
            return {
                locale: 'zh-TW',
                isLoaded: false,
                isEdit: false,
                guid: $('#row-guid').val(),
                isNoticeExist: false,
                pageContent: {
                    type: pageType,
                    content: {
                        en: null,
                        'zh-TW': null,
                        'zh-CN': null 
                    },
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
                editorShow: true,
                token: $('meta[name="csrf-token"]').attr('content'),
            }
        },
        created: function () {
            this.getNotice();
            
            $('.loading-bar').fadeOut('100')
        },
        computed: {
        },
        watch: {
            locale() {
                this.editorShow = false

                setTimeout(() => {
                    this.editorShow = true
                }, 500);
            }
        },
        methods: {
            saveNotice: function () {
                var self = this
                var apiUrl = this.isNoticeExist ? `/admin/${this.pagetype}/update` : `/admin/${this.pagetype}/create`
                let vo = JSON.parse(JSON.stringify(this.pageContent))

                vo.content = JSON.stringify(vo.content)
                $('.loading-bar').fadeIn('100')

                axios.post(apiUrl, vo)
                    .then(res => {
                        this.$message.success('編輯完成')
                        self.getNotice()
                    }).catch(err => {
                        this.$message.error('編輯失敗')
                    }).then(() => {
                        $('.loading-bar').fadeOut('100')
                    })
            },
            getNotice: function (guid) {
                var self = this;

                axios.get(`/admin/${this.pagetype}/get`)
                    .then(res => {
                        var result = res.data
                        console.log(res)
                        if (result) {
                            self.isNoticeExist = true
                            self.pageContent.type = result.type
                            self.pageContent.content = JSON.parse(result.content)
                            self.pageContent.locale = result.locale
                        } else {
                            self.isNoticeExist = false
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
