<template>
    <div class="row">
        <div class="col-md-7">
            <!-- <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">繁體中文</a></li>
                <li><a data-toggle="tab" href="#menu1">英文</a></li>
            </ul> -->

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <table class="table field-table">
                        <thead>
                            <tr>
                                <th>區塊名稱</th>
                                <th width="70" align="center" style="text-align: center;">識別ID</th>
                                <!-- <th width="70" align="center" style="text-align: center;">語系</th> -->
                                <th width="40" align="center" style="text-align: center;">編輯</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in pageContent" v-bind:key="index">
                                <td><a v-bind:href="editLink(item)">{{item.title}}</a></td>
                                <td align="center">{{item.id}}</td>
                                <!-- <td align="center" style="text-align: center;">
                                    <span v-if="item.locale == 'en'"><strong>英文</strong></span>
                                    <span v-if="item.locale == 'zh-TW'"><strong>繁體中文</strong></span>
                                </td> -->
                                <td align="center" style="text-align: center;"><a v-bind:href="editLink(item)"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    $('.loading-bar').fadeOut('100');
    export default {
        data() {
            return {
                pageContent: []
            }
        },
        props: ['type'],
        created: function () {
            this.getPages();
        },
        methods: {
            getPages: function () {
                var self = this;

                console.log(this.type)

                $.ajax({
                    url: '/admin/page/get',
                    type: 'GET',
                    dataType: 'json'
                })
                .done(function(response) {
                    response.data.forEach(function (item) {
                        if (item.type == self.type) {
                            self.pageContent.push({
                                title: item.title,
                                guid: item.guid,
                                id: item.id,
                                locale: item.locale
                            });
                        }                        
                    });
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });

            },
            localeFilter(locale) {
                return _.compact(this.pageContent.map(elm => {
                    return elm.locale == locale ? elm : null
                }))
            },
            editLink: function (item) {
                return "/cyberholic-system/page/edit/" + item.guid;
            }
        }
    }
</script>
