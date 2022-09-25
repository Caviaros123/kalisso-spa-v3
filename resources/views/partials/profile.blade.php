<main class="card-product p-3">
	<!-- formulaire de mise a jour du profil utilisateur  -->
  <form class="form-horizontal" action="{{route('users.update')}}" method="POST">
   @csrf
   @method('PATCH')
   <div class="form-group row">
    <label for="inputName" class="col-sm-2 col-form-label">Nom </label>
    <div class="col-sm-10 input-group" >
      <input type="text" class="form-control p-4" name="name" value="{{old('name', $user->name)}}" id="inputName"  maxlength="50" max="10" autocomplete="off">
      <i class="fa fa-user bg-secondary p-3 border text-light"></i>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputName" class="col-sm-2 col-form-label">Prénom </label>
    <div class="col-sm-10 input-group" >
      <input type="text" class="form-control p-4" name="lastname" value="{{old('lastname', $user->lastname)}}" id="inputName"  maxlength="50" max="10" autocomplete="off" placeholder="Votre prénom">
      <i class="fa fa-user bg-secondary p-3 border text-light"></i>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10  input-group">
      <input type="email" class="form-control p-4" name="email" value="{{old('email', $user->email)}}" id="inputEmail" placeholder="Email">
      <i class="fa fa-envelope bg-secondary p-3 border text-light"></i>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputName2" class="col-sm-2 col-form-label">Numéro de téléphone</label>
    <div class="col-sm-10">
      <div class="input-group">
        @if(auth()->user()->phone)
        <input type="tel" class="form-control p-4" name="phone" id="inputName3" placeholder="Numero de téléphone" maxlength="9" readonly value="{{old('phone', $user->phone)}}" minlength="9" title="Une fois mise à jour vous ne pourrez plus modifier le numéro de téléphone">
        @else
        <input type="tel" class="form-control p-4" name="phone" id="inputName3" placeholder="Numero de téléphone" maxlength="9" required minlength="9" title="Une fois mise à jour vous ne pourrez plus modifier le numéro de téléphone">

        @endif
        <i class="fa fa-phone bg-secondary p-3 border text-light"></i>
      </div>
      @if(! auth()->user()->phone)
      <small class="text-sm text-danger">" Une fois mise à jour vous ne pourrez plus modifier le numéro de téléphone "</small>
      @else
      <small class="text-sm text-muted"> Une fois mise à jour vous ne pouvez plus modifier le numéro de téléphone voir nos conditions générales d'utilisations</small>
      @endif
    </div>
  </div>
  <div class="form-group row">
    <label for="inputName2" class="col-sm-2 col-form-label">Mot de passe</label>
    <div class="col-sm-10">
      <div class="input-group">
        <input type="password" class="form-control p-4" name="password" id="inputName2"  placeholder="Nouveau mot de passe" autocomplete="off">
        <i class="fa fa-lock bg-secondary p-3 border text-light"></i>
      </div>
      <label class="text-muted">Laissez les champs de mot de passe vide pour gardez votre ancien mot de passe ! 
      </label>
    </div>

  </div>
  <div class="form-group row">
    <label for="inputExperience" class="col-sm-2 col-form-label">Confimer le MDP</label>
    <div class="col-sm-10">
     <div class="input-group">
      <input type="password" class="form-control p-4" name="password_confirmation" id="inputName2" placeholder="Nouveau mot de passe">
      <i class="fa fa-lock bg-secondary p-3 border text-light"></i>
    </div>
  </div>
</div>
<div class="form-group row">
  <div class="offset-sm-2 col-sm-10 text-right">
    <button type="submit" class="btn btn-success p-3">Mise à jour </button>
  </div>
</div>
</form>
</main>
