  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Profil </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
   
                     <div class="form-group card card-product">
                       <p>ID de l'utilisateur:<h4 class="b" id="user_id"></h4></p>
                       <hr class="my-2">
                       <p>Soldes Courant:<h4 class="b" id="user_amount_courant"></h4></p>
                       <hr class="my-2">
                       <p>Soldes Epargne:<h4 class="b" id="user_amount_epargne"></h4></p>
                       <hr class="my-2">
                       <p>Découvert:<h4 class="b" id="user_amount_decouvert"></h4></p>
                       <hr class="my-2">

                    </div>
                  
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

  <div class="modal fade" id="myModalProfile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Profil </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
   
                     <div class="form-group card card-product">
                       <p>ID de l'utilisateur:<h4 class="b" id="user_id"></h4></p>
                       <hr class="my-2">
                       <p>Soldes Courant:<h4 class="b" id="user_amount_courant"></h4></p>
                       <hr class="my-2">
                       <p>Soldes Epargne:<h4 class="b" id="user_amount_epargne"></h4></p>
                       <hr class="my-2">
                       <p>Découvert:<h4 class="b" id="user_amount_decouvert"></h4></p>
                       <hr class="my-2">

                    </div>
                  
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


  <div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Voulez vous vraiment supprimer </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- <div class="modal-body">
   
                     <div class="form-group card card-product">
                       <div class="row">
                           
                       </div>

                    </div>
                  
            </div> --}}
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn-lg b shadow-sm btn-success" data-dismiss="modal">Non</button>
                <button type="button" class="btn-lg b shadow-sm btn-danger" onclick="event.preventDefault();
                    document.getElementById('delete').submit();">Oui</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->