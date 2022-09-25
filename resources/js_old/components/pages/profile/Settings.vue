<template>
  <!-- ========================= SECTION CONTENT ========================= -->
  <main class="col-md-9">
    <div class="card">
      <div class="card-body">
        <form class="row" @submit.prevent="handleSubmit(updateProfile)">
          <div class="col-md-9">
            <div class="form-row">
              <div class="col form-group">
                <label>Nom</label>
                <input
                  type="text"
                  v-model="formData.name"
                  class="form-control"
                  value="Vosidiy"
                />
              </div>
              <!-- form-group end.// -->
              <div class="col form-group">
                <label>Prénom</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="formData.lastname"
                />
              </div>
              <!-- form-group end.// -->
            </div>
            <!-- form-row.// -->

            <div class="form-row">
              <div class="form-group col-md-6">
                <label
                  >Email
                  <span v-if="user.email_verified_at !== null"
                    >|
                    <span
                      class="badge badge-success m-auto"
                      title="Votre email a été vérifié"
                      >Vérifier</span
                    ></span
                  ></label
                >
                <input
                  type="email"
                  class="form-control"
                  v-model="formData.email"
                  v-bind:class="user.email_verified_at !== null ? ' border-success solid bg' : ''"
                  name="email"
                  id="email"
                />
              </div>
              <!-- form-group end.// -->
              <div class="form-group col-md-6">
                <label>Pays</label>
                <select
                  id="inputState"
                  v-model="formData.country"
                  class="form-control"
                >
                  <option>Choose...</option>

                  <option selected="">Congo</option>
                  <option>RD Congo</option>
                  <option>France</option>
                  <option>United States</option>
                  <option>India</option>
                  <option>Afganistan</option>
                </select>
              </div>
              <!-- form-group end.// -->
            </div>
            <!-- form-row.// -->

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Ville</label>
                <input
                  type="text"
                  class="form-control"
                  value=""
                  placeholder="Saisissez votre ville actuelle"
                />
              </div>
              <!-- form-group end.// -->
              <div class="form-group col-md-6">
                <label
                  >Numéro de téléphone
                  <span v-if="user.phone_verified_at !== null"
                    >|
                    <span
                      class="badge badge-success m-auto"
                      title="Votre numéro de téléphone a été vérifié"
                      >Vérifier</span
                    ></span
                  ></label
                >
                <input
                  type="tel"
                  v-model="formData.phone"
                  v-bind:class="
                    user.phone_verified_at !== null
                      ? ' border-success solid bg'
                      : ''
                  "
                  class="form-control"
                />
              </div>
              <!-- form-group end.// -->
            </div>
            <!-- form-row.// -->

            <button type="submit" class="btn btn-primary">Enregister</button>
            <button class="btn btn-light">Changer le mot de passe</button>

            <br />
          </div>
          <!-- col.// -->
          <div class="col-md">
            <img
              :src="storage_url + user.avatar"
              class="img-md rounded-circle border"
            />
          </div>
          <!-- col.// -->
        </form>

        <!-- <toggle-button @change="onChangeEventHandler" />

        <toggle-button v-model="myDataVariable" aria-label="Hello" />

        <toggle-button
          :value="true"
          :labels="{ checked: 'Oui', unchecked: 'Non' }"
        /> -->
      </div>

      <!-- card-body.// -->

    </div>

    <div class="row justify-content-around padding-y">
      <div class="text-muted m-auto text-left col-md-6">
        Compte crée le : {{ user.created_at | formatDate }}
      </div>
      <div class="text-right m-auto col-md-6" align="right">
        <Button class="btn btn-danger">Supprimer mon compte</Button>
      </div>
    </div>

    <!-- card .// -->
  </main>
  <!-- col.// -->

  <!-- ========================= SECTION CONTENT END// ========================= -->
</template>

<script >
import { ToggleButton } from "vue-js-toggle-button";

export default {
  name: "ProfileSettings",

  data() {
    return {
      user: "",
      storage_url: this.$store.state.baseURL,
      formData: {
        name: "",
        lastname: "",
        email: "",
        country: "",
        city: "",
        phone: "",
        avatar: "",
      },
    };
  },
  created() {
    this.loadData();
  },
  components: {
    ToggleButton,
  },
  methods: {
    updateProfile() {
      return alert("hello");
    },
    loadData() {
      this.user = this.$store.state.user;
      this.formData.name = this.user.name;
      this.formData.lastname = this.user.lastname;
      this.formData.email = this.user.email;
      this.formData.country = this.user.country;
      this.formData.city = this.user.city;
      this.formData.phone = this.user.phone;
      this.formData.avatar = this.user.avatar;
      // console.log(this.user);
    },
  },
};
</script>