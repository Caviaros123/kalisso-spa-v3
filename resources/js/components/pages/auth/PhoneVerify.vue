<template>
  <div class="page-wrapper">
    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content padding-y-xs" style="min-height: 16vh">
      <!-- ============================ COMPONENT LOGIN   ================================= -->
      <div
        class="mx-auto padding-y-md"
        align="center"
        style="max-width: 380px; margin-top: 6%"
      >
        <router-link :to="{ name: 'home' }">
          <img
            src="/images/logo.png"
            class="center-block w-50 padding-y img-fluid"
            alt="Logo Kalisso"
          />
        </router-link>
      </div>
      <div v-if="successMessage" class="alert alert-success text-center m-2">
        {{ successMessage }}
      </div>
      <div v-if="serverError" class="alert alert-danger text-center m-2">
        {{ serverError }}
      </div>
      <!-- //recaptcha-container -->
      <!-- <div id="recaptcha" class="card mx-auto" style="max-width: 380px; margin-top: 10px">
       
        <div class="p-2 my-3">
          <h6 class="text-muted text-center small b mx-auto">Nous vérifions si vous êtes pas un robot</h6>
        </div>


      </div> -->
      <!-- // end recaptcha-container -->

      <div
        id="inputOtp"
        class="card mx-auto"
        style="max-width: 380px; margin-top: 10px"
      >
        <div class="card-body" align="center">
          <i class="fa text-danger fa-sms fa-3x"></i>
          <h5 class="card-title">Vérification du Téléphone</h5>
          <small>Nous avons envoyez un code par SMS au </small>
          <h5 class="mb-4">{{ phone }}</h5>
          <form @submit.stop.prevent="verify">
            <div class="form-group">
              <v-otp-input
                inputClasses="otp-input"
                :numInputs="6"
                :isInputNum="true"
                separator=" "
                :shouldAutoFocus="true"
                @on-complete="handleOnComplete"
                @on-change="handleOnChange"
              />
            </div>
            <!-- form-group form-check .// -->
            <!-- <button type="submit" class="btn btn-primary btn-block">
                Verifier
              </button> -->
            <!-- <vue-recaptcha
                ref="invisibleRecaptcha"
                @verify="onVerify"
                @expired="onExpired"
                size="invisible"
                :sitekey="'6LchoJccAAAAAHye8tUq1LNJRSDzbFiPUA5rvtjk'"
              >
              </vue-recaptcha> -->

            <!-- <button class="btn btn-primary btn-block">Verifier</button> -->
            <div class="small mt-4">
              <!-- Renvoi du code de vérification dans:
              <span class="text-primary b h6">01:00s</span> -->

              <vue-countdown-timer
                :key="componentKey"
                @start_callback="startCallBack('event started')"
                @end_callback="endCallBack('event ended')"
                :start-time="endAt"
                :end-time="endAt"
                :interval="1000"
                :start-label="'Renvoi du code de vérification dans'"
                :end-label="'Until end:'"
                label-position="begin"
                :end-text="'Renvoyer le code'"
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
                  <!-- <span>{{ scope.props.days }}</span
                  ><i>{{ scope.props.dayTxt }}</i>
                  <span>{{ scope.props.hours }}</span
                  ><i>{{ scope.props.hourTxt }}</i>
                  <span>{{ scope.props.minutes }}</span
                  ><i>{{ scope.props.minutesTxt }}</i> -->
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

                <template slot="end-text" slot-scope="scope">
                  <a
                    href="#"
                    @click="resendOtpCode()"
                    class="btn-link text-danger"
                    ><i class="fa fa-redo"></i> {{ scope.props.endText }}
                  </a>
                  <!-- <a href="#" @click="startAt = new Date().getTime()" class="border p-2 btn btn-danger solid border-warning mt-4 rounded"> <i class="fa fa-paper-plane fa-1x"></i></a> -->
                  <!-- <i class="fa fa-refresh" aria-hidden="true"></i> -->
                </template>
              </vue-countdown-timer>
              <div id="recaptcha-container"></div>
            </div>
            <!-- form-group// -->
          </form>
        </div>
        <!-- card-body.// -->
      </div>
      <!-- card .// -->

      <p class="text-center mt-4">
        Vous n'avez pas de compte?
        <router-link :to="{ name: 'register' }" href="#"
          >Inscrivez-vous ici</router-link
        >
      </p>
      <br /><br />
      <!-- ============================ COMPONENT LOGIN  END.// ================================= -->
    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->
  </div>
