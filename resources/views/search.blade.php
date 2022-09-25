@extends('layouts.master')

@section('title', 'Recherche')

@include('layouts.navbar')

@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">


<link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>

<link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />

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

<section class="section-content bg padding-y-sm">
	<div class="container-fluid">
			<div class="card-body m-0 p-0 p-2" style="border: none!important;">

				<div class="row-sm">
					<div class="col-4"> 
						<strong>Filtrer par:</strong> 
					</div> <!-- col.// -->
					<div class="col-md-21-24"> 
						<ul class="list-inline">
							<li class="list-inline-item dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Type de vendeur </a>
								<div class="dropdown-menu p-3 " style="min-width:200px;" >	
									<label class="form-check">
										<a href="#">
											<input type="checkbox" class="form-check-input"> Bon deal
										</a>
									</label>
									<label class="form-check">
										<a href="#">
											<input type="checkbox" class="form-check-input"> Meilleur Vendeur
										</a>
									</label>
									<label class="form-check">
										<a href="#">
											<input type="checkbox" class="form-check-input"> Nouveau Vendeur
										</a>
									</label>
								</div> <!-- dropdown-menu.// -->
							</li>
							<li class="list-inline-item dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">  Pays </a>
								<div class="dropdown-menu p-3" style="max-width:400px;">	
									<label class="form-check">
										<a href="#">
											<input type="checkbox" class="form-check-input"> Congo
										</a>
									</label>
									<label class="form-check">
										<a href="#">
											<input type="checkbox" class="form-check-input"> RDC
										</a>
									</label>
									<label class="form-check">
										<a href="#">
											<input type="checkbox" class="form-check-input"> Cameroun
										</a>
									</label>
									<label class="form-check">
										<a href="#">
											<input type="checkbox" class="form-check-input"> Gabon
										</a>
									</label>
									
								</div> <!-- dropdown-menu.// -->
								<li class="list-inline-item dropdown">
									<div class="form-inline">
										<label class="mr-2">Prix</label>
										<input class="form-control form-control-sm" placeholder="Min" type="number">
										<span class="px-2"> - </span>
										<input class="form-control form-control-sm" placeholder="Max" type="number">
										<button type="submit" class="btn btn-sm ml-2">Ok</button>
									</div>
								</li>
							</li>
							
						</ul>
					</div> <!-- col.// -->
				</div> <!-- row.// -->
			</div> <!-- card-body .// -->
		

		<div class=" row">
			<div class="col-8 text-left">
				@if(count($products) == 0)

				<span class=""><strong class="text-danger">{{count($products)}}</strong> Aucun résultat pour votre recherche </span>

				@else

				<span><strong class="text-danger">{{$products->total()}}</strong> Résultat(s) trouvées pour : <strong class="text-muted h4">{{ request()->input('search')}}</strong></span>

				@endif

			</div>
			<div class="col-md-4" >
				
			{!! $products->appends(request()->input())->links() !!}
			</div>
		</div>

		<div class="row-sm cols-flex">

			@forelse($products as $prod)


                <div class="col-sm-4 col-md-2 col-6  ">
                    <figure class=" card-product" style="border: none!important;">
                        <a href="{{route('shop.show', $prod->slug)}}">
                            <div class="img-box img-fluid img-md m-auto m-0 p-0">
                                <img src="{{ asset('storage/'.loadImg($prod->image))}}" title="{{ $prod->name }} | {{ $prod->details }}" class="img-md p-2" alt="{{ $prod->details }}">
                            </div>
                        </a>
                        <div class="bottom-wrap p-3 m-0">
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


                                   {{--  <button type="submit" class="btn btn-md btn-primary shadow float-right">
                                        <i class="fa fa-shopping-cart text-success"></i>
                                    </button>  --}}
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
			<div class="text-center col-12">
				<div class="alert alert-danger p-5 m-5">
					<h4>Aucun produit trouver pour cette recherche, veuillez réessayer s'il vous plaît </h4>
				</div>
			</div>

			@endforelse


			{!! $products->appends(request()->input())->links() !!}
		</div> <!-- row.// -->


	</div><!-- container // -->
</section>


@include('layouts.footer')

@stop




@section('js')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">

	(function myOnLoadFunc(){

		$('#exampleModalCenter').modal('show').fadeOut(2000,function() {
			$(this).modal('hide');
		});

	})();

	// setInterval(function () {
	//    $('#myModal').modal('show');
	// }, 5000);

</script>

@stop
