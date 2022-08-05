<?php 
    
    if (auth()->user()->role_id == 1) {
        $data = \App\Groupe::all();
    }else{
        $data = \App\Groupe::where('day' , '!=', 0)->where('type' , 'carte')->get();
    }

 ?>

<div class="modal fade" id="modal-deposit">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Nouveau dépot</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if(!request()->is('scorecard/all/account/group'))
            <form action="{{route('carte.deposit')}}" method="POST" role="form">
                @csrf
                @method('PUT') 
                <div class="modal-body">

                 
                    <div  id="alert" hidden align="center" class="bagde badge-danger text-center shadow my-4 rounded px-3 py-2 text-light b h5">
                        
                    </div>
                    <div class="s2-example">
                        <label>Choisir le membre</label><br>
                        <select  id="scorecard_deposit_get_user" name="user_id" class="js-example-basic-single" >
                            <option></option>
                            @forelse(\App\Carte::where('day' , '!=', 0)->get() as $item)
                                @foreach(\App\Models\User::where('id', $item->user_id)->get() as $user)
                                <option  value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            @empty
                                <option  selected >Aucun groupe disponible</option>
                            @endforelse
                        </select>
                    </div>
                    <br>
                    <div class="form-group mb-3">
                        
                     <div class="input-group d-flex" >
                        <div class="col-6">
                            <label>Solde de la carte:</label>
                            <h2 id="scorecard_deposit_user_amount" class="form-control bg-warning rounded shadow b text-light">0 Fcfa</h2>
                        </div>
                        <div class="col-6">
                            <label>Montant de versement fixe:</label>
                            <h2 id="scorecard_deposit_user_amount_fixed" class="form-control bg-danger rounded shadow b text-light">0 Fcfa</h2>
                        </div>
                        <!-- <input type="number" minlength="3" id="user_amount" value="" min="500" name="user_amount" class="form-control" placeholder="Soldes" required> -->
                    </div>
                    
                </div>
                <div class="input-group mb-3" hidden>
                    <input type="tel" name="code" hidden class="form-control" minlength="9" maxlength="12" value="{{ 'M'.date('dmY').'C'.rand(0,999).'A'}} " readonly placeholder="ID" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-code"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="row"><label>Montant du dépot </label><h5 id="case" class="b  ml-2 mr-2">0</h5> | <h5 id="case2" class="b  ml-2">0</h5></div>
                    
                    <div class="input-group">
                        <input type="number" name="amount" id="deposit_amount" class="form-control-lg form-control"  placeholder="" min="" max="" required="required">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-money-bill"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger shadow" data-dismiss="modal">Annuler</button>

                <div class="col-4">
                    <!-- HIDDEN INPUT -->
                    <input type="text" name="created_by" value="{{ auth()->id() }}" hidden="hidden">

                    <button type="submit" id='deposit_submit' name="submit" value="scorecard_deposit" required="required" class="btn btn-success shadow btn-block">Créer</button>
                </div>
            </div>
        </form>
        @else

        <form action=" {{route('carte.group.deposit')}} " method="POST" role="form">
            @csrf
            @method('PUT') 
            <div class="modal-body">
                <div  id="group_alert" hidden align="center" class="bagde badge-danger text-center shadow my-4 rounded px-3 py-2 text-light b h5">
                    
                </div>
                <div class="form-group s2-example">
                    <label>Choisir le groupe</label><br>
                    <select  id="group_scorecard_deposit_get_user" name="user_id" class="form-control js-example-basic-single" >
                        <option></option>
                        @forelse($data as $item)
                            
                            <option  value="{{$item->id}}">{{$item->name}}</option>

                        @empty
                            <option  selected >Aucun groupe disponible</option>
                        @endforelse
                    </select>
                </div>
                <div class="form-group mb-3">
                    
                 <div class="input-group d-flex" >
                    <div class="col-6">
                        <label>Solde de la carte:</label>
                        <h2 id="group_scorecard_deposit_user_amount" class="form-control bg-warning rounded shadow b text-light">0 Fcfa</h2>
                    </div>
                    <div class="col-6">
                        <label>Montant de versement fixe:</label>
                        <h2 id="group_scorecard_deposit_user_amount_fixed" class="form-control bg-danger rounded shadow b text-light">0 Fcfa</h2>
                    </div>
                    <!-- <input type="number" minlength="3" id="user_amount" value="" min="500" name="user_amount" class="form-control" placeholder="Soldes" required> -->
                </div>
                
            </div>
            <div class="input-group mb-3" hidden>
                <input type="tel" name="code" hidden class="form-control" minlength="9" maxlength="12" value="{{ 'M'.date('dmY').'C'.rand(0,999).'A'}} " readonly placeholder="ID" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-code"></span>
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <label>Montant du dépot <h2 id="case" class="b h3 ml-2"></h2></label>
                <div class="input-group">
                    <input type="number" name="amount" id="group_deposit_amount" class="form-control-lg form-control"  placeholder="Choisissez un groupe" min="" max="" required="required">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-money-bill"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger shadow" data-dismiss="modal">Annuler</button>

            <div class="col-4">
                <!-- HIDDEN INPUT -->
                <input type="text" name="created_by" value="{{ auth()->id() }}" hidden="hidden">

                <button type="submit" id='group_deposit_submit' name="submit" value="scorecard_group_deposit" required="required" class="btn btn-success shadow btn-block">Créer</button>
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
@section('deposit_css')

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
@section('deposit_js')

