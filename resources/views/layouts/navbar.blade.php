
@section('navbar-menu')

<header class="section-header ">

  <section class="header-main border-bottom  p-0 m-0 ">
    <div class="container-fluid align-items-center">
      <div class="row align-items-center">
        <!-- LOGO BRAND -->
        
        <div class="col-lg-2 row-sm col-sm-3 col-5 mb-0">
         <a href="/" class="navbar-brand">
           <img class="w-100 flex-fill"  src="/kalisso.png" >
         </a> <!-- brand-wrap.// -->
       </div>
       <!-- SEARCH AREA -->
       <div class="col-md-6  col-lg-7 col-sm-6 d-none d-md-block mt-2 mb-0 pb-0">
        <form action="{{ route('search.search') }}" method="GET" class="search-wrap mb-0"> 

          <div class=" input-group">
            <input type="search" name="search" minlength="3" required="required" class="form-control rounded p-4 " placeholder="Qu'est ce qui vous ferais plaisir ?" autocomplete="{{ request()->input('search')}}" value="{{request()->input('search') ?? '' }}">
            <button type="submit" class="btn bg-danger btn-lg  m-0">
              <i class="fa fa-search text-light rounded b"></i>
            </button> 
          </div>
        </form>
      </div>
      <!-- End search -->
      <div class="col-lg-3 col-sm-6 col-md-3 m-0 p-0 col-7">

        <div class="d-flex justify-content-end m-0 p-0">
         
          
          <a href="/cart" class="widget-header m-0 p-2 p-0 ">
            <div class="icon zoom-wrap">
              <i class="icon-sm rounded-circle text-success shadow border border-success zoom-in fa fa-shopping-basket"></i>
              <span class="notify bg-success round b round mt-2 ml-0 mr-2 ">{{Cart::instance('default')->count()}}</span>
            </div>
          </a>
          <a href="/wishlist" class="widget-header m-0 p-2 ">
            <div class="icon zoom-wrap ">
              <i class="icon-sm rounded-circle text-danger border shadow border-danger zoom-in fa fa-heart"></i>
              <span class="notify bg-danger round b round mt-2 ml-0 mr-2 ">{{Cart::instance('wishlist')->count()}}</span>

            </div>
          </a>
          

          @if(Auth::user())
          

          <div class="widget-header  dropdown">
            <a href="{{route('users.edit')}}" class="ml-2 caret-up" data-toggle="dropdown" data-offset="10,20">
              <div class="icontext zoom-wrap mt-1">
                <div class="icon-wrap border  shadow rounded-circle zoom-in">
                  <img src="../storage/{{Auth::user()->avatar}}" class="thumbnail icon-sm shadow border rounded-circle">
                  <span class="notify p-2 round shadow-lg mr-1 border solid border-success mt-2 ml-0 "
                  style="background-color: lightgreen!important"></span>
                  <i class="fa fa-caret-down card-product text-dark "style=" size: 18px; z-index: 1; position: absolute; top: 45px;left: 16px "></i>
                </div>

              </div>
            </a>
            <!-- DROPDOWN USER SECTION -->
            <ul class="dropdown-menu dropdown-menu-right text-left shadow-lg  px-3 py-4 my-2 mx-2 " role="menu" >
                 <!--  <li class="text-center p-0 m-0 dropdown-link">
                   <img src="../storage/{{Auth::user()->avatar}}" class="thumbnail solid border-dark icon-md shadow-lg border rounded-circle">
                 </li> -->
                <!--  <span class=" p-2 round badge badge-sm shadow-lg mb-5 border solid border-success "
                 style="background-color: lightgreen!important; size: 9px; z-index: 1; position: absolute; top: 20%;left: 38%"><small class="text-dark">Connecté</small></span> -->

                 
                 
                 <li class="dropdown-link"><a href="{{route('users.edit')}}" class="p-2 b "><i class="fa fa-user mr-2"> </i>Mon Compte</a></li>

                 @if(auth()->user()->role_id === 3 || auth()->user()->role_id === 1)
                 <li class="dropdown-link">
                  <a href="/admin" target="_blank" class="b  p-2 m-0">
                    <i class="fa fa-store mr-2"></i>Ma Boutique
                  </a>
                </li>
                @endif
                @if(auth()->user()->role_id === 4 || auth()->user()->role_id === 1 )
                <li class="dropdown-link">
                 <a href="/delivery" class="b p-2 m-0">
                  <i class="fa fa-truck mr-2"></i>Livraison
                </a>
              </li>
              <li class="dropdown-link"><a class="b p-2 m-0" href="/vendre"><i class="fa fa-caret-right mr-2"> </i>Vendre</a> </li>
              <li class="dropdown-link" ><span data-href="/tasks" id="export" class="btn btn-success btn-sm" onclick="exportTasks(event.target);">Export CSV</span></li>
              @endif

              <li class=" zoom-wrap mt-2">
                <a class="text-danger  shadow zoom-in  text-danger" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Deconnexion <span class="fa fa-power-off mr-2"></span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>
          </ul>
        </div>  <!-- widget-header .// -->

              <!--   <a   href="{{route('users.edit')}}" class="widget-header m-0 pl-2 pt-2 p-0 " style="display: inline-flex;">
                  <div class="icon zoom-wrap d-flex">
                    <div class=" zoom-in">
                      
                        <i class="icon-sm  text-danger  fa fa-wallet"></i>
                        <span class="text-danger b  ml-0 ">
                            
                            <a href="#"  class="shadow small btn-sm rounded btn btn-light bg-danger">
                              Solde <br>
                              <hr class="bg-light m-0 p-0">
                              <span class="b text-light">100000 FCFA <br></span>
                              </a>
                        </span>
                    </div>

                  </div>
                </a> -->


                @else

                <a href="/login" class="m-0 p-2 p-0 ">
                  <div class="icontext">
                    <div class="icon ">
                      <i class="icon-sm rounded-circle border shadow border-dark text-dark fa fa-user"></i>
                    </div>
                    <div class="text pl-3 d-none d-md-block">
                      <small class="text-muted">Identifiez-vous</small>
                      <small class=" text-danger b">
                        Compte 
                        
                      </small>
                    </div>
                  </div>
                </a>

                
                @endif
                
              </div> <!-- widgets-wrap.// -->
            </div> <!-- col.// -->
            
          </div> <!-- row.// -->
        </div> <!-- container.// -->
      </section> <!-- header-main .// -->
      
      <!--============================ NAVBAR COLLAPSE =========================   -->
      <nav id="navbar_top" class="navbar navbar-expand-md navbar-light navbar-inverse bg d p-0 m-0 shadow "  >
        <!-- Formulaire de recherche mobile -->
      
        <div class="col m-0" > 
          <form  action="{{ route('search.search') }}" class=" m-0 p-0 d-block d-md-none" method="GET" style="display: inline;">
            <div class="form-group"> 
                <div class="input-group"> 
                     <input type="search" name="search" required="required" minlength="3" class="rounded pt-4 pb-4 w-100   m-0  form-control " placeholder="Qu'est ce qui vous ferais envie ?" autocomplete="{{ request()->input('search')}}" value="{{request()->input('search') ?? '' }}" style="border: none!important;" >
                      <button type="submit" class="btn m-auto pr-3 pl-3 m-auto" style="border: none!important; border-bottom: 3px;" >
                        <i class="fa fa-search text-danger rounded b"></i>
                      </button>
                       <button class="navbar-toggler p-2 " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}" style="border: none!important; border-bottom: 3px;" >
                    <span class="navbar-toggler-icon m-0 p-0"></span>
                  </button>
                </div>
            </div>
          </form>
        </div>
        {{ menu('main', 'partials.menus.main') }}
      </nav>

      

    </header>


    @endsection





