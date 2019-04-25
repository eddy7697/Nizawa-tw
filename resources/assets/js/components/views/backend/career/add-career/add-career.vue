<template>
    <div class="row">
        <div class="col-md-12">
            <el-form :model="ruleForm" label-position="top" :rules="rules" ref="ruleForm" label-width="130px" class="demo-ruleForm">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <el-form-item label="職缺名稱" prop="title">
                                    <el-input v-model="ruleForm.title"></el-input>
                                </el-form-item>
                                <el-form-item label="職缺地點" prop="location">
                                    <el-input v-model="ruleForm.location"></el-input>
                                </el-form-item>
                                <el-form-item label="職缺部門" prop="department">
                                    <el-input v-model="ruleForm.department"></el-input>
                                </el-form-item>
                                <el-form-item label="招募人數" prop="number">
                                    <el-input v-model="ruleForm.number"></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-md-6">
                                <el-form-item label="工作經驗 (年) (不填寫則代表不拘)" prop="experience">
                                    <el-input v-model="ruleForm.experience"></el-input>
                                </el-form-item>
                                <el-form-item label="教育程度 (不填寫則代表不拘)" prop="education">
                                    <el-input v-model="ruleForm.education"></el-input>
                                </el-form-item>
                                <el-form-item label="薪資範圍 (不填寫則代表面議)" prop="paymentRange">
                                    <el-input v-model="ruleForm.paymentRange"></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        
                        
                        <el-form-item label="職缺內容" prop="description">
                            <ckeditor
                                class="ch-product-description"
                                :config="ckConfig"
                                v-model="ruleForm.description">
                            </ckeditor>
                        </el-form-item>
                    </div>
                    <div class="col-md-3">
                        <el-form-item label="職缺開放" prop="status">
                            <el-switch
                                v-model="ruleForm.status"
                                active-color="#13ce66"
                                inactive-color="#ff4949">
                            </el-switch>
                        </el-form-item>
                        <el-form-item label="熱門職缺" prop="isTop">
                            <el-switch
                                v-model="ruleForm.isTop"
                                active-color="#13ce66"
                                inactive-color="#ff4949">
                            </el-switch>
                        </el-form-item>
                        <el-form-item label="隱藏/顯示於前台" prop="isShow">
                            <el-switch
                                v-model="ruleForm.isShow"
                                active-color="#13ce66"
                                inactive-color="#ff4949">
                            </el-switch>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="primary" @click="submitForm('ruleForm')">
                                <span v-if="mode == 'edit'">儲存</span>
                                <span v-else>立即建立</span>
                            </el-button>
                            <el-button v-if="mode == 'edit'" type="warning" @click="deleteData(id)">刪除文章</el-button>
                            <el-button @click="goList">回列表</el-button>
                        </el-form-item>
                    </div>
                </div>
               
                
            </el-form>
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
        mounted () {
            $('.loading-bar').hide()
            console.log('Component mounted.')
        },
        props: ['mode', 'id'],
        components: {
            Ckeditor,
        },
        data () {
            return {
                ruleForm: {
                    title: null,
                    isTop: null,
                    education: null,
                    paymentRange: null,
                    department: null,
                    status: false,
                    number: null,
                    experience: null,
                    location: null,
                    isShow: false,
                    description: null,
                },
                rules: {
                    title: [
                        { required: true, message: '請輸入職缺名稱', trigger: 'blur' }
                    ],
                    description: [
                        { required: true, message: '請填寫職缺內容', trigger: 'blur' }
                    ],
                    department: [
                        { required: true, message: '請填寫職缺部門', trigger: 'blur' }
                    ],
                    number: [
                        { required: true, message: '請填寫招募人數', trigger: 'blur' }
                    ],
                    location: [
                        { required: true, message: '請設定職缺地點', trigger: 'blur' }
                    ],
                },
                ckConfig: {
                    height: 300,
                    allowedContent: true,
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=' + $('meta[name="csrf-token"]').attr('content'),
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=' + $('meta[name="csrf-token"]').attr('content')
                },
            }
        },
        created() {
            if (this.mode == 'edit') {
                this.getData()
            }
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.saveCustomField()
                } else {
                    console.log('error submit!!');
                    return false;
                }
                });
            },
            saveCustomField() {
                let url = this.mode == 'edit' ? `/admin/career/update/${this.id}` : '/admin/career/add'

                axios.post(url, this.ruleForm)
                    .then(res => {
                        this.$message.success('儲存成功')
                        setTimeout(() => {
                            window.location.href = '/cyberholic-system/career/list'
                        }, 1000);
                    })
            },
            getData() {
                axios.get(`/admin/career/get/${this.id}`)
                    .then(res => {
                        delete res.data.id
                        delete res.data.updated_at
                        delete res.data.created_at

                        res.data.status = res.data.status == 1 ? true : false
                        res.data.isTop = res.data.isTop == 1 ? true : false
                        res.data.isShow = res.data.isShow == 1 ? true : false
                        
                        this.ruleForm = res.data
                    })
            },
            addImage() {
                let self = this

                window.open('/laravel-filemanager' + '?type=Images', 'FileManager', 'width=900,height=600');
                window.SetUrl = function (url, file_path) {
                    self.ruleForm.customField4 = file_path
                };
            },
            goList() {
                window.location.href = '/cyberholic-system/career/list'
            },
            deleteData(id) {
                this.$confirm('此操作將永久刪除該筆資料, 是否繼續?', '提示', {
                    confirmButtonText: '確定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    axios.post(`/admin/custom/delete/${id}`)
                        .then(res => {
                            this.$message({
                                type: 'success',
                                message: '刪除成功!'
                            });

                            window.location.href = '/cyberholic-system/career/list'
                        })
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消刪除'
                    });          
                });
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
}
.submit-trigger {
    position: absolute;
    right: 21px;
    top: 7px;
}
.el-form-item {
    padding-bottom: 5px;
}
</style>
