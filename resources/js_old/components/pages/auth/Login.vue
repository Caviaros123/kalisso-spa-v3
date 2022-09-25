<template>
  <div class="page-wrapper">
    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content " style="min-height: 16vh">
      <!-- ============================ COMPONENT LOGIN   ================================= -->
      <div
        class="mx-auto "
        align="center"
        style="max-width: 380px; margin-top: 3%"
      >
        <router-link :to="{ name: 'home' }">
          <img
            src="/images/logo.png"
            class="center-block w-50 padding-y img-fluid"
            alt="Logo Kalisso"
          />
        </router-link>
      </div>
      <div class="card mx-auto" style="max-width: 380px; margin-top: 10px">
        <!-- //spinner overlay -->
        <Spinner v-show="loading" />
        <!-- // end spinner overlay -->

        <div v-if="successMessage" class="alert alert-success text-center m-2">
          {{ successMessage }}
        </div>
        <div v-if="serverError" class="alert alert-danger text-center m-2">
          {{ serverError }}
        </div>

        <div class="card-body text-center text-muted">
          <h4 class="card-title mb-4">Identifiez-vous</h4>
          <validation-observer ref="observer" v-slot="{ handleSubmit }">
            <b-form @submit.stop.prevent="handleSubmit(login)">
              <div class="form-group">
                <validation-provider
                  name="Username"
                  :rules="{ required: true }"
                  v-slot="validationContext"
                >
                  <label class="small text-muted"
                    >Respecter ce format pour téléphone:
                    <strong class="text-danger">242055452277</strong></label
                  >
                  <b-form-input
                    id="username"
                    name="username"
                    class="form-control"
                    placeholder="Email ou Numéro de Téléphone"
                    type="text"
                    v-model.trim="username"
                    @keydown.space.prevent
                    @keyup.space.prevent
                    :state="getValidationState(validationContext)"
                    aria-describedby="input-2-live-feedback"
                  ></b-form-input>

                  <b-form-invalid-feedback id="input-2-live-feedback">{{
                    validationContext.errors[0]
                  }}</b-form-invalid-feedback>
                </validation-provider>
              </div>
              <!-- form-group// -->
              <div class="form-group">
                <validation-provider
                  name="Mot de passe"
                  :rules="{ required: true, min: 8 }"
                  v-slot="validationContext"
                >
                  <b-form-input
                    type="password"
                    id="password"
                    name="password"
                    v-model.trim="password"
                    :state="getValidationState(validationContext)"
                    aria-describedby="input-1-live-feedback"
                    minlength="8"
                    placeholder="Saisissez votre mot de passe"
                  ></b-form-input>

                  <b-form-invalid-feedback id="input-1-live-feedback">{{
                    validationContext.errors[0]
                  }}</b-form-invalid-feedback>
                </validation-provider>
              </div>
              <!-- form-group// -->

              <div class="form-group">
                <router-link
                  :to="{ name: 'reset.password' }"
                  class="float-right"
                  >Mot de passe oublié?</router-link
                >
                <label class="float-left custom-control custom-checkbox">
                  <input
                    type="checkbox"
                    class="custom-control-input"
                    checked=""
                  />
                  <div class="custom-control-label">Se souvenir de moi</div>
                </label>
              </div>
              <!-- form-group form-check .// -->
              <div class="form-group">
                <button
                  type="submit"
                  :disabled="loading"
                  class="btn btn-primary btn-block"
                >
                  <span
                    v-if="loading"
                    class="spinner-border spinner-border-sm"
                    role="status"
                    aria-hidden="true"
                  ></span>
                  Connexion
                </button>
              </div>
              <!-- form-group// -->
            </b-form>
          </validation-observer>
          <!-- <div class="py-2" align="center" hidden>
            <span>OU</span><br />
            <small>Connectez-vous avec</small>
            <div class="pt-3">
              <div class="row">
                <div class="col-6">
                  <a href="#" class="btn btn-facebook btn-block">
                    <i class="fab fa-facebook-f"></i>
                    Facebook</a
                  >
                </div>
                <div class="col-6">
                  <a href="#" class="btn btn-google btn-block">
                    <i class="fab fa-google"></i>
                    Google</a
                  >
                </div>
              </div>
            </div>
          </div> -->
          <p class="text-center mt-5">
            <span class="text-muted">Vous n'avez pas de compte Kalisso?</span>
            <br />
             <router-link :to="{ name: 'register' }" class="btn btn-light mt-2 btn-block">Inscrivez-vous ici</router-link>
          </p>
        </div>
        <!-- card-body.// -->
      </div>
      <!-- card .// -->

      <!-- ============================ COMPONENT LOGIN  END.// ================================= -->
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
  name: "Login",
  props: {
    dataSuccessMessage: {
      type: String,
    },
  },
  components: {
    ValidationProvider,
  },
  data() {
    return {
      username: "",
      password: "",
      serverError: "",
      successMessage: this.dataSuccessMessage || null,
      loading: false,
    };
  },
  methods: {
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },
    validateBeforeSubmit() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          this.login();
        }
      });
    },
    login() {
      this.loading = true;
      this.successMessage = "";
      this.serverError = "";

      this.$store
        .dispatch("retrieveToken", {
          username: this.username,
          password: this.password,
        })
        .then((response) => {
          // console.log(response)
          this.password = "";
          this.successMessage = "Bon retour parmis nous " + response.data.data.name;
          // console.log(response.data);
          this.serverError = "";
          this.$router.push(this.$route.query.redirect | '/');
          this.loading = false;
          // redirect to profile

          this.$router.push({ name: "profile.index" });
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
  },
};
</script>
