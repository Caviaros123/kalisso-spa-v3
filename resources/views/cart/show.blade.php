@extends('layouts.master')

@section('title', $products->slug)

@if( (new Jenssegers\Agent\Agent)->isDesktop() )
	@include('layouts.navbar')
@endif

@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />
<!-- // import for zoom image viewer -->
<link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
<link rel="stylesheet" href="{{asset('/assets/style.css')}}">

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

@if( (new Jenssegers\Agent\Agent)->isMobile() )
<!-- PRODUCT SHOWING -->
<section class="section-content bg ">
	
	<!-- MOBILE APPARENCE -->
		
<div>	
	<nav id="nav-top" class="nav-navbar padding-y-sm float-top fixed-top bg-none px-2 navbar-transparent">
					<ul class="nav">
						<li class="nav-item">
							<!-- <a href="{{ URL::previous() }}" class="nav-link"><i class="fa fa-arrow-left text-danger fa-1x shadow p-2 rounded-circle bg"> </i></a> -->
							<a href="{{ route('home') ?: URL::previous() }}" class="nav-link"><i class="fa fa-arrow-left text-danger fa-1x shadow p-2 rounded-circle bg"> </i></a>
						</li>
						<li class="nav-item ml-auto">
							<a href="/search" class="nav-link"><i class="fa fa-search iconix text-danger shadow fa-1x p-2 rounded-circle bg"> </i></a>
						</li>
						
					</ul>
				</nav>
		<div id="carouselExampleIndicators"  class="carousel d-block d-md-none  slide" data-ride="carousel">
				
				@if($products->images)	
					  <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="shadow active"></li>

                           @foreach(json_decode(loadImg($products->images, true)) as $image)

							     <li data-target="#carouselExampleIndicators" data-slide-to="1++" class=" shadow"></li>
							
					       @endforeach
					  </ol>
		  		@endif
				  <div class="carousel-inner " style="width: 100%!important; height: 300px!important">
				  		
				  			<div class="carousel-item active m-auto " align="center">	
									<img  class="d-block img-fluid img-lg img-bg" src="{{productImage($products->image)}}" alt="First slide">

				  			</div>
						@if($products->images)	
				  			@foreach(json_decode($products->images, true) as $image)

		    					<div class="carousel-item  m-auto " align="center">
		    						<img alt="produit" class="d-block img-fluid img-lg img-bg" src="{{productImage($image)}}">
		    					</div>

							@endforeach
			   			@endif

						   
				  </div>
				  	@if($products->images)
					    <!-- CAROUSEL NAV -->
					    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					        <span class="sr-only">Precedent</span>
					    </a>
					    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					        <span class="carousel-control-next-icon" aria-hidden="true"></span>
					        <span class="sr-only">Suivant</span>
					    </a>
					@endif
		</div>
	</div>
		<!-- SUBMIT FORM MOBILE  -->
		<form  hidden="hidden" id="SubForm" action="{{route('cart.store')}}" method="POST" style="display: inline">
		          @csrf

		          	<input hidden="" name="id_produit" value="{{$products->id}}">
		            <input hidden="" name="name" value="{{$products->name}}">
		            <input hidden="" name="price" value="{{$products->price}}">
		            <input hidden="" name="image" value="{{$products->image}}">
		            <input hidden="" name="details" value="{{$products->details}}">
		            <input hidden="" name="slug" value="{{$products->slug}}">
		            <input hidden="" name="id" value="{{$products->id}}">
		            <input hidden="" name="send" value="addToCart">
				</form>	

				<form hidden="hidden"  id="SubForm_checkout" action="{{route('cart.store')}}" method="POST" style="display: inline">
		          @csrf

		          	<input hidden="" name="id_produit" value="{{$products->id}}">
		            <input hidden="" name="name" value="{{$products->name}}">
		            <input hidden="" name="price" value="{{$products->price}}">
		            <input hidden="" name="image" value="{{$products->image}}">
		            <input hidden="" name="details" value="{{$products->details}}">
		            <input hidden="" name="slug" value="{{$products->slug}}">
		            <input hidden="" name="id" value="{{$products->id}}">
		            <input hidden="" name="send" value="addToCheckout">
		            
				</form>	
			
		<div class="container shadow-lg">	
		<div class="float-right" >
		
	
			@if(Auth::user())
				<form  action="/products/{{ $products->id }}/like" method="POST">
					@csrf
					@if($products->isLikedBy(auth()->user()))
						@method('DELETE')
					@else
						@method('PUT')
					@endif 
					<button type="submit" class="btn p-0 m-0 ">
						<i  class=" rounded-circle fa fa-heart text-danger fa-2x p-3 pt-3 mr- shadow-lg  border  border-danger solid @if($products->isLikedBy(auth()->user()))   bg-danger text-light   @elseif($products->isDislikedBy(auth()->user())) bg-light text-danger  @endif" style="z-index: 9999"></i>
					</button>
				</form>
			@else
				<form action="/products/{{ $products->id }}/like" method="POST">
					@csrf
					@method('PUT')
					<button type="submit" class="btn p-0 m-0 ">
						<i  class=" rounded-circle fa fa-heart text-danger fa-2x p-3 pt-3 mr- shadow-lg  border  border-danger solid 
							bg-light text-danger " style="z-index: 9999"></i>
					</button>
				</form>
			@endif
						
			
	
		</div>
					
				<div class="row ">	
					<div class="px-3 py-3 col-12" style="font-size: 12px">	
						
						<p class="p-0 m-0">	
							{{$products->name}}
							
							<p class="p-0 m-0">
								{{$products->details}}
							</p>
						</p>
						<p class="p-0 m-0 h3 text-danger">	
							{{ presentPrice($products->price) }}
						</p>
						@if($products->coupon)
							<p class="m-0 p-0 d-flex mt-2" style="font-size: 18px">
								<span class="badge badge-danger pl-2 pr-2 mr-2 round alert-danger">% price réduit</span>	
								<span class="badge badge-danger pl-2 pr-2 round alert-primary"><i class="fa fa-truck ml-1"></i> Livraison gratuite</span>	
							</p>
						@endif
						<div class="m-0 p-0 d-flex mt-2" style="font-size: 14px">
							<aside class="text-muted m-0 mr-3 p-0">{{$products->transaction ?? '0 Commandes'}}</aside>
							<aside class="text-muted m-0 p-0">
									{{ $products->likes->where('liked', true)->count() ?: 0 }} J'aime
							</aside>
						</div>

						<hr>

						<div class=" m-0 p-0">
							<div class="header m-0 p-0" style="font-size: 18px">
								<p>Estimation de livraison</p>
							</div>
							<p>
								{{ $products->livraison ?: 'Le '.str_replace('-', ' ', strftime('%A %d %B %Y', strtotime($products->created_at))) }}
							</p>
						</div>
					</div>
	
				</div>


		</div>


		<div class="container my-3 shadow-lg">	
				<div class=" m-auto section-heading heading-line">
					<h4 class="title-section bg my-2" style="z-index: 0">Plus de details</h4>
				</div>
				<div class="row ">	
					<div class="px-3 py-3 col-12" style="font-size: 12px">	

						<p class="p-0 m-0">	
							
							
							<p class="p-0 m-0 text-justify">
							{!!$products->description!!}
							</p>
						</p>
						
					</div>

				</div>


		</div>




		<div class="container-fluid shadow-lg">
			<div class=" row my-3 bg">
				<div class="col-6 m-auto section-heading heading-line">
					<h5 class="title-section bg text-truncate my-2" style="z-index: 0">{{$getStore->store_name}}</h5>
				</div>
				<div class="col-6 m-auto ml-auto" align="right">
					<a href="/{{$getStore->slug}}" class="btn btn-sm round my-auto btn-primary ">Visiter <i class="fa fa-arrow-right">	</i></a>
				</div>
				<div class="pl-3 my-2">
					<p class="p-0 m-0 text-muted text-center">
						{{$getStore->description}}
						
					</p>
				</div>

				<div class="d-flex px-3 py-1 m-0 col-sm-12 offset-sm-12" align="center">	
					<div class="col-4 m-0" align="center">	
						<span class="h3">{{ App\Product::where('email', $getStore->email)->count() }}</span><br>	
						<small>Produits</small>
					</div>
					<div class="col-4 m-0" align="center">	
						<span class="h3">{{ App\Product::where('email', $getStore->email)->where('featured', 1)->count() }}</span><br>	
						<small>Nouveauté</small>
					</div>
					<div class="col-4  m-0" align="center">	
						<p class="p-0 m-0"><span class="h3">0  </span><br>
						<small>Followers</small></p>
					</div>
				</div>
				<hr>		
				<div class="py-1 my-1  container col-sm-12 offset-sm-12 " align="center"> 

                		<a href="/{{$getStore->slug}}?view=0" class="ml-auto shadow-lg btn btn-outline-danger rounded">S'abonner <i class="fa fa-store ml-2">  </i></a>

            	</div>
				<hr>	
				<div class="container">
					
						<div class="py-3 my-2 container col-sm-12 offset-sm-12 " align="center"> 
							<h5 class=" bg " >Vous aimerez peut être </h5>
						</div>
						
					
					
					<div class="d-flex">	

							@foreach($mightAlsoLike->where('email', $getStore->email)->take(3) as $product)
							<div class="col-4" align="center">	
								 <a href="{{route('cart.show', $product->slug)}}"><img src="{{ productImage(loadImg($product->image))}}" title="{{ $product->name }} | {{ $product->details }}" class="img-sm m-0 p-2 mb-2 border border-muted rounded solid" alt="{{ $product->details }}">
								<small>{{ presentPrice($product->price) }}</small></a>
							</div>
							@endforeach
					</div>
					
				</div>
			</div>
		</div>
		<div class="container shadow-lg">	

			
			 <header class="section-heading bg heading-line">
              <h4 class="title-section bg  p-2">Produits similaires</h4>
            </header>
			<div class="d-flex my-3 table table-responsive">

				<!-- $categoriesForProduct->contains($category) -->

			         @forelse($mightAlsoLike as $prod)

			            <div class="col-sm-4 col-md-2 col-6 m-0 p-0 mr-2" style="font-size: 12px">
			                <figure class=" card-product  rounded" style="border: none!important;">
			                    <a href="{{route('shop.show', $prod->slug)}}">
			                        <div class="img-box img-fluid img-md m-auto m-0 p-0">
			                            <img src="{{ productImage(loadImg($prod->image))}}" title="{{ $prod->name  }} | {{ $prod->details }}" class="img-md m-0 p-0" alt="{{ $prod->details }}">
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





