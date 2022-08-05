"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_pages_auth_ResetPassword_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pages/auth/ResetPassword.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pages/auth/ResetPassword.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vee_validate__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vee-validate */ "./node_modules/vee-validate/dist/vee-validate.esm.js");
/* harmony import */ var vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vee-validate/dist/rules */ "./node_modules/vee-validate/dist/rules.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) { symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); } keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

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
//
//


(0,vee_validate__WEBPACK_IMPORTED_MODULE_0__.extend)("required", _objectSpread(_objectSpread({}, vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__.required), {}, {
  message: "Ce champ est requis"
}));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "ResetPassword",
  props: {
    username: {
      type: String
    }
  },
  components: {
    ValidationProvider: vee_validate__WEBPACK_IMPORTED_MODULE_0__.ValidationProvider
  },
  data: function data() {
    return {
      username: this.username | null,
      serverError: "",
      successMessage: this.dataSuccessMessage || null,
      loading: false
    };
  },
  methods: {
    getValidationState: function getValidationState(_ref) {
      var dirty = _ref.dirty,
          validated = _ref.validated,
          _ref$valid = _ref.valid,
          valid = _ref$valid === void 0 ? null : _ref$valid;
      return dirty || validated ? valid : null;
    },
    validateBeforeSubmit: function validateBeforeSubmit() {
      var _this = this;

      this.$validator.validateAll().then(function (result) {
        if (result) {
          _this.login();
        }
      });
    },
    resetPassword: function resetPassword() {
      var _this2 = this;

      this.loading = true;
      this.successMessage = "";
      this.serverError = "";
      this.$store.dispatch("retrieveToken", {
        username: this.username,
        password: this.password
      }).then(function (response) {
        // console.log(response)
        _this2.password = "";
        _this2.successMessage = "";
        _this2.serverError = "";

        _this2.$router.push({
          name: "profile.index"
        });

        _this2.loading = false;
      })["catch"](function (error) {
        _this2.loading = false;

        _this2.$toast.error({
          title: 'Echec de connexion',
          message: error.response.data.message
        });

        _this2.serverError = error.response.data.message;
        _this2.password = "";
        _this2.successMessage = "";
      });
    }
  }
});

/***/ }),

/***/ "./resources/js/components/pages/auth/ResetPassword.vue":
/*!**************************************************************!*\
  !*** ./resources/js/components/pages/auth/ResetPassword.vue ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _ResetPassword_vue_vue_type_template_id_34a5bd8e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ResetPassword.vue?vue&type=template&id=34a5bd8e& */ "./resources/js/components/pages/auth/ResetPassword.vue?vue&type=template&id=34a5bd8e&");
/* harmony import */ var _ResetPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ResetPassword.vue?vue&type=script&lang=js& */ "./resources/js/components/pages/auth/ResetPassword.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ResetPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ResetPassword_vue_vue_type_template_id_34a5bd8e___WEBPACK_IMPORTED_MODULE_0__.render,
  _ResetPassword_vue_vue_type_template_id_34a5bd8e___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/pages/auth/ResetPassword.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/pages/auth/ResetPassword.vue?vue&type=script&lang=js&":
