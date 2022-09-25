<template>
  <div class="px-0 page-wrapper">
    <nav-section></nav-section>

     <section class="section-pagetop bg-gray">
            <div class="container">
                <h1 class="title-page text-muted display-4 text-center ">Contactez-nous</h1>
            </div>
            <!-- container //  -->
        </section>

    <section>
      <div class="container px-5 py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-6 text-center">
              <div class="card card-product">
                <div class="card-header">
                  <h2 class="text-muted">BRAZZAVILLE</h2>
                </div>
                <div class="card-body">
                  <p class="text-muted h4 p-3">
                    Email: support@kalisso.com <br />
                  </p>
                    <span 
                      ><h4 class="bg-success text-light p-3 border rounded">
                        WhatsApp: +242 05 545 22 77
                      </h4></span
                    ><br />
                </div>
              </div>
            </div>
            <div class="col-md-6 text-center">
              <div class="card card-product">
                <div class="card-header">
                  <h2 class="text-muted">POINTE-NOIRE</h2>
                </div>
                <div class="card-body">
                  <p class="text-muted h4 p-3">
                    Email: support@kalisso.com <br />
                  </p>
                    <span 
                      ><h4 class="bg-info text-light p-3 border rounded">
                        WhatsApp: +242 05 545 22 77
                      </h4></span
                    ><br />
                </div>
              </div>
            </div>
          </div>
          <hr />
          <div class="container mx-auto">
            <div class="row">
              <div class="col-md-6 text-center">
                <h3 class="b text-muted display-4">Besoin d'aide ?</h3>
                <div class="mt-5">
                  <h3 class="text-muted">Contactez-nous</h3>
                </div>
                <hr />
                <div class="text-center">
                  <p class="text-muted h4 p-3">
                    Email: support@kalisso.com <br />
                  </p>
                    <span 
                      ><h4 class="bg-info text-light p-3 border rounded">
                        WhatsApp: +242 05 545 22 77
                      </h4></span
                    ><br />
                </div>
              </div>
              <div class="col-md-6">
                <h4>Laissez nous un message</h4>
                <p class="b text-muted">Nous repondons en général très rapidement pour vous assurez une meilleure assistance</p>
                <div class="card-product card">
                  <form action="" method="post">
                    <div class="m-3 mt-5">
                      <label> Nom <span class="text-danger">*</span></label>
                      <!-- v-if="this.$store.getters.loggedIn ? readonly : 'required'"   -->
                      <input
                        type="text"
                        class="input form-control"
                        placeholder="Votre nom"
                        name="name"
                      />
                    </div>
                    <hr />
                    <div class="m-3">
                      <label> Email <span class="text-danger">*</span></label>
                      <input
                        type="email"
                        class="input form-control"
                        placeholder="Votre email"
                        name="email"
                        required="required"
                      />
                    </div>
                    <hr />
                    <div class="m-3">
                      <label> Sujet <span class="text-danger">*</span></label>
                      <input
                        type="text"
                        class="input form-control"
                        placeholder="Votre sujet"
                        name="subject"
                        required="required"
                      />
                    </div>
                    <div class="m-3">
                      <label> Message <span class="text-danger">*</span></label>
                      <textarea
                        type="text"
                        class="input form-control p-5"
                        placeholder="Votre message ici..."
                        name="name"
                        required="required"
                      >
                      </textarea>
                    </div>

                    <div class="m-3 mt-5 mb-2 text-right">
                      <button class="btn btn-primary">
                        <i class="fa fa-"></i> Envoyer
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="container padding-y" align="center">
              <div class="row justify-content-center align-items-arround">
                <label class="text-muted b h2">Prochainement :</label>

                <a
                  href=""
                  class="
                    border-bottom
                    pb-3
                    m-3
                    text-muted
                    disable
                    solid
                    border-danger
                  "
                  >RD Congo</a
                >
                <a
                  href=""
                  class="
                    border-bottom
                    pb-3
                    m-3
                    text-muted
                    disable
                    solid
                    border-danger
                  "
                  >Cameroun</a
                >
                <a
                  href=""
                  class="
                    border-bottom
                    pb-3
                    m-3
                    text-muted
                    disable
                    solid
                    border-danger
                  "
                  >Angola</a
                >
                <a
                  href=""
                  class="
                    border-bottom
                    pb-3
                    m-3
                    text-muted
                    disable
                    solid
                    border-danger
                  "
                  >Cabinda</a
                >
                <a
                  href=""
                  class="
                    border-bottom
                    pb-3
                    m-3
                    text-muted
                    disable
                    solid
                    border-danger
                  "
                  >Cote d'ivoire</a
                >
                <a
                  href=""
                  class="
                    border-bottom
                    pb-3
                    m-3
                    text-muted
                    disable
                    solid
                    border-danger
                  "
                  >Sénégal</a
                >
                <a
                  href=""
                  class="
                    border-bottom
                    pb-3
                    m-3
                    text-muted
                    disable
                    solid
                    border-danger
                  "
                  >Bénin</a
                >
                <a
                  href=""
                  class="
                    border-bottom
                    pb-3
                    m-3
                    text-muted
                    disable
                    solid
                    border-danger
                  "
                  >Mali</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer-section></footer-section>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
</style>