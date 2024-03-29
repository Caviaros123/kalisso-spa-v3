@forelse(App\Order::where('shipped', null)->get()->sortByDesc('created_at') as $order)
  <article class="card card-product  shadow-lg mb-4">
    <header class="card-header text-light bg-danger ">
      <div class="row-sm">
       <div class="col-4 m-auto" align="left">
         <strong class="">REFERENCE : <span class="text-light">{{$order->id}}</span></strong>
       </div>
       <div class="col-4 m-auto text-center">
       		@if($order->shipped == 0)
        	
        		<h5><span class="badge  p-2 badge-light  shadow"> Statut: Annuler</span></h5>
        
        	@endif
       </div>
      <div class="col-4 m-auto text-right" align="right">
        <strong>Emise Le: <span class="text-light">{{ str_replace('-', '/', date('d-m-Y', strtotime($order->created_at))) }}</span></strong>
      </div>
    </div>
  </header>
  <div class="card-body">
    <div class="row"> 
      <div class="col-md-8">
        <h6 class="text-muted">Données de l'acheteur </h6>
        <hr class="m-0 p-0">
        <p class="mt-2"> 
         Nom: 		<span class="b h6 text-uppercase">{{$order->billing_name}}</span> <br>
         Téléphone: <span class="b h6 text-uppercase">{{$order->billing_phone}}</span> <br>
         Email:     <span class="b h6 text-uppercase">{{$order->billing_email}}</span> <br>
         Adresse:   <span class="b h6 text-uppercase">{{$order->billing_city}}, 
         {{$order->billing_adress}}  </span><br>
         
         Nombre de produits : <span class="b badge badge-danger">{{ $order->products->collect()->count() }}</span>

       </p>

     </div>
     
     <div class="col-md-4 ">

      <h5 class="text-info">Paiement</h5>
      Payé Par : <strong class="text-info">{{$order->payment_gateway}}</strong>
            <!-- <span class="text-success">
              <i class="fab fa-lg fa-cc-visa"></i>
                Visa  **** 4216  
              </span> -->
              
              <p>Prix: <span class="b text-danger">{{ presentPrice($order->billing_subtotal) }}</span> <br>
               Livraison:  {{presentPrice($order->billing_tax)}} <br> 
               <span class="b h5 text-danger">Total:  {{ presentPrice($order->billing_total) }}  </span>
             </p>
             <a href="{{route('orders.show', $order->id)}}"  class="btn btn-outline-info ml-auto m-auto "> Détails  </a>
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
                  <var class="price text-muted "> {{ presentPrice($order->billing_total) }} </var>
                </td>
                <td> <strong>Vendeur</strong> <br> {{$product->email}} </td>
                <td width="250" class="d-flex pt-4"> 
                  <!-- <a href="#" class="btn btn-outline-danger mr-2">Valider</a> -->
                   
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