</section>
@else

<div class="row">
	<div class="col-md-4">
		
	</div>
	<div class="col-md-8">
		
	</div>
	
</div>

@endif

@include('layouts.footer')
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" integrity="sha512-VZ6m0F78+yo3sbu48gElK4irv2dzPoep8oo9LEjxviigcnnnNvnTOJRSrIhuFk68FMLOpiNz+T77nNY89rnWDg==" crossorigin="anonymous"></script>

<script type="text/javascript">
	(function() {
		const currentImage = document.querySelector('#currentImage');
		const images = document.querySelectorAll('.item-gallery');

		images.forEach((element) => element.addEventListener('click', thumbnailClick));

		function thumbnailClick(e){
			currentImage.src = this.querySelector('img').src;

			images.forEach((element) => element.classList.remove('active'));
			this.classList.add('zoom-in active');
		}
	})();

</script>
<script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha384-JUMjoW8OzDJw4oFpWIB2Bu/c6768ObEthBMVSiIx4ruBIEdyNSUQAjJNFqT5pnJ6" crossorigin="kalisso.com"></script>
<script src="{{asset('./assets/zoomsl.js')}}"></script>
<script src="{{asset('./assets/script.js')}}"></script>
<script type="text/javascript">
    (function myOnLoadFunc(){

            $('#exampleModalCenter').modal('show').fadeOut(2000,function() {
                $(this).modal('hide');
            });

        })();
</script>

@stop
