@extends('layouts.master')
@section('title', 'Groupes Cartes')
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

          <h2 class="card-title text-muted">Listes des groupes de cartes </h2>
          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" id="txt_search_id"  name="table_search" class="form-control float-right" placeholder="Recherche">

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
                <th class=" text-success ">Soldes</th>
                <th class=" text-danger ">Montant Fixe</th>
                <th>Période</th>
                <th class=" text-primary ">Leaders</th>
                <th>Crée par</th>
                <th>Status</th>
                <th>Date de création</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>

              @forelse(App\Groupe::where('type', 'carte')->get() as $item)
              <?php

              $user = DB::table('users')->where('id', $item->user_id)->get();

              $user = json_decode($user);
              $created_by = DB::table('users')->where('id', $item->created_by)->get();
              $user2 = json_decode($created_by);
              $leaders_id = array(
                'leader_1' => $item->leader_1, 
                'leader_2' => $item->leader_2, 
                'leader_3' => $item->leader_3, 
              );
              $leaders = DB::table('users')->whereIn('id', $leaders_id)->get();

              ?>
              
              @foreach($user2 as $users2)
              <tr class=" @if($item->day > 0) @else bg-light @endif">
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td class=" text-success "> <strong><span class="b ">{{ presentPrice($item->amount)}} </span></strong></td>
                <td class=" text-danger "> <strong><span class=" b ">{{presentPrice($item->amount_fixed)}} </span></strong> </td>
                <td> {{($item->amount / $item->amount_fixed) - $item->day  }} Jours</td>
                <td> 
                    @foreach($leaders as $leader => $val)
                      <span class="badge-md badge-primary badge p-2">{{$val->name}}</span> - 
                    @endforeach
                 </td>
                <td> {{$users2->name}}</td>
                @if($item->day > 0)
                    <td> <span class=" badge  badge-success ">Actif</span></td>
                @else 
                    <td> <span class=" badge  badge-danger ">Terminée</span></td>
                @endif
                <td> {{  strftime("%A %d %B %G", strtotime($item->created_at))}}</td>
                
                <td>
                  <div class="d-flex justify-content-around">
                   {{--  <div class="col-2">
                      <a href="edit/user/{{$item->id}}" class="btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                    </div> --}}
                    <div class="col-2">
                      <a href="show/user/{{$item->id}}" data-id="{{$item->id}}" type="button" class="btn-sm btn-primary mr-3" data-toggle="modal" data-target="#myModal" class="btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                    </div>
                    @if(auth()->user()->role_id == 1)
                        <div class="col-2">
                          <a id="confirm" onclick="return confirm('Voulez vous supprimer ce compte');" href="{{ route('carte.group.detroy', $item->id) }}"  class="btn-sm btn-danger suppression"><i class="fa fa-trash"></i></a>
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
               <td colspan='4' class="text-danger b h4">Aucun groupe trouver</td>
             </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <div class="d-flex justify-content-between text-center">

        <button type="button" class="btn btn-success mr-3" data-toggle="modal" data-target="#modal-default">
          <i class="fa fa-plus mr-2"></i> Ajouter une carte de groupe
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
@endsection
@section('js')
<script>
  $(document).ready(function(){

    var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
      removeItemButton: true,
      maxItemCount:3,
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
</script>
@stop
@section('footer')
@include('layouts.footer')
@stop