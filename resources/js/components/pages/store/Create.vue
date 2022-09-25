<template>
  <div class="px-0 page-wrapper">
    <Spinner v-if="loading" />
    <div class="page-wrapper ">
      <section class="section-content padding-y-md">
        <div
          class="mx-auto"
          align="center"
          style="max-width: 480px; margin-top: 3%"
        >
          <router-link :to="{ name: 'home' }">
            <img
              src="/images/logo.png"
              class="center-block w-50 img-fluid"
              alt="Logo Kalisso"
            />
          </router-link>
        </div>
        <div class="container m-auto text-center" style="max-width: 820px">
          <h4 class="text-uppercase mt-3">Création de votre boutique</h4>
        <p class=" text-muted h5 mt-3">Devenez vendeur particulier ou professionnel grâce à notre
                  solution multiservices</p>
          <div class="card rounded mt-2 shadow mb-4 p-5">
            <form-wizard
              validate-on-back
              ref="wizard"
              error-color="#ff4949"
              @submit.stop.prevent="handleSubmit(create)"
              :start-index.sync="activeIndex"
              @on-complete="handleSubmit(onComplete)"
              subtitle=""
              title=""
              nextButtonText="Suivant"
              backButtonText="Précédent"
              finishButtonText="Je valide"
              shape="circle"
              stepSize="sm"
            >
              <tab-content
                title="Information de la boutique"
                icon="fa fa-store"
              >
                <div
                  class="form-row text-center"
                  id="slider"
                  v-bind:class="'slide-in'"
                >
                  <div class="col-sm-12 col-md-6 form-group">
                    <label class="text-muted">Nom de la boutique</label>
                    <validation-provider
                      name="Username"
                      :rules="{ required: true }"
                      v-slot="validationContext"
                    >
                      <b-form-input
                        type="text"
                        class="form-control form-control-lg"
                        placeholder="Ex: Sté Park N Shop"
                        :state="getValidationState(validationContext)"
                        aria-describedby="input-2-live-feedback"
                        required="required"
                      ></b-form-input>

                      <b-form-invalid-feedback id="input-2-live-feedback">{{
                        validationContext.errors[0]
                      }}</b-form-invalid-feedback>
                    </validation-provider>
                  </div>
                  <div class="col-sm-12 col-md-6 form-group">
                    <label class="text-muted">Catégories</label>

                    <select
                      v-model="formData.category"
                      class="form-control form-control-lg"
                    >
                      <option :selected="selected" class="text-muted" hidden>
                        Choisissez une catégorie
                      </option>
                      <option
                        class="text-dark bg"
                        v-for="item in categories"
                        :key="item.id"
                        :label="item.name"
                        :value="item.id"
                      ></option>
                    </select>
                  </div>
                </div>
                <div
                  class="form-row text-center"
                  id="slider"
                  v-bind:class="'slide-in'"
                >
                  <div class="col-sm-12 col-md-6 form-group">
                    <label class="text-muted">Pays</label>
                    <select
                      v-model="formData.country"
                      class="form-control form-control-lg"
                    >
                      <option :selected="selected" class="text-muted" hidden>
                        Choisissez un pays
                      </option>
                      <option
                        class="text-dark bg"
                        v-for="item in countries"
                        :key="item.id"
                        :label="item.nicename"
                        :selected="
                          item.iso == 'CG' ? (formData.country = item.name) : ''
                        "
                        :value="item.name"
                      ></option>
                    </select>
                  </div>
                  <div class="col-sm-12 col-md-6 form-group">
                    <label class="text-muted">Ville</label>

                    <select
                      v-model="formData.city"
                      class="form-control form-control-lg"
                    >
                      <option :selected="selected" class="text-muted" hidden>
                        Choisissez une ville
                      </option>
                      <option
                        class="text-dark bg"
                        v-for="item in cities"
                        :key="item.id"
                        :label="item.name"
                        :value="item.slug"
                      ></option>
                    </select>
                  </div>
                </div>
              </tab-content>

              <tab-content title="Completez votre boutique" icon="fa fa-store">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="row" align="left">
                      <div class="form-input col-md-6 mb-4">
                        <div class="form-input col-12 mb-4">
                            <label
                              class="b text-muted"
                              for="exampleFormControlFile1"
                              >Description de votre boutique:</label
                            >
                            <textarea
                              required="required"
                              class="form-control"
                              placeholder="Décrivez votre boutique ou les carecteristiques de votre boutique en quelques lignes... "
                              id="exampleFormControlTextarea1"
                              name="description"
                              rows="3"
                            ></textarea>
                        </div>
                        <div class="form-input col-12 " align="left">
                          <label
                            class="b text-muted"
                            for="exampleFormControlFile1"
                            >Adresse de votre boutique:</label
                          >
                          <input
                            type="text"
                            name="adress"
                            required="required"
                            class="form-control-lg"
                            placeholder="Saisissez votre adresse "
                          />
                        </div>
                      </div>
                      <div class="form-input col-md-6" align="left">
                        <div
                          class="b m-auto text-muted h6 p-0 m-0"
                          for="image1"
                        >
                          Importer votre logo:<br />
                          <label class="text-muted small"
                            >Si vous n'avez pas de logo, cliquez ici</label
                          >
                          <a href="https://hatchful.shopify.com/fr/"
                            >Créer mon logo</a
                          >
                        </div>

                        <!-- Our File Inputs -->
                        <div
                          class="
                            col-12
                            wrap-custom-file
                            shadow-lg
                            border
                            rounded
                            border-danger
                            solid
                          "
                          align="left"
                        >
                          <input
                            type="file"
                            name="logo"
                            id="image1"
                            accept=".gif, .jpg, .png, .jpeg"
                          />
                          <label for="image1">
                            <span>VOTRE LOGO</span>
                            <i class="fa fa-plus-circle"></i>
                          </label>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </tab-content>

              <tab-content title="Informations personnel" icon="fa fa-user">
                <div class="col-md-12">
                  <div class="form-group row">
                    <div class="form-input col-md-6 mb-4" align="left">
                      <label class="b text-muted" for="exampleFormControlFile1"
                        >Votre nom:</label
                      >
                      <input
                        type="text"
                        required
                        name="founder_name"
                        class="form-control-lg"
                        placeholder="Nom du propriétaire"
                        :oninput="(this.className = '')"
                      />
                    </div>
                    <div class="form-input col-md-6 mb-4" align="left">
                      <label class="b text-muted" for="exampleFormControlFile1"
                        >Email:</label
                      >
                      <input
                        type="email"
                        name="email"
                        value=""
                        class="form-control-lg"
                        placeholder="Votre email"
                      />
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <div class="form-input col-md-6 mb-4" align="left">
                      <label class="b text-muted" for="exampleFormControlFile1"
                        >Téléphone:</label
                      >
                      <input
                        type="tel"
                        name="phone"
                        required
                        class="form-control-lg"
                        placeholder="Votre numéro Téléphone"
                        value=""
                        :oninput="(this.className = '')"
                      />
                    </div>
                  </div>
                </div>
              </tab-content>
            </form-wizard>
          </div>
          <div class="mx-auto p-4 text-center align-items-center text-light">
            <div class="row">
              <div class="col-md-4">
                <a class="text-dark" href="/">&copy; Kalisso.com, Inc.</a>
              </div>
              <div class="col-md-4">
                <a class="text-dark" href="/contact"
                  ><i class="fab fa-warning"></i> Assistance</a
                >
              </div>
              <div class="col-md-4">
                <a class="text-dark" href="/privacy">
                  Confidentialité &amp; conditions</a
                >
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script>
import { ValidationProvider, extend } from "vee-validate";
import { required } from "vee-validate/dist/rules";
import VueFormWizard from 'vue-form-wizard'


