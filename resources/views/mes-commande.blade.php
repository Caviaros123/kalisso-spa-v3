@extends('layouts.master')

@section('title', 'Mes Commande')
@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>

<link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />

@stop
@include('layouts.navbar')

@section('content')

@if (session()->has('success_message'))
<div class="toast card p-3 my-3 toastrDefaultSuccess shadow-lg shadow" id="toast1" data-delay="3000"  style="position: absolute; top: 3rem; right: 4rem; max-width:40rem; max-height: 200px" aria-live="assertive" aria-atomic="true">
  <div class="toast-header text-success card-header ">
    <small> 
      <strong class="mr-auto h5">Notifications</strong>
    </small>
    <button type="button" class="ml-auto mb-1 close" data-dismiss="toast" aria-label="Fermer">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body bg-light p-3">
    <strong>{{ session()->get('success_message') }}</strong>  
  </div>
</div>
@endif

@if (count($errors) > 0)
<div class="alert alert-danger">
  <ul class="text-center ">
    @foreach($errors->all() as $error)
    <li class="h5"><h5>{{ $error }}</h5></li>
    @endforeach
  </ul>
</div>
@endif
<div class="content-wrapper px-4 py-4" style="min-height: 1416.81px;">
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid icon-lg border round img-circle" src="{{asset('profile-user')}}/{{ Auth()->user()->avatar}}" alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{Auth()->user()->name}}</h3>

              <!--  <p class="text-muted text-center">Software Engineer</p> -->

              <ul class="list-group list-group-unbordered mb-3 text-center">
                <li class="list-group-item text-center">
                  <a  class="float-center active btn text-dark" href="{{route('users.edit')}}" >Mon Profile</a>
                </li>
                <li class="list-group-item">
                 <a href="{{route('orders.index')}}" class="float-center btn text-dark">Mes Commandes</a>
               </li>
               <li class="list-group-item">
                <a  href="#livraison" data-toggle="tab" class="float-center btn text-dark">Livraison</a>
              </li>
            </ul>

            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header pl-3 pt-2">
            <!-- header profile -->
            <h2 class="text-uppercase">ID : {{$order->id}}</h2>

          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
             
              <!-- Transaction et livraison de l'utilisateur  -->
              <!-- section de controle et suivie des commandes de l'utilisateur -->      
              <div class="row ">
                <div class="card">
                  <div class="card-header">{{$order->id}}</div>
                  <div class="card-body">
                    {{ presentPrice($order->billing_total) }}
                    @foreach($products as $product)
                    <div>{{$product->name}}</div>
                    <div class=""><img class="icon-lg padding p-2 border " src="{{asset($product->image)}}" alt="Image Du Produit"></div>
                    @endforeach
                  </div>
                </div>                       
                <hr>
              </div>
              <div class="tab-pane" id="commandes">            		
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>


@stop

@section('extra-js')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">

  
  function myOnloadFunc() {

    $('#exampleModalCenter').modal('show').delay(3000);

    $('#toast1').toast('show').delay(1000).fadeOut(2000);
  }

</script>

@stop
