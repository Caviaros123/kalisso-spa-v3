@extends('layouts.master')

@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">


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

<form action="{{route('reservation.update')}}" method="post">	
 method('PATCH')
 @csrf
 <div class="form-group row">
  <label for="recipient-name" class="ml-3 col-form-label" >Date:</label>
  <input type="date" name="date" class="date form-control mb-3 mt-3">
</div>
<div class="form-group row">
  <label for="recipient-name" class="col-form-label" >Heure de Depart:</label>
  <input  class="btn aqua-gradient" type="time" name="begin" value="{{ $data->begin }}" autocomplete="{{ $data->begin }}" required="required">
</div>

<hr>
<div class="text-center">
  <h4>Destination</h4>
</div>

<div class="form-group row">
  <label for="recipient-name" class=" ml-3 col-form-label">De:</label>
  <select class="btn aqua-gradient  ml-4 pr-4" name="from" required="required">
    
    <option value="" hidden >Depart de :</option>
    <option value="{{ $data->from }}" selected="{{ $data->from }}" hidden="">{{ $data->from }}</option>
    <option value="Brazzaville" >Brazzaville</option>
    <option value="Pointe-Noire" >Pointe-Noire</option>
    <option value="Dolisie" >Dolisie</option>
    <option value="Sibiti" >Sibiti</option>
    
  </select>
  <label for="recipient-name" class="ml-4 col-form-label" >A:</label>
  <select class="btn aqua-gradient " name="to" required="required">
    <option value="" hidden >Arrivee a :</option>
    <option value="{{ $data->to }}" selected="{{ $data->to }}" hidden="">{{ $data->to }}</option>
    <option value="Brazzaville" >Brazzaville</option>
    <option value="Pointe-Noire" >Pointe-Noire</option>
    <option value="Dolisie" >Dolisie</option>
    <option value="Sibiti" >Sibiti</option>
  </select>
</div>
<div class="form-group row ">
  <label for="recipient-name" class="ml-3 col-form-label">Duree:</label>
  <input  class="btn aqua-gradient pr-4" type="time" value="{{ $data->duration }}" autocomplete="{{ $data->duration }}" name="duration" required="required">
  <label for="recipient-name" class="col-form-label" >Heure d'Arrivee:</label>
  <input  class="btn aqua-gradient pr-4" type="time" value="{{ $data->arrival }}" autocomplete="{{ $data->arrival }}" name="arrival"  required="required">
</div>
<div class="form-group">
  <label for="message-text" class="col-form-label">Prix:</label>
  <input type="number" step="5000" name="price" class="form-control" id="message-text" value="{{ $data->price }}" autocomplete="{{ $data->price }}" placeholder="Prix du voyage en Fcfa" required="required" >
  
</div>
<div class="form-group">
  <label for="reduction-text" class="col-form-label">Reduction: <span class="text-muted">(Facultatif)</span></label>
  <input type="number" step="1" class="form-control"  id="reduction-text" value="{{ $data->reduction }}" autocomplete="{{ $data->reduction }}" name="reduction" placeholder="Ex : 10 %" required="required">
</div>


</div>

<div>	
  <button type="submit" class="btn btn-success">Mettre a jour</button>
</div>

</form>

@endSection