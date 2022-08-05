"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_pages_PhoneVerify_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pages/PhoneVerify.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pages/PhoneVerify.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var firebase__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! firebase */ "./node_modules/firebase/dist/index.esm.js");
/* harmony import */ var firebase_auth__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! firebase/auth */ "./node_modules/firebase/auth/dist/index.esm.js");
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
 // import 'firebase/compat/app-check';

 // import VueRecaptcha from "vue-recaptcha";

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: {
    phoneNumber: {
      type: String
    }
  },
  data: function data() {
    return {
      phone: this.phoneNumber || "+242064272080",
      endAt: new Date().getTime() + 120000,
      startAt: new Date().getTime(),
      serverError: "",
      successMessage: "",
      componentKey: 0,
      //phone init
      // confirmationResult: null,
      user: null,
      otp: null,
      smsSent: false,
      recaptchaVerifier: null,
      recaptchaWidgetId: null,
      confirmResult: null,
      appVerifier: ""
    };
  },
  mounted: function mounted() {
    firebase__WEBPACK_IMPORTED_MODULE_0__["default"].auth().useDeviceLanguage();
    this.initRecaptha();
  },
  // components: { VueRecaptcha },
  methods: {
    resendOtpCode: function resendOtpCode() {
      this.startAt = new Date().getTime(), this.endAt = new Date().getTime() + 60000, this.componentKey += 1;
      this.initRecaptha();
    },
    startCallBack: function startCallBack(x) {
      console.log(x);
    },
    endCallBack: function endCallBack(x) {
      console.log(x);
    },
    handleOnComplete: function handleOnComplete(value) {
      // alert("OTP completed: "+ value);
      this.otp = value;
      this.verifyOtp();
    },
    handleOnChange: function handleOnChange(value) {
      console.log("OTP changed: ", value);
    },
    handleClearInput: function handleClearInput() {
      this.$refs.otpInput.clearInput();
    },
    initRecaptha: function initRecaptha() {
      var vm = this;
      window.recaptchaVerifier = new firebase__WEBPACK_IMPORTED_MODULE_0__["default"].auth.RecaptchaVerifier("recaptcha-container", {
        size: "invisible",
        callback: function callback(response) {
          // reCAPTCHA solved, allow signInWithPhoneNumber.
          // ...
          vm.$toast.warning({
            title: "Verification",
            message: "Nous avons vérifier que vous n'êtespas un robot"
          }); // alert("Success recaptcha");
          // this.sendOtp();
        },
        "expired-callback": function expiredCallback() {
          // Response expired. Ask user to solve reCAPTCHA again.
          // ...
          vm.$toast.warning({
            title: "Verification Expiré",
            message: "La vérificaton a expiré, veuillez recharger cette page"
          }); // alert("Echec recaptcha");
        }
      });
      recaptchaVerifier.render();
      this.appVerifier = window.recaptchaVerifier;
      this.sendOtp();
    },
    sendOtp: function sendOtp() {
      var vm = this;
      firebase__WEBPACK_IMPORTED_MODULE_0__["default"].auth().signInWithPhoneNumber(this.phone, this.appVerifier).then(function (confirmationResult) {
        window.confirmationResult = confirmationResult;
        vm.$toast.info({
          title: "SMS Envoyé",
          message: "Vous allez recevoir un SMS de confirmation"
        }); // alert("Sms Sent!  Message envoyé avec succès.");
      })["catch"](function (error) {
        vm.$toast.error({
          title: "Erreur d'envoi du SMS",
          message: error.message
        }); // alert(error.message);
      });
    },
    verifyOtp: function verifyOtp() {
      var vm = this;
      var code = vm.otp; //

      window.confirmationResult.confirm(code).then(function (result) {
        // User signed in successfully.
        // var user = result.user;
        vm.$toast.success({
          title: "Félicitations",
          message: "Vous êtes inscrit à Kalisso.com"
        }); // ...
        //route to login page !

        vm.$router.push({
          name: "login"
        });
      })["catch"](function (error) {
        vm.$toast.error({
          title: "Erreur de vérification",
          message: error.message
        });
        alert(error.message);
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/firebase/auth/dist/index.esm.js":
/*!******************************************************!*\
  !*** ./node_modules/firebase/auth/dist/index.esm.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _firebase_auth__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @firebase/auth */ "./node_modules/@firebase/auth/dist/auth.esm.js");

//# sourceMappingURL=index.esm.js.map


/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pages/PhoneVerify.vue?vue&type=style&index=0&lang=css&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pages/PhoneVerify.vue?vue&type=style&index=0&lang=css& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../node_modules/laravel-mix/node_modules/css-loader/dist/runtime/api.js */ "./node_modules/laravel-mix/node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "\n.otp-input {\n  width: 40px;\n  height: 40px;\n  padding: 5px;\n  margin: 0 8px;\n  font-size: 20px;\n  border-radius: 4px;\n  border: 1px solid rgba(0, 0, 0, 0.3);\n  box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 10%) !important;\n  text-align: center;\n}\n.otp-input:focus-visible {\n  border-color: crimson;\n}\n.otp-input::-webkit-inner-spin-button,\n.otp-input::-webkit-outer-spin-button {\n  -webkit-appearance: none;\n  margin: 0;\n}\n.error {\n  border: 1px solid red !important;\n}\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pages/PhoneVerify.vue?vue&type=style&index=0&lang=css&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pages/PhoneVerify.vue?vue&type=style&index=0&lang=css& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_PhoneVerify_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./PhoneVerify.vue?vue&type=style&index=0&lang=css& */ "./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pages/PhoneVerify.vue?vue&type=style&index=0&lang=css&");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_PhoneVerify_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_PhoneVerify_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./resources/js/components/pages/PhoneVerify.vue":
/*!*******************************************************!*\
  !*** ./resources/js/components/pages/PhoneVerify.vue ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _PhoneVerify_vue_vue_type_template_id_385d24e1___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PhoneVerify.vue?vue&type=template&id=385d24e1& */ "./resources/js/components/pages/PhoneVerify.vue?vue&type=template&id=385d24e1&");
