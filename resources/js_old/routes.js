import Logout from "./components/pages/auth/Logout";
import Contact from "./components/pages/Contact";
import About from "./components/pages/About";
import TravelIndex from "./components/pages/travel/Index";
import CreateStore from "./components/pages/store/Create";
import BecomeSeller from "./components/pages/store/Index";
import ShowStore from "./components/pages/store/Store";
import MusicIndex from "./components/pages/music/Index";
import Privacy from "./components/pages/Privacy";
import ThankYouPage from "./components/pages/Merci";
import PlanPage from "./components/pages/store/Plan";
import Payment from "./components/pages/payment/Index";
import PaymentQuery from "./components/pages/payment/GetPayment.vue";

const routes = [
     {
        path: "/payment/:query",
        name: "payment.query",
        props: true,
        component: Payment
    },
    {
        path: "/payment",
        name: "payment",
        props: true,
        component: Payment
    },
    {
        path: "/merci",
        name: "thankyou",
        props: true,
        component: ThankYouPage
    },
    {
        path: "/privacy",
        name: "privacy",
        component: Privacy
    },
    {
        path: "/music",
        name: "music.index",
        component: MusicIndex
    },
    {
        path: "/help-center",
        name: "help",
        component: require("./components/pages/Faq.vue").default
    },
    {
        path: "/about/kalisso/story",
        name: "about",
        props: true,
        component: About
    },
    {
        path: "/travel/ticket/reservation",
        name: "travel.index",
        props: true,
        component: TravelIndex
    },
    {
        path: "/contact-us/",
        name: "contact",
        props: true,
        component: Contact
    },
    {
        path: "/store/:slug",
        name: "show.store",
        props: true,
        component: ShowStore
    },
    {
        path: "/create/store/choose/plan",
        name: "plan.create.store",
        props: true,
        meta: {
            requiresAuth: true
        },
        component: PlanPage
    },
    {
        path: "/create/store/seller",
        name: "create.store",
        props: true,
        meta: {
            requiresAuth: true
        },
        component: CreateStore
    },
    {
        path: "/become/seller",
        name: "become.seller",
        props: true,
        component: BecomeSeller
    },
    {
        path: "/all/kalisso/store/",
        name: "all.store.index",
        props: true,
        component: require("./components/pages/store/AllStore.vue").default
    },
    {
        path: "/reset/password",
        name: "reset.password",
        props: true,
        meta: {
            requiresVisitor: true
        },
        component: require("./components/pages/auth/ResetPassword.vue").default
    },
    {
        path: "/category/show/:slug",
        name: "category.show",
        props: true,
        component: require("./components/pages/category/Show.vue").default
    },
    {
        path: "/categories",
        name: "category.index",
        props: true,
        component: require("./components/pages/Category.vue").default
    },
    {
        path: "/phone/verify",
        name: "phone.verify",
        props: true,
        meta: {
            requiresVisitor: true
        },
        component: require("./components/pages/auth/PhoneVerify.vue").default
    },
    {
        path: "/search/:q",
        name: "search",
        props: true,
        component: require("./components/pages/SearchPage.vue").default
    },
    {
        path: "/sold",
        name: "sold",
        component: require("./components/pages/Offers.vue").default
    },
    {
        path: "/",
        name: "home",
        component: require("./components/pages/Index.vue").default
    },
    {
        path: "/show/:slug",
        name: "products.show",
        component: require("./components/Products/Show.vue").default
    },

    {
        path: "/shoppingCart",
        name: "products.shopping",
        meta: {
            requiresAuth: true
        },
        component: require("./components/Products/ShoppingCart.vue").default
    },
    {
        path: "/account/profile",
        name: "profile.index",
        props: true,
        meta: {
            requiresAuth: true
        },
        component: require("./components/pages/profile/Index.vue").default
    },
    {
        path: "/account/orders",
        name: "profile.orders",
        props: true,
        meta: {
            requiresAuth: true
        },
        component: require("./components/pages/profile/Orders.vue").default
    },
    {
        path: "/profile/seller",
        name: "profile.seller",
        props: true,
        meta: {
            requiresAuth: true
        },
        component: require("./components/pages/profile/Seller.vue").default
    },
    {
        path: "/profile/wishlist",
        name: "profile.wishlist",
        props: true,
        meta: {
            requiresAuth: true
        },
        component: require("./components/pages/profile/Wishlist.vue").default
    },
    {
        path: "/profile/settings",
        name: "profile.settings",
        props: true,
        meta: {
            requiresAuth: true
        },
        component: require("./components/pages/profile/Settings.vue").default
    },
    {
        path: "/profile/address",
        name: "profile.address",
        props: true,
        meta: {
            requiresAuth: true
        },
        component: require("./components/pages/profile/Address.vue").default
    },
    {
        path: "/login",
        name: "login",
        props: true,
        meta: {
            requiresVisitor: true
        },
        component: require("./components/pages/auth/Login.vue").default
    },
    {
        path: "/logout",
        name: "logout",
        meta: {
            requiresAuth: true
        },
        component: Logout
    },
    {
        path: "/register",
        name: "register",
        meta: {
            requiresVisitor: true
        },
        component: require("./components/pages/auth/Register.vue").default
    },
    {
        path: "/checkout",
        name: "checkout.payment",
        props: true,
        meta: {
            requiresAuth: true
        },
        component: require("./components/pages/Checkout.vue").default
    },
    {
        path: "/:pathMatch(.*)*",
        name: "404",
        component: require("./components/NotFound.vue").default
    }
];

export default routes;
