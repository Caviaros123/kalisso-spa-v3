@extends('layouts.master')

@section('title', 'Reservation')

@include('layouts.navbar')
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



<section class="section-content py-2">

  <div class="container ">

    <!-- <a href="{{route('home')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left mr-2"></i>Retour
    </a> -->

    @if(!count($search) == 0)
      <div class="padding-y-sm text-dark">
       
        <span class="h5 text-dark "> {{count($search)}} </span> Résultat(s) trouver de "<strong class="text-danger">{{ $request->from }}</strong>" à "<strong class="text-danger">{{ $request->to }}</strong>"  
        
      </div>
    
    
    

    <div class="row">

      <aside class="col-4">
       <div class="card card-filtertext-center mb-3">
        <article class="card-group-item ">
          <div class="card-header text-center h3 text-muted card-product initialism">Trier Par</div>
          <header class="card-header">
            <a class="collapsed" aria-expanded="true" href="#" data-toggle="collapse" data-target="#collapse22">
              <i class="icon-action fa fa-chevron-down"></i>
              <h6 class="title">Jour De Départ</h6>
            </a>
          </header>
          <div style="" class="filter-content collapse show" id="collapse22">
            <div class="card-body">
              <form class="pb-3" action="{{route('reservation.show', 1)}}">
                @csrf
                <div class="input-group">
                  <input class="form-control card-product" placeholder="Recherche"  type="date">
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </form>

              
            </div> <!-- card-body.// -->
          </div> <!-- collapse .// -->
        </article> <!-- card-group-item.// -->
        <article class="card-group-item">
          <header class="card-header">
            <a href="#" data-toggle="collapse" data-target="#collapse33" aria-expanded="false" class="collapsed">
              <i class="icon-action fa fa-chevron-down"></i>
              <h6 class="title">Par Prix </h6>
            </a>
          </header>
          <div class="filter-content collapse" id="collapse33" style="">
            <div class="card-body">
              <input type="range" class="custom-range" min="0" max="100" name="">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Min</label>
                  <input class="form-control" placeholder="0 Fcfa" type="number">
                </div>
                <div class="form-group text-right col-md-6">
                  <label>Max</label>
                  <input class="form-control" max="18 000 Fcfa" placeholder="100 000 Fcfa" type="number">
                </div>
              </div> <!-- form-row.// -->
              <button class="btn btn-block btn-outline-primary">Appliquer</button>
            </div> <!-- card-body.// -->
          </div> <!-- collapse .// -->
        </article> <!-- card-group-item.// -->
        <article class="card-group-item">
          <header class="card-header">
            <a href="#" data-toggle="collapse" data-target="#collapse44" aria-expanded="false" class="collapsed">
              <i class="icon-action fa fa-chevron-down"></i>
              <h6 class="title">Par Agence de voyage </h6>
            </a>
          </header>
          <div class="filter-content collapse" id="collapse44" style="">
            <div class="card-body">
              <form>
                <label class="form-check">
                  <input class="form-check-input" value="" type="checkbox">
                  <span class="form-check-label">
                    <span class="float-right badge badge-light round">5</span>
                    STELIMAC 
                  </span>
                </label>  <!-- form-check.// -->
                <label class="form-check">
                  <input class="form-check-input" value="" type="checkbox">
                  <span class="form-check-label">
                    <span class="float-right badge badge-light round">13</span>
                    TRANS BONY
                  </span>
                </label> <!-- form-check.// -->
                <label class="form-check">
                  <input class="form-check-input" value="" type="checkbox">
                  <span class="form-check-label">
                    <span class="float-right badge badge-light round">12</span>
                    TRANS ROUTE 
                  </span>
                </label>  <!-- form-check.// -->
                <label class="form-check">
                  <input class="form-check-input" value="" type="checkbox">
                  <span class="form-check-label">
                    <span class="float-right badge badge-light round">32</span>
                    OCEAN DU NORD
                  </span>
                </label>  <!-- form-check.// -->
              </form>
            </div> <!-- card-body.// -->
          </div> <!-- collapse .// -->
        </article> <!-- card-group-item.// -->
      </div> <!-- card.// -->
    </aside> <!-- col.// -->

    <main class="col-8">
      
          @foreach($search as $data)
           <div class="card-product card">
          
              <form  action="{{route('reservation.show', $data->id)}}" method="GET">
                @csrf
                <div class="card-body ">
                  <div class="row">
                      <div class="col-6 text-uppercase"><h3>{{$data->agency}}</h3></div>
                      <div class="col-6" align="right">
                          <h5><span class=" badge-warning badge-sm badge h5 p-3 b">Economisez 12%</span></h5>
                      </div>
                  </div>
              
                  <div class="row">
                    <div class="col-sm-4  border-right solid border-muted" style="background: url('../img/ste.jpg') no-repeat  ;background-size: cover;background-position: center;">
                        <!-- <img src="../img/ste.jpg" class="w-50 "> -->
                    </div>
                    <div class="col-sm-8">
                        <div class="row mb-3">
                            <div class="col-6" align="left">
                                <span class="b  text-muted  text-uppercase">Départ</span>
                                 <div  align="left">
                                      <span class="b h5 text-danger  text-uppercase">{{$data->from}}</span>
                                </div>
                                <p><i class="fa fa-clock text-danger"></i> Heure de départ : <span class="b text-danger h5">{{strftime(' %Hh %Mmin', strtotime($data->begin))}}</span></p>
                            </div>
             
                            <div class="col-6 mt-1" align="right">
                                <span class="b text-muted  text-uppercase">Arrivée</span>
                                <div  align="right">
                                    <span class="b h5 text-danger text-uppercase">{{$data->to}}</span>
                                </div>
                                <p><i class="fa fa-clock text-danger"></i> Arrivée: <span class="b text-danger h5">{{strftime(' %Hh %Mmin', strtotime($data->arrival))}}</span></p>
                            </div>
                        </div>
                       
                        
                                       <p class="text-dark b"><span class="text-danger b">A votre attention :</span> Les formalités commencent à partir de 05h 20 min</p>
                        <div class="b" align="left">
                            <p><i class="fa fa-calendar mr-3 text-danger"></i> <span class="b h5 text-danger">Le {{ str_replace('-', ' ', strftime('%A %d %B %Y', strtotime($data->date))) }}</span></p>
                        </div>
                    </div>
                  </div>
                    <hr>    
                  <div class="row">
                        <div class="col-md-6 text-muted">
                             <p>Prix TTC, par personne</p>
                        </div>
                        <div class="col-md-6 row m-auto" >
                          <h2 class=" col-6"> <span class="badge badge-warning text-danger mr-3">{{presentPrice($data->price)}}</span> </h2>
                          <button type="submit" type="submit" class="btn bg-success text-light col-6 btn-lg text-uppercase b ">J'en Profite</button>
                        </div>
                  </div>
                </div>
                

              </form>
          </div>


          @endforeach


    </main> <!-- col.// -->


  </div>
  @else
    <div class="text-center">
        
      <div class="m-4 pb-5  alert alert-danger text-dark h4"><i class="fas fa-bus text-danger fa-1x">  </i> Aucun résultat  !!</div>
        <div class="p-0 m-0 padding-y shadow-lg">
            @include('partials.billet')
        </div>
    </div>

    @endif
</div> <!-- container .//  -->
</section>


@include('layouts.footer')

@endSection

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

  </script>



@stop

