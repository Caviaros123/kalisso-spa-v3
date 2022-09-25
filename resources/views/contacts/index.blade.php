@extends('layouts.master')

@section('title', 'Notification')

@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<link rel="stylesheet" href="../store_assets/plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../store_assets/dist/css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


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





<div class="container-fluid px-5 py-5">
    <div class="text-center " align="center">
        <div class="col-12 px-3 py-3">
            <img src="/kalisso.png" class="w-25 w-lg-25">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card shadow">
                <div class="card-header display-4 text-center">{{ __('Message de notification') }}</div>
       
                <div class="card-body px-5 text-center padding-y">
                    @if($errors->count() == 1)
                               
                        <p class="alert shadow  alert-danger text-truncate"> {{ $errors }}</p>
                    
                    @endif
                     @if(session()->has('success_message'))

                        <p class="alert shadow  alert-success text-truncate"> {{ session()->get('success_message') }}</p>

                     @endif
                    <form method="POST" action="notifications">
                        @csrf
                        <div class="row">
                            <div class="checkbox row col-md-12">
                                <div class="col-3">
                                    <label for="all">All users</label>
                                    <input type="checkbox" name="all" id="all" >
                                </div>
                                <div class="col-3">
                                    <label for="all">Seller</label>
                                    <input type="checkbox" name="seller" id="all" >
                                </div>
                                <div class="col-3">
                                    <label for="all">Want selling</label>
                                    <input type="checkbox" name="isSeller" id="all" >
                                </div>
                                <div class="col-3">
                                    <label for="all">Deliver</label>
                                    <input type="checkbox" name="deliver" id="all" >
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                <label for="to">Envoyer à : </label>
                                <input id="to" type="tel"  name="phone" placeholder="Téléphone" class="form-control shadow mb-4">
                            </div>
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label> Message </label>
                                    <textarea class="form-control shadow     textarea @error('message') is-invalid @enderror" required placeholder="Votre message" name="message"></textarea>
                                    @error('message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                        
                            <div class="update ml-auto mx-5 my-5  mr-auto">
                                <button type="submit" name="submit" class="btn-lg btn-outline-success px-5 btn-round">Envoyer</button>
                            </div>
                        </div>

                        </form>
                        <div class="text-muted ">
                            <p class="h3 display-4">Diffusion sms</p>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')


<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" integrity="sha512-VZ6m0F78+yo3sbu48gElK4irv2dzPoep8oo9LEjxviigcnnnNvnTOJRSrIhuFk68FMLOpiNz+T77nNY89rnWDg==" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script type="text/javascript">

		// alert('HELLOO');

		(function(){
			
			const classname = document.querySelectorAll('.quantity')

			Array.from(classname).forEach( function(element) {
				element.addEventListener('change', function() {
					const id = element.getAttribute('data-id')
					const productStock = element.getAttribute('data-productStock')

					axios.patch(`/cart/${id}`, {
						quantity: this.value,
						productStock: productStock
					})
					.then(function (response) {
						
						window.location.href='{{ route('cart.index') }}';
					})
					.catch(function (error) {
						
						window.location.href='{{ route('cart.index') }}';
					});
				})
			})
		})();



		(function myOnLoadFunc(){

			$('#exampleModalCenter').modal('show').fadeOut(2000,function() {
				$(this).modal('hide');
			});

		})();

    </script>



    @stop