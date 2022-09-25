<template>
  <div class="page-wrapper">
    <!-- //spinner overlay -->
    <Spinner v-show="loading"/>
    <!-- // end spinner overlay -->
    <section class="section-content padding-y-xs" style="min-height: 16vh">
      <!-- ============================ COMPONENT LOGIN   ================================= -->
      <div
        class="mx-auto padding-y-md"
        align="center"
        style="max-width: 380px; margin-top: 2%"
      >
        <router-link :to="{ name: 'home' }">
          <img
            src="/images/logo.png"
            class="center-block w-50 padding-y img-fluid"
            alt="Logo Kalisso"
          />
        </router-link>
      </div>
      <div class="card mx-auto" style="max-width: 520px; margin-top: 10px">
        <div v-if="successMessage" class="alert alert-success text-center m-2">
          {{ successMessage }}
        </div>
        <div v-if="serverErrors">
          <div
            class="alert alert-danger text-center m-2"
            v-for="(value, key) in serverErrors"
            :key="key[0]"
            v-text="value[0]"
          ></div>
        </div>

        <article class="card-body">
          <header class="mb-4">
            <h4 class="card-title">Inscrivez-vous</h4>
          </header>

          <validation-observer ref="observer" v-slot="{ handleSubmit }">
            <b-form @submit.stop.prevent="handleSubmit(singUp)">
              <!-- <form action="#" method="POST" @submit.prevent="singUp()"> -->
               <div class="form-row">
                <div class="form-group col-md-6 pb-0 mb-0">
                  <validation-provider
                    name="Nom"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                  >
                    <b-form-group
                      id="example-input-group-1"
                      label="Nom"
                      label-for="firstname"
                    >
                      <b-form-input
                        type="text"
                        id="firstname"
                        name="firstname"
                        v-model="formData.firstname"
                        :state="getValidationState(validationContext)"
                        aria-describedby="input-2-live-feedback"
                        placeholder="Votre nom"
                      ></b-form-input>

                      <b-form-invalid-feedback id="input-2-live-feedback">{{
                        validationContext.errors[0]
                      }}</b-form-invalid-feedback>
                    </b-form-group>
                  </validation-provider>
                </div>
                <!-- form-group end.// -->
                <div class="form-group col-md-6 pb-0 mb-0">
                  <validation-provider
                    name="Prénom"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                  >
                    <b-form-group
                      id="example-input-group-1"
                      label="Prénom"
                      label-for="lastname"
                    >
                      <b-form-input
                        type="text"
                        id="lastname"
                        name="lastname"
                        v-model="formData.lastname"
                        :state="getValidationState(validationContext)"
                        aria-describedby="input-2-live-feedback"
                        placeholder="Votre prénom"
                      ></b-form-input>

                      <b-form-invalid-feedback id="input-2-live-feedback">{{
                        validationContext.errors[0]
                      }}</b-form-invalid-feedback>
                    </b-form-group>
                  </validation-provider>
                </div>
              </div>

              <validation-provider
                name="Téléphone"
                :rules="{ required: true, min: 10 }"
                v-slot="validationContext"
              >
                <b-form-group
                  id="example-input-group-1"
                  label="Téléphone"
                  label-for="example-input-1"
                >
                  <vue-tel-input
                    v-model="formData.phone"
                    v-bind="bindProps"
                    class="form-control"
                    :state="getValidationState(validationContext)"
                    aria-describedby="input-1-live-feedback"
                  >
                  </vue-tel-input>

                  <b-form-invalid-feedback id="input-1-live-feedback">{{
                    validationContext.errors[0]
                  }}</b-form-invalid-feedback>
                </b-form-group>

                <!-- <small class="form-text text-muted mb-3"
                  >Nous ne partagerons jamais votre téléphone avec quelqu'un
                  d'autre.
                  <i class="fas fa-exclamation-triangle text-danger"></i
                ></small> -->
              </validation-provider>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <validation-provider
                    name="Mot de passe"
                    :rules="{ required: true, min: 8 }"
                    v-slot="validationContext"
                  >
                    <b-form-group
                      id="example-input-group-1"
                      label="Mot de passe"
                      label-for="password"
                    >
                      <b-form-input
                        type="password"
                        id="password"
                        name="password"
                        v-model="formData.password.password"
                        :state="getValidationState(validationContext)"
                        aria-describedby="input-1-live-feedback"
                        minlength="8"
                        placeholder="Saisissez votre mot de passe"
                      ></b-form-input>

                      <b-form-invalid-feedback id="input-1-live-feedback">{{
                        validationContext.errors[0]
                      }}</b-form-invalid-feedback>
                    </b-form-group>
                  </validation-provider>
                </div>
                <!-- form-group end.// -->
                <div class="form-group col-md-6">
                  <validation-provider
                    name="Confirmer votre mot de passe"
                    :rules="{ required: true, min: 8, confirmed: 'Mot de passe' }"
                    v-slot="validationContext"
                  >
                    <b-form-group
                      id="example-input-group-1"
                      label="Confirmer votre mot de passe"
                      label-for="confirmPassword"
                    >
                      <b-form-input
                        type="password"
                        id="confirmPassword"
                        name="password_confirmation"
                        v-validate="'required|confirmed:password'"
                        v-model="formData.password.confirm"
                        :state="getValidationState(validationContext)"
                        aria-describedby="input-2-live-feedback"
                        minlength="8"
                        placeholder="Confirmer votre mot de passe"
                      ></b-form-input>

                      <b-form-invalid-feedback id="input-2-live-feedback">{{
                        validationContext.errors[0]
                      }}</b-form-invalid-feedback>
                    </b-form-group>
                  </validation-provider>
                </div>
              </div>

              <div class="form-group">
                <label class="custom-control custom-checkbox">
                  <input
                    type="checkbox"
                    class="custom-control-input"
                    v-model="formData.terms"
                    required="required"
                  />
                  <div class="custom-control-label">
                    J'accepte les
                    <router-link :class="'text-danger'" to="/privacy"
                      >termes et contitions</router-link
                    >
                  </div>
                </label>
              </div>
              <div class="form-group">
                <label class="custom-control custom-checkbox">
                  <input
                    type="checkbox"
                    class="custom-control-input"
                    v-model="formData.beingSeller"
                  />
                  <div class="custom-control-label">
                    Je souhaite vendre sur
                    <span :class="'text-danger'">Kalisso</span>
                  </div>
                </label>
              </div>
              <div class="form-group">
                <b-button type="submit" variant="btn btn-primary btn-block">Inscription</b-button>
              </div>
            </b-form>
          </validation-observer>
        </article>
        <!-- card-body.// -->
      </div>
      <!-- card .// -->
      <p class="text-center mt-4">
        Vous avez déja un compte Kalisso?
        <router-link :to="{ name: 'login' }" href="#"
          >Connectez-vous ici</router-link
        >
      </p>
      <br /><br />
      <!-- ============================ COMPONENT REGISTER  END.// ================================= -->
    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->
  </div>
