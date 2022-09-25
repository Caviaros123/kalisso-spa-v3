<template>
    <div class="container " >
        <hr>
        <section class="footer-top padding-y mx-auto px-3">
            <div class="row justify-content-arround ">
                <!-- <aside class="col-md-4">
                    <article class="mr-3 mb-4">
                        <img src="/images/logo.png" class="logo-footer w-100" />
                        <p class="mt-5 b h5 text-center text-danger">
                            A chacun sa flopée de plaisir
                        </p>
                        
                    </article>
                </aside> -->
                <aside class="col-sm-3 mt-5 col-md-3">
                    <h6 class="title">A propos</h6>
                    <ul class="list-unstyled">
                        <li><a href="/privacy">Terms & conditions</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Blogs</a></li>
                        <li><router-link :to="{name: 'about'}">A propos de Kalisso</router-link></li>
                    </ul>
                </aside>
                <aside class="col-sm-3 mt-5 col-md-3">
                    <h6 class="title">Services</h6>
                    <ul class="list-unstyled">
                        <li><router-link :to="{name: 'help'}">Centre d'aide</router-link></li>
                        <li><a href="#">Livraison</a></li>
                        <li><a href="#">Remboursement</a></li>
                        <!-- <li><a href="#">Open dispute</a></li> -->
                    </ul>
                </aside>
                <aside class="col-sm-3 mt-5 col-md-3">
                    <h6 class="title">Utilisateurs</h6>
                    <ul class="list-unstyled">
                        <li><router-link :to="{name: 'login'}"> Connexion </router-link></li>
                        <li><router-link :to="{name: 'register'}"> Inscription </router-link></li>
                        <li><a href="/account/profile"> Paramètres de compte </a></li>
                        <li><a href="/account/profile"> Mes commandes </a></li>
                        <li><a href="/account/profile"> Mes Favoris </a></li>
                    </ul>
                </aside>
                <aside class="col-sm-3 mt-5 col-md-3">
                    <h6 class="title ">Téléchargez nos applications gratuites :</h6>
                    
                        <!-- <a href="#" class="d-block mb-2 "
                            ><img src="/images/misc/appstore.png" height="40"
                        /></a> -->
                        <a target="_blank" href="https://bit.ly/3yh87Os" class="d-block mb-2 "
                            ><img src="/images/misc/playmarket.png" height="40"
                        /></a>
                </aside>

            </div>
            <!-- row.// -->
        </section>
        <!-- footer-top.// -->

        <section class="footer-copyright border-top">
            <p class="float-left text-muted">
                &copy; 2020 Kalisso LLC Tous les droits sont réservés
            </p>
            
            <p target="_blank" class="float-right text-muted">
                <a href="/privacy">Terms, conditions & Cookies</a> &nbsp; &nbsp;
                <!-- <a href="#">Accessibilité</a> -->
            </p>
        </section>
    </div>
    <!-- //container -->
</template>

<script>
export default {
    
};
</script>
