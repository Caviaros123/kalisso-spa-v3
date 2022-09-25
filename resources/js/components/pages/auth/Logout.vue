
<template>
  <div class="page-wrapper">
    
  </div>
</template>

<script>
export default {
  // created() {
  //   this.$modal.show("dialog", {
  //     title: "The standard Lorem Ipsum passage",
  //     text: "Lorem ipsum dolor sit amet, ...",
  //     buttons: [
  //       {
  //         title: "Cancel",
  //         handler: () => {
  //           this.$modal.hide("dialog");
  //         },
  //       },
  //       {
  //         title: "Like",
  //         handler: () => {
  //           alert("Like action");
  //         },
  //       },
  //       {
  //         title: "Repost",
  //         handler: () => {
  //           alert("Repost action");
  //         },
  //       },
  //     ],
  //   });
  // },
  methods: {
    showMsgBoxTwo() {
      this.boxTwo = "";
      this.$bvModal
        .msgBoxConfirm(
          "Vous êtes sur le point de vous déconnecter voulez-vous vraiment quitter votre session?",
          {
            title: "Déconnexion",
            size: "md",
            buttonSize: "md",
            okVariant: "danger",
            okTitle: "Oui",
            cancelTitle: "Non",
            footerClass: "p-3",
            hideHeaderClose: false,
            centered: true,
          }
        )
        .then((value) => {
          // console.log(value)
          if (value === true) {
            this.logout();
          } else {
            this.$router.push({ name: "profile.index" });
          }
          this.boxTwo = value;
        })
        .catch((err) => {
          this.logout();
          // An error occurred
        });
    },
    logout() {
      // this.$store.dispatch('clearTodos')
      this.$store.dispatch("destroyToken").then((response) => {
        this.$router.push({ name: "home" })
      }).catch((error) => {
        this.$router.push({ name: "home" })
      })
    },
  },
  mounted() {
    this.showMsgBoxTwo();
  },
};
</script>