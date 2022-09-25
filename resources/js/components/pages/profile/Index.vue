<template>
  <div class="page-wrapper">
    <nav-section></nav-section>
    <profile-header></profile-header>
    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content padding-y">
      <div class="container">
        <div class="row">
           <aside class="col-md-3">
                <nav class="list-group">
                    <button class="list-group-item" :class="activeTab === 'ProfileUser' ? 'active' :''" @click="activeTab = 'ProfileUser' " > Aperçu du compte  </button>
                    <button class="list-group-item" :class="activeTab === 'ProfileAddress' ? 'active' :''" @click="activeTab = 'ProfileAddress' " > Mon Adresse </button>
                    <button class="list-group-item" :class="activeTab === 'ProfileOrders' ? 'active' :''" @click="activeTab = 'ProfileOrders' " href="#"> Mes Commandes <span v-show="this.$store.state.orders.length >= 1" class="badge badge-danger float-right">{{this.$store.state.orders.length}}</span></button>
                    <button class="list-group-item" :class="activeTab === 'ProfileWishlist' ? 'active' :''" @click="activeTab = 'ProfileWishlist' " href="#"> Mes Favoris <span v-show="this.$store.state.wishlist.length >= 1" class="badge badge-light float-right">{{this.$store.state.wishlist.length}}</span></button>
                    <!-- <button class="list-group-item" :class="activeTab === 'ProfileSeller' ? 'active' :''" @click="activeTab = 'ProfileSeller' " href="#"> Mes Produits </button> -->
                    <button class="list-group-item" :class="activeTab === 'ProfileSettings' ? 'active' :''" @click="activeTab = 'ProfileSettings' " href="#"> Paramètres </button>
                    <!-- <router-link :to="{ name: 'logout'}" class="list-group-item" href="#"> Déconnexion </router-link> -->
                </nav>
                <br>
                <a href="/admin"  class="btn btn-danger btn-block" > <i class="fab fa-kickstarter"></i> <span class="text">Mon K-Panel</span> </a>
                <br>
                <router-link :to="{ name: 'logout'}"  class="btn btn-light btn-block" > <i class="fa fa-power-off text-danger"></i> <span class="text">Déconnexion</span> </router-link>
                <br>
            </aside> <!-- col.// -->

          <component :is='activeTab'></component>
          <!-- col.// -->
        </div>
      </div>
      <!-- container .//  -->
    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->
    <footer-section></footer-section>
  </div>
</template>

<script>
import ProfileAddress from "./Address";
import ProfileOrders from "./Orders";
// import ProfileSeller from "./Seller";
import ProfileSettings from "./Settings";
import ProfileWishlist from "./Wishlist";
import ProfileUser from "./Profile";

// import { eventBus } from '../../../app'

export default {
  name: "ProfileIndex",
  props: {
    setNewTab: {
      type: String,
    },
  },
  components: {
    ProfileAddress,
    ProfileOrders,
    // ProfileSeller,
    ProfileSettings,
    ProfileWishlist,
    ProfileUser,
  },
  created(){
    window.eventBus.$on('activeTabChanged', (data)=>{
      this.activeTab = data
    })
  },
  mounted(){
    //check if logged in
    if (localStorage.getItem("isLoggedIn") === "true") {
        //call get user data
        this.$store.dispatch("retrieveUserInfo");
    }
  },
  data() {
      return {
          activeTab: this.setNewTab || 'ProfileUser'
      }
  },
  methods: {
    changeActiveTab(data){
        this.activeTab = data
    }
  },
  
};
</script>

<style scoped>
    .list-group, button{
        text-align: left;
    }
</style>