extend("required", {
  ...required,
  message: "Ce champ est requis",
});

export default {
  data() {
    return {
      countries: [],
      cities: [],
      successMessage: "",
      serverError: "",
      loading: false,
      formData: {
        category: "Choisissez une catégorie",
        country: "Choisissez un pays",
        city: "Choisissez une ville",
      },
    };
  },
  components: {
    ValidationProvider,
    VueFormWizard,
  },
  mounted() {
    this.getCountry();
  },
  computed: {
    categories() {
      return this.$store.state.categories;
    },
    getCountry() {
      this.$store.dispatch("getCountries").then((response) => {
        this.countries = response.data.data.countries;
        this.cities = response.data.data.cities;
      });
    },
  },
  methods: {
    onComplete() {
      alert("cool");
    },
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

    // Display the current tab

    showTab(n) {
      // This function will display the specified tab of the form ...
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      // ... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == x.length - 1) {
        document.getElementById("nextBtn").innerHTML = "Envoyer";
      } else {
        document.getElementById("nextBtn").innerHTML = "Suivant";
      }
      // ... and run a function that displays the correct step indicator:
      fixStepIndicator(n);
    },

    nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab");

      // Exit the function if any field in the current tab is invalid:
      if (n == 1 && !validateForm()) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      // if you have reached the end of the form... :
      if (currentTab >= x.length) {
        //...the form gets submitted:
        // document.getElementsByClassName("isFinish").show();
        document.getElementById("regForm").submit();
        return false;
      }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    },

    validateForm() {
      // This function deals with validation of the form fields
      var y,
        i,
        valid = true;
      y = document.getElementsByClassName("tab");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false:
          valid = false;
        }
      }
      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step")[currentTab].className +=
          " finish";
      }
      return valid; // return the valid status
    },

    fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i,
        x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class to the current step:
      x[n].className += " active";
    },
  },
  mounted() {
    $('input[type="file"]').each(function () {
      // Refs
      var $file = $(this),
        $label = $file.next("label"),
        $labelText = $label.find("span"),
        labelDefault = $labelText.text();

      // When a new file is selected
      $file.on("change", function (event) {
        var fileName = $file.val().split("\\").pop(),
          tmppath = URL.createObjectURL(event.target.files[0]);
        //Check successfully selection
        if (fileName) {
          $label
            .addClass("file-ok")
            .css("background-image", "url(" + tmppath + ")");
          $labelText.text(fileName);
        } else {
          $label.removeClass("file-ok");
          $labelText.text(labelDefault);
        }
      });
    });
  },
};
</script>

