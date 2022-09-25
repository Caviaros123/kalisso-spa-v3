<template>
  <div class="page-wrapper">
    <Spinner v-if="loading" />
    <section>
      <div
        class="mx-auto"
        align="center"
        style="max-width: 780px; margin-top: 3%"
      >
        <router-link :to="{ name: 'home' }">
          <img
            src="/images/logo.png"
            class="center-block w-25 pt-3 img-fluid"
            alt="Logo Kalisso"
          />
        </router-link>
        <h5 class="text-muted text-uppercase pt-3">Choisir un abonnement</h5>
        <p class="text-muted">
          Choisissez un abonnement qui vous correspond afin de mettre en avant
          vos produits, nous offrons une large gamme de solutions adapté à votre
          boutique
        </p>
      </div>
      <div class="alert alert danger" v-if="successMessage || serverError">
        {{ successMessage || serverError }}
      </div>
      <div class="mx-auto" style="max-width: 1180px; margin-top: 1%">
        <div class="padding-y">
          <div class="row">
            <div class="col-lg-3 col-md-6">
              <article class="card item-pricing mb-3 rounded shadow">
                <h6 class="card-header">
                  <small class="text-uppercase h4">SUKA</small>
                </h6>
                <div class="card-body">
                  <p class="price">
                    <strong class="text-danger h6"
                      >> {{ presentPrice(10000) }}
                    </strong>
                    /mois
                  </p>

                  <ul class="list-check" style="min-height: 220px">
                    <li>Icone Verifié</li>
                    <li>Boutique personnalisé</li>
                    <li>
                      Produits personnalisés
                      <span
                        class="badge badge-pill badge-warning"
                        style="
                          float: right;
                          margin-top: 4px;
                          background-color: orange !important;
                          font-size: 9px;
                        "
                        >Nouveau</span
                      >
                    </li>
                    <li>Visibilité +++</li>
                    <li>Services personnalisé</li>
                    <li>Produits illimité</li>
                    <li>Promotion réseaux sociaux</li>
                    <li>Promotion SEO référencement</li>
                  </ul>
                  <hr />
                  <a
                    href="#"
                    @click.prevent="planChoosen((plan = 'suka'))"
                    class="btn btn-primary btn-block"
                    >Choisir ce plan</a
                  >
                </div>
                <!-- card-body.// -->
              </article>
              <!-- item-pricing .// -->
            </div>
            <!-- col.// -->
            <div class="col-lg-3 col-md-6">
              <article
                class="
                  card
                  item-pricing
                  mb-3
                  rounded
                  shadow
                  border border-danger
                  solid
                "
              >
                <h6 class="card-header">
                  <small class="text-uppercase h4">KYMIA</small>
                  <span
                    class="badge badge-danger"
                    style="
                      float: right;
                      margin-top: 0px;
                      background-color: orange !important;
                      font-size: 16px;
                    "
                  >
                    Populaire
                  </span>
                </h6>
                <div class="card-body">
                  <p class="price">
                    <strong class="text-danger h6"
                      >> {{ presentPrice(5000) }}
                    </strong>
                    /mois
                  </p>
                  <ul class="list-check" style="min-height: 210px">
                    <li>Icone Verifié</li>
                    <li>Boutique personnalisé</li>
                    <li>
                      Produits personnalisés
                      <span
                        class="badge badge-pill badge-warning"
                        style="
                          float: right;
                          margin-top: 4px;
                          background-color: orange !important;
                          font-size: 9px;
                        "
                        >Nouveau</span
                      >
                    </li>
                    <li>Visibilité ++</li>
                    <li>Services personnalisé</li>
                    <li>500 Produits</li>
                    <li>Promotion réseaux sociaux</li>
                    <li>
                      + Inscription unique
                      <span class="text-danger h6">{{
                        presentPrice(1000)
                      }}</span>
                    </li>
                  </ul>
                  <hr />
                  <a
                    href="#"
                    @click.prevent="planChoosen((plan = 'kymia'))"
                    class="btn btn-primary btn-block"
                    >Choisir ce plan</a
                  >
                </div>
                <!-- card-body.// -->
              </article>
              <!-- item-pricing .// -->
            </div>
            <!-- col.// -->
            <div class="col-lg-3 col-md-6">
              <article class="card item-pricing mb-3 rounded shadow">
                <h6 class="card-header">
                  <small class="text-uppercase h4">ESSENGO</small>
                </h6>
                <div class="card-body">
                  <p class="price">
                    <strong class="text-danger h6"
                      >> {{ presentPrice(2000) }}
                    </strong>
                    /mois
                  </p>
                  <ul class="list-check" style="min-height: 180px">
                    <li>Icone Verifié</li>
                    <li>Boutique personnalisé</li>
                    <li>Visibilité +</li>
                    <li>Services personnalisé</li>
                    <li>200 Produits</li>
                    <li>
                      + Inscription unique
                      <span class="text-danger h6">{{
                        presentPrice(1000)
                      }}</span>
                    </li>
                  </ul>
                  <hr />
                  <a
                    href="#"
                    @click.prevent="planChoosen((plan = 'essengo'))"
                    class="btn btn-primary btn-block"
                    >Choisir ce plan</a
                  >
                </div>
                <!-- card-body.// -->
              </article>
              <!-- item-pricing .// -->
            </div>
            <!-- col.// -->
            <div class="col-lg-3 col-md-6">
              <article class="card item-pricing mb-3 rounded shadow">
                <h6 class="card-header">
                  <small class="text-uppercase h4">mpamba</small>
                </h6>
                <div class="card-body">
                  <p class="price">
                    <strong class="text-danger">> GRATUIT</strong> à vie pour
                    les particuliers
                  </p>

                  <ul class="list-check" style="min-height: 100px">
                    <li>Boutique personnalisé</li>
                    <li>50 Produits</li>
                    <li>
                      + Inscription unique
                      <span class="text-danger h6">{{
                        presentPrice(1000)
                      }}</span>
                    </li>
                  </ul>
                  <hr />
                  <a
                    href="#"
                    @click.prevent="planChoosen((plan = 'free'))"
                    class="btn btn-primary btn-block"
                    >Choisir ce plan</a
                  >
                </div>
                <!-- card-body.// -->
              </article>
              <!-- item-pricing .// -->
            </div>
            <!-- col.// -->
          </div>
        </div>
      </div>
      <div v-if="successMessage || serverError">
        {{ successMessage || serverError }}
      </div>
    </section>
  </div>
