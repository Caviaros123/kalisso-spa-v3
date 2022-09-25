@extends('layouts.master')

@section('title', 'Acceuil')


@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<?php   setlocale(LC_TIME, 'fr_FR.utf8','fra'); ?>
<link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>

<link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />

@stop


@section('main')
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



<div class="container rounded m-auto padding-y bg-dark" >


      

<div class="row justify-content-center m-auto">
  <div class="col-12  text-center" align="center">
   <div class="content padding-y " style="margin: auto">
    <img src="kalisso.png" class=" " style="width: 250px"> 
    <h2 class="text-light display-5"><span>Réservez n'a jamais été aussi simple</span></h2>
  </div>
  <form method="post" class="container" action="{{ route('reservation.search') }}">
    @csrf
    <div class="row ">
      
      <div class="col-md-4 ">
        <div class="mb-2 input-group">
          <div class="input-group-prepend">
            <span class="input-group-text rounded text-light bg-danger">
              <i class="fa fa-bus"></i>
            </span>
          </div>
          <select class="form-control-lg  custom-select rounded shadow" required="required" name="from">
            <option hidden >Depart  :</option>
            <option value="brazzaville">Brazzaville</option>
            <option value="pointe-noire">Pointe-Noire</option>
            <option value="dolisie">Dolisie</option>
            <option value="sibiti">Sibiti</option>
          </select>
          @error('empty')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

      </div>
      <div class="col-md-4">
        <div class="mb-2 input-group">
          <div class="input-group-prepend">
            <span class="input-group-text rounded text-light  bg-success"><i class="fas fa-map-marker-alt"></i></span>
          </div>
          <select class="form-control-lg  custom-select rounded shadow" name="to" required="required">
            <option value="" hidden >Arrivée :</option>
            <option value="brazzaville">Brazzaville</option>
            <option value="pointe-noire">Pointe-Noire</option>
            <option value="dolisie">Dolisie</option>
            <option value="sibiti">Sibiti</option>
          </select>
        </div>
        
      </div>
      <div class="col-md-4 mb-4">
        <button type="submit"  class="btn btn-success btn-lg rounded shadow  text-light form-control pr-5 pl-5"><i class="fa fa-search text-light "></i>  Rechercher</button>
      </div>
    </div>
  </form>
  <div class="col-md-12 text-light" align="center">  

    <!-- Widget: user widget style 1 -->
    <div class="widget">
      <div class="container d-none d-sm-block">
        
        <div class="d-flex ">
          <div class="col-sm-2 btn text-center ml-auto">
            <img src="../icon/icons8_airport_100px.png" class="thumbnail img-xs"><br>
            <div class="text-uppercase text-center text-light">Avion</div> 
          </div>
          <div class="col-sm-2 btn text-center ml-auto ">
            <img src="../icon/icons8_bus_100px_1.png" class="thumbnail img-xs"><br>
            <span class="text-uppercase text-center text-light">bus</span> 
          </div>
          <div class="col-sm-2 btn text-center ml-auto">
            <img src="../icon/icons8_bed_100px.png" class="thumbnail img-xs"><br>
            <span class="text-uppercase text-center text-light">hotel</span> 
          </div>
          <div class="col-sm-2 btn text-center ml-auto">
            <img src="../icon/icons8_car_100px.png" class="thumbnail img-xs"><br>
            <span class="text-uppercase text-center text-light">location</span> 
          </div>
          <div class="col-sm-2 btn text-center ml-auto">
            <img src="../icon/icons8_food_100px.png" class="thumbnail img-xs"><br>
            <span class="text-uppercase text-center text-light">restaurant</span> 
          </div>
          <div class="col-sm-2 btn text-center ml-auto">
            <img src="../icon/icons8_hospital_100px.png" class="thumbnail img-xs"><br>
            <span class="text-uppercase text-center text-light">pharmacies</span> 
          </div>

        </div>
      </div> 
      <div class="widget-user-header pb-4 pt-5 bg-info-active">
        <h4 class="">
          <strong class="shadow">Réservez un billet de bus n'a jamais été aussi simple </strong>
        </h4> 
        <h6>Payer par DigiBox Congo incluant MTN Mobile Money et par Airtel Money</h6> 
      </div>
      <div class="widget-user-image mt-2">
        <img class="  bg " src="{{asset('../digibox.png')}}" alt="User Avatar" style="width: 90px"> 
      </div>
      
    </div>
    <!-- /.widget-user -->
  </div>
</div>
</div>

</div>

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