</template>

<script>
import { ValidationProvider, extend } from "vee-validate";
import { required } from "vee-validate/dist/rules";

extend("required", {
  ...required,
  message: "Ce champ est requis",
});

export default {
  data() {
    return {
      loading: false,
      formData: {
        firstname: null,
        lastname: null,
        phone: null,
        password: {
          password: null,
          confirm: null,
        },
        email: null,
        referral: null,
        terms: false,
        beingSeller: false,
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
        styleClasses: 'proTelWrapper',
        dropdownOptions: {
          disabledDialCode: false,
          showFlags: true,
          showDialCodeInList: true,
        },
        inputOptions: {
          // showDialCode: true,
          styleClasses: 'telstyle',
          maxlength: 20,
          type: 'tel',
          placeholder: "Votre numéro de téléphone",
          required: true,
          trim: true,
        },
      },
      serverErrors: null,
      successMessage: null,
    };
  },
  methods: {
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },
    resetForm() {
      this.form = {
        name: null,
        food: null,
      };

      this.$nextTick(() => {
        this.$refs.observer.reset();
      });
    },
    validateBeforeSubmit() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          this.singUp();
        }
      });
    },
    singUp() {
      this.loading = true
      this.$store
        .dispatch("register", {
          firstname: this.formData.firstname,
          lastname: this.formData.lastname,
          phone: this.formData.phone.split(" ").join(""),
          password: this.formData.password.password,
          password_confirmation: this.formData.password.confirm,
          isSeller: this.formData.beingSeller,
          terms: this.formData.terms,
          // referral: this.formData.referral.split(" ").join(""),
          status: "registerWithPhone",
        })
        .then((response) => {
          this.successMessage = "Vous êtes inscrit sur kalisso.com!";
          this.serverErrors = "";
          this.$toast.success({
            title: "Succès",
            message: "Vous êtes inscrit sur kalisso.com!",
          });
          this.loading = false
          this.$router.push({
            name: "phone.verify",
            params: { phoneNumber: this.formData.phone },
          });
        })
        .catch((error) => {
           this.successMessage = ""
           this.serverErrors = Object.values(error.response.data.errors);
           this.serverErrors.forEach(element => {
              this.$toast.error({
                title: "Echec lors de l'inscription",
                message: element[0],
              });
           });
          this.loading = false
          // console.log(error.response.data)
        });
    },
  },
  components: {
    ValidationProvider,
  },
};
</script>
