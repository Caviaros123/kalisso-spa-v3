@extends('layouts.master')

@section('title', 'Panier')

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

<section class="section-content bg padding-y border-top">
	<div class="container-fluid">

		@if (Cart::instance('default')->count() > 0)

		<h4 class="">{{ Cart::instance('default')->content()->count() }} Produit(s) dans votre Panier</h4>
		<div class="row">
			<main class="col-sm-9">
				<div class="card">
					<table class="table table-responsive shopping-cart-wrap">
						<thead class="text-muted">
							<tr>
								<th scope="col" width="400">Produit</th>
								<th scope="col" width="300">Details</th>
								<th scope="col" >Quantité</th>
								<th scope="col" width="200">Prix</th>
								<th scope="col" class="text-right"  >Action</th>
							</tr>
						</thead>
						<!-- boucle du tableau des produits dans le panier 		 -->
						@foreach(Cart::instance('default')->content() as $item)
						
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
										
										<!-- <div class="text-md-right mr-1">
											<form style="display: inline;"  action="{{route('saveForLater', $item->id)}}" method="POST">
												@csrf
												<input  hidden="" name="image" value="{{$item->options->images}}">
												<input hidden="" name="id_produit" value="{{$item->id}}">
												<input hidden="" name="name" value="{{$item->name}}">
												<input hidden="" name="price" value="{{$item->subtotal}}">
												<input hidden="" name="details" value="{{$item->options->details}}">
												<input hidden="" name="slug" value="{{$item->model->slug}}">
												<input hidden="" name="id" value="{{$item->id}}">

												<button type="submit" title="Ajouter aux favoris" class="btn  rounded bg-danger text-light" style="background-color: #ff09ff"><i class="fa fa-heart"></i> </button>
											</form>
										</div> -->
										
										<div class="text-md-right">
											<form style="display: inline;" action="{{route('cart.destroy', $item->rowId,$item->id)}}" method="POST">
												@csrf
												@method('DELETE')
												<input type="number" hidden="" name="id" value="{{$item->id}}">
												<button type="submit" onauxclick="myOnLoadFunc();" title="Supprimer du panier" class="btn btn-dark  rounded "><i class="fa fa-trash text-danger"></i></button>
											</form>
										</div>
									</div>	
								</td>
							</tr>
						</tbody>

						@endforeach
						
					</table>
				</div> <!-- card.// -->

			</main> <!-- col.// -->
			<aside class="col-sm-3">
           
                <p class="alert b text-center alert-success">Tous nos price inclut la TVA et la livraison est gratuite </p>
               
                <dl class="dlist-align">
                   <dt>Prix: </dt>
                   <dd class="text-right">{{ presentPrice(Cart::subtotal()) }} </dd>
               </dl>
              <dl class="dlist-align h4">
               <dt>Total:</dt>
          
               <dd class="text-right"><strong>{{ presentPrice(Cart::total()) }} </strong></dd>
              
           </dl>
           <hr>
           <div class="container m-2 mb-3">

               <a href="{{ route('checkout.index')}}" class="btn btn-success btn-lg form-control rounded"><i class="fab fa-telegram-plane fa-1x"></i> Commander</a>

           </div>
           <div class="container m-2 mb-5">

               <a href="/empty" class="btn btn-danger btn-lg form-control rounded"><i class="fas fa-trash fa-1x"></i> Vider le panier</a>

           </div>
           <hr>
           <div class="row-sm" align="left">
              <h5>Moyens de paiements </h5>
              <div>
                 <figure class="itemside mb-3 " >

                    <a href="https://play.google.com/store/apps/details?id=net.hrmtech.zainmalonga.hrm_tech_biz_pro_242_app_wallet">
                       <aside class="aside ">
                          <img class=" icon-lg img-thumbnail" src="https://www.casec-acsac.org/wp-content/uploads/2019/09/FormatFactoryLOGO_MoMo-OK1.jpg">
                      </aside>
                  </a>

                  <div class="text-wrap small mt-3 text-muted">
                      MTN MoMo  <span class="b text-danger">(3.5% frais)</span><br>
                      <!-- <i class="fa fa-arrow-left text-danger fa fa-1x"></i> Télécharger l'application <br> en cliquant sur le logo -->
                  </div>
              </figure>
          </div>
          <div>
             <figure class="itemside mb-3 " >

                <a href="https://play.google.com/store/apps/details?id=net.hrmtech.zainmalonga.hrm_tech_biz_pro_242_app_wallet">
                   <aside class="aside ">
                      <img class=" icon-lg img-thumbnail" src="https://feedmalawicharity.org/wp-content/uploads/2020/07/925865141s.png">
                  </aside>
              </a>

              <div class="text-wrap small mt-3 text-muted">
                  AIRTEL Money  <span class="b text-danger">(3.5% frais)</span><br>
                  <!-- <i class="fa fa-arrow-left text-danger fa fa-1x"></i> Télécharger l'application <br> en cliquant sur le logo -->
              </div>
          </figure>
      </div>
      <div>
         <figure class="itemside mb-3 " >

            <a href="https://play.google.com/store/apps/details?id=net.hrmtech.zainmalonga.hrm_tech_biz_pro_242_app_wallet">
               <aside class="aside ">
                  <img class=" icon-lg img-thumbnail" src="https://www.ubacongobrazzaville.com/wp-content/uploads/sites/10/2019/09/Logo-UBA-180X180.jpg">
              </aside>
          </a>

          <div class="text-wrap small mt-3 text-muted">
              Visa UBA  <span class="b text-danger">(5% frais)</span><br>
              <!-- <i class="fa fa-arrow-left text-danger fa fa-1x"></i> Télécharger l'application <br> en cliquant sur le logo -->
          </div>
          </figure>
      </div>
      <div>
         <figure class="itemside mb-3 " >

            <a href="https://play.google.com/store/apps/details?id=net.hrmtech.zainmalonga.hrm_tech_biz_pro_242_app_wallet">
               <aside class="aside ">
                  <img class=" icon-lg img-thumbnail p-0 " src="https://www.killmybill.be/wp-content/uploads/sites/15/2017/03/carte-credit.jpg">
              </aside>
          </a>

          <div class="text-wrap small mt-3 text-muted">
              Carte de crédit  <span class="b text-danger">(0% frais)</span><br>
              <!-- <i class="fa fa-arrow-left text-danger fa fa-1x"></i> Télécharger l'application <br> en cliquant sur le logo -->
          </div>
          </figure>
      </div>
      <div>
         <figure class="itemside mb-3 " >

            <a href="https://play.google.com/store/apps/details?id=net.hrmtech.zainmalonga.hrm_tech_biz_pro_242_app_wallet">
               <aside class="aside ">
                  <img class=" icon-lg img-thumbnail" src="https://www.webdo.tn/wp-content/uploads/2016/02/paypal_2014_logo_detail.png">
              </aside>
          </a>

          <div class="text-wrap small mt-3 text-muted">
              Paypal <span class="b text-danger">(0% frais)</span><br>
              <!-- <i class="fa fa-arrow-left text-danger fa fa-1x"></i> Télécharger l'application <br> en cliquant sur le logo -->
          </div>
          </figure>
      </div>
    					<!-- <div>
						
						<figure class="itemside mb-3 " >

							<a href="https://www.facebook.com/digiboxcongo/">
								<aside class="aside ">
									<img class=" icon-lg img-thumbnail" src="https://lh3.googleusercontent.com/0fAyLeyV2IYpg_3uuzN_49qCEalqgvLWYO6xYhTSPLtB3nYir8TkciGpExiRvMrKgSI">
								</aside>
							</a>
							<p class="text-wrap small mt-3 text-muted">
								Paiement cash a reception du produit (2.000 Fcfa)
							</p>
						</figure>
					</div> -->
				</div>						
			</aside> <!-- col.// -->
		</div>

		@else
		<div class="col-md-6 m-auto bg-danger card-product p-5 text-center rounded  " >

			<h3 class="text-light">Ooups Vous n'avez aucun produit dans votre Panier</h3>
			<div>
               <img src="https://cdn4.iconfinder.com/data/icons/e-commerce-and-online-shopping-flat/512/cancel_basket_empty_delete_cart_store-512.png" class="img w-50">
           </div>
           <a href="/category" class="btn btn-info text-light mt-3 rounded">

            Retournez au shopping !
        </a>
    </div>
    <div class="col-md-6   p-5 text-center rounded  ">

     <h3 class="b display-2">Panier vide</h3>
 </div>


 @endif

 @if(!Cart::content())

 @foreach($products as $item)

 <p class="alert alert-danger">{{ $item->id }} </p>

 @endforeach

 @endif
</div> <!-- container .//  -->


</section>

@include('layouts.footer')
@endsection


@section('js')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" integrity="sha512-VZ6m0F78+yo3sbu48gElK4irv2dzPoep8oo9LEjxviigcnnnNvnTOJRSrIhuFk68FMLOpiNz+T77nNY89rnWDg==" crossorigin="anonymous"></script>

<script type="text/javascript">

		// alert('HELLOO');

		(function(){
			
			const classname = document.querySelectorAll('.quantity')

			Array.from(classname).forEach( function(element) {
				element.addEventListener('change', function() {
					const id = element.getAttribute('data-id')
					const productStock = element.getAttribute('data-productStock')

					axios.patch(`/cart/${id}`, {
						quantity: this.value,
						productStock: productStock
					})
					.then(function (response) {
						
						window.location.href='{{ route('cart.index') }}';
					})
					.catch(function (error) {
						
						window.location.href='{{ route('cart.index') }}';
					});
				})
			})
		})();


	 $(window).on("load", function() { 
	        (function myOnLoadFunc(){
	            $('#exampleModalCenter').modal('show');
	            
	            $("#exampleModalCenter").modal('hide');
	            
	        })();


	    });

    </script>



    @stop

