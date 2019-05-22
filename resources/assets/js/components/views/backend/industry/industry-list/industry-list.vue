<template>
    <div class="row">
        <div class="col-md-10">
            <el-table
                :data="pageData.data"
                style="width: 100%">
                <el-table-column
                    prop="id"
                    width="50"
                    label="#">
                </el-table-column>
                <el-table-column
                    label="標題">
                    <template slot-scope="scope">
                        <div>
                            {{scope.row.locale['zh-TW']}}&nbsp;&nbsp;|&nbsp;&nbsp;{{scope.row.locale['zh-CN']}}&nbsp;&nbsp;|&nbsp;&nbsp;{{scope.row.locale['en']}}
                        </div>
                    </template>
                </el-table-column>
                <el-table-column
                    label="編輯"
                    width="80">
                    <template slot-scope="scope">
                        <div>
                            <el-button type="primary" icon="el-icon-edit" circle @click="editIndu(scope.row)"></el-button>
                        </div>
                    </template>
                </el-table-column>
            </el-table>
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
        mounted () {
            $('.loading-bar').hide()
        },
        data () {
            return {
                pageData: {}
            }
        },
        created() {
            this.getIndustry()
        },
        methods: {
            getIndustry() {
                axios.post('/admin/custom/get/industry')
                    .then(res => {
                        res.data.data.forEach(elm => {
                            elm.locale = JSON.parse(elm.locale)
                        });
                        this.$nextTick(() => {
                            this.pageData = res.data
                        })
                        

                    })
            },
            editIndu(row) {
                window.location.href = `/cyberholic-system/industry/edit/${row.id}`
            }
        }
    }
</script>
