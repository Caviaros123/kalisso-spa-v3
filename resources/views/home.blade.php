@extends('layouts.master')

@section('title', 'Le e-commerce numero 1 made in Congo')

@include('layouts.navbar')


@section('extra-css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<link href="{{asset('css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />

<meta charset="utf-8" name="acceuil" content="Achat et vente en ligne parmi des millions de produits en stock. Livraison gratuite à partir de 2.000Fcfa. Vos articles à petits prix : culture, high-tech, mode, jouets, sport ...">



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
			<div class="modal-body bg p-4 text-success b text-center">

				<i class="fa fa-check text-success fa-2x mt-2 mr-3"></i>
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


<!-- CAROUSEL -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	<div class="d-none d-md-block">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
		</ol>
	</div>

	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="images/banners/banner1.jpg" alt="First slide">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="images/banners/banner2.jpg" alt="Second slide">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="images/banners/banner3.jpg" alt="Third slide">
		</div>
		
		

	</div>

	
	
	<!-- CAROUSEL NAV -->
	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Precedent</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Suivant</span>
	</a>
</div>
<!-- 
	inclure la navigation en mobile -->

	@include('partials.nav_cat')


	@if(!auth()->user())
	<div class="container padding-y-sm card" align="center">
		<p>
			<h5 class="mb-4">Identifiez-vous pour une meilleure expérience</h5>
			<a href="/login" class="p-2 btn-outline-success border  rounded pt-2  col-12   text-center"><h6>Connectez-vous ici</h6></a> 
		</p>
		
	</div>
	@endif


	<!-- ========================= SECTION CONTENT ========================= -->
	<section class="padding-bottom container-fluid padding-y-sm d-none d-md-block">
		<header class="section-heading heading-line bg">
			<h4 class="title-section text-uppercase">Nos catégories</h4>
		</header>

		<div class="card card-home-category container-fluid padding-y-sm d-none d-md-block ">
			<div class="row no-gutters">
				<div class="col-md-3">
					
					<div class="home-category-banner bg-light-danger">
						<h5 class="title display-4">Les catégories préférées de nos clients</h5>
						<!-- <p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p> -->
						<a href="/category" class="btn btn-outline-danger rounded">Parcourir</a>
						<img src="site_kali_icon.png" class="img-bg">
					</div>

				</div> <!-- col.// -->
				<div class="col-md-9">
					<ul class="row no-gutters bordered-cols">
						<li class="col-6 col-lg-3 col-md-4">
							<a href="#" class="item"> 
								<div class="card-body">
									<h6 class="title">Montre bluetooth mixte</h6>
									<img class="img-md float-right" src="images/items/7.jpg"> 
									<!-- <p class="text-muted"><i class="fa fa-map-marker-alt"></i> Tokyo, Japan</p> -->
								</div>
							</a>
						</li>
						<li class="col-6 col-lg-3 col-md-4">
							<a href="#" class="item"> 
								<div class="card-body">
									<h6 class="title">Airpods</h6>
									<img class="img-md float-right" src="images/items/8.jpg"> 
									<!-- <p class="text-muted"><i class="fa fa-map-marker-alt"></i> Hong Kong, China</p> -->
								</div>
							</a>
						</li>
						<li class="col-6 col-lg-3 col-md-4">
							<a href="#" class="item"> 
								<div class="card-body">
									<h6 class="title">Casque sans fil</h6>
									<img class="img-md float-right" src="images/items/9.jpg"> 
									<!-- <p class="text-muted"><i class="fa fa-map-marker-alt"></i> Tashkent, Uzb</p> -->
								</div>
							</a>
						</li>
						<li class="col-6 col-lg-3 col-md-4">
							<a href="#" class="item"> 
								<div class="card-body">
									<h6 class="title">Réveil électronique</h6>
									<img class="img-md float-right" src="images/items/10.jpg"> 
									<!-- <p class="text-muted"><i class="fa fa-map-marker-alt"></i> Guanjou, China</p> -->
								</div>
							</a>	
						</li>
						<li class="col-6 col-lg-3 col-md-4">
							<a href="#" class="item"> 
								<div class="card-body">
									<h6 class="title">Caméra GoPro</h6>
									<img class="img-md float-right" src="images/items/11.jpg"> 
									<!-- <p class="text-muted"><i class="fa fa-map-marker-alt"></i> Guanjou, China</p> -->
								</div>
							</a>
						</li>
						<li class="col-6 col-lg-3 col-md-4">
							<a href="#" class="item"> 
								<div class="card-body">
									<h6 class="title">Cuisine et électroménager</h6>
									<img class="img-md float-right" src="images/items/12.jpg"> 
									<!-- <p class="text-muted"><i class="fa fa-map-marker-alt"></i> Guanjou, China</p> -->
								</div>
							</a>
						</li>
						<li class="col-6 col-lg-3 col-md-4">
							<a href="#" class="item"> 
								<div class="card-body">
									<h6 class="title">Habillments et modes</h6>
									<img class="img-md float-right" src="images/items/1.jpg"> 
									<!-- <p class="text-muted"><i class="fa fa-map-marker-alt"></i> Guanjou, China</p> -->

								</div>
							</a>
						</li>
						<li class="col-6 col-lg-3 col-md-4">
							<a href="#" class="item"> 
								<div class="card-body">
									<h6 class="title">Chaussures baskets homme | femme </h6>
									<img class="img-md float-right" src="images/items/15.jpg"> 
									<!-- <p class="text-muted"><i class="fa fa-map-marker-alt"></i> Guanjou, China</p> -->
								</div>
							</a>
						</li>
					</ul>
				</div> <!-- col.// -->
			</div> <!-- row.// -->
		</div> <!-- card.// -->
	</section>


	<!-- ========================= SECTION CONTENT END// ========================= -->

	<div class="container d-block d-md-none padding-y-sm">
		<div class="d-flex  table table-responsive">
			@forelse($mightAlsoLike as $prod)
			<!-- init -->
                <div class="col-sm-4 col-md-2 col-6 m-0 p-0 mr-2" style="font-size: 12px">
                	<figure class=" card-product shadow rounded" style="border: none!important;">
                		<a href="{{route('shop.show', $prod->slug)}}">
                			<div class="img-box img-fluid img-md m-auto m-0 p-0">
                				<img src="{{  productImage($prod->image) }}" title="{{ $prod->name  }} | {{ $prod->details }}" class="img-md m-0 p-0" alt="{{ $prod->details }}">
                			</div>
                		</a>
                		<div class="bottom-wrap p-3 m-0">
                			<p class="title p-0 m-0 b text-truncate">{{ $prod->name }}</p>
                			<figure class="p-0 m-0 text-truncate">{{ $prod->details }}</figure>
                			
                			<form hidden="" action="{{route('cart.store')}}" method="POST" style="display: inline;">
                				@csrf
                				<input hidden="" name="id_produit" value="{{$prod->id}}">
                				<input hidden="" name="name" value="{{$prod->name}}">
                				<input hidden="" name="price" value="{{$prod->price}}">
                				<input hidden="" name="image" value="{{productImage($prod->image)}}">
                				<input hidden="" name="details" value="{{$prod->details}}">
                				<input hidden="" name="slug" value="{{$prod->slug}}">
                				<input hidden="" name="id" value="{{$prod->id}}">

                				{{-- <button type="submit" class="btn btn-success shadow b mt-2 m-0" style="border: none!important;"><i class="fa fa-shopping-cart text-success"></i> +Panier</button> --}}


                				<button type="submit" class="btn btn-md btn-primary shadow float-right">
                					<i class="fa fa-shopping-cart text-success"></i>
                				</button> 
                			</form>
                			<div class="price-wrap h5  text-danger">
                				
                				<span class="price-new h6 text-danger b">{{ presentPrice($prod->price) }}</span> 
                				
                				@if($prod->price < $prod->old_price)
                				<del class="price-old">{{ presentPrice($prod->old_price) }}</del>      
                				@endif

                				@if($prod->featured)
                				<span class="babge badge-danger babge-lg text-light mt-3 mr-2 b p-2 h3 rounded notify">{{ __('Nouveau') }}</span>
                				@endif
                			</div> <!-- price-wrap.// -->
                		</div> <!-- bottom-wrap.// -->
                	</figure>
                </div> <!-- col // -->


                @empty

                <div class="alert alert-danger">
                	<h2>
                		<i class="fas fa-recycle fa-3x"></i>
                		Désoler aucun produit n'est disponible pour le moment !!
                	</h2>
                </div>

                @endforelse
            </div>

        </div>


        {{-- ///////////// BILLET SECTION --}}
        {{-- @include('partials.billet') --}}
        {{-- //////////// END BILLET SECTION --}}


        <div class="container d-block d-md-none padding-y-sm" sty>
        	<header class="section-heading heading-line">
        		<h4 class="title-section bg text-uppercase">Meilleur ventes</h4>
        	</header>
        	<div class="d-flex  table table-responsive" style="font-size: 12px">
        		@forelse($product as $prod)

        		<div class="col-sm-4 col-md-2 col-6 m-0 p-0 mr-2">
        			<figure class=" card-product shadow rounded" style="border: none!important;">
        				<a href="{{route('shop.show', $prod->slug)}}" class="m-0 p-0">
        					<div class="img-box img-fluid img-md m-auto m-0 p-0">
        						<img src="{{ productImage($prod->image)  }}" title="{{ $prod->name }} | {{ $prod->details }}" class="img-md m-0 p-0" alt="{{ $prod->details }}">
        					</div>
        				</a>
        				<div class="bottom-wrap p-3 pr-2 m-0">
        					<p class="title p-0 m-0 b text-truncate">{{ $prod->name }}<br>

        					</p>
        					<figure class="p-0 m-0 text-truncate">{{ $prod->details }}</figure>
        					
        					<form action="{{route('cart.store')}}" method="POST" style="display: inline;">
        						@csrf
        						<input hidden="" name="id_produit" value="{{$prod->id}}">
        						<input hidden="" name="name" value="{{$prod->name}}">
        						<input hidden="" name="price" value="{{$prod->price}}">
        						<input hidden="" name="image" value="{{$prod->image}}">
        						<input hidden="" name="details" value="{{$prod->details}}">
        						<input hidden="" name="slug" value="{{$prod->slug}}">
        						<input hidden="" name="id" value="{{$prod->id}}">

        						{{-- <button type="submit" class="btn btn-success shadow b mt-2 m-0" style="border: none!important;"><i class="fa fa-shopping-cart text-success"></i> +Panier</button> --}}


                                {{-- <button type="submit" class="btn btn-md btn-primary shadow float-right">
                                    <i class="fa fa-shopping-cart text-success"></i>
                                </button> --}}
                            </form>
                            <div class="price-wrap h5  text-danger">
                            	
                            	<span class="price-new h6 text-danger b">{{ presentPrice($prod->price) }}</span> 
                            	
                            	@if($prod->price < $prod->old_price)
                            	<del class="price-old">{{ presentPrice($prod->old_price) }}</del>      
                            	@endif

                            	@if($prod->featured)
                            	<span class="babge badge-danger babge-lg text-light mt-3 mr-2 b p-2 h3 rounded notify">{{ __('Nouveau') }}</span>
                            	@endif
                            </div> <!-- price-wrap.// -->
                        </div> <!-- bottom-wrap.// -->
                    </figure>
                </div> <!-- col // -->


                @empty

                <div class="alert alert-danger">
                	<h2>
                		<i class="fas fa-recycle fa-3x"></i>
                		Désoler aucun produit n'est disponible pour le moment !!
                	</h2>
                </div>

                @endforelse
            </div>

        </div>

        <!-- ========================= Caroussel produit populaire BEGIN// ========================= -->

        <div class="container-fluid d-none d-md-block mt-3 ">
        	<div class="row-sm m-0 p-0">
        		<div class="col-12 m-0 p-0">
        			<header class="section-heading heading-line">
        				<h4 class="title-section bg text-uppercase">LES PLUS POPULAIRES</h4>
        			</header>
        			<div id="myCarousel" class="carouselProduct carousel  m-auto p-0 slide" data-ride="carouselProduct carousel" data-interval="5000">

        				<ol hidden="" class="carousel-indicators carousel-indicators-product m-0 p-0">
        					<li class="bg-secondary mr-3 active" data-target="#carouselExampleIndicators" data-slide-to="0"></li>
        					<li class="bg-secondary mr-3" data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        					<li class="bg-secondary mr-3" data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        					<li class="bg-secondary " data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        				</ol>
        				<!-- Wrapper for carousel items -->
        				<div class="carousel-inner  " style="font-size: 12px">
        					<!-- boucle caroussel produit -->
        					@foreach($product->chunk(6) as $products)
        					<div class="item carousel-item @if($loop->first) active @endif" >
        						<div class="row-sm m-0 p-0 ">
        							@foreach($products as $prod)
        							<div class="col-md-2 col-6 card-product shadow m-0 p-0 ">
        								<div class=" border-none   m-0 p-0" style="border: none!important;">
        									<a href="{{route('shop.show', $prod->slug)}}">
        										<div class="img-box img-sm">
        											<img src="{{ productImage($prod->image) }}" class="img-responsive m-0 p-0 img-fluid" alt="">
        										</div>
        									</a>
        									<div class="thumb-content m-0 p-0">
        										<a class="text-dark " href="{{route('shop.show', $prod->slug)}}">{{ $prod->name }}</a>
        										<p class="item-price m-0 p-0">
        											@if($prod->price < $prod->old_price)
        											<strike>{{ presentPrice($prod->old_price) }}</strike>
        											@endif

        											@if($prod->featured)
        											<span class="badge-new">{{ 'Nouveau' }}</span>
        											@endif

        											<span class="b text-danger">{{ presentPrice($prod->price) }} </span>
        										</p>
        										
        										<form action="{{route('cart.store')}}" method="POST">
        											@csrf
        											<input hidden="" name="id_produit" value="{{$prod->id_produit}}">
        											<input hidden="" name="name" value="{{$prod->name}}">
        											<input hidden="" name="price" value="{{$prod->price}}">
        											<input hidden="" name="image" value="{{$prod->image}}">
        											<input hidden="" name="details" value="{{$prod->details}}">
        											<input hidden="" name="slug" value="{{$prod->slug}}">
        											<input hidden="" name="id" value="{{$prod->id}}">
        											
        											{{-- <button type="submit" class="btn btn-danger  pl-4 pr-4 p-2 rounded shadow-lg" style="border: none!important;"><i class="fab fa-opencart"></i> +Panier</button> --}}
        										</form>
        									</div>            
        								</div>
        							</div>
        							@endforeach
        						</div>
        					</div>  
        					@endforeach
        				</div>


        				<!-- Carousel controls -->
        				<a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
        					<i class="fa fa-angle-left"></i>
        				</a>
        				<a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
        					<i class="fa fa-angle-right"></i>
        				</a>
        			</div>
        		</div>
        	</div>
        </div>

        <!-- ========================= Caroussel produit populaire END// ========================= -->

        <!-- ========================= SECTION ITEMS ========================= -->
        <section class="section-request  padding-y py-5">
        	<div class="container-fluid m-0 p-0" style="background-color: white">
        		<header class="section-heading heading-line">
        			<h4 class="title-section bg text-uppercase pl-4">Produits Recents</h4>
        		</header>

        		<div class="row-sm cols-flex m-0 p-0" style="font-size: 12px">
        			@forelse($mightAlsoLike as $prod)

        			<div class="col-sm-4 col-md-2 col-6 shadow  m-0 p-0">
        				<figure class=" card-product m-0 p-0" style="border: none!important;">
        					<a href="{{route('shop.show', $prod->slug)}}" class="p-0 m-0">
        						<div class="img-box img-fluid img-md m-auto  m-0 p-0">
        							<img src="{{ productImage($prod->image)}}" title="{{ $prod->name }} | {{ $prod->details }}" class="img-md m-0 p-0" alt="{{ $prod->details }}">
        						</div>
        					</a>
        					
        					<div class="bottom-wrap p-2 mt-2 m-0 p-0">
        						
        						<figure class="p-0 m-0 text-truncate"> {{ $prod->name }}<br>{{ $prod->details }}</figure>

        						
        						<form action="{{route('cart.store')}}" method="POST" class="m-0 p-0" style="display: inline;">
        							@csrf
        							<input hidden="" name="id_produit" value="{{$prod->id}}">
        							<input hidden="" name="name" value="{{$prod->name}}">
        							<input hidden="" name="price" value="{{$prod->price}}">
        							<input hidden="" name="image" value="{{$prod->image}}">
        							<input hidden="" name="details" value="{{$prod->details}}">
        							<input hidden="" name="slug" value="{{$prod->slug}}">
        							<input hidden="" name="id" value="{{$prod->id}}">

        							{{-- <button type="submit" class="btn btn-success shadow b mt-2 m-0" style="border: none!important;"><i class="fa fa-shopping-cart text-success"></i> +Panier</button> --}}


                               {{--   <button type="submit" class="btn btn-md btn-primary shadow float-right">
                                    <i class="fa fa-shopping-cart text-success"></i>
                                </button>  --}}
                            </form>
                            <div class="price-wrap h5 m-0 p-0 text-danger">
                            	
                            	<span class="price-new h6 text-danger m-0 p-0 b">{{ presentPrice($prod->price) }}</span> 
                            	
                            	@if($prod->price < $prod->old_price)
                            	<del class="price-old">{{ presentPrice($prod->old_price) }}</del>      
                            	@endif

                            	@if($prod->featured)
                            	
                            	<h5><span class="badge badge-secondary mr-3 mt-3 shadow rounded notify">{{ __('Nouveau') }}</span></h5>
                            	@endif
                            </div> <!-- price-wrap.// -->
                        </div> <!-- bottom-wrap.// -->
                    </figure>
                </div> <!-- col // -->


                @empty

                <div class="alert alert-danger">
                	<h2>
                		<i class="fas fa-recycle fa-3x"></i>
                		Désoler aucun produit n'est disponible pour le moment !!
                	</h2>
                </div>

                @endforelse
                <div class="text-muted px-2 m-auto padding-y d-block d-md-none my-3" style="font-size: 10px">
                	--------- Fin de la liste -----------
                </div>
            </div> <!-- row.// -->
        </div><!-- container // -->
    </section>




    <div class="modal  fade-scale " id="newsletter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    	<div class="modal-dialog modal-dialog-centered " role="document">
    		<div class="modal-content shadow-lg border solid borger-light bg-danger text-light">
    			<div class="modal-header shadow-lg ">
    				<h4 class="h2">Bienvenue sur kalisso.com</h4>
    				<span  aria-hidden="true" class="close text-danger rounded" data-dismiss="modal" aria-label="Close">&times;</span>
    				
    			</div>
    			<form action="" method="post">
    				@csrf


    				<div class="modal-body col-12 b text-center">
    					<span class="display-4">Ne manquez pas nos offres d'achats!</span>
    					<input type="email" class="form-control-lg col-12 shadow " placeholder="Entrer votre email ici" id="email">
    					
    					
    				</div>
    				<div class="modal-footer text-center" align="center">
    					<button class="subscribe m-3 btn btn-light btn-lg shadow">SOUSCRIRE</button>
    				</div>
    			</form>
    		</div>
    	</div>
    </div>



    @include('layouts.footer')

    @stop

    @section('extra-js')
    <script  src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript">

	 // $(window).on("load", function() { 
		// (function myOnLoadFunc(){
		// 	$('#newsletter').modal('show');
		// 	setInterval(function () {
		// 			$("#newsletter").modal('hide');
		// 	}, 8000);
		// })();

		// console.log("Toutes les ressources sont chargées !");


 	// });

 	$(window).on("load", function() { 
 		(function myOnLoadFunc(){
 			$('#exampleModalCenter').modal('show');
 			setInterval(function () {
 				$("#exampleModalCenter").modal('hide');
 			}, 5000);

 			
 		})();
 	});
 	
 	

 </script>




 @stop

