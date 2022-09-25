@extends('layouts.master')

@section('title', 'Profil')

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
			<div class="modal-body bg p-4 text-success b text-center">

				<i class="fa fa-check text-success fa-2x mt-2 mr-3"></i>
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


<div class="content-wrapper  py-4" >
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<h5 class="doc-title-md mb-4 text-dark"> <a href="/" class="text-muted"><i class="fa fa-arrow-left text-danger mr-2"></i>Accueil </a></h5>
			<div class="row">
				<div class="col-md-2 ">

					<!-- Profile Image -->
					<div class="card card-product">
						<div class="card-body box-profile" >
							<div class="text-center">
								<form action="" method="POST" enctype="multipart/form-data">

									<img  class="profile-user-img img-fluid icon-lg border round img-circle shadow mb-2 solid border-success" src="../storage/{{Auth::user()->avatar}}" alt="User profile picture">



									<h3 class="profile-username text-center h6 mt-2">{{auth()->user()->email}}</h3>
									<input type="file" name="image" hidden="" class="custom-select form-control">

								</form>

							</div>
							<hr>
							<!-- navigation link -->
							<ul class="nav navbar-nav nav-pills nav-fill mb-3" role="tablist" >
								<li class="nav-item">
									<a data-toggle="pill" href="#profile"  class="p-2 nav-link active" > <i class="fa fa-user"></i> Mon Profil</a>
								</li>
								@if(!auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
								<li class="nav-item ">
									<a data-toggle="pill" href="#commandes" class="p-2 nav-link " target="#commandes"> Mes Commandes <span class="badge badge-warning ml-4 round">{{$orders->collect()->count()}}</span>
									</a>
								</li>
								@endif
								<?php   

										$getStore = \App\Profile::where('store_id', auth()->user()->store_id)->first();
								?>
								@if(auth()->user()->role_id == 3 || auth()->user()->role_id == 1)
								<li class="nav-item ">
									<a  href="/{{ $getStore['slug'] }}" class="p-2 nav-link " > <i class="fa fa-store"></i> Ma Boutique 
									</a>
								</li>
								<li class="nav-item ">
									<a  href="/admin" class="p-2 nav-link " > <i class="fa fa-tools"></i> Gérer ma boutique 
									</a>
								</li>
								@endif
								@if(auth()->user()->role_id == 4 || auth()->user()->role_id == 1)
								<li class="nav-item ">
									<a  href="/diffusion" class="p-2 nav-link " > <i class="fa fa-phone"></i> Diffusion SMS</a>
								</li>
								@endif
								@if(auth()->user()->role_id == 1)
								<li class="nav-item ">
									<a  href="/tasks/products" class="p-2 nav-link " title="Pixel PRODUITS"> <i class="fa fa-download"></i> Exportez les PRODUITS </a>
								</li>
								<li class="nav-item ">
									<a  href="/tasks/members" class="p-2 nav-link " title="Listes des membres"> <i class="fa fa-download"></i> Exportez les Liste des membres </a>
								</li>
								@endif
								<hr class="py-3">	
								<li class="nav-item ">  
									<a class="text-danger rounded btn shadow btn-outline-danger " href="{{ route('logout') }}"
									onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
									Deconnexion <span class="fa fa-power-off"></span>
								</a>
								<form id="logout-form" hidden="" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
                   <!--  <li class="nav-item ">
                        <a class="p-2 nav-link " data-toggle="pill" href="#parametres">Paramètres </a>
                    </li> -->
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-10">
    	<div class="card">

    		<div class="tab-content">
    			<div class="tab-pane fade" id="livraison">
    				<!-- Transaction et livraison de l'utilisateur  -->
    				<div class="card-header bg-danger text-light pl-3 mb-2">
    					<!-- header profile -->
    					<h2 class="text-uppercase">livraison & Suivie</h2>

    				</div><!-- /.card-header -->
    				@include('partials.livraison')
    			</div>	
    			<!-- /.tab-pane -->


    			<div class="tab-pane fade" id="commandes">
    				<!-- section de controle et suivie des commandes de l'utilisateur -->  		
    				<div class="card-header bg-danger text-light pl-3 mb-2">
    					<!-- header profile -->
    					<div class="row">
    						<div class="col-md-9 b">
    							<h5 class="text-uppercase m-0 p-0">Commandes </h5>
    						</div>
    						<div class="col-md-3 b ">
    							Vous avez <span class="badge p-2 ml-2 badge-warning">{{$orders->collect()->count()}}</span> Commande(s)
    						</div>


    					</div>

    				</div><!-- /.card-header -->
    				@include('partials.my-orders')
    			</div>
    			<!-- /.tab-pane -->

    			<div class="tab-pane  active" id="profile">
    				<div class="card-header bg-danger text-light  mb-2">
    					<!-- header profile -->
    					<h5 class="text-uppercase m-0 p-0">Profil</h5>

    				</div><!-- /.card-header -->
    				@include('partials.profile')
    			</div>
    			<!-- /.tab-pane -->
    		</div>
    		<!-- /.tab-content -->

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


@include('layouts.footer')     
@stop


@section('js')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
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

         
         
     </script>

     @endsection
