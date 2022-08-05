<template>
  <!-- ========================= SECTION CONTENT ========================= -->

  <main class="col-md-9">
    <article
      class="card mb-4"
      v-for="(order, index) in this.$store.state.orders"
      :key="index"
    >
      <header class="card-header">
        <a href="#" class="float-right disabled"> <i class="fa fa-print"></i> Imprimer</a>
        <strong class="d-inline-block mr-3"
          >ID de la commande: {{ order.transaction_id }}</strong
        >
        <span>Emise le: {{ order.created_at | formatDate }}</span>
      </header>
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
            <h6 class="text-muted">Livré à</h6>
            <p>
              {{ order.billing_name }} <br />
              Numéro de Téléphone: +{{ order.billing_phone }} <br />
              Email: {{ order.billing_email }} <br />
              Adresse:
              {{
                order.billing_adress +
                " " +
                order.billing_city +
                " " +
                order.billing_country
              }}
              <br />
            </p>
          </div>
          <div class="col-md-4">
            <h6 class="text-muted">Paiement</h6>
            <span class="text-success text-uppercase">
              <!-- <i class="fab fa-lg fa-cc-visa"></i> -->
              {{ order.payment_gateway }}
            </span>
            <p>
              Sous-Total: {{ presentPrice(order.billing_subtotal) }} <br />
              Frais de livraison: {{ presentPrice(0) }}<br />
              <span class="b"
                >Total: {{ presentPrice(order.billing_total) }}
              </span>
            </p>
          </div>
        </div>
        <!-- row.// -->
      </div>
      <!-- card-body .// -->
      <div class="table-responsive">
        <table class="table table-hover">
          <tbody>
            <tr v-for="(product, index) in order.products" :key="index">
              <td width="65">
                <img :src="storage_url + product.image" class="img-xs border" />
              </td>
              <td>
                <p class="title mb-0">{{ product.name }}</p>
                <var class="price text-muted">{{
                  presentPrice(product.price)
                }}</var>
              </td>
              <td>
                Quantité <br />
                {{ product.pivot.quantity }}
              </td>
              <td>
                Vendu par <br />
                <span @load="getSeller(product.store_id)"></span>
                
              </td>
              <td width="250">
                <a  href="#" class="btn btn-outline-primary disabled" title="Bientôt disponible" disabled="disabled" >Suivre <i class="fa fa-track-order"></i></a>
                <div class="dropdown d-inline-block">
                  <a
                    href="#"
                    data-toggle="dropdown"
                    class="dropdown-toggle btn btn-outline-secondary"
                    >Plus+</a
                  >
                  <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item disabled" disabled="disabled" aria-haspopup="Bientôt disponible" title="Bientôt disponible">Remboursement</a>
                    <a href="#" class="dropdown-item disabled" disabled="disabled" aria-haspopup="Bientôt disponible" title="Bientôt disponible">Annuler la commande</a>
                  </div>
                </div>
                <!-- dropdown.// -->
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- table-responsive .end// -->
    </article>
    <!-- card order-item .// -->
    <main v-if="this.$store.state.orders.length === 0">
      <div align="center" class="padding-y-lg card">
        <h2>Oups!</h2>
        <div>
          <img
            src="/images/no-orders_2x.png"
            class="img-fluid w-25"
            alt="Cart is Empty"
          />
        </div>
        <p>Vous n'avez aucune commande pour l'instant</p>
      </div>
    </main>
  </main>

  <!-- ========================= SECTION CONTENT END// ========================= -->
</template>

<script>
export default {
  name: "ProfileOrders",
  data() {
    return {
      seller: [],
      storage_url: this.$store.state.baseURL,
    };
  },
  created() {
    this.dispatchEvent()
  },
  methods: {
    dispatchEvent(){
      let arr = []
      this.$store.state.orders.forEach((value, index) => {
          arr.push(value.products)
      })
      let products = arr.flat()
      let final = []

      products.forEach((val, ind) => {
        final.push(val.email)
      })
      this.$store.dispatch('getSellerName', {
        email: final
      })
       
    },
    getSeller(product) {
      
      const findSeller = this.$store.state.ordersProductSeller.find(
        (item) =>
          item.email === product.email || item.store_id === product.store_id
      );

      const seller = JSON.parse(JSON.stringify(findSeller))

      return seller.store_name
    },
  },
};
</script>
