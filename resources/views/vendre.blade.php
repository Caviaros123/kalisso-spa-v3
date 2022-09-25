@extends('layouts.master')

@section('title', 'Vendre')

@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">


<link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>

<link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/ui.css')}}" rel="stylesheet" type="text/css"/>

@stop

@section('content')


<!-- ================= SUCCESS AND ERROR MODAL ============== -->
@if (session()->has('success_message'))
<!-- Modal success-->
<div class="modal fade " id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered " role="document">
		<div class="modal-content bg-transparent shadow-lg border solid borger-light text-light">
			<div class="modal-header shadow-lg bg">
				<button type="button" class="close text-danger rounded" data-dismiss="modal" aria-label="Close">
					<span  aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body bg p-4 text-dark b text-center">
				{!! session()->get('success_message') !!}
				
			</div>
		</div>
	</div>
</div>
@endif

@if ($errors->count() > 0)
<!-- Modal  errors-->
<div class="modal fade " id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered " role="document">
		<div class="modal-content bg-transparent shadow-lg border solid borger-light text-light">
			@foreach($errors->all() as $error)
			<div class="modal-body bg  text-danger p-4 b text-center">
				{{ $error }}
				<button type="button" class="close text-danger " data-dismiss="modal" aria-label="Close">
					<span class="badge badge-danger p-2" aria-hidden="true">&times;</span>
				</button>
			</div>
			@endforeach
		</div>
	</div>
</div>

@endif
<!-- ================= SUCCESS AND ERROR MODAL ============== -->




<nav class="nav navbar bg-light shadow-lg ml-auto ">
	<div class="container">	
		<!-- LOGO BRAND -->
		<div class="col-lg-3 col-sm-4 col-md-4 col-5">
			<a href="/" class="brand-wrap d-flex">
				<img class="brand  " width="140" height="60" src="/kalisso.png" >
				
			</a> <!-- brand-wrap.// -->
		</div>
		<ul class="nav nav-navbar mr-3 ">
<!-- 			<li ><a href="#" class="nav-link text-muted text-lowercase btn">Questions</a></li>
			<li ><a href="#" class="nav-link text-muted text-lowercase btn">Avantages</a></li> -->
			<li><a href="/reglement" class="nav-link text-muted text-lowercase btn">CGV</a> </li>
			<li><a href="/aide" class="nav-link text-muted text-lowercase btn">Aide</a></li>
			<li><a href="/contact" class="nav-link text-muted text-lowercase btn">Nous Contactez</a></li>
			<li><a href="/adminSignUp" class="btn btn-danger b p-2 ml-3 ">METTRE EN VENTE</a></li>
		</ul>
	</div>
	
	
