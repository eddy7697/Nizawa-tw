<template>
    <div class="row">
        <div class="col-md-8">
            <div style="margin-bottom: 20px">
                <el-radio-group v-model="type" size="medium">
                    <el-radio-button label="產品目錄" ></el-radio-button>
                    <el-radio-button label="文件下載"></el-radio-button>
                    <el-radio-button label="資質證明"></el-radio-button>
                </el-radio-group>
            </div>
            <el-table
                :data="pageData.data"
                border
                style="width: 100%">
                <el-table-column
                    fixed
                    prop="title"
                    label="檔案下載標題">
                    <template slot-scope="scope">
                        <div>
                            {{JSON.parse(scope.row.title)['zh-TW']}}
                        </div>
                    </template>
                </el-table-column>
                <el-table-column
                    fixed="right"
                    label="切換置頂"
                    width="80">
                    <template slot-scope="record">
                        <div style="text-align: center">
                            <el-switch
                                v-model="record.row.isTop"
                                active-color="#13ce66"
                                @change="handleChange(record.row)"
                                inactive-color="#ff4949">
                            </el-switch>
                        </div>
                    </template>
                </el-table-column>
                <el-table-column
                    fixed="right"
                    label="操作"
                    width="50">
                    <template slot-scope="record">
                        <el-button @click="handleClick(record.row)" type="text" size="small">编辑</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>
    </div>
</template>

<script>
    import ElementUI from 'element-ui'
    import 'element-ui/lib/theme-chalk/index.css'
    import lang from 'element-ui/lib/locale/lang/zh-TW'
    import locale from 'element-ui/lib/locale'
    
    Vue.use(ElementUI)
    locale.use(lang)

    export default {
        mounted () {
            console.log('Component mounted.')
            $('.loading-bar').hide()
        },
        data () {
            return {
                type: '產品目錄',
                pageData: {},
            }
        },
        created() {
            this.getData()
        },
        watch: {
            type() {
                this.getData()
            }
        },
        methods: {
            getData() {
                let vo = {
                    type: this.type
                }
                $('.loading-bar').show()
                axios.post(`/admin/download/get`, vo)
                    .then(res => {
                        res.data.data.forEach(elm => {
                            elm.isTop = elm.isTop == 1
                        });
                        this.pageData = res.data
                        $('.loading-bar').hide()
                    })
            },
            handleClick(row) {
                console.log(row)
                window.location.href = `/cyberholic-system/download/edit/${row.id}`
            },
            handleChange(val) {
                console.log(val)
                axios.post(`/admin/download/udpate/status/${val.id}`)
                    .then(res => {
                        this.getData()
                        this.$message.success('變更狀態成功')
                    })
            }
        }
    }
</script>