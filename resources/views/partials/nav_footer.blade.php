<nav class="nav navbar shadow-lg d-block d-md-none m-0 p-0  fixed-bottom m-auto text-lowercase" >
	<ul class="nav navbar d-flex justify-content-around text-center shadow-lg p-0 bg " style="font-size: 12px">
		<li class="nav-item">
			<a href="/" class="nav-link m-auto @if(URL::current() == url('/')) text-danger @else  text-muted  @endif   text-center">
				<i class="fa fa-home">	</i><br>Accueil
			</a>
		</li>
		<li class="nav-item">
			<a href="/category" class="nav-link m-auto @if(URL::current() == url('/category')) text-danger @else  text-muted  @endif  text-center">
				<i class="fa fa-list">	</i><br>Catégories
			</a>
		</li>
		<li class="nav-item">
			<a href="/cart" class="nav-link m-auto @if(URL::current() == url('/cart')) text-danger @else  text-muted  @endif  text-center">
				<i class="fa fa-shopping-cart">	</i>
				<span class="badge  badge-success round ">{{Cart::instance('default')->count()}}</span><br>Panier
			</a>
		</li>
		<li class="nav-item">
			<a href="/compte" class="nav-link m-auto @if(URL::current() == url('/compte')) text-danger @else  text-muted  @endif  text-center">
				<i class="fa fa-user">	</i><br>Compte
			</a>
		</li>
		
	</ul>
</nav>
