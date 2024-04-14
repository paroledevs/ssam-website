(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_lazycomponents_ytVideo_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/lazycomponents/ytVideo.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/lazycomponents/ytVideo.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************************************************/
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
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: ['url', 'height'],
  filters: {
    youtube_parser: function youtube_parser(url) {
      var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
      var match = url.match(regExp);
      return match && match[7].length == 11 ? 'https://www.youtube.com/embed/' + match[7] : false;
    }
  }
});

/***/ }),

/***/ "./resources/js/lazycomponents/ytVideo.vue":
/*!*************************************************!*\
  !*** ./resources/js/lazycomponents/ytVideo.vue ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _ytVideo_vue_vue_type_template_id_fe9c3dce___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ytVideo.vue?vue&type=template&id=fe9c3dce& */ "./resources/js/lazycomponents/ytVideo.vue?vue&type=template&id=fe9c3dce&");
/* harmony import */ var _ytVideo_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ytVideo.vue?vue&type=script&lang=js& */ "./resources/js/lazycomponents/ytVideo.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _ytVideo_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _ytVideo_vue_vue_type_template_id_fe9c3dce___WEBPACK_IMPORTED_MODULE_0__.render,
  _ytVideo_vue_vue_type_template_id_fe9c3dce___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/lazycomponents/ytVideo.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/lazycomponents/ytVideo.vue?vue&type=script&lang=js&":
