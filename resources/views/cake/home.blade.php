@extends('layouts.master')

@section('title', 'Acceuil')

@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">


<link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>

<link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />

@stop

@include('layouts.navbar')


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

<div class="container py-5 ">
	<div class="col-4 col-md-12 text-center mb-3">		
		<a href="{{route('cake.store')}}" class="btn btn-outline-secondary shadow form-control p-5 "><i class="fa fa-map"></i> {{ $getCake->name }}</a>
		<div>
			<h1>{{ $getCake->name }}</h1>
		</div>
		<div class="main">
			<div class="row">
				@forelse($cakeProduct as $prod)

				<div class="col-sm-2 col-sm-1">
					<figure class="card text-center card-product">
						<a href="{{route('shop.show', $prod->slug)}}">
							<div class="img-box">
								<img src="{{asset('../storage')}}/{{$prod->image}}" title="{{ $prod->name }} | {{ $prod->details }}" class="img-responsive p-3 img-fluid" alt="{{ $prod->details }}">
							</div>
						</a>
						<figcaption class="info-wrap">
							<h6 class="title">
								<a class="text-dark" href="{{route('shop.show', $prod->slug)}}">{{ $prod->name }}</a>
							</h6>
							<div class="price-wrap">
								<span class="price-new h6 text-success">{{ presentPrice($prod->price) }}</span>
								
							</div> <!-- price-wrap.// -->
							<div class="text-center mt-2">
								
								<form action="{{route('cart.store')}}" method="POST">
									@csrf
									<input hidden="" name="id_produit" value="{{$prod->id_produit}}">
									<input hidden="" name="name" value="{{$prod->name}}">
									<input hidden="" name="price" value="{{$prod->price}}">
									<input hidden="" name="image" value="{{asset('../storage')}}/{{$prod->image}}">
									<input hidden="" name="details" value="{{$prod->details}}">
									<input hidden="" name="id" value="{{$prod->id}}">
									
									<button type="submit" class="btn btn-info rounded shadow"><i class="fab fa-opencart"></i> +Panier</button>
								</form>
							</div>
							
						</figcaption>
					</figure> <!-- card // -->
				</div> <!-- col // -->

				@empty
				
				<div class="alert alert-danger">
					<h2>
						<i class="fas fa-recycle fa-3x"></i>
						Désoler Aucun Produit N'est Disponible Pour Le Moment !!
					</h2>
				</div>

				@endforelse
			</div>
		</div>
	</div>
</div>



@stop