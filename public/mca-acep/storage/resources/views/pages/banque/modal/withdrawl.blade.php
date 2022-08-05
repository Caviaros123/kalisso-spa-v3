<?php
if (auth()->user()->role_id == 1) {
    $data = \App\Banque::all();
}else{
    $data = \App\Banque::where('id', '!=', '1')->get();
}
?>
<div class="modal fade " id="modal-withdrawl">
    <div class="modal-dialog ">
        <div class="modal-content bg-warning">
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Nouveau retrait</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if(!request()->is('bank/group/account'))
             <form action="{{route('bank.deposit') }}" method="POST">
                    @csrf
                    @method('PUT')  
                    <div class="modal-body">
                        <div class="s2-example form-group">
                            <label>Choisir le membre</label><br>
                            <select id="withdrawl_get_user" name="user_id" class=" js-example-basic-single form-control" required="required" >
                                <option></option>
                                @foreach($data as $item)
                                    @foreach(\App\Models\User::where('id', $item->user_id)->get() as $user)
                                        <option  value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            
                            <div class="input-group d-flex" >
                                <div class="col-6">
                                    <label>Solde Courant:</label>
                                    <h2 id="withdrawl_user_amount_courant" class="form-control bg rounded shadow b h1 text-danger">0 Fcfa</h2>
                                </div>
                                <div class="col-6">
                                    <label>Solde Epargne:</label>
                                    <h2 id="withdrawl_user_amount_epargne" class="form-control bg rounded shadow b h1 text-danger">0 Fcfa</h2>
                                </div>
                                <!-- <input type="number" minlength="3" id="user_amount" value="" min="500" name="user_amount" class="form-control" placeholder="Soldes" required> -->
                            </div>
                        </div>
                        <div class="input-group mb-3" hidden>
                            <input type="tel" name="code" hidden class="form-control" minlength="9" maxlength="12" value="{{ 'M'.date('dmY').'C'.rand(0,999).'A'}} " readonly required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-code"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="text-center b h5 text-uppercase py-2">Type de retrait</div>
                            <div class="input-group d-flex">
                                <div class="col-6">
                                    <label for="type1" class="container">Compte courant
                                        <input type="radio" name="type" value="courant" id="type1" checked required>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <label for="type2" class="container">Compte epargne
                                        <input type="radio" name="type" value="epargne" id="type2"  required>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Montant du retrait | <span id="show_amount"></span></label>
                            <div class="input-group">
                                <input type="number" name="amount" id="withdrawl_amount" class="form-control-lg form-control"  placeholder="Minimum= 500 Fcfa" min="500" max="" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-money-bill"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>

                    <div class="col-4">
                        <!-- HIDDEN INPUT -->
                        <input type="text" name="created_by" value="{{ auth()->id() }}" hidden="hidden" required>
                        <button type="submit" id='withdrawl_submit' name="submit" value="bank_withdrawl" required="required" class="btn btn-success btn-block">Créer</button>
                    </div>
                </div>
            </form>
            @else

            <form action="{{route('bank.group.withdrawl') }}" method="POST">
            @csrf
            @method('PUT')
                <div class="modal-body">
                    <div class="form-group" >
                        <label>Choisir le groupe</label>
                        <div class="row d-flex justify-content-center mt-100">
                            <div class="col-md-12" style="color: black!important"> 
                                <select name="user_id" class="form-control  get_group_amount choices-multiple-remove-button" placeholder="Selectionnez le groupe" multiple required="required" >
                                    @foreach(\App\Groupe::all() as $item)
                                    <option  value="{{$item->id}}">{{$item->code}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">

                        <div class="input-group d-flex" >
                            <div class="col-6">
                                <label>Solde Courant:</label>
                                <h2 id="group_withdrawl_user_amount_courant" class="form-control bg rounded shadow b h1 text-danger">0 Fcfa</h2>
                            </div>
                            <div class="col-6">
                                <label>Solde Epargne:</label>
                                <h2 id="group_withdrawl_user_amount_epargne" class="form-control bg rounded shadow b h1 text-danger">0 Fcfa</h2>
                            </div>
                            <!-- <input type="number" minlength="3" id="user_amount" value="" min="500" name="user_amount" class="form-control" placeholder="Soldes" required> -->
                        </div>
                    </div>
                    <div class="input-group mb-3" hidden>
                        <input type="tel" name="code" hidden class="form-control" minlength="9" maxlength="12" value="{{ 'M'.date('dmY').'C'.date('Hms').'A'}} " readonly placeholder="ID" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-code"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="text-center b h5 text-uppercase py-2">Type de dépot</div>
                        <div class="input-group d-flex">
                            <div class="col-6">
                                <label for="withdrawl_type1" class="container">Compte courant
                                    <input type="radio" name="type" value="courant" id="withdrawl_type1" checked required>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-6">
                                <label for="withdrawl_type2" class="container">Compte epargne
                                    <input type="radio" name="type" value="epargne" id="withdrawl_type2"  required>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Montant du retrait | <span id="show_amount"></span></label>
                        <div class="input-group">
                            <input type="number" name="amount" id="withdrawl_amount" class="form-control-lg form-control"  placeholder="Minimum= 500 Fcfa" min="500" max="" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-money-bill"></span>
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

                        <button type="submit" id='withdrawl_submit' name="submit" value="bank_withdrawl" required="required" class="btn btn-success btn-block">Créer</button>
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

@section('withdrawl_css')



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
@section('withdrawl_js')

 <script type="text/javascript">
   $(document).ready(function(){

    $('#withdrawl_amount').on("keyup change", function () {
        var amount = $(this).val();
        var max_amount = $(this).attr("max");
        var taxe = (amount * 3) / 100;
        var total_amount = parseFloat(amount) + parseFloat(taxe);

        // var total_amount = amount ;
        $('#show_amount').text(total_amount);

        if (total_amount <= max_amount) {
            $('#withdrawl_submit').show();
        }else{
            $('#withdrawl_submit').hide();
        }
    });


     $(".get_group_amount").change(function(){
        var id = $(this).val();
             
        axios.patch(`/bank/group/user/${id}`)
        .then(function (response) {
            if (response.data.data) {
                var data = JSON.parse(response.data.data);
                var courant =  data.amount.toString();
                var epargne = data.epargne != null ? data.epargne : 0;

                $('#withdrawl_submit').hide();
                $('#withdrawl_amount').attr("max", courant);

                $("#group_withdrawl_user_amount_courant").text(courant+ " Fcfa");
                $("#group_withdrawl_user_amount_epargne").text(epargne+ " Fcfa");

                // alert("LE SOLDE DE CETTE UTILISATEUR EST INFERIEUR A 500 ET EST DE: "+ data);    
            }

        })
        .catch(function (error) {
            alert("CETTE UTILISATEUR N'EXISTE PAS OU N'A PAS ENCORE DE COMPTE: "+  error);
            console.log("Echec : "+ error);
            
        });


    });



 
    $("#withdrawl_get_user").change(function(){
        var id = $(this).val();

        axios.patch(`/user/banque/${id}`)
        .then(function (response) {

                    var data = JSON.parse(response.data.data);
                    var courant =  data.courant.toString();
                    var epargne = data.epargne.toString();

                    $('#withdrawl_submit').hide();
                    $('#withdrawl_amount').attr("max", courant);
                    
                    $("#withdrawl_user_amount_courant").text(courant+ " Fcfa");
                    $("#withdrawl_user_amount_epargne").text(epargne+ " Fcfa");
                    
                    // alert("LE SOLDE DE CETTE UTILISATEUR EST INFERIEUR A 500 ET EST DE: "+ data);    
            
            // console.log(response);
        
        })
        .catch(function (error) {
            alert("CETTE UTILISATEUR N'EXISTE PAS OU N'A PAS ENCORE DE COMPTE: "+  error);
            console.log("Echec : "+ error);
            
        });

  
    });
});
  </script>


@stop