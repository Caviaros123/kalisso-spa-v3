@extends('layouts.master')

@section('title', 'Verification')

@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>

<link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />

@stop

@section('content')
<div class="container-fluid px-5 py-5">
    <div class="text-center " align="center">
        <div class="col-12 px-3 py-3">
            <img src="/kalisso.png" class="w-50 w-lg-25">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card shadow">
                <div class="card-header text-center b h5">{{ __('Verifier votre adresse E-mail') }}</div>

                <div class="card-body text-center padding-y">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Un nouvel email a ete envoyer a votre adresse email verifiez votre messagerie.') }}
                    </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('Si vous n\'avez pas recu le mail') }}, 
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf

                    <button class="btn btn-outline-danger my-5"  type="submit">{{ __('Renvoyer le mail' ) }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')




@stop