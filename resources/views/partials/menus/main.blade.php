<!-- debut des de la listes de Categogories de produits -->

<div class="collapse navbar-collapse" id="navbarSupportedContent">
 
  <ul class="navbar-nav" >
    <!-- li.position-static gets rid of relative position -->
    <li class="nav-item  p-2 ">
      <a href="#" class="nav-link show d-none d-md-block solid border-muted border dropdown-toggle" data-toggle="dropdown" data-target="#">
        <i class="fa fa-list-ul mr-2"></i> Toutes Les Catégories
      </a>
      <!-- div.w-100 make it mega menu, div.top-auto opens the mega menu exactly as position like other normal menu -->
      <div class="dropdown-menu fade w-50  border solid border-muted ml-4 shadow-lg top-auto" >
       
          <!-- div.w-100 is also needed in certain circumstances to make this menu a mega menu -->
          <div class="row w-100">
            <!-- Start mega menu column -->
            <div class="col-md-12"> 
              <div class="dropdown-header b bg-danger rounded b text-light">Habillement | Accessoires </div>
              <div class="dropdown-divider"></div>
              <div class="row">
                <div class="col-md-4">
                  <ul class="nav navbar-nav m-auto">
                   @foreach( $category = DB::table('category')->get() as $cat)
                   <li class="nav-item p-0">
                    <a class="dropdown-item" href="category?category={{$cat->slug}}"> {{$cat->name}}</a></li>
                    @endforeach
                  </ul> 
                </div>

              </div>
            </div>
            <!-- end mega menu column -->
          </div>

       
      </div>
    </li>
    <ul class="navbar-nav p-2  m-right zoom-wrap">
      <li class="nav-item"><a class="nav-link" href="/reservation">Voyages</a></li>
      @foreach($items as $menu_item)
      <li  class="nav-item">
        <a class="nav-link  p-xs-3" href="{{ $menu_item->link() }}">
          {{$menu_item->title}}

        </a>
      </li>
      @endforeach
    </ul>
    
  </ul>
</div>









