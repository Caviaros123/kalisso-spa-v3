<template>
  <!-- ========================= SECTION CONTENT ========================= -->
  <main class="col-md-9">
    <article class="card mb-3">
      <div class="card-body">
        <figure class="icontext">
          <div class="icon">
            <img
              class="rounded-circle img-sm border"
              :src="storage_url + user.avatar"
            />
          </div>
          <div class="text">
            <strong> {{ user.name }} </strong> <br />
            <p class="mb-2">{{ user.email }}</p>
            <!-- <router-link
              href="#"
              :to="{
                name: 'profile.index',
                params: { tab: 'ProfileSettings' },
              }"
              class="btn btn-light btn-sm"
              >Modifier</router-link
            > -->
            <a href="" class="btn-sm btn-info " @click.stop.prevent="changeActiveTab($event = 'ProfileSettings')"
              >Modifier le profil</a
            >
          </div>
        </figure>
        <hr />
        <p v-if="this.$store.state.address.default_address == 1 ?? false">
          <i class="fa fa-map-marker text-muted"></i> &nbsp; Mon adresse:
          <br />
          {{
            address.title +
            " " +
            address.address_line1 +
            " " +
            address.state +
            " " +
            address.country
          }}&nbsp;
          <a
            href="#"
            @click.stop.prevent="changeActiveTab($event = 'ProfileAddress')"
            class="btn-link"
          >
            Editer</a
          >
        </p>

        <article class="card-group card-stat">
          <figure class="card bg"  >
            <a href="" @click.stop.prevent="changeActiveTab($event = 'ProfileOrders')">
              <div class="p-3" >
                <h4 class="title" v-text="this.$store.state.orders.length"></h4>
                <span>Commandes</span>
              </div>
            </a>
          </figure>
          <figure class="card bg">
            <a href=""  @click.stop.prevent="changeActiveTab($event = 'ProfileWishlist')">
            <div class="p-3">
              <h4 class="title" v-text="this.$store.state.wishlist.length"></h4>
              <span>Favoris</span>
            </div>
            </a>
          </figure>
          <figure class="card bg" >
          <a href=""  @click.stop.prevent="changeActiveTab($event = 'ProfileOrders')">
            <div class="p-3">
              <h4 class="title">{{ orders.length }}</h4>
              <span>En attente de livraison</span>
            </div>
            </a>
          </figure>
          <figure class="card bg">
            <a href=""  @click.stop.prevent="changeActiveTab($event = 'ProfileOrders')">
              <div class="p-3">
                <h4 class="title">{{ orders.length }}</h4>
                <span>Commandes Livrés</span>
              </div>
            </a>
          </figure>
        </article>
      </div>
      <!-- card-body .// -->
    </article>
    <!-- card.// -->

    <article class="card mb-3" v-if="this.$store.state.orders.length > 0">
      <div class="card-body">
        <h5 class="card-title mb-4">Commandes récentes</h5>
       
        <div class="row">
          <div
            class="col-md-6"
            v-for="(order, index) in this.$store.state.orders.slice(0, 4)"
            :key="index"
          >
            <figure class="itemside mb-3">
              <div class="aside">
                <a href="" @click.stop.prevent="changeActiveTab($event = 'ProfileOrders')">
                  <img
                    :src="storage_url + order.products[0].image"
                    class="border img-sm"
                  />
                  </a>
              </div>
              <figcaption class="info">
              <a href="" @click.stop.prevent="changeActiveTab($event = 'ProfileOrders')">
                <p>{{ order.transaction_id }}</p>
                <time class="text-muted"
                  ><i class="fa fa-calendar-alt"></i>
                  {{ order.created_at | formatDate }}</time
                >
                <span class="text-success">{{ order.paymentStatus }} </span>
                <div class="text-danger">
                  {{ order.products.length }} Article{{
                    order.products.length > 1 ? "s" : ""
                  }}
                </div>
                </a>
              </figcaption>
            </figure>
          </div>
          <!-- col.// -->
          <!-- col.// -->
        </div>
        <!-- row.// -->

        <a
          v-if="this.$store.state.orders.length > 4"
          href=""
          @click.stop.prevent="changeActiveTab($event = 'ProfileOrders')"
          class="btn btn-outline-primary btn-block"
        >
          Voir toutes les commandes <i class="fa fa-chevron-down"></i>
        </a>
      </div>
      <!-- card-body .// -->
    </article>
    <!-- card.// -->
  </main>
  <!-- col.// -->
</template>

<script>
// import { eventBus } from "../../../app";

export default {
  name: "ProfileUser",

  data() {
    return {
      user: [],
      address: this.$store.state.address || [],
      orders: this.$store.state.orders || [],
      storage_url: this.$store.state.baseURL,
      activeTab: "ProfileSettings",
    };
  },
  mounted() {
    //   this.loadData();
    // this.$eventBus.on("changeActiveTab", (data) => this.changeActiveTab(data));
    this.$store.dispatch("retrieveUserInfo").then((response) => {
      this.user = this.$store.state.user || [];
      // this.orders =  [];
      this.address = this.$store.state.address || [];
    });
  },
  computed: {
    swapComponent: function (component) {
      this.currentComponent = component;
    },

    // loadData(){
    //    this.user =  this.$store.state.user
    //   this.orders =  this.$store.state.orders
    //   this.address = this.$store.state.address
    //   console.log(this.user)
    // }
  },
  methods: {
    changeActiveTab: function (data) {
      window.eventBus.$emit("activeTabChanged", data);
      return
    },
    // retrieveUser(){

    //   // console.log(vm.$store.state.user)
    //   this.user = this.$store.state.user ? this.$store.state.user : [];
    //   this.orders = this.$store.state.orders ? this.$store.state.orders : [];
    //   this.address = this.$store.state.address ? this.$store.state.address : [];
    // }
  },
};
</script>