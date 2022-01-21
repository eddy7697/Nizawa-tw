<template>
    <div class="row">
        <div class="col-md-8">
            <div style="margin-bottom: 20px">
                <el-radio-group v-model="type" size="medium">
                    <el-radio-button label="產品目錄"></el-radio-button>
                    <el-radio-button label="文件下載"></el-radio-button>
                    <el-radio-button label="資質證明"></el-radio-button>
                </el-radio-group>
            </div>
            <el-table :data="pageData.data" border style="width: 100%">
                <el-table-column fixed prop="title" label="檔案下載標題">
                    <template slot-scope="scope">
                        <div>
                            {{ JSON.parse(scope.row.title)["zh-TW"] }}
                        </div>
                    </template>
                </el-table-column>
                <el-table-column fixed="right" label="切換置頂" width="80">
                    <template slot-scope="record">
                        <div style="text-align: center">
                            <el-switch
                                v-model="record.row.isTop"
                                active-color="#13ce66"
                                @change="handleChange(record.row)"
                                inactive-color="#ff4949"
                            >
                            </el-switch>
                        </div>
                    </template>
                </el-table-column>
                <el-table-column
                    fixed="right"
                    label="操作"
                    header-align="center"
                    align="center"
                    width="100"
                >
                    <template slot-scope="record">
                        <el-button
                            @click="handleClick(record.row)"
                            type="text"
                            size="small"
                            >编辑</el-button
                        >
                        <el-button
                            @click="handleDelete(record.row)"
                            type="text"
                            size="small"
                            >刪除</el-button
                        >
                    </template>
                </el-table-column>
            </el-table>
            <el-pagination
                style="margin-top: 10px"
                layout="prev, pager, next"
                :current-page.sync="currentPage"
                :page-size="pageData.per_page"
                @current-change="gotoPage"
                :total="pageData.total"
            >
            </el-pagination>
        </div>
    </div>
</template>

<script>
import ElementUI from "element-ui";
import "element-ui/lib/theme-chalk/index.css";
import lang from "element-ui/lib/locale/lang/zh-TW";
import locale from "element-ui/lib/locale";

Vue.use(ElementUI);
locale.use(lang);

export default {
    mounted() {
        console.log("Component mounted.");
        $(".loading-bar").hide();
    },
    data() {
        return {
            type: "產品目錄",
            pageData: {},
            currentPage: 1,
            urlPath: "/admin/download/get",
        };
    },
    created() {
        this.getData();
    },
    watch: {
        type() {
            this.getData();
        },
        urlPath: {
            handler(urlPath, oldVal) {
                this.getData();
            },
        },
    },
    methods: {
        getData() {
            let vo = {
                type: this.type,
            };

            $(".loading-bar").show();

            axios.post(this.urlPath, vo).then((res) => {
                res.data.data.forEach((elm) => {
                    elm.isTop = elm.isTop == 1;
                });
                this.pageData = res.data;
                $(".loading-bar").hide();
            });
        },
        gotoPage(page) {
            let checkPage = this.urlPath.match("page=");

            if (checkPage) {
                let pathArray = this.urlPath.split("?");
                let pageStrIndex;

                pathArray.forEach((elm) => {
                    if (elm.match("page=")) {
                        pageStrIndex = pathArray.indexOf(elm);
                    }
                });

                pathArray[pageStrIndex] = `page=${page}`;

                this.urlPath = pathArray.join("?");
            } else {
                const url = `${this.urlPath}?page=${page}`;

                this.urlPath = url;
            }
        },
        handleClick(row) {
            console.log(row);
            window.location.href = `/cyberholic-system/download/edit/${row.id}`;
        },
        handleDelete(row) {
            this.$confirm(
                "此操作將會刪除所選項目且無法復原，是否繼續？",
                "刪除檔案下載",
                {
                    confirmButtonText: "OK",
                    cancelButtonText: "Cancel",
                    type: "success",
                }
            ).then((action) => {
                axios
                    .delete(`/admin/download/delete/${row.id}`)
                    .then((res) => {
                        this.getData();
                        this.$message.success("刪除成功");
                    })
                    .catch((err) => {
                        this.$message.error("刪除失敗");
                    });
            });
        },
        handleChange(val) {
            console.log(val);
            axios
                .post(`/admin/download/udpate/status/${val.id}`)
                .then((res) => {
                    this.getData();
                    this.$message.success("變更狀態成功");
                });
        },
    },
};
</script>