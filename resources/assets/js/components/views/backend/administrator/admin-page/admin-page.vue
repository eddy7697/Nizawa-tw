<template>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel tile fixed_height_600">
                <div class="x_title">
                    <h2>庫存警示 (一般商品，庫存低於３) </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table field-table">
                        <thead>
                            <tr>
                                <th>貨號</th>
                                <th>產品名稱</th>                                
                                <th style="text-align: right">庫存數量</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in simpleProduct" v-bind:key="index">
                                <td>{{item.serialNumber}}</td>
                                <td>
                                    <a :href="`/cyberholic-system/product/edit/${item.productGuid}`">
                                        {{item.productTitle}}
                                    </a>
                                </td> 
                                <td align="right">{{item.quantity}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel tile fixed_height_600">
                <div class="x_title">
                    <h2>庫存警示 (子商品，庫存低於３)</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table field-table">
                        <thead>
                            <tr>
                                <th>貨號</th>
                                <th>產品名稱</th>               
                                <th>上層商品</th>                 
                                <th style="text-align: right">庫存數量</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in subProducts" v-bind:key="index">
                                <td>{{item.subSerialNumber}}</td>
                                <td>{{item.subTitle}}</td> 
                                <td>
                                    <a :href="`/cyberholic-system/product/edit/${item.productParent}`">
                                        {{item.productTitle}}
                                    </a>
                                </td>
                                <td align="right">
                                    {{item.subQuantity}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel tile fixed_height_600 overflow_hidden">
                <div class="x_title">
                    <h2>最新訂單</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div v-if="newestOrder.length == 0" class="alert alert-warning" style="background: #0C6BB0; border-color: #119AFC">
                        <strong>目前沒有新訂單。</strong>
                    </div>
                    <table v-else class="table field-table">
                        <thead>
                            <tr>
                                <th>訂單編號</th>
                                <th>訂購人</th>                                
                                <th style="text-align: right">總金額</th>
                                <th style="text-align: right">訂單狀態</th>
                                <th style="text-align: right">下單日期</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in newestOrder" v-bind:key="index">
                                <td :class="{ urgent: item.isUrgent}">{{item.merchantID}}</td>
                                <td :class="{ urgent: item.isUrgent}">
                                    {{item.shippingTarget.ReceiverName}}
                                </td> 
                                <td align="right" :class="{ urgent: item.isUrgent}">
                                    {{item.amount}}
                                </td>                               
                                <td align="right">
                                    <span style="color: brown; font-weight: bold" v-if="item.orderStatus == 'undisposed'">未處理</span>
                                    <span style="color: brown; font-weight: bold" v-if="item.orderStatus == 'disposing'">處理中</span>
                                    <span style="color: green; font-weight: bold" v-if="item.orderStatus == 'contacted'">已聯絡</span>
                                    <span style="color: green; font-weight: bold" v-if="item.orderStatus == 'disposed'">已出貨</span>
                                    <span style="color: red; font-weight: bold" v-if="item.orderStatus == 'canceled'">已取消</span>
                                    <span style="color: blue; font-weight: bold" v-if="item.orderStatus == 'success'">完成</span>
                                </td>
                                <td align="right" :class="{ urgent: item.isUrgent}">
                                    {{item.created_at}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel tile fixed_height_600">
                <div class="x_title">
                    <h2>流量統計</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <h4>頁面瀏覽排名</h4>
                    <div class="widget_summary" v-for="(item, index) in analyticsData.slice(0, 10)" v-bind:key="index">
                        <div class="w_left w_25">
                            <span>{{item.url}}</span>
                        </div>
                        <div class="w_center w_55">
                            <div class="progress">
                                <div class="progress-bar" style="background: #0C6BB0" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" v-bind:style="valuePercentage(item.pageViews)">
                                    <span class="sr-only">60% Complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="w_right w_20">
                            <span>{{item.pageViews}}</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
        </div>
        
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile fixed_height_320 overflow_hidden" style="height: 730px;">
                <div class="x_title">
                    <h2>訪客分析</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="user-type-list">
                        <ul>
                            <li v-for="(item, index) in userType" v-bind:key="index">
                                <span v-if="item.type === 'New Visitor'">新訪客： </span>
                                <span v-else>回流訪客： </span>
                                {{item.sessions}}人次
                            </li>
                        </ul>
                    </div>
                    <div class="pie-chart"></div>
                    
                </div>
            </div>
        </div> -->

    </div>
</template>

<script>
    // import VueCharts from 'vue-chartjs'

    export default {
        data() {
            return {
                analyticsData: [],
                userType: [],
                lastDays: 14,
                newestOrder: [],
                datasets: [{
                    data: [10, 20, 30]
                }],
                simpleProduct: [],
                subProducts: [],
                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: [
                    'Red',
                    'Yellow',
                    'Blue'
                ]
            }
        },
        created() {
            $('.loading-bar').fadeOut('100')
            this.generateChart()
            this.generatePieChart()
            this.getNewestOrder()
            this.getSimpleLowQty()
            this.getSubLowQty()
            // var ctx = document.getElementById("my-pie");
            // var myChart = new Chart(ctx, {
            //     type: 'pie',
            //     data: {
            //     }
            // });
        },
        methods: {
            valuePercentage (val) {
                var percentage = (val * 100 / this.analyticsData[0].pageViews)  + '%';
                return `width: ${percentage}`;
            },
            generateChart() {
                var self = this;

                this.getPageViews().then(function (value) {

                    // console.log(value.slice(0, 5))

                    d3.select('.bar-chart')
                      .selectAll('div')
                      .data(value)
                      .enter()
                      .append('div')
                      .attr('class', 'item clearfix')
                      .text(function (d) {
                          return d.url;
                      })
                      .append('div')
                      .text(function (data) {
                          return data.pageViews;
                      })
                      .attr('class','bar')
                      .style('width', function(d){
                          return (d.pageViews * 100 / value[0].pageViews)  + '%';
                      });
                });
            },
            generatePieChart() {
                var serlf = this;

                this.getUserType().then(function (value) {
                    var data = value;

                    var width = 800,
                        height = 600,
                        radius = Math.min(width, height) / 2;

                    var color = d3.scale.ordinal()
                        .range(["#00DBC0", "#C0BBB8", "#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00"]);

                    var arc = d3.svg.arc()
                        .outerRadius(radius - 10)
                        .innerRadius(radius - 130);

                    var pie = d3.layout.pie()
                        .sort(null)
                        .value(function (d) {
                        return d.sessions;
                    });



                    var svg = d3.select(".pie-chart").append("svg")
                        .attr("width", width)
                        .attr("height", height)
                        .append("g")
                        .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

                        var g = svg.selectAll(".arc")
                            .data(pie(data))
                            .enter().append("g")
                            .attr("class", "arc");

                        g.append("path")
                            .attr("d", arc)
                            .style("fill", function (d) {
                            return color(d.data.type);
                        });

                        g.append("text")
                            .attr("transform", function (d) {
                            return "translate(" + arc.centroid(d) + ")";
                        })
                            .attr("dy", ".35em")
                            .style("font-size", "30px")
                            .style("text-anchor", "middle")
                            .text(function (d) {
                                if (d.data.type === "New Visitor") {
                                    return '新訪客 \n';
                                } else {
                                    return '回流訪客 \n';
                                }
                        });
                });
            },
            getPageViews() {
                var self = this;

                return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: '/admin/analytics/get/pageViews/' + self.lastDays,
                        type: 'GET',
                        dataType: 'json'
                    })
                    .done(function(result) {
                        self.analyticsData = [];

                        result.forEach(function (item) {
                            if ((item.pageTitle !== 'good 烘焙房') &&
                                (item.pageTitle !== '台灣帕太股份有限公司') &&
                                (item.pageTitle !== '(not set)')) {
                                self.analyticsData.push(item);
                            }
                        });

                        resolve(self.analyticsData);
                    })
                    .fail(function(xhr) {
                        reject(xhr);
                    });
                });
            },
            getNewestOrder() {
                var self = this

                axios.get('/admin/getNewOrder')
                    .then(res => {
                        // console.log(res.data)
                        // self.newestOrder = res.data

                        self.newestOrder = res.data.map(elm => {
                            let isUrgent = new Date(elm.created_at).getTime() < new Date(`${moment().format('YYYY-MM-DD')} 14:00:00`).getTime()

                            return {
                                amount: elm.amount,
                                content: JSON.parse(elm.content),
                                merchantID: elm.merchantID,
                                created_at: elm.created_at,
                                orderStatus: elm.orderStatus,
                                isUrgent: isUrgent,
                                shippingTarget: JSON.parse(elm.shippingTarget)
                            }
                        })
                    }).catch(err => {

                    })
            },
            getUserType() {
                var self = this;

                return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: '/admin/analytics/get/getUserType/' + self.lastDays,
                        type: 'GET',
                        dataType: 'json'
                    })
                    .done(function(result) {
                        self.userType = result;
                        resolve(result);
                    })
                    .fail(function() {
                        reject("error");
                    });
                });
            },
            getSimpleLowQty() {
                let self = this

                axios.get('/admin/product/low_qty')
                    .then(res => {
                        self.simpleProduct = res.data
                    })
            },
            getSubLowQty() {
                let self = this

                axios.get('/admin/product/sub/low_qty')
                    .then(res => {
                        self.subProducts = res.data
                    })
            }
        }
    }
</script>

<style scoped>
.w_25 {
    overflow : hidden;
    text-overflow : ellipsis;
    white-space : nowrap;
}
.x_title h2 {
    float: initial;
}
.x_content h4 {
    margin-top: 0px;
    margin-bottom: 20px;
}
.user-type-list {
    font-size: 18px;
}
.urgent {
    color: red;
}
</style>