/*!***************************************************************************************!*\
  !*** ./resources/js/components/pages/auth/ResetPassword.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ResetPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ResetPassword.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pages/auth/ResetPassword.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ResetPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/pages/auth/ResetPassword.vue?vue&type=template&id=34a5bd8e&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/components/pages/auth/ResetPassword.vue?vue&type=template&id=34a5bd8e& ***!
  \*********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ResetPassword_vue_vue_type_template_id_34a5bd8e___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ResetPassword_vue_vue_type_template_id_34a5bd8e___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ResetPassword_vue_vue_type_template_id_34a5bd8e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ResetPassword.vue?vue&type=template&id=34a5bd8e& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pages/auth/ResetPassword.vue?vue&type=template&id=34a5bd8e&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pages/auth/ResetPassword.vue?vue&type=template&id=34a5bd8e&":
/*!************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pages/auth/ResetPassword.vue?vue&type=template&id=34a5bd8e& ***!
  \************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "page-wrapper" }, [
    _c(
      "section",
      {
        staticClass: "section-content padding-y-xs",
        staticStyle: { "min-height": "16vh" }
      },
      [
        _c(
          "div",
          {
            staticClass: "mx-auto padding-y-md",
            staticStyle: { "max-width": "380px", "margin-top": "6%" },
            attrs: { align: "center" }
          },
          [
            _c("router-link", { attrs: { to: { name: "home" } } }, [
              _c("img", {
                staticClass: "center-block w-50 padding-y img-fluid",
                attrs: { src: "/images/logo.png", alt: "Logo Kalisso" }
              })
            ])
          ],
          1
        ),
        _vm._v(" "),
        _c(
          "div",
          {
            staticClass: "card mx-auto",
            staticStyle: { "max-width": "380px", "margin-top": "10px" }
          },
          [
            _vm.successMessage
              ? _c(
                  "div",
                  { staticClass: "alert alert-success text-center m-2" },
                  [
                    _vm._v(
                      "\n        " + _vm._s(_vm.successMessage) + "\n      "
                    )
                  ]
                )
              : _vm._e(),
            _vm._v(" "),
            _vm.serverError
              ? _c(
                  "div",
                  { staticClass: "alert alert-danger text-center m-2" },
                  [_vm._v("\n        " + _vm._s(_vm.serverError) + "\n      ")]
                )
              : _vm._e(),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "card-body" },
              [
                _c("h4", { staticClass: "card-title mb-4" }, [
                  _vm._v("Mot de passe oublié")
                ]),
                _vm._v(" "),
                _c("validation-observer", {
                  ref: "observer",
                  scopedSlots: _vm._u([
                    {
                      key: "default",
                      fn: function(ref) {
                        var handleSubmit = ref.handleSubmit
                        return [
                          _c(
                            "b-form",
                            {
                              on: {
                                submit: function($event) {
                                  $event.stopPropagation()
                                  $event.preventDefault()
                                  return handleSubmit(_vm.login)
                                }
                              }
                            },
                            [
                              _c(
                                "div",
                                { staticClass: "form-group" },
                                [
                                  _c("validation-provider", {
                                    attrs: {
                                      name: "Username",
                                      rules: { required: true }
                                    },
                                    scopedSlots: _vm._u(
                                      [
                                        {
                                          key: "default",
                                          fn: function(validationContext) {
                                            return [
                                              _c(
                                                "label",
                                                {
                                                  staticClass:
                                                    "small text-muted"
                                                },
                                                [
                                                  _vm._v(
                                                    "Respecter ce format pour téléphone: "
                                                  ),
                                                  _c(
                                                    "strong",
                                                    {
                                                      staticClass: "text-danger"
                                                    },
                                                    [_vm._v("242055452277")]
                                                  )
                                                ]
                                              ),
                                              _vm._v(" "),
                                              _c("b-form-input", {
                                                staticClass: "form-control",
                                                attrs: {
                                                  id: "username",
                                                  name: "username",
                                                  placeholder:
                                                    "Email ou Numéro de Téléphone",
                                                  type: "text",
                                                  state: _vm.getValidationState(
                                                    validationContext
                                                  ),
                                                  "aria-describedby":
                                                    "input-2-live-feedback"
                                                },
                                                on: {
                                                  keydown: function($event) {
                                                    if (
                                                      !$event.type.indexOf(
                                                        "key"
                                                      ) &&
                                                      _vm._k(
                                                        $event.keyCode,
                                                        "space",
                                                        32,
                                                        $event.key,
                                                        [" ", "Spacebar"]
                                                      )
                                                    ) {
                                                      return null
                                                    }
                                                    $event.preventDefault()
                                                  },
                                                  keyup: function($event) {
                                                    if (
                                                      !$event.type.indexOf(
                                                        "key"
                                                      ) &&
                                                      _vm._k(
                                                        $event.keyCode,
                                                        "space",
                                                        32,
                                                        $event.key,
                                                        [" ", "Spacebar"]
                                                      )
                                                    ) {
                                                      return null
                                                    }
                                                    $event.preventDefault()
                                                  }
                                                },
                                                model: {
                                                  value: _vm.username,
                                                  callback: function($$v) {
                                                    _vm.username =
                                                      typeof $$v === "string"
                                                        ? $$v.trim()
                                                        : $$v
                                                  },
                                                  expression: "username"
                                                }
                                              }),
                                              _vm._v(" "),
                                              _c(
                                                "b-form-invalid-feedback",
                                                {
                                                  attrs: {
                                                    id: "input-2-live-feedback"
                                                  }
                                                },
                                                [
                                                  _vm._v(
                                                    _vm._s(
                                                      validationContext
                                                        .errors[0]
                                                    )
                                                  )
                                                ]
                                              )
                                            ]
                                          }
                                        }
                                      ],
                                      null,
                                      true
                                    )
                                  })
                                ],
                                1
                              ),
                              _vm._v(" "),
                              _c("div", { staticClass: "form-group" }, [
                                _c(
                                  "button",
                                  {
                                    staticClass: "btn btn-primary btn-block",
                                    attrs: {
                                      type: "submit",
                                      disabled: _vm.loading
                                    }
                                  },
                                  [
                                    _vm.loading
                                      ? _c("span", {
                                          staticClass:
                                            "spinner-border spinner-border-sm",
                                          attrs: {
                                            role: "status",
                                            "aria-hidden": "true"
                                          }
                                        })
                                      : _vm._e(),
                                    _vm._v("\n                Récupérer "),
                                    _c("i", {
                                      staticClass:
                                        "fa fa-arrow-right pl-2 text-light"
                                    })
                                  ]
                                )
                              ])
                            ]
                          )
                        ]
                      }
                    }
                  ])
                })
              ],
              1
            )
          ]
        ),
        _vm._v(" "),
        _c(
          "p",
          { staticClass: "text-center mt-4" },
          [
            _vm._v("\n      Besoin d'aide?\n      "),
            _c("router-link", { attrs: { to: { name: "contact" } } }, [
              _vm._v("Contactez l'assistance")
            ])
          ],
          1
        ),
        _vm._v(" "),
        _c(
          "p",
          { staticClass: "text-center mt-5" },
          [
            _c("router-link", { attrs: { to: { name: "login" } } }, [
              _c("i", { staticClass: "fa fa-arrow-left text-primary" }),
              _vm._v(" Retour")
            ])
          ],
          1
        )
      ]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);