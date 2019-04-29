<template>
    <div class="row">
        <!-- <div class="col-md-12">
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-4">
                    <el-input placeholder="請輸入關鍵字" v-model="keyword" class="input-with-select">
                        <el-button slot="append" icon="el-icon-search" @click="searchPost"></el-button>
                    </el-input>
                </div>
            </div>
        </div> -->
        <div class="col-md-12">
            <el-table
                :data="pageData.data"
                style="width: 100%">
                <el-table-column
                    prop="fullName"
                    label="姓名">
                </el-table-column>
                <el-table-column
                    prop="email"
                    label="電子郵件">
                </el-table-column>
                <el-table-column
                    prop="mobile"
                    label="行動電話">
                </el-table-column>
                <el-table-column
                    prop="address"
                    label="居住地址">
                </el-table-column>
                <el-table-column
                    prop="postalCode"
                    label="郵遞區號">
                </el-table-column>
                <el-table-column
                    prop="website"
                    label="個人網站">
                    <template slot-scope="scope">
                        <div>
                            <a :href="scope.row.website">{{scope.row.website}}</a>
                        </div>
                    </template>
                </el-table-column>
                <el-table-column
                    label="履歷檔案">
                    <template slot-scope="scope">
                        <div>
                            <a :href="scope.row.resumeFile">{{scope.row.resumeFile}}</a>
                        </div>
                    </template>
                </el-table-column>
                <el-table-column
                    prop="created_at"
                    label="投遞時間"
                    width="180">
                </el-table-column>
            </el-table>
            <el-pagination
                style="margin-top: 10px"
                layout="prev, pager, next"
                :current-page.sync="currentPage"
                :page-size="pageData.per_page"
                @current-change="gotoPage"
                :total="pageData.total">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    import ElementUI from 'element-ui';
    import 'element-ui/lib/theme-chalk/index.css';
    import lang from 'element-ui/lib/locale/lang/zh-TW'
    import locale from 'element-ui/lib/locale'    

    Vue.use(ElementUI)
    locale.use(lang)

    export default {
        mounted () {
            $('.loading-bar').hide()
            console.log('Component mounted.')
        },
        props: ['careerid'],
        data () {
            let urlPath = `/admin/resume/get/${this.careerid}`
            return {
                currentPage: 1,
                tableData: [],
                keyword: null,
                listVo: {
                    keyword: null
                },
                pageData: {},
                urlPath: urlPath
            }
        },
        created() {
            this.getData()
        },
        watch: {
            urlPath: {
                handler(urlPath, oldVal) {
                    this.getData();
                }
            },
        },
        methods: {
            getData() {
                $('.loading-bar').show()
                axios.post(this.urlPath, this.listVo)
                    .then(res => {
                        this.pageData = res.data
                        $('.loading-bar').hide()
                    })
            },
            searchPost() {
                var self = this;

                if (this.keyword) {
                    this.listVo.keyword = this.keyword   
                } else {
                    this.listVo.keyword = null
                }

                this.getData()
            },
            handleCommand(val) {
                let parsedCommand = val.split('.')
                let id = parsedCommand[0]
                let cmd = parsedCommand[1]
                
                switch (cmd) {
                    case 'edit':
                        window.location.href = `/cyberholic-system/career/edit/${id}`
                        break;
                    case 'delete': 
                        this.deleteData(id)
                        break;
                    default:
                        break;
                }
            },
            gotoPage(page) {
                let checkPage = this.urlPath.match('page=')

                if (checkPage) {
                    let pathArray = this.urlPath.split('?')
                    let pageStrIndex

                    pathArray.forEach(elm => {
                        if (elm.match('page=')) {
                            pageStrIndex = pathArray.indexOf(elm)
                        }
                    })

                    pathArray[pageStrIndex] = `page=${page}`
                    
                    this.urlPath = pathArray.join('?')
                } else {
                    const url = `${this.urlPath}?page=${page}`

                    this.urlPath = url
                }
            },
            deleteData(id) {
                this.$confirm('此操作將永久刪除該筆資料, 是否繼續?', '提示', {
                    confirmButtonText: '確定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    axios.post(`/admin/career/delete/${id}`)
                        .then(res => {
                            this.$message({
                                type: 'success',
                                message: '刪除成功!'
                            });

                            this.getData()
                        })
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消刪除'
                    });          
                });
            }
        }
    }
</script>
