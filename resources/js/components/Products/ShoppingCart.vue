<template>
  <section class="page-wrapper">
    <nav-section></nav-section>
    <!-- ========================= SECTION PAGETOP ========================= -->
    <section class="section-pagetop bg-gray">
      <div class="container">
        <div class="ml-3">
          <h2 class="title-page">Mon Panier </h2>
          <h5 class="text-danger">
            {{ totalProduct }} produit{{ totalProduct > 1 ? "s" : "" }} dans
            votre panier
          </h5>
        </div>
      </div>
      <!-- container //  -->
    </section>
    <!-- ========================= SECTION PAGETOP END// ========================= -->

    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content padding-y">
      <div class="container">
        <div class="row">
          <main class="col-md-9">
            <div class="card">
              <table
                v-if="this.$store.state.cart.length > 0"
                class="table table-borderless table-responsive table-shopping-cart"
              >
                <thead class="text-muted">
                  <tr class="small text-uppercase">
                    <th scope="col">Produit</th>
                    <th scope="col" width="120">Quantité</th>
                    <th scope="col" width="120">prix</th>
                    <th scope="col" class="text-right" width="200"></th>
                  </tr>
                </thead>
                <tbody>
                  <!-- //ZONE PRODUIT  -->
                  <tr v-for="(product, index) in getCart" :key="index">
                    <td>
                      <figure class="itemside">
                        <div class="aside">
                          <img
                            v-bind:src="storage_url + product.image"
                            class="img-sm"
                          />
                        </div>
                        <figcaption class="info">
                          <router-link
                            :to="{
                              name: 'products.show',
                              params: { slug: product.slug },
                            }"
                            href="#"
                            class="title text-dark"
                            >{{ product.name }}</router-link
                          >
                          <p class="text-muted small">
                            {{ product.details }}
                            <br />
                            <!-- Brand: Gucci -->
                          </p>
                        </figcaption>
                      </figure>
                    </td>
                    <td>
                      <!-- <select  v-model="qty" @change="onChange(this.value)" class="form-control">
                        <option
                          v-for="n in 10"
                          :key="n"
                          :value="n"
                          v-bind="n == product.qty ? qty = product.qty : null"
                        >
                          {{ n }}
                        </option>
                      </select> -->
                      <!-- <input
                        type="number"
                        min="1"
                        max="10"
                        class="form-control "
                        @change="updateCartQty(product, actiontype= '+')"
                        v-model="product.qty"
                      /> -->
                      <div class="form-group col-md flex-grow-0">
                        <div class="input-group mb-3 input-spinner">
                          <div class="input-group-append">
                            <button
                              class="btn btn-light"
                              type="button"
                              id="button-minus"
                              @click.passive="decreaseItemQty(product)"
                            >
                              <!-- @click="$store.commit('updateCartQty', index)" -->
                              &minus;
                            </button>
                          </div>
                          <input
                            type="text"
                            min="1"
                            max="10"
                            class="form-control"
                            v-model="product.qty"
                          />
                          <div class="input-group-prepend">
                            <button
                              class="btn btn-light"
                              type="button"
                              id="button-plus"
                              @click.stop.passive="increaseItemQty(product)"
                            >
                              <!-- ;incrementCounter({product}) -->
                              <!-- @click="$store.commit('updateCartQty', index)" -->
                              +
                            </button>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="price-wrap">
                        <var class="price">{{
                          presentPrice(product.price)
                        }}</var>
                        <!-- <small class="text-muted"> $315.20 each </small> -->
                      </div>
                      <!-- price-wrap .// -->
                    </td>
                    <td class="text-right">
                      <!-- <a
                        data-original-title="Save to Wishlist"
                        title=""
                        href=""
                        class="btn btn-light"
                        data-toggle="tooltip"
                      >
                        <i class="fa fa-heart"></i
                      ></a> -->
                      <a
                        href=""
                        @click.stop.prevent="
                          $store.commit('removeProductToCart', index)
                        "
                        class="btn btn-light"
                      >
                        Retirer</a
                      >
                    </td>
                  </tr>
                </tbody>
              </table>

              <div v-if="this.$store.state.cart.length <= 0" class="jumbotron">
                <div class="row">
                  <div class="col-8">
                    <h2>Votre Panier est Vide</h2>
                    <router-link :to="{ name: 'home' }" class="btn btn-light">
                      <i class="fa fa-chevron-left"></i>
                      Retour au shopping
                    </router-link>
                  </div>
                  <div class="col-4">
                    <img
                      src="/images/emptCart2.png"
                      class="img-fluid"
                      alt="Cart is Empty"
                    />
                  </div>
                </div>
              </div>

              <div class="card-body border-top d-none d-md-block">
                <router-link
                  :to="{
                    name: 'checkout.payment',
                    params: { totalPrice: totalPrice },
                  }"
                  v-if="this.$store.state.cart.length > 0"
                  class="btn btn-primary float-md-right"
                >
                  Passer à la caisse
                  <i class="fa fa-chevron-right"></i>
                </router-link>
                <router-link
                  v-if="this.$store.state.cart.length > 0"
                  :to="{ name: 'home' }"
                  class="btn btn-light"
                >
                  <i class="fa fa-chevron-left"></i>
                  Retour au shopping
                </router-link>
              </div>
            </div>
            <!-- card.// -->

            <div
              class="alert alert-success mt-3"
              v-if="this.$store.state.cart.length > 0"
            >
              <p class="icontext">
                <i class="icon text-success fa fa-truck"></i>
                Livraison gratuite sous 48h
              </p>
            </div>
          </main>
          <!-- col.// -->
          <aside class="col-md-3" v-if="this.$store.state.cart.length > 0">
            <div class="card mb-3">
              <div class="card-body">
                <form role="form">
                  <div class="form-group">
                    <label>Vous avez un coupon?</label>
                    <div class="input-group">
                      <input
                        type="text"
                        class="form-control"
                        v-model="coupon"
                        placeholder="Coupon code"
                      />
                      <span class="input-group-append">
                        <button class="btn btn-primary">Appliquer</button>
                      </span>
                    </div>
                  </div>
                </form>
              </div>
              <!-- card-body.// -->
            </div>
            <!-- card .// -->
            <div class="card">
              <div class="card-body">
                <dl class="dlist-align">
                  <dt>Total :</dt>
                  <dd class="text-right">{{ presentPrice(totalPrice) }}</dd>
                </dl>
                <dl class="dlist-align">
                  <dt>Réduction:</dt>
                  <dd class="text-right">{{ presentPrice(0) }}</dd>
                </dl>
                <dl class="dlist-align">
                  <dt>Total à payer:</dt>
                  <dd class="text-right h5">
                    <strong>{{ presentPrice(totalPrice) }}</strong>
                  </dd>
                </dl>
                <hr />
                <p class="text-center mb-3">
                  <img src="/images/misc/payments.png" height="32" />
                </p>
              </div>
              <!-- card-body.// -->
            </div>
            <div
          class="
            card
            shadow
            d-flex
            fixed-bottom
            d-block d-md-none
            mx-auto
            padding-y-sm
            px-3
            m-0
          "
        >
          
          <router-link
                  :to="{
                    name: 'payment',
                    params: { totalPrice: totalPrice },
                  }"
                  v-if="this.$store.state.cart.length > 0"
                  class="btn btn-primary "
                >
                  Passer à la caisse
                  <i class="fa fa-chevron-right "></i>
                </router-link>
        </div>
            <!-- card .// -->
          </aside>
          <!-- col.// -->
        </div>
      </div>
      <!-- container .//  -->
    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->

    <!-- ========================= SECTION  ========================= -->
    <section class="section-name border-top padding-y">
      <div class="container">
        <h6>Politique de paiement et de remboursement</h6>
        <p>
          Nous vous rembourserons tous les paiements que nous avons reçus de
          votre part, y compris les frais de livraison standard (c'est-à-dire la
          livraison la moins chère que nous proposons) au plus tard 15 jours à
          compter de la réception de votre demande de retrait. Nous utiliserons
          le même mode de paiement que celui que vous avez utilisé pour votre
          commande initiale, sauf si vous acceptez expressément un autre mode de
          paiement. En aucun cas, ce remboursement ne vous occasionnera de frais
          supplémentaires. Nous pouvons suspendre le remboursement jusqu'à ce
          que nous ayons reçu le ou les produits ou jusqu'à ce que vous ayez
          fourni une preuve d'expédition du ou des produits, quelle que soit la
          date d'échéance. premier de ces faits. Si le remboursement intervient
          après le délai mentionné ci-dessus, le montant qui vous est dû sera
          automatiquement majoré.
        </p>
      </div>
      <!-- container // -->
    </section>
    <!-- ========================= SECTION  END// ========================= -->

    <!-- ===================  REAL CART START HERE  ========================= -->
    <div class="container mx-auto" hidden>
      <div class="flex shadow-md">
        <div class="w-3/4 bg-white px-10 py-10">
          <div class="flex justify-between border-b pb-8">
            <h1 class="font-semibold text-2xl">Shopping Cart</h1>
            <h2 class="font-semibold text-2xl">
              {{ totalProduct }} produits dans votre panier
            </h2>
          </div>
          <div class="flex mt-10 mb-5">
            <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">
              Détails du produit
            </h3>
            <h3
              class="
                font-semibold
                text-center text-gray-600 text-xs
                uppercase
                w-1/5
                text-center
              "
            >
              Quantité
            </h3>
            <h3
              class="
                font-semibold
                text-center text-gray-600 text-xs
                uppercase
                w-1/5
                text-center
              "
            >
              price
            </h3>
            <h3
              class="
                font-semibold
                text-center text-gray-600 text-xs
                uppercase
                w-1/5
                text-center
              "
            >
              Total
            </h3>
          </div>
          <div
            v-for="(product, index) in getCart"
            :key="index"
            class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5"
          >
            <div class="flex w-2/5">
              <div class="w-20">
                <img
                  class="h-24"
                  src="https://images.unsplash.com/photo-1494726161322-5360d4d0eeae?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80"
                  alt=""
                />
              </div>
              <div class="flex flex-col justify-between ml-4 flex-grow">
                <span class="font-bold text-sm">{{ product.name }}</span>
                <span class="text-gray-500 text-xs">{{
                  product.description
                }}</span>
                <a
                  href="#"
                  @click="$store.commit('removeProductToCart', index)"
                  class="font-semibold hover:text-red-500 text-gray-500 text-xs"
                  >Supprimer du panier</a
                >
              </div>
            </div>
            <div class="flex justify-center w-1/5">
              <span
                class="mx-2 border text-center w-8"
                v-text="product.qty"
              ></span>
            </div>
            <span class="text-center w-1/5 font-semibold text-sm">{{
              product.price / 100
            }}</span>
            <span class="text-center w-1/5 font-semibold text-sm">{{
              (product.price * product.qty) / 100
            }}</span>
          </div>

          <router-link
            :to="{ name: 'home' }"
            class="flex font-semibold text-indigo-600 text-sm mt-10"
          >
            Revenir faire les courses</router-link
          >
        </div>

        <div id="summary" class="w-1/4 px-8 py-10">
          <h1 class="font-semibold text-2xl border-b pb-8">Informations</h1>
          <div class="border-t mt-8">
            <div
              class="flex font-semibold justify-between py-6 text-sm uppercase"
            >
              <span>price total</span>
              <span>{{ totalPrice / 100 }} €</span>
            </div>
            <button
              class="
                bg-indigo-500
                font-semibold
                hover:bg-indigo-600
                py-3
                text-sm text-white
                uppercase
                w-full
              "
            >
              Passer à la caisse
            </button>
          </div>
        </div>
        
      </div>
    </div>
    <footer-section></footer-section>
  </section>
