<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            @if (request()->is('all/carte/account'))
                <div class="modal-header">
                    <h4 class="modal-title text-uppercase">Nouvelle carte de pointage</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('carte.store')}}" method="post">
                    @csrf
                        <div class="modal-body">
                            <div class="s2-example form-group">
                                <label>Choisir le membre</label><br>
                                <select name="user_id" class="js-example-basic-single " required>
                                    <option></option>
                                    @foreach(\App\Models\User::all() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Montant fixé à :</label>
                                <div class="input-group mb-3">
                                    <input type="number" minlength="3" id="d_amount_fixed" min="500" name="amount_fixed" class="form-control" placeholder="Montant" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-money-bill"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3" hidden>
                                <input type="tel" name="code" class="form-control" minlength="9" maxlength="12" value="{{ 'M'.date('dmY').'C'.rand(100,999).'A'}} " readonly placeholder="ID" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-code"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <input type="tel" name="day" autocomplete="false" class="form-control"  readonly placeholder="30 jours" step="30" value="31" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Versement</label>
                                <div class="input-group">
                                    <input type="number" name="amount" id="d_amount" class="form-control" min="500"  placeholder="Premier versement" value="" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>

                            <div class="col-4">
                                <!-- HIDDEN INPUT -->
                                <input type="text" name="created_by" value="{{ auth()->id() }}" hidden="hidden">

                                <button type="submit" name="submit" value="submit_scorecard" required="required" class="btn btn-success btn-block">Créer</button>
                            </div>
                        </div>
                </form>

            @elseif (request()->is('scorecard/all/account/group'))

                <div class="modal-header">
                    <h4 class="modal-title text-uppercase">Nouveau groupe de carte</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                    <form action="{{route('carte.group.store')}}"  method="post">
                        @csrf
                        <div class="modal-body">


                                <div class="input-group mb-3">
                                    <input type="text" name="name" class="form-control" placeholder="Nom du groupe" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row d-flex justify-content-center mt-100">
                                        <div class="col-md-12 "> 
                                            <select id="choices-multiple-remove-button" name="user_id[]" class="form-control " placeholder="Selectionnez 3 leaders" multiple required="required">
                                                @foreach(\App\Models\User::all() as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select> 
                                        </div>
                                        
                                    </div>
                                    {{-- <select name="user_id" class="form-control " required>
                                        <option hidden selected>Choisir un membre</option>
                                        @foreach(\App\Models\User::all() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select> --}}
                                </div>
                                 <div class="form-group mb-3">
                                    <label>Montant fixé à :</label>
                                    <div class="input-group mb-3">
                                        <input type="number" minlength="3" id="d_amount_fixed" min="500" name="amount_fixed" class="form-control" placeholder="Montant" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fa fa-money-bill"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3" hidden>
                                    <input type="tel" name="code" class="form-control" minlength="9" maxlength="12" value="{{ 'MCA'.date('dmYHms')}} " readonly placeholder="ID" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-code"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="tel" name="day" autocomplete="false" class="form-control"  readonly placeholder="30 jours" step="30" value="31" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Versement</label>
                                    <div class="input-group">
                                        <input type="number" name="amount" id="d_amount" class="form-control" min="500"  placeholder="Premier versement" value="" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>

                            <div class="col-4">
                                <!-- HIDDEN INPUT -->
                                <input type="text" name="created_by" value="{{ auth()->id() }}" hidden="hidden">

                                <button type="submit" name="submit" value="submit_scorecard_group" required="required" class="btn btn-success btn-block">Créer</button>
                            </div>
                        </div>
                </form>
       
            @endif
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<!-- /.modal -->

@section('default_css')

<style>
/* Customize the label (the container) */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: brown;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.container .checkmark:after {
  top: 9px;
  left: 9px;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: white;
}
</style>


@stop



@section('default_js')

 <script type="text/javascript">
    $("#default_amount").attr('readonly', 'readonly');
    $("#default_amount").attr('placeholder', 'Veuillez choisir un membre ');
    
    $("#scorecard_default_get_user").change(function(){
        var id = $(this).val();
        $("#default_amount").attr('placeholder', '');
        
        $("#default_amount").val('');

        axios.patch(`/user/carte/${id}`)
        .then(function (response) {
            var data = JSON.parse(response.data.data);
            var status = data.status;
            var amount =  data.amount;
            var amount_fixed = data.amount_fixed;

            if (data) {
                   
                   $("#default_amount").removeAttr('readonly');
                   $("#scorecard_default_user_amount").text(amount+ " Fcfa");
                   $("#scorecard_default_user_amount_fixed").text(amount_fixed+ " Fcfa");
                   $("#default_amount").attr('max', amount_fixed);
                   $("#default_amount").attr('min', amount_fixed);
                   $("#default_amount").attr('placeholder', 'Le montant du retrait sera de '+(amount - amount_fixed)+ " Fcfa");
                    if (!status) {
                        $("#alert").text('Opération impossible cette carte n\'est plus active'); 
                        $("#alert").removeAttr('hidden'); 
                        $("#default_amount").attr('readonly', 'readonly');
                        $("#default_amount").attr('placeholder', 'Retrait impossible sur cette carte ');
                    }else{
                        $("#alert").attr('hidden', 'hidden'); 
                    }
                    // alert("LE SOLDE DE CETTE UTILISATEUR EST DE: "+ data.courant.toString()); 
                // alert("LE SOLDE DE CETTE UTILISATEUR EST DE: "+ response.data.data);
            }

            console.log(data);
        
        })
        .catch(function (error) {
            alert("CETTE UTILISATEUR N'EXISTE PAS OU N'A PAS ENCORE DE COMPTE: "+  error);
            console.log("Echec : "+ error);
            
        });

  
    });
  </script>


@stop


