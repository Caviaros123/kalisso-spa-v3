<div class="modal fade" id="edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Modifier le compte</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{route('bank.update')}}" method="post">
                    @csrf
                     <div class="form-group">
                        <label>Choisir le membre</label>
                        <select name="user_id" class="form-control " disabled="disabled" required>
                            <option hidden selected>Choisir un membre</option>
                            @foreach(\App\Models\User::all() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
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
                        <input type="tel" name="account_id" class="form-control" minlength="9" maxlength="12" value="{{ 'MCA'.date('dmY').rand(1,99999)}}" readonly placeholder="ID" required>
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

                    <button type="submit" id='submit' required="required" class="btn btn-success btn-block">Créer</button>
                </div>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
