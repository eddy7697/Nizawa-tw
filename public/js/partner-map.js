/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 675);
/******/ })
/************************************************************************/
/******/ ({

/***/ 18:
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ 675:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(676);


/***/ }),

/***/ 676:
/***/ (function(module, exports, __webpack_require__) {

Vue.component('partner-map', __webpack_require__(677));

var app = new Vue({
    el: '#partner-map'
});

/***/ }),

/***/ 677:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(18)
/* script */
var __vue_script__ = __webpack_require__(678)
/* template */
var __vue_template__ = __webpack_require__(679)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\assets\\js\\components\\views\\frontend\\partner\\partner-map.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-f0dc1484", Component.options)
  } else {
    hotAPI.reload("data-v-f0dc1484", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 678:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

$('.loading-bar').fadeOut('100');
/* harmony default export */ __webpack_exports__["default"] = ({
    props: ['locale'],
    data: function data() {
        var i18n = JSON.parse(document.getElementById('i18n-text').value);
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
            token: $('meta[name="csrf-token"]').attr('content')
        };
    },

    created: function created() {
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
                beforeSend: function beforeSend(xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            }).done(function (response) {
                resolve(response);
            }).fail(function (error) {
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
                beforeSend: function beforeSend(xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            }).done(function (response) {
                resolve(response);
            }).fail(function (error) {
                reject(error);
            });
        });

        Promise.all([getPartnerLocationPromise, getPartnerTypePromise]).then(function (results) {
            self.typeList = results[1];
            self.locationList = results[0];

            self.getPartners();
        });
    },
    watch: {
        partnerType: {
            handler: function handler(partnerType, oldVal) {
                var self = this;
                self.getPartners();
            },
            deep: true
        },
        partnerLocation: {
            handler: function handler(partnerLocation, oldVal) {
                var self = this;
                self.getPartners();
            },
            deep: true
        }
    },
    methods: {
        getPartners: function getPartners() {
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
                beforeSend: function beforeSend(xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            }).done(function (response) {
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
            }).fail(function () {}).always(function () {});
        },
        switchMap: function switchMap(item) {
            var _this = this;

            this.lat = parseFloat(item.lng);
            this.lng = parseFloat(item.lat);
            this.note = item.link;
            this.title = item.name;

            this.$nextTick(function () {
                _this.initBmap();
            });
        },
        initBmap: function initBmap() {
            var self = this;

            //创建和初始化地图函数：
            function initMap() {
                createMap(); //创建地图
                setMapEvent(); //设置地图事件
                addMapControl(); //向地图添加控件
                addMarker(); //向地图中添加marker
            }

            //创建地图函数：
            function createMap() {
                var map = new BMap.Map("dituContent"); //在百度地图容器中创建一个地图
                var point = new BMap.Point(self.lat, self.lng); //定义一个中心点坐标
                map.centerAndZoom(point, 18); //设定地图的中心点和坐标并将地图显示在地图容器中
                window.map = map; //将map变量存储在全局
            }

            //地图事件设置函数：
            function setMapEvent() {
                map.enableDragging(); //启用地图拖拽事件，默认启用(可不写)
                map.enableScrollWheelZoom(); //启用地图滚轮放大缩小
                map.enableDoubleClickZoom(); //启用鼠标双击放大，默认启用(可不写)
                map.enableKeyboard(); //启用键盘上下左右键移动地图
            }

            //地图控件添加函数：
            function addMapControl() {
                //向地图中添加缩放控件
                var ctrl_nav = new BMap.NavigationControl({ anchor: BMAP_ANCHOR_TOP_LEFT, type: BMAP_NAVIGATION_CONTROL_LARGE });
                map.addControl(ctrl_nav);
                //向地图中添加缩略图控件
                var ctrl_ove = new BMap.OverviewMapControl({ anchor: BMAP_ANCHOR_BOTTOM_RIGHT, isOpen: 1 });
                map.addControl(ctrl_ove);
                //向地图中添加比例尺控件
                var ctrl_sca = new BMap.ScaleControl({ anchor: BMAP_ANCHOR_BOTTOM_LEFT });
                map.addControl(ctrl_sca);
            }

            //标注点数组
            var markerArr = [{ title: "我的标记", content: self.note, point: self.lat + '|' + self.lng, isOpen: 0, icon: { w: 21, h: 21, l: 0, t: 0, x: 6, lb: 5 } }, { title: self.title, content: self.note, point: self.lat + '|' + self.lng, isOpen: 0, icon: { w: 21, h: 21, l: 0, t: 0, x: 6, lb: 5 } }];
            //创建marker
            function addMarker() {
                for (var i = 0; i < markerArr.length; i++) {
                    var json = markerArr[i];
                    var p0 = json.point.split("|")[0];
                    var p1 = json.point.split("|")[1];
                    var point = new BMap.Point(p0, p1);
                    var iconImg = createIcon(json.icon);
                    var marker = new BMap.Marker(point, { icon: iconImg });
                    var iw = createInfoWindow(i);
                    var label = new BMap.Label(json.title, { "offset": new BMap.Size(json.icon.lb - json.icon.x + 10, -20) });
                    marker.setLabel(label);
                    map.addOverlay(marker);
                    label.setStyle({
                        borderColor: "#808080",
                        color: "#333",
                        cursor: "pointer"
                    });

                    (function () {
                        var index = i;
                        var _iw = createInfoWindow(i);
                        var _marker = marker;
                        _marker.addEventListener("click", function () {
                            this.openInfoWindow(_iw);
                        });
                        _iw.addEventListener("open", function () {
                            _marker.getLabel().hide();
                        });
                        _iw.addEventListener("close", function () {
                            _marker.getLabel().show();
                        });
                        label.addEventListener("click", function () {
                            _marker.openInfoWindow(_iw);
                        });
                        if (!!json.isOpen) {
                            label.hide();
                            _marker.openInfoWindow(_iw);
                        }
                    })();
                }
            }
            //创建InfoWindow
            function createInfoWindow(i) {
                var json = markerArr[i];
                var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>" + json.content + "</div>");
                return iw;
            }
            //创建一个Icon
            function createIcon(json) {
                var icon = new BMap.Icon("https://api.map.baidu.com/lbsapi/creatmap/images/us_mk_icon.png", new BMap.Size(json.w, json.h), { imageOffset: new BMap.Size(-json.l, -json.t), infoWindowOffset: new BMap.Size(json.lb + 5, 1), offset: new BMap.Size(json.x, json.h) });
                return icon;
            }

            initMap(); //创建和初始化地图 
        },
        parseStr: function parseStr(str) {
            return JSON.parse(str)[this.locale];
        }
    }
});

