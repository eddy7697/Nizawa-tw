<template>
    <div class="row">
        <div class="col-md-8">
            <el-form :model="qnaContent" :rules="rules" ref="qnaContent" label-width="100px" class="demo-qnaContent">
                <el-form-item label="語系" prop="qatype">
                    <el-radio-group v-model="locale" size="medium">
                        <el-radio-button label="zh-TW">繁體中文</el-radio-button>
                        <el-radio-button label="zh-CN">簡體中文</el-radio-button>
                        <el-radio-button label="en">英文</el-radio-button>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="問題標題" prop="qatitle">
                    <el-input v-model="qnaContent.qatitle[locale]"></el-input>
                </el-form-item>
                <el-form-item label="問題分類" prop="qatype">
                    <el-radio-group v-model="qnaContent.qatype" size="medium">
                        <el-radio-button label="一般產品問題" ></el-radio-button>
                        <el-radio-button label="詢價問題"></el-radio-button>
                        <el-radio-button label="服務支援"></el-radio-button>
                        <el-radio-button label="運送相關"></el-radio-button>
                        <el-radio-button label="支付相關"></el-radio-button>
                        <el-radio-button label="水質檢測相關產品"></el-radio-button>
                        <el-radio-button label="食品安全相關產品"></el-radio-button>
                        <el-radio-button label="生技藥妝相關產品"></el-radio-button>
                        <el-radio-button label="試劑相關產品"></el-radio-button>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="問題內容" prop="qacontent">
                    <textarea rows="8" style="resize: vertical;" class="form-control" v-model="qnaContent.qacontent[locale]"></textarea>
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
                    qatitle: {
                        en: null,
                        'zh-TW': null,
                        'zh-CN': null
                    },
                    qatype: null,
                    qacontent: {
                        en: null,
                        'zh-TW': null,
                        'zh-CN': null
                    }
                },
                rules: {
                    qatitle: [
                        { required: true, message: '請輸入問題標題', trigger: 'change' }
                    ],
                    qatype: [
                        { required: true, message: '請選擇問題分類', trigger: 'change' }
                    ],
                    qacontent: [
                        { required: true, message: '請輸入問題內容', trigger: 'change' }
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
                axios.post(`/admin/qa/get/${this.qnaid}`)
                    .then(res => {
                        delete res.data.id
                        delete res.data.created_at
                        delete res.data.updated_at

                        res.data.qatitle = JSON.parse(res.data.qatitle)
                        res.data.qacontent = JSON.parse(res.data.qacontent)

                        this.qnaContent = res.data 
                    });
            },
            saveData() {
                let url = this.qnaid ? `/admin/qa/edit/${this.qnaid}` : '/admin/qa/add'
                let content = JSON.parse(JSON.stringify(this.qnaContent))

                content.qatitle = JSON.stringify(content.qatitle)
                content.qacontent = JSON.stringify(content.qacontent)
                axios.post(url, content)
                    .then(res => {
                        this.$message.success('儲存問題成功')
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
            return2List() {
                window.location.href = '/cyberholic-system/qa/list'
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
