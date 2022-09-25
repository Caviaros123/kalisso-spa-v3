@extends('layouts.master')

@section('title', 'Connexion')

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

@section('content')
<div class="container-fluid " align="center" >
 <div class=" col-md-12 col-lg-4 p-lg-2  p-md-4">
   <div class=" p-lg-3  ">
    <div class="zoom-wrap mb-1 mt-3">
      <a href="{{ url('/') }}" title="Retour à l'acceuil">
        <img src="kalisso.png" class="zoom-in w-50" >
      </a>
    </div>
    <div class="pt-3 pb-2 small text-muted b">
      <h5 >{{ __('Bienvenue sur ') }}<a class="text-danger" href="/">KALISSO.COM</a></h5>
      <small class="text-muted  h6 p-2">Identifiez-vous pour une meilleure expérience</small>
    </div>
    
    <!-- ================== IF LOGGIN WITH SOCIAL ========================== -->
          {{-- <div class="row">
             <div class="col-md-6 ">
                 <a href="{{ url('auth/google') }}" style="margin-top: 20px;" class="btn btn-lg btn-google btn-block">
                  <strong>Login With Google</strong>
                </a> 
             </div>
             <div class="col-md-6">
                <a type="submit" href="{{ url('auth/facebook') }}" target="_blank" class="btn btn-facebook btn-block btn-lg"><i class="fab fa-facebook text-light"> Avec Facebook</i></a>
             </div>
            </div> --}}


            <!-- LOGIN FORM -->
            <form method="POST" action="{{ route('login') }}" >

              @csrf
              <div class="form-group">
               
                <input id="email" type="text" class="form-control input100 p-4 rounded shadow @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="Email ou Numéro de téléphone " autofocus>
                <div align="left" class="invalid mt-2 text-muted" role="alert">
                  Exemple: 242055452277
                </div>
                @error('email')
                <span class="invalid-feedback text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="input-group mb-3 m-0 p-0" id="show_hide_password">
                <input id="password" type="password" title="Votre mot de passe" class="form-control bg mb-1 p-4 input100 p-2 rounded shadow @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Mot de passe" placeholder="Mot de passe">
                <div class="input-group-addon">
                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                </div>
                @error('password')
                <span class="invalid-feedback text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="row mb-2">
                @if (Route::has('password.request'))
                  <a class=" nav-link  " href="{{ route('password.request') }}">
                    {{ __('Mot de passe oublié ?') }}
                  </a>
                @endif
              
              <div class="container m-2 text-center">
                <div class="icheck-primary d-flex">
                  <div class="col-md-4 text-right">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  </div>
                  <div class="col-12 text-left">
                   <label class="form-check-label text-muted" for="remember">
                    {{ __('Se souvenir de moi') }}
                  </label>
                </div>
              </div>
            </div>
          </div>
          
          <div class="zoom-wrap">
            <div class="form-group ">
              <button type="submit" class="btn btn-success shadow rounded b zoom-in w-100 p-2">
                {{ __('Connexion') }}
              </button>
            </div>
          </div>
          
        </form>
        <!-- END LOGIN FORM -->

        <small class="text-danger b h6 pb-2">Si vous n'avez pas encore de compte kalisso</small>

        <div class="zoom-wrap">
          <a class=" btn btn-warning shadow rounded b zoom-in w-100 p-2 " href="{{url('register')}}">
           Créer un compte 
         </a>
       </div>
     </div>
   </div>
   <div class="col-md-8  my-5">
    <div class="row">
      <div class="col-4 m-0 p-1"><a class="text-muted" href="/">&copy; Kalisso Inc</a></div>
      <div class="col-4 m-0 p-1"><a class="text-muted" href="/contact">Contactez-nous</a></div>
      <div class="col-4 m-0 p-1"><a class="text-muted" href="/reglement"> Conditions</a></div>
      
    </div>
    <div class="pt-5"> </div>
  </div>

</div>

@endsection

@section('js')
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script  src="https://jacoblett.github.io/bootstrap4-latest/bootstrap-4-latest.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

      <script type="text/javascript" >

        
        function myOnloadFunc() {

            $('#exampleModalCenter').fadeOut(2000,function() {
              $(this).modal('hide');
            });

            $('#exampleModalCenter').modal('show').delay(3000);

            $('#toast1').toast('show').delay(3000).fadeOut(4000);
        }


         // script for annimation 

         $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-eye" );
                }
            });
        });
         
       </script>
@stop
