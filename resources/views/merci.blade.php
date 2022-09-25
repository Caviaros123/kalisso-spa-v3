@extends('layouts.master')

@section('title', 'Merci')

@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<link rel="stylesheet" href="../store_assets/plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../store_assets/dist/css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>

<link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />
<!-- // import for zoom image viewer -->
<link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
<link rel="stylesheet" href="{{asset('/assets/style.css')}}">
<style type="text/css">
	.carousel-indicators li {
		width: 10px;
		height: 10px;
		border-radius: 100%;
	}

	.iconix i {
		width: .88888889rem;
		height: .88888889rem;
		line-height: .88888889rem;
		text-align: center;
		border-radius: 50%;
		background-color: hsla(0,0%,100%,.4);
		color: #222;
		font-size: 0;
	}

</style>
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


@if(isset($_GET['status']) ) 

@if($_GET['status'] == 'SUCCESSFUL' || $_GET['status'] == 200 || $_GET['status'] == 'SUCCESS')



<?php

								  //init
$getOrder1 = DB::table('orders')->where('transaction_id', $_GET['Reference'])->first();
$getOrder2 = DB::table('transactions')->where('reference', $_GET['Reference'])->first();
$code = mt_rand(100000, 999999);

		//dd($getOrder1);
$name = strtoupper(auth()->user()->lastname);
$date = str_replace('-', '/', date('d-m-Y H:i:s', strtotime($getOrder1->created_at)));
$price = presentPrice($getOrder1->billing_total);

$message = "FELICITATIONS ".$name."!\nID: ".$_GET['Reference']."\nMontant: ".$price."\nDate: ".$date."\nVotre code de livraison est : $code\nSaisissez-le à la livraison de votre commande.\nAssistance? 055452277\nMerci d'avoir choisi kalisso.com pour vos achats en ligne";
$phone_number =  phoneNumber(auth()->user()->phone);

			//dd($getOrder1->transaction_id);

