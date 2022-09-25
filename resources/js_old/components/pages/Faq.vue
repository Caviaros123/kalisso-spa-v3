<template>
  <v-sheet class="page-wrapper">
    <nav-section></nav-section>
    <v-container class="py-4 py-lg-8">
      <div class="text-center m-5">
        <div
          class="
            text-uppercase
            font-weight-bold
            body-2
            text-danger
            mb-2
            m-4
            h3
          "
        >
         Centre d'aide & Support
        </div>
        <h2 class="text-h3 text-lg-h2">{{ title }}</h2>
        <v-responsive max-width="1200" class="mx-auto">
          <div class="text-h6 text-muted h5 mt-4">{{ subtitle }}</div>
        </v-responsive>
      </div>

      <div class="card justify-content-center align-items-center mt-8">
        <div class="card-body" v-for="(item, index) in faq" :key="index">
          <div class="text-danger">
            {{ item.question }}
          </div>
          <div class="text-muted secondary--text">
            {{ item.answer }}
          </div>
        </div>
      </div>

      <section class="sptb">
			<div class="container">
				<div class="panel-group1" id="accordion2">
					<div class="panel panel-default mb-4 border p-0">
						<div class="panel-heading1">
							<h4 class="panel-title1">
								<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseone" aria-expanded="false">1. What does it Cost to advertise?</a>
							</h4>
						</div>
						<div id="collapseone" class="panel-collapse active collapse" role="tabpanel" aria-expanded="false" style="">
							<div class="panel-body bg-white">
								<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words </p>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise</p>
							</div>
						</div>
					</div>
					<div class="panel panel-default mb-4 border p-0">
						<div class="panel-heading1">
							<h4 class="panel-title1">
								<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapsetwo" aria-expanded="false">2. What Classifieds Categories do you offer?</a>
							</h4>
						</div>
						<div id="collapsetwo" class="panel-collapse collapse active" role="tabpanel" aria-expanded="false">
							<div class="panel-body bg-white">
								<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words </p>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise</p>
							</div>
						</div>
					</div>
					<div class="panel panel-default mb-4 border p-0">
						<div class="panel-heading1">
							<h4 class="panel-title1">
								<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapsethree" aria-expanded="false">3. How do I pay for my classified ad?</a>
							</h4>
						</div>
						<div id="collapsethree" class="panel-collapse collapse active" role="tabpanel" aria-expanded="false">
							<div class="panel-body bg-white">
								<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words </p>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise</p>
							</div>
						</div>
					</div>
					<div class="panel panel-default mb-4 border p-0">
						<div class="panel-heading1">
							<h4 class="panel-title1">
								<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour" aria-expanded="false">4. Do you offer frequency Discounts?</a>
							</h4>
						</div>
						<div id="collapseFour" class="panel-collapse collapse active" role="tabpanel" aria-expanded="false">
							<div class="panel-body bg-white">
								<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words </p>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise</p>
							</div>
						</div>
					</div>
					<div class="panel panel-default mb-4 border p-0">
						<div class="panel-heading1">
							<h4 class="panel-title1">
								<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive" aria-expanded="false">5. How will I know if people are responding to my classified ad?</a>
							</h4>
						</div>
						<div id="collapseFive" class="panel-collapse collapse active" role="tabpanel" aria-expanded="false">
							<div class="panel-body bg-white">
								<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words </p>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise</p>
							</div>
						</div>
					</div>
					<div class="panel panel-default border p-0">
						<div class="panel-heading1">
							<h4 class="panel-title1">
								<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapsesix" aria-expanded="false">6. I Know I want to place  an ad,but I still have questions.What should I do?</a>
							</h4>
						</div>
						<div id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-expanded="false">
							<div class="panel-body bg-white">
								<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words </p>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
    </v-container>
    <footer-section></footer-section>
  </v-sheet>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      default: "",
    },
  },
  data() {
    return {
      panel: [0],
      subtitle: "Vous trouvez des reponses à toutes vos questions",
      faq: [
        {
          question: "Qu'est ce que Kalisso.com",
          answer: "Qu'est ce que Kalisso.com",
        },
        {
          question: "Qu'est ce que Kalisso.com",
          answer: "Qu'est ce que Kalisso.com",
        },
        {
          question: "Qu'est ce que Kalisso.com",
          answer: "Qu'est ce que Kalisso.com",
        },
        {
          question: "Qu'est ce que Kalisso.com",
          answer: "Qu'est ce que Kalisso.com",
        },
      ],
    };
  },
};
</script>