</nav>
<div class="container  my-5 px-2 ">
		<!-- SECTION 1 -->
		<section  class="container pb-5">
			<div class="text-center  pb-3">
				<div class=" pt-5 pb-5" align="left">
				<h1  class="text-uppercase b display-3">Votre boutique ouverte en continu</h1>
				<p class="h6 pt-3 text-muted">
				Accédez à des millions de clients et mettez l’expertise de la vente en ligne et les technologies de recherche et de paiement de kalisso au service de votre entreprise. Vendre sur Kalisso est un processus simple en 5 étapes.</p>
				</div>
				
			</div>
			<div class="padding-y-sm" align="center">
			<a href="/adminSignUp" class="btn btn-danger btn-lg round b p-2 ml-3 p-3">METTRE EN VENTE</a>
		</div>
			<strong ><h4 class="display-3 pl-5">Avant de vous inscrire</h4></strong>
		</section>
		

		<hr class="bg-light ">	

		<!-- SECTION 2 -->
		<section  class="container  row p-5">
			<div class="col-5 text-center">
				<img class="w-50 " src="https://m.media-amazon.com/images/G/01/marketplace-creative/Illustrations-2018/Binoculars.svg">
			</div>
			<div class="col-7 pb-5 text-left ">
				<h1 class="text-uppercase">Décidez de ce que vous voulez vendre </h1>	
					<p class="h6 ">
						<span class="h3 text-danger mr-3">1.</span> Décidez de ce que vous voulez vendre
						Plus de 20 catégories sont ouvertes à tous les vendeurs. Certaines ne sont ouvertes qu’aux vendeurs professionnels.

					</p>
					<a class="pt-5" href="#">En savoir plus sur les catégories de produits ></a>
			</div>
		</section>
		
		<hr class="bg-light ">	

		<!-- SECTION 3 -->
		<section  class="container  row p-5">
			
			<div class="col-7 pb-5 text-left ">
					<h1 class="text-uppercase">Sélectionner un plan de vente</h1>	
					<p class="h6 ">
					<span class="h3 text-danger mr-3">2.</span> 
					Avec deux plans de vente distincts sur Kalisso, vous pouvez vendre à l’unité ou par milliers. Le plan professionnel vous permet de vendre une quantité illimitée de produits pour un abonnement mensuel de 5000 Fcfa (hors TVA). Pour les particuliers, pas d’abonnement mensuel mais une commission de 10% (hors TVA) par article vendu. Les professionnels et les particuliers paient des frais de vente supplémentaires dès qu’un article est vendu.

					</p>
					<a class="pt-5" href="#">En savoir plus sur les plans et les tarifs ›</a>
			</div>
			<div class="col-5 text-center">
				<img class="w-50 " src="https://m.media-amazon.com/images/G/01/marketplace-creative/Illustrations-2018/Magnifying_Glass.svg">
			</div>
		</section>
	

		<hr class="bg-light ">	

		<!-- SECTION 3 -->
		<section  class="container  row p-5">
			<div class="col-5 text-center">
				<img class="w-50 " src="https://m.media-amazon.com/images/G/01/marketplace-creative/Illustrations-2018/Person_At_Desk.svg">
			</div>
			<div class="col-7 pb-5 text-left ">
					<h1 class="text-uppercase">S’inscrire et commencer à répertorier des produits</h1>	
					<p class="h6 ">
					<span class="h3 text-danger mr-3">3.</span> 
					Créez votre compte sur Seller Central, l’interface web sur laquelle vous pourrez aussi gérer votre compte vendeur.

					</p>
					<a class="pt-5" href="#">En savoir plus sur les plans et les tarifs ›</a>
			</div>
			
		</section>

		<hr>

		<section class="container padding-y-lg ">	

			<h2 class="display-4">Une fois inscrit</h2>
			<div class="row-sm padding-y-sm bg shadow-lg">
				

				<div class="col-9 px-5 py-5 ">	

					<h4><span class="h3 text-danger mr-3">1.</span>  Répertorier</h4>
					<p>
						Vous pouvez ajouter des produits au catalogue Kalisso Market, soit un par un, soit en quantité si vous disposez d’un compte vendeur professionnel.
						<br>	
						<br>	
						Deux façons de répertorier des produits:
					</p>
					<div class="ml-5">
						<div class="container px-5  bg ">	
							<h4><span class="h3 b h-2 text-danger mr-3">1.</span>  Répertorier des produits déjà présents sur Kalisso.com</h4>	
						</div>
						<p class="px-5">	
							   Indiquez le nombre de produits que vous avez à vendre, l’état du ou des produit(s) et les options de livraison.
						</p>
					</div>
					<div class="ml-5">
						<div class="container px-5  bg ">	
							<h4><span class="h3 b h-2 text-danger mr-3">2.</span>  Répertorier des produits qui n’existent pas encore sur Kalisso.com</h4>	
						</div>
						<p class=" mx-5">	
							   <ul class="ml-5 mx-5">	
							   		<li>Identifiez les codes UPC/EAN et SKU</li>
							   		<li>Répertoriez les caractéristiques des produits (titre, description, etc.)</li>
							   </ul>
						</p>
					</div>

				</div>
				<div class="col-3 padding-y-lg">
						<img class="w-50" src="https://m.media-amazon.com/images/G/01/marketplace-creative/Illustrations-2018/Checklist.svg">
				</div>
			</div>


			<hr>	
			<div class="px-5 py-5">
			

				<!-- SECTION 1 -->
				<section  class="container  row p-5">
					<div class="col-5 text-center">
						<img class="w-50 " src="https://m.media-amazon.com/images/G/01/marketplace-creative/Illustrations-2018/Special_Product.svg">
					</div>
					<div class="col-7 pb-5 text-left ">
							<p class="h1"><span class="h1 text-danger mr-3">2.</span>Vendre	</p>
							<p class="h6 pt-3 ml-5">
								 Vous disposez de différentes possibilités pour gérer vos commandes, en fonction du nombre de commandes que vous recevez :
								 <ul class="ml-3">
								 	<li><p><strong>Outil de gestion des commandes </strong>: visualisez une liste de vos commandes et les détails concernant une commande sélectionnée dans Seller Central.</p></li>
								 	<li><p><strong>Rapports de commande </strong>: recevez des informations sur le traitement de plusieurs commandes en exécutant un seul rapport.</p></li>
								 	<li><p><strong>Rapports de commande </strong>: recevez des informations sur le traitement de plusieurs commandes en exécutant un seul rapport.</p></li>
								 </ul>

							</p>
							<a class="pt-5" href="#">En savoir plus sur les options de gestion des commandes ›</a>
					</div>
				</section>

				<hr class="bg-light ">	

				<section  class="container  row p-5">
					<div class="col-7 pb-5 text-left ">
							<p class="h1"><span class="h1 text-danger mr-3">3.</span>Expédition	</p>
							<p class="h6 pt-3 ml-5">
								 Kalisso vous alerte quand un client passe commande.
							</p>
							
					</div>
					<div class="col-5 text-center">
						<img class="w-50 " src="https://m.media-amazon.com/images/G/01/marketplace-creative/Illustrations-2018/Shipping.svg">
					</div>
				</section>

				<hr class="bg-light ">	

				<section  class="container  row p-5">
					<div class="col-5 text-center">
						<img class="w-50 " src="https://m.media-amazon.com/images/G/01/marketplace-creative/Illustrations-2018/Money.svg">
					</div>
					<div class="col-7 pb-5 text-left ">
							<p class="h1"><span class="h1 text-danger mr-3">4.</span>Encaissement	</p>
							<p class="h6 pt-3 ml-5">
								 Kalisso dépose régulièrement les paiements sur votre Mobile Money ou Digibox et vous informe que le règlement a bien été effectué.
						
							</p>
							
					</div>
				</section>

			</div>
		

		</section>

	</div>
	


	<div class="shadow-lg">
		
		@include('layouts.footer')
	</div>
	@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" integrity="sha512-VZ6m0F78+yo3sbu48gElK4irv2dzPoep8oo9LEjxviigcnnnNvnTOJRSrIhuFk68FMLOpiNz+T77nNY89rnWDg==" crossorigin="anonymous"></script>

@stop