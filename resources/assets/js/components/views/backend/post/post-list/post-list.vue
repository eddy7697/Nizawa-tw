<template lang="html">
    <div class="row">
        <div class="col-md-4">
            <searchBar 
                :keyword="keyword"
                :btnTitle="'搜尋最新消息'"
                @newKeyword="newKeyword($event)"
                @searchPost="searchPost($event)"/>
        </div>
        <!-- <div class="col-md-3">
            <categoryList 
                :btnTitle="'變更最新消息類別'"
                :selectedCategoryName="selectedCategoryName"
                :data="categories"
                :selectedCategoryKey="selectedCategoryKey"
                @changeCategory="changeCategory($event)"/>
        </div> -->
        <div class="col-md-12" v-if="!isEmpty">            
            <itemList 
                :column="column"
                :config="listConfig"
                :data="posts" 
                @doListFunction="doListFunction($event)"
                @sortAction="sortAction($event)"
                @togglePublish="togglePublish($event)"
                @editPost="editPost($event)">
            </itemList>
            <ul class="pagination">
                <li v-if="prev_page_url">
                    <a href="#" @click="prevPage()">上一頁</a>
                </li>
                <li v-for="item in eachPage" v-bind:class="{ active: current_page == item.pageNumber }">
                    <a href="#" @click="gotoPage(item)">{{item.pageNumber}}</a>
                </li>
                <li v-if="next_page_url">
                    <a href="#" @click="nextPage()">下一頁</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import ToggleButton from 'vue-js-toggle-button';

    var itemList = require('../../../../common/itemList.vue');
    var categoryList = require('../../../../common/categoryList.vue');
    var searchBar = require('../../../../common/searchBar.vue');

    Vue.use(ToggleButton);

    export default {
        data() {
            return {
                isLoaded: false,
                posts: [],
                next_page_url: null,
                prev_page_url: null,
                total: null,
                current_page: null,
                eachPage: [],
                allSelect: false,
                keyword: null,
                isEmpty: false,
                defaultOrder: 'desc',
                token: $('meta[name="csrf-token"]').attr('content'),
                listFunction: 'default',
                flag: 'schedulePost',
                selectedCategoryName: '全部類別',
                selectedCategoryKey: 'ALL',
                categories: [],
                urlPath: '/admin/post/get',
                column: [
                    {
                        label: '最新消息名稱',
                        id: 'postTitle',
                        type: 'string',
                        sortable: true
                    },{
                        label: '建立者',
                        id: 'authorName',
                        type: 'string',
                        sortable: true
                    },{
                        label: '建立時間',
                        id: 'created_at',
                        type: 'string',
                        sortable: true
                    },{
                        label: '狀態',
                        id: 'isPublish',
                        type: 'method',
                        method: 'togglePublish',
                        sortable: true,
                        alignment: 'center',
                        formatter: (item) => {
                            if (item.isPublish) {
                                return `<i class="fa fa-toggle-on pointer" aria-hidden="true"></i>`
                            } else {
                                return `<i class="fa fa-toggle-off pointer" aria-hidden="true"></i>`
                            }
                        }
                    },{
                        label: '編輯',
                        id: 'postGuid',
                        type: 'method',
                        method: 'editPost',
                        alignment: 'center',
                        formatter: (item) => { 
                            return `<i class="fa fa-pencil pointer" aria-hidden="true"></i>`
                        }
                    }
                ],
                listConfig: {
                    checkBox: true,
                    listFunction: [
                        {
                            title: '請選擇動作',
                            method: 'default'
                        },{
                            title: '刪除最新消息',
                            method: 'deletePosts'
                        }                        
                    ]
                }
            }
        },
        components: {
            itemList,
            searchBar,
            categoryList
        },
        created: function () {
            var self = this;

            this.getPostData('/admin/post/get');
            this.getCategories();
        },
        watch: {
            isAllSelected: {
                handler: function (isAllSelected, oldVal) {
                    var self = this;

                    this.allSelect = isAllSelected;
                }
            }
        },
        computed: {
            isAllSelected: function () {
                var status = true;

                this.posts.forEach(function (item) {
                    if (!item.isSelect) {
                        status = false;
                    }
                });

                return status;
            },
            selectedPosts: function () {
                var selectedRows = [];

                this.posts.forEach(function (item) {
                    if (item.isSelect) {
                        selectedRows.push(item.postGuid);
                    }
                });

                return selectedRows;
            }
        },
        methods: {
            analyzePlacement (val) {
                console.log(val)
            },
            togglePublish: function (item) {
                var self = this;
                var token = this.token;
                var itemIndex = this.posts.indexOf(item);

                $('.loading-bar').fadeIn('100');

                $.ajax({
                    url: '/admin/post/update/' + item.postGuid,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        isPublish: item.isPublish ? '0' : '1'
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function() {
                    self.showMessage('success', '變更發布狀態成功');
                    item.isPublish = !item.isPublish
                })
                .fail(function() {
                    console.log(itemIndex);
                    self.showMessage('error', '變更發布狀態失敗');
                })
                .always(function() {
                    $('.loading-bar').fadeOut('100');
                });
            },
            toggleAllSelect: function () {
                if (this.isAllSelected) {
                    this.posts.forEach(function (item) {
                        item.isSelect = false;
                    });
                } else {
                    this.posts.forEach(function (item) {
                        item.isSelect = true;
                    });
                }
            },
            doListFunction: function (item) {
                var self = this;

                switch (item.method) {
                    case "deletePosts":
                        this.deletePosts(item);
                        break;
                    default:
                        console.log(this.listFunction);
                }

            },
            editPost: function (item) {
                window.location = '/cyberholic-system/post/edit/' + item.postGuid;
            },
            searchPost() {
                var self = this;

                $('.loading-bar').fadeIn('100');

                if (self.keyword) {
                    this.urlPath = `/admin/post/search/${self.keyword}`
                    this.getPostData(`/admin/post/search/${self.keyword}`);
                } else {
                    this.urlPath = '/admin/post/get';
                    this.getPostData('/admin/post/get');
                }
            },
            changeCategory (key) {
                $('.loading-bar').fadeIn('100')

                this.selectedCategoryKey = key

                if (key == 'ALL') {
                    this.selectedCategoryName = '全部類別'
                    this.urlPath = '/admin/post/get';
                    this.getPostData('/admin/post/get');
                } else {
                    var selectedCategory = _.find(this.categories, ['guid', key])

                    this.selectedCategoryName = selectedCategory.name
                    this.urlPath = `/admin/post/get/category/${key}`;
                    this.getPostData(`/admin/post/get/category/${key}`);
                }
            },
            getCategories () {
                var self = this;

                axios.get('/posts/category')
                    .then(result => {
                        // console.log(result)
                        self.categories = [];
                        result.data.data.forEach(function(item) {
                            self.categories.push({
                                'categoryParent': item.parentId,
                                'name': item.categoryTitle,
                                'guid': item.categoryGuid,
                                'parentId': item.parentId,
                                'isEdit': false,
                                'description': item.categoryDescription,
                                'featureImage': item.featureImage
                            });
                        });
                    }).catch(err => {
                        console.log(err)
                    })
            },
            newKeyword (item) {
                this.keyword = item
            },
            deletePosts: function (items) {
                var self = this;
                var token = this.token;
                var checkDelete = confirm('確認要刪除所有已選取的最新消息嗎?');

                if (!checkDelete) {
                    return
                }

                $('.loading-bar').fadeIn('100');

                $.ajax({
                    url: '/admin/post/delete',
                    type: 'POST',
                    dataType: 'json',
                    cache: false,
                    data: {
                        data: items.content.map(elm => {
                            return elm.postGuid
                        })
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function(result) {
                    self.showMessage('success', '最新消息刪除成功');
                    self.getPostData('/admin/post/get');
                })
                .fail(function() {
                    self.showMessage('success', '最新消息刪除失敗');
                })
                .always(function() {
                    // self.getPostData('/admin/post/get');
                    $('.loading-bar').fadeOut('100');
                });

            },
            nextPage: function () {
                this.getPostData(this.next_page_url);
            },
            prevPage: function () {
                this.getPostData(this.prev_page_url);
            },
            gotoPage: function (item) {
                this.getPostData(`${this.urlPath}?page=${item.pageNumber}`);
            },
            sortAction (flag) {
                this.defaultOrder = this.defaultOrder == 'asc' ? 'desc' : 'asc';
                this.flag = flag
                this.getPostData(this.urlPath, flag);
            },
            getPostData: function (url) {
                var self = this;
                
                axios.get(url, {
                    params: {
                        flag: self.flag,
                        order: self.defaultOrder
                    }
                }).then(result => {
                    var postData = result.data;

                    if (result.data.data.length < 1) {
                        self.isEmpty = true
                        $('.loading-bar').fadeOut('100');
                        return
                    } else {
                        self.isEmpty = false
                    }

                    self.posts = [];
                    self.next_page_url = postData.next_page_url;
                    self.prev_page_url = postData.prev_page_url;
                    self.current_page = postData.current_page;
                    self.total = postData.total;
                    self.eachPage = [];                           

                    result.data.data.forEach(item => {
                        self.posts.push({
                            postGuid: item.postGuid,
                            postTitle: item.postTitle,
                            authorName: item.authorName,
                            categoryTitle: item.categoryTitle,
                            price: item.price,
                            isPublish: Boolean(item.isPublish),
                            isSelect: false,
                            created_at: item.created_at
                        })
                    });

                    for (var i = 0; i < postData.last_page; i++) {
                        self.eachPage.push({
                            pageNumber: i + 1,
                        });
                    }

                    self.isLoaded = true;
                    $('.loading-bar').fadeOut('100');
                }).catch(err => {
                    console.log(err)
                })

            },
            thumb: function (url) {
                var urlArray = url.split('/');
                var newUrl = urlArray[0];

                for (var i = 1; i < (urlArray.length - 1); i++) {
                    newUrl = newUrl + '/' + urlArray[i];
                }

                newUrl = newUrl + '/thumbs/' + urlArray[urlArray.length - 1];

                return newUrl;
            },
            showMessage: function (type, string) {
                toastr[type](string)
                this.message = string;
            }
        }
    }
</script>
