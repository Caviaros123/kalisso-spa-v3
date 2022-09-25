@extends('layouts.master')

@section('title', $getStore->store_name)

@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<link rel="stylesheet" href="../store_assets/plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../store_assets/dist/css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


<link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>

<link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />
<!-- // import for zoom image viewer -->
<link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
<link rel="stylesheet" href="{{asset('/assets/style.css')}}">
<style type="text/css">
  .carousel-indicators li {
    width: 10px;
    height: 10px;
    border-radius: 100%;
  }

  .iconix i {
    width: .88888889rem;
      height: .88888889rem;
      line-height: .88888889rem;
      text-align: center;
      border-radius: 50%;
      background-color: hsla(0,0%,100%,.4);
      color: #222;
      font-size: 0;
  }

</style>
@stop

@section('content')


 

  <!-- Main content -->
  <section class="content">

      <div class="container-fluid">
            <!-- Widget: user widget style 1 -->
            <div class="card my-3 card-widget widget-user">

              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-header d-flex p-2 m-0 bg">
                  
                  <div class="col-sm-4 m-auto">
                       <img class=" round border solid img-sm p-0 m-0 img-circle  elevation-3" src="{{asset(json_decode($getStore->logo))}}" alt="Store Logo" >
                    
                  </div> 
                  <div class="col-sm-8 p-0 m-0">
                      <h5 class="p-0 m-0 "><span class="badge badge-success   bg-success rounded h5 my-2 shadow"><i class="fa fa-user-check p-2 mr-2"> </i>Boutique Certifié</span></h5>
                     <p class="widget-user-username"><span class="h4 text-muted text-uppercase"> {{$getStore->store_name}}</span><br>  
                    {{$getStore->type}}</p>
                
                  </div> 
                  
               
               
              </div>
              
              
            </div>
            <!-- /.widget-user -->
            <!-- <div class="container p-0 m-0 "> 
              <div class="col-md-12 offset-md-12 m-auto m-0 p-0" align="center">
                  
                  
                 
              </div>

            </div> -->
             <div class="card-product p-2 m-0">
                <div class="row ">
                  <div class="col-4 m-auto text-center border-right ">
                    <div class="description-block">
                      <h5 class="description-header">{{ $getStore->transaction ?: 0 }}</h5>
                      <span class="description-text">VENTES</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-4 m-auto text-center border-right ">
                    <div class="description-block">
                      <h5 class="description-header">{{ $getStore->follows ?: 0}} </h5>
                      <span class="description-text">ABONNEES</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-4 m-auto text-center ">
                    <div class="description-block">
                      <h5 class="description-header">{{ \App\Product::where('email', $getStore->email)->count() }}</h5>
                      <span class="description-text">PRODUITS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                   

                  <!-- /.col -->
                </div>
                <div class="row p-0 m-0 "> 
                  <div class="col-md-4 offset-md-4 py-3 m-0 p-0">
                      <a class="btn btn-light col-md-12 offset-md-12 bg-danger shadow disabled rounded p-2 " href="#">+ Suivre</a>
                
                  </div>

                </div>
                <!-- /.row -->
              </div>

          </div>

          <hr>


          <div class="b text-muted shadow text-center py-3 px-2">
              
            <p class="small text-danger">Des mise à jour de votre espace sont en cours ...</p>

          </div>

          <hr>


             <div class="container">

            <header class="section-heading heading-line">
              <p class="title-section bg rounded shadow p-2">Nouveaux chez <span class="h5 b text-danger text-uppercase">  {{$getStore->store_name}}</span></p>
            </header>

            <div class="row-sm cols-flex m-0 p-0" style="font-size: 12px">
                @forelse($products = \App\Product::where('email', $getStore->email)->where('featured', 1)->take(8)->get() as $prod)
             
               <div class="col-sm-4 col-md-2 col-6 shadow  m-0 p-0">
                <figure class=" card-product m-0 p-0" style="border: none!important;">
                    <a href="{{route('shop.show', $prod->slug)}}" class="p-0 m-0">
                        <div class="img-box img-fluid img-md m-auto  m-0 p-0">
                            <img src="{{ productImage(loadImg($prod->image))}}" title="{{ $prod->name }} | {{ $prod->details }}" class="img-md m-0 p-0" alt="{{ $prod->details }}">
                        </div>
                    </a>
                    
                    <div class="bottom-wrap p-2 mt-2 m-0 p-0">
                           
                            <figure class="p-0 m-0 text-truncate"> {{ $prod->name }}<br>{{ $prod->details }}</figure>

                            
                            <form action="{{route('cart.store')}}" method="POST" class="m-0 p-0" style="display: inline;">
                                @csrf
                                <input hidden="" name="id_produit" value="{{$prod->id}}">
                                <input hidden="" name="name" value="{{$prod->name}}">
                                <input hidden="" name="price" value="{{$prod->price}}">
                                <input hidden="" name="image" value="{{$prod->image}}">
                                <input hidden="" name="details" value="{{$prod->details}}">
                                <input hidden="" name="slug" value="{{$prod->slug}}">
                                <input hidden="" name="id" value="{{$prod->id}}">

                                {{-- <button type="submit" class="btn btn-success shadow b mt-2 m-0" style="border: none!important;"><i class="fa fa-shopping-cart text-success"></i> +Panier</button> --}}


                               {{--   <button type="submit" class="btn btn-md btn-primary shadow float-right">
                                    <i class="fa fa-shopping-cart text-success"></i>
                                </button>  --}}
                            </form>
                            <div class="price-wrap h5 m-0 p-0 text-danger">
                                
                                <span class="price-new h6 text-danger m-0 p-0 b">{{ presentPrice($prod->price) }}</span> 
                                    
                                @if($prod->price < $prod->old_price)
                                    <del class="price-old">{{ presentPrice($prod->old_price) }}</del>      
                                @endif

                                @if($prod->featured)
                                    
                                    <h5><span class="badge badge-secondary mr-3 mt-3 shadow rounded notify">{{ __('Nouveau') }}</span></h5>
                                @endif
                            </div> <!-- price-wrap.// -->
                    </div> <!-- bottom-wrap.// -->
                </figure>
               
            </div> <!-- col // -->

              @empty
                @guest
                 
                    <div class="col-md-4 offset-md-4 text-center">
                      <span>Vous n'avez encore aucun produit disponible veuillez en ajouter depuis votre k-Panel</span><br> <br>  
                      <a href="/admin" class="btn btn-outline-danger  p-3 m-auto"><i class="fa fa-store pr-2">  </i>Mon K-Panel</a>
                    </div>
                  
                @else



                @endguest
              
              @endforelse
            </div>
            <div class="py-3 container col-sm-12 offset-sm-12" align="center"> 

                <a href="/{{$getStore->slug}}?view=0?featured=1" class="ml-auto py-3">Voir plus <i class="fa fa-arrow-right ml-2">  </i></a>

            </div>
        </div>



          <hr>  
          <div class="container">

            <header class="section-heading heading-line">
              <p class="title-section bg  rounded shadow p-2">Produits Recommandés par <span class="h5 b text-danger text-uppercase">  {{$getStore->store_name}}</span></p>
            </header>

            <div class="row-sm cols-flex m-0 p-0" style="font-size: 12px">
                @forelse($produit = \App\Product::where('email', $getStore->email)->take(12)->get() as $prod)
             


               <div class="col-sm-4 col-md-2 col-6 shadow  m-0 p-0">
                <figure class=" card-product m-0 p-0" style="border: none!important;">
                    <a href="{{route('shop.show', $prod->slug)}}" class="p-0 m-0">
                        <div class="img-box img-fluid img-md m-auto  m-0 p-0">
                            <img src="{{ productImage(loadImg($prod->image))}}" title="{{ $prod->name }} | {{ $prod->details }}" class="img-md m-0 p-0" alt="{{ $prod->details }}">
                        </div>
                    </a>
                    
                    <div class="bottom-wrap p-2 mt-2 m-0 p-0">
                           
                            <figure class="p-0 m-0 text-truncate"> {{ $prod->name }}<br>{{ $prod->details }}</figure>

                            
                            <form action="{{route('cart.store')}}" method="POST" class="m-0 p-0" style="display: inline;">
                                @csrf
                                <input hidden="" name="id_produit" value="{{$prod->id}}">
                                <input hidden="" name="name" value="{{$prod->name}}">
                                <input hidden="" name="price" value="{{$prod->price}}">
                                <input hidden="" name="image" value="{{$prod->image}}">
                                <input hidden="" name="details" value="{{$prod->details}}">
                                <input hidden="" name="slug" value="{{$prod->slug}}">
                                <input hidden="" name="id" value="{{$prod->id}}">

                                {{-- <button type="submit" class="btn btn-success shadow b mt-2 m-0" style="border: none!important;"><i class="fa fa-shopping-cart text-success"></i> +Panier</button> --}}


                               {{--   <button type="submit" class="btn btn-md btn-primary shadow float-right">
                                    <i class="fa fa-shopping-cart text-success"></i>
                                </button>  --}}
                            </form>
                            <div class="price-wrap h5 m-0 p-0 text-danger">
                                
                                <span class="price-new h6 text-danger m-0 p-0 b">{{ presentPrice($prod->price) }}</span> 
                                    
                                @if($prod->price < $prod->old_price)
                                    <del class="price-old">{{ presentPrice($prod->old_price) }}</del>      
                                @endif

                                @if($prod->featured)
                                    
                                    <h5><span class="badge badge-secondary mr-3 mt-3 shadow rounded notify">{{ __('Nouveau') }}</span></h5>
                                @endif
                            </div> <!-- price-wrap.// -->
                    </div> <!-- bottom-wrap.// -->
                </figure>
            </div> <!-- col // -->
              @empty
                @guest
                 
                    <div class="col-md-4 offset-md-4 text-center">
                      <span>Vous n'avez encore aucun produit disponible veuillez en ajouter depuis votre k-Panel</span><br> <br>  
                      <a href="/admin" class="btn btn-outline-danger  p-3 m-auto"><i class="fa fa-store pr-2">  </i>Mon K-Panel</a>
                    </div>
                  
                @else



                @endguest
              @endforelse
            </div>
            <div class="py-3 container col-sm-12 offset-sm-12" align="center"> 

                <a href="/{{$getStore->slug}}?view=0" class="ml-auto py-3">Voir plus <i class="fa fa-arrow-right ml-2">  </i></a>

            </div>
        </div>
  </section>
  <!-- /.content -->



@stop



@section('js')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" integrity="sha512-VZ6m0F78+yo3sbu48gElK4irv2dzPoep8oo9LEjxviigcnnnNvnTOJRSrIhuFk68FMLOpiNz+T77nNY89rnWDg==" crossorigin="anonymous"></script>

<script type="text/javascript">
	(function() {
		const currentImage = document.querySelector('#currentImage');
		const images = document.querySelectorAll('.item-gallery');

		images.forEach((element) => element.addEventListener('click', thumbnailClick));

		function thumbnailClick(e){
			currentImage.src = this.querySelector('img').src;

			images.forEach((element) => element.classList.remove('active'));
			this.classList.add('zoom-in active');
		}
	})();

</script>
<script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha384-JUMjoW8OzDJw4oFpWIB2Bu/c6768ObEthBMVSiIx4ruBIEdyNSUQAjJNFqT5pnJ6" crossorigin="kalisso.com"></script>
<script src="{{asset('./assets/zoomsl.js')}}"></script>
<script src="{{asset('./assets/script.js')}}"></script>
<script type="text/javascript">
    (function myOnLoadFunc(){

            $('#exampleModalCenter').modal('show').fadeOut(2000,function() {
                $(this).modal('hide');
            });

        })();

</script>

@stop