/***/ }),

/***/ 679:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "row" }, [
    _c("div", { staticClass: "col-md-12 partner-filter" }, [
      _c("div", { staticClass: "container" }, [
        _c("div", { staticClass: "row" }, [
          _c(
            "div",
            {
              staticClass: "col-md-5 mx-auto",
              staticStyle: { "line-height": "60px", color: "#EEE" }
            },
            [
              _vm._v(
                "\n                    " +
                  _vm._s(_vm.partner_finder) +
                  "\n                "
              )
            ]
          ),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-8 mx-auto" }, [
            _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "col-md-4 mx-auto" }, [
                _c("div", { staticClass: "select-wrapper" }, [
                  _c(
                    "select",
                    {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.partnerType,
                          expression: "partnerType"
                        }
                      ],
                      attrs: { name: "" },
                      on: {
                        change: function($event) {
                          var $$selectedVal = Array.prototype.filter
                            .call($event.target.options, function(o) {
                              return o.selected
                            })
                            .map(function(o) {
                              var val = "_value" in o ? o._value : o.value
                              return val
                            })
                          _vm.partnerType = $event.target.multiple
                            ? $$selectedVal
                            : $$selectedVal[0]
                        }
                      }
                    },
                    [
                      _c("option", { attrs: { value: "" } }, [
                        _vm._v(_vm._s(_vm.partner_finder_choose))
                      ]),
                      _vm._v(" "),
                      _vm._l(_vm.typeList, function(item, index) {
                        return _c(
                          "option",
                          {
                            key: index,
                            domProps: { value: item.categoryGuid }
                          },
                          [_vm._v(_vm._s(_vm.parseStr(item.categoryTitle)))]
                        )
                      })
                    ],
                    2
                  )
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "col-md-4 mx-auto" }, [
                _c("div", { staticClass: "select-wrapper" }, [
                  _c(
                    "select",
                    {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.partnerLocation,
                          expression: "partnerLocation"
                        }
                      ],
                      attrs: { name: "" },
                      on: {
                        change: function($event) {
                          var $$selectedVal = Array.prototype.filter
                            .call($event.target.options, function(o) {
                              return o.selected
                            })
                            .map(function(o) {
                              var val = "_value" in o ? o._value : o.value
                              return val
                            })
                          _vm.partnerLocation = $event.target.multiple
                            ? $$selectedVal
                            : $$selectedVal[0]
                        }
                      }
                    },
                    [
                      _c("option", { attrs: { value: "" } }, [
                        _vm._v(_vm._s(_vm.partner_finder_country))
                      ]),
                      _vm._v(" "),
                      _vm._l(_vm.locationList, function(item, index) {
                        return _c(
                          "option",
                          {
                            key: index,
                            domProps: { value: item.categoryGuid }
                          },
                          [_vm._v(_vm._s(_vm.parseStr(item.categoryTitle)))]
                        )
                      })
                    ],
                    2
                  )
                ])
              ])
            ])
          ])
        ])
      ])
    ]),
    _vm._v(" "),
    _c(
      "div",
      {
        staticClass: "col-md-3",
        staticStyle: { height: "600px", padding: "0", overflow: "auto" }
      },
      [
        _c(
          "ul",
          { staticClass: "partner-list" },
          _vm._l(_vm.feature, function(item, index) {
            return _c(
              "li",
              {
                key: index,
                staticClass: "map-btn",
                attrs: { id: item.id },
                on: {
                  click: function($event) {
                    _vm.switchMap(item)
                  }
                }
              },
              [
                _c("h4", [_vm._v(_vm._s(item.name))]),
                _vm._v(" "),
                _c("h5", [_vm._v(_vm._s(item.addressString))]),
                _vm._v(" "),
                _c("a", { attrs: { href: item.link } }, [
                  _vm._v(_vm._s(item.link))
                ]),
                _vm._v(" "),
                _vm._m(0, true)
              ]
            )
          })
        )
      ]
    ),
    _vm._v(" "),
    _c("div", {
      staticClass: "col-md-9",
      staticStyle: { height: "600px" },
      attrs: { id: "dituContent" }
    })
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("button", { staticClass: "map-button" }, [
      _c("span", { staticClass: "glyphicon glyphicon-map-marker" })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-f0dc1484", module.exports)
  }
}

/***/ })

/******/ });