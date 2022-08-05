<template>
  <div id="overlay" >
    <!-- <div class="spinner"></div> -->
    <img src="/images/loader.gif" class="spinner p-0 m-0" alt="Kalisso Loader " >
    <!-- <br>
    Chargement en cours... -->
  </div>
</template>

<script>
export default {
  name: "Spinner",
};
</script>

<style lang="scss" scoped>
#overlay {
  background: #ffffff;
  color: #666666;
  position: fixed;
  height: 100%;
  width: 100%;
  z-index: 5000;
  top: 0;
  left: 0;
  float: left;
  text-align: center;
  padding-top: 18%;
  opacity: 0.8;
}
.spinner {
  margin: 0;
  padding: 0;
  // animation: rotate 0.8s infinite linear;
  // border: 5px solid rgb(248, 3, 3);
  // border-right-color: transparent;
  // border-radius: 50%;
}
@keyframes rotate {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>