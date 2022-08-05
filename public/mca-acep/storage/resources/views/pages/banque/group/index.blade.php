@extends('layouts.master')
@section('title', 'Groupes Banque')
@section('content')
@section('css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
  <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

@stop


@if(session()->has('success'))


<div class="alert alert-success my-3 m-auto">{{session()->get('success')}}</div>
<button hidden type="button" class="btn btn-success swalDefaultSuccess">
  Launch Success Toast
</button>

@endif

@if(session()->has('errors'))

<div class="alert alert-danger my-3">{{session()->get('errors')}}</div>

@endif
<div class="px-5 py-2">

  <div class="row">
    <div class="col-12">

      <div class="card">

        <div class="card-header">

          <h2 class="card-title text-muted">Listes de tous les groupes de la banque </h2>
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
                <th>Nom du groupe</th>
                <th>Code du groupe</th>
                <th class=" text-success ">Soldes</th>
                <th>Epargne</th>
                <th class=" text-primary ">Leaders</th>
                <th>Status</th>
                <th>Crée par</th>
                <th>Date de création</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>

              @forelse(App\Groupe::where('type', 'banque')->get() as $item)
              <?php
              
              $created_by = DB::table('users')->where('id', $item->created_by)->get();
              $leaders_id = array(
                'leader_1' => $item->leader_1, 
                'leader_2' => $item->leader_2, 
                'leader_3' => $item->leader_3, 
              );
               
              $leaders = DB::table('users')->whereIn('id', $leaders_id)->get();
              $user2 = json_decode($created_by);

              {{-- dd($leaders_id); --}}

              ?>
              @foreach($user2 as $users2)
              <tr class=" @if($item->status != 'actif')  @else bg-light @endif">
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->code}}</td>
                <td class=" text-success "> <strong><span class="b ">{{ presentPrice($item->amount)}} </span></strong></td>
                <td class=" text-danger "> <strong><span class=" b ">{{presentPrice($item->epargne)}} </span></strong> </td>
                <td> 
                    @foreach($leaders as $leader => $val)
                      <span class="badge-md badge-primary badge p-2">{{$val->name}}</span> - 
                    @endforeach
                 </td>
                
                
                @if($item->status == 'actif')
                  <td>  <span class=" badge  badge-success ">Actif</span></td>
                @else 
                  <td> <span class=" badge  badge-danger ">Inactif</span></td>
                @endif
                <td> {{$users2->name}}</td>

                <td> {{  strftime("%A %d %B %G", strtotime($item->created_at))}}</td>

                <td>
                  <div class="d-flex justify-content-around">
                   <!--  <div class="col-2">
                      <a href="bank/group/edit/user/{{$item->id}}" class="btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                    </div> -->
                
                    <div class="col-2">
                      <a href="show/user/{{$item->id}}" data-id="{{$item->id}}"  data-toggle="modal" data-target="#myModal" class="btn-sm btn-primary show_user"><i class="fa fa-eye"></i></a>
                    </div>
                  
                    @if(auth()->user()->role_id == 1)
                        <div class="col-2">
                          <a id="confirm" onclick="return confirm('Voulez vous supprimer ce compte');" href="{{ route('bank.group.delete', $item->id) }}"  class="btn-sm btn-danger suppression"><i class="fa fa-trash"></i></a>
                        </div>
                    @endif
                  </div>

                </td>
              </tr>
              @endforeach
              @empty
              <tr>
                <td>
                  <div class="alert alert-danger col-12"> Aucun groupe pour l'instant</div>
                </td>
              </tr>
              @endforelse
              <!-- Display this <tr> when no record found while search -->
             <tr class='notfound' >
               <td colspan='4' class="text-danger b h4">Aucun groupe trouver</td>
             </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <div class="d-flex justify-content-between text-center">

        <button type="button" class="btn btn-success mr-3" data-toggle="modal" data-target="#modal-default">
          <i class="fa fa-plus mr-2"></i> Ajouter un groupe
        </button>
        <button type="button" class="btn btn-warning mr-3" data-toggle="modal" data-target="#modal-withdrawl">
          <i class="fa fa-plus mr-2"></i> Retrait
        </button>
        <button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#modal-deposit">
          <i class="fa fa-plus mr-2"></i> Dépot
        </button>
        @if(auth()->user()->role_id == 1)
          <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#modal-decouvert">
            <i class="fa fa-plus mr-2"></i> Découvert
          </button>
        @endif

      </div>
      <!-- /.card -->
    </div>
  </div>

</div>
@include('pages.banque.modal.default')
@include('pages.banque.modal.withdrawl')
@include('pages.banque.modal.deposit')
@include('pages.banque.modal.decouvert')

@endsection
@section('js')


<script type="text/javascript">
  $(document).ready(function(){

    var multipleCancelButton = new Choices('.choices-multiple-remove-button', {
      removeItemButton: true,
      maxItemCount:3,
      searchResultLimit:5,
      renderChoiceLimit:5
    });

    var multipleCancelButton = new Choices('.choices-one-remove-button', {
      removeItemButton: true,
      maxItemCount:1,
      searchResultLimit:5,
      renderChoiceLimit:5
    });


  });

  $(document).ready(function() {

    $("#getUser").change('#getUser ', function() {
      var dInput = $(this).val();

      $("#user_amount").val(dInput);

    });


  });

   $(".show_user").click(function(){
        var id = $(this).attr('data-id');
        // alert("LES DATAS SONT = "+id);
        axios.patch(`/bank/group/show/user/${id}`)
        .then(function (response) {
            if (response.data.data) {
                    var data = JSON.parse(response.data.data);
                      console.log(data);
                     var courant =  parseFloat(data.amount);
                     var epargne = parseFloat(data.epargne);
                     var decouvert = parseFloat(data.decouvert);
                     var user_id = data.code;
                    
                    $("#user_id").text(user_id);
                    $("#user_amount_courant").text(courant+ " Fcfa");
                    $("#user_amount_epargne").text(epargne+ " Fcfa");
                    $("#user_amount_decouvert").text(decouvert+ " Fcfa");
            }

            console.log(response);
        
        })
        .catch(function (error) {
            alert("CETTE UTILISATEUR N'EXISTE PAS OU N'A PAS ENCORE DE COMPTE: "+  error);
            console.log("Echec : "+ error);
            
        });

  
    });
</script>
@stop
@section('footer')
@include('layouts.footer')
@stop