/* harmony import */ var _PhoneVerify_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PhoneVerify.vue?vue&type=script&lang=js& */ "./resources/js/components/pages/PhoneVerify.vue?vue&type=script&lang=js&");
/* harmony import */ var _PhoneVerify_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./PhoneVerify.vue?vue&type=style&index=0&lang=css& */ "./resources/js/components/pages/PhoneVerify.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");



;


/* normalize component */

var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _PhoneVerify_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _PhoneVerify_vue_vue_type_template_id_385d24e1___WEBPACK_IMPORTED_MODULE_0__.render,
  _PhoneVerify_vue_vue_type_template_id_385d24e1___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/pages/PhoneVerify.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/pages/PhoneVerify.vue?vue&type=script&lang=js&":
/*!********************************************************************************!*\
  !*** ./resources/js/components/pages/PhoneVerify.vue?vue&type=script&lang=js& ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PhoneVerify_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./PhoneVerify.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pages/PhoneVerify.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PhoneVerify_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/pages/PhoneVerify.vue?vue&type=style&index=0&lang=css&":
/*!****************************************************************************************!*\
  !*** ./resources/js/components/pages/PhoneVerify.vue?vue&type=style&index=0&lang=css& ***!
  \****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_PhoneVerify_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader/dist/cjs.js!../../../../node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./PhoneVerify.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/dist/cjs.js!./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pages/PhoneVerify.vue?vue&type=style&index=0&lang=css&");


/***/ }),

