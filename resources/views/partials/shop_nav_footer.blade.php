<nav class="nav navbar shadow-lg d-block d-md-none m-0 p-0  fixed-bottom m-auto text-lowercase" >
	<ul class="nav-navbar row-sm text-center shadow-lg p-0 bg m-auto " style="font-size: 12px">
		
			<li class="nav-item m-auto col-2"><a href="/cart" class="nav-link m-auto text-muted text-center"><i class="fa fa-shopping-cart">	</i>
			<span class="notify bg-success round b round mt-2 ml-0 mr-3">{{Cart::instance('default')->count()}}</span></a></li>

			
			<li class="nav-item p-2 col-5">
				<button type="submit"  onclick="getElementById('SubForm').submit()" class="nav-link btn btn-outline-success m-0  text-muted  text-center">Ajoutez Panier</button>
			</li>
			<li class="nav-item p-2 col-5">
				<button type="submit"  onclick="getElementById('SubForm_checkout').submit()" class="nav-link btn btn-outline-warning m-0  text-muted text-center">Commandez</button>
			</li>

			


		
	</ul>
</nav>