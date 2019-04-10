<template>
    <div class="row" v-if="isLoaded">
        <div class="col-md-9">

            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">客服資訊</a></li>
                <li><a data-toggle="tab" href="#menu1">運送資訊</a></li>
                <li><a data-toggle="tab" href="#menu2">退換貨政策</a></li>
                <li><a data-toggle="tab" href="#menu3">反詐騙提醒</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <ckeditor
                        class="ch-product-description"
                        :config="ckConfig"
                        v-model="otherContent.service">
                    </ckeditor>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <ckeditor
                        class="ch-product-description"
                        :config="ckConfig"
                        v-model="otherContent.shipping">
                    </ckeditor>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <ckeditor
                        class="ch-product-description"
                        :config="ckConfig"
                        v-model="otherContent.return">
                    </ckeditor>
                </div>
                <div id="menu3" class="tab-pane fade">
                    <ckeditor
                        class="ch-product-description"
                        :config="ckConfig"
                        v-model="otherContent.antiFraud">
                    </ckeditor>
                </div>
            </div>
            <!-- <ckeditor
                class="ch-product-description"
                :config="ckConfig"
                v-model="pageContent.content">
            </ckeditor> -->
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
                    <button class="btn btn-success" type="button" name="button" @click="saveOther">儲存頁面</button>
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
                isOtherExist: false,
                pageContent: {
                    type: 'OTHER',
                    content: null,
                    locale: 'zh-tw'
                },
                otherContent: {
                    service: null,
                    shipping: null,
                    return: null,
                    antiFraud: null
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
            this.getOther();
            
            $('.loading-bar').fadeOut('100')
        },
        computed: {
        },
        watch: {
            otherContent: {
                handler(otherContent, oldVal) {
                    this.pageContent.content = JSON.stringify(otherContent)
                },
                deep: true
            }
        },
        methods: {
            saveOther: function () {
                var self = this
                var apiUrl = this.isOtherExist ? '/admin/other/update' : '/admin/other/create'

                $('.loading-bar').fadeIn('100')

                axios.post(apiUrl, this.pageContent)
                    .then(res => {
                        console.log(res)
                        self.getOther()
                    }).catch(err => {
                        console.log(err)
                    }).then(() => {
                        $('.loading-bar').fadeOut('100')
                    })
            },
            getOther: function (guid) {
                var self = this;

                axios.get('/admin/other/get')
                    .then(res => {
                        var result = res.data
                        console.log(res)
                        if (result) {
                            self.isOtherExist = true
                            self.pageContent.type = result.type
                            self.otherContent = JSON.parse(result.content)
                            self.pageContent.locale = result.locale
                        } else {
                            self.isOtherExist = false
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
