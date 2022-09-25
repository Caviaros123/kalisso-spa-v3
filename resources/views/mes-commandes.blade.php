@extends('layouts.master')

@section('title', 'Mes Commandes')

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



<div class="content-wrapper px-4 py-4">
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <h5 class="doc-title-md mb-4"> <a href="/mon-compte"><i class="fa fa-arrow-left mr-2"></i>Mon Compte </a></h5>
      <!-- =========================  COMPONENT MYORDER 1 ========================= --> 
      <div class="row">
        <aside class="col-md-3 card-product">
          <!--   SIDEBAR   -->
          <ul class="nav bg radius nav-pills nav-fill mb-3" role="tablist">
            <li class="nav-item "><a data-toggle="pill" href="#order" class="p-3 nav-link list-group-item active" href="#" target="#orders"> Mon historique de Commande <span class="badge badge-warning ml-4 round">{{$orders->collect()->count()}}</span></a> </li>
            <li class="nav-item "><a class="p-3 nav-link list-group-item" href="#"> Mes Transactions </a></li>
            <li class="nav-item "><a class="p-3 nav-link list-group-item" href="#"> Retour & Remboursement </a></li>
            <li class="nav-item "><a class="p-3 nav-link list-group-item" href="#">Paramètres </a></li>
            <li class="nav-item "><a class="p-3 nav-link list-group-item" href="#"> Mes produits Vendu </a></li>
            <li class="nav-item "><a class="p-3 nav-link list-group-item" href="#"> Commande Recu </a></li>
          </ul>
          <br>
          <div class="zoom-wrap">
            <a class="text-light form-control text-center shadow zoom-in btn btn-danger" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            Deconnexion <span class="fa fa-power-off"></span>
          </a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>

        <!--   SIDEBAR .//END   -->
      </aside>

      

      <div class="tab-content">
        <main class="col-md-9" class="tab-pane fade" id="order">
          @forelse($orders as $order)
          <article class="card card-product shadow-lg mb-4">
            <header class="card-header ">
              <div class="row">
               <div class="col-md-4">
                 <strong class="">REFERENCE DE LA COMMANDE: {{$order->id}}</strong>
               </div>
               <div class="col-md-8 text-right">
                <strong class="">Emise Le: <span class="text-danger">{{ date('d-m-Y', strtotime($order->created_at)) }}</span></strong>
              </div>
            </div>
          </header>
          <div class="card-body">
            <div class="row"> 
              <div class="col-md-7">
                <h6 class="text-muted">Livraison à : <span class="text-uppercase h5">{{$order->billing_name}}</span></h6>
                <p> 
                 Téléphone: {{$order->billing_phone}} <br>
                 Email:     {{auth()->user()->email}} <br>
                 Adresse:   {{$order->billing_province}},
                 {{$order->billing_city}},
                 {{$order->billing_adress}} <br> 
                 

               </p>

             </div>
             <div class="col-md-1 vl"></div>
             <div class="col-md-4 ">

              <h4 class="text-info">Paiement</h4>
              Payé Par: <strong class="text-info">{{$order->payment_gateway}}</strong>
            <!-- <span class="text-success">
              <i class="fab fa-lg fa-cc-visa"></i>
                Visa  **** 4216  
              </span> -->
              
              <p>Prix: {{ presentPrice($order->billing_subtotal) }} Fcfa<br>
               Frais de Livraison:  {{$order->shipped}} Fcfa<br> 
               <span class="b h5 text-danger">Total:  {{ presentPrice($order->billing_total) }} Fcfa</span>
             </p>
             
           </div>
         </div> <!-- row.// -->
       </div> <!-- card-body .// -->
       <div class="table-responsive">
        <table class="table table-hover">
          <tbody>
           
           @foreach($order->products as $product)
           <tr>
            <td width="65">
              <img src="{{asset('storage/'.$product->image)}}" alt="Image Du Produit" class="img-sm p-2 border">
            </td>
            <td> 
              <p class="title mb-0"><strong>{{$product->name}}</strong></p>
              <var class="price text-muted "> {{ presentPrice($order->billing_total) }} Fcfa</var>
            </td>
            <td> <strong>Vendeur</strong> <br> {{$product->email}} </td>
            <td width="250" class="mt-4"> 
              <!-- <a href="#" class="btn btn-outline-primary mr-2">Suivre</a> -->
              <a href="{{route('orders.show', $order->id)}}" class="btn btn-outline-info"> Détails </a> 
            </td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
    </div> <!-- table-responsive .end// -->
  </article> <!-- order-group.// --> 
  <hr class="m-4">
  @empty
  <div class="alert alert-danger">Vous n'avez aucune commande en cours </div>
  @endforelse
</main>
</div>

<!-- =========================  COMPONENT MYORDER 2 ========================= --> 
{{-- <div class="row">

  <div class="col-md-9" id="transaction">
    <article class="card order-group">
      <header class="card-header">
        <b class="d-inline-block mr-3">Transaction ID: 6123456789</b>
        <span>Date: 16 December 2018</span>
      </header>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <h6 class="text-muted">Payment</h6>
            <span class="text-success">
              <i class="fab fa-lg fa-cc-visa"></i>
              Visa  **** 4216  
            </span>

            <p>Subtotal: $356 <br>
             Shipping fee:  $56 <br> 
             <span class="b">Total:  $456 </span>
           </p>
           
         </div>
         <div class="col-md-4">
          <h6 class="text-muted">Contact</h6>
          <p>Michael Jackson <br> +1234567890 <br> somename@gmail.com</p>
        </div>
        <div class="col-md-4">
          <h6 class="text-muted">Shipping address</h6>
          <p> Home 123, Building name, Street abcd,  Tashkent Uzbekistan  </p>
        </div>
      </div> <!-- row.// -->
      <hr>
      <ul class="row">
        <li class="col-md-4">
          <figure class="itemside  mb-3">
            <div class="aside"><img src="bootstrap-ecommerce-html/images/items/1.jpg" class="img-sm border"></div>
            <figcaption class="info align-self-center">
              <p class="title">Just name of title or name goes here</p>
              <span class="text-muted">$145 </span>
            </figcaption>
          </figure> 
        </li>
        <li class="col-md-4">
          <figure class="itemside  mb-3">
            <div class="aside"><img src="bootstrap-ecommerce-html/images/items/2.jpg" class="img-sm border"></div>
            <figcaption class="info align-self-center">
              <p class="title">Just name of title or name goes here</p>
              <span class="text-muted">$250 </span>
            </figcaption>
          </figure> 
        </li>
        <li class="col-md-4"> 
          <figure class="itemside mb-3">
            <div class="aside"><img src="bootstrap-ecommerce-html/images/items/3.jpg" class="img-sm border"></div>
            <figcaption class="info align-self-center">
              <p class="title">Just name of title or name goes here</p>
              <span class="text-muted">$145 </span>
            </figcaption>
          </figure> 
        </li>
      </ul>
    </div> <!-- card-body .// -->
  </article> 
</div>  <!-- col .// -->
</div>  --}}

<!-- =========================  COMPONENT MYORDER 2 END.// ========================= -->

</div> <!-- row.// -->

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

   $('#exampleModalCenter').delay(3000).fadeOut(2000,function() {
    $(this).modal('hide');
  });

   $('#exampleModalCenter').modal('show').delay(3000).fadeOut(2000);

   $('#toast1').toast('show').delay(1000).fadeOut(2000);
 }

</script>

@stop