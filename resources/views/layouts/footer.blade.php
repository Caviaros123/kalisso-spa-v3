<!-- ========================= FOOTER ========================= -->

<footer class="section-footer text-center" >

	<!-- ========================= SECTION ITEMS .END// ========================= -->


<div class="container-fluid m-0 bg-light shadow-lg  d-none d-md-block   ">

<!-- SECTION PUB -->
<figure class="mt-3 banner p-3 ">
	@if(!auth()->user())
		<div class="text-lg text-center p-3 dark">
			<label class="text-dark-75 mr-4">Identifiez-vous pour une meilleur expérience</label>
			<a href="/login?ref=footerClick" class="btn btn-outline-success btn-lg ">Connectez-vous</a>
		</div>
	@else
	<div>
		
		<!-- SECTION PUB -->
		<figure class="mt-3 banner p-3 bg-danger">
			<h1 class="text-lg text-center text-uppercase b  white">Le e-commerce made in Congo</h1>
		</figure>
	</div>

	@endif
</figure>


<!-- ========================= SECTION LINKS END.// ========================= -->
	<section class="footer-top padding-top">
		<div class="row">
			<aside class="col-sm-3 col-md-3  mb-3" >
				<h5 class="title b h4 text-uppercase text-muted">Services </h5>
				<ul class="list-unstyled " >
					<li class="nav-item mb-2"> <a class="nav-link text-lowercase p-0 m-0" href="/aide"><i class="fa fa-question-circle text-danger mr-2"></i> Centre d'aide</a></li>
					<li class="nav-item mb-2"> <a class=" nav-link  p-0 m-0" href="/delivery"><i class="fa fa-truck mr-2 text-danger"></i> Livraison </a></li>
					<li class="nav-item mb-2"> <a class="nav-link text-lowercase p-0 m-0 disabled	" href="#">Remboursement</a></li>
					<li class="nav-item mb-2"> <a class="nav-link text-lowercase p-0 m-0" href="/reglement"><i class="fa fa-gavel mr-2 text-danger"></i> Termes et Conditions</a></li>
					<li class="nav-item mb-2"> <a class="nav-link text-lowercase p-0 m-0 " href="#"><i class="fab fa-facebook-messenger mr-2 text-success"></i> Discusion ouverte !</a></li>
				</ul>
			</aside>
			<aside class="col-sm-3 col-md-3 mb-3">
				<h5 class="title text-uppercase text-muted">Mon compte</h5>
				<ul class="list-unstyled text-lowercase p-0 m-0">
					<li class="nav-item mb-2"> <a class=" nav-link text-lowercase p-0 m-0" href="/compte"> Parametres du compte </a></li>
					<li class="nav-item mb-2"> <a class="	nav-link text-lowercase p-0 m-0" href="/compte"> Mes Commandes </a></li>
					<li class="nav-item mb-2"> <a class=" nav-link text-lowercase p-0 m-0" href="/favoris"> Mes Favoris </a></li>
					<li class="nav-item mb-2"> <a class=" nav-link text-lowercase p-0 m-0" href="/login"> Connexion </a></li>
					<li class="nav-item mb-2"> <a class=" nav-link text-lowercase p-0 m-0" href="/register"> Inscription </a></li>
				</ul>
			</aside>
			<aside class="col-sm-3 col-md-3  mb-3">
				<h5 class="title text-uppercase text-muted">A Propos</h5>
				<ul class="list-unstyled  " >
					<li class="nav-item mb-2"> <a class=" nav-link text-lowercase p-0 m-0" href="/about"> Notre histoire </a></li>
					<li class="nav-item mb-2"> <a class=" nav-link text-lowercase p-0 m-0" href="/vendre"> Comment vendre ? </a></li>
					
					<li class="nav-item mb-2"> <a class=" nav-link text-lowercase p-0 m-0 disabled " href="#"> Publicités </a></li>
					<li class="nav-item mb-2"> <a class=" nav-link text-lowercase p-0 m-0 disabled " href="#"> Partenaire </a></li>
				</ul>
			</aside>
			<aside class="col-sm-3 mb-3">
				<article class="">
					<h5 class="title text-uppercase text-muted">Contacts</h5>
					<p>
						<strong>Téléphone: </strong> (+242) 05 545 22 77 <br> 
						<strong>Email:</strong> support@kalisso.com
					</p>
					<div class="btn-group white ">
						<a class="btn btn-facebook" title="Facebook" target="_blank" href="https://facebook.com/phoenone"><i class="fab fa-facebook-f  fa-fw"></i></a>
						<a class="btn btn-instagram" title="Instagram" target="_blank" href="https://instagram.com/phoenone"><i class="fab fa-instagram  fa-fw"></i></a>
						<a class="btn btn-youtube" title="Youtube" target="_blank" href="https://youtube.com/phoenone"><i class="fab fa-youtube  fa-fw"></i></a>
						<a class="btn btn-twitter" title="Twitter" target="_blank" href="https://twitter.com/phoenone"><i class="fab fa-twitter  fa-fw"></i></a>
					</div>
					<div hidden="">
						<img class=" thumbnail wrap w-25 m-3" src="../icon/apple-android-store-icons.png">
					</div>
				</article>
			</aside>
		</div> <!-- row.// -->
		<br> 
	</section>
	<hr>
	<!-- Copyright -->
	<section class="footer-bottom row border-top-dark">
		<div class="container text-dark-50">
			Copyright all right reserved &#9400; <a href="/">Kalisso.com</a> {{date('Y')}}  
				<!-- <a href="https://www.phoenone.com" class="text-dark-50">
					<img src="{{asset('../images/logoPhoenone.png')}}" class="mb-1" style="width: 80px">,
				</a> -->
			</div>
		</section> <!-- //footer-top -->
	</div><!-- //container -->
	<!-- ========================= FOOTER END // ========================= -->
</footer>