</template>

<script>
import firebase from "firebase";
import OtpInput from "@bachdgvn/vue-otp-input"
import CountdownTimer from "vuejs-countdown-timer"

import "firebase/auth";
// import VueRecaptcha from "vue-recaptcha";

export default {
  props: {
    phoneNumber: {
      type: String,
    },
  },
  components: {
    "v-otp-input": OtpInput,
    CountdownTimer,
    // VueRecaptcha,
  },
  data() {
    return {
      phone: this.phoneNumber,
      endAt: new Date().getTime() + 120000,
      startAt: new Date().getTime(),
      serverError: "",
      successMessage: "",
      componentKey: 0,

      //phone init
      // confirmationResult: null,
      user: null,
      otp: null,
      smsSent: false,
      recaptchaVerifier: null,
      recaptchaWidgetId: null,
      confirmResult: null,
      appVerifier: "",
    };
  },
  mounted() {
    firebase.auth().useDeviceLanguage();
    this.initRecaptha();
  },
  // components: { VueRecaptcha },
  methods: {
    resendOtpCode() {
      (this.startAt = new Date().getTime()),
        (this.endAt = new Date().getTime() + 60000),
        (this.componentKey += 1);

        this.initRecaptha();
    },
    startCallBack: function (x) {
      console.log(x);
    },
    endCallBack: function (x) {
      console.log(x);
    },
    handleOnComplete(value) {
      // alert("OTP completed: "+ value);
      this.otp = value;
      this.verifyOtp();
    },
    handleOnChange(value) {
      console.log("OTP changed: ", value);
    },
    handleClearInput() {
      this.$refs.otpInput.clearInput();
    },
    initRecaptha() {
      let vm = this;

      window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
        "recaptcha-container",
        {
          size: "invisible",
          callback: function (response) {
            // reCAPTCHA solved, allow signInWithPhoneNumber.
            // ...
            vm.$toast.warning({
              title: "Verification",
              message: "Nous avons vérifier que vous n'êtespas un robot",
            });
            // alert("Success recaptcha");
            // this.sendOtp();
          },
          "expired-callback": function () {
            // Response expired. Ask user to solve reCAPTCHA again.
            // ...

            vm.$toast.warning({
              title: "Verification Expiré",
              message: "La vérificaton a expiré, veuillez recharger cette page",
            });
            // alert("Echec recaptcha");
          },
        }
      );
      recaptchaVerifier.render();
      this.appVerifier = window.recaptchaVerifier;
      this.sendOtp();
    },
    sendOtp() {
      let vm = this;

      firebase
        .auth()
        .signInWithPhoneNumber(this.phone, this.appVerifier)
        .then(function (confirmationResult) {
          window.confirmationResult = confirmationResult;
          vm.$toast.info({
            title: "SMS Envoyé",
            message: "Vous allez recevoir un SMS de confirmation",
          });
          // alert("Sms Sent!  Message envoyé avec succès.");
        })
        .catch(function (error) {
          vm.$toast.error({
            title: "Erreur d'envoi du SMS",
            message: error.message,
          });
          // alert(error.message);
        });
    },
    verifyOtp() {
      let vm = this;
      let code = vm.otp;
      //
      window.confirmationResult
        .confirm(code)
        .then(function (result) {
          // User signed in successfully.
          // var user = result.user;
          vm.$toast.success({
            title: "Félicitations",
            message: "Vous êtes inscrit à Kalisso.com",
          });
          // ...
          //route to login page !
          vm.$router.push({ name: "login" });
        })
        .catch(function (error) {
          vm.$toast.error({
            title: "Erreur de vérification",
            message: error.message,
          });
          alert(error.message);
        });
    },
  },
};
</script>

<style lang="css" >
.otp-input {
  width: 40px;
  height: 40px;
  padding: 5px;
  margin: 0 8px;
  font-size: 20px;
  border-radius: 4px;
  border: 1px solid rgba(0, 0, 0, 0.3);
  box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 10%) !important;
  text-align: center;
}
.otp-input:focus-visible {
  border-color: crimson;
}
.otp-input::-webkit-inner-spin-button,
.otp-input::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
.error {
  border: 1px solid red !important;
}
</style>