</template>

<script>

export default {
  name: "cart",

  data() {
    return {
      coupon: "",
      qty: "",
      counter: 1,
      storage_url: this.$store.state.baseURL,
      cart: this.$store.state.cart,
      componentKey: 1,
      loading: false,
      defaultAddress: [],
      endAt: null,
      startAt: new Date().getTime(),
      qrvalue: "",
      qrsize: 160,
      serverError: null,
      successMessage: null,
      paymentFormData: {
        url: "",
        amount: "",
        signature: "",
        acid: "",
        emailId: "",
        successurl: "",
        cancelurl: "",
        currency: "",
        Reference: "",
      },
    };
  },
  computed: {
    getCart() {
      // this.$store.state.cart;
      return this.$store.state.cart;
    },
    totalProduct() {
      return this.$store.state.cart.reduce(
        (acc, current) => acc + current.qty,
        0
      );
    },
    Total() {
      let total = 0;
      this.$store.state.cart.forEach((item) => {
        total += item.price * item.qty;
      });
      return total;
    },
    totalPrice() {
      return this.$store.state.cart.reduce(
        (acc, current) => acc + current.price * current.qty,
        0
      );
    },

    
  },

  methods: {
    onChange(event) {
      // console.log(event.target.value);
    },
    // updateCartQty(product, actiontype) {
    //     this.$store.commit("updateCartQty", {product, actiontype});
    // },
    increaseItemQty(product) {
      const actiontype = "+";
      this.$store.dispatch("updateCartQty", { product, actiontype });
    },
    decreaseItemQty(product) {
      const actiontype = "-";
      this.$store.dispatch("updateCartQty", { product, actiontype });
    },

    // setNewOrder() {
    //   this.loading = true;
    //   this.successMessage = "";
    //   this.serverError = "";

    //   this.$store
    //     .dispatch("setNewOrder", {
    //       amount: this.totalPrice(),
    //       cartItemList: JSON.parse(localStorage.getItem("cartItem")),
    //       useDefaultAddress: this.formData.useDefaultAddress,
    //       deliveryOption: this.formData.delivery,
    //       newAddress: this.formData.setNewAddress,
    //     })
    //     .then((response) => {
    //       // console.log(response)
    //       // this.formData = "";
    //       // this.endAt = new Date().getTime() + 10000;
    //       this.successMessage = response.data.message;
    //       this.serverError = "";
    //       this.$bvModal.show("bv-modal-example");

    //       // init variable for payment
    //       this.paymentFormData.url = response.data.data.url;
    //       this.paymentFormData.amount = this.totalPrice();
    //       this.paymentFormData.signature = response.data.data.signature;
    //       this.paymentFormData.acid = response.data.data.acid;
    //       this.paymentFormData.emailId = response.data.data.emailId;
    //       this.paymentFormData.successurl = response.data.data.successurl;
    //       this.paymentFormData.cancelurl = response.data.data.cancelurl;
    //       this.paymentFormData.currency = response.data.data.currency;
    //       this.paymentFormData.Reference = response.data.data.Reference;

    //       this.$toast.success({
    //         title: "Félicitations",
    //         message: response.data.message,
    //       });
    //       this.$store.dispatch("retrieveUserInfo").then((response) => {
    //         this.loading = false;
    //       });
    //       // this.$router.push({ name: "profile.index" });
    //     })
    //     .catch((error) => {
    //       this.loading = false;
    //       this.$toast.error({
    //         title: "Echec de connexion",
    //         message: error.response.data.message,
    //       });
    //       this.serverError = error.response.data.message;
    //       this.password = "";
    //       this.successMessage = "";
    //     });
    // },
  },
};
</script>