</template>

<script>
export default {
  data() {
    return {
      plan: "",
      loading: false,
      serverError: "",
      successMessage: "",
    };
  },
  methods: {
    planChoosen(data) {
      this.loading = true;
      this.plan = data;
      if (data === "free") {
        data = {
          amount: 1000,
          reference: this.plan,
          type: "create store subscription",
        };
      } else if (data === "essengo") {
        data = {
          amount: 2000 + 1000,
          reference: this.plan,
          type: "Création d'une boutique Kalisso",
        };
      } else if (data === "kymia") {
        data = {
          amount: 5000 + 1000,
          reference: this.plan,
          type: "Création d'une boutique Kalisso",
        };
      } else if (data === "suka") {
        data = {
          amount: 10000,
          reference: this.plan,
          type: "Création d'une boutique Kalisso",
        };
      }

      this.$store
        .dispatch("checkoutPlanSubscription", data)
        .then((response) => {
          this.loading = false;
          this.successMessage = response.data.message;
          // this.plan = "";
          this.showModal = false;
          this.$router.push({
            name: "payment",
            params: response.data,
            query: {
              type: "plan",
              amount: data.amount,
              reference: data.reference,
              object: response.data.data[1],
            },
          });
        })
        .catch((error) => {
          this.serverError = error.data;
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
};
</script>

<style lang="scss" scoped>
</style>