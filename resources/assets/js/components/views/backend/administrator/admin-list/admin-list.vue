<template>
    <div class="row">
        <div class="col-md-12" style="position: relative">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-primary" @click="openAddModal()" style="position: absolute; right: 10px; top: -42px;">
              <span class="glyphicon glyphicon-plus"></span> 新增管理者
            </button>

            <table class="table field-table">
                <thead>
                    <tr>
                        <th>帳號</th>
                        <th>名稱</th>
                        <th>建立時間</th>
                        <!-- <th width="50">狀態</th> -->
                        <th width="50" style="text-align: center">編輯</th>
                        <th width="50" style="text-align: center">刪除</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in accounts" v-bind:key="index">
                        <td>{{ item.email }}</td>
                        <td>{{ item.name }}</td>
                        <td>{{ item.created_at }}</td>
                        <!-- <td>{{ item.status }}</td> -->
                        <td align="center"><span @click="editAdmin(item)" class="glyphicon glyphicon-pencil pointer"></span></td>
                        <td align="center"><span @click="deleteAdmin(item)" class="glyphicon glyphicon-trash pointer"></span></td>
                    </tr>
                </tbody>
            </table>

            <!-- 新增帳號視窗 -->
            <div class="modal fade" id="createAdminModal" tabindex="-1" role="dialog" aria-labelledby="createAdminModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 v-if="!isEdit" class="modal-title" id="createAdminModalLabel">新增管理者帳號</h4>
                            <h4 v-else class="modal-title" id="createAdminModalLabel">編輯管理者帳號</h4>
                        </div>
                        <div class="modal-body">
                            <table class="field-table">
                                <tr>
                                    <td>顯示名稱</td>
                                    <td>
                                        <input class="form-control" type="text" name="name" v-model="fieldContent.name" autofocus="true">
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-Mail</td>
                                    <td>
                                        <input class="form-control" type="text" name="email" v-model="fieldContent.email" v-bind:disabled="isEdit">
                                    </td>
                                </tr>
                                <tr v-if="!isEdit">
                                    <td>密碼</td>
                                    <td>
                                        <input class="form-control" type="password" name="password" v-model="fieldContent.password">
                                    </td>
                                </tr>
                                <tr v-if="!isEdit">
                                    <td>確認密碼</td>
                                    <td>
                                        <input class="form-control" type="password" name="check-password" v-model="fieldContent.confirmPassword">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button v-if="isEdit" type="button" class="btn btn-primary pull-left" @click="resetAdminPassword()">重設密碼</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                            <button v-if="isEdit" type="button" class="btn btn-primary" @click="saveUser()">編輯</button>
                            <button v-else type="button" class="btn btn-primary" @click="saveUser()">新增</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 訊息區塊 -->
            <div class="modal fade" id="messageModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body message-modal-body">
                        {{ message }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ElementUI from 'element-ui';
    import 'element-ui/lib/theme-chalk/index.css';
    import lang from 'element-ui/lib/locale/lang/zh-TW'
    import locale from 'element-ui/lib/locale'

    Vue.use(ElementUI);
    locale.use(lang)

    export default {
        data() {
            return {
                fieldContent: {
                    name: '',
                    email: '',
                    password: '',
                    confirmPassword: ''
                },
                fieldValidation: {
                    name: false,
                    email: false,
                    password: false,
                    confirmPassword: false
                },
                isEdit: false,
                accounts: [],
                guid: null,
                token: $('meta[name="csrf-token"]').attr('content'),
                message: ''
            }
        },
        created: function () {
            var self = this;

            this.getUser();
        },
        computed: {
            formValidation: function() {
                return this.fieldValidation.name && this.fieldValidation.email && this.fieldValidation.password && this.fieldValidation.confirmPassword;
            },
        },
        methods: {
            getUser: function () {
                var self = this;

                $.ajax({
                    url: '/admin/admin/list',
                    type: 'GET',
                    dataType: 'json',
                    data: {param1: 'value1'}
                })
                .done(function(result) {
                    self.accounts = result.data;
                    $('.loading-bar').fadeOut('100');
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
            },
            saveUser: function () {
                var token = this.token;
                var fieldContent = this.fieldContent;
                var self = this;
                var baseUrl = this.isEdit ? `/admin/admin/update/${this.guid}` : '/admin/admin/add'

                if (this.fieldContent.password !== this.fieldContent.confirmPassword) {
                    self.showMessage('warning', '密碼欄位不一致，請確認。');
                    return;
                }

                this.formValidator();
                if (this.formValidation) {
                    $('.loading-bar').fadeIn('100');
                    axios.post(baseUrl, fieldContent)
                        .then(res => {
                            self.showMessage('success', self.isEdit ? '管理者帳號編輯成功' : '管理者帳號建立成功');
                            fieldContent.name = '';
                            fieldContent.email = '';
                            fieldContent.password = '';
                            fieldContent.confirmPassword = '';
                            $('#createAdminModal').modal('hide')
                        }).catch(err => {

                        }).then(arg => {
                            self.getUser();
                            $('.loading-bar').fadeOut('100');
                        })
                } else {
                    self.showMessage('warning', '請檢查欄位');
                }

            },
            resetAdminPassword() {
                let self = this
                let checkProperty = confirm('是否要重設密碼？')

                if (!checkProperty) {
                    return
                }

                $('.loading-bar').show()

                axios.post('/admin/admin/reset/default', {
                    guid: this.guid
                }).then(res => {
                    $('#createAdminModal').modal('hide')
                    this.$alert(`密碼已重新設定為${res.data.data}`, '密碼重設成功', {
                        confirmButtonText: '確定',
                        center: false,
                        callback: action => {
                            // this.$message({
                            // type: 'info',
                            // message: `action: ${ action }`
                            // });
                        }
                    });
                }).catch(err => {
                    self.showMessage('error', '重設密碼失敗')
                    $('#createAdminModal').modal('hide')
                }).then(arg => {
                    $('.loading-bar').hide()
                })
            },
            editAdmin: function (item) {
                let self = this

                this.isEdit = true
                this.guid = item.guid
                this.fieldContent = {
                    name: item.name,
                    email: item.email
                }
                $('#createAdminModal').modal('show')
            },
            openAddModal() {
                let self = this

                $('#createAdminModal').modal('show')
                this.isEdit = false
            },
            deleteAdmin: function (item) {
                var self = this;
                var token = this.token;
                var checkProperty = confirm("是否刪除帳號?");

                if (checkProperty) {
                    $.ajax({
                        url: '/admin/admin/delete',
                        type: 'POST',
                        cache: false,
                        dataType: 'json',
                        data: {
                            adminUser: item.guid
                        },
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    })
                    .done(function(result) {
                        self.showMessage('success', result.message);
                    })
                    .fail(function(errorData) {
                        self.showMessage('error', errorData.responseJSON.message);
                    })
                    .always(function() {
                        self.getUser();
                    });
                } else {
                    return;
                }

            },
            formValidator: function () {
                var emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;

                if (this.fieldContent.name.trim() !== '') {
                    this.fieldValidation.name = true;
                } else {
                    this.fieldValidation.name = false;
                }

                if (emailRule.test(this.fieldContent.email)) {
                    this.fieldValidation.email = true;
                } else {
                    this.fieldValidation.email = false;
                }
                if (!this.isEdit) {
                    if ((this.fieldContent.password.trim() !== this.fieldContent.confirmPassword.trim()) ||
                        (this.fieldContent.password.trim() == '') ||
                        (this.fieldContent.confirmPassword.trim() == '')) {
                        this.fieldValidation.password = false;
                        this.fieldValidation.confirmPassword = false;
                    } else {
                        this.fieldValidation.password = true;
                        this.fieldValidation.confirmPassword = true;
                    }
                } else {
                    this.fieldValidation.password = true;
                    this.fieldValidation.confirmPassword = true;
                }

                
            },
            showMessage: function (type, string) {
                toastr[type](string)
                this.message = string;
            }
        }
    }
</script>