/***/ "./resources/js/components/pages/PhoneVerify.vue?vue&type=template&id=385d24e1&":
/*!**************************************************************************************!*\
  !*** ./resources/js/components/pages/PhoneVerify.vue?vue&type=template&id=385d24e1& ***!
  \**************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PhoneVerify_vue_vue_type_template_id_385d24e1___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PhoneVerify_vue_vue_type_template_id_385d24e1___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PhoneVerify_vue_vue_type_template_id_385d24e1___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./PhoneVerify.vue?vue&type=template&id=385d24e1& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pages/PhoneVerify.vue?vue&type=template&id=385d24e1&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pages/PhoneVerify.vue?vue&type=template&id=385d24e1&":
/*!*****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pages/PhoneVerify.vue?vue&type=template&id=385d24e1& ***!
  \*****************************************************************************************************************************************************************************************************************************/
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
  return _c("div", [
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
        _vm.successMessage
          ? _c("div", { staticClass: "alert alert-success text-center m-2" }, [
              _vm._v("\n      " + _vm._s(_vm.successMessage) + "\n    ")
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.serverError
          ? _c("div", { staticClass: "alert alert-danger text-center m-2" }, [
              _vm._v("\n      " + _vm._s(_vm.serverError) + "\n    ")
            ])
          : _vm._e(),
        _vm._v(" "),
        _c(
          "div",
          {
            staticClass: "card mx-auto",
            staticStyle: { "max-width": "380px", "margin-top": "10px" },
            attrs: { id: "inputOtp" }
          },
          [
            _c(
              "div",
              { staticClass: "card-body", attrs: { align: "center" } },
              [
                _c("i", { staticClass: "fa text-danger fa-sms fa-3x" }),
                _vm._v(" "),
                _c("h5", { staticClass: "card-title" }, [
                  _vm._v("Vérification du Téléphone")
                ]),
                _vm._v(" "),
                _c("small", [_vm._v("Nous avons envoyez un code par SMS au ")]),
                _vm._v(" "),
                _c("h5", { staticClass: "mb-4" }, [_vm._v(_vm._s(_vm.phone))]),
                _vm._v(" "),
                _c(
                  "form",
                  {
                    on: {
                      submit: function($event) {
                        $event.stopPropagation()
                        $event.preventDefault()
                        return _vm.verify.apply(null, arguments)
                      }
                    }
                  },
                  [
                    _c(
                      "div",
                      { staticClass: "form-group" },
                      [
                        _c("v-otp-input", {
                          attrs: {
                            inputClasses: "otp-input",
                            numInputs: 6,
                            isInputNum: true,
                            separator: " ",
                            shouldAutoFocus: true
                          },
                          on: {
                            "on-complete": _vm.handleOnComplete,
                            "on-change": _vm.handleOnChange
                          }
                        })
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "small mt-4" },
                      [
                        _c("vue-countdown-timer", {
                          key: _vm.componentKey,
                          attrs: {
                            "start-time": _vm.endAt,
                            "end-time": _vm.endAt,
                            interval: 1000,
                            "start-label":
                              "Renvoi du code de vérification dans",
                            "end-label": "Until end:",
                            "label-position": "begin",
                            "end-text": "Renvoyer le code",
                            "day-txt": "",
                            "hour-txt": "",
                            "minutes-txt": "",
                            "seconds-txt": "s"
                          },
                          on: {
                            start_callback: function($event) {
                              return _vm.startCallBack("event started")
                            },
                            end_callback: function($event) {
                              return _vm.endCallBack("event ended")
                            }
                          },
                          scopedSlots: _vm._u([
                            {
                              key: "start-label",
                              fn: function(scope) {
                                return [
                                  scope.props.startLabel !== "" &&
                                  scope.props.tips &&
                                  scope.props.labelPosition === "begin"
                                    ? _c(
                                        "span",
                                        { staticStyle: { color: "red" } },
                                        [
                                          _vm._v(
                                            _vm._s(scope.props.startLabel) + ":"
                                          )
                                        ]
                                      )
                                    : _vm._e(),
                                  _vm._v(" "),
                                  scope.props.endLabel !== "" &&
                                  !scope.props.tips &&
                                  scope.props.labelPosition === "begin"
                                    ? _c(
                                        "span",
                                        { staticStyle: { color: "blue" } },
                                        [
                                          _vm._v(
                                            _vm._s(scope.props.endLabel) + ":"
                                          )
                                        ]
                                      )
                                    : _vm._e()
                                ]
                              }
                            },
                            {
                              key: "countdown",
                              fn: function(scope) {
                                return [
                                  _c("span", { staticClass: "b h7" }, [
                                    _vm._v(_vm._s(scope.props.seconds))
                                  ]),
                                  _c("i", [
                                    _vm._v(_vm._s(scope.props.secondsTxt))
                                  ])
                                ]
                              }
                            },
                            {
                              key: "end-label",
                              fn: function(scope) {
                                return [
                                  scope.props.startLabel !== "" &&
                                  scope.props.tips &&
                                  scope.props.labelPosition === "end"
                                    ? _c(
                                        "span",
                                        {
                                          staticClass: "mt-4",
                                          staticStyle: { color: "red" }
                                        },
                                        [
                                          _vm._v(
                                            _vm._s(scope.props.startLabel) + ":"
                                          )
                                        ]
                                      )
                                    : _vm._e(),
                                  _vm._v(" "),
                                  scope.props.endLabel !== "" &&
                                  !scope.props.tips &&
                                  scope.props.labelPosition === "end"
                                    ? _c(
                                        "span",
                                        { staticStyle: { color: "blue" } },
                                        [
                                          _vm._v(
                                            _vm._s(scope.props.endLabel) + ":"
                                          )
                                        ]
                                      )
                                    : _vm._e()
                                ]
                              }
                            },
                            {
                              key: "end-text",
                              fn: function(scope) {
                                return [
                                  _c(
                                    "a",
                                    {
                                      staticClass: "btn-link text-danger",
                                      attrs: { href: "#" },
                                      on: {
                                        click: function($event) {
                                          return _vm.resendOtpCode()
                                        }
                                      }
                                    },
                                    [
                                      _c("i", { staticClass: "fa fa-redo" }),
                                      _vm._v(
                                        " " +
                                          _vm._s(scope.props.endText) +
                                          "\n                "
                                      )
                                    ]
                                  )
                                ]
                              }
                            }
                          ])
                        }),
                        _vm._v(" "),
                        _c("div", { attrs: { id: "recaptcha-container" } })
                      ],
                      1
                    )
                  ]
                )
              ]
            )
          ]
        ),
        _vm._v(" "),
        _c(
          "p",
          { staticClass: "text-center mt-4" },
          [
            _vm._v("\n      Vous n'avez pas de compte?\n      "),
            _c(
              "router-link",
              { attrs: { to: { name: "register" }, href: "#" } },
              [_vm._v("Inscrivez-vous ici")]
            )
          ],
          1
        ),
        _vm._v(" "),
        _c("br"),
        _c("br")
      ]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);