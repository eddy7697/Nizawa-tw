<template>
    <div class="row">
        <div class="col-md-4">
            <searchBar 
                :keyword="keyword"
                :btnTitle="'搜尋會員'"
                @newKeyword="newKeyword($event)"
                @searchPost="searchPost($event)"/>
        </div>
        <div class="col-md-12" style="position: relative">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createAdminModal" style="position: absolute; right: 10px; top: -52px;">
              <span class="glyphicon glyphicon-plus"></span> 新增帳號
            </button>

            <table class="table field-table">
                <thead>
                    <tr>
                        <!-- <th><input type="checkbox" v-model="allSelect" v-on:change="toggleAllSelect()"></th> -->
                        <th class="pointer" @click="sortAction('email')">帳號</th>
                        <th class="pointer" @click="sortAction('name')">名稱</th>
                        <th class="pointer" @click="sortAction('created_at')">建立時間</th>
                        <!-- <th width="70" style="text-align: center">剩餘點數</th> -->
                        <th class="pointer" width="50" @click="sortAction('created_at')" style="text-align: center">狀態</th>
                        <th width="50" style="text-align: center">編輯</th>
                        <th width="50" style="text-align: center">刪除</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in accounts" v-bind:key="index">
                        <!-- <td><input type="checkbox" v-model="item.isSelect"></td> -->
                        <td>{{ item.email }}</td>
                        <td>{{ item.name }}</td>
                        <td>{{ item.created_at }}</td>
                        <!-- <td style="text-align: center">{{ item.point }}</td> -->
                        <td style="text-align: center">{{ item.status }}</td>
                        <td align="center"><span @click="editUser(item)" class="glyphicon glyphicon-pencil pointer"></span></td>
                        <td align="center"><span @click="deleteAdmin(item)" class="glyphicon glyphicon-trash pointer"></span></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <ul class="pagination">
                				<li v-if="prev_page_url">
                					<a href="#" @click="prevPage()">上一頁</a>
                				</li>
                				<li v-for="(item, index) in eachPage" v-bind:key="index" v-bind:class="{ active: current_page == item.pageNumber }">
                					<a href="#" @click="gotoPage(item)">{{item.pageNumber}}</a>
                				</li>
                				<li v-if="next_page_url">
                					<a href="#" @click="nextPage()">下一頁</a>
                				</li>
                			</ul>
                        </td>
                    </tr>
                </tfoot>
            </table>

            <!-- 新增帳號視窗 -->
            <div class="modal fade" id="createAdminModal" tabindex="-1" role="dialog" aria-labelledby="createAdminModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="createAdminModalLabel">新增使用者帳號</h4>
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
                                        <input class="form-control" type="text" name="email" v-model="fieldContent.email">
                                    </td>
                                </tr>
                                <tr>
                                    <td>密碼</td>
                                    <td>
                                        <input class="form-control" type="password" name="password" v-model="fieldContent.password">
                                    </td>
                                </tr>
                                <tr>
                                    <td>確認密碼</td>
                                    <td>
                                        <input class="form-control" type="password" name="check-password" v-model="fieldContent.confirmPassword">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                            <button type="button" class="btn btn-primary" @click="addUser()">新增</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 編輯帳號視窗 -->
            <div class="modal fade" ref="createAdminModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="createAdminModalLabel">編輯使用者資訊</h4>
                        </div>
                        <div class="modal-body">
                            <table class="field-table">
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group">
                                            <label for="">顯示名稱</label>
                                            <input class="form-control" type="text" name="name" v-model="accountContent.name" autofocus="true">
                                        </div>                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group">
                                            <label for="">E-Mail</label>
                                            <input class="form-control" type="text" name="email" v-model="accountContent.email" readonly>
                                        </div>                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="">收件人</label>
                                            <input class="form-control" type="text" name="fullname" v-model="accountContent.address.fullName">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="">行動電話</label>
                                            <input class="form-control" type="text" name="cellphone" v-model="accountContent.address.cellPhone">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group">
                                            <label for="">郵遞區號</label>
                                            <input class="form-control" type="text" name="port" v-model="accountContent.address.postcode">
                                        </div>
                                    </td>
                                    <!-- <td>
                                        <div class="form-group">
                                            <label for="">居住城市</label>
                                            <input class="form-control" type="text" name="city" v-model="accountContent.address.city">
                                        </div>
                                    </td> -->
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group">
                                            <label for="">街道地址</label>
                                            <input class="form-control" type="text" name="address" v-model="accountContent.address.address">
                                        </div>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td colspan="2">
                                        <div class="form-group">
                                            <label for="">會員溢付款</label>
                                            <input class="form-control" type="number" name="address" v-model="accountContent.remark">
                                        </div>
                                    </td>
                                </tr> -->
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                            <button type="button" class="btn btn-primary" @click="saveUser()">儲存</button>
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
    var searchBar = require('../../../../common/searchBar.vue');

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
                accountContent: {
                    guid: null,
                    name: null,
                    email: null,
                    remark: 'null',
                    address: {
                        address: null,
                        postcode: null,
                        fullName: null,
                        cellPhone: null,
                        city: null
                    }
                },
                accounts: [],
                keyword: null,
                addressExist: false,
                defaultOrder: 'asc',
                token: $('meta[name="csrf-token"]').attr('content'),
                message: '',
                flag: 'id',
                urlPath: '/admin/normal/list',
                next_page_url: null,
                prev_page_url: null,
                total: null,
                current_page: null,
                eachPage: [],
                allSelect: false
            }
        },
        components: {
            searchBar
        },
        created: function () {
            var self = this;

            this.getUser(this.urlPath);
        },
        watch: {
            accounts: {
                handler: function (accounts, oldVal) {
                    var self = this;
                },
                deep: true
            },
            isAllSelected: {
                handler: function (isAllSelected, oldVal) {
                    var self = this;

                    this.allSelect = isAllSelected;
                }
            }
        },
        computed: {
            formValidation: function() {
                return this.fieldValidation.name && this.fieldValidation.email && this.fieldValidation.password && this.fieldValidation.confirmPassword;
            },
            isAllSelected: function () {
                var status = true;

                this.accounts.forEach(function (item) {
                    if (!item.isSelect) {
                        status = false;
                    }
                });

                return status;
            }
        },
        methods: {
            getUser: function (url) {
                var self = this

                $('.loading-bar').fadeIn('100');

                axios.post(url, {
                    flag: self.flag,
                    order: self.defaultOrder
                }).then(result => {
                    self.next_page_url = result.data.next_page_url;
                    self.prev_page_url = result.data.prev_page_url;
                    self.current_page = result.data.current_page;
                    self.total = result.data.total;
                    self.eachPage = [];

                    self.accounts = [];

                    for (var i = 0; i < result.data.last_page; i++) {
                        self.eachPage.push({
                            pageNumber: i + 1,
                        });
                    }

                    result.data.data.forEach(function (item) {
                        self.accounts.push({
                            guid: item.guid,
                            email: item.email,
                            name: item.name,
                            created_at: item.created_at,
                            point: item.point,
                            remark: item.remark,
                            status: item.status,
                            isSelect: false
                        });
                    });
                    $('.loading-bar').fadeOut('100');
                }).catch(err => {
                    console.log(err)
                })
            },
            sortAction (flag) {
                this.defaultOrder = this.defaultOrder == 'asc' ? 'desc' : 'asc';
                this.flag = flag
                this.getUser(this.urlPath);
            },
            searchPost () {
                var self = this;                

                if (self.keyword) {
                    this.urlPath = `/admin/normal/search/${self.keyword}`
                    this.getUser(`/admin/normal/search/${self.keyword}`);
                } else {
                    this.urlPath = '/admin/normal/list';
                    this.getUser('/admin/normal/list');
                }
            },
            newKeyword (event) {
                this.keyword = event
            },
            addUser: function () {
                var token = this.token;
                var fieldContent = this.fieldContent;
                var self = this;

                if (this.fieldContent.password !== this.fieldContent.confirmPassword) {
                    self.showMessage('warning', '密碼欄位不一致，請確認。');
                    return;
                }

                this.formValidator();
                if (this.formValidation) {
                    $('.loading-bar').fadeIn('100');
                    $.ajax({
                        url: "/admin/admin/add",
                        type: 'POST',
                        cache: false,
                        data: fieldContent,
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    }).done(function(result) {
                        self.showMessage('success', '帳號建立成功');
                        fieldContent.name = '';
                        fieldContent.email = '';
                        fieldContent.password = '';
                        fieldContent.confirmPassword = '';
                    }).fail(function(result) {
                        var errorData = JSON.parse(result.responseText);
                        if (errorData.email) {
                            self.showMessage('error', '帳號已存在，請重新輸入');
                        }
                        if (errorData.password) {
                            self.showMessage('warning', '密碼長度必須大於六個字元');
                        }
                    }).always(function() {
                        self.getUser('/admin/normal/list');
                        $('.loading-bar').fadeOut('100');
                    });
                } else {
                    self.showMessage('warning', '請檢查欄位');
                }

            },
            editUser: function (item) {
                var self = this

                axios.get(`/admin/normal/get/${item.guid}`)
                    .then(res => {
                        self.accountContent = res.data

                        self.addressExist = Boolean(res.data.address)
                        
                        self.accountContent = {
                            guid: res.data.guid,
                            name: res.data.name,
                            email: res.data.email,
                            remark: res.data.remark,
                            address: {
                                owner: item.guid,
                                address: res.data.address ? res.data.address.address : null,
                                postcode: res.data.address ? res.data.address.postcode : null,
                                fullName: res.data.address ? res.data.address.fullName : null,
                                cellPhone: res.data.address ? res.data.address.cellPhone : null,
                                city: res.data.address ? res.data.address.city : null
                            }
                        }
                        $(this.$refs.createAdminModal).modal('show')
                    }).catch(err => {

                    })
            },
            deleteAdmin: function (item) {
                var self = this;
                var token = this.token;
                var checkProperty = confirm("是否刪除帳號?");

                console.log(item);

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
                        self.getUser('/admin/normal/list');
                    });
                } else {
                    return;
                }

            },
            nextPage: function () {
                this.getUser(this.next_page_url);
            },
            prevPage: function () {
                this.getUser(this.prev_page_url);
            },
            gotoPage: function (item) {
                this.getUser('/admin/normal/list?page=' + item.pageNumber);
            },
            toggleAllSelect: function () {
                if (this.isAllSelected) {
                    this.accounts.forEach(function (item) {
                        item.isSelect = false;
                    });
                } else {
                    this.accounts.forEach(function (item) {
                        item.isSelect = true;
                    });
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

                if ((this.fieldContent.password.trim() !== this.fieldContent.confirmPassword.trim()) ||
                    (this.fieldContent.password.trim() == '') ||
                    (this.fieldContent.confirmPassword.trim() == '')) {
                    this.fieldValidation.password = false;
                    this.fieldValidation.confirmPassword = false;
                } else {
                    this.fieldValidation.password = true;
                    this.fieldValidation.confirmPassword = true;
                }
            },
            saveUser() {
                var self = this
                var addressUrl = `/admin/address/${this.addressExist ? 'update/' + this.accountContent.guid : 'create'}`

                const updateUser = axios.post(`/admin/normal/update/${this.accountContent.guid}`, {
                    name: this.accountContent.name,
                    remark: this.accountContent.remark
                })
                const saveAddress = axios.post(addressUrl, this.accountContent.address)

                $('.loading-bar').fadeIn('100');

                axios.all([
                    updateUser,
                    saveAddress
                ]).then(axios.spread((res1, res2) => {
                    $(this.$refs.createAdminModal).modal('hide')
                    self.showMessage('success', '儲存使用者成功')
                    self.accountContent = {
                        guid: null,
                        name: null,
                        email: null,
                        remark: null,
                        address: {
                            owner: null,
                            address: null,
                            postcode: null,
                            fullName: null,
                            cellPhone: null,
                            city: null
                        }
                    }
                    self.getUser(self.urlPath);
                })).catch(err => {
                    self.showMessage('error', '儲存使用者失敗')
                }).then(() => {
                    $('.loading-bar').fadeOut('100');
                })
            },
            showMessage: function (type, string) {
                toastr[type](string)
                this.message = string;
            }
        }
    }
</script>
