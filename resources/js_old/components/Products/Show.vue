<template>
  <div class="page-wrapper">
    <Spinner v-if="loading"/>
    <nav-section></nav-section>

    <section class="py-3 bg-light">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Accueil</a></li>
          <li class="breadcrumb-item">
            <a href="#">Catégories</a>
          </li>
          <!-- <li class="breadcrumb-item">
            <a href="#">Sub category</a>
          </li> -->
          <li class="breadcrumb-item">
            <a href="#" v-text="retrieveCategoryName(product)"></a>
          </li>
          <!-- <li class="breadcrumb-item">
            <a href="#">Sub category</a>
          </li> -->
          <li class="breadcrumb-item active" aria-current="page">
            {{ product.name }}
          </li>
        </ol>
      </div>
    </section>

    <!-- ========================= SECTION CONTENT ========================= -->
    <section
      class="section-content bg-white padding-y"
      @load="checkProductLiked({ product })"
    >
      <div class="container">
        <!-- ============================ ITEM DETAIL ======================== -->
        <div class="row">
          <aside class="col-md-6">
            <div class="card">
              <article class="gallery-wrap">
                <div class="img-big-wrap">
                  <div>
                    <a href="#">
                      <img
                        class="xzoom"
                        :src="storage_url + product.image.replace('-small', '')"
                        :xoriginal="
                          storage_url + product.image.replace('-small', '')
                        "
                      />
                    </a>
                  </div>
                </div>
                <!-- slider-product.// -->
                <div class="xzoom-thumbs thumbs-wrap">
                  <a href="#" class="item-thumb fill">
                    <img
                      class="xzoom-gallery fill"
                      :src="storage_url + product.image"
                      :xoriginal="
                        (
                          storage_url + product.image.replace('.', '-small.')
                        ).toString()
                      "
                    />
                  </a>
                  <a
                    href="#"
                    class="item-thumb fill"
                    width=""
                    v-for="img in JSON.parse(product.images)"
                    :key="img"
                  >
                    <img
                      class="xzoom-gallery fill"
                      :src="storage_url + img"
                      :xpreview="
                        (storage_url + img.replace('.', '-small.')).toString()
                      "
                    />
                  </a>
                </div>
                <!-- slider-nav.// -->
              </article>
              <!-- gallery-wrap .end// -->
            </div>
            <!-- card.// -->
          </aside>
          <!-- <aside class="col-md-6">
            <div class="card m-4">
              
                <div class="gallery-wrap">
                  <div class="img-big-wrap">
                  <ProductZoomer
                        :class="'img-fluid p-0 m-0 w-50'"
                        :base-images="images"
                        :base-zoomer-options="zoomerOptions"
                      />

                  </div>
                </div>

            </div>
          </aside> -->
          <main class="col-md-6">
            <article class="product-info-aside">
              <h2 class="title mt-3" v-text="product.name.toString()"></h2>
              <p v-html="product.details"></p>
              <div class="rating-wrap my-3">
                <small
                  class="label-rating text-muted"
                  v-if="product.review !== null"
                  >{{ product.review.length }} Commentaires</small
                >
                <small
                  class="label-rating text-success"
                  v-if="product.product_sale !== 0"
                >
                  <i class="fa fa-clipboard-check"></i>
                  {{ product.product_sale }} Vendue{{
                    product.product_sale > 2 ? "s" : ""
                  }} </small
                ><br /><br />
                <small class="badge badge-warning pr-3">
                  <i class="fas fa-map-marker-alt pr-2 pl-2"></i>
                  {{ product.location }}
                </small>
              </div>
              <!-- rating-wrap.// -->

              <div class="mb-3">
                <var class="price h4">{{ presentPrice(product.price) }}</var>
                <span class="text-muted">Tous frais inclus</span>
              </div>
              <!-- price-detail-wrap .// -->

              <p v-html="product.description"></p>

              <dl class="row" v-if="product.options">
                <dt class="col-sm-3">Manufacturer</dt>
                <dd class="col-sm-9">
                  <a href="#">Great textile Ltd.</a>
                </dd>

                <dt class="col-sm-3">Article number</dt>
                <dd class="col-sm-9">596 065</dd>

                <dt class="col-sm-3">Guarantee</dt>
                <dd class="col-sm-9">2 year</dd>

                <dt class="col-sm-3">Delivery time</dt>
                <dd class="col-sm-9">3-4 days</dd>

                <dt class="col-sm-3">Availabilty</dt>
                <dd class="col-sm-9">in Stock</dd>
              </dl>

              <div class="form-row mt-4">
                <!-- <div class="form-group col-md flex-grow-0">
                      <div class="input-group mb-3 input-spinner">
                          <div class="input-group-prepend">
                              <button
                                  class="btn btn-light"
                                  type="button"
                                  id="button-plus"
                                    @click="incrementCounter"
                              >
                                  +
                              </button>
                          </div>
                          <input
                              type="text"
                              class="form-control"
                              v-model="counter"
                          />
                          <div class="input-group-append">
                              <button
                                  class="btn btn-light"
                                  type="button"
                                  id="button-minus"
                                  @click="decrementCounter"
                              >
                                  &minus;
                              </button>
                          </div>
                      </div>
                  </div> -->
                <!-- col.// -->
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
                      <a
                        href="#!"
                        class="btn btn-primary form-control"
                        v-if="product.stock > 0"
                        @click.stop.prevent="addToCart()"
                      >
                        <i class="fas fa-shopping-cart"></i>
                        <span class="text">Ajoutez au panier</span>
                      </a>

                </div>
                <div class="form-group d-none d-md-block">
                  <a
                    href=""
                    class="btn btn-primary"
                    v-if="product.stock > 0"
                    @click.stop.prevent="addToCart()"
                  >
                    <i class="fas fa-shopping-cart"></i>
                    <span class="text">Ajoutez au panier</span>
                  </a>

                  <a
                    href="#"
                    class="btn invalid disabled"
                    v-if="product.stock == 0"
                  >
                    <i class="fas fa-shopping-cart"></i>
                    <span v-text="'Rupture de stock'"></span>
                  </a>
                  <button
                    type="button"
                    class="btn btn-light"
                    @click.stop.prevent="setLike(product.id)"
                  >
                    <!-- <i class="fas fa-heart-alt fa-3x"></i> -->
                    <i
                      :class="
                        like === true
                          ? 'far fa-heart fa-2x text-danger'
                          : 'fa fa-heart fa-2x text-danger'
                      "
                    ></i>
                  </button>
                  <div class="py-5">
                    <!-- <star-rating ></star-rating> -->
                    <div
                      style="
                        padding-top: 10px;
                        cursor: pointer;
                        margin-bottom: 20px;
                        color: grey;
                      "
                    >
                      <p class="b h5 py-2">
                        Noter ce produit <br />
                        <small>Donnez votre avis aux utilisateurs</small>
                      </p>
                      <star-rating
                        v-model="boundRating"
                        text-class="custom-text "
                      ></star-rating>
                    </div>
                    <a class="py-2 text-muted" href="#" @click="boundRating = 0"
                      >Rédiger un avis</a
                    >
                  </div>
                </div>

                <!-- col.// -->
              </div>
              <!-- row.// -->
            </article>
            <!-- product-info-aside .// -->
          </main>
          <!-- col.// -->
        </div>
        <!-- row.// -->

        <!-- ================ ITEM DETAIL END .// ================= -->
      </div>
      <!-- container .//  -->
    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->
    <section class="padding-bottom px-3" v-if="productsLastSeen.length !== 0">
      <div class="container px-4">
        <header class="section-heading heading-line">
          <h4 class="title-section text-uppercase">Produits vu récement</h4>
        </header>
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
                  <img
                    slot="image"
                    class="fill fit"
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
    <!-- ========================= SECTION  ========================= -->
    <section v-bind:class="'section-name padding-y bg'" hidden>
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <h5 class="title-description">Description</h5>

            <p v-html="product.description"></p>
            <ul class="list-check">
              <li>Material: Stainless steel</li>
              <li>Weight: 82kg</li>
              <li>built-in drip tray</li>
              <li>Open base for pots and pans</li>
              <li>On request available in propane execution</li>
            </ul>

            <h5 class="title-description">Specifications</h5>
            <table class="table table-bordered">
              <tr>
                <th colspan="2">Basic specs</th>
              </tr>
              <tr>
                <td>Type of energy</td>
                <td>Lava stone</td>
              </tr>
              <tr>
                <td>Number of zones</td>
                <td>2</td>
              </tr>
              <tr>
                <td>Automatic connection</td>
                <td><i class="fa fa-check text-success"></i> Yes</td>
              </tr>

              <tr>
                <th colspan="2">Dimensions</th>
              </tr>
              <tr>
                <td>Width</td>
                <td>500mm</td>
              </tr>
              <tr>
                <td>Depth</td>
                <td>400mm</td>
              </tr>
              <tr>
                <td>Height</td>
                <td>700mm</td>
              </tr>

              <tr>
                <th colspan="2">Materials</th>
              </tr>
              <tr>
                <td>Exterior</td>
                <td>Stainless steel</td>
              </tr>
              <tr>
                <td>Interior</td>
                <td>Iron</td>
              </tr>

              <tr>
                <th colspan="2">Connections</th>
              </tr>
              <tr>
                <td>Heating Type</td>
                <td>Gas</td>
              </tr>
              <tr>
                <td>Connected load gas</td>
                <td>15 Kw</td>
              </tr>
            </table>
          </div>
          <!-- col.// -->

          <aside class="col-md-4">
            <div class="box">
              <h5 class="title-description">Files</h5>
              <p v-html="product.details"></p>

              <h5 class="title-description">Videos</h5>

              <article class="media mb-3">
                <a href="#"
                  ><img class="img-sm mr-3" src="images/posts/3.jpg"
                /></a>
                <div class="media-body">
                  <h6 class="mt-0">
                    <a href="#">How to use this item</a>
                  </h6>
                  <p class="mb-2">
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus
                    scelerisque ante sollicitudin
                  </p>
                </div>
              </article>

              <article class="media mb-3">
                <a href="#"
                  ><img class="img-sm mr-3" src="images/posts/2.jpg"
                /></a>
                <div class="media-body">
                  <h6 class="mt-0">
                    <a href="#">New tips and tricks</a>
                  </h6>
                  <p class="mb-2">
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus
                    scelerisque ante sollicitudin
                  </p>
                </div>
              </article>

              <article class="media mb-3">
                <a href="#"
                  ><img class="img-sm mr-3" src="images/posts/1.jpg"
                /></a>
                <div class="media-body">
                  <h6 class="mt-0">
                    <a href="#">New tips and tricks</a>
                  </h6>
                  <p class="mb-2">
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus
                    scelerisque ante sollicitudin
                  </p>
                </div>
              </article>
            </div>
            <!-- box.// -->
          </aside>
          <!-- col.// -->
        </div>
        <!-- row.// -->
      </div>
      <!-- container .//  -->
    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->

    <!-- ========================= SECTION SUBSCRIBE  ========================= -->
    <section class="padding-y-lg bg-light border-top" hidden>
      <div class="container">
        <p class="pb-2 text-center">
          Delivering the latest product trends and industry news straight to
          your inbox
        </p>

        <div class="row justify-content-md-center">
          <div class="col-lg-4 col-sm-6">
            <form class="form-row">
              <div class="col-8">
                <input
                  class="form-control"
                  placeholder="Your Email"
                  type="email"
                />
              </div>
              <!-- col.// -->
              <div class="col-4">
                <button type="submit" class="btn btn-block btn-warning">
                  <i class="fa fa-envelope"></i> Subscribe
                </button>
              </div>
              <!-- col.// -->
            </form>
            <small class="form-text"
              >We’ll never share your email address with a third-party.
            </small>
          </div>
          <!-- col-md-6.// -->
        </div>
      </div>
    </section>
    <!-- ========================= SECTION SUBSCRIBE END// ========================= -->
    <footer-section></footer-section>
  </div>