/*!**************************************************************************!*\
  !*** ./resources/js/lazycomponents/ytVideo.vue?vue&type=script&lang=js& ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ytVideo_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ytVideo.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/lazycomponents/ytVideo.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ytVideo_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/lazycomponents/ytVideo.vue?vue&type=template&id=fe9c3dce&":
/*!********************************************************************************!*\
  !*** ./resources/js/lazycomponents/ytVideo.vue?vue&type=template&id=fe9c3dce& ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ytVideo_vue_vue_type_template_id_fe9c3dce___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ytVideo_vue_vue_type_template_id_fe9c3dce___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ytVideo_vue_vue_type_template_id_fe9c3dce___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ytVideo.vue?vue&type=template&id=fe9c3dce& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/lazycomponents/ytVideo.vue?vue&type=template&id=fe9c3dce&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/lazycomponents/ytVideo.vue?vue&type=template&id=fe9c3dce&":
/*!***********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/lazycomponents/ytVideo.vue?vue&type=template&id=fe9c3dce& ***!
  \***********************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "yt_video" }, [
    _c("img", {
      attrs: {
        src:
          "https://img.youtube.com/vi/" +
          _vm.youtube_parser(_vm.url) +
          "/maxresdefault.jpg"
      }
    }),
    _vm._v(" "),
    _c("iframe", {
      attrs: {
        width: "100%",
        height: _vm.height,
        src: _vm._f("youtube_parser")(_vm.url),
        frameborder: "0",
        allow: "accelerometer;encrypted-media;gyroscope;"
      }
    })
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vcmVzb3VyY2VzL2pzL2xhenljb21wb25lbnRzL3l0VmlkZW8udnVlIiwid2VicGFjazovLy8uL3Jlc291cmNlcy9qcy9sYXp5Y29tcG9uZW50cy95dFZpZGVvLnZ1ZSIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvbGF6eWNvbXBvbmVudHMveXRWaWRlby52dWU/Mzg3ZiIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvbGF6eWNvbXBvbmVudHMveXRWaWRlby52dWU/ZjAyYyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FBYUE7QUFDQSwwQkFEQTtBQUdBO0FBRUEsa0JBRkEsMEJBRUEsR0FGQSxFQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFOQTtBQUhBLEc7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQ2JzRjtBQUMzQjtBQUNMOzs7QUFHdEQ7QUFDQSxDQUE2RjtBQUM3RixnQkFBZ0Isb0dBQVU7QUFDMUIsRUFBRSwwRUFBTTtBQUNSLEVBQUUsK0VBQU07QUFDUixFQUFFLHdGQUFlO0FBQ2pCO0FBQ0E7QUFDQTtBQUNBOztBQUVBOztBQUVBO0FBQ0EsSUFBSSxLQUFVLEVBQUUsWUFpQmY7QUFDRDtBQUNBLGlFQUFlLGlCOzs7Ozs7Ozs7Ozs7Ozs7O0FDdENrTSxDQUFDLGlFQUFlLHlNQUFHLEVBQUMsQzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FDQXJPO0FBQ0E7QUFDQTtBQUNBO0FBQ0Esb0JBQW9CLDBCQUEwQjtBQUM5QztBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLEtBQUs7QUFDTDtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLDhCQUE4QixnQkFBZ0IsVUFBVTtBQUN4RDtBQUNBLEtBQUs7QUFDTDtBQUNBO0FBQ0E7QUFDQSIsImZpbGUiOiJqcy9yZXNvdXJjZXNfanNfbGF6eWNvbXBvbmVudHNfeXRWaWRlb192dWUuanMiLCJzb3VyY2VzQ29udGVudCI6WyI8dGVtcGxhdGU+XG5cblx0PGRpdiBjbGFzcz1cInl0X3ZpZGVvXCI+XG5cdFxuXHRcdDxpbWcgOnNyYz0nXCJodHRwczovL2ltZy55b3V0dWJlLmNvbS92aS9cIiArIHlvdXR1YmVfcGFyc2VyKHVybCkgKyBcIi9tYXhyZXNkZWZhdWx0LmpwZ1wiJz5cblxuXHRcdDxpZnJhbWUgd2lkdGg9XCIxMDAlXCIgOmhlaWdodD1cImhlaWdodFwiIDpzcmM9XCJ1cmwgfCB5b3V0dWJlX3BhcnNlclwiIGZyYW1lYm9yZGVyPVwiMFwiIGFsbG93PVwiYWNjZWxlcm9tZXRlcjtlbmNyeXB0ZWQtbWVkaWE7Z3lyb3Njb3BlO1wiPjwvaWZyYW1lPlxuXHRcblx0PC9kaXY+XG5cbjwvdGVtcGxhdGU+XG5cbjxzY3JpcHQ+XG5leHBvcnQgZGVmYXVsdCB7XG5cdHByb3BzOiBbJ3VybCcsJ2hlaWdodCddLFxuXHRcblx0ZmlsdGVyczp7XG5cdCAgICBcblx0ICAgIHlvdXR1YmVfcGFyc2VyKHVybCl7XG5cdFx0ICAgIHZhciByZWdFeHAgPSAvXi4qKCh5b3V0dS5iZVxcLyl8KHZcXC8pfChcXC91XFwvXFx3XFwvKXwoZW1iZWRcXC8pfCh3YXRjaFxcPykpXFw/P3Y/PT8oW14jXFwmXFw/XSopLiovO1xuXHRcdCAgICB2YXIgbWF0Y2ggPSB1cmwubWF0Y2gocmVnRXhwKTtcblx0XHQgICAgcmV0dXJuIChtYXRjaCYmbWF0Y2hbN10ubGVuZ3RoPT0xMSk/ICdodHRwczovL3d3dy55b3V0dWJlLmNvbS9lbWJlZC8nICsgbWF0Y2hbN10gOiBmYWxzZTtcblx0XHR9LFxuXHRcdFxuICAgIH0sXG59XG48L3NjcmlwdD4iLCJpbXBvcnQgeyByZW5kZXIsIHN0YXRpY1JlbmRlckZucyB9IGZyb20gXCIuL3l0VmlkZW8udnVlP3Z1ZSZ0eXBlPXRlbXBsYXRlJmlkPWZlOWMzZGNlJlwiXG5pbXBvcnQgc2NyaXB0IGZyb20gXCIuL3l0VmlkZW8udnVlP3Z1ZSZ0eXBlPXNjcmlwdCZsYW5nPWpzJlwiXG5leHBvcnQgKiBmcm9tIFwiLi95dFZpZGVvLnZ1ZT92dWUmdHlwZT1zY3JpcHQmbGFuZz1qcyZcIlxuXG5cbi8qIG5vcm1hbGl6ZSBjb21wb25lbnQgKi9cbmltcG9ydCBub3JtYWxpemVyIGZyb20gXCIhLi4vLi4vLi4vbm9kZV9tb2R1bGVzL3Z1ZS1sb2FkZXIvbGliL3J1bnRpbWUvY29tcG9uZW50Tm9ybWFsaXplci5qc1wiXG52YXIgY29tcG9uZW50ID0gbm9ybWFsaXplcihcbiAgc2NyaXB0LFxuICByZW5kZXIsXG4gIHN0YXRpY1JlbmRlckZucyxcbiAgZmFsc2UsXG4gIG51bGwsXG4gIG51bGwsXG4gIG51bGxcbiAgXG4pXG5cbi8qIGhvdCByZWxvYWQgKi9cbmlmIChtb2R1bGUuaG90KSB7XG4gIHZhciBhcGkgPSByZXF1aXJlKFwiL1VzZXJzL3JvZ2VyL0Rldi9hc3Rlcm9pZGUvbm9kZV9tb2R1bGVzL3Z1ZS1ob3QtcmVsb2FkLWFwaS9kaXN0L2luZGV4LmpzXCIpXG4gIGFwaS5pbnN0YWxsKHJlcXVpcmUoJ3Z1ZScpKVxuICBpZiAoYXBpLmNvbXBhdGlibGUpIHtcbiAgICBtb2R1bGUuaG90LmFjY2VwdCgpXG4gICAgaWYgKCFhcGkuaXNSZWNvcmRlZCgnZmU5YzNkY2UnKSkge1xuICAgICAgYXBpLmNyZWF0ZVJlY29yZCgnZmU5YzNkY2UnLCBjb21wb25lbnQub3B0aW9ucylcbiAgICB9IGVsc2Uge1xuICAgICAgYXBpLnJlbG9hZCgnZmU5YzNkY2UnLCBjb21wb25lbnQub3B0aW9ucylcbiAgICB9XG4gICAgbW9kdWxlLmhvdC5hY2NlcHQoXCIuL3l0VmlkZW8udnVlP3Z1ZSZ0eXBlPXRlbXBsYXRlJmlkPWZlOWMzZGNlJlwiLCBmdW5jdGlvbiAoKSB7XG4gICAgICBhcGkucmVyZW5kZXIoJ2ZlOWMzZGNlJywge1xuICAgICAgICByZW5kZXI6IHJlbmRlcixcbiAgICAgICAgc3RhdGljUmVuZGVyRm5zOiBzdGF0aWNSZW5kZXJGbnNcbiAgICAgIH0pXG4gICAgfSlcbiAgfVxufVxuY29tcG9uZW50Lm9wdGlvbnMuX19maWxlID0gXCJyZXNvdXJjZXMvanMvbGF6eWNvbXBvbmVudHMveXRWaWRlby52dWVcIlxuZXhwb3J0IGRlZmF1bHQgY29tcG9uZW50LmV4cG9ydHMiLCJpbXBvcnQgbW9kIGZyb20gXCItIS4uLy4uLy4uL25vZGVfbW9kdWxlcy9iYWJlbC1sb2FkZXIvbGliL2luZGV4LmpzPz9jbG9uZWRSdWxlU2V0LTVbMF0ucnVsZXNbMF0udXNlWzBdIS4uLy4uLy4uL25vZGVfbW9kdWxlcy92dWUtbG9hZGVyL2xpYi9pbmRleC5qcz8/dnVlLWxvYWRlci1vcHRpb25zIS4veXRWaWRlby52dWU/dnVlJnR5cGU9c2NyaXB0Jmxhbmc9anMmXCI7IGV4cG9ydCBkZWZhdWx0IG1vZDsgZXhwb3J0ICogZnJvbSBcIi0hLi4vLi4vLi4vbm9kZV9tb2R1bGVzL2JhYmVsLWxvYWRlci9saWIvaW5kZXguanM/P2Nsb25lZFJ1bGVTZXQtNVswXS5ydWxlc1swXS51c2VbMF0hLi4vLi4vLi4vbm9kZV9tb2R1bGVzL3Z1ZS1sb2FkZXIvbGliL2luZGV4LmpzPz92dWUtbG9hZGVyLW9wdGlvbnMhLi95dFZpZGVvLnZ1ZT92dWUmdHlwZT1zY3JpcHQmbGFuZz1qcyZcIiIsInZhciByZW5kZXIgPSBmdW5jdGlvbigpIHtcbiAgdmFyIF92bSA9IHRoaXNcbiAgdmFyIF9oID0gX3ZtLiRjcmVhdGVFbGVtZW50XG4gIHZhciBfYyA9IF92bS5fc2VsZi5fYyB8fCBfaFxuICByZXR1cm4gX2MoXCJkaXZcIiwgeyBzdGF0aWNDbGFzczogXCJ5dF92aWRlb1wiIH0sIFtcbiAgICBfYyhcImltZ1wiLCB7XG4gICAgICBhdHRyczoge1xuICAgICAgICBzcmM6XG4gICAgICAgICAgXCJodHRwczovL2ltZy55b3V0dWJlLmNvbS92aS9cIiArXG4gICAgICAgICAgX3ZtLnlvdXR1YmVfcGFyc2VyKF92bS51cmwpICtcbiAgICAgICAgICBcIi9tYXhyZXNkZWZhdWx0LmpwZ1wiXG4gICAgICB9XG4gICAgfSksXG4gICAgX3ZtLl92KFwiIFwiKSxcbiAgICBfYyhcImlmcmFtZVwiLCB7XG4gICAgICBhdHRyczoge1xuICAgICAgICB3aWR0aDogXCIxMDAlXCIsXG4gICAgICAgIGhlaWdodDogX3ZtLmhlaWdodCxcbiAgICAgICAgc3JjOiBfdm0uX2YoXCJ5b3V0dWJlX3BhcnNlclwiKShfdm0udXJsKSxcbiAgICAgICAgZnJhbWVib3JkZXI6IFwiMFwiLFxuICAgICAgICBhbGxvdzogXCJhY2NlbGVyb21ldGVyO2VuY3J5cHRlZC1tZWRpYTtneXJvc2NvcGU7XCJcbiAgICAgIH1cbiAgICB9KVxuICBdKVxufVxudmFyIHN0YXRpY1JlbmRlckZucyA9IFtdXG5yZW5kZXIuX3dpdGhTdHJpcHBlZCA9IHRydWVcblxuZXhwb3J0IHsgcmVuZGVyLCBzdGF0aWNSZW5kZXJGbnMgfSJdLCJzb3VyY2VSb290IjoiIn0=