if ($getOrder1 != null && $getOrder1->transaction_id === $_GET['Reference']) {

				 					# code...
	try {

		\DB::table('orders')->update([
			'paymentStatus' => 'Payer',
			
		]);


		$sms = array(
			'client'=>    'caviaros123',
			'password'=>    'FilsdeDieu1995@',
                          'phone'=>    '242064272080',// The number that will receive the text message
                          'from'=>    'Kalisso.com',// The sender of the SMS
                          'affiliate' => '999',
                          'text' => utf8_decode(urldecode($message)), // The content of the text message
                      );

		$context = stream_context_create(array(
			'http' => array(
				'method' => 'POST',
				'header'  => "Content-type: application/x-www-form-urlencoded",
				'content' => http_build_query($sms),
			)));

		$response = file_get_contents("https://api.wirepick.com/httpsms/send", false, $context);


		\DB::table('messages')->insert([
			'type' => 'sms livraison',
			'status' => 'commande de l\'utilisateur',
			'message' => $message,
			'response' => $response ?? ''
		]);

		


	} catch (Exception $e) {
		echo '<script language="javascript">';
		echo 'alert('.$e.')';
		echo '</script>';
                    // dd($th);
		return back()->withErrors(['Une erreur est survenue lors de l\'envoi des messages a tous les membres de kalisso.com'.$e]);

	}
	?>
				<!-- <style type="text/css">
					#app{
						background-color: lightgreen
					}
				</style> -->
				<div class="container py-5 ">
					<div class="text-center ">
						<div class="card p-2 shadow-lg bg-light">
							<div class="mt-3">
								<i class="fa fa-truck fa-3x text-success"></i>
							</div>
							<div class="card-body">
								<h2 class="text-uppercase text-success mb-3">félicitations !</h2>
								<div class="p-2 ">
									<p class="b">ID de la transaction:</p> <h3 class="text-danger b ">{{$_GET['Reference']}}</h3>
									<br><br>
									Merci d'avoir choisi kalisso.com
									
									<br>
									Nous avons envoyé un SMS et un E-mail avec votre code de livraison
								</div>
								<p class="text-center">{!! $session = session()->get('success') ?? '' !!}</p>
								
								<div class="mt-3">
									<a class="btn btn-primary p-3" href="/category">Retour au shopping</a>
								</div>
								
								
							</div>
						</div>
					</div>
				</div>
				<?php

			}elseif($getOrder2 != null && $getOrder2->reference == $_GET['Reference']){

				try {

					\DB::table('transactions')->update([
						'status' => 'Payer',
						
					]);

					\DB::table('users')->where('id', $getOrder2->user)->update([
						'role_id' => 3,
					]);

				} catch (Exception $e) {
					echo '<script language="javascript">';
					echo 'alert('.$e.')';
					echo '</script>';
					
				}

				?>
				<div class="container py-5 ">
					<div class="text-center ">
						<div class="card p-2 shadow-lg bg-light">
							<div class="mt-3">
								<i class="fa fa-smile fa-3x text-success"></i>
							</div>
							<div class="card-body">
								<h2 class="text-uppercase text-success mb-3">félicitations !</h2>
								
								<style type="text/css">
									#app{
										background-color: lightgreen
									}
								</style>
								<div class="p-2 ">
									<p class="b">ID de la transaction:</p> <h3 class="text-danger b ">{{$_GET['Reference']}}</h3>
									<br><br>
									Merci d'avoir choisi kalisso.com
									
									<br>
									Nous avons envoyé un SMS et un E-mail avec votre code de livraison
								</div>
								
								
								<p class="text-center">{!! $session = session()->get('success_message') ?? '' !!}</p>
								
								<div class="mt-3">
									<a class="btn btn-primary p-3" href="/">Retour à l'acceuil</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<?php
			}else{

				?>

				<div class="container py-3">
					<div class="text-center ">
						<div class="card  bg shadow-lg ">
							<div class="text-danger pt-2">
								<!-- <i class="fa fa-trash fa-2x "></i> -->
								<img src="https://cdn2.iconfinder.com/data/icons/payment-53/100/credit-card-failed-2-payment-failed-denied-card-mobile-reader-rejected-invalid-x-512.png" class=" img w-25 round m-3 ">
							</div>
							<div class="card-body">
								<h2 class="text-uppercase text-danger mb-5">Transaction introuvable!</h2>
								
								<span class="alert alert-danger my-3">
									Veuillez vérifier votre requête
								</span>
								<div class="p-2 ">
									<p class="b">ID de la transaction:</p> <h3 class="text-danger b ">{{$_GET['Reference']}}</h3>
									<br><br>
									Merci d'avoir choisis kalisso.com
									
									<br>
									Votre paiement à échouer, nous vous prions de réessayer SVP !
								</div>
								
								<div class="mt-3">
									<a class="btn btn-primary p-3" href="/">Retour à l'acceuil</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<?php
			}
			
			
			?>

			@else
		<!-- <style type="text/css">
			#app{
				background-color: red
			}
		</style> -->
		<div class="container py-3">
			<div class="text-center ">
				<div class="card  bg shadow-lg ">
					<div class="text-danger pt-2">
						<!-- <i class="fa fa-trash fa-2x "></i> -->
						<img src="https://cdn2.iconfinder.com/data/icons/payment-53/100/credit-card-failed-2-payment-failed-denied-card-mobile-reader-rejected-invalid-x-512.png" class=" img w-25 round m-3 ">
					</div>
					<div class="card-body">
						<h2 class="text-uppercase text-danger mb-5">Echec de paiement  !</h2>
						
						<span class="alert alert-danger my-3">
							Veuillez vérifier votre solde
						</span>
						<div class="p-2 ">
							<p class="b">ID de la transaction:</p> <h3 class="text-danger b ">{{$_GET['Reference']}}</h3>
							<br><br>
							Merci d'avoir choisis kalisso.com
							
							<br>
							Votre paiement à échouer, nous vous prions de réitérer votre achat en replissant nos conditions de paiement SVP !
						</div>
						
						<div class="mx-5 my-5">
							<a class="btn btn-outline-secondary shadow-lg p-3" href="/cart">Retour au panier</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif



		@endif



		@include('layouts.footer')
		@stop

		@section('js')
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script  src="https://jacoblett.github.io/bootstrap4-latest/bootstrap-4-latest.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


	@stop
