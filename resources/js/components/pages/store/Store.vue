<template>
  <div class="px-0 page-wrapper">
    <Spinner v-if="loading" />
    <nav-section></nav-section>
    <div v-if="serverError || successMessage">
      {{ serverError || successMessage }}
      {{ getStoreInfo }}
    </div>
    <div class="row p-0">
      <div class="col-md-12 mx-auto">
        <!-- Profile widget -->
        <div class="bg-white shadow rounded overflow-hidden">
          <div class="px-4 pt-0 pb-4 cover">
            <div class="media align-items-end profile-head">
              <div class="profile mr-3">
                
                <img
                  :src="baseUrl + getStoreInfo.logo"
                  :alt="'Logo'+ getStoreInfo.name "
                  width="130"
                  class="rounded mb-2 img-thumbnail"
                />
                <a href="#" v-if="this.$store.getters.loggedIn" class="btn btn-outline-danger btn-sm btn-block"
                  ><i class="fas fa-edit"></i> Modifier</a
                >
              </div>
              <div
                class="
                  media-body
                  mb-5
                  text-white
                  d-flex
                  justify-content-between
                "
              >
                <div class="mb-4">
                  <h1 class="mt-0 mb-0">{{ getStoreInfo.name }}</h1>
                  <p class="small">{{ getStoreInfo.category }}</p>
                </div>
                <p class="b mt-4 d-none d-md-block">
                  <i class="fas fa-map-marker-alt mr-2"></i
                  >{{ getStoreInfo.location }} | {{ getStoreInfo.address }}
                </p>
              </div>
            </div>
          </div>
          <div class="bg-light p-4 d-flex justify-content-between">
            <div class="px-2 desc">
              <h5 class="mb-0">A propos de {{ getStoreInfo.name }}</h5>

              <p class="font-italic mb-0">
                Catégorie : {{ getStoreInfo.category }}
              </p>
              <p class="font-italic mb-0">{{ getStoreInfo.description }}</p>
              <p class="font-italic mb-0">
                {{ getStoreInfo.location }}
              </p>
            </div>
            <ul class="list-inline mb-0 text-center">
              <li class="list-inline-item">
                <h5 class="font-weight-bold mb-0 d-block">
                  {{ getStoreInfo.products.length }}
                </h5>
                <small class="text-muted">
                  <i class="fas fa-image mr-1"></i>Produits</small
                >
              </li>
              <li class="list-inline-item">
                <h5 class="font-weight-bold mb-0 d-block">0</h5>
                <small class="text-muted">
                  <i class="fas fa-user mr-1"></i>Abonnés</small
                >
              </li>
              <li class="list-inline-item">
                <h5 class="font-weight-bold mb-0 d-block">0</h5>
                <small class="text-muted">
                  <i class="fas fa-redo mr-1"></i>Vendues</small
                >
              </li>
            </ul>
          </div>
          <div class="py-4 px-4">
            <!-- =============== SECTION ITEMS =============== -->
            <section class="padding-bottom px-3">
              <header
                class="
                  section-heading
                  d-flex
                  align-items-center
                  justify-content-between
                  mb-3
                "
              >
                <h4 class="title-section text-uppercase">
                  Produits Recommendés
                </h4>
                <a href="#" class="btn btn-link title-section bg text-muted">Voir tout</a>
              </header>

              <div class="container px-4">
                <carousel
                  :navigationEnabled="true"
                  :paginationPadding="5"
                  easing="linear"
                  :speed="300"
                  :minSwipeDistance="70"
                  :perPage="6"
                  :resistanceCoef="1"
                >
                  <slide
                    :class="'p-2'"
                    v-for="(product, index) in getStoreInfo.products.slice(
                      0,
                      40
                    )"
                    :key="index"
                  >
                    <div class="card card-sm prod-bg p-0 m-0 card-product-grid">
                      <router-link
                        :to="{
                          name: 'products.show',
                          params: { slug: product.slug },
                        }"
                        class="img-wrap"
                      >
                        <vue-load-image>
                          <img
                            slot="image"
                            class="prod-pic fit-image"
                            :src="storage_url + product.image"
                          />
                          <img
                            slot="preloader"
                            width="40"
                            height="40"
                            class="
                              justify-content-center
                              align-items-center
                              mx-auto
                              mt-4
                              text-center
                            "
                            src="/images/xloading.gif"
                          />
                          <div slot="error">error message</div>
                        </vue-load-image>
                        <!-- <img class="img" v-bind:src="storage_url + product.image" /> -->
                      </router-link>
                      <figcaption class="info-wrap">
                        <router-link
                          :to="{
                            name: 'products.show',
                            params: { slug: product.slug },
                          }"
                          class="title"
                          >{{ product.name }}</router-link
                        >
                        <div class="price mt-1">
                          {{ presentPrice(product.price) }}
                        </div>
                        <!-- price-wrap.// -->
                      </figcaption>
                    </div>
                  </slide>
                </carousel>
              </div>
              <!-- row.// -->
            </section>
            <!-- =============== SECTION ITEMS .//END =============== -->
          </div>
        </div>
      </div>
    </div>
    <footer-section></footer-section>
  </div>
</template>

<script>
import { Carousel, Slide } from "vue-carousel";
import { VueperSlides, VueperSlide } from "vueperslides";
import "vueperslides/dist/vueperslides.css";

export default {
  data() {
    return {
      loading: false,
      getStoreInfo: [],
      serverError: "",
      successMessage: "",
      baseUrl: "https://kalisso.com",
      storage_url: this.$store.state.baseURL,
    };
  },
  components: {
    Carousel,
    Slide,
    VueperSlides,
    VueperSlide,
  },
  mounted() {
    this.loading = true;
    this.$store
      .dispatch("findStore", {
        slug: this.$route.params.slug,
      })
      .then((response) => {
        this.getStoreInfo = response.data.data[0];
        console.log(response.data.data[0]);
        this.loading = false;
      })
      .catch((error) => {
        this.loading = false;
        this.serverError = error;
      });
  },
  methods: {},
};
</script>

<style lang="scss" scoped>
.profile-head {
  transform: translateY(5rem);
}
.desc {
  margin-left: 10%;
}
.cover {
  background-image: url(https://images.unsplash.com/photo-1530305408560-82d13781b33a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1352&q=80);
  background-size: cover;
  background-repeat: no-repeat;
}
</style>