<template>
  <!-- ========================= SECTION CONTENT ========================= -->

  <main class="col-md-9" v-if="wishlists">
    <article class="card" v-if="wishlists.length > 0">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6" v-for="(data, index) in wishlists" :key="index">
            <figure class="itemside mb-4">
              <div class="aside">
                <img v-lazy-src="storage_url+data.image" class="border img-md" />
              </div>
              <figcaption class="info">
                <a href="#" class="title">{{ data.name }}</a>
                <p class="price mb-2">{{ presentPrice(data.price) }}</p>
                <a href="#" @click.stop.prevent="addToCart(data)" class="btn btn-success btn-sm"> Ajouter au panier </a>
                <a
                  href="#"
                  @click.stop.prevent="removeFromWishlist(data.id, index)"
                  class="btn btn-danger btn-sm"
                  data-toggle="tooltip"
                  title="Retirer de vos favoris"
                  data-original-title="Remove from wishlist"
                >
                  <i class="fa fa-times"></i>
                </a>
              </figcaption>
            </figure>
          </div>
          <!-- col.// -->
        </div>
        <!-- row .//  -->
      </div>
      <!-- card-body.// -->
    </article>
     <main v-if="wishlists.length === 0">
      <div align="center" class="padding-y-lg card">
        <h2>
          Oups! 
        </h2>
        <div >
          <img
            src="/images/noWishlist.png"
            class="img-fluid w-50"
            alt="Cart is Empty"
          />
        </div>
        <p>
            Vous n'avez aucun favoris pour l'instant <br>
            ajouter des produits vos favoris en les <i class="fa fa-heart fa-2x text-danger"></i> Likons tout simplement  
        </p>
      </div>
  </main>
  </main>
  <!-- col.// -->
  
  <!-- ========================= SECTION CONTENT END// ========================= -->
</template>

<script>

export default {
  name: "ProfileWishlist",

  data() {
    return {
      wishlists: this.$store.state.wishlist || [],
      storage_url: this.$store.state.baseURL,
    }
  },
  computed: {
    getproduct(){
      
    }
  },
  methods:{
    addToCart(product) {
      // console.log(product)
      // product.push({qty: 1}) 
      this.$store.commit('addProductToCart', product)
      this.$toast.success({
        title: product.name,
        message: "Ajouter au panier avec succès"
      })
    },
    removeFromWishlist(id, index){
      this.$store.dispatch('removeItemFromWishlist', {
        product_id: id,
        index: index
      })
    }
  }
};
</script>