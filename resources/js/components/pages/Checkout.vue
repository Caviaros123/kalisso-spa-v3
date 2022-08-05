<template>
  <div class="page-wrapper">
    <Spinner v-if="loading" />
    <!-- <nav-section ></nav-section> -->
    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content padding-y">
      <div class="container" style="max-width: 720px">
        <div class="justify-content-left align-items-center py-3" align="left">
          <router-link :to="{name: 'products.shopping'}"  class="btn btn-danger">
           <i class="fa fa-caret-left mr-2"></i> Annuler cette commande <i class="fa fa-trash ml-2"></i>
          </router-link>
        </div>
        <div class="card mb-4">
          <form action="" @submit.stop.prevent="setNewOrder()" method="post">
            <div class="card-body">
              <h4 class="card-title mb-3">Informations de livraison</h4>

              <div class="form-row">
                <div class="form-group col-sm-6">
                  <label
                    class="js-check box"
                    v-bind:class="
                      formData.delivery === 'option1' ? 'active' : ''
                    "
                  >
                    <input
                      type="radio"
                      name="dostavka"
                      v-model="formData.delivery"
                      value="option1"
                      checked
                    />
                    <h6 class="title">Livraison Standard</h6>
                    <p class="text-muted">Gratuit</p>
                  </label>
                  <!-- js-check.// -->
                </div>
                <div class="form-group col-sm-6">
                  <label
                    class="js-check box"
                    v-bind:class="
                      formData.delivery === 'option2' ? 'active' : ''
                    "
                  >
                    <input
                      type="radio"
                      name="dostavka"
                      v-model="formData.delivery"
                      value="option2"
                    />
                    <h6 class="title">Livraison Noki</h6>
                    <p class="text-muted">+{{ presentPrice(2000) }}</p>
                  </label>
                  <!-- js-check.// -->
                </div>
              </div>
              <!-- form row.// -->
              <div class="form-row" v-if="defaultAddress.length !== 0">
                <label for="address" class="b text-success pl-2"
                  >Vous avez une adresse par defaut</label
                >
                <div class="form-group col-md-12" id="address">
                  <label
                    class="js-check box"
                    v-bind:class="
                      formData.useDefaultAddress === true ? 'active' : ''
                    "
                  >
                    <input
                      type="checkbox"
                      name="address"
                      class="input-checkbox c5"
                      v-model="formData.useDefaultAddress"
                    />
                    <h6 class="title pl-4">
                      Utiliser votre adresse par défaut
                      <span class="text-danger b">{{
                        defaultAddress.title
                      }}</span>
                    </h6>
                    <p class="text-muted pl-5">
                      {{
                        defaultAddress.recipient_name +
                        ", " +
                        defaultAddress.phone_number +
                        ", " +
                        defaultAddress.address_line1 +
                        ", " +
                        defaultAddress.country +
                        ", " +
                        defaultAddress.state
                      }}
                    </p>
                  </label>
                  <!-- js-check.// -->
                </div>
                <hr />
              </div>

              <div v-if="formData.useDefaultAddress === false">
                <div class="form-row">
                  <div class="col form-group">
                    <label>Nom</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="formData.setNewAddress.name"
                      placeholder="Saisissez votre nom"
                    />
                  </div>
                  <!-- form-group end.// -->
                  <div class="col form-group">
                    <label>Prénom</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="formData.setNewAddress.lastname"
                      placeholder="Saisissez votre prénom"
                    />
                  </div>
                  <!-- form-group end.// -->
                </div>
                <!-- form-row end.// -->

                <div class="form-row">
                  <div class="col form-group">
                    <label>Email</label>
                    <input
                      type="email"
                      v-model="formData.setNewAddress.email"
                      class="form-control"
                      placeholder="Saisissez votre adresse email"
                    />
                  </div>
                  <!-- form-group end.// -->
                  <div class="col form-group">
                    <label>Téléphone</label>
                    <vue-tel-input
                      v-model="formData.setNewAddress.phone"
                      v-bind="bindProps"
                      class="form-control"
                      placeholder="Saisissez votre numéro de téléphone"
                      aria-describedby="input-1-live-feedback"
                    >
                    </vue-tel-input>
                    <!-- <input type="text" v-model="formData.phone" class="form-control" placeholder="Saisissez votre numéro de téléphone"> -->
                  </div>
                  <!-- form-group end.// -->
                </div>
                <!-- form-row end.// -->

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Pays</label>
                    <select
                      id="inputState"
                      v-model="formData.setNewAddress.country"
                      class="form-control"
                    >
                      <option hidden>Choisir...</option>
                      <option selected value="Congo-Brazzaville">
                        Congo-Brazzaville
                      </option>
                      <option value="Congo-Kinshasa">RDC</option>
                      <option value="Gabon">Gabon</option>
                      <option value="Cameroun">Cameroun</option>
                      <option value="Sénegal">Sénegal</option>
                    </select>
                  </div>
                  <!-- form-group end.// -->
                  <div class="form-group col-md-6">
                    <label>Ville</label>
                    <input
                      type="text"
                      v-model="formData.setNewAddress.city"
                      class="form-control"
                    />
                  </div>
                  <!-- form-group end.// -->
                </div>
                <!-- form-row.// -->
                <div class="form-group">
                  <label
                    >Adresse
                    <i class="fa fa-map-marker-alt text-primary"></i>
                  </label>
                  <textarea
                    class="form-control"
                    v-model="formData.setNewAddress.address"
                    placeholder="Ex: 112 rue de la paix Moungalie Brazzaville"
                    rows="2"
                  ></textarea>
                  <!-- <places
                class="form-control"
                v-model="formData.country.label"
                placeholder="Saisissez votre adresse complète"
                @change="val => { formData.country.data = val }"
                :options="options"> 
                 </places> -->
                </div>
                <!-- form-group// -->
              </div>
              <div
                class="custom-control custom-checkbox"
                v-if="formData.useDefaultAddress === false"
              >
                <input
                  type="checkbox"
                  class="custom-control-input"
                  id="customCheck1"
                  v-model="formData.setNewAddress.saveAsDefaultAddress"
                />
                <label
                  class="custom-control-label text-muted"
                  for="customCheck1"
                  >Sauvegarder cette nouvelle adresse comme par défaut</label
                >
              </div>

              <div class="form-group padding-y-sm">
                <button
                  type="submit"
                  :disabled="loading"
                  class="btn btn-primary btn-block d-none d-md-block "
                >
                  <span
                    v-if="loading"
                    class="spinner-border spinner-border-sm"
                    role="status"
                    aria-hidden="true"
                  ></span>
                  Payer {{ presentPrice(totalToPaid()) }}
                </button>
              </div>
              <span v-if="successMessage">{{ successMessage }}</span>
              <span v-if="serverError">{{ serverError }}</span>
            </div>
            <div class="card shadow fixed-bottom d-block d-md-none mx-auto padding-y-sm px-3">
                <button :disabled="loading" href="#" type="submit" class="btn btn-primary py-3 mx-auto btn-block">
                Payer <strong>{{ presentPrice(totalToPaid()) }}</strong>
                </button>
            </div>
          </form>
          <!-- card-body.// -->
        </div>
        <!-- card .// -->

        <div class="card mb-4" hidden>
          <div class="card-body">
            <h4 class="card-title mb-4">Payment</h4>
            <form role="form" style="max-width: 380px">
              <div class="form-group">
                <label for="username">Name on card</label>
                <input
                  type="text"
                  class="form-control"
                  name="username"
                  placeholder="Ex. John Smith"
                  required=""
                />
              </div>
              <!-- form-group.// -->

              <div class="form-group">
                <label for="cardNumber">Card number</label>
                <div class="input-group">
                  <input
                    type="text"
                    class="form-control"
                    name="cardNumber"
                    placeholder=""
                  />
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <i class="fab fa-cc-visa"></i> &nbsp;
                      <i class="fab fa-cc-amex"></i> &nbsp;
                      <i class="fab fa-cc-mastercard"></i>
                    </span>
                  </div>
                </div>
                <!-- input-group.// -->
              </div>
              <!-- form-group.// -->

              <div class="row">
                <div class="col-md flex-grow-0">
                  <div class="form-group">
                    <label class="hidden-xs">Expiration</label>
                    <div class="form-inline" style="min-width: 220px">
                      <select class="form-control" style="width: 100px">
                        <option>MM</option>
                        <option>01 - Janiary</option>
                        <option>02 - February</option>
                        <option>03 - February</option>
                      </select>
                      <span style="width: 20px; text-align: center"> / </span>
                      <select class="form-control" style="width: 100px">
                        <option>YY</option>
                        <option>2018</option>
                        <option>2019</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label title="3 digits code on back side of the card"
                      >CVV <i class="fa fa-question-circle"></i
                    ></label>
                    <input class="form-control" required="" type="text" />
                  </div>
                  <!-- form-group.// -->
                </div>
              </div>
              <!-- row.// -->
              <button class="subscribe btn btn-primary btn-block" type="button">
                Confirm
              </button>
            </form>
          </div>
          <!-- card-body.// -->
        </div>
        <!-- card .// -->

        <br /><br />
      </div>
      <!-- container .//  -->
    </section>

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
      <!-- <b-button class="mt-3" block @click="$bvModal.hide('bv-modal-example')"
        >Close Me</b-button
      > -->
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
      <!-- <b-button class="mt-3" block @click="$bvModal.hide('bv-modal-example')"
        >Close Me</b-button
      > -->
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
        <h2 class="text-danger py-3">Félicitations</h2>
        <img
          src="/images/order_success.jpeg"
          class="w-50 p-3"
          alt="Success Order image"
        />
        <h3>{{ successMessage }}</h3>
        <p class="text-primary">
          Choisissez votre methode de paiement ci-dessous
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
              class="btn btn-lg btn-warning col-12 form-control-lg"
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

    <!-- ========================= SECTION CONTENT END// ========================= -->
    <!-- <footer-section ></footer-section> -->
    
  </div>
