@extends('layouts.master')

@section('title', 'Livraison')

@include('layouts.navbar')

@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">


<link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>

<link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />

@stop

@section('content')


@if(auth()->user())



<!-- ================= SUCCESS AND ERROR MODAL ============== -->
@if (session()->has('validated'))
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
				{!! session()->get('validated') !!}
				
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




<section>
	
	<div class="container padding-y ">

		<div class="row-sm ">
			<div class="col-md-3  card text-center">
				<h5 class="padding-y-sm card-header">Gestions des commandes</h5>
				<div class="padding-y">	
					<!-- navigation link -->
                    <ul class="nav navbar-nav nav-pills nav-fill mb-3" role="tablist" >
                      <li class="nav-item m-0 ">
                        <a class=" b nav-link p-2 link text-left active" data-toggle="pill" href="#all"  >Toutes les Commandes <span class="float-right badge badge-info p-1 round">{{ App\Order::count() }}</span></a>
                    </li>
                    <li class="nav-item m-0 ">
                        <a class=" b nav-link p-2 link text-left" data-toggle="pill" href="#notShipped" class="p-2 b nav-link " target="#notShipped">Commande(s) non Livrées <span class="float-right badge badge-warning  p-1 round">{{ App\Order::where('shipped', '0')->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item m-0 ">
                        <a class=" b nav-link p-2 link text-left" data-toggle="pill" href="#shipped" >Commande(s) Livrées <span class="float-right badge badge-success  p-1 round">{{ App\Order::where('shipped', '1')->count() }}</span></a>
                    </li>
                    
                    <li class="nav-item m-0 ">
                        <a class=" b nav-link p-2 link text-left" data-toggle="pill" href="#canceled" target="#canceled">Commande(s) annuler <span class="float-right badge badge-danger p-1 round">{{ App\Order::where('shipped', null)->count() }}</span>
                        </a>

                    </li>



                </ul>
            </div>
        </div>
        <br>
        <div class="col-md-9 card " >



            <main class="col-md-12 tab-content padding-y" >

               <div class="tab-pane fade active show" id="all">
                  <div class="h4 b padding-y-sm card-header" align="center">
                      Vous avez recu <span class="badge p-2 badge-info shadow">{{ App\Order::count() }}</span> Commande(s) au total
                  </div>
                  @include('partials.orders.allOrders')
              </div>
              <div class="tab-pane fade" id="notShipped">
                  <div class="h4 b padding-y-sm card-header" align="center">
                      Vous avez <span class="badge p-2 badge-warning shadow">{{ App\Order::where('shipped', '1')->count() }}</span> Commande(s) non livrées
                  </div>
                  @include('partials.orders.notShippedOrder')
              </div>
              <div class="tab-pane fade" id="shipped">
                  <div class="h4 b padding-y-sm card-header" align="center">
                      Vous avez <span class="badge p-2 badge-success shadow">{{ App\Order::where('shipped', '1')->count() }}</span> Commande(s) livrées
                  </div>
                  @include('partials.orders.shippedOrder')
              </div>
             
              <div class="tab-pane fade" id="canceled">
                  <div class="h4 b padding-y-sm card-header" align="center">
                      Vous avez <span class="badge p-2 badge-danger shadow">{{ App\Order::where('shipped', null)->count() }}</span> Commande(s) annuler
                  </div>
                  @include('partials.orders.canceledOrders')
              </div>


          </main>
      </div>
  </div>

</div>


</section>






@else


<div class="container padding-y-lg" align="center">
	<div class="alert alert-danger display-4" >Vous n'avez pas acces a cet espace
	</div>
	<a href="/" class="btn btn-outline-info m-5">Retour</a>
</div>




@endif


@if (session()->get('success_message'))
<!-- Modal success-->
<div class="modal fade " id="exampleModalCenter" tabindex="-8" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content bg shadow-lg border solid borger-light text-light">
            <div class="modal-header shadow-lg bg">
            <h4>
                
            </h4>
            <button type="button" class="close text-danger rounded" data-dismiss="modal" aria-label="Close">
                <span  aria-hidden="true">&times;</span>
            </button>
            </div>
             <form method="post" action="{{ route('order.update', session()->get('dataId') ) }}">
                @csrf
                @method('PATCH')
                <div class="modal-body bg p-4 text-dark b text-center">
                    <span class="text-success
                    ">{{ session()->get('success_message') }}</span>
                    <div>
                       Id de la commande: {{session()->get('dataId')}}
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Saisissez le code de livraison:</label>
                        <input type="tel" name="pin_code" maxlength="6" required placeholder="Code de validation" minlength="6" class="form-control text-center " id="message-text">
                    </div>

                </div>
                <div class="modal-footer text-success">
                    <!-- <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Annuler</button> -->
                      
                    <button type="submit" class="btn btn btn-danger send"  name="shippedValidation" value="confirm">Confirmer</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endif



@stop



@section('js')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">



	(function myOnLoadFunc(){

		$('#exampleModalCenter').modal('show').fadeOut(2000,function() {
			$('#exampleModalCenter').modal('hide');
		});

	})();


    
</script>



@stop