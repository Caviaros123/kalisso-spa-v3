<template>
  <div class="page-wrapper">
    <nav-section/>
  <!-- ========================= SECTION CONTENT ========================= -->
  <section class="section-content padding-y">
    <div class="container">
      <nav class="row">
        <div class="col-md-3" v-for="(item, index) in categories" :key="index">
          <div class="card card-category">
            <div class="img-fluid" style="background: #ffd7d7">
              <img class="img-md" v-lazy-src="storage_url + item.cat_img" />
            </div>
            <div class="card-body" >
              <h4 class="card-title"><a href="#!">{{ item.name }}</a></h4>
              <ul class="list-menu" hidden>
                <li><a href="">Unisex T shirts</a></li>
                <li><a href="">Casual shirts</a></li>
                <li><a href="">Scherf Ice cream</a></li>
                <li><a href="">Another category</a></li>
                <li><a href="">Great items name</a></li>
                <li><a href="">Great items name</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <!-- row.// -->
    </div>
    <!-- container .//  -->
  </section>
  <!-- ========================= SECTION CONTENT END// ========================= -->
   <article class="my-4">
      <img src="/images/banners/ad-sm.png" class="w-100" />
    </article>

    <footer-section/>
  </div>
</template>

<script>
export default {
  data() {
    return {
        storage_url: this.$store.state.baseURL
    };
  },
  computed: {
    categories() {
      return this.$store.state.categories;
    },
  },
};
</script>

<style lang="scss" >
</style>