<template>
  <!-- ========================= SECTION CONTENT ========================= -->
  
  <main class="col-md-9">
    <Spinner v-if="loading" />
    <a
      href="#"
      @click="$bvModal.show('bv-modal-add-address')"
      class="btn btn-light mb-3"
    >
      <i class="fa fa-plus"></i> Ajouter une adresse
    </a>

    <div class="row">
      <div class="col-md-6" v-for="(data, index) in allAddress" :key="index">
        <article class="box mb-4">
          <h6>{{ data.title }}</h6>
          <p>
            {{ data.address_line1 }} <br />
            {{ data.state }}, {{ data.country }}
          </p>
          <a
            href="#"
            @click.prevent="changeDefaultAddress(data.id, index)"
            class="btn btn-light"
            :class="{ active: data.default_address == 1 }"
          >
            <i v-if="data.default_address == 1" class="fa fa-check"></i>
            {{
              data.default_address == 1 ? "Par défaut" : "Definir par défaut"
            }}</a
          >
          <a href="#" class="btn btn-light"> <i class="fa fa-pen"></i> </a>
          <a
            href="#"
            @click.prevent="deleteAddress(data.id, index)"
            class="btn btn-light"
          >
            <i class="text-danger fa fa-trash"></i>
          </a>
        </article>
      </div>
      <div class="col-12 text-center" v-if="allAddress.length === 0">
        <div align="center" class="padding-y-lg card">
          <h2>Oups!</h2>
          <div>
            <img
              src="/images/address.gif"
              class="img-fluid w-25"
              alt="No address"
            />
          </div>
          <p>Vous n'avez aucune adresse pour l'instant</p>
        </div>
      </div>
      <!-- col.// -->
    </div>
    <!-- row.// -->
    <b-modal
      id="bv-modal-add-address"
      class="p-0 m-0"
      centered
      hide-footer
      no-close-on-backdrop
      hide-backdrop
      content-class="shadow-lg shadow"
    >
      <template #modal-title> Ajouter une nouvelle adresse </template>
      <div class="d-block p-2 m-0">
        <form action="" @submit.stop.prevent="addNewAddress()" method="post">
          <div class="card-body p-0 m-0">
            <div>
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
                  <label>Ville</label>
                  <select
                    id="inputState"
                    v-model="formData.setNewAddress.city"
                    class="form-control"
                  >
                    <option hidden>Choisir...</option>
                    <option selected value="congo-brazzaville">
                      Brazzaville
                    </option>
                    <option value="pointe-noire">Pointe-Noire</option>
                    <option value="dolisie">Dolisie</option>
                    <option value="nkayi">Nkayi</option>
                    <option value="sibiti">Sibiti</option>
                  </select>
                </div>
                <!-- form-group end.// -->
                <div class="form-group col-md-6">
                  <label>Secteur</label>
                  <select
                    id="inputState"
                    v-model="formData.setNewAddress.address_line2"
                    class="form-control"
                  >
                    <option hidden>Choisir...</option>
                    <option selected value="congo-brazzaville">
                      Brazzaville
                    </option>
                    <option value="pointe-noire">Pointe-Noire</option>
                    <option value="dolisie">Dolisie</option>
                    <option value="nkayi">Nkayi</option>
                    <option value="sibiti">Sibiti</option>
                  </select>
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
              <label class="custom-control-label text-muted" for="customCheck1"
                >Sauvegarder cette nouvelle adresse comme par défaut</label
              >
            </div>

            <div class="form-group padding-y-sm">
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
                Enregistrer
              </button>
            </div>
            <span v-if="successMessage">{{ successMessage }}</span>
            <span v-if="serverError">{{ serverError }}</span>
          </div>
        </form>
      </div>
    </b-modal>
  </main>

  <!-- col.// -->
</template>

<script>
export default {
  name: "ProfileAddress",

  data() {
    return {
      loading: false,
      formData: {
        useDefaultAddress: false,
        setNewAddress: {
          name: "",
          lastname: "",
          email: "",
          phone: "",
          country: "",
          city: "",
          address: "",
          address_line2: "",
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
    };
  },
  computed: {
    allAddress() {
      return this.$store.state.totalAddress;
    },
  },
  methods: {
    addNewAddress() {
      this.loading = true;
      this.$store
        .dispatch("addAddress", {
          recipient_name: this.formData.name + " " + this.formData.lastname,
          phone_number: this.formData.phone,
          address_line1: this.formData.address,
          address_line2: this.formData.address_line2,
          country: this.formData.country,
          state: this.formData.city,
          default_address: this.formData.saveAsDefaultAddress,
        })
        .then((response) => {
          this.loading = false
          this.successMessage = 'Vous avez ajouter une adresse de livraison'
        })
        .catch((e) => {
          this.serverError = e
        })
    },
    changeDefaultAddress(id, index) {
      this.loading = true;
      this.$store
        .dispatch("changeDefaultAddress", {
          id: id,
          index: index,
        })
        .then((response) => {
          this.loading = false;
        });
    },
    deleteAddress(id, index) {
      this.loading = true;
      this.$store
        .dispatch("deleteFromAddress", {
          id: id,
          index: index,
        })
        .then((response) => {
          this.loading = false;
        })
    },
  },
};
</script>