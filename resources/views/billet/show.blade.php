@extends('layouts.master')

@section('title', 'reservation')

@section('background')


style="background-image: url('/img/bg7.jpg'); background-attachment: fixed; background-repeat: no-repeat; background-position: center;background-size: cover; background-origin: content-box;"


@stop

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

<div class="container py-3 px-3" align="center">
	<div class="text-left ml-0">	
		<a href="/reservation" class="btn btn-primary text-light p-2 mb-3 btn-lg pl-4 pr-4 m-2"><i class="fa fa-arrow-left fa-1x mr-2"></i>Retour</a>
	</div>
	<form action="{{ route('reservation.store') }}"  method="POST" enctype="multipart/form-data">
		@csrf
		<div class="row">

			<div class="col-md-5 bg">
				<div class="card-header" style="background: url('{{asset('../storage')}}/{{$data->logo}}');background-size: cover;background-attachment: fixed;background-position: center center; background-repeat: no-repeat; ">
					<img src="/storage/{{$data->logo}}" class="w-50">
					<hr>
					<div class="text-left">	
						<span class="form-check-label">
							<span class="float-right badge badge-light round">{{presentPrice($data->price)}}</span>
							Prix du trajet :
						</span>
					</div>
					<div class="text-left">	
						<span class="form-check-label">
							<span class="float-right badge badge-light round">{{$data->begin}}</span>
							Depart a :
						</span>
					</div>
					<div class="text-left">	
						<span class="form-check-label">
							<span class="float-right badge badge-light round">{{$data->date}}</span>
							Le :
						</span>
					</div>
					<div class="text-left">	
						<span class="form-check-label">
							<span class="float-right badge badge-light round">{{$data->duration}}</span>
							Durée du trajet :
						</span>
					</div>
					<div class="text-left">	
						<span class="form-check-label">
							<span class="float-right badge badge-light round">{{$data->arrival}}</span>
							Arrivée :
						</span>
					</div>
					
					<!-- <ul class="nav navbar-nav">
						<li><div class="text-left b">  {{presentPrice($data->price)}} </div></li>
						<li><div class="text-left b">Places :  {{$data->places}}</div></li>
						<li><div class="text-left b">Départ le :  {{$data->date}}</div></li>
						<li><div class="text-left b">Départ  :  {{$data->begin}}</div></li>
						<li><div class="text-left b">Durée du voyage :  {{$data->duration}}</div></li>
						<li><div class="text-left b">Arrivée à environ :  {{$data->arrival}}</div></li>

					</ul> -->
					<hr>

					<span class="initialism h2">Destination </span><br>
				</div>
				<div class="row m-3">
					<div class="col-5 mt-1" >
						<h6 class=" text-uppercase text-dark">{{$data->from}} </h6>
					</div>

					<div class="col-2"><i class="fa fa-arrow-right text-danger fa-2x mt-0"> </i></div>

					<div class="col-5 mt-1" >
						<h6 class="text-uppercase text-dark" > {{$data->to}}</h6>
					</div>
					
					
					
				</div>

			</div>
			<div class="col-md-7 col-sm-4 text-center ">

				<div class="card  py-3 shadow text-center">
					
					<div class="card-body text-center">
						<div class="text-center ">
							<div class="desc " align="center">
								
								<h3>Remplissez le formulaire de réservation</h3>
								<small class="text-muted">On remplissant ce formulaire vous nous autorisez à utiliser vos informations afin de vous assurer un excellent voyage. Vos informations ne seront ni divulguées ni partager à un tiers</small>
								
								<hr>

								<!-- // should be VISABLE at the start and be HIDDEN when Next button is clicked. -->
								<div class="test1">
									<input type="text" class="form-control text-center shadow mt-3 p-4"  value="{{ Auth::user() ? Auth::user()->nom :old('nom') }}" name="nom" placeholder="Votre nom" required="required">
								</div>

								<div class="test1">
									<input type="text" class="form-control text-center shadow mt-3 p-4"  value="{{ Auth::user()->prenom ?? ''}}" name="prenom" placeholder="Votre prénom" required="required">
								</div>

								<div class="test2">
									<input type="tel" required="required" maxlength="9" name="phone" class="form-control text-center shadow mt-3 p-4" placeholder="Numero de téléphone" >  
								</div>

								<input type="number" name="traject_id" value="{{$data->id}}" required="required" hidden="hidden">

							</div>
							
						</div>
						<!-- paiement mobile -->
						<div class="text-center" align="center">
							
							<div class="col-md-12 mt-4">
								<button type="submit" name="submit_by" value="airtel" class="btn btn-danger  form-control initialism rounded shadow ">
									<strong class="">Valider</strong>
								</button>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		
	</form>

</div>
</div>



@endsection