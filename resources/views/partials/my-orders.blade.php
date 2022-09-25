<main class="col-md-12" >

  @forelse(orderDelivery() as $order)
  <article class="card card-product shadow-lg mb-4">
    <header class="card-header ">
      <div class="row">
       <div class="col-md-4">
         <strong class="">REFERENCE DE LA COMMANDE: <span class="text-danger">{{$order->id}}</span></strong>
       </div>
       <div class="col-md-4 text-center">
        <span class="badge p-3 badge-warning "> En attente ...</span>
      </div>
      <div class="col-md-4 text-right">
        <strong>Emise Le: <span class="text-danger">{{ date('d-m-Y', strtotime($order->created_at)) }}</span></strong>
      </div>
    </div>
  </header>
  <div class="card-body">
    <div class="row"> 
      <div class="col-md-9">
        <h6 class="text-muted">Livraison à : <span class="text-uppercase h5">{{$order->billing_name}}</span></h6>
        <p> 
         Téléphone: {{$order->billing_phone}} <br>
         Email:     {{auth()->user()->email}} <br>
         Adresse:   {{$order->billing_province}},
         {{$order->billing_city}},
         {{$order->billing_adress}} <br> 
         Nombre de produits: <span class="b badge badge-danger">{{ $order->products->collect()->count() }}</span>

       </p>

     </div>
     
     <div class="col-md-3 ">

      <h4 class="text-info">Paiement</h4>
      Payé Par: <strong class="text-info">{{$order->payment_gateway}}</strong>
            <!-- <span class="text-success">
              <i class="fab fa-lg fa-cc-visa"></i>
                Visa  **** 4216  
              </span> -->
              
              <p>Prix: {{ presentPrice($order->billing_subtotal) }} <br>
               Frais de Livraison:  {{$order->shipped}} <br> 
               <span class="b h5 text-danger">Total:  {{ presentPrice($order->billing_total) }}  </span>
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
              <var class="price text-muted "> {{ presentPrice($order->billing_total) }} </var>
            </td>
            <td> <strong>Vendeur</strong> <br> {{$product->email}} </td>
            <td width="250" class="mt-4"> 
              <!-- <a href="#" class="btn btn-outline-primary mr-2">Suivre</a> -->
              <a href="{{route('orders.show', $order->id)}}" class="btn btn-outline-info"> Détails sur cette commande </a> 
            </td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
    </div> <!-- table-responsive .end// -->
  </article> <!-- order-group.// --> 
  <hr class="m-4">
  @empty
  <div class="alert alert-danger">Vous n'avez aucun commandes en cours </div>
  @endforelse
</main>