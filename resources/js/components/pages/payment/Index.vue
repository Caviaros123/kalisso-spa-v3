<template>
  <div class="content-wrapper">
    <Spinner v-if="loading"/>

    <div  v-if="this.$route.query.type != 'plan'">
      <nav-section></nav-section>
      <section class="section-pagetop bg-gray">
        <div class="container">
          <h2 class="title-page ml-3">Paiement</h2>
          <p class="ml-3 h4 text-muted">
            Vous y êtes presque! Finaliser votre paiement
          </p>
        </div>
        <!-- container //  -->
      </section>
      <section class="container mx-auto padding-around" >
        <div class="row">
          <div class="col-md-8">
            <div
              class="card shadow rounded m-2 p-4 padding-around"
              style="min-height: 380px; margin-top: 3%"
            >
              <h4 class="text-muted">Methodes de paiment</h4>
              <div class="form-row padding-y">
                <div class="form-group col-sm-6" >
                  <label
                    class="js-check box rounded"
                    v-bind:class="formData.delivery === 'option1' ? 'active bg-light' : ''"
                  >
                    <input
                      type="radio"
                      name="dostavka"
                      v-model="formData.delivery"
                      value="option1"
                      checked
                    />
                    <img
                      src="/img-payment/airtel_momo.png"
                      width="40"
                      class="img-fluid img-bg float-right thumbnail"
                    />
                    <img
                      src="/img-payment/unnamed.png"
                      width="40"
                      class="img-fluid img-bg mr-2 float-right thumbnail"
                    />

                    <h6 class="title">Epay Congo</h6>
                    <p class="text-muted small">
                      inclus: MTN MoMo, Airtel Money, Visa UBA et Mastercard
                    </p>
                  </label>
                  <!-- js-check.// -->
                </div>
                <div class="form-group col-sm-6">
                  <label
                    class="js-check box rounded"
                    v-bind:class="formData.delivery === 'option2' ? 'active bg-light' : ''"
                  >
                    <input
                      type="radio"
                      name="dostavka"
                      v-model="formData.delivery"
                      value="option2"
                    />
                    <div class="row-sm text-center float-right">
                      <img
                        src="/img-payment/logo.png"
                        width="120"
                        class="img-fluid img-bg float-right thumbnail"
                      /><br />
                    </div>
                    <h6 class="title">ScanPay</h6>
                    <p class="text-muted small">
                      inclus: MTN MoMo, Airtel Money, Visa, PayPal et Mastercard
                    </p>
                  </label>

                  <!-- js-check.// -->
                </div>
                <div class="form-group disabled col-sm-6">
                  <label
                    aria-disabled="true"
                    title="Ce moyen de paiement sera disponible très prochainment"
                    class="js-check disabled box rounded"
                    v-bind:class="formData.delivery === 'option3' ? 'active' : ''"
                  >
                    <input
                      type="radio"
                      name="dostavka"
                      class="disabled"
                      disabled
                      v-model="formData.delivery"
                      value="option3"
                    />
                    <img
                      src="/img-payment/téléchargement.png"
                      width="130"
                      class="img-fluid img-bg float-right thumbnail"
                    />
                    <h6 class="title">Carte de Crédit</h6>
                    <p class="text-muted">Visa - Mastercard</p>
                    <span
                      class="badge badge-pill disabled badge-warning"
                      style="
                        float: right;
                        margin-bottom: -10px;
                        background-color: black !important;
                        font-size: 12px;
                      "
                      >Bientot disponible</span
                    >
                  </label>
                  <!-- js-check.// -->
                </div>
                <div class="form-group disabled col-sm-6">
                  <label
                    aria-disabled="true"
                    title="Ce moyen de paiement sera disponible très prochainment"
                    class="js-check disabled box rounded"
                    v-bind:class="formData.delivery === 'option4' ? 'active' : ''"
                  >
                    <input
                      type="radio"
                      name="dostavka"
                      disabled
                      class="disabled"
                      v-model="formData.delivery"
                      value="option4"
                    />
                    <img
                      src="/img-payment/PayPal-Logo.png"
                      width="100"
                      class="img-fluid img-bg float-right thumbnail"
                    />
                    <h6 class="title">PayPal</h6>
                    <p class="text-muted">Application</p>
                    <span
                      class="badge badge-pill badge-warning"
                      style="
                        float: right;
                        margin-bottom: -10px;
                        background-color: black !important;
                        font-size: 12px;
                      "
                      >Bientot disponible</span
                    >
                  </label>
                  <!-- js-check.// -->
                </div>
              </div>
            </div>
          </div>
          <aside class="col-md-4">
            <div
              class="card shadow rounded m-2"
              style="min-height: 380px; margin-top: 3%"
            >
              <div class="card-body">
                <h4 class="mb-3">Aperçu de votre commande</h4>
                <dl class="dlist-align">
                  <dt class="text-muted">Type:</dt>
                  <dd class="text-uppercase">{{ epayFormData.type || cart.reference }}</dd>
                </dl>
                <dl class="dlist-align">
                  <dt class="text-muted">Détails:</dt>
                  <dd class="text-lowercase">{{ epayFormData.reference || presentPrice(cart.amount) }}</dd>
                </dl>
                <dl class="dlist-align">
                  <dt class="text-muted">Paiment par:</dt>
                  <dd class="text-danger h6 b">
                    {{
                      formData.delivery === "option1"
                        ? "Epay Congo"
                        : "ScanPay By DigiBox"
                    }}
                  </dd>
                </dl>
                <hr />
                <dl class="dlist-align">
                  <dt>Total:</dt>
                  <dd class="h5">{{ presentPrice(epayFormData.amount) }}</dd>
                </dl>
                <hr />
                <a href="#" @click.prevent="formData.delivery === 'option1'
                        ? redirectToEpay() : requestScanPay() " class="btn btn-primary py-3 mt-5 btn-block d-none d-md-block">
                  Payer <strong>{{ presentPrice(epayFormData.amount) }}</strong>
                </a>
              </div>
              <div class=" px-4 text-center padding-y">
                <p class="text-muted small mx-auto"
                  >En cliquant, vous acceptez nos CGU . Nous traiterons vos
                  données personnelles pour l'exécution de votre commande et à
                  d'autres fins conformément à notre politique de confidentialité
                  . Ce site est protégé par reCAPTCHA et la politique de
                  confidentialité et les conditions d'utilisation de Google
                  s'appliquent.</p
                >
              </div>
              <!-- card-body.// -->
              <div class="card shadow fixed-bottom d-block d-md-none mx-auto padding-y-sm px-3">
                <a href="#" @click.prevent="formData.delivery === 'option1'
                        ? redirectToEpay() : requestScanPay() " class="btn btn-primary py-3 mx-auto btn-block">
                  Payer <strong>{{ presentPrice(epayFormData.amount) }}</strong>
                </a>
              </div>
            </div>
            <!-- card.// -->
          </aside>
        </div>
      </section>
      <footer-section></footer-section>
    </div>
    <div class=" card shadow p-3 m-3" v-if="this.$route.query.type == 'plan'">
      
        <div class="p-3 text-center">
          <h3>Total à payer </h3><br><span class="text-primary p-3 h1">{{ presentPrice(amount) }}</span>
        </div>
        <article class="box mb-3 bg-light">
            <dl class="dlist-align text-muted">
                <dt>Type:</dt>
                <dd class="text-right h4 ">{{ type == 'plan' ? 'Abonnement' : 'Non spécifié' }}</dd>
            </dl>
            <dl class="dlist-align text-muted">
                <dt>Détails:</dt>
                <dd class="text-right h4">{{ reference || 'Non spécifié'  }}</dd>
            </dl>
            <!-- <dl class="dlist-align">
                <dt><strong>Utilisateur:</strong></dt>
                <dd class="text-right"><strong>{{ object || 'Non spécifié'  }}</strong></dd>
            </dl> -->
        </article>
        <div class="text-center">
          <h4 class="text-muted py-3 ">Methodes de paiment</h4>
        </div>
        <div class="form-row">
         <div class="form-group col-12" >
                <label
                  class="js-check box rounded"
                  v-bind:class="formData.delivery === 'option1' ? 'active bg-light' : ''"
                >
                  <input
                    type="radio"
                    name="dostavka"
                    v-model="formData.delivery"
                    value="option1"
                    checked
                  />
                  <img
                    src="/img-payment/airtel_momo.png"
                    width="40"
                    class="img-fluid img-bg float-right thumbnail"
                  />
                  <img
                    src="/img-payment/unnamed.png"
                    width="40"
                    class="img-fluid img-bg mr-2 float-right thumbnail"
                  />

                  <h6 class="title">Epay Congo</h6>
                  <p class="text-muted small">
                    inclus: MTN MoMo, Airtel Money, Visa UBA et Mastercard
                  </p>
                </label>
                <!-- js-check.// -->
              </div>

              <!-- ScanPay -->
              <!-- <div class="form-group col-12">
                <label
                  class="js-check box rounded"
                  v-bind:class="formData.delivery === 'option2' ? 'active bg-light' : ''"
                >
                  <input
                    type="radio"
                    name="dostavka"
                    v-model="formData.delivery"
                    value="option2"
                  />
                  <div class="row-sm text-center float-right">
                    <img
                      src="/img-payment/logo.png"
                      width="120"
                      class="img-fluid img-bg float-right thumbnail"
                    /><br />
                  </div>
                  <h6 class="title">ScanPay</h6>
                  <p class="text-muted small">
                    inclus: MTN MoMo, Airtel Money, Visa, PayPal et Mastercard
                  </p>
                </label>
              </div> -->
       </div>
        <br>

        <a href="!#" @click.prevent="formData.delivery == 'option1' ? redirectToEpay() : requestScanPay()" class="btn btn-lg btn-primary btn-block"> Continue </a>
    </div>


    <b-modal id="bv-modal-scanpay" hide-footer backdrop content-class="shadow">
      <template #modal-title> ID de la commande: <span
              class="text-primary"
              >{{ successMessage }}
            </span></template>
      <div
        class="d-block text-center justify-content-center align-items-center"
      >
      <p class="text-primary padding-y-sm">
          Télécharger l'application <strong>ScanPay</strong> sur Google Play Store puis
          validé en scannant ou en saisissons le <strong>CodePay</strong><br>
          <a
            target="_blank"
            href="https://play.google.com/store/apps/details?id=net.hrmtech.zainmalonga.hrm_tech_biz_pro_242_app_wallet"
            class="btn btn-secondary"
            ><i class="fab fa-google-play text-light"></i> Télécharger
            ScanPay</a
          >
        </p>
       <h4>Scanner ce <strong>QrCode</strong></h4>
        
        <qrcode-vue :value="qrvalue" :size="qrsize" level="H"></qrcode-vue>
        <div class="row m-2">
            <div class="col"><hr></div>
            <div class="col-auto pt-1">OU</div>
            <div class="col"><hr></div>
        </div>
        <h4>Utiliser ce <strong>CodePay</strong></h4>
        <h2 class="text-primary"><span>{{ qrvalue | VMask('### ###') }}</span> </h2>
        <hr />
        <div class="row">
          <a href="#" @click.stop.prevent="checkScanPayPayment()" class="btn btn-lg btn-primary col-12 form-control-lg">
            <i class="fas fa-check pr-2"></i>
            J'ai validé mon paiement</a
          >
        </div>
      </div>
    </b-modal>

    <b-modal id="bv-modal-scanpay-confirmed" hide-footer backdrop content-class="shadow">
      <template #modal-title>Paiement validé</template>
      <div
        class="d-block text-center justify-content-center align-items-center"
      >
       <h2 class="text-danger py-3">Félicitations</h2>
       <img
          src="/images/order_success.jpeg"
          class="w-50 p-3"
          alt="Success Order image"
        />
        <h5 class="text-muted">Merci d'avoir choisis Kalisso.com pour vos courses</h5>
        <p class="text-danger b">Vous recevrez un SMS et un Email lorsque votre commande sera prête à être livré</p>
      </div>
      <hr>
       <vue-countdown-timer
            :key="componentKey"
            @start_callback="startCallBack('event started')"
            @end_callback="endCallBack('event ended')"
            :start-time="endAt"
            :end-time="endAt"
            :interval="1000"
            :start-label="'Vous allez être rediriger dans : '"
            :end-label="'Until end:'"
            label-position="begin"
            :end-text="''"
            :day-txt="''"
            :hour-txt="''"
            :minutes-txt="''"
            :seconds-txt="'s'"
          >
            <template slot="start-label" slot-scope="scope">
              <span
                style="color: red"
                v-if="
                  scope.props.startLabel !== '' &&
                  scope.props.tips &&
                  scope.props.labelPosition === 'begin'
                "
                >{{ scope.props.startLabel }}:</span
              >
              <span
                style="color: blue"
                v-if="
                  scope.props.endLabel !== '' &&
                  !scope.props.tips &&
                  scope.props.labelPosition === 'begin'
                "
                >{{ scope.props.endLabel }}:</span
              >
            </template>
            <template slot="countdown" slot-scope="scope">
             
              <span class="b h7">{{ scope.props.seconds }}</span
              ><i>{{ scope.props.secondsTxt }}</i>
            </template>

            <template slot="end-label" slot-scope="scope">
              <span
                class="mt-4"
                style="color: red"
                v-if="
                  scope.props.startLabel !== '' &&
                  scope.props.tips &&
                  scope.props.labelPosition === 'end'
                "
                >{{ scope.props.startLabel }}:</span
              >
              <span
                style="color: blue"
                v-if="
                  scope.props.endLabel !== '' &&
                  !scope.props.tips &&
                  scope.props.labelPosition === 'end'
                "
                >{{ scope.props.endLabel }}:</span
              >
            </template>

        
          </vue-countdown-timer>
    </b-modal>

    <!-- payment not confirmed -->
    <b-modal id="bv-modal-scanpay-not-confirmed" hide-footer backdrop content-class="shadow">
      <template #modal-title class="text-primary">Paiement non confirmé</template>
      <div
        class="d-block text-center justify-content-center align-items-center"
      >
      <h4 class="text-primary">Echec de paiement</h4>
       <img
          src="/images/aucun-moyen-aucun-concept-illustration_23-2148574633.jpeg"
          class="w-25 p-2"
          alt="Error Order image"
        />
        <p class="text-muted">
          {{ successMessage }}
        </p>
        <h4>Scanner ce <strong>QrCode</strong></h4>
        
        <qrcode-vue :value="qrvalue" :size="qrsize" level="H"></qrcode-vue>
        <div class="row m-2">
            <div class="col"><hr></div>
            <div class="col-auto pt-1">OU</div>
            <div class="col"><hr></div>
        </div>
        <h4>Utiliser ce <strong>CodePay</strong></h4>
        <h2 class="text-primary"> <span>{{ qrvalue | VMask('### ###') }}</span></h2>
        
      </div>
      <hr>
      <div class="row">
        <a href="#" @click.stop.prevent="checkScanPayPayment()" class="btn btn-lg btn-primary col-12 form-control-lg">
          <i class="fa fa-redo pr-2"></i>
          Vérfier à nouveau</a
        >
      </div>
      <!-- <b-button class="mt-3" block @click="$bvModal.hide('bv-modal-example')"
        >Close Me</b-button
      > -->
    </b-modal>

    <b-modal id="bv-modal-example" hide-footer backdrop content-class="shadow">
      <template #modal-title> Félicitations </template>
      <div class="d-block text-center">
        <h2 class="text-danger py-3">Félicitaions</h2>
        <img
          src="/images/order_success.jpeg"
          class="w-50 p-3"
          alt="Success Order image"
        />
        <h3>{{ successMessage }}</h3>
        <p class="text-primary">
          Choisissez votre méthode de paiement ci-dessous
          <!-- <vue-countdown-timer
            :key="componentKey"
            @start_callback="startCallBack('event started')"
            @end_callback="endCallBack('event ended')"
            :start-time="endAt"
            :end-time="endAt"
            :interval="1000"
            :start-label="'Vous allez être rediriger vers la page de paiement dans : '"
            :end-label="'Until end:'"
            label-position="begin"
            :end-text="''"
            :day-txt="''"
            :hour-txt="''"
            :minutes-txt="''"
            :seconds-txt="'s'"
          >
            <template slot="start-label" slot-scope="scope">
              <span
                style="color: red"
                v-if="
                  scope.props.startLabel !== '' &&
                  scope.props.tips &&
                  scope.props.labelPosition === 'begin'
                "
                >{{ scope.props.startLabel }}:</span
              >
              <span
                style="color: blue"
                v-if="
                  scope.props.endLabel !== '' &&
                  !scope.props.tips &&
                  scope.props.labelPosition === 'begin'
                "
                >{{ scope.props.endLabel }}:</span
              >
            </template>
            <template slot="countdown" slot-scope="scope">
             
              <span class="b h7">{{ scope.props.seconds }}</span
              ><i>{{ scope.props.secondsTxt }}</i>
            </template>

            <template slot="end-label" slot-scope="scope">
              <span
                class="mt-4"
                style="color: red"
                v-if="
                  scope.props.startLabel !== '' &&
                  scope.props.tips &&
                  scope.props.labelPosition === 'end'
                "
                >{{ scope.props.startLabel }}:</span
              >
              <span
                style="color: blue"
                v-if="
                  scope.props.endLabel !== '' &&
                  !scope.props.tips &&
                  scope.props.labelPosition === 'end'
                "
                >{{ scope.props.endLabel }}:</span
              >
            </template>

        
          </vue-countdown-timer> -->
        </p>
        <hr />
        <div class="form-row">
          <div class="col-6 justify-content-center align-items-center">
            <a
              href="#"
              @click.prevent="redirectToEpay()"
              class="btn btn-lg btn-primary col-12 form-control-lg"
            >
              <i class="fas fa-mobile-alt"></i>
              Mobile Money</a
            >
          </div>
          <div class="col-6 justify-content-center align-items-center">
            <a
              href="#"
              @click.prevent="requestScanPay()"
              class="btn btn-lg btn-info col-12 form-control-lg"
            >
              <i class="fas fa-qrcode"></i>
              ScanPay</a
            >
          </div>
        </div>
      </div>
      <!-- <b-button class="mt-3" block @click="$bvModal.hide('bv-modal-example')"
        >Close Me</b-button
      > -->
    </b-modal>
  </div>
