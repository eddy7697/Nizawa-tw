<template>
    <div class="row">
        <div class="col-md-12 partner-filter">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 mx-auto" style="line-height: 60px; color: #EEE">
                        {{partner_finder}}
                    </div>
                    <div class="col-md-8 mx-auto">
                        <div class="row">
                            <div class="col-md-4 mx-auto">
                                <div class="select-wrapper">
                                    <select class="" name="" v-model="partnerType">
                                        <option value="">{{partner_finder_choose}}</option>
                                        <option v-for="(item, index) in typeList" :key="index" v-bind:value="item.categoryGuid">{{parseStr(item.categoryTitle)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mx-auto">
                                <div class="select-wrapper">
                                    <select class="" name="" v-model="partnerLocation">
                                        <option value="">{{partner_finder_country}}</option>
                                        <option v-for="(item, index) in locationList" :key="index" v-bind:value="item.categoryGuid">{{parseStr(item.categoryTitle)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-md-3" style="height:600px; padding: 0; overflow: auto;">
            <ul class="partner-list">
                <li v-for="(item, index) in feature" :key="index" class="map-btn" v-bind:id="item.id" @click="switchMap(item)">
                    <h4>{{item.name}}</h4>
                    <h5>{{item.addressString}}</h5>
                    <a v-bind:href="item.link">{{item.link}}</a>
                    <button class="map-button"><span class="glyphicon glyphicon-map-marker"></span></button>
                </li>
            </ul>
        </div>
        <div class="col-md-9" id="dituContent" style="height:600px">

        </div>
    </div>
</template>

<script>
    $('.loading-bar').fadeOut('100');
    export default {
        props: ['locale'],
        data() {
            let i18n = JSON.parse(document.getElementById('i18n-text').value)
            return {
                i18n: i18n,
                partnerType: '',
                partnerLocation: '',
                typeList: [],
                locationList: [],
                feature: [],
                lat: 121.530151,
                lng: 31.234715,
                title: "科尔客化学工业（上海）有限公司",
                note: "我的备注",
                partner_finder: $('#partner_finder').val(),
                partner_finder_choose: $('#partner_finder_choose').val(),
                partner_finder_country: $('#partner_finder_country').val(),
                token: $('meta[name="csrf-token"]').attr('content'),
            }
        },
        created: function () {
            var self = this;
            var token = this.token;

            var getPartnerLocationPromise = new Promise(function (resolve, reject) {
                $.ajax({
                    url: '/category/get',
                    type: 'POST',
                    cache: false,
                    data: {
                        type: 'partnerLocation'
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function(response) {
                    resolve(response);
                })
                .fail(function(error) {
                    reject(error);
                });
            });

            var getPartnerTypePromise = new Promise(function (resolve, reject) {
                $.ajax({
                    url: '/category/get',
                    type: 'POST',
                    cache: false,
                    data: {
                        type: 'partnerType'
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function(response) {
                    resolve(response);
                })
                .fail(function(error) {
                    reject(error);
                });
            });

            Promise.all([
                getPartnerLocationPromise,
                getPartnerTypePromise
            ]).then(function (results) {
                self.typeList = results[1];
                self.locationList = results[0];

                self.getPartners();
            });

        },
        watch: {
            partnerType: {
                handler: function (partnerType, oldVal) {
                    var self = this;
                    self.getPartners();
                },
                deep: true
            },
            partnerLocation: {
                handler: function (partnerLocation, oldVal) {
                    var self = this;
                    self.getPartners();
                },
                deep: true
            }
        },
        methods: {
            getPartners: function () {
                var self = this;
                var token = this.token;

                $.ajax({
                    url: '/partner/get',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        partnerType: self.partnerType,
                        partnerLocation: self.partnerLocation
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function(response) {
                    self.feature = [];

                    response.forEach(function (item) {
                        self.feature.push({
                            id: item.guid,
                            name: item.name,
                            link: item.link,
                            addressString: item.addressString,
                            lat: item.latitude,
                            lng: item.longitude,
                            type: 'location'
                        });
                    });

                    window.feature = self.feature;

                    // window.initGoogleMap();
                    self.initBmap();
                })
                .fail(function() {
                })
                .always(function() {
                });

            },
            switchMap(item) {
                this.lat = parseFloat(item.lng)
                this.lng = parseFloat(item.lat)
                this.note = item.link
                this.title = item.name

                this.$nextTick(() => {
                    this.initBmap()
                })
            },
            initBmap() {
                let self = this

                //创建和初始化地图函数：
                function initMap(){
                    createMap();//创建地图
                    setMapEvent();//设置地图事件
                    addMapControl();//向地图添加控件
                    addMarker();//向地图中添加marker
                }
                
                //创建地图函数：
                function createMap(){
                    var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
                    var point = new BMap.Point(self.lat,self.lng);//定义一个中心点坐标
                    map.centerAndZoom(point,18);//设定地图的中心点和坐标并将地图显示在地图容器中
                    window.map = map;//将map变量存储在全局
                }
                
                //地图事件设置函数：
                function setMapEvent(){
                    map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
                    map.enableScrollWheelZoom();//启用地图滚轮放大缩小
                    map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
                    map.enableKeyboard();//启用键盘上下左右键移动地图
                }
                
                //地图控件添加函数：
                function addMapControl(){
                    //向地图中添加缩放控件
                var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
                map.addControl(ctrl_nav);
                    //向地图中添加缩略图控件
                var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:1});
                map.addControl(ctrl_ove);
                    //向地图中添加比例尺控件
                var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
                map.addControl(ctrl_sca);
                }
                
                //标注点数组
                var markerArr = [{title:"我的标记",content:self.note,point:`${self.lat}|${self.lng}`,isOpen:0,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}}
                    ,{title:self.title,content:self.note,point:`${self.lat}|${self.lng}`,isOpen:0,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}}
                    ];
                //创建marker
                function addMarker(){
                    for(var i=0;i<markerArr.length;i++){
                        var json = markerArr[i];
                        var p0 = json.point.split("|")[0];
                        var p1 = json.point.split("|")[1];
                        var point = new BMap.Point(p0,p1);
                        var iconImg = createIcon(json.icon);
                        var marker = new BMap.Marker(point,{icon:iconImg});
                        var iw = createInfoWindow(i);
                        var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
                        marker.setLabel(label);
                        map.addOverlay(marker);
                        label.setStyle({
                                    borderColor:"#808080",
                                    color:"#333",
                                    cursor:"pointer"
                        });
                        
                        (function(){
                            var index = i;
                            var _iw = createInfoWindow(i);
                            var _marker = marker;
                            _marker.addEventListener("click",function(){
                                this.openInfoWindow(_iw);
                            });
                            _iw.addEventListener("open",function(){
                                _marker.getLabel().hide();
                            })
                            _iw.addEventListener("close",function(){
                                _marker.getLabel().show();
                            })
                            label.addEventListener("click",function(){
                                _marker.openInfoWindow(_iw);
                            })
                            if(!!json.isOpen){
                                label.hide();
                                _marker.openInfoWindow(_iw);
                            }
                        })()
                    }
                }
                //创建InfoWindow
                function createInfoWindow(i){
                    var json = markerArr[i];
                    var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
                    return iw;
                }
                //创建一个Icon
                function createIcon(json){
                    var icon = new BMap.Icon("https://api.map.baidu.com/lbsapi/creatmap/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
                    return icon;
                }
                
                initMap();//创建和初始化地图 
            },
            parseStr(str) {
                return JSON.parse(str)[this.locale]
            }
        }
    }
</script>
