<template>
    <section class="content page-wrapper">
        <div class="container"> 
            <div class="mx-auto justify-content-center align-items-center">
                <div class="text-center padding-y">
                    <!-- //lottie image
                    <img src="images/404.svg" alt="404" class="img-fluid"> -->

                    <vue-lottie ref="lottie" loop autoplay :data="animationData" :height="400" :width="400"></vue-lottie>

                    <p class="display-4 padding-y-sm text-muted"><strong class="text-danger">Ooops! </strong> Page non trouvé</p>
                    <div class="mx-auto padding-y-sm justify-content-center align-items-center">
                        <router-link class="btn btn-lg btn-danger border-rounded" :to="'/'">Retour à l'accueil</router-link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

export default {

};
</script>
