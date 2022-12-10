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
      <div class="card mx-auto" style="max-width: 380px; margin-top: 10px">
        <div v-if="successMessage" class="alert alert-success text-center m-2">
          {{ successMessage }}
        </div>
        <div v-if="serverError" class="alert alert-danger text-center m-2">
          {{ serverError }}
        </div>

        <div class="card-body">
          <h4 class="card-title mb-4">Mot de passe oublié</h4>
          <validation-observer ref="observer" v-slot="{ handleSubmit }">
            <b-form @submit.stop.prevent="handleSubmit(login)">
            
            <div class="form-group">
              <validation-provider
                    name="Username"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                  >
                      <label class="small text-muted">Respecter ce format pour téléphone: <strong class="text-danger">242055452277</strong></label>
                    
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
                  Récupérer <i class="fa fa-arrow-right pl-2 text-light"></i>
                </button>
              </div>
            </b-form>
          </validation-observer>
            
        </div>
        <!-- card-body.// -->
      </div>
      <!-- card .// -->
      <p class="text-center mt-4">
        Besoin d'aide?
        <router-link :to="{ name: 'contact' }" 
          >Contactez l'assistance</router-link
        >
      </p>
      <p class="text-center mt-5">
        <router-link :to="{ name: 'login' }"
          ><i class="fa fa-arrow-left text-primary"></i> Retour</router-link
        >
      </p>
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
  name: "ResetPassword",
  props: {
    username: {
      type: String,
    },
  },
  components: {
    ValidationProvider,
  },
  data() {
    return {
      username: this.username | null,
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
    resetPassword() {
      this.loading = true;
      this.successMessage = "";
      this.serverError = "";

      this.$store
        .dispatch("retrieveToken", {
          username: this.username,
        })
        .then((response) => {
          // console.log(response)
          this.successMessage = "";
          this.serverError = "";

          this.$router.push({ name: "profile.index" });
          this.loading = false;
          
        })
        .catch((error) => {
          this.loading = false;
          this.$toast.error({
            title:'Echec de connexion',
            message: error.response.data.message
          })
          this.serverError = error.response.data.message;
          this.successMessage = "";
        });
    },
  },
  
};
</script>
