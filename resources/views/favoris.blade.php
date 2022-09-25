@extends('layouts.master')

@section('title', 'Favoris')

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

<!-- Process -->
<div class="container-fluid padding-y">

@if (Cart::instance('wishlist')->count() > 0)

  <div class="b row text-muted mb-3">
    <div class="b pt-2 pl-3 pb-0">
      <h3>Vos Favoris</h3>
    </div>
    <div class="p-3 pb-0">
      
      <span class="b badge badge-danger">{{Cart::instance('wishlist')->count()}}</span>
    </div>
  </div>

  <div class="card">
    <table class="table table-responsive shopping-cart-wrap">
      <thead class="text-muted">
        <tr>
          <th scope="col" width="400">Produit</th>
          <th scope="col" width="300">Details</th>
          <th scope="col" >Quantité</th>
          <th scope="col" width="200">Prix</th>
          <th scope="col" class="text-right">Action</th>
        </tr>
      </thead>
      <!-- boucle du tableau des produits dans le panier     -->
      @foreach(Cart::instance('wishlist')->content() as $item)
      
      <tbody>
        <tr>
          <td>
            <figure class="media">
              <div class="img-wrap">
                <a href="{{route('cart.show', $item->model->slug)}}">
                  <img src="{{ asset('storage/'.$item->options->images)}}" class="img-thumbnail img-sm">
                </a>
              </div>
              <figcaption class="media-body">
                <a href="">
                  <h6 class="title "><a  href="{{ route('cart.show', $item->model->slug) }}"><p class="text-truncate">{{$item->name}}</p> </a></h6>
                </a>
                
              </figcaption>
            </figure> 
          </td>
          <td class="text-truncate">
            <small class="text-muted">{{ $item->options->details }}</small>
          </td>
          <td> 
            <select id="quantity" class="form-control quantity" data-id="{{ $item->rowId }}" data-productStock="{{ $item->model->stock }}">
              @for ($i = 1; $i <  10 + 1 ; $i++)
              <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
              @endfor
            </select>
          </td>
          <td> 
            <div class="price-wrap"> 
              <var class="price text-success">{{ presentPrice($item->subtotal) }}  </var> 
              
            </div> <!-- price-wrap .// -->
          </td>
          <td  > 
            <div class="text-right d-flex">
              <div class="text-md-right mr-1">
                <form style="display: inline;"  action="{{route('cart.switchToSaveForLater',$item->rowId)}}" method="POST">
                  @csrf
                  <input hidden="" name="image" value="{{$item->options->images}}">
                  <button type="submit" title="Ajouter aux favoris" class="btn  rounded bg-danger text-light" style="background-color: #ff09ff"><i class="fa fa-heart"></i> </button>
                </form>
              </div>
              
              <div class="text-md-right">
                <form style="display: inline;" action="{{route('cart.destroy', $item->rowId,$item->id)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <input type="number" hidden="" name="id" value="{{$item->id}}">
                  <button type="submit" onauxclick="myOnLoadFunc();" title="Supprimer du panier" class="btn btn-dark text-light rounded "><i class="fa fa-window-close"></i></button>
                </form>
              </div>
            </div>  
          </td>
        </tr>
      </tbody>

      @endforeach
      
    </table>
  </div> <!-- card.// -->

  @else


      <div class="col-md-6 m-auto bg-secondary shadow-lg card-product p-5 px-5 py-5 padding-md text-center rounded  ">

      <h3 class="text-light">Ooups Vous n'avez aucun article favoris pour l'instant</h3>
      <div><i class="fas fa-shopping-basket  fa-3x text-light"></i></div>
      <a href="/category" class="btn btn-light bg-info mt-3 rounded">
        
        Continuez votre shopping !
      </a>
    </div>


  @endif
</div>




@include('layouts.footer')     
@stop


@section('js')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">

  
  function myOnloadFunc() {

    $('#exampleModalCenter').fadeOut(2000,function() {
      $(this).modal('hide');
    });

    $('#exampleModalCenter').modal('show').delay(3000);

    $('#toast1').toast('show').delay(3000).fadeOut(4000);
  }


         // script for annimation 

         
         
       </script>

       @endsection