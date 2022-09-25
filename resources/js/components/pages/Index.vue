<template>
  <div class="px-0 page-wrapper" >
    
    <nav-section></nav-section>

    <home-header-and-carousel></home-header-and-carousel>
    <!-- =============== SECTION DEAL =============== -->
    <section class="padding-bottom">
      <div class="card card-deal">
        <div class="col-heading content-body">
          <header class="section-heading">
            <h3 class="section-title">Ventes Flash</h3>
            <p>Se termine dans</p>
          </header>
          <!-- sect-heading -->
          <div class="timer">
            <div><span class="num">04</span> <small>Jours</small></div>
            <div><span class="num">12</span> <small>Heures</small></div>
            <div><span class="num">58</span> <small>Min</small></div>
            <div><span class="num">02</span> <small>Sec</small></div>
          </div>
        </div>
        <!-- col.// -->
        <div class="row no-gutters items-wrap">
          <div
            class="col-md col-6"
            v-for="(category, index) in categories.slice(0, 5)"
            :key="index"
          >
            <figure class="card-product-grid card-sm">
              <router-link
                :to="{
                  name: 'category.index',
                  params: { selected: category.slug },
                }"
                class="img-wrap"
              >
                <div class="d-flex justify-content-center text-center">
                  <img
                    :src="storage_url + category.cat_img"
                    :class="'mx-auto h-50 w-50 pt-5 img-fluid d-block'"
                  />
                </div>
              </router-link>
              <div class="text-wrap p-3">
                <router-link
                  :to="{
                    name: 'category.index',
                    params: { selected: category.slug },
                  }"
                  class="title"
                  >{{ category.name }}</router-link
                >
                <span class="badge badge-danger"> -20% </span>
              </div>
            </figure>
          </div>
        </div>
      </div>
    </section>
    <!-- =============== SECTION DEAL // END =============== -->

     <section class="padding-bottom px-3" v-if="productsLastSeen.length !== 0">
      <header class="section-heading heading-line">
        <h4 class="title-section text-uppercase">Produits vu récement</h4>
      </header>
      <div class="container px-4">
        <carousel
          :navigationEnabled="true"
          :paginationPadding="5"
          easing="linear"
          :speed="300"
          :minSwipeDistance="70"
          :perPage="6"
          :perPageCustom="[1199, 2]"
          :resistanceCoef="3"
        >
          <slide
            :class="'p-2'"
            v-for="(product, index) in productsLastSeen"
            :key="index"
          >
            <div class="card card-sm card-product-grid">
              <router-link
                :to="{ name: 'products.show', params: { slug: product.slug } }"
                class="img-wrap"
              >
                <vue-load-image>
                  <img slot="image" class="fill" :src='storage_url + product.image' />
                  <img slot="preloader" width="40" height="40" class="justify-content-center align-items-center mx-auto mt-4 text-center" src="/images/xloading.gif" />
                  <div slot="error">error message</div>
                </vue-load-image>
                <!-- <img class="fill" v-bind:src="storage_url + product.image" /> -->
              </router-link>
              <figcaption class="info-wrap">
                <a href="#" class="title">{{ product.name }}</a>
                <div class="price mt-1">{{ presentPrice(product.price) }}</div>
                <!-- price-wrap.// -->
              </figcaption>
            </div>
          </slide>
        </carousel>
      </div>
    </section>


    <section class="padding-bottom px-3">
      <header class="section-heading heading-line">
        <h4 class="title-section text-uppercase">Nouveautés</h4>
      </header>
      <div class="container px-4">
        <carousel
          :navigationEnabled="true"
          :paginationPadding="5"
          easing="linear"
          :speed="300"
          :minSwipeDistance="70"
          :perPage="6"
          :perPageCustom="[1199, 2]"
          :resistanceCoef="3"
        >
          <slide
            :class="'p-2'"
            v-for="(product, index) in products.slice(0, 18)"
            :key="index"
          >
            <div class="card card-sm card-product-grid">
              <router-link
                :to="{ name: 'products.show', params: { slug: product.slug } }"
                class="img-wrap"
              >
                <vue-load-image>
                  <img slot="image" class="fill" :src='storage_url + product.image' />
                  <img slot="preloader" width="40" height="40" class="justify-content-center align-items-center mx-auto mt-4 text-center" src="/images/xloading.gif" />
                  <div slot="error">error message</div>
                </vue-load-image>
                <!-- <img class="fill" v-bind:src="storage_url + product.image" /> -->
              </router-link>
              <figcaption class="info-wrap">
                <a href="#" class="title">{{ product.name }}</a>
                <div class="price mt-1">{{ presentPrice(product.price) }}</div>
                <!-- price-wrap.// -->
              </figcaption>
            </div>
          </slide>
        </carousel>
      </div>
    </section>

    <!-- =============== SECTION 1 =============== -->
    <section class="padding-bottom px-3" hidden>
      <header class="section-heading heading-line">
        <h4 class="title-section text-uppercase">Apparel</h4>
      </header>

      <div class="card card-home-category">
        <div class="row no-gutters">
          <div class="col-md-3">
            <div class="home-category-banner bg-light-orange">
              <h5 class="title">Best trending clothes only for summer</h5>
              <p>
                Consectetur adipisicing elit, sed do eiusmod tempor incididunt
                ut labore et dolore magna aliqua.
              </p>
              <a href="#" class="btn btn-outline-primary rounded-pill"
                >Source now</a
              >
              <img src="images/items/2.jpg" class="img-bg" />
            </div>
          </div>
          <!-- col.// -->
          <div class="col-md-9">
            <ul class="row no-gutters bordered-cols">
              <li class="col-6 col-lg-3 col-md-4">
                <a href="#" class="item">
                  <div class="card-body">
                    <h6 class="title">
                      Well made women clothes with trending collection
                    </h6>
                    <img class="img-sm float-right" src="images/items/1.jpg" />
                    <p class="text-muted">
                      <i class="fa fa-map-marker-alt"></i> Guanjou, China
                    </p>
                  </div>
                </a>
              </li>
              <li class="col-6 col-lg-3 col-md-4">
                <a href="#" class="item">
                  <div class="card-body">
                    <h6 class="title">
                      Great clothes with trending collection
                    </h6>
                    <img class="img-sm float-right" src="images/items/2.jpg" />
                    <p class="text-muted">
                      <i class="fa fa-map-marker-alt"></i> Beijing, China
                    </p>
                  </div>
                </a>
              </li>
              <li class="col-6 col-lg-3 col-md-4">
                <a href="#" class="item">
                  <div class="card-body">
                    <h6 class="title">Demo clothes with sample collection</h6>
                    <img class="img-sm float-right" src="images/items/3.jpg" />
                    <p class="text-muted">
                      <i class="fa fa-map-marker-alt"></i> Tokyo, Japan
                    </p>
                  </div>
                </a>
              </li>
              <li class="col-6 col-lg-3 col-md-4">
                <a href="#" class="item">
                  <div class="card-body">
                    <h6 class="title">
                      Home and kitchen electronic stuff collection
                    </h6>
                    <img class="img-sm float-right" src="images/items/4.jpg" />
                    <p class="text-muted">
                      <i class="fa fa-map-marker-alt"></i> Tashkent, Uzb
                    </p>
                  </div>
                </a>
              </li>
              <li class="col-6 col-lg-3 col-md-4">
                <a href="#" class="item">
                  <div class="card-body">
                    <h6 class="title">
                      Home and kitchen electronic stuff collection
                    </h6>
                    <img class="img-sm float-right" src="images/items/5.jpg" />
                    <p class="text-muted">
                      <i class="fa fa-map-marker-alt"></i> London, Britain
                    </p>
                  </div>
                </a>
              </li>
              <li class="col-6 col-lg-3 col-md-4">
                <a href="#" class="item">
                  <div class="card-body">
                    <h6 class="title">
                      Home and kitchen electronic stuff collection
                    </h6>
                    <img class="img-sm float-right" src="images/items/6.jpg" />
                    <p class="text-muted">
                      <i class="fa fa-map-marker-alt"></i> Guanjou, China
                    </p>
                  </div>
                </a>
              </li>
              <li class="col-6 col-lg-3 col-md-4">
                <a href="#" class="item">
                  <div class="card-body">
                    <h6 class="title">
                      Well made clothes with trending collection
                    </h6>
                    <img class="img-sm float-right" src="images/items/7.jpg" />
                    <p class="text-muted">
                      <i class="fa fa-map-marker-alt"></i> Hong Kong, China
                    </p>
                  </div>
                </a>
              </li>
              <li class="col-6 col-lg-3 col-md-4">
                <a href="#" class="item">
                  <div class="card-body">
                    <h6 class="title">
                      Home and kitchen interior stuff collection
                    </h6>
                    <img class="img-sm float-right" src="images/items/6.jpg" />
                    <p class="text-muted">
                      <i class="fa fa-map-marker-alt"></i> Guanjou, China
                    </p>
                  </div>
                </a>
              </li>
            </ul>
          </div>
          <!-- col.// -->
        </div>
        <!-- row.// -->
      </div>
      <!-- card.// -->
    </section>
    <!-- =============== SECTION 1 END =============== -->

    <!-- =============== SECTION 2 =============== -->
    <section class="padding-bottom px-3" hidden>
      <header class="section-heading heading-line">
        <h4 class="title-section text-uppercase">Electronics</h4>
      </header>

      <div class="card card-home-category">
        <div class="row no-gutters">
          <div class="col-md-3">
            <div class="home-category-banner bg-light-orange">
              <h5 class="title">Machinery items for manufacturers</h5>
              <p>
                Consectetur adipisicing elit, sed do eiusmod tempor incididunt
                ut labore et dolore magna aliqua.
              </p>
              <a href="#" class="btn btn-outline-primary rounded-pill"
                >Source now</a
              >
              <img src="images/items/14.jpg" class="img-bg" />
            </div>
          </div>
          <!-- col.// -->
          <div class="col-md-9">
            <ul class="row no-gutters bordered-cols">
              <li class="col-6 col-lg-3 col-md-4">
                <a href="#" class="item">
                  <div class="card-body">
                    <h6 class="title">Well made electronic stuff collection</h6>
                    <img class="img-sm float-right" src="images/items/7.jpg" />
                    <p class="text-muted">
                      <i class="fa fa-map-marker-alt"></i> Tokyo, Japan
                    </p>
                  </div>
                </a>
              </li>
              <li class="col-6 col-lg-3 col-md-4">
                <a href="#" class="item">
                  <div class="card-body">
                    <h6 class="title">
                      Another demo text for item stuff goes here
                    </h6>
                    <img class="img-sm float-right" src="images/items/8.jpg" />
                    <p class="text-muted">
                      <i class="fa fa-map-marker-alt"></i> Hong Kong, China
                    </p>
                  </div>
                </a>
              </li>
              <li class="col-6 col-lg-3 col-md-4">
                <a href="#" class="item">
                  <div class="card-body">
                    <h6 class="title">
                      Home and kitchen electronic stuff collection
                    </h6>
                    <img class="img-sm float-right" src="images/items/9.jpg" />
                    <p class="text-muted">
                      <i class="fa fa-map-marker-alt"></i> Tashkent, Uzb
                    </p>
                  </div>
                </a>
              </li>
              <li class="col-6 col-lg-3 col-md-4">
                <a href="#" class="item">
                  <div class="card-body">
                    <h6 class="title">Group of electronic stuff collection</h6>
                    <img class="img-sm float-right" src="images/items/10.jpg" />
                    <p class="text-muted">
                      <i class="fa fa-map-marker-alt"></i> Guanjou, China
                    </p>
                  </div>
                </a>
              </li>
              <li class="col-6 col-lg-3 col-md-4">
                <a href="#" class="item">
                  <div class="card-body">
                    <h6 class="title">
                      Home and kitchen electronic stuff collection
                    </h6>
                    <img class="img-sm float-right" src="images/items/11.jpg" />
                    <p class="text-muted">
                      <i class="fa fa-map-marker-alt"></i> Guanjou, China
                    </p>
                  </div>
                </a>
              </li>
              <li class="col-6 col-lg-3 col-md-4">
                <a href="#" class="item">
                  <div class="card-body">
                    <h6 class="title">
                      Home and kitchen electronic stuff collection
                    </h6>
                    <img class="img-sm float-right" src="images/items/12.jpg" />
                    <p class="text-muted">
                      <i class="fa fa-map-marker-alt"></i> Guanjou, China
                    </p>
                  </div>
                </a>
              </li>
              <li class="col-6 col-lg-3 col-md-4">
                <a href="#" class="item">
                  <div class="card-body">
                    <h6 class="title">
                      Home and kitchen electronic stuff collection
                    </h6>
                    <img class="img-sm float-right" src="images/items/1.jpg" />
                    <p class="text-muted">
                      <i class="fa fa-map-marker-alt"></i> Guanjou, China
                    </p>
                  </div>
                </a>
              </li>
              <li class="col-6 col-lg-3 col-md-4">
                <a href="#" class="item">
                  <div class="card-body">
                    <h6 class="title">
                      Home and kitchen electronic stuff collection
                    </h6>
                    <img class="img-sm float-right" src="images/items/2.jpg" />
                    <p class="text-muted">
                      <i class="fa fa-map-marker-alt"></i> Guanjou, China
                    </p>
                  </div>
                </a>
              </li>
            </ul>
          </div>
          <!-- col.// -->
        </div>
        <!-- row.// -->
      </div>
      <!-- card.// -->
    </section>
    <!-- =============== SECTION 2 END =============== -->

    <!-- =============== SECTION ITEMS =============== -->
    <section class="padding-bottom px-3">
      <header class="section-heading heading-line">
        <h4 class="title-section text-uppercase">Produits Recommendés</h4>
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
            v-for="(product, index) in products.slice(0, 40).sort(() => Math.random() - 0.5)"
            :key="index"
          >
            <div class="card card-sm prod-bg p-0 m-0 card-product-grid">
              <router-link
                :to="{ name: 'products.show', params: { slug: product.slug } }"
                class="img-wrap "
              >
                <vue-load-image>
                  <img slot="image" class="prod-pic fit-image" :src='storage_url + product.image' />
                  <img slot="preloader" width="40" height="40" class="justify-content-center align-items-center mx-auto mt-4 text-center" src="/images/xloading.gif" />
                  <div slot="error">error message</div>
                </vue-load-image>
                <!-- <img class="img" v-bind:src="storage_url + product.image" /> -->
              </router-link>
              <figcaption class="info-wrap">
                  <router-link
                :to="{ name: 'products.show', params: { slug: product.slug } }" class="title">{{ product.name }}</router-link>
                <div class="price mt-1">{{ presentPrice(product.price) }}</div>
                <!-- price-wrap.// -->
              </figcaption>
            </div>
          </slide>
        </carousel>
      </div>
      <!-- row.// -->
    </section>
    <!-- =============== SECTION ITEMS .//END =============== -->

    <!-- =============== SECTION SERVICES =============== -->
    <section class="padding-bottom px-3" hidden>
      <header class="section-heading heading-line">
        <h4 class="title-section text-uppercase">SERVICES COMMERCIAUX</h4>
      </header>

      <div class="row">
        <div class="col-md-3 col-sm-6">
          <article class="card card-post">
            <img src="images/posts/1.jpg" class="card-img-top" />
            <div class="card-body">
              <h6 class="title">Assurance commerciale</h6>
              <p class="small text-uppercase text-muted">
                Protection de vos commandes
              </p>
            </div>
          </article>
          <!-- card.// -->
        </div>
        <!-- col.// -->
        <div class="col-md-3 col-sm-6">
          <article class="card card-post">
            <img src="images/posts/2.jpg" class="card-img-top" />
            <div class="card-body">
              <h6 class="title">Paiements Securisés</h6>
              <p class="small text-uppercase text-muted">Solution K-Pay</p>
            </div>
          </article>
          <!-- card.// -->
        </div>
        <!-- col.// -->
        <div class="col-md-3 col-sm-6">
          <article class="card card-post">
            <img src="images/posts/3.jpg" class="card-img-top" />
            <div class="card-body">
              <h6 class="title">Service après ventes</h6>
              <p class="small text-uppercase text-muted">Garantie</p>
            </div>
          </article>
          <!-- card.// -->
        </div>
        <!-- col.// -->
        <div class="col-md-3 col-sm-6">
          <article class="card card-post">
            <img src="images/posts/4.jpg" class="card-img-top" />
            <div class="card-body">
              <h6 class="title">Transport maritime et aérien</h6>
              <p class="small text-uppercase text-muted">Services logistique</p>
            </div>
          </article>
          <!-- card.// -->
        </div>
        <!-- col.// -->
      </div>
      <!-- row.// -->
    </section>
    <!-- =============== SECTION SERVICES .//END =============== -->

    <!-- =============== SECTION REGION =============== -->
    <!-- <section class="padding-bottom">
      <header class="section-heading heading-line">
        <h4 class="title-section text-uppercase">Choose region</h4>
      </header>

      <ul class="row mt-4">
        <li class="col-md col-6">
          <a href="#" class="icontext">
            <img class="icon-flag-sm" src="images/icons/flags/CN.png" />
            <span>China</span>
          </a>
        </li>
        <li class="col-md col-6">
          <a href="#" class="icontext">
            <img class="icon-flag-sm" src="images/icons/flags/DE.png" />
            <span>Germany</span>
          </a>
        </li>
        <li class="col-md col-6">
          <a href="#" class="icontext">
            <img class="icon-flag-sm" src="images/icons/flags/AU.png" />
            <span>Australia</span>
          </a>
        </li>
        <li class="col-md col-6">
          <a href="#" class="icontext">
            <img class="icon-flag-sm" src="images/icons/flags/RU.png" />
            <span>Russia</span>
          </a>
        </li>
        <li class="col-md col-6">
          <a href="#" class="icontext">
            <img class="icon-flag-sm" src="images/icons/flags/IN.png" />
            <span>India</span>
          </a>
        </li>
        <li class="col-md col-6">
          <a href="#" class="icontext">
            <img class="icon-flag-sm" src="images/icons/flags/GB.png" />
            <span>England</span>
          </a>
        </li>
        <li class="col-md col-6">
          <a href="#" class="icontext">
            <img class="icon-flag-sm" src="images/icons/flags/TR.png" />
            <span>Turkey</span>
          </a>
        </li>
        <li class="col-md col-6">
          <a href="#" class="icontext">
            <img class="icon-flag-sm" src="images/icons/flags/UZ.png" />
            <span>Uzbekistan</span>
          </a>
        </li>
        <li class="col-md col-6">
          <a href="#" class="icontext">
            <i class="mr-3 fa fa-ellipsis-h"></i> <span>More regions</span>
          </a>
        </li>
      </ul>
    </section> -->
    <!-- =============== SECTION REGION .//END =============== -->
    <!-- // check if user is logged in -->

    <section class="padding-bottom px-3" v-if="isLoggedIn()">
      <div class="my-4 text-center m-auto">
        <div class="card">
          <div class="card-body">
            <h5>
              Identifiez-vous pour une meilleure expériencce d'achat en ligne
            </h5>
            <div class="p-3">
              <router-link
                class="btn-lg pl-3 pr-3 btn-success"
                :to="{ name: 'login' }"
                >Connectez-vous</router-link
              >
            </div>
          </div>
        </div>
      </div>
    </section>

    <article class="my-4">
      <img src="/images/banners/ad-sm.png" class="w-100" />
    </article>

    <footer-section></footer-section>
  </div>