</template>

<script>
import { integer } from "vee-validate/dist/rules";
import QrcodeVue from "qrcode.vue";

export default {
  props: {
    amount: {
      type: integer,
    },
    reference: {
      type: String,
    },
    type: "",
    object: [],
  },
  components: {
    QrcodeVue,
  },
  data() {
    return {
      formData: {
        delivery: "option1",
      },
      componentKey: 1,
      endAt: null,
      startAt: new Date().getTime(),
      qrvalue: "",
      qrsize: 160,
      loading: false,
      serverError: null,
      successMessage: null,
      cart: {
        product: '',
        amount: 0
      },
      epayFormData: {
        
      },
    };
  },
  mounted() {
    // this.getEpayData()
    if(this.$route.query.type == 'plan'){
      this.reference = this.$route.query.reference
      this.amount = this.$route.query.amount
      this.type = this.$route.query.type
      this.object = this.$route.query.object
      this.epayFormData = this.$route.query.object
    }
  },
  created() {
    // this.epayFormData = this.$route.params.data[1]
  },
  methods: {
    getEpayData(){
      this.loading = true
      this.$store.dispatch('getEpayData', this.epayFormData)
      .then((response) => {
        this.loading = false
        this.epayFormData = response.data.data
        this.epayFormData['amount'] = this.$route.query.amount
        this.epayFormData['reference'] = this.$route.query.reference
       // this.successMessage = 'Votre paiement a été effectué avec succès'
      })
      .catch(error => {
        this.loading = false
        this.serverError = error.response.data.message
      })
    },
    qrvalueCustom(data){
      return data.replace(/^(.{4})(.{4})(.{4})(.*)$/, "-")
    },
    checkScanPayPayment(){
      this.loading = true;
      this.$bvModal.hide("bv-modal-scanpay");
      this.$store
        .dispatch("checkScanPayPayment", {
          clientRef: this.epayFormData.Reference,
        })
        .then((response) => {
          this.loading = false;
          // this.qrvalue = response.data.payCode;
          if(response.status === 200 || response.ok || response.data.payUuid) {
            this.$bvModal.show("bv-modal-scanpay-confirmed");
            this.endAt = new Date().getTime() + 5000;
            console.log(response.data);
          }else if(response.status !== 200 ){
            this.successMessage = 'vous n\'avez pas encore validé le paiement de cette commande: '+response.data.clientRef;
            this.$bvModal.show("bv-modal-scanpay-not-confirmed");
            console.log(response.data);
          }else{
            alert('une erreur s\'est produite veuillez réessayer svp!')
          }
          console.log(response.status);
          // this.$router.push({ name: "home"});
        })
        .catch((error) => {
          this.loading = false;
          this.$toast.error({
            title: "Echec de connexion",
            message: error.response.data.message,
          });
          console.log(error);
        });
    },
    requestScanPay() {
      this.loading = true;
      this.$bvModal.hide("bv-modal-example");
      this.$store
        .dispatch("requestScanPay", {
          clientRef: this.epayFormData.Reference || this.epayFormData.reference,
          amount: this.epayFormData.amount,
        })
        .then((response) => {
          this.loading = false;
          this.qrvalue = response.data.payCode;
          this.successMessage = response.data.clientRef;
          this.$bvModal.show("bv-modal-scanpay");
          console.log(response.data);
        })
        .catch((error) => {
          this.loading = false;
          this.$toast.error({
            title: "Echec de connexion",
            message: error.response.data.message,
          });
          console.log(error);
        });
    },
    redirectToEpay() {
      this.loading = true;
      this.epayFormData.amount = this.epayFormData.amount+50
      let input =
        ' <input type="hidden" name="signature" value="' +
        this.epayFormData.signature +
        '" /><input type="hidden" name="amount" value="' +
        this.epayFormData.amount +
        '" /><input type="hidden" name="acid" value="' +
        this.epayFormData.acid +
        '" /><input type="hidden" name="emailId" value="' +
        this.epayFormData.emailId +
        '" /><input type="hidden" name="successurl" value="' +
        this.epayFormData.successurl +
        '" /><input type="hidden" name="cancelurl" value="' +
        this.epayFormData.cancelurl +
        '" /><input type="hidden" name="currency" value="' +
        this.epayFormData.currency +
        '" /><input type="hidden" name="Reference" value="' +
        this.epayFormData.Reference +
        '" />';
      document.body.innerHTML +=
        '<form id="epayForm" action="' +
        this.epayFormData.url +
        '" method="post">' +
        input +
        "</form>";
      document.getElementById("epayForm").submit();

      this.$bvModal.hide("bv-modal-example");
      this.loading = false;
    },
    startCallBack: function (x) {
      console.log(x);
    },
    endCallBack: function (x) {
      // this.redirectToEpay();
      // return console.log(this.paymentFormData)
      // this.$router.push({ name: "home" });
      this.$router.push({ name: "thankyou", params: {data: 'success'} });
      // console.log(x);
    },
  },
};
</script>

<style>
.box rounded -selection.active {
  border-color: #e50000;
}

.box rounded -selection {
  border: 2px solid #ededed;
  margin-bottom: 10px;
  display: block;
  padding: 15px;
  border-radius: 0.5rem;
}

input[type="checkbox"] {
  /* change "blue" browser chrome to yellow */
  filter: (0.5);
}
</style>