</template>


<script>
import StarRating from "vue-star-rating";
import { Carousel, Slide } from "vue-carousel";
import { VueperSlides, VueperSlide } from "vueperslides";
import "vueperslides/dist/vueperslides.css";

export default {
  data() {
    return {
      counter: 1,
      storage_url: this.$store.state.baseURL,
      rating: "No Rating Selected",
      currentRating: "No Rating",
      currentSelectedRating: "No Current Rating",
      boundRating: 0,
      loading: false,
      like: false,
    };
  },
  computed: {
    product() {
      return this.$store.state.products.find(
        (element) => element.slug === this.$route.params.slug
      );
    },
    productsLastSeen() {
      return JSON.parse(localStorage.getItem("lastSeenProducts")) || [];
    },
  },
  created() {
    this.checkProductLiked();
    this.setLastSeen();
    // this.setLastSeen()
  },
  components: {
    Carousel,
    Slide,
    VueperSlides,
    VueperSlide,
    StarRating,
  },
  methods: {
    checkProductLiked(product) {
      const record = this.$store.state.products.find(
        (element) => element.slug === this.$route.params.slug
      );

      const data = JSON.parse(JSON.stringify(record));
      // this.productData.push(data)
      this.$store
        .dispatch("checkLike", {
          product_id: data.id,
        })
        .then((response) => {
          // console.log(response.data.data)
          this.like = response.data.data.success;
        })
        .catch((error) => {
          console.log(error.data.message);
        });
    },
    setLastSeen() {
      const record = this.$store.state.products.find(
        (element) => element.slug === this.$route.params.slug
      );

      const product = JSON.parse(JSON.stringify(record));
      this.$store.commit("pushToLastSeenProducts", product);
      localStorage.setItem(
        "lastSeenProducts",
        JSON.stringify(this.$store.state.lastSeenProducts)
      );

      if (localStorage.key("lastSeenProducts")) {
        // console.log(product)
        this.$store
          .dispatch("setLastSeenProducts", {
            product_id: product.id,
            product: product,
          })
          .then((response) => {
            // console.log(response.data);
          })
          .catch((error) => {
            console.log(error.data.message);
          });
      }
    },
    //  productData() {
    //     return this.$store.state.products.find(
    //       (element) => element.slug === this.$route.params.slug
    //     );
    //  },
    retrieveCategoryName(prod) {
      let data = JSON.parse(prod.category)[0];
      let cat = this.$store.state.categories;

      let record = cat.filter(function (elem) {
        if (elem.id == data) return elem;
      });

      return record[0].name;
    },
    addToCart() {
      // if(this.$store.getters.loggedIn){
        this.loading = true
        
        this.$store.dispatch('addToCart', this.product).then((response) => {
          this.$toast.success({
            title: this.product.name,
            message: "Ajouter au panier avec succès",
          });
          this.loading = false
        }).catch((e) => {
          // console.log(e)
          this.$toast.error({
            title: "Echec d'ajout au panier",
            message: e,
          })
          this.loading = false
        })
      // }else{
      //   return this.$router.push({ name: "login" })
      // }
      //this.$store.commit("addProductToCart", this.product);
     
    },
    incrementCounter() {
      if (this.counter >= 10) {
        this.counter = 10;
      } else {
        this.counter++;
      }
    },
    decrementCounter() {
      if (this.counter <= 1) {
        this.counter = 1;
      } else {
        this.counter--;
      }
    },
    setLike(id) {
      if (this.like) {
        this.$store
          .dispatch("addToWishlist", {
            product_id: id,
          })
          .then((response) => {
            // console.log(response.data.data);
            this.like = false;
          })
          .catch((error) => {
            // console.log(error);
            this.like = true;
          });
      } else {
        this.$store
          .dispatch("addToWishlist", {
            product_id: id,
          })
          .then((response) => {
            // console.log(response.data.data);
            this.like = true;
          })
          .catch((error) => {
            // console.log(error);
            this.like = false;
          });
      }
    },
    setRating: function (rating) {
      this.rating = "You have Selected: " + rating + " stars";
    },
    showCurrentRating: function (rating) {
      this.currentRating =
        rating === 0
          ? this.currentSelectedRating
          : "Click to select " + rating + " stars";
    },
    setCurrentSelectedRating: function (rating) {
      this.currentSelectedRating = "You have Selected: " + rating + " stars";
    },
  },
  mounted() {
    window.scrollTo(0, 0);
    $(document).ready(function () {
      $(".xzoom, .xzoom-gallery").xzoom({ tint: "#333", Xoffset: 5 });
    });
  },
};
</script>
<style lang="scss" scoped>
.xzoom-source img,
.xzoom-preview img,
.xzoom-lens img {
  display: block;
  max-width: none;
  max-height: none;
  -webkit-transition: none;
  -moz-transition: none;
  -o-transition: none;
  transition: none;
}

.custom-text {
  font-weight: bold;
  font-size: 1.9em;
  border: 1px solid #cfcfcf;
  padding-left: 10px;
  padding-right: 10px;
  border-radius: 5px;
  color: #999;
  background: #fff;
}
</style>