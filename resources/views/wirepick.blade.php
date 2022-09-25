@extends('layouts.master')

@section('title', 'Vérification')

@section('extra-css')

<!-- custom style -->
<link href="{{asset('/css/mobile.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<!-- custom javascript -->
<script src="{{asset('/js/script.js')}}" type="text/javascript"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

@stop

@section('content')

<div  class="screen-wrap">
	<header class="app-header bg-danger">
		<a href="javascript:history.go(-1)" class="btn-header"><i class="fa fa-arrow-left"></i></a>
		<div class="title-header"> {{ __('Vérification du numero de téléphone') }} </div>
		<div class="header-right">   </div>
	</header> <!-- section-header.// -->
	<main class="app-content">

		<section class="padding-around">

			<div class="text-center">
				<span class="icon bg-white icon-lg rounded-circle rotate"><i class="fa text-warning fa-sms"></i></span>
			</div>
			<p class="text-center" id="msgSent">
				{{ __('Nous avons envoyer un code de verification par SMS à votre numéro de téléphone') }} <br>
				<strong>+{{auth()->user()->phone}}</strong> <a class="btn-link" href="">Modifier</a> 
			</p>
			<div class="alert alert-success text-center mb-2 px-5" align="center" id="sentSuccess" style="display: none;"></div>
			<div class="alert alert-success text-center mb-2 px-5" align="center" id="successRegsiter" style="display: none;"></div>
			<div id="sendCodeId" class="card-body text-center">
				<form class="p-2 m-2">
					<label>Numéro de téléphone:</label>
					<input type="text" id="number" class="form-control text-center" value="+{{auth()->user()->phone}}" placeholder="Saisissez votre numéro de téléphone avec indicatif ex: +242055452277">
					<div align="center" class=" p-2" id="recaptcha-container"></div>
					<button type="button" class="btn btn-success" onclick="phoneSendAuth();">Envover le code</button>
				</form>
			</div>
			

			<div id="receiveOtp">	
					
					<form class="px-5 mb-5">
						<input type="text" id="verificationCode" required autofocus class="form-control text-center mb-3 " maxlength="6" minlength="6"  placeholder="* * * * * *">
						<button type="button" onclick="codeverify();" class="btn btn-block btn-danger">Vérifier</button>
					</form>
					<p class="text-center"> <a href="#" onclick="phoneSendAuth();" class="btn-link text-danger"> <i class="fa fa-redo"></i> Renvoyer le code</a>
					</p>
			</div>

		</section>

	</main>
	<form hidden action="{{route('otp.verify')}}" method="post" id="otpSuccess">	
		@csrf
			<input type="text" name="otpSuccess" value="ok">
			<button type="submit"></button>
	</form>

</div> 

@endsection
@section('js')
<script type="text/javascript">
	window.onload=function () {
		render();
	};

	function render() {
		window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
		recaptchaVerifier.render();
		$("#receiveOtp").hide();
		$("#msgSent").hide();

	}

	function phoneSendAuth() {

		var number = $("#number").val();

		firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {

			window.confirmationResult=confirmationResult;
			coderesult=confirmationResult;
			console.log(coderesult);
			$("#sendCodeId").hide();
			$("#receiveOtp").show();
			$("#msgSent").show();
			$("#sentSuccess").text("Message envoyé avec succès.");
			$("#sentSuccess").show();

		}).catch(function (error) {
			$("#error").text(error.message);
			$("#error").show();
		});

	}

	function codeverify() {

		var code = $("#verificationCode").val();

		coderesult.confirm(code).then(function (result) {
			var user = result.user;
			$("#sentSuccess").hide();
			$("#msgSent").hide();
			$('#otpSuccess').submit();
			$("#successRegsiter").text("Vous êtes inscrit à Kalisso avec succès.");
			$("#successRegsiter").show();

		}).catch(function (error) {
			$("#error").text(error.message);
			$("#error").show();
		});
	}
</script>



@stop