<style lang="scss" scoped>
/* Style the form */
#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  padding: 10px;
  width: 100%;
  min-width: 200px;
}

/* Style the input fields */
input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4caf50;
}

/*style css for upload images*/

/*** GENERAL STYLES ***/
* {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

body {
  margin: 0;

  font-family: "Roboto", sans-serif;

  background: lightcoral;
}

#page {
  text-align: center;
  font-size: 16px;
  margin: 150px auto;
}
#page h1 {
  margin-bottom: 4rem;
  font-family: "Lemonada", cursive;
  text-transform: uppercase;
  font-weight: normal;
  color: #fff;
  font-size: 2rem;
}

/*** CUSTOM FILE INPUT STYE ***/
.wrap-custom-file {
  position: relative;
  display: inline-block;
  width: 150px;
  height: 100px;
  margin: 0 0.5rem 1rem;
  text-align: center;
}
.wrap-custom-file input[type="file"] {
  position: absolute;
  top: 0;
  left: 0;
  width: 2px;
  height: 2px;
  overflow: hidden;
  opacity: 0;
}
.wrap-custom-file label {
  z-index: 1;
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  overflow: hidden;
  padding: 0 0.5rem;
  cursor: pointer;
  background-color: #fff;
  border-radius: 4px;
  -webkit-transition: -webkit-transform 0.4s;
  transition: -webkit-transform 0.4s;
  transition: transform 0.4s;
  transition: transform 0.4s, -webkit-transform 0.4s;
}
.wrap-custom-file label span {
  display: block;
  margin-top: 2rem;
  font-size: 14px;
  color: #777;
  -webkit-transition: color 0.4s;
  transition: color 0.4s;
}
.wrap-custom-file label .fa {
  position: absolute;
  bottom: 1rem;
  left: 50%;
  -webkit-transform: translatex(-50%);
  transform: translatex(-50%);
  font-size: 1.5rem;
  color: lightcoral;
  -webkit-transition: color 0.4s;
  transition: color 0.4s;
}
.wrap-custom-file label:hover {
  -webkit-transform: translateY(-1rem);
  transform: translateY(-1rem);
}
.wrap-custom-file label:hover span,
.wrap-custom-file label:hover .fa {
  color: #333;
}
.wrap-custom-file label.file-ok {
  background-size: cover;
  background-position: center;
}
.wrap-custom-file label.file-ok span {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 0.3rem;
  font-size: 0.8rem;
  color: #000;
  background-color: rgba(255, 255, 255, 0.7);
}
.wrap-custom-file label.file-ok .fa {
  display: none;
}
</style>