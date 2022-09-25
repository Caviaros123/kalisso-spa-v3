<template>
    
    <v-offline @detected-condition="amIOnline">
        <template v-if="online"> ( Online: {{ onLine }} ) </template>
        <template v-if="offline"> ( Online: {{ onLine }} ) </template>
    </v-offline>
   
</template>

<script>
import { VOffline } from 'v-offline';

export default {
    name: 'CheckInternetConnexion',
    components: {
        VOffline
    },
    data() {
        return {
            onLine: true,
        };
    },
    methods: {
        amIOnline(e) {
            this.onLine = e;
        },
    },
}
</script>

<style lang="scss" scoped>
.offline {
  background-color: #fc9842;
  background-image: linear-gradient(315deg, #fc9842 0%, #fe5f75 74%);
}
.online {
  background-color: #00b712;
  background-image: linear-gradient(315deg, #00b712 0%, #5aff15 74%);
}
</style>