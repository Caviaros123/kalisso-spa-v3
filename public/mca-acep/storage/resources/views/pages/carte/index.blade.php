@extends('layouts.master')
@section('title', 'Cartes')
@section('content')
@if(session()->has('success'))


<div class="alert alert-success my-3 m-auto">{{session()->get('success')}}</div>
<button hidden type="button" class="btn btn-success swalDefaultSuccess">
  Launch Success Toast
</button>

@endif

@if(session()->has('errors'))

<div class="alert alert-danger my-3">{{session()->get('errors')}}</div>

@endif


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
                    <div class="p-0 m-0 "  >
                       ID de l'utilisateur:<h4 class="b m-0 p-0" id="show_user_id"></h4>
                       
                       Solde actuel:<h4 class="b" id="show_user_amount"></h4>
                       
                       Solde Fixe:<h4 class="b" id="show_user_amount_fixed"></h4>
                       
                       Code de la carte:<h4 class="b" id="show_user_code"></h4>
                    
                       Crée par:<h4 class="b" id="show_user_created_by"></h4>
                       
                       Date de création:<h4 class="b" id="show_user_created_at"></h4>
                    </div>
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



<div class="px-5 py-2">

  <div class="row">
    <div class="col-12">

      <div class="card">

        <div class="card-header">

          <h2 class="card-title text-muted">Listes de toutes les cartes </h2>
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

          <table class="table table-head-fixed">
            <thead>
              <tr >
                <th>ID</th>
                <th>Nom complet</th>
                <th class=" text-success ">Soldes</th>
                <th class=" text-danger ">Montant Fixe</th>
                <th>Période</th>
                <th>Crée par</th>
                <th>Status</th>
                <th>Date de création</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>

              @forelse(App\Carte::all() as $item)
              <?php

              $user = DB::table('users')->where('id', $item->user_id)->get();
              $user = json_decode($user);

              $created_by = DB::table('users')->where('id', $item->created_by)->get();
              $user2 = json_decode($created_by);
              ?>
              @foreach($user as $users)
                @foreach($user2 as $users2)
                <tr class=" @if($item->day > 0) @else bg-light @endif">
                  <td>{{$item->id}}</td>
                  <td>{{$users->name.' '.$users->firstname}}</td>
                  <td class=" text-success "> <strong><span class="b ">{{ presentPrice($item->amount)}} </span></strong></td>
                  <td class=" text-danger "> <strong><span class=" b ">{{presentPrice($item->amount_fixed)}} </span></strong> </td>
                  <td> {{($item->amount / $item->amount_fixed) - $item->day  }} Jours</td>
                  <td> {{$users2->name}}</td>
                  @if($item->day > 0)
                      <td> {{ $item->status  }} <span class=" badge badge-success ">Actif</span></td>
                  @else 
                      <td> <span class=" badge  badge-danger ">Inactif</span></td>
                  @endif
                  
                  <td> {{  strftime("%A %d %B %G", strtotime($item->created_at))}}</td>
      
                  <td>
                    <div class="d-flex justify-content-between">
                     <!--  <div class="col-2">
                        <a href="edit/user/{{$item->id}}" class="btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                      </div> -->
                      <div class="col-2">
                        <a data-id="{{$item->id}}"  data-toggle="modal" data-target="#myModal" class="btn-sm btn-primary show_user"><i class="fa fa-eye text-light"></i></a>
                      </div>
                    
                      @if(auth()->user()->role_id == 1)
                          <div class="col-2">
                            <a id="confirm" onclick="return confirm('Voulez vous supprimer ce compte');" href="{{ route('scorecard.delete', $item->id) }}"  class="btn-sm btn-danger suppression"><i class="fa fa-trash"></i></a>
                          </div>
                      @endif

                    </div>

                  </td>
                </tr>
                @endforeach
              @endforeach
              @empty
              <tr>

                <td>
                  <div class="alert alert-danger col-12"> Aucun compte pour l'instant</div>

                </td>
              </tr>

              @endforelse
              <tr class='notfound'>
               <td colspan='4' class="text-danger b h4">Aucune carte trouvé</td>
             </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <div class="d-flex justify-content-between text-center">

        <button type="button" class="btn btn-success mr-3" data-toggle="modal" data-target="#modal-default">
          <i class="fa fa-plus mr-2"></i> Ajouter une carte
        </button>
        <button type="button" class="btn btn-warning mr-3" data-toggle="modal" data-target="#modal-withdrawl">
          <i class="fa fa-plus mr-2"></i> Retrait
        </button>
        <button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#modal-deposit">
          <i class="fa fa-plus mr-2"></i> Dépot
        </button>

      </div>
      <!-- /.card -->
    </div>
  </div>

</div>
@include('pages.carte.modal.default')
@include('pages.carte.modal.withdrawl')
@include('pages.carte.modal.deposit')
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
        axios.patch(`/scorecard/show/account/${id}`)
        .then(function (response) {
            if (response.data.data) {
              var data = JSON.parse(response.data.data);
                console.log(data);
               var amount =  data.amount.toString();
               var amount_fixed = data.amount_fixed.toString();
               var day = data.day.toString();
               var user_id = data.user_id.toString();
               var code = data.code.toString();
               var created_by = data.created_by.toString();
               var created_at = data.created_at.toString();
              
              $("#show_user_amount").text(amount+ " Fcfa");
              $("#show_user_amount_fixed").text(amount_fixed+ " Fcfa");
              $("#show_user_code").text(code);
              $("#show_user_created_by").text(created_by);
              $("#show_user_created_at").text(created_at);
              $("#show_user_id").text(user_id);
                    
                    
            }

            console.log(response);
        
        })
        .catch(function (error) {
            alert("CETTE UTILISATEUR N'EXISTE PAS OU N'A PAS ENCORE DE COMPTE: "+  error);
            console.log("Echec : "+ error);
            
        });

  
    });



    $(document).ready(function() {
  
      $("#getUser").change(' #getUser ', function() {
        var dInput = $(this).val();
       
        $("#user_amount").val(dInput);
  
      });
  
  
    });
  </script>

@stop
@endsection
@section('footer')
@include('layouts.footer')
@stop