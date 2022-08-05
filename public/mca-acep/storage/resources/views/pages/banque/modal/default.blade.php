 <?php
 if (auth()->user()->role_id == 1) {
    $data = App\Models\User::all();
}else{
    $data = App\Models\User::where('id', '!=', '1')->get();
}
?>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            @if(!request()->is('bank/group/account'))
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Nouveau compte</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{route('bank.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="s2-example form-group">
                        <label>Choisir le membre: </label><br>
                        <select name="user_id" class="js-example-basic-single " required >
                            <option></option>
                            @foreach($data as $item)
                                <option value="{{$item->id}}" >{{$item->name}}</option>
                            @endforeach
                        </select>

                    </div>
                
                    <div class="input-group mb-3">
                        <input type="text" name="soldes" class="form-control" placeholder="1er versement" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fa fa-money-bill"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3" hidden="hidden">
                        <input type="tel" name="account_id" class="form-control" minlength="9" maxlength="12" value="{{ 'MCA'.date('dmYHms')}}" readonly placeholder="ID" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-code"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="text-center b h5 text-uppercase py-2">Choisissez le compte de versement</div>
                        <div class="input-group d-flex">
                            <div class="col-6">
                                <label for="add_type1" class="container">Compte courant
                                    <input type="radio" name="account_type" value="1" id="add_type1" checked required>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-6">
                                <label for="add_type2" class="container">Compte epargne
                                    <input type="radio" name="account_type" value="2" id="add_type2"  required>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3" hidden="hidden">
                        <input type="text" autocomplete="false" class="form-control" placeholder="Créer par" readonly value="Créer par {{auth()->user()->name}}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>

                    <div class="col-4">
                        <!-- HIDDEN INPUT -->
                        <input type="text" name="created_by" value="{{ auth()->user()->id ?? 0}}" hidden="hidden">

                        <button type="submit" id='submit_new_user' required="required" name="submit" value="bank_create_account" class="btn btn-success btn-block">Créer</button>
                    </div>
                </div>
            </form>
            @else
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Nouveau compte de groupe</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('bank.group.store')}}" method="post">
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
                            <select  name="user_id[]" class="form-control choices-multiple-remove-button" placeholder="Selectionnez 3 leaders" multiple required="required">
                                @foreach($data as $item)
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
                        <div class="input-group mb-3">
                            <input type="text" name="soldes" class="form-control" placeholder="1er versement" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fa fa-money-bill"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="text-center b h5 text-uppercase py-2">Choisissez le compte de versement</div>
                            <div class="input-group d-flex">
                                <div class="col-6">
                                    <label for="add_type1" class="container">Compte courant
                                        <input type="radio" name="account_type" value="1" id="add_type1" checked required>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <label for="add_type2" class="container">Compte epargne
                                        <input type="radio" name="account_type" value="2" id="add_type2"  required>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3" hidden="hidden">
                            <input type="text" autocomplete="false" class="form-control" placeholder="Créer par" readonly value="Créer par {{auth()->user()->name}}" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="text-center b h5  text-uppercase py-2">Numéro de compte</div>

                            <input type="text" name="account_id" class="form-control border-none text-center"  value="{{ 'MCA'.date('Hms')}}" readonly placeholder="ID" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>

                        <div class="col-4">
                            <!-- HIDDEN INPUT -->
                            <input type="text" name="created_by" value="{{ auth()->user()->id ?? 0}}" hidden="hidden">

                            <button type="submit" id="submit_new_user" name="submit" value="bank_create_group_account" required="required" class="btn btn-success btn-block">Créer</button>
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
    