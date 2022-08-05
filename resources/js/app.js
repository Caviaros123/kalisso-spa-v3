require("./bootstrap");

import "bootstrap"
import Vue from "vue"
import VueRouter from "vue-router"
import Vuex from "vuex"
import NavBar from "./components/partials/_navbar.vue"
// import CheckConnexion from "./components/partials/_checkInternet.vue"
import Footer from "./components/partials/_footer.vue"
import routes from "./routes"
import { store } from "./store/store"
import HomeHeader from "./components/pages/home/Header.vue"
import VueCountdownTimer from "vuejs-countdown-timer"
import VueTelInput from "vue-tel-input"
import "vue-tel-input/dist/vue-tel-input.css"
import BootstrapVue from "bootstrap-vue"
import {
    ValidationObserver,
    ValidationProvider,
    extend,
    localize
} from "vee-validate";
import fr from "vee-validate/dist/locale/fr.json"
import * as rules from "vee-validate/dist/rules"
import firebase  from "firebase"
// import { getAnalytics } from "firebase/analytics";
// import ProductZoomer from 'vue-product-zoomer'
import moment from 'moment';
import VLazySrcPlugin from 'v-lazy-src'
import VModal from 'vue-js-modal/dist/index.nocss.js'
import 'vue-js-modal/dist/styles.css'
import CxltToastr from 'cxlt-vue2-toastr'
import "vue-form-wizard/dist/vue-form-wizard.min.css";
import Element from 'element-ui'
import locale from 'element-ui/lib/locale/lang/en'
import 'cxlt-vue2-toastr/dist/css/cxlt-vue2-toastr.css'
import { currency } from './currency'
// import VOffline from 'v-offline';
import { VueMaskFilter } from 'v-mask'
import VueLoadImage from 'vue-load-image'
// import VueProgressBar from 'vue-progressbar'

// Vue.use(VueProgressBar, {
//   color: 'rgb(143, 255, 199)',
//   failedColor: 'red',
//   height: '2px'
// })
 
Vue.filter('VMask', VueMaskFilter)
Vue.filter('formatDate', function(value) {
    if (value) {
      return moment(String(value)).format('DD/MM/YYYY hh:mm:ss');
    }
});

window.eventBus = new Vue();

// Install VeeValidate rules and localization
Object.keys(rules).forEach(rule => {
    extend(rule, rules[rule]);
})

localize("fr", fr)

const toastrConfigs = {
    position: 'bottom left',
    showDuration: 2000,
    timeOut: 5000,
    progressBar: true,
}

// Vue.use(ValidationProvider)
Vue.use(VueLoadImage)
// Vue.use(VOffline)
Vue.use(Element, { locale })
// Vue.use(VueFormWizard)
Vue.use(CxltToastr, toastrConfigs)
Vue.use(VModal)
Vue.use(VLazySrcPlugin)
// Vue.use(ProductZoomer)
// Vue.use(CountdownTimer)
Vue.use(BootstrapVue)
Vue.use(VueTelInput)
Vue.use(Vuex)
Vue.use(VueRouter)
Vue.use(VueCountdownTimer)

Vue.config.productionTip = false

const firebaseConfig = {
    apiKey: "AIzaSyCc2BBFgf_osbxj-5-E_KQKEV4SuATFuRI",
    authDomain: "kalisso-298808.firebaseapp.com",
    projectId: "kalisso-298808",
    storageBucket: "kalisso-298808.appspot.com",
    messagingSenderId: "84460790081",
    appId: "1:84460790081:web:5fd6866e8ca6be405601c0",
    measurementId: "G-GYX9DFZG8J"
}

// Initialize Firebase
firebase.initializeApp(firebaseConfig)
// const analytics = getAnalytics(firebase);

const router = new VueRouter({
    mode: "history",
    linkActiveClass: "active",
    routes
})

function isLoggedIn() {
    return localStorage.getItem("isLoggedIn")
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!isLoggedIn()) {
            next({
                name: "login",
                query: {redirect: to.fullPath }
            });
        } else {
            next()
        }
    } else if (to.matched.some(record => record.meta.requiresVisitor)) {
        if (isLoggedIn()) {
            next({
                name: "profile.index"
            })
        } else {
            next()
        }
    } else {
        next()
    }
});

Vue.component("vue-load-image", VueLoadImage)
Vue.component("ValidationProvider", ValidationProvider)
Vue.component("ValidationObserver", ValidationObserver)
Vue.component("nav-section", NavBar)
Vue.component("footer-section", Footer)
Vue.component("home-header-and-carousel", HomeHeader)
// Vue.component("v-otp-input", OtpInput)

Vue.component("not-found", require("./components/NotFound.vue").default);
Vue.component("Spinner", require("./components/partials/_spinner.vue").default);
// Vue.component('pulse-loader', require('vue-spinner/src/PulseLoader.vue'));

Vue.component(
    "profile-header",
    require("./components/pages/profile/partials/_profileHeaders.vue").default
);

Vue.component(
    "profile-nav",
    require("./components/pages/profile/partials/_profileNavigation.vue")
        .default
);

Vue.component('set-cookie', require('./components/partials/_cookie.vue').default);

Vue.mixin({
    methods: {
        presentPrice(value) {
            let val = (value / 1).toFixed(0).replace(",", ".") + " XAF";
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },
        loadImage(image){   
            return image.replace(/\\/g, "/");
        }
    }
});

Vue.filter('currency', currency)


const app = new Vue({
    router,
    store,
    el: "#app",
    data() {
        return {
            users: {},
            onLine: navigator.onLine,
            showBackOnline: false
        }
    },
    mounted() {
       
        //check if logged in
        // if (localStorage.getItem("isLoggedIn") === "true") {
        //     this.$store.dispatch("retrieveUserInfo").then((response) => {
        //         this.$router.push({ name: "profile.index" });
        //     }).catch((error) => {
        //         this.$router.push({ name: "home" });
        //     })
        // }
        store
            .dispatch("getProducts")
            .then(() => {})
            .catch(error => console.error(error));
        store
            .dispatch("getCategory")
            .then(() => {})
            .catch(error => console.error(error));
        store
            .dispatch("getHomeBanner")
            .then(() => {})
            .catch(error => console.error(error));

        if (isLoggedIn()) {
            store.dispatch("retrieveUserInfo").then((response) => {
                // this.$router.push({ name: "profile.index" });
            }).catch((error) => {
                localStorage.removeItem("isLoggedIn");
                this.$router.push({ name: "home" });
            })
        }

        //  if(localStorage.getItem("access_token") !== 'undefined')
        // {
        //     axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem("access_token");
        //     return new Promise((resolve, reject) => {
        //     axios
        //         .get("/user")
        //         .then(response => {
        //             // context.commit("pushToLastSeenProducts", data.product);
        //             // resolve(response);
        //             // localStorage.setItem("access_token", response.data.access_token);
        //             console.log(response);
        //             return true;
        //         })
        //         .catch(error => {
        //             console.log(error);
        //             localStorage.removeItem("access_token")
        //             // window.location.href = '/login';
        //             return false;
        //         });
        //     });
            
            

        // }
        // console.log(store.state.token);
       
        // Echo.join('users')
        //     .here((users) => {
        //     this.users= users
        //     })
        //     .joining((user) => {
        //     this.users.push(user)
        //     })
        //     .leaving((user) => {
        //     this.user.splice(this.users.indexOf(user), 1)
        // })
        // window.addEventListener('online', this.updateOnlineStatus)
        // window.addEventListener('offline', this.updateOnlineStatus)
    },
});
