
@extends('layouts.master')

@section('title', 'Contact')

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


<div class="container  px-5 py-5">
	<div class="container">
		
		<div class="row">	
			<div class="col-md-6 text-center ">	
				<div class="card card-product ">
					<div class="card-header">
						<h3>BRAZZAVILLE</h3>
					</div>
					<div class="card-body">
						<p>Email: support@kalisso.com <br>    
                            <span ><h4 class="bg-success  text-light round">Tel: +242 05 545 22 77</h4></span><br></p>	
					</div>
				</div>
			</div>
			<div class="col-md-6 text-center  ">	
				<div class="card card-product ">
					<div class="card-header">
						<h3>POINTE-NOIRE</h3>
					</div>
					<div class="card-body">
						<p>Email: support@kalisso.com <br>    
                            <span ><h4 class="bg-success  text-light round">Tel: +242 05 545 22 77</h4></span><br></p>	
					</div>
				</div>
			</div>
		</div>
		<hr>	
		<div class="container mx-auto">	
			<div class="row">
				<div class="col-md-6 text-center">	
					<h5>Besoin d'aide ?</h5>
					<div class="mt-5">	
						<h3>Contactez-nous</h3>	
					</div>
					<hr>	
					<div align="center">	
						<p>	
							Email: support@kalisso.com <br>	
							<span ><h4 class="bg-success w-75 text-light round">Tel: +242 05 545 22 77</h4></span><br>	

						</p>
					</div>
				</div>
				<div class="col-md-6">	
					<h4>Laissez nous un message</h4>
					<div class="card-product card">	
						<form action="" method="post">	
							@csrf
							<div class="m-3 mt-5">
								<label>	Nom <span class="text-danger">*</span></label>	
								<input type="text" @if(auth()->user()) readonly @endif   required="required" class="input form-control" placeholder="Votre nom" value="{{auth()->user()->name ?? ''}}" name="name">
							</div>
							<hr>	
							<div class="m-3">
								<label>	Email <span class="text-danger">*</span></label>	
								<input type="email" @if(auth()->user()) readonly @endif value="{{auth()->user()->email ?? ''}}" class="input form-control" placeholder="Votre email" name="email" required="required">
							</div>
							<hr>	
							<div class="m-3">
								<label>	Sujet <span class="text-danger">*</span></label>	
								<input type="text" class="input form-control" placeholder="Votre sujet" name="subject" required="required">
							</div>
							<div class="m-3">
								<label>	Message <span class="text-danger">*</span></label>	
								<textarea type="text" class="input form-control p-5" placeholder="Votre message ici..." name="name" required="required">
									
								</textarea> 
							</div>
							
							<div class="m-3 mt-5 mb-2 text-right">	
								<button class="btn btn-primary"><i class="fa fa-"></i> Envoyer</button>
							</div>

						</form>
					</div>
				</div>	
			</div>
			<div class="container  p-3 " align="center">
				<div class="row-sm">
					<label class="mt-2 b h2">Prochainement :</label>	
					
					<a href="" class="border-bottom pb-3 m-3 text-muted disable solid border-danger">RD Congo</a>
					<a href="" class="border-bottom pb-3 m-3 text-muted disable solid border-danger">Cameroun</a>
					<a href="" class="border-bottom pb-3 m-3 text-muted disable solid border-danger">Angola</a>
					<a href="" class="border-bottom pb-3 m-3 text-muted disable solid border-danger">Cabinda</a>
					<a href="" class="border-bottom pb-3 m-3 text-muted disable solid border-danger">Cote d'ivoire</a>
					<a href="" class="border-bottom pb-3 m-3 text-muted disable solid border-danger">Sénégal</a>
					<a href="" class="border-bottom pb-3 m-3 text-muted disable solid border-danger">Bénin</a>
					<a href="" class="border-bottom pb-3 m-3 text-muted disable solid border-danger">Mali</a>
				</div>
			</div>
			
		</div>
	</div>
</div>	
@include('layouts.footer')		

@stop

@section('extra-js')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script type="text/javascript">

    (function myOnLoadFunc(){
		$('#exampleModalCenter').modal('show').fadeOut(2000,function() {
				$(this).modal('hide');
			});

	})();



    // function orderPost() {

    //      var postData = {
    //        'phone' => '+242064272080',
    //         'amount' =>  '100',
    //         'pin_code' => '1122',
    //     };

    //     let axiosConfig = {
    //       headers: {
    //             'Accept' => 'application/json; charset=UTF-8',
    //             'apiClientCode' => '1580436250',
    //             'apiClientToken' => '15523Tdy2Jx5S07LM81Qh4',
    //       }
    //     };

    //     axios.post('http://www.digibox.cg/api/momo/digibox/request-payment-autorization-code', postData, axiosConfig)
    //     .then((res) => {

    //         alert('success_message'+res);
    //       console.log("RESPONSE RECEIVED: ", res);
    //     })
    //     .catch((err) => {
    //         alert('error'+err);

    //       console.log("AXIOS ERROR: ", err);
    //     })


    //   }
    // ;


</script>



@stop