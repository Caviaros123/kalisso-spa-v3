import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);

axios.defaults.baseURL = "https://kalisso.com/api/v1";

export const store = new Vuex.Store({
    state: {
        //int user information
        token: localStorage.getItem("access_token") || null,
        cart: JSON.parse(localStorage.getItem("cartItem")) || [],
        user: [],
        orders: [],
        ordersProductSeller: [],
        wishlist: [],
        address: [],
        totalAddress: [],
        allStore: [],
        lastSeenProducts: JSON.parse(localStorage.getItem("lastSeenProducts")) || [],

        //init data content
        products: [],
        categories: [],
        homeBanner: [],
        baseURL: "https://kalisso.com/storage/"
    },
    getters: {
        loggedIn(state) {

            // if(localStorage.getItem('access_token') !== null)
            // {
            axios.defaults.headers.common["Authorization"] = "Bearer " + state.token;
            
            axios
                .get("/user",)
                .then(response => {
                    state.user = response.data;
                    return true;
                })
                .catch(error => {
                    localStorage.removeItem("access_token");
                    return false;
                });
            // } 
            return state.token !== null;
        },
        cartItemList: state => {
            return state.cart;
        },
        cartItem: state => {
            return JSON.parse(localStorage.getItem("cartItem")) || [];
        }
    },
    mutations: {
        setBanner(state, data) {
            state.homeBanner = data;
        },
        setProducts(state, products) {
            state.products = products;
        },
        setCategory(state, categories) {
            state.categories = categories;
        },
        addProductToCart(state, {product, qty}) {
            //check if logged in
            // if(context.getters.loggedIn){
                const cart =
                JSON.parse(localStorage.getItem("cartItem")) || state.cart;

                let duplicatedProductIndex = cart.find(item => {
                    return item.product.id === product.id
                });

                if (duplicatedProductIndex) {
                    duplicatedProductIndex.qty += qty;
                    localStorage.setItem("cartItem", JSON.stringify(state.cart));
                    return;
                }

                product.qty = 1;
                state.cart.push({
                    product,
                    qty
                });
                localStorage.setItem("cartItem", JSON.stringify(state.cart));
            // }else{
            //     //redirect to login
            //     return this.$router.push({ name: "login", params: { redirect: this.$route.fullPath } });
            // }
            
        },

        updateCartQty(state, { product, actiontype }) {
            // const cart = JSON.parse(localStorage.getItem("cartItem"));
            const record = state.cart.findIndex(item => item.id === product.id);

            if (record !== -1) {
                if (actiontype === "+") {
                    if (state.cart[record].qty >= 1) {
                        state.cart[record].qty++;
                        localStorage.setItem(
                            "cartItem",
                            JSON.stringify(state.cart)
                        );
                        return;
                    } else {
                        state.cart[record].qty += 1;
                        localStorage.setItem(
                            "cartItem",
                            JSON.stringify(state.cart)
                        );
                        return;
                    }
                } else if (actiontype === "-") {
                    if (state.cart[record].qty >= 2) {
                        state.cart[record].qty -= 1;
                        localStorage.setItem(
                            "cartItem",
                            JSON.stringify(state.cart)
                        );
                        return;
                    } else {
                        state.cart[record].qty = 1;
                        localStorage.setItem(
                            "cartItem",
                            JSON.stringify(state.cart)
                        );
                        return;
                    }
                }
            }
            // state.cart.push(product)
            // localStorage.setItem("cartItem", JSON.stringify(state.cart));
        },
        SET_CART(state, productList) {
            if (productList) {
                state.cart = [];
            }
        },
        removeProductToCart(state, index) {
            state.cart.splice(index, 1);
            localStorage.setItem("cartItem", JSON.stringify(state.cart));
        },
        retrieveToken(state, token) {
            state.token = token || localStorage.getItem("access_token");
        },
        destroyToken(state) {
            state.token = null
            state.cart = []
            state.user = null
            state.orders = []
            state.wishlist = []
            state.address = null
            state.totalAddress = []
        },
        retrieveStoreInfo(state, data) {
            state.ordersProductSeller = data;
        },
        retrieveUserInfo(state, data) {
            state.user = data.data || [];
            state.orders = data.orders || [];
            state.wishlist = data.wishlist || [];
            state.address = data.address || [];
            state.totalAddress = data.totalAddress || [];
        },
        removeItemFromWishlist(state, index) {
            state.wishlist.splice(index, 1);
        },
        changeAddress(state, data) {
            const record = state.totalAddress.findIndex(
                item => item.id === data.id
            );

            state.totalAddress.forEach(element => {
                let rid = state.totalAddress.findIndex(
                    data => data.id === element.id
                );
                if (rid !== -1) {
                    state.totalAddress[rid].default_address = 0;
                }
            });

            if (record !== -1) {
                state.totalAddress[record].default_address = 1;
            }

            // console.log(state.totalAddress)
            // state.totalAddress.push(element)
            // state.totalAddress.push(record)
        },
        deleteAddress(state, index) {
            state.totalAddress.splice(index, 1);
        },
        pushToWishlist(state, data) {
            const record = state.wishlist.findIndex(
                item => item.id === data.id
            );

            if (record !== -1) {
                state.wishlisty.splice(index, 1);
                return;
            }
            state.wishlist.push(data);
        },
        pushToLastSeenProducts(state, data){

            const duplicatedProductIndex = state.lastSeenProducts.findIndex(
                item => item.id === data.id
            );

            if (duplicatedProductIndex !== -1) {
                return
            }

            state.lastSeenProducts.push(data);
            localStorage.setItem('lastSeenProducts', JSON.stringify(state.lastSeenProducts))
            
        },
        AllStore(state, data){
            state.AllStore.push(data);
        }
    },
    actions: {
         getEpayData(context, data){
            return new Promise((resolve, reject) => {
                axios
                    .get("/request/fetch/data/payment/getEpayData")
                    .then(response => {
                        // context.commit("pushToLastSeenProducts", data.product);
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
            
        },
        addToCart(context, data) {

            const mapData = {
                product_id: data.product.id,
            };

            return new Promise((resolve, reject) => {
                axios
                    .post("/account/cart/addToCart", mapData)
                    .then(response => {
                        context.commit("addProductToCart", data);
                        // console.log(data)
                        resolve(response);
                    })
                    .catch(error => {
                        // console.log(data)
                        reject(error);
                    });
            });
        },
        checkoutPlanSubscription(context, data){
            return new Promise((resolve, reject) => {
                axios
                    .post("/account/user/store/plan/subscription", data)
                    .then(response => {
                        // context.commit("pushToLastSeenProducts", data.product);
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
            
        },
        setLastSeenProducts(context, data){
            return new Promise((resolve, reject) => {
                axios
                    .get("/account/user/product/addToLastSeen")
                    .then(response => {
                        // context.commit("pushToLastSeenProducts", data.product);
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
            
        },
        findStore(context, data) {
            axios.defaults.headers.common["Accept"] = "application/json";
            
            return new Promise((resolve, reject) => {
                axios
                    .post("/getStoreInfo", data)
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        getAllStore(context) {
            axios.defaults.headers.common["Accept"] = "application/json";
            return new Promise((resolve, reject) => {
                axios
                    .get("/getAllStore")
                    .then(response => {
                        resolve(response);
                        context.commit("AllStore", response.data.data);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        checkScanPayPayment(context, data) {
            axios.defaults.headers.common["Accept"] = "application/json";
            axios.defaults.headers.common["clientId"] = "230031586";
            axios.defaults.headers.common["clientSecret"] = "1bpehsnbn41c8121";

            const url =
                "https://pos-prod.digibox-pos.com/api-v1/scan-pay/pay-code/verify/" +
                data.clientRef;
            return new Promise((resolve, reject) => {
                axios
                    .get(url)
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        requestScanPay(context, data) {
            axios.defaults.headers.common["Accept"] = "application/json";
            axios.defaults.headers.common["clientId"] = "230031586";
            axios.defaults.headers.common["clientSecret"] = "1bpehsnbn41c8121";

            const url =
                "https://pos-prod.digibox-pos.com/api-v1/scan-pay/pay-code/create";
            return new Promise((resolve, reject) => {
                axios
                    .post(url, data)
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        getSearchProduct(context, data) {
            return new Promise((resolve, reject) => {
                axios
                    .post("search/getSearchProduct", data)
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        checkLike(context, data) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            return new Promise((resolve, reject) => {
                axios
                    .post("account/user/checkWishList", data)
                    .then(response => {
                        // const data = JSON.parse(JSON.stringify(response.data.data))
                        // context.commit('pushToWishlist', response.data.data.success);
                        resolve(response);
                        // console.log(response)
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        addToWishlist(context, data) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            return new Promise((resolve, reject) => {
                axios
                    .post("account/user/addToWishList", data)
                    .then(response => {
                        // const data = JSON.parse(JSON.stringify(response.data.data))
                        context.commit("pushToWishlist", response.data.data);
                        resolve(response);
                        // console.log(response)
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        addAddress(context, data) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            return new Promise((resolve, reject) => {
                axios
                    .post("account/user/addAddress", data)
                    .then(response => {
                        // const data = JSON.parse(JSON.stringify(response.data.data))
                        context.commit("addAddress", data.index);
                        resolve(response);
                        // console.log(response)
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        deleteFromAddress(context, data) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            return new Promise((resolve, reject) => {
                axios
                    .post("account/user/deleteAddress", data)
                    .then(response => {
                        // const data = JSON.parse(JSON.stringify(response.data.data))
                        context.commit("deleteAddress", data.index);
                        resolve(response);
                        // console.log(response)
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        changeDefaultAddress(context, data) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;
            return new Promise((resolve, reject) => {
                axios
                    .post("account/user/setDefaultAddress", data)
                    .then(response => {
                        // const data = JSON.parse(JSON.stringify(response.data.data))
                        context.commit("changeAddress", data);
                        resolve(response);
                        // console.log(response)
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        getCountries(context) {
            return new Promise((resolve, reject) => {
                axios
                    .get("getCountries")
                    .then(response => {
                        // const data = JSON.parse(JSON.stringify(response.data.data))
                        // context.commit('removeItemFromWishlist', data.index);
                        resolve(response);
                        console.log(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        removeItemFromWishlist(context, data) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            return new Promise((resolve, reject) => {
                axios
                    .post("account/user/removeFromWishList", data)
                    .then(response => {
                        // const data = JSON.parse(JSON.stringify(response.data.data))
                        context.commit("removeItemFromWishlist", data.index);
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        getSellerName(context, data) {
            return new Promise((resolve, reject) => {
                axios
                    .post("getStoreInfo", data)
                    .then(response => {
                        const datas = JSON.parse(
                            JSON.stringify(response.data.data)
                        );
                        context.commit("retrieveStoreInfo", datas);
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        setNewOrder(context, data) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/account/user/set/new/order", data)
                    .then(response => {
                        localStorage.removeItem("cartItem");
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        clearCart: ({ commit }) => {
            commit("SET_CART", []);
        },
        updateCartQty(context, datas) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/account/cart/update", datas)
                    .then(response => {
                        context.commit("UPDATE_CART_QTY", response.data);
                        resolve(response);
                        // console.log(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        retrieveUserInfo(context) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            return new Promise((resolve, reject) => {
                axios
                    .get("/user")
                    .then(response => {
                        const data = response.data;
                        context.commit("retrieveUserInfo", data);
                        resolve(response);
                        // console.log(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        register(context, data) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/register", data)
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        destroyToken(context) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            if (context.getters.loggedIn) {
                return new Promise((resolve, reject) => {
                    axios
                        .post("/logout")
                        .then(response => {
                            localStorage.removeItem("access_token");
                            localStorage.removeItem("cartItem");
                            context.commit("destroyToken");
                            resolve(response);
                            // console.log(response);
                        })
                        .catch(error => {
                            localStorage.removeItem("access_token");
                            localStorage.removeItem("cartItem");
                            context.commit("destroyToken");
                            reject(error);
                        });
                });
            }
        },
        retrieveToken(context, credentials) {
            return new Promise((resolve, reject) => {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios
                        .post("/login", {
                            email: credentials.username.split(" ").join(""),
                            password: credentials.password.split(" ").join("")
                        })
                        .then(response => {
                            const token = response.data.token.token;
                            localStorage.setItem("access_token", token);
                            // console.log("REPONSE LOGIN===="+response);
                            context.commit("retrieveToken", token);
                            resolve(response);
                        })
                        .catch(error => {
                            // console.log(error);
                            reject(error);
                        });
                });
            });
        },
        getProducts({ commit }) {
            axios
                .get("/product")
                .then(response => {
                    commit("setProducts", response.data.data);
                })
                .catch(error => console.error(error));
        },
        getCategory({ commit }) {
            axios
                .get("/category")
                .then(response => {
                    commit("setCategory", response.data.data);
                })
                .catch(error => console.error(error));
        },
        getHomeBanner({ commit }) {
            axios
                .get("/home/getHomeBanner")
                .then(response => {
                    commit("setBanner", response.data);
                })
                .catch(error => console.error(error));
        }
    }
});
