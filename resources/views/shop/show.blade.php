@extends('layouts.master')

@section('title', 'Nos boutiques')

@section('extra-css')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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

  <div class="container">

    <header class="section-heading heading-line">
      <p class="title-section bg  rounded shadow p-2">Toutes les boutiques <span class="h5 b text-danger text-uppercase">  {{config('app.name')}}</span></p>
    </header>

    <div class="row-sm cols-flex m-0 p-0" style="font-size: 12px">
      @forelse(\App\Profile::all() as $store)

          
            <div class="card card-inverse mb-3" style="background-color: #333; border-color: #333;">
              <div class="card-block">
                <div class="row">
                  <div class="col-4">
                    
                  <div class=" text-center">
                    <img class="img-md rounded" src="{{asset(json_decode($store->logo))}}" alt="Logo {{$store->store_name}}" style=" width: 100px!important;height: 100px!important;">
                  </div>  
                  </div>
                  <div class="col-8 col-sm-8">
                    <h2 class="card-title">{{$store->store_name}}</h2>
                    <p class="card-text"><strong>Catégorie: </strong> {{$store->type}}</p>
                    <p class="card-text"><strong>Description: </strong> {{ $store->description }} </p>
                   
                   
                  </div>
                </div>
                  <div class="d-flex col-12">
                           
                    <div class="col-md-4 col-sm-4 text-center">
                      <h2><strong> {{ \App\Profile::where('email', $store->email)->count() }}</strong></h2>                    
                      <p><small>VENTES</small></p>
                      <button class="btn btn-primary btn-block btn-sm"><span class="fa fa-facebook-square"></span> Like  </button>
                    </div>
                    <div class="col-md-4 col-sm-4 text-center">
                      <h2><strong>{{ \App\Product::where('email', $store->email)->count() }}</strong></h2>                    
                      <p><small>PRODUITS</small></p>
                      <button class="btn btn-success btn-block btn-sm"><span class="fa fa-twitter-square"></span> Voir </button>
                    </div>
                    <div class="col-md-4 col-sm-4 text-center">
                      <h2><strong>{{ \App\Product::where('email', $store->email)->count() }}</strong></h2>                    
                      <p><small>ABONNEES</small></p>
                      <button type="button" class="btn btn-danger btn-block btn-sm"><span class="fa fa-google-plus-square"></span> Suivre </button>  
                    </div>
                  </div>
              </div>
            </div>
      
      


      @empty
      @guest

      <div class="col-md-4 offset-md-4 text-center">
        <span>Aucune boutique disponible </span><br> <br>  
        <a href="/" class="btn btn-outline-danger  p-3 m-auto"><i class="fa fa-store pr-2">  </i>Accueil</a>
      </div>

      @else



      @endguest
      @endforelse
    </div>
    <div class="py-3 container col-sm-12 offset-sm-12" align="center"> 

      <a href="/" class="ml-auto py-3">Voir plus <i class="fa fa-arrow-right ml-2">  </i></a>

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