</template>

<script>
// import VueLoadImage from 'vue-load-image';
import { Carousel, Slide } from "vue-carousel";
import { VueperSlides, VueperSlide } from "vueperslides";
import "vueperslides/dist/vueperslides.css";


export default {
  data() {
    return {
      lastSeenProducts: [],
      storage_url: this.$store.state.baseURL,
    };
  },
  components: {
    Carousel,
    Slide,
    VueperSlides,
    VueperSlide,
  },
  computed: {
    products() {
      return this.$store.state.products;
    },
    categories() {
      return this.$store.state.categories;
    },
    productsLastSeen(){
      return JSON.parse(localStorage.getItem('lastSeenProducts')) || []
    },
    
  },
  methods: {
    isLoggedIn() {
      return localStorage.getItem("isLoggedIn");
    },
  }
};
</script>

<style scoped>

.card-img {
  background-size: cover !important;
}

.image-bg {
  width: 100px;
}

.fit-image {
  object-fit: cover;
  width: 100%;
  background-size: cover;
}

.prod-pic {
  width: 100px;
  height: 100px;
  margin: 0;
  padding: 0;
  cursor: pointer;
}

.prod-bg {
  width: 100%;
  height: 100px;
  padding: 0px;
  background-size: cover;
  background-color: #ffffff;
}

.fat-img {
  width: 94px;
  height: 100px;
}
</style>