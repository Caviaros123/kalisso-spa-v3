<template>
    <div class="content-wrapper">
        <Spinner v-if="loading" />
    
        <!-- <nav-section></nav-section> -->
        <section class="container mx-auto padding-around">
            <div class="card">   
                <div class="">
                    <p>Paiement de la commande</p>
                    <div class="padding-y">
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6 justify-content-center align-items-center">
                        <a href="#" @click.prevent="redirectToEpay()" class="btn btn-lg btn-primary col-12 form-control-lg">
                        <i class="fas fa-mobile-alt"></i>
                        Continuez</a
                        >
                    </div>
                    <div class="col-6 justify-content-center align-items-center">
                        <a
                        href="#"
                        @click.prevent="requestScanPay()"
                        class="btn btn-lg btn-warning col-12 form-control-lg"
                        >
                        <i class="fas fa-qrcode"></i>
                        Annuler</a
                        >
                    </div>
                </div>
                </div>
            </section>
        </div>
</template>

<script>
export default {
    setup() {
        return {

        }
    }
}
</script>

<style lang="scss" scoped>

</style>