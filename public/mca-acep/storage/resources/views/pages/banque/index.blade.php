@extends('layouts.master')
@section('title', 'Comptes')
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

          <h2 class="card-title text-muted">Listes de tous les comptes </h2>
          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" id="txt_searchall" name="search" class="form-control float-right" placeholder="Recherche">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body table-responsive p-0" style="height: 300px;">

          <table class="table table-head-fixed">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nom complet</th>
                <th class=" text-success ">Soldes</th>
                <th class=" text-danger ">Découvert</th>
                <th class=" text-primary ">Epargne</th>
                <th>Crée par</th>
                <th>Status</th>
                <th>Date de création</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="list">
              <?php
                   if (auth()->user()->role_id == 1) {
                    $banque = App\Banque::all();
                  }else{
                    $banque = App\Banque::where('user_id', '!=', '1')->get();
                  }
               ?>
              @forelse($banque as $item)
               
              <?php

                  $getUser = DB::table('users')->where('id', $item->user_id)->get();
                  $user = json_decode($getUser);

                  $created_by = DB::table('users')->where('id', $item->created_by)->get();
                  $user2 = json_decode($created_by);
              ?>
              @foreach($user as $users)
              <tr>
                <td>{{$item->id}}</td>
                <td>{{$users->name.' '.$users->firstname}}</td>
                <td class=" text-success "> <strong><span class="b ">{{ presentPrice($item->soldes)}}</span></strong> </td>
                <td class=" text-danger "> <strong><span class="b ">{{presentPrice($item->decouvert)}}</span></strong> </td>
                <td class=" text-primary "> <strong><span class="b ">{{presentPrice($item->epargne)}} </span></strong></td>
                @foreach($user2 as $createBy)
                <td>{{ $createBy->name }}</td>
                @endforeach
                <td>{{$item->status}} <span class="tag tag-success"></span></td>
                <td>{{  strftime("%A %d %B %G", strtotime($item->created_at))}}</td>

                <td>
                  <div class="d-flex justify-content-around">
                   {{--  <div class="col-2" hidden="">
                      <a href="edit/user/{{$item->id}}" class="btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                    </div> --}}
                    <div class="col-2">
                      <a href="show/user/{{$item->id}}" data-id="{{$item->id}}"  data-toggle="modal" data-target="#myModal" class="btn-sm btn-primary show_user"><i class="fa fa-eye"></i></a>
                    </div>
                    @if(auth()->user()->role_id == 1)
                        <div class="col-2">
                          <a id="confirm" onclick="return confirm('Voulez vous supprimer ce compte');" href="{{ route('bank.delete', $item->id) }}"  class="btn-sm btn-danger suppression"><i class="fa fa-trash"></i></a>
                        </div>
                    @endif
                  </div>

                </td>
              </tr>
              @endforeach
              @empty
                <tr>

                  <td>
                    <div class="alert alert-danger col-12"> Aucun compte pour l'instant</div>

                  </td>
                </tr>

              @endforelse
              <!-- Display this <tr> when no record found while search -->
             <tr class='notfound' >
               <td colspan='4' class="text-danger b h4">Aucun compte trouver</td>
             </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <div class="d-flex justify-content-between text-center">

        <button type="button" class="btn btn-success " data-toggle="modal" data-target="#modal-default">
          <i class="fa fa-plus mr-2"></i> Ajouter un compte
        </button>
        <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#modal-withdrawl">
          <i class="fa fa-plus mr-2"></i> Retrait
        </button>

        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modal-deposit">
          <i class="fa fa-plus mr-2"></i> Dépot
        </button>
        @if(auth()->user()->role_id == 1)
          <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#modal-decouvert">
            <i class="fa fa-plus mr-2"></i> Découvert
          </button>
        @endif
       {{--  <button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal-virement">
          <i class="fa fa-plus mr-2"></i> Virement
        </button> --}}

      </div>
      <!-- /.card -->
    </div>
  </div>

</div>


@include('pages.banque.modal.default')
@include('pages.banque.modal.withdrawl')
@include('pages.banque.modal.deposit')
@include('pages.banque.modal.decouvert')
@include('pages.banque.modal.virement')

@section('js')

   <script type="text/javascript">
    

    //SEARCH ZONE
      $("#search").on("keyup", function() {
      var value = $(this).val().toLowerCase().trim();
      var v = value.split("%");
      // alert("CouCou");
      $(".list tr").each(function(j,k) {
        var s = true;
        $.each(v, function(i, x) {
          if (s) {
            s = $(k).text().toLowerCase().indexOf(x) > -1;
          }
        });
        $(this).toggle(s);
      });
    });


    $(".show_user").click(function(){
        var id = $(this).attr('data-id');
        // alert("LES DATAS SONT = "+id);
        axios.patch(`/bank/show/user/${id}`)
        .then(function (response) {
            if (response.data.data) {
                    var data = JSON.parse(response.data.data);
                      console.log(data);
                     var courant =  data.soldes.toString();
                     var epargne = data.epargne.toString();
                     var decouvert = data.decouvert.toString();
                     var user_id = data.user_id.toString();
                    
                    $("#user_amount_courant").text(courant+ " Fcfa");
                    $("#user_amount_epargne").text(epargne+ " Fcfa");
                    $("#user_amount_decouvert").text(decouvert+ " Fcfa");
                    $("#user_id").text(user_id);
            }

            console.log(response);
        
        })
        .catch(function (error) {
            alert("CETTE UTILISATEUR N'EXISTE PAS OU N'A PAS ENCORE DE COMPTE: "+  error);
            console.log("Echec : "+ error);
            
        });

  
    });

  document.getElementById("role").addEventListener("change", function() {

    var x = document.getElementById("role");
    var y = document.getElementById("type");

    if (x.value == 3) {

      y.removeAttribute("hidden");

    } else if (x.value == 1) {
      y.setAttribute("hidden", "hidden");
    } else if (x.value == 2) {
      y.setAttribute("hidden", "hidden");
    } else {
      y.removeAttribute("hidden");
    }


  });




</script>

@stop

@endsection
@section('footer')
@include('layouts.footer')
@stop