@extends('layouts.master')
@section('title', 'Membres')
@section('content')
@if(session()->has('success'))


<div class="alert alert-success my-3 m-auto">{{session()->get('success')}}</div>
<button hidden type="button" class="btn btn-success swalDefaultSuccess">
  Launch Success Toast
</button>

@endif


@if(session()->has('errors'))

<div class="alert alert-danger my-3 m-auto">{{session()->get('errors')}}</div>


@endif
<div class="px-5 py-2">

    <div class="row">
      <div class="col-12">

        <div class="card">

          <div class="card-header">

            <h2 class="card-title text-muted">Listes de tous les membres </h2>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" id="txt_searchall" name="table_search" class="form-control float-right" placeholder="Recherche">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
              </div>
          </div>
      </div>
  </div>
  <!-- /.card-header -->

  <div class="card-body table-responsive p-0" style="height: 300px;">

    <table class="table table-head-fixed" id="myTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom complet</th>
          <th>role</th>
          <th>Date de création</th>
          <th>type</th>
          <th>Status</th>
          <th>Actions</th>
      </tr>
  </thead>
  <tbody>

      @forelse(App\Models\User::all() as $user)
      <?php 

      $getRole = DB::table('roles')->where('id', $user->role_id)->get(); 
      $role = json_decode($getRole);

      ?>


      @foreach($role as $roles)

      <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name.' '.$user->firstname}}</td>
        <td>{{$roles->display_name}}</td>
        <td>{{  strftime("%A %d %B %G", strtotime($user->created_at))}}</td>
        @if($user->type != null && $user->type == 1)
        <td>  Banque </td>
        @elseif($user->type == 2)
        <td>  Carte</td>
        @else
        <td>-</td>
        @endif

        @if(!$user->status != null)
        <td> {{ $user->status  }} <span class=" badge  badge-success ">Actif</span></td>
        @else 
        <td> <span class=" badge  badge-danger ">Archivé</span></td>
        @endif

        <td>
          <div class="d-flex justify-content-between">
              <!-- <div class="col-2">
                  <a id="get" data-toggle="modal" data-target="#modal-default1" href="/edit/user/{{$user->id}}" class="btn-sm btn-warning"><i class="fa fa-edit"></i></a>
              </div> -->
              <div class="col-2">
                  <a id="get" href="/show/user/{{$user->id}}" href="show/user/{{$user->id}}" data-id="{{$user->id}}"  data-toggle="modal" data-target="#myModal" class="btn-sm btn-primary show_user"><i class="fa fa-eye"></i></a>
              </div>

              @if(auth()->user()->role_id == 1)
              <div class="col-2">
                <a href="#" data-id="delete{{$user->id}}" data-toggle="modal" data-target="#deleteModal" class="btn-sm btn-danger suppression"><i class="fa fa-trash"></i></a>
              </div>

              <form id="delete{{$user->id}}" data-id="{{$user->id}}" action="{{ route('user.destroy', $user->id) }}" method="get" style="display: none;">
                @csrf
              </form>
              @endif
          </div>
      </td>
  </tr>


  @endforeach
  @empty
  <div class="alert alert-danger p-3"> Aucun utilisateur pour l'instant</div>

  @endforelse
  <!-- Display this <tr> when no record found while search -->
   <tr class='notfound' >
     <td colspan='4' class="text-danger b h4">Aucun utilisateur trouver</td>
   </tr>
</tbody>
</table>
</div>
<!-- /.card-body -->
</div>
<div class="d-flex justify-content-left text center">

    <button type="button" class="btn btn-success mr-3" data-toggle="modal" data-target="#modal-default">
        <i class="fa fa-plus mr-2"></i> Ajouter un utilisateur
    </button>


</div>  
<!-- /.card -->
</div>
</div>

</div>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nouveau Membre</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="{{route('user.register')}}" method="post">
     @csrf
     <div class="modal-body">
        <div class="input-group mb-3">
            <div class="col-4">
                <label class="b">Civilité: </label>
            </div>
            <div class="col-2">
                <label for="male"> Mr.
                    <input type="radio" checked="checked" name="gender" value="male" class="radio" placeholder="Nom " required>
                </label>
            </div>
            <div class="col-5">
                <label for="female"> Mme 
                    <input type="radio" name="gender" value="female" class="radio" placeholder="Nom " required>
                </label>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="text" name="name"  class="form-control" placeholder="Nom " required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="text"  name="firstname" class="form-control" placeholder="Prénom "required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="far fa-user"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="tel" name="phone" maxlength="9" class="form-control" minlength="9" maxlength="12" placeholder="Telephone" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-phone"></span>
                </div>
            </div>
        </div>
        
        <div class="input-group mb-3">
            <input type="text" name="address" autocomplete="false"  class="form-control" placeholder="Adresse" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-globe"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="date" name="birthdate" autocomplete="false"  class="form-control" placeholder="Date de naissance" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-calendar"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="text" name="cellule" autocomplete="false"  class="form-control" placeholder="Cellule" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-map"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">

            <select name="role_id" id="role" class="form-control role" placeholder="Choisissez un rôle" required>
                <option selected hidden>Choisissez un rôle</option>
                <option value="1">Administrateur</option>
                <option value="2">Employé</option>
                <option value="3">Client</option>
            </select>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fa fa-tools"></span>
                </div>
            </div>
        </div>
        <div id="set_email" class="input-group mb-3" hidden>   
            <input type="email" name="email" id="z_email" class="form-control" placeholder="Saisirssez l'email du membre">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fa fa-tools"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3 " hidden id="type">

            <select name="type" id="y_type" class="form-control  type" placeholder="Choisissez un rôle" required>
                <option hidden>Choisissez le type de compte</option>
                <option value="1">BANQUE</option>
                <option value="2">CARTES DE POINTAGE</option>

            </select>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fa fa-tools"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" name="password" autocomplete="false" class="form-control" placeholder="Mot de passe" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>


    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>

        <div class="col-4">
            <!-- HIDDEN INPUT -->
            <input type="text" name="created_by" value="{{ auth()->user()->id ?? 0}}" hidden="hidden">
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

@section('js')

<script type="text/javascript">

    $('#role').change(function () {
        var x = document.getElementById("role");
        var y = document.getElementById("type");
        var z = document.getElementById("set_email");
        var y_type = document.getElementById("y_type");
        var z_email = document.getElementById("z_email");
        
      if (x.value == 3) {
          y.removeAttribute("hidden");
          y_type.setAttribute("required", "required");
          z.setAttribute("hidden", "hidden");
      }else if (x.value == 1 || x.value == 2){
          y.setAttribute("hidden", "hidden");
          z.removeAttribute("hidden");
          z_email.setAttribute("required", "required");
      }else{
          y.removeAttribute("hidden");
          z.removeAttribute("hidden");
      }
    });


    // document.getElementById("role").addEventListener( "change",function(){

        


  // });
</script>

@stop
@endsection
@section('footer')
@include('layouts.footer')
@stop