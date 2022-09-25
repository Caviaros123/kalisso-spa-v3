<template>
  <div class="page-wrapper">
    <nav-section></nav-section>
    
    <div>
      <!-- ========================= SECTION CONTENT ========================= -->
      <section class="section-content padding-y">
        <div class="container">
         
          <!-- ============================  FILTER TOP  ================================= -->
          <div class="card mb-3">
            <div class="card-body">
              <ol class="breadcrumb float-left">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <!-- <li class="breadcrumb-item"><a href="#">Category name</a></li> -->
                <li class="breadcrumb-item ">Recherche</li>
                <li class="breadcrumb-item active text-uppercase">{{query}}</li>
              </ol>
            </div>
            <!-- card-body .// -->
          </div>
          <!-- card.// -->
          <!-- ============================ FILTER TOP END.// ================================= -->

          <div class="row">
            <aside class="col-md-2">
              <article class="filter-group">
                <h6 class="title">
                  <a
                    href="#"
                    class="dropdown-toggle"
                    data-toggle="collapse"
                    data-target="#collapse_1"
                  >
                    Type de Produit
                  </a>
                </h6>
                <div class="filter-content collapse show" id="collapse_1">
                  <div class="inner">
                    <ul class="list-menu">
                      <li><a href="#">Shorts </a></li>
                      <li><a href="#">Trousers </a></li>
                      <li><a href="#">Sweaters </a></li>
                      <li><a href="#">Clothes </a></li>
                      <li><a href="#">Home items </a></li>
                      <li><a href="#">Jackats</a></li>
                      <li><a href="#">Somethings </a></li>
                    </ul>
                  </div>
                  <!-- inner.// -->
                </div>
              </article>
              <!-- filter-group  .// -->
              <article class="filter-group">
                <h6 class="title">
                  <a
                    href="#"
                    class="dropdown-toggle"
                    data-toggle="collapse"
                    data-target="#collapse_2"
                  >
                    Brands
                  </a>
                </h6>
                <div class="filter-content collapse show" id="collapse_2">
                  <div class="inner">
                    <label class="custom-control custom-checkbox">
                      <input
                        type="checkbox"
                        checked=""
                        class="custom-control-input"
                      />
                      <div class="custom-control-label">
                        Adidas
                        <b class="badge badge-pill badge-light float-right"
                          >120</b
                        >
                      </div>
                    </label>
                    <label class="custom-control custom-checkbox">
                      <input
                        type="checkbox"
                        checked=""
                        class="custom-control-input"
                      />
                      <div class="custom-control-label">
                        Nike
                        <b class="badge badge-pill badge-light float-right"
                          >15</b
                        >
                      </div>
                    </label>
                    <label class="custom-control custom-checkbox">
                      <input
                        type="checkbox"
                        checked=""
                        class="custom-control-input"
                      />
                      <div class="custom-control-label">
                        The Noth Face
                        <b class="badge badge-pill badge-light float-right"
                          >35</b
                        >
                      </div>
                    </label>
                    <label class="custom-control custom-checkbox">
                      <input
                        type="checkbox"
                        checked=""
                        class="custom-control-input"
                      />
                      <div class="custom-control-label">
                        The cat
                        <b class="badge badge-pill badge-light float-right"
                          >89</b
                        >
                      </div>
                    </label>
                    <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" />
                      <div class="custom-control-label">
                        Honda
                        <b class="badge badge-pill badge-light float-right"
                          >30</b
                        >
                      </div>
                    </label>
                  </div>
                  <!-- inner.// -->
                </div>
              </article>
              <!-- filter-group .// -->
              <article class="filter-group">
                <h6 class="title">
                  <a
                    href="#"
                    class="dropdown-toggle"
                    data-toggle="collapse"
                    data-target="#collapse_3"
                  >
                    Price range
                  </a>
                </h6>
                <div class="filter-content collapse show" id="collapse_3">
                  <div class="inner">
                    <input
                      type="range"
                      class="custom-range"
                      min="0"
                      max="100"
                      name=""
                    />
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Min</label>
                        <input
                          class="form-control"
                          placeholder="$0"
                          type="number"
                        />
                      </div>
                      <div class="form-group text-right col-md-6">
                        <label>Max</label>
                        <input
                          class="form-control"
                          placeholder="$1,0000"
                          type="number"
                        />
                      </div>
                    </div>
                    <!-- form-row.// -->
                    <button class="btn btn-block btn-primary">Apply</button>
                  </div>
                  <!-- inner.// -->
                </div>
              </article>
              <!-- filter-group .// -->
              <article class="filter-group">
                <h6 class="title">
                  <a
                    href="#"
                    class="dropdown-toggle"
                    data-toggle="collapse"
                    data-target="#collapse_4"
                  >
                    Sizes
                  </a>
                </h6>
                <div class="filter-content collapse show" id="collapse_4">
                  <div class="inner">
                    <label class="checkbox-btn">
                      <input type="checkbox" />
                      <span class="btn btn-light"> XS </span>
                    </label>

                    <label class="checkbox-btn">
                      <input type="checkbox" />
                      <span class="btn btn-light"> SM </span>
                    </label>

                    <label class="checkbox-btn">
                      <input type="checkbox" />
                      <span class="btn btn-light"> LG </span>
                    </label>

                    <label class="checkbox-btn">
                      <input type="checkbox" />
                      <span class="btn btn-light"> XXL </span>
                    </label>
                  </div>
                  <!-- inner.// -->
                </div>
              </article>
              <!-- filter-group .// -->
              <article class="filter-group">
                <h6 class="title">
                  <a
                    href="#"
                    class="dropdown-toggle"
                    data-toggle="collapse"
                    data-target="#collapse_5"
                  >
                    Condition
                  </a>
                </h6>
                <div class="filter-content collapse show" id="collapse_5">
                  <div class="inner">
                    <label class="custom-control custom-radio">
                      <input
                        type="radio"
                        name="myfilter_radio"
                        checked=""
                        class="custom-control-input"
                      />
                      <div class="custom-control-label">Any condition</div>
                    </label>

                    <label class="custom-control custom-radio">
                      <input
                        type="radio"
                        name="myfilter_radio"
                        class="custom-control-input"
                      />
                      <div class="custom-control-label">Brand new</div>
                    </label>

                    <label class="custom-control custom-radio">
                      <input
                        type="radio"
                        name="myfilter_radio"
                        class="custom-control-input"
                      />
                      <div class="custom-control-label">Used items</div>
                    </label>

                    <label class="custom-control custom-radio">
                      <input
                        type="radio"
                        name="myfilter_radio"
                        class="custom-control-input"
                      />
                      <div class="custom-control-label">Very old</div>
                    </label>
                  </div>
                  <!-- inner.// -->
                </div>
              </article>
              <!-- filter-group .// -->
            </aside>
            <!-- col.// -->
            <main class="col-md-10">
              <header class="mb-3">
                <div class="form-inline">
                  <strong class="mr-md-auto">{{resultSearch.length}} Produit{{resultSearch.length >= 2 ? 's' : ''}} trouvé{{resultSearch.length >= 2 ? 's' : ''}}<span class=" text-muted"><br> Pour votre recherche <strong class="text-danger b">{{query}}</strong></span> </strong>
                  <select class="mr-2 form-control">
                    <option>Nouveautés</option>
                    <option>Populaire</option>
                    <option>Tendence</option>
                    <option>Le moins cher</option>
                  </select>
                  <div class="btn-group">
                    <a
                      href="#!"
                      class="btn btn-light"
                      data-toggle="tooltip"
                      title="List view"
                    >
                      <i class="fa fa-bars"></i
                    ></a>
                    <a
                      href="#!"
                      class="btn btn-light active"
                      data-toggle="tooltip"
                      title="Grid view"
                    >
                      <i class="fa fa-th"></i
                    ></a>
                  </div>
                </div>
              </header>
              <!-- sect-heading -->

              <article class="card card-product-list" v-for="(item, index) in resultSearch" :key="index">
                <div class="row no-gutters">
                  <aside class="col-md-3">
                    <router-link
                      :to="{ name: 'products.show', params: { slug: item.slug } }" class="img-wrap">
                      <span class="badge badge-danger" v> Nouveau </span>
                      <img v-lazy-src="storage_url + item.image" />
                    </router-link>
                  </aside>
                  <!-- col.// -->
                  <div class="col-md-6">
                    <div class="info-main">
                      <router-link
                      :to="{ name: 'products.show', params: { slug: item.slug } }" class="h5 title">
                        {{item.name +' '+item.details}} </router-link
                      >
                      <div class="rating-wrap mb-2" v-show="item.review">
                        <star-rating v-model="boundRating" text-class="custom-text "></star-rating>
                        <div class="label-rating">9/10</div>
                      </div>
                      <!-- rating-wrap.// -->

                      <p class="mb-3">
                        <span class="tag" v-if="item.featured">
                          <i class="fa fa-check text-success"></i> Verifié</span
                        >
                        <span class="tag"> 5 Ans </span>
                        <span class="tag" v-if="item.review"> {{item.review}} Avis </span>
                        <span class="tag"> {{item.location}} </span>
                      </p>
                      
                      <p v-html="item.details" ></p>
                      <p v-html="item.description" ></p>
                    </div>
                    <!-- info-main.// -->
                  </div>
                  <!-- col.// -->
                  <aside class="col-sm-3">
                    <div class="info-aside">
                      <div class="price-wrap">
                        <span class="h5 price">{{presentPrice(item.price)}}</span>
                        <!-- <small class="text-muted">/per item</small> -->
                      </div>
                      <!-- price-wrap.// -->
                      <!-- <small class="text-warning">Paid shipping</small> -->

                      <!-- <p class="text-muted mt-3">{{item.store_id}}</p> -->
                      <p class="mt-3">
                        <a href="#!" @click.stop.prevent="addToCart(item)" class="btn btn-outline-primary">
                          <i class="fa fa-shopping-cart"></i> Ajouter au panier
                        </a>
                        <a href="#!" disabled class="btn btn-light disabled"
                          ><i class="fa fa-heart"></i> J'aime
                        </a>
                      </p>

                      <!-- <label class="custom-control mt-3 custom-checkbox">
                        <input type="checkbox" class="custom-control-input" />
                        <div class="custom-control-label">Add to compare</div>
                      </label> -->
                    </div>
                    <!-- info-aside.// -->
                  </aside>
                  <!-- col.// -->
                </div>
                <!-- row.// -->
              </article>
              <!-- card-product .// -->

              <nav class="mb-4" v-if="resultSearch.length > 8" aria-label="Page navigation sample">
                <ul class="pagination">
                  <li class="page-item disabled">
                    <a class="page-link" href="#!">Précédent</a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#!">1</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#!">2</a></li>
                  <li class="page-item"><a class="page-link" href="#!">3</a></li>
                  <li class="page-item"><a class="page-link" href="#!">4</a></li>
                  <li class="page-item"><a class="page-link" href="#!">5</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#!">Suivant</a>
                  </li>
                </ul>
              </nav>

              <div class="box text-center" v-if="resultSearch.length > 1">
                <p>Avez-vous trouvé ce que vous cherchiez?</p>
                <a href="#!" class="btn btn-light">Oui</a>
                <a href="#!" class="btn btn-light">Non</a>
              </div>
            </main>
            <!-- col.// -->
          </div>
        </div>
        <!-- container .//  -->
      </section>
      <!-- ========================= SECTION CONTENT END// ========================= -->

      <!-- ========================= SECTION SUBSCRIBE  ========================= -->
      <section class="padding-y-lg bg-light border-top">
        <div class="container">
          <p class="pb-2 text-center">
            Recevez les dernières tendances de produits et les nouvelles directement dans votre boîte SMS ou e-mail
          </p>

          <div class="row justify-content-md-center">
            <div class="col-lg-4 col-sm-6">
              <form class="form-row">
                <div class="col-8">
                  <input
                    class="form-control"
                    placeholder="Votre e-mail ou téléphone"
                    type="text"
                  />
                </div>
                <!-- col.// -->
                <div class="col-4">
                  <button type="submit" class="btn btn-block btn-warning">
                    <i class="fa fa-envelope"></i> S'abonner
                  </button>
                </div>
                <!-- col.// -->
              </form>
              <small class="form-text"
                >Nous ne partagerons jamais votre adresse e-mail avec un tiers.
              </small>
            </div>
            <!-- col-md-6.// -->
          </div>
        </div>
      </section>
      <!-- ========================= SECTION SUBSCRIBE END// ========================= -->
    </div>

    <footer-section></footer-section>
  </div>
</template>

<script>
import StarRating from "vue-star-rating";


export default {

    name: "searchPage",
    props: {
      query: {
        type: String,
      }
    },
    data(){
      return {
        resultSearch: [],
        storage_url: this.$store.state.baseURL,
        rating: "No Rating Selected",
        currentRating: "No Rating",
        currentSelectedRating: "No Current Rating",
        boundRating: 0,
        like: false
      };
    },
    components: {
      StarRating,
    },
    created(){
      this.search()
    },
    computed: {
      
    },
    methods: {
      addToCart(product) {
        this.$store.commit('addProductToCart', product)
        this.$toast.success({
          title: product.name,
          message: "Ajouter au panier avec succès"
        })
      },
      search(){
        this.$store.dispatch('getSearchProduct', {
          query: this.query
        })
        .then((response) => {
          this.resultSearch = response.data.data
        })
        .catch((error) => {
          console.log(error)
        })
      },
      getSeller(product) {
        const findSeller = this.$store.state.ordersProductSeller.find(
          (item) =>
            item.email === product.email || item.store_id === product.store_id
        );

        const seller = JSON.parse(JSON.stringify(findSeller))

        return seller.store_name

        // return seller
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

};
</script>