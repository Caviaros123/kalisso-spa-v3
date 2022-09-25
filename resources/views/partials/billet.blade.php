

<!-- // nav Menu tab -->  

<div class="padding-y-sm text-light" style="background-image: url('img/bg7.jpg') ; background-attachment: fixed;background-position: center; background-size: cover;">
	<div align="center">
		<h3>Partez avec - <img src="kalisso.png" class="mb-2" style="width: 100px">. <span class="b ">Voyages</span></h3>
	</div>
	<div class="container  my-5">
	
			
			<div class="col-12 bg rounded">
				<nav>
				  <div class="nav nav-tabs " id="nav-tab" role="tablist">
				    <a class="nav-link active show pr-3 pl-3 btn btn-danger b h1" id="nav-home-tab" data-toggle="tab" href="#nav-bus" role="tab" aria-controls="nav-home" aria-selected="true"> <i class="fa fa-bus mr-2 fa-1x"></i>BUS</a>
				    <a class=" nav-link pr-3 pl-3 b btn btn-danger" id="nav-profile-tab" data-toggle="tab" href="#nav-vols" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-plane mr-2 fa-1x"></i>VOL</a>
				    <a class=" nav-link pr-3 pl-3 b btn btn-danger" id="nav-contact-tab" data-toggle="tab" href="#nav-hotels" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fa fa-hotel mr-2 fa-1x"></i>HOTEL</a>
				  </div>
				</nav>
				<div class="tab-content m-0 p-0 " id="nav-tabContent">
					  <div class="tab-pane fade show active m-0 p-0" id="nav-bus" role="tabpanel" aria-labelledby="nav-home-tab">
					  	
					  		<div class="py-3" >
					  			<form method="POST" action="{{route('reservation.search') }}" class="m-0 p-0">
					  				@csrf
    				  				<div class="b h6 text-muted">
    						  			<p>Réservez un billet de bus n'a jamais été aussi simple </p>
    						  		</div>
                                    <div class="row-sm mb-2">
                                         <div class="mr-auto col-sm-6 col-6 mb-3">
                                                <label class="text-muted">Je cherche un bus:</label>
                                                <select name="status" class="custom-select ">
                                                    <option selected value="aller-retour">Aller-retour</option>
                                                    <option value="aller-simple">Aller simple</option>
                                                  
                                                </select>
                                            </div>
                                            <div class="mr-auto col-sm-6 col-6 mb-3">
                                                <label class="text-muted">pour:</label>
                                                <select name="places" class="custom-select ">
                                                    <option selected="" hidden="">Places</option>
                                                    @for($i = 1; $i < 11 ; $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                    </div>
                                    <div class="container ">
                                            
                                        <div class="row-sm">
                                        
                                            <div class="form-group col-md-6">
                                                <div class="input-group">
                                                    
                                                   <!-- <input type="text"  id="txt-pickup" name="from" placeholder="Départ" class="col-5 rounded shadow m-0  border boder-danger solid form-control-lg " required="Votre ville de depart">-->

<select id="txt-pickup"  required="required" placeholder="Départ" class="col-5 rounded shadow m-0  border boder-danger solid form-control-lg custom-select" name="from">
            <option hidden >Départ  :</option>
            <option value="brazzaville">Brazzaville</option>
            <option value="pointe-noire">Pointe-Noire</option>
            <option value="dolisie">Dolisie</option>
            <option value="sibiti">Sibiti</option>
          </select>

                                                        <span class="btn btn-danger m-auto" >
                                                           <i class="fa fa-exchange-alt m-0 p-0 m-auto"></i>
                                                        </span>
                                         
                                       <select id="txt-destination" required="required" placeholder="Arrivée" class="col-5 rounded shadow m-0  border boder-danger solid form-control-lg custom-select " name="to">
            <option hidden >Arrivée  :</option>
            <option value="brazzaville">Brazzaville</option>
            <option value="pointe-noire">Pointe-Noire</option>
            <option value="dolisie">Dolisie</option>
            <option value="sibiti">Sibiti</option>
          </select>            
                                                    

                                                  <!--  <input type="text" id="txt-destination" name="to" placeholder="Arrivée" class="col-5  rounded shadow m-0  border boder-danger solid form-control-lg" required> -->
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group">
                                                  
                                                            
                                                    <input type="date" name="date" id="datePickerId"  class="col-sm-12 rounded shadow border boder-danger solid form-control-lg mb-4 " required>
                                                        
                                               
                                                    <button type="submit" name="bus" class="btn bg-success col-sm-12 form-control-lg px-5  p-2 ">
                                                        <i class="fa fa-search text-light"></i>
                                                    </button>
                                               
                                            
                                            </div>
                                        </div>
                                    </div>
                                    </div>

					  			</form>
					  		</div>


					  </div>
					  <div class="tab-pane fade" id="nav-vols" role="tabpanel" aria-labelledby="nav-profile-tab">
					  	<div class=" padding-y-sm" align="left">
				  				<div class="b h6 text-muted">
						  			<p>Réservez un billet d'avion n'a jamais été aussi simple </p>
						  		</div>
					  			<form method="POST" action="{{route('reservation.search') }}"><!-- , request()->input('vol') ? request()->input('vol') : ''  -->
					  				@csrf
					  				<div class="form-group">
					  					<div class="input-group">
					  						<input type="text"  id="txt-pickup2" name="from" placeholder="Départ" class=" mb-2 rounded shadow border boder-danger solid form-control-lg mr-2" required="Votre ville de depart">
					  						<span id="swap2"  class="btn btn-md pt-2 mr-2" >
					  							<i class="fa fa-exchange-alt"></i>
					  						</span>
					  						<input type="text"  id="txt-destination2" name="to" placeholder="Arrivée" class=" mb-2 rounded shadow border boder-danger solid form-control-lg mr-2" required>
					  						<input type="date" name="date" id="datePickerId2"  class=" rounded shadow border boder-danger solid form-control-lg mb-2 mr-2" required>

					  						<button type="submit" name="vol" class="btn bg-success btn-md">
					  							<i class="fa fa-search text-light"></i>
					  						</button>
					  					</div>
					  				</div>	
					  			</form>
					  		</div>

					  </div>
					  <div class="tab-pane fade" id="nav-hotels" role="tabpanel" aria-labelledby="nav-contact-tab">
					  		<div class=" padding-y-sm" align="left">
				  				<div class="b h6 text-muted">
						  			<p>Réservez un hôtel n'a jamais été aussi simple </p>
						  		</div>
					  			<form method="POST" action="{{route('reservation.search') }}"><!-- , request()->input('vol') ? request()->input('vol') : ''  -->
					  				@csrf
					  				<div class="form-group">
					  					<div class="input-group">
					  						<input type="text"  id="txt-pickup2" name="from" placeholder="Départ" class=" mb-2 rounded shadow border boder-danger solid form-control-lg mr-2" required="Votre ville de depart">
					  						<span id="swap3"  class="btn btn-md pt-2 mr-2" >
					  							<i class="fa fa-exchange-alt"></i>
					  						</span>
					  						<input type="text"  id="txt-destination3" name="to" placeholder="Arrivée" class=" mb-2 rounded shadow border boder-danger solid form-control-lg mr-2" required>
					  						<input type="date" name="date" id="datePickerId3"  class=" rounded shadow border boder-danger solid form-control-lg mb-2 mr-2" required>

					  						<button type="submit" name="hotel" class="btn bg-success btn-md">
					  							<i class="fa fa-search text-light"></i>
					  						</button>
					  					</div>
					  				</div>	
					  			</form>
					  		</div>
					  </div>
				</div>
			</div>

	


	</div>
	
</div>


@section('js')
<script type="text/javascript">

    datePickerId.min = new Date().toISOString().split("T")[0];
    datePickerId2.min = new Date().toISOString().split("T")[0];
    datePickerId3.min = new Date().toISOString().split("T")[0];

    $(document).ready(function (){
     
        $("#swap").on('click',function(){
            var pickup = $('#txt-pickup').val();
            $('#txt-pickup').val($('#txt-destination').val());
            $('#txt-destination').val(pickup);
            
            
        });
        
    });

     $(document).ready(function (){
     
        $("#swap2").on('click',function(){
            var pickup = $('#txt-pickup2').val();
            $('#txt-pickup2').val($('#txt-destination2').val());
            $('#txt-destination2').val(pickup);
            
            
        });
        
    });

      $(document).ready(function (){
     
        $("#swap3").on('click',function(){
            var pickup = $('#txt-pickup3').val();
            $('#txt-pickup3').val($('#txt-destination3').val());
            $('#txt-destination3').val(pickup);
            
            
        });
        
    });

</script>


@stop




