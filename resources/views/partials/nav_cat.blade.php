

<!-- MOBILE NAVIGATION CUSTOM -->
  <div class="table-responsive nav  d-block d-md-none">
    <ul class="d-flex nav-navbar p-0 m-0 " style="list-style-type: none;">
      @foreach( $category = DB::table('category')->get() as $cat)
      <i class="fa fa-caret-right text-muted p-1 m-auto"></i>
      <a href="category?category={{$cat->slug}}">
        <li class="nav-link  m-auto " align="center">
          <p style="font-size: 9px" class=" text-truncate mr-auto text-muted " >
          <img src="storage/{{$cat->cat_img}}" class="img-xs pr-2">
            <!-- <img src"logo.png" class="icon icon-wrap shadow rounded-circle border border-danger solid p-3 m-2"> -->
           
              {{$cat->name}}</p>

        </li>
      </a>
      <!-- <i class="fa fa-caret-right text-danger fa-2x mr-3 m-2"></i> -->
      @endforeach
    </ul>
  </div>




