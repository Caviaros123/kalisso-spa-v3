@extends('layouts.master')

@section('title', 'Aide')

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


<!-- about page -->
<div class="container px-5 py-5">
	<div class=" text-center p-3">
		<img class="w-25" src="kalisso.png">
	</div>
	<p><strong>kalisso</strong> est un site de vente en ligne basée au Congo Brazzaville. Il vous permettra d'effectuer vos achats en ligne et de vous l'est fait livrer chez vous a la maison grace à un système de livraison unique, nos services de ventes en gros et aux détails répondront à vos attentent et nos produits sont ceux que vous retrouverez sur le marché.
<br><br>
Nous aspirons à devenir la référence en matière de commerce digital.
<br>
Notre motivation, vous servir.
<br><br>
Vous trouverez des milliers d'articles prêt à l'achat
<br>

Kalisso vous offrent aussi des services comme:
<br>
	- Les produits de vos boutiques locaux <br>
    - La reservation de billet de bus<br>
    - La reservation de billet d'avion<br>
    - La reservation de billet  d'hotel <br>
    
<br>
Et plusieurs autres services tels que :
<br>
    - La prestation de services divers <br>
    - Locations de materiel inditrielles <br>
    - Locations de vehicules <br>
    - services immobiliers <br>

<br>
<strong>Kalisso</strong> est le e-commerce que vous devez adopter, pour satisfaire vos envies.
<br>

<a href="/contact">Contactez-nous</a> pour plus d'informations.<br> <br>

Kalisso.com&copy;
 </p>

</div>


<div class="my-3" align="center">
	<a href="undefined" style="display:inline-block; width:140px; height:40px;">
		<img class="w-100" src="https://core.sortlist.com//_/apps/core/images/badges-fr/badge-flag-pink-light-xs.svg" alt="flag"/>
	</a>
</div>


@include('layouts.footer')
@endsection

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

</script>


@stop