<script type="text/javascript">
    $("#deposit_amount").attr('readonly', 'readonly');
    $("#deposit_amount").attr('placeholder', 'Veuillez choisir un membre ');

    $("#deposit_amount").change(function () {
     var nb = $(this).val();
     $("#case2").text(nb / amount_fixed); 
 });


    $("#scorecard_deposit_get_user ").change(function(){
        var id = $(this).val();
        $("#deposit_amount").attr('placeholder', '');
        $("#deposit_amount").val('');

        axios.patch(`/user/carte/${id}`)
        .then(function (response) {
            var data = JSON.parse(response.data.data);
            var status = data.status;
            var amount =  data.amount;
            var amount_fixed = data.amount_fixed;
            
            if (data.amount > 500) {
             $("#deposit_amount").removeAttr('readonly');
             $("#scorecard_deposit_user_amount").text(amount+ " Fcfa");
             $("#scorecard_deposit_user_amount_fixed").text(amount_fixed+ " Fcfa");
             $("#deposit_amount").attr('min', amount_fixed);
                //    $("#deposit_amount").attr('max', (amount_fixed *  ( 31 - (amount / amount_fixed))));
                $("#deposit_amount").attr('max', amount_fixed);
                $("#case").text("reste= " + (31 - (amount / amount_fixed)));
                $("#deposit_amount").attr('min', amount_fixed);
                $("#deposit_amount").attr('placeholder', 'Le montant du dépot doit être de '+amount_fixed+ " Fcfa");

                if (!status) {
                    $("#alert_deposit").text('Opération impossible cette carte n\'est plus active'); 
                    $("#alert_deposit").removeAttr('hidden'); 
                    $("#deposit_amount").attr('readonly', 'readonly');
                    $("#deposit_amount").attr('placeholder', 'Dépot impossible sur cette carte ');
                }else{
                    $("#alert_deposit").attr('hidden', 'hidden'); 
                }
                    // alert("LE SOLDE DE CETTE UTILISATEUR EST DE: "+ data.courant.toString()); 
                // alert("LE SOLDE DE CETTE UTILISATEUR EST DE: "+ response.data.data);
            }

            console.log(response);
            
        })
        .catch(function (error) {
            alert("CETTE UTILISATEUR N'EXISTE PAS OU N'A PAS ENCORE DE COMPTE: "+  error);
            console.log("Echec : "+ error);
            
        });

        
    });

    $("#group_deposit_amount").attr('readonly', 'readonly');

    $("#group_scorecard_deposit_get_user ").change(function(){
        var id = $(this).val();
        $("#group_deposit_amount").attr('placeholder', 'Montant du dépot');
        
        $("#group_deposit_amount").val('');
        $("#group_scorecard_deposit_user_amount").text("0");
        $("#group_scorecard_deposit_user_amount_fixed").text("0");

        axios.patch(`/user/carte/group/${id}`)
        .then(function (response) {
            if (response.data.data) {
                    var data = JSON.parse(response.data.data);
                    var courant =  data.amount.toString();
                    var epargne = data.epargne != null ? data.epargne : 0;

                    $("#group_scorecard_deposit_user_amount").text(courant+ " Fcfa");
                    $("#group_scorecard_deposit_user_amount_fixed").text(epargne+ " Fcfa");
                    $("#group_deposit_amount").removeAttr('readonly');
                    // alert("LE SOLDE DE CETTE UTILISATEUR EST INFERIEUR A 500 ET EST DE: "+ data);    
            }

            console.log(response);

        }).catch(function (error) {
                // alert("CETTE UTILISATEUR N'EXISTE PAS OU N'A PAS ENCORE DE COMPTE: "+  error);
                console.log("Echec : "+ error);
        });

        
    });

    
</script>


@stop