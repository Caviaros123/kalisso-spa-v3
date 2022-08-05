@extends('layouts.master')
@section('title', 'Trnsactions')
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

            <h2 class="card-title text-muted">Listes des transactions </h2>
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
          <th>type</th>
          <th>Status</th>
          <th>Référence</th>
          <th>Emis par</th>
          <th>Date de création</th>
          <th>Actions</th>
      </tr>
  </thead>
  <tbody>

      @forelse(DB::table('transaction')
              ->where('action','!=', 'bank_create_group_account')
              ->where('action','!=', 'scorecard_create_group_account')
              ->where('action','!=', 'bank_create_account')
              ->where('action','!=', 'scorecard_create_account')
              ->get() 
              as $user)
      <?php 
          $data=json_decode($user->playload);
          $created_by = App\Models\User::find($data->created_by);
       ?>
          <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->action}}</td>
                @if($user->status == 'success')
                    <td> <h5><span class="badge badge-lg  badge-success ">Réussi</span></h5></td>
                @else 
                    <td> <span class=" badge  badge-danger ">Echoué</span></td>
                @endif
                <td>{{ $data->account_id ?? $data->code }}</td>
                <td>{{ $created_by->name }}</td>
                <td>{{ strftime("%A %d %B %G", strtotime($user->created_at))}}</td>
                <td>
                  <div class="d-flex justify-content-between">
                    
                      <div class="col-2 disabled invalid" >
                          <a data-toggle="modal"  data-target="#myModal" data-id="{{$user->id}}" class="btn-sm btn-primary invalid"><i class="fa fa-eye"></i></a>
                      </div>
                      {{-- <div class="col-2">
                          <a id="get" href="/delete/user/{{$user->id}}" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                      </div> --}}
                  </div>
              </td>
          </tr>

  
  <!-- Display this <tr> when no record found while search -->
   <tr class='notfound' >
     <td colspan='4' class="text-danger b h4">Aucun utilisateur trouver</td>
   </tr>
   @empty
        <div class="alert alert-danger p-3"> Aucune activité récente</div>

  @endforelse
</tbody>
</table>
</div>
<!-- /.card-body -->
</div>
<div class="d-flex justify-content-left text center">

    {{-- <button type="button" class="btn btn-success mr-3" data-toggle="modal" data-target="#modal-default">
        <i class="fa fa-plus mr-2"></i> Ajouter un utilisateur
    </button> --}}


</div>  
<!-- /.card -->
</div>
</div>

</div>


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