<template>
 
    <aside class="col-md-3">
        <nav class="list-group">
            <a class="list-group-item" @click="activeTab = 'ProfileUser' " href="#"> Account overview  </a>
            <a class="list-group-item" @click="activeTab = 'ProfileAddress' " href="#"> My Address </a>
            <a class="list-group-item" @click="activeTab = 'ProfileOrders' " href="#"> My Orders </a>
            <a class="list-group-item" @click="activeTab = 'ProfileWishlist' " href="#"> My wishlist </a>
            <a class="list-group-item" @click="activeTab = 'ProfileSeller' " href="#"> My Selling Items </a>
            <a class="list-group-item active" @click="activeTab = 'ProfileSettings' " href="#"> Settings </a>
            <a class="list-group-item" @click="activeTab = 'Oauth' " href="#"> Oauth 2.0 </a>
            <router-link :to="{ name: 'logout'}" class="list-group-item" href="#"> Déconnexion </router-link>
        </nav>
        <br>
        <a class="btn btn-light btn-block" href="#"> <i class="fa fa-power-off"></i> <span class="text">Log out</span> </a>
    </aside> <!-- col.// -->
 
</template>

<script>
export default {
    
}
</script>