<template>
    <div>
        <nav-section></nav-section>
        <div class="container py-5" v-if="successStatus.includes(status)">
            <div class="text-center row justify-content-center align-items-center">
                <div class="card p-2 rounded col-8 mx-auto shadow-lg">
                    <div class="mt-3" v-bind:class="successStatus.includes(status) ? 'text-success' : 'text-danger'">
                        <i class="fa  fa-5x  pb-2" v-bind:class="successStatus.includes(status) ? 'fa-truck' : 'fa-trash'"></i>
                        <h2 class="text-uppercase mb-3">{{ successStatus.includes(status) ? 'félicitations !': 'Echec de paiement' }}</h2>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Merci pour votre commande</h5>
                        <p class="card-text">
                            Votre commande a bien été prise en compte, Vous pouvez également consulter les détails de votre commande en cliquant sur le bouton ci-dessous.
                            <div class="p-2">
                                <p class="b h2">ID de la transaction:
                                    <span class="text-danger b h4">{{ reference }}</span></p>
                                <br />
                                <p class="b h2">Montant:
                                    <span class="text-danger b h4">{{ presentPrice(amount) }}</span></p>
                                <br /><br /> Merci d'avoir choisi kalisso.com
    
                                <br /> Nous avons envoyé un SMS et un E-mail avec votre code de livraison
                            </div>
                            <p class="text-center">{{ successMessage }}</p>
    
                            <div class="mt-3">
                                <a class="btn btn-primary p-3" href="/category">Retour au shopping</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
    
        <div class="container py-3" v-show="errorStatus.includes(status)">
          <div class="text-center row justify-content-center align-items-center  pt-0 pb-4 cover">
            <div class="card p-2 rounded col-8 mx-auto shadow-lg media align-items-center profile-head">
              <div class="text-danger pt-2 profile">
                <!-- <i class="fa fa-trash fa-2x "></i> -->
                <img
                  src="https://cdn2.iconfinder.com/data/icons/payment-53/100/credit-card-failed-2-payment-failed-denied-card-mobile-reader-rejected-invalid-x-512.png"
                  class="img w-25 round rounded mb-2  "
                />
              </div>
              <div class="card-body">
                <h2 class="text-uppercase text-danger ">
                 Echec de paiement
                </h2>
                <span class="alert py-3 h5">
                  Veuillez vérifier votre solde et réessayer de nouveau ! 
                </span>
                <div class="p-2 mt-4">
                  <p class="b h2">ID de la transaction:
                  <span class="text-danger b h4">{{ reference }}</span></p>
                  <br />
                  <p class="b h2">Montant:
                  <span class="text-danger b h4">{{ presentPrice(amount) }}</span></p>
                  <br /><br />
                  Merci d'avoir choisis kalisso.com
    
                  <br />
                  Votre paiement à échouer, nous vous prions de réessayer SVP !
                </div>
    
                <div class="mt-3">
                  <a class="btn btn-primary p-3" href="/">Retour à l'acceuil</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-3">
            <div class="text-center" v-show="paymentFailed()">
                <div class="card bg shadow-lg">
                    <div class="text-danger pt-2">
                        <!-- <i class="fa fa-trash fa-2x "></i> -->
                        <img src="https://cdn2.iconfinder.com/data/icons/payment-53/100/credit-card-failed-2-payment-failed-denied-card-mobile-reader-rejected-invalid-x-512.png" class="img w-25 round m-3" />
                    </div>
                    <div class="card-body">
                        <h2 class="text-uppercase text-danger mb-5">Echec de paiement !</h2>
    
                        <span class="alert alert-danger my-3">
                  Veuillez vérifier votre solde
                </span>
                        <div class="p-2">
                            <p class="b">ID de la transaction:</p>
                            <h3 class="text-danger b">{{ reference }}</h3>
                            <br /><br /> Merci d'avoir choisis kalisso.com
    
                            <br /> Votre paiement à échouer, nous vous prions de réitérer votre achat en replissant nos conditions de paiement SVP !
                        </div>
    
                        <div class="mx-5 my-5">
                            <a class="btn btn-outline-secondary shadow-lg p-3" href="/cart">Retour au panier</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer-section></footer-section>
      </div>
</template>

<script>
export default {
    data() {
        return {
            successMessage: "",
            serverError: "",
            reference: "",
            status: "",
            amount: "",
            currency: "",
            paymentMethod: "",
            paymentId: "",
            successStatus: ["success", "SUCCESS", "completed", "SUCCESSFUL", "200", "APPROVED", "0", "Approuver"],
            errorStatus: ["failed", "FAILED", "cancelled", "60019", "01035", "99046", "00068", "00017", "0100006", "DECLINED", "CANCELED", "2006", -2, -1, "PENDING"],
        };
    },
    mounted() {
        this.status = this.$route.query.status
        this.reference = this.$route.query.Reference
        this.amount = this.$route.query.amount
        this.currency = this.$route.query.currency
        this.paymentMethod = this.$route.query.PaymentMethod
        this.paymentId = this.$route.query.paymentID
    },
    computed: {
        // paymentFailed() {
        //   if (this.$route.query.status === "60019" || this.$route.query.status === "60019") {
        //     return false;
        //   }
        //   return this.successMessage === "payment_failed";
        // },
        // referenceNotFound() {
        //   return this.successMessage === "reference_not_found";
        // },
    },
    methods: {
        referenceNotFound() {
            return false;
        },
        paymentFailed() {
            return false;
        },
    },
};
</script>

<style lang="scss" scoped>

</style>