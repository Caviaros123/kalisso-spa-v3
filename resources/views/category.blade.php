@extends('layouts.master')

@section('title', 'Categories')

@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<link rel="stylesheet" href="../store_assets/plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../store_assets/dist/css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

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





<div class="row ">
	<div class="col-4  bg-light shadow-lg flex-wrap m-2 p-0" style="font-size: 8px!important" style="height: 100%!important" >

        <ul class="nav nav-tabs col-4 fixed-top nav nav-pills  navbar-nav m-0 p-2" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link @if($categoryName == 'Nouveaux') active @endif p-0 m-2" id="home-tab"  role="tab" aria-controls="home" aria-selected="true" href="/category">Nouveaux</a>
            </li>
            @foreach($countProduct as $data)
            <li class="nav-item p-0 m-0 ">
                <a class="nav-link @if(request()->get('category') == $data->slug) active @endif p-2" id="{{$categoryName}}-tab"  role="tab" aria-controls="{{$categoryName}}" aria-selected="false" href="{{route('category.index', ['category'=>$data->slug])}}" class="nav-link" style="font-size: 9px"> {{$data->name}}
                    <span class="float-right badge badge-danger  text-right round">{{$data->number}}
                    </span>
                </a>
            </li>
            @endforeach
        </ul> 
		
	</div>
	
	<div class="col-7 p-0 tab-content" id="myTabContent" > 
        <h5 class="text-muted pt-4 ">{{$categoryName}}</h5>
             <div class="row mx-2 pt-2 table"style="overflow-y: auto; white-space: nowrap;" > 
                @forelse($products as $prod)
                    <div class="tab-pane col-6 m-0 p-0 fade show active" id="{{$categoryName}}" role="tabpanel" aria-labelledby="content-tab" >

                                <div class=" m-1 mb-0 p-0" >
                                        <a href="{{route('cart.show', $prod->slug)}}">
                                        <div class=" card-sm card-product p-0 m-0">   
                                              <div class="widget-header p-0 m-0 mx-2 py-2"> 
                                                    <img src="{{productImage(loadImg($prod->image))}}" title="{{ $prod->name }} | {{ $prod->details }}" class="img-sm p-0 m-0" alt="{{ $prod->details }}">
                                              </div>
                                                <div class="card-body text-dark p-0 m-0 pl-2" style="font-size: 11px">   
                                                          
                                                          <p class="small  p-0 m-0 ">   
                                                                 
                                                                <h6 class="text-danger">   {{presentPrice($prod->price)}}</h6>
                                                          </p>
                                                </div>
                                        </div>   
                                        </a>
                                </div>   
                          </div>

                           
                @empty

                    <div class="alert alert danger m-auto">   
                            <p>Aucun produit n'est disponible pour cette catégorie pour le moment</p>
                    </div>
                @endforelse
            </div>
    </div>


</div>




@stop

@section('js')
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script  src="https://jacoblett.github.io/bootstrap4-latest/bootstrap-4-latest.min.js"></script>
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

         $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-eye" );
                }
            });
        });
         
       </script>
@stop


