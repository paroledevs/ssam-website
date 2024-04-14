(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_lazycomponents_ShowNotifications_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/lazycomponents/ShowNotifications.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/lazycomponents/ShowNotifications.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
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
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: ['errors', 'notification'],
  data: function data() {
    return {
      alerts: []
    };
  },
  methods: {
    showAlerts: function showAlerts() {
      var alert;
      this.show = true;
      setTimeout(function () {
        $('#alerts .alert').each(function (i) {
          setTimeout(function () {
            $('#alerts .alert#alert' + i).addClass('showed');
          }, (i + 1) * 100);
          setTimeout(function () {
            $('#alerts .alert#alert' + i).removeClass('showed');
          }, (i + 1) * 100 + 6000);
        });
      }, 1000);
    },
    closeAlert: function closeAlert(alert) {
      $('#alerts .alert#alert' + alert).removeClass('showed');
    },
    checkProps: function checkProps() {
      var _this = this;

      if (!_.isEmpty(this.errors)) {
        _.each(this.errors, function (error) {
          _this.alerts.push({
            type: 'error',
            message: error
          });
        });
      }

      if (!_.isNull(this.notification) && !_.isUndefined(this.notification)) {
        this.alerts.push({
          type: 'info',
          message: this.notification
        });
      }
    }
  },
  mounted: function mounted() {
    var _this2 = this;

    this.checkProps();
    this.showAlerts();
    this.listenGlobalEvent('showAlerts', function (alerts) {
      _this2.alerts = alerts;

      _this2.showAlerts();
    });
  }
});

/***/ }),

/***/ "./resources/js/lazycomponents/ShowNotifications.vue":
/*!***********************************************************!*\
  !*** ./resources/js/lazycomponents/ShowNotifications.vue ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _ShowNotifications_vue_vue_type_template_id_0c8dad04___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ShowNotifications.vue?vue&type=template&id=0c8dad04& */ "./resources/js/lazycomponents/ShowNotifications.vue?vue&type=template&id=0c8dad04&");
/* harmony import */ var _ShowNotifications_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ShowNotifications.vue?vue&type=script&lang=js& */ "./resources/js/lazycomponents/ShowNotifications.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _ShowNotifications_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _ShowNotifications_vue_vue_type_template_id_0c8dad04___WEBPACK_IMPORTED_MODULE_0__.render,
  _ShowNotifications_vue_vue_type_template_id_0c8dad04___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/lazycomponents/ShowNotifications.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/lazycomponents/ShowNotifications.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/js/lazycomponents/ShowNotifications.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ShowNotifications_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ShowNotifications.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/lazycomponents/ShowNotifications.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ShowNotifications_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/lazycomponents/ShowNotifications.vue?vue&type=template&id=0c8dad04&":