</template>


<script>
import { numeric } from "vee-validate/dist/rules";
import QrcodeVue from "qrcode.vue";
// import Places from 'vue-places';

export default {
  props: {
    totalPrice: {
      type: Number,
    },
  },
  data() {
    return {
      //   options: {
      //     appId: 'Kalisso.com',
      //     apiKey: 'AIzaSyCc2BBFgf_osbxj-5-E_KQKEV4SuATFuRI',
      //     countries: ['CG'],
      //   },
      componentKey: 1,
      loading: false,
      defaultAddress: [],
      endAt: null,
      startAt: new Date().getTime(),
      qrvalue: "",
      qrsize: 160,

      formData: {
        delivery: "option1",
        useDefaultAddress: false,
        saveForLater: null,
        setNewAddress: {
          name: "",
          lastname: "",
          email: "",
          phone: "",
          country: "",
          city: "",
          address: "",
          saveAsDefaultAddress: false,
        },
      },
      bindProps: {
        mode: "international",
        defaultCountry: "CG",
        disabledFetchingCountry: false,
        disabled: false,
        disabledFormatting: false,
        autoDefaultCountry: true,
        enabledCountryCode: true,
        enabledFlags: true,
        preferredCountries: ["CG", "CD"],
        autocomplete: "on",
        name: "telephone",
        validCharactersOnly: true,
        styleClasses: "proTelWrapper",
        dropdownOptions: {
          disabledDialCode: false,
          showFlags: true,
          showDialCodeInList: true,
        },
        inputOptions: {
          // showDialCode: true,
          styleClasses: "telstyle",
          maxlength: 20,
          type: "tel",
          placeholder: "Votre numéro de téléphone",
          required: true,
          trim: true,
        },
      },
      serverError: null,
      successMessage: null,
      paymentFormData: {
        url: "",
        amount: "",
        signature: "",
        acid: "",
        emailId: "",
        successurl: "",
        cancelurl: "",
        currency: "",
        Reference: "",
      },
    };
  },
  mounted() {
    this.useDefaultAddress();
  },
  methods: {
    cancelOrder(){

    },
    qrvalueCustom(data){
      return data.replace(/^(.{4})(.{4})(.{4})(.*)$/, "-")
    },
    checkScanPayPayment(){
      this.loading = true;
      this.$bvModal.hide("bv-modal-scanpay");
      this.$store
        .dispatch("checkScanPayPayment", {
          clientRef: this.paymentFormData.Reference,
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
          clientRef: this.paymentFormData.Reference,
          amount: this.paymentFormData.amount,
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
      let input =
        ' <input type="hidden" name="signature" value="' +
        this.paymentFormData.signature +
        '" /><input type="hidden" name="amount" value="' +
        this.paymentFormData.amount +
        '" /><input type="hidden" name="acid" value="' +
        this.paymentFormData.acid +
        '" /><input type="hidden" name="emailId" value="' +
        this.paymentFormData.emailId +
        '" /><input type="hidden" name="successurl" value="' +
        this.paymentFormData.successurl +
        '" /><input type="hidden" name="cancelurl" value="' +
        this.paymentFormData.cancelurl +
        '" /><input type="hidden" name="currency" value="' +
        this.paymentFormData.currency +
        '" /><input type="hidden" name="Reference" value="' +
        this.paymentFormData.Reference +
        '" />';
      document.body.innerHTML +=
        '<form id="epayForm" action="' +
        this.paymentFormData.url +
        '" method="post">' +
        input +
        "</form>";
      document.getElementById("epayForm").submit();

      this.$bvModal.hide("bv-modal-example");
      this.loading = false;
    },
    setNewOrder() {
      this.loading = true;
      this.successMessage = "";
      this.serverError = "";

      this.$store
        .dispatch("setNewOrder", {
          amount: this.totalToPaid(),
          cartItemList: JSON.parse(localStorage.getItem("cartItem")),
          useDefaultAddress: this.formData.useDefaultAddress,
          deliveryOption: this.formData.delivery,
          newAddress: this.formData.setNewAddress,
        })
        .then((response) => {
          // console.log(response)
          // this.formData = "";
          // this.endAt = new Date().getTime() + 10000;
          this.successMessage = response.data.message;
          this.serverError = "";
          this.$bvModal.show("bv-modal-example");

          // init variable for payment
          this.paymentFormData.url = response.data.data.url;
          this.paymentFormData.amount = this.totalToPaid();
          this.paymentFormData.signature = response.data.data.signature;
          this.paymentFormData.acid = response.data.data.acid;
          this.paymentFormData.emailId = response.data.data.emailId;
          this.paymentFormData.successurl = response.data.data.successurl;
          this.paymentFormData.cancelurl = response.data.data.cancelurl;
          this.paymentFormData.currency = response.data.data.currency;
          this.paymentFormData.Reference = response.data.data.Reference;

          this.$toast.success({
            title: "Félicitations",
            message: response.data.message,
          });
          this.$store.dispatch("retrieveUserInfo").then((response) => {
            this.loading = false;
          });
          // this.$router.push({ name: "profile.index" });
        })
        .catch((error) => {
          this.loading = false;
          this.$toast.error({
            title: "Echec de connexion",
            message: error.response.data.message,
          });
          this.serverError = error.response.data.message;
          this.password = "";
          this.successMessage = "";
        });
    },
    totalToPaid() {
      let total = 0;
      if (this.formData.delivery === "option2") {
        total = this.totalPrice + 2000;
      } else {
        total = this.totalPrice;
      }

      return total;
    },
    useDefaultAddress() {
      let getDefaultAddress = this.$store.state.address;

      if (getDefaultAddress !== null) {
        this.defaultAddress = getDefaultAddress;
      }
    },
    resendOtpCode() {
      (this.startAt = new Date().getTime()),
        (this.endAt = new Date().getTime() + 5000),
        (this.componentKey += 1);

      this.initRecaptha();
    },
    startCallBack: function (x) {
      console.log(x);
    },
    endCallBack: function (x) {
      // this.redirectToEpay();
      // return console.log(this.paymentFormData)
      this.$router.push({ name: "home" });
      // console.log(x);
    },
  },
  components: {
    QrcodeVue,
  },
};
</script>

<style scoped>

input[type="checkbox"] {
  /* change "blue" browser chrome to yellow */
  filter: (0.5);
}

.btn-warning{
  background-color: orange!important;
  border-color: rgb(53, 170, 59)!important;
}

</style>