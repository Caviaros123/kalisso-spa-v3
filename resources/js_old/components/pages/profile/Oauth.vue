<template>
    <div class="container card">
        <br /><br />
        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>
        <passport-personal-access-tokens></passport-personal-access-tokens>
    </div>
</template>

<script>
export default {
    name: "Oauth",
    setup () {
        return {}
    }
}
</script>

<style lang="scss" scoped>

</style>