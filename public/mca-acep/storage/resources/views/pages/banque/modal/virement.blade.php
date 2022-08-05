<div class="modal fade" id="modal-virement">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Transfert</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{route('carte.store')}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label>Choisir le membre</label>
                        <select name="user_id" class="form-control " required>
                            <option hidden selected>Choisir un membre</option>
                            @foreach(\App\Models\User::all() as $item)

                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Montant fixé à :</label>
                        <div class="input-group mb-3">
                            <input type="number" minlength="3" id="amount_fixed" min="500" name="amount_fixed" class="form-control" placeholder="Montant" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fa fa-money-bill"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="tel" name="code" class="form-control" minlength="9" maxlength="12" value="{{ 'M'.date('dmY').'C'.rand(0,999).'A'}} " readonly placeholder="ID" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-code"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="number" name="day" autocomplete="false" class="form-control" min="0" placeholder="Créer par" step="30" value="30" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Solde</label>
                        <div class="input-group">
                            <input type="number" name="amount" id="amount" class="form-control" readonly placeholder="Soldes actuel" value="" required>
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