/*!******************************************************************************************!*\
  !*** ./resources/js/lazycomponents/ShowNotifications.vue?vue&type=template&id=0c8dad04& ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ShowNotifications_vue_vue_type_template_id_0c8dad04___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ShowNotifications_vue_vue_type_template_id_0c8dad04___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ShowNotifications_vue_vue_type_template_id_0c8dad04___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ShowNotifications.vue?vue&type=template&id=0c8dad04& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/lazycomponents/ShowNotifications.vue?vue&type=template&id=0c8dad04&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/lazycomponents/ShowNotifications.vue?vue&type=template&id=0c8dad04&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/lazycomponents/ShowNotifications.vue?vue&type=template&id=0c8dad04& ***!
  \*********************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { attrs: { id: "alerts" } },
    _vm._l(_vm.alerts, function(alert, index) {
      return _c(
        "div",
        {
          key: index,
          staticClass: "alert",
          class: alert.type,
          attrs: { id: "alert" + index },
          on: {
            click: function($event) {
              return _vm.closeAlert(index)
            }
          }
        },
        [
          _c("span", [_vm._v(_vm._s(alert.message))]),
          _vm._v(" "),
          alert.type == "error"
            ? _c("i", { staticClass: "fa fa-exclamation-triangle" })
            : _vm._e(),
          _vm._v(" "),
          alert.type == "info"
            ? _c("i", { staticClass: "fa fa-check" })
            : _vm._e()
        ]
      )
    }),
    0
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vcmVzb3VyY2VzL2pzL2xhenljb21wb25lbnRzL1Nob3dOb3RpZmljYXRpb25zLnZ1ZSIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvbGF6eWNvbXBvbmVudHMvU2hvd05vdGlmaWNhdGlvbnMudnVlIiwid2VicGFjazovLy8uL3Jlc291cmNlcy9qcy9sYXp5Y29tcG9uZW50cy9TaG93Tm90aWZpY2F0aW9ucy52dWU/YTcyMCIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvbGF6eWNvbXBvbmVudHMvU2hvd05vdGlmaWNhdGlvbnMudnVlPzA2NmYiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUFZQTtBQUNBLG1DQURBO0FBRUEsTUFGQSxrQkFFQTtBQUVBO0FBQ0E7QUFEQTtBQUlBLEdBUkE7QUFVQTtBQUVBLGNBRkEsd0JBRUE7QUFFQTtBQUNBO0FBRUE7QUFHQTtBQUdBO0FBRUE7QUFFQSxXQUpBLEVBSUEsYUFKQTtBQU9BO0FBRUE7QUFFQSxXQUpBLEVBSUEsb0JBSkE7QUFRQSxTQWxCQTtBQXVCQSxPQTFCQSxFQTBCQSxJQTFCQTtBQTJCQSxLQWxDQTtBQW9DQSxjQXBDQSxzQkFvQ0EsS0FwQ0EsRUFvQ0E7QUFFQTtBQUVBLEtBeENBO0FBMENBLGNBMUNBLHdCQTBDQTtBQUFBOztBQUNBO0FBQ0E7QUFDQTtBQUNBLHlCQURBO0FBRUE7QUFGQTtBQUlBLFNBTEE7QUFNQTs7QUFFQTtBQUNBO0FBQ0Esc0JBREE7QUFFQTtBQUZBO0FBSUE7QUFFQTtBQTNEQSxHQVZBO0FBd0VBLFNBeEVBLHFCQXdFQTtBQUFBOztBQUVBO0FBRUE7QUFFQTtBQUNBOztBQUNBO0FBQ0EsS0FIQTtBQUtBO0FBbkZBLEc7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQ1pnRztBQUMzQjtBQUNMOzs7QUFHaEU7QUFDQSxDQUE2RjtBQUM3RixnQkFBZ0Isb0dBQVU7QUFDMUIsRUFBRSxvRkFBTTtBQUNSLEVBQUUseUZBQU07QUFDUixFQUFFLGtHQUFlO0FBQ2pCO0FBQ0E7QUFDQTtBQUNBOztBQUVBOztBQUVBO0FBQ0EsSUFBSSxLQUFVLEVBQUUsWUFpQmY7QUFDRDtBQUNBLGlFQUFlLGlCOzs7Ozs7Ozs7Ozs7Ozs7O0FDdEM0TSxDQUFDLGlFQUFlLG1OQUFHLEVBQUMsQzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FDQS9PO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLEtBQUssU0FBUyxlQUFlLEVBQUU7QUFDL0I7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxrQkFBa0Isc0JBQXNCO0FBQ3hDO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxTQUFTO0FBQ1Q7QUFDQTtBQUNBO0FBQ0E7QUFDQSx1QkFBdUIsNENBQTRDO0FBQ25FO0FBQ0E7QUFDQTtBQUNBLHVCQUF1Qiw2QkFBNkI7QUFDcEQ7QUFDQTtBQUNBO0FBQ0EsS0FBSztBQUNMO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJmaWxlIjoianMvcmVzb3VyY2VzX2pzX2xhenljb21wb25lbnRzX1Nob3dOb3RpZmljYXRpb25zX3Z1ZS5qcyIsInNvdXJjZXNDb250ZW50IjpbIjx0ZW1wbGF0ZT5cbiAgICA8ZGl2IGlkPVwiYWxlcnRzXCI+XG4gICAgXHQ8ZGl2IGNsYXNzPVwiYWxlcnRcIiA6Y2xhc3M9XCJhbGVydC50eXBlXCIgOmlkPVwiYGFsZXJ0JHtpbmRleH1gXCIgdi1mb3I9XCIoYWxlcnQsaW5kZXgpIGluIGFsZXJ0c1wiIDprZXk9XCJpbmRleFwiIEBjbGljaz1cImNsb3NlQWxlcnQoaW5kZXgpXCI+XG5cdCAgICBcdDxzcGFuPnt7IGFsZXJ0Lm1lc3NhZ2UgfX08L3NwYW4+XG5cdCAgICBcdDxpIGNsYXNzPVwiZmEgZmEtZXhjbGFtYXRpb24tdHJpYW5nbGVcIiB2LWlmPVwiYWxlcnQudHlwZSA9PSAnZXJyb3InXCI+PC9pPlxuXHQgICAgXHQ8aSBjbGFzcz1cImZhIGZhLWNoZWNrXCIgdi1pZj1cImFsZXJ0LnR5cGUgPT0gJ2luZm8nXCI+PC9pPlxuICAgIFx0PC9kaXY+XG4gICAgPC9kaXY+XG48L3RlbXBsYXRlPlxuXG48c2NyaXB0PlxuXG4gICAgZXhwb3J0IGRlZmF1bHQge1xuICAgICAgICBwcm9wczogWydlcnJvcnMnLCAnbm90aWZpY2F0aW9uJ10sXG5cdCAgICBkYXRhKCl7XG5cblx0XHQgICAgcmV0dXJue1xuXHRcdFx0ICAgIGFsZXJ0czogW10sXG5cdFx0ICAgIH1cblxuXHQgICAgfSxcblxuXHQgICAgbWV0aG9kczp7XG5cblx0XHRcdHNob3dBbGVydHMoKXtcblxuXHRcdFx0XHR2YXIgYWxlcnQ7XG5cdFx0XHRcdHRoaXMuc2hvdyA9IHRydWU7XG5cblx0XHRcdFx0c2V0VGltZW91dCgoKSA9PiB7XG5cblxuXHRcdFx0XHRcdCQoJyNhbGVydHMgLmFsZXJ0JykuZWFjaCgoaSk9PntcblxuXG5cdFx0XHRcdFx0XHRzZXRUaW1lb3V0KCgpPT57XG5cblx0XHRcdFx0XHRcdFx0JCgnI2FsZXJ0cyAuYWxlcnQjYWxlcnQnICsgaSkuYWRkQ2xhc3MoJ3Nob3dlZCcpO1xuXG5cdFx0XHRcdFx0XHR9LChpKzEpKjEwMCk7XG5cblxuXHRcdFx0XHRcdFx0c2V0VGltZW91dCgoKT0+e1xuXG5cdFx0XHRcdFx0XHRcdCQoJyNhbGVydHMgLmFsZXJ0I2FsZXJ0JyArIGkpLnJlbW92ZUNsYXNzKCdzaG93ZWQnKTtcblxuXHRcdFx0XHRcdFx0fSwoKGkrMSkqMTAwKSArIDYwMDApO1xuXG5cblxuXHRcdFx0XHRcdH0pO1xuXG5cblxuXG4gICAgICAgICAgICBcdH0sIDEwMDApO1xuXHRcdFx0fSxcblxuXHRcdFx0Y2xvc2VBbGVydChhbGVydCl7XG5cblx0XHRcdFx0JCgnI2FsZXJ0cyAuYWxlcnQjYWxlcnQnICsgYWxlcnQpLnJlbW92ZUNsYXNzKCdzaG93ZWQnKTtcblxuXHRcdFx0fSxcblxuICAgICAgICAgICAgY2hlY2tQcm9wcygpIHtcbiAgICAgICAgICAgICAgICBpZiAoIV8uaXNFbXB0eSh0aGlzLmVycm9ycykpIHtcbiAgICAgICAgICAgICAgICAgICAgXy5lYWNoKHRoaXMuZXJyb3JzLCAoZXJyb3IpID0+IHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHRoaXMuYWxlcnRzLnB1c2goe1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHR5cGU6ICdlcnJvcicsXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgbWVzc2FnZTogZXJyb3IsXG4gICAgICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgaWYgKCFfLmlzTnVsbCh0aGlzLm5vdGlmaWNhdGlvbikgJiYgIV8uaXNVbmRlZmluZWQodGhpcy5ub3RpZmljYXRpb24pKSB7XG4gICAgICAgICAgICAgICAgICAgIHRoaXMuYWxlcnRzLnB1c2goe1xuICAgICAgICAgICAgICAgICAgICAgICAgdHlwZTogJ2luZm8nLFxuICAgICAgICAgICAgICAgICAgICAgICAgbWVzc2FnZTogdGhpcy5ub3RpZmljYXRpb24sXG4gICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgfSxcbiAgICAgICAgfSxcblxuICAgICAgICBtb3VudGVkICgpIHtcblxuICAgICAgICAgICAgdGhpcy5jaGVja1Byb3BzKCk7XG5cbiAgICAgICAgICAgIHRoaXMuc2hvd0FsZXJ0cygpO1xuXG4gICAgICAgICAgICB0aGlzLmxpc3Rlbkdsb2JhbEV2ZW50KCdzaG93QWxlcnRzJywgKGFsZXJ0cykgPT4ge1xuXHRcdFx0XHR0aGlzLmFsZXJ0cyA9IGFsZXJ0cztcblx0XHRcdFx0dGhpcy5zaG93QWxlcnRzKCk7XG5cdFx0XHR9KTtcblxuICAgICAgICB9LFxuXG5cbiAgICB9XG5cbjwvc2NyaXB0PiIsImltcG9ydCB7IHJlbmRlciwgc3RhdGljUmVuZGVyRm5zIH0gZnJvbSBcIi4vU2hvd05vdGlmaWNhdGlvbnMudnVlP3Z1ZSZ0eXBlPXRlbXBsYXRlJmlkPTBjOGRhZDA0JlwiXG5pbXBvcnQgc2NyaXB0IGZyb20gXCIuL1Nob3dOb3RpZmljYXRpb25zLnZ1ZT92dWUmdHlwZT1zY3JpcHQmbGFuZz1qcyZcIlxuZXhwb3J0ICogZnJvbSBcIi4vU2hvd05vdGlmaWNhdGlvbnMudnVlP3Z1ZSZ0eXBlPXNjcmlwdCZsYW5nPWpzJlwiXG5cblxuLyogbm9ybWFsaXplIGNvbXBvbmVudCAqL1xuaW1wb3J0IG5vcm1hbGl6ZXIgZnJvbSBcIiEuLi8uLi8uLi9ub2RlX21vZHVsZXMvdnVlLWxvYWRlci9saWIvcnVudGltZS9jb21wb25lbnROb3JtYWxpemVyLmpzXCJcbnZhciBjb21wb25lbnQgPSBub3JtYWxpemVyKFxuICBzY3JpcHQsXG4gIHJlbmRlcixcbiAgc3RhdGljUmVuZGVyRm5zLFxuICBmYWxzZSxcbiAgbnVsbCxcbiAgbnVsbCxcbiAgbnVsbFxuICBcbilcblxuLyogaG90IHJlbG9hZCAqL1xuaWYgKG1vZHVsZS5ob3QpIHtcbiAgdmFyIGFwaSA9IHJlcXVpcmUoXCIvVXNlcnMvcm9nZXIvRGV2L2FzdGVyb2lkZS9ub2RlX21vZHVsZXMvdnVlLWhvdC1yZWxvYWQtYXBpL2Rpc3QvaW5kZXguanNcIilcbiAgYXBpLmluc3RhbGwocmVxdWlyZSgndnVlJykpXG4gIGlmIChhcGkuY29tcGF0aWJsZSkge1xuICAgIG1vZHVsZS5ob3QuYWNjZXB0KClcbiAgICBpZiAoIWFwaS5pc1JlY29yZGVkKCcwYzhkYWQwNCcpKSB7XG4gICAgICBhcGkuY3JlYXRlUmVjb3JkKCcwYzhkYWQwNCcsIGNvbXBvbmVudC5vcHRpb25zKVxuICAgIH0gZWxzZSB7XG4gICAgICBhcGkucmVsb2FkKCcwYzhkYWQwNCcsIGNvbXBvbmVudC5vcHRpb25zKVxuICAgIH1cbiAgICBtb2R1bGUuaG90LmFjY2VwdChcIi4vU2hvd05vdGlmaWNhdGlvbnMudnVlP3Z1ZSZ0eXBlPXRlbXBsYXRlJmlkPTBjOGRhZDA0JlwiLCBmdW5jdGlvbiAoKSB7XG4gICAgICBhcGkucmVyZW5kZXIoJzBjOGRhZDA0Jywge1xuICAgICAgICByZW5kZXI6IHJlbmRlcixcbiAgICAgICAgc3RhdGljUmVuZGVyRm5zOiBzdGF0aWNSZW5kZXJGbnNcbiAgICAgIH0pXG4gICAgfSlcbiAgfVxufVxuY29tcG9uZW50Lm9wdGlvbnMuX19maWxlID0gXCJyZXNvdXJjZXMvanMvbGF6eWNvbXBvbmVudHMvU2hvd05vdGlmaWNhdGlvbnMudnVlXCJcbmV4cG9ydCBkZWZhdWx0IGNvbXBvbmVudC5leHBvcnRzIiwiaW1wb3J0IG1vZCBmcm9tIFwiLSEuLi8uLi8uLi9ub2RlX21vZHVsZXMvYmFiZWwtbG9hZGVyL2xpYi9pbmRleC5qcz8/Y2xvbmVkUnVsZVNldC01WzBdLnJ1bGVzWzBdLnVzZVswXSEuLi8uLi8uLi9ub2RlX21vZHVsZXMvdnVlLWxvYWRlci9saWIvaW5kZXguanM/P3Z1ZS1sb2FkZXItb3B0aW9ucyEuL1Nob3dOb3RpZmljYXRpb25zLnZ1ZT92dWUmdHlwZT1zY3JpcHQmbGFuZz1qcyZcIjsgZXhwb3J0IGRlZmF1bHQgbW9kOyBleHBvcnQgKiBmcm9tIFwiLSEuLi8uLi8uLi9ub2RlX21vZHVsZXMvYmFiZWwtbG9hZGVyL2xpYi9pbmRleC5qcz8/Y2xvbmVkUnVsZVNldC01WzBdLnJ1bGVzWzBdLnVzZVswXSEuLi8uLi8uLi9ub2RlX21vZHVsZXMvdnVlLWxvYWRlci9saWIvaW5kZXguanM/P3Z1ZS1sb2FkZXItb3B0aW9ucyEuL1Nob3dOb3RpZmljYXRpb25zLnZ1ZT92dWUmdHlwZT1zY3JpcHQmbGFuZz1qcyZcIiIsInZhciByZW5kZXIgPSBmdW5jdGlvbigpIHtcbiAgdmFyIF92bSA9IHRoaXNcbiAgdmFyIF9oID0gX3ZtLiRjcmVhdGVFbGVtZW50XG4gIHZhciBfYyA9IF92bS5fc2VsZi5fYyB8fCBfaFxuICByZXR1cm4gX2MoXG4gICAgXCJkaXZcIixcbiAgICB7IGF0dHJzOiB7IGlkOiBcImFsZXJ0c1wiIH0gfSxcbiAgICBfdm0uX2woX3ZtLmFsZXJ0cywgZnVuY3Rpb24oYWxlcnQsIGluZGV4KSB7XG4gICAgICByZXR1cm4gX2MoXG4gICAgICAgIFwiZGl2XCIsXG4gICAgICAgIHtcbiAgICAgICAgICBrZXk6IGluZGV4LFxuICAgICAgICAgIHN0YXRpY0NsYXNzOiBcImFsZXJ0XCIsXG4gICAgICAgICAgY2xhc3M6IGFsZXJ0LnR5cGUsXG4gICAgICAgICAgYXR0cnM6IHsgaWQ6IFwiYWxlcnRcIiArIGluZGV4IH0sXG4gICAgICAgICAgb246IHtcbiAgICAgICAgICAgIGNsaWNrOiBmdW5jdGlvbigkZXZlbnQpIHtcbiAgICAgICAgICAgICAgcmV0dXJuIF92bS5jbG9zZUFsZXJ0KGluZGV4KVxuICAgICAgICAgICAgfVxuICAgICAgICAgIH1cbiAgICAgICAgfSxcbiAgICAgICAgW1xuICAgICAgICAgIF9jKFwic3BhblwiLCBbX3ZtLl92KF92bS5fcyhhbGVydC5tZXNzYWdlKSldKSxcbiAgICAgICAgICBfdm0uX3YoXCIgXCIpLFxuICAgICAgICAgIGFsZXJ0LnR5cGUgPT0gXCJlcnJvclwiXG4gICAgICAgICAgICA/IF9jKFwiaVwiLCB7IHN0YXRpY0NsYXNzOiBcImZhIGZhLWV4Y2xhbWF0aW9uLXRyaWFuZ2xlXCIgfSlcbiAgICAgICAgICAgIDogX3ZtLl9lKCksXG4gICAgICAgICAgX3ZtLl92KFwiIFwiKSxcbiAgICAgICAgICBhbGVydC50eXBlID09IFwiaW5mb1wiXG4gICAgICAgICAgICA/IF9jKFwiaVwiLCB7IHN0YXRpY0NsYXNzOiBcImZhIGZhLWNoZWNrXCIgfSlcbiAgICAgICAgICAgIDogX3ZtLl9lKClcbiAgICAgICAgXVxuICAgICAgKVxuICAgIH0pLFxuICAgIDBcbiAgKVxufVxudmFyIHN0YXRpY1JlbmRlckZucyA9IFtdXG5yZW5kZXIuX3dpdGhTdHJpcHBlZCA9IHRydWVcblxuZXhwb3J0IHsgcmVuZGVyLCBzdGF0aWNSZW5kZXJGbnMgfSJdLCJzb3VyY2VSb290IjoiIn0=