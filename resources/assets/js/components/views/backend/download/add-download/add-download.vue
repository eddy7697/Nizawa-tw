<template>
    <div class="row">
        <div class="col-md-8">
            <el-form :model="qnaContent" :rules="rules" ref="qnaContent" label-width="120px" class="demo-qnaContent">
                <el-form-item label="語系" prop="type">
                    <el-radio-group v-model="locale" size="medium">
                        <el-radio-button label="zh-TW">繁體中文</el-radio-button>
                        <el-radio-button label="zh-CN">簡體中文</el-radio-button>
                        <el-radio-button label="en">英文</el-radio-button>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="檔案下載標題" prop="title">
                    <el-input v-model="qnaContent.title[locale]"></el-input>
                </el-form-item>
                <el-form-item label="檔案下載分類" prop="type">
                    <el-radio-group v-model="qnaContent.type" size="medium">
                        <el-radio-button label="產品目錄" ></el-radio-button>
                        <el-radio-button label="文件下載"></el-radio-button>
                        <el-radio-button label="資質證明"></el-radio-button>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="檔案下載內容" prop="content">
                    {{qnaContent.content[locale]}}
                    <el-button type="primary" icon="el-icon-edit" circle @click="addFile"></el-button>
                </el-form-item>
                <el-form-item style="margin-top: 10px;">
                    <el-button type="primary" @click="submitForm('qnaContent')">儲存</el-button>
                    <el-button @click="return2List">回列表</el-button>
                    <el-button @click="resetForm('qnaContent')">重置</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>

<script>
    import Ckeditor from 'vue-ckeditor2';
    import ElementUI from 'element-ui'
    import 'element-ui/lib/theme-chalk/index.css'
    import lang from 'element-ui/lib/locale/lang/zh-TW'
    import locale from 'element-ui/lib/locale'
    
    Vue.use(ElementUI)
    locale.use(lang)

    export default {
        mounted () {
            $('.loading-bar').hide()
        },
        components: {
            Ckeditor
        },
        props: ['qnaid'],
        data () {
            return {
                isSwitching: true,
                locale: 'zh-TW',
                qnaContent: {
                    title: {
                        en: null,
                        'zh-TW': null,
                        'zh-CN': null
                    },
                    type: null,
                    content: {
                        en: null,
                        'zh-TW': null,
                        'zh-CN': null
                    }
                },
                rules: {
                    title: [
                        { required: true, message: '請輸入檔案下載標題', trigger: 'change' }
                    ],
                    type: [
                        { required: true, message: '請選擇檔案下載分類', trigger: 'change' }
                    ],
                    content: [
                        { required: true, message: '請設定檔案連結', trigger: 'change' }
                    ],
                },
                ckConfig: {
                    height: 300,
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=' + $('meta[name="csrf-token"]').attr('content'),
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=' + $('meta[name="csrf-token"]').attr('content')
                },
            }
        },
        created() {
            if (this.qnaid) {
                this.getData()
            }
        },
        watch: {
            locale() {
                this.isSwitching = !this.isSwitching

                setTimeout(() => {
                    this.isSwitching = !this.isSwitching
                }, 500);
            }
        },
        methods: {
            getData() {
                axios.post(`/admin/download/get/${this.qnaid}`)
                    .then(res => {
                        delete res.data.id
                        delete res.data.created_at
                        delete res.data.updated_at

                        res.data.title = JSON.parse(res.data.title)
                        res.data.content = JSON.parse(res.data.content)

                        this.qnaContent = res.data 
                    });
            },
            saveData() {
                let url = this.qnaid ? `/admin/download/edit/${this.qnaid}` : '/admin/download/add'
                let content = JSON.parse(JSON.stringify(this.qnaContent))

                content.title = JSON.stringify(content.title)
                content.content = JSON.stringify(content.content)
                axios.post(url, content)
                    .then(res => {
                        this.$message.success('儲存檔案下載成功')

                        setTimeout(() => {
                            // window.location.href = '/cyberholic-system/download/list'
                        }, 500);
                    })
            },
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.saveData()
                } else {
                    return false;
                }
                });
            },
            addFile: function () {
                var self = this;

                window.open('/laravel-filemanager' + '?type=files', 'FileManager', 'width=900,height=600');
                window.SetUrl = function (url, file_path) {
                    self.qnaContent.content[self.locale] = file_path
                };
            },
            return2List() {
                window.location.href = '/cyberholic-system/download/list'
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            }
        }
    }
</script>
<style lang="scss">
.el-form-item__error {
    position: relative;
    margin-bottom: 5px;
}
.submit-trigger {
    padding: 10px 0px;
    text-align: right;
}
.el-date-editor--daterange {
    width: 100% !important;
}
.el-date-editor {
    width: 100% !important;
}
.time {
    font-size: 13px;
    color: #999;
}

.bottom {
    margin-top: 13px;
    line-height: 12px;
}

.button {
    padding: 0;
    float: right;
}

.image {
    width: 100%;
    display: block;
}

.album-card {
    margin-top: 10px;

    .el-card__body {
        position: relative;

        .card-del-btn {
            position: absolute;
            top: 8px;
            right: 8px;
        }
        .card-top-btn {
            position: absolute;
            top: 8px;
            right: 50px;
        }
    }
}

.sec-valid {
    color: grey;

    &.pass {
        color: #67C23A;
    }
}

#BeginSaleDate {
    &.is-error {
        .el-date-editor {
            border-color: rgb(220, 223, 230);
        }
        .el-form-item__error {
            display: none;
        }
    }
}
.el-transfer {
    margin-top: 15px;

    .el-transfer-panel {
        width: 40%;
    }
    .el-transfer__buttons {
        width: 20%;
        padding: 0 6.7%;
    }
}
.el-tag {
    margin: 0 10px;
}
hr {
    margin-top: 10px;
    margin-bottom: 10px;
}
.toolbar {
    position: relative;
    margin-bottom: 15px; 

    &::after {
        content: '';
        position: absolute;
        height: 2px;
        bottom: 0;
        left: 0px;
        right: 0px;
        background-color: #e4e7ed;
    }
    &.header {
        margin-top: -20px;
    }
}
.el-select {
    width: 100%;
}
</style>
