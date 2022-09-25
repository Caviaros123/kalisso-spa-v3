<ul class="nav mr-auto d-none d-md-flex">
	<li class="nav-item px-4 mt-1 text-light">Suivez nous sur: </li>

	@foreach($items as $menu_item)
	<li class="navbar-item"><a class="nav-link mt-1 text-light" href="{{ $menu_item->link() }}"><i class="fab {{$menu_item->title}}"></i></a></li>
	@endforeach
	
	
</ul>