@extends('layouts.master')

@section('title', 'Mot de passe')

@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">


<link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>

<link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />

@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
   
    <div class="col-md-8 px-5 py-5 text-center" style="margin-top: 8%">

      <div class="card card-product shadow-lg bg-transparent  text-light border solid boder-light">
        
        <div class="card-header text-muted">
          <span class="zoom-wrap brand">
            <a href="{{ url('/') }}" title="Retour à l'acceuil"><img src="{{asset('kalisso.png')}}" class="zoom-in" style="width:100px; "></a>
          </span><br>
        {{ __('Réinitialiser le mot de passe') }}</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <!-- <label for="email" class=" col-form-label text-md-center">{{ __('Votre Adresse Email') }}</label> -->
            <div class="input-group text-center mb-3">
              

              <div class=" m-auto">
                <input id="email" type="email" class="form-control text-center @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Entrer votre adresse email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group  mb-0">
              
              <button type="submit" class="btn btn-primary pr-4 pl-4">
                {{ __('Envoyer ') }}
              </button>
              
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('extrajs')



<!--===============================================================================================-->
<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="../vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="../vendor/bootstrap/js/popper.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="../vendor/daterangepicker/moment.min.js"></script>
<script src="../vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="../vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="../js/main.js"></script>


@stop
