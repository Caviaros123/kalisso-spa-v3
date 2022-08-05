<template>
  <div class="px-0 page-wrapper" style="background-color: white">
    <Spinner v-if="loading" />
    <nav-section></nav-section>

    <section class="container">
      <div class="pt-5 pb-2 mx-auto">
        <h2>Nos boutiques Kalisso's</h2>
      </div>
      <div class="py-3 row mx-auto align-self-start">
        <div
          class="card  py-4 px-4 m-2"
          v-for="(item, index) in allStore"
          :key="index"
        >
          <div class="card-body m-0 p-0">
            <div class="row justify-content-center">
              <div class="image-bg mr-3">
                <img class="user-img fit-image" :src="loadImg(item.logo)" />
              </div>
              <div class="text-left">
                <div class="row-sm justify-content-arround">
                  <h2 class="pr-2">{{ item.name }}</h2>
                  <img
                    width="32"
                    height="32"
                    src="/images/icons/icons8-verified-badge-48.png"
                  />
                </div>
                <!-- <h6>{{ item.products.length }} PRODUITS - 0 VENTE</h6> -->
                <p v-html="item.description"></p>

                <star-rating
                  :border-width="2"
                  border-color="#d8d8d8"
                  :read-only="true"
                  :rounded-corners="true"
                  :star-points="[
                    23, 2, 14, 17, 0, 19, 10, 34, 7, 50, 23, 43, 38, 50, 36, 34,
                    46, 19, 31, 17,
                  ]"
                  :star-size="20"
                  v-model="boundRating"
                  text-class="custom-text "
                ></star-rating>
              </div>
            </div>
            <div v-if="item.products.length >= 1">
              <div class="line"></div>
              <div class="row d-flex justify-content-around px-3">
                <div
                  class="prod-bg rounded p-0 m-0"
                  v-for="(prod, index) in item.products.slice(0, 4)"
                  :key="index"
                >
                  <img
                    class="prod-pic rounded fit-image m-0 p-1"
                    :src="storage_url + '/storage/' + prod.image"
                  />
                </div>
                <div
                  class="more rounded text-center pt-3"
                  v-if="item.products.length >= 5"
                >
                  <h1 class="mb-0 dk-none dk-sm-block">
                    <strong>+{{ item.products.slice(4, 1000).length}}</strong>
                  </h1>
                  <h5>Produits</h5>
                </div>
              </div>
            </div>
            <div class="counter mt-3">
              <div class="row">
                <div class="col-6 col-lg-3">
                  <div class="count-data text-center">
                    <h6 class="count h2" data-to="500" data-speed="500">{{ item.products.length }}</h6>
                    <p class="m-0px font-w-600">Total Produits</p>
                  </div>
                </div>
                <div class="col-6 col-lg-3">
                  <div class="count-data text-center">
                    <h6 class="count h2" data-to="150" data-speed="150">0</h6>
                    <p class="m-0px font-w-600">Abonnées</p>
                  </div>
                </div>
                <div class="col-6 col-lg-3">
                  <div class="count-data text-center">
                    <h6 class="count h2" data-to="850" data-speed="850">0</h6>
                    <p class="m-0px font-w-600">Vendues</p>
                  </div>
                </div>
                <div class="col-6 col-lg-3">
                  <div class="count-data text-center">
                    <h6 class="count h2" data-to="190" data-speed="190">{{ item.products.length }}</h6>
                    <p class="m-0px font-w-600">Nouveaux Produits</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer row-sm">
            <div class="col-6 col-lg-6">
              <a href="#" class="btn btn-lg disabled form-control btn-danger"> S'abonner </a>
            </div>
            <!-- <hr class="vl" /> -->
            <div class="col-6 col-lg-6">
              <router-link :to="{name: 'show.store', params: {slug: item.slug, email: item.email, store_id: item.store_id}}" class="btn btn-lg form-control btn-secondary"> <i class="fa fa-store"></i> Visiter </router-link>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer-section></footer-section>
  </div>
</template>

<script>
import StarRating from "vue-star-rating";

export default {
  data() {
    return {
      allStore: [],
      storeProduct: [],
      loading: false,
      successMessage: "",
      serverError: "",
      boundRating: Math.floor(Math.random() * (5 - 1 + 1)) + 1,
      storage_url: "https://kalisso.com",
    };
  },
  components: {
    StarRating,
  },
  created() {
    this.getStore();
  },
  methods: {
    loadImg(logo) {
      return this.storage_url + logo;
    },
    getStore() {
      this.loading = true;
      this.$store
        .dispatch("getAllStore")
        .then((response) => {
          (this.loading = false), (this.allStore = response.data.data);
          console.log(response.data);
        })
        .catch((error) => {
          this.loading = false;
          this.serverError = error.data.message;
        });
    },
  },
};
</script>

<style lang="scss" scoped>
.vl {
  border-left: 2px solid grey;
  height: auto;
}
p {
  display: -webkit-box;
  max-width: 400px;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.line {
  height: 1px;
  background-color: #eeeeee;
  width: 100%;
  margin: 35px 0px;
}

.card {
  width: 650px;
  margin: auto;
}

.user-img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  cursor: pointer;
}

.fa-star.active {
  color: #e91e63;
}

.btn-pink {
  background-color: #e91e63;
  color: #fff;
  height: 70px;
  padding: 20px 30px;
  margin-top: 15px;
}

.btn-pink:hover {
  background-color: #d81b60;
}

.image-bg {
  width: 100px;
}

.fit-image {
  object-fit: cover;
  width: 100%;
}

.prod-pic {
  width: 100px;
  height: 100px;
  margin: 0;
  padding: 0;
  cursor: pointer;
}

.prod-bg {
  width: 100px;
  height: 100px;
  margin: 8px;
  padding: 0px;
  background-color: #e0e0e0;
  // margin-bottom: 10px;
}

.fat-img {
  width: 94px;
  height: 100px;
}

.more {
  width: 100px;
  height: 100px;
  color: #fff;
  background-color: #000;
  cursor: pointer;
}

@media screen and (max-width: 677px) {
  .card {
    width: 100%;
    margin: auto;
  }
  .btn-pink {
    width: 100%;
    height: 40px;
    padding: 6px 30px;
  }
  .prod-bg {
    width: 33%;
    height: 110px;
    background-color: #e0e0e0;
  }
  .more {
    width: 66%;
  }
}
</style>