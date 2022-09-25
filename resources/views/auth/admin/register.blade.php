@extends('layouts.master')

@section('title' , 'Creation de la boutique')

@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">


<link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>

<link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />
<!-- //upload image css style link -->
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet" type="text/css">

<style type="text/css">
  
  /* Style the form */
#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  padding: 10px;
  width: 100%;
  min-width: 200px;
}

/* Style the input fields */
input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}


/*style css for upload images*/

/*** GENERAL STYLES ***/
* {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

body {
  margin: 0;

  font-family: 'Roboto', sans-serif;

  background: lightcoral;
}

#page {
  text-align: center;
    font-size: 16px;
    margin: 150px auto;
}
#page h1 {
  margin-bottom: 4rem;
  font-family: 'Lemonada', cursive;
  text-transform: uppercase;
  font-weight: normal;
  color: #fff;
  font-size: 2rem;
}

/*** CUSTOM FILE INPUT STYE ***/
.wrap-custom-file {
  position: relative;
  display: inline-block;
  width: 150px;
  height: 100px;
  margin: 0 0.5rem 1rem;
  text-align: center;
}
.wrap-custom-file input[type="file"] {
  position: absolute;
  top: 0;
  left: 0;
  width: 2px;
  height: 2px;
  overflow: hidden;
  opacity: 0;
}
.wrap-custom-file label {
  z-index: 1;
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  overflow: hidden;
  padding: 0 0.5rem;
  cursor: pointer;
  background-color: #fff;
  border-radius: 4px;
  -webkit-transition: -webkit-transform 0.4s;
  transition: -webkit-transform 0.4s;
  transition: transform 0.4s;
  transition: transform 0.4s, -webkit-transform 0.4s;
}
.wrap-custom-file label span {
  display: block;
  margin-top: 2rem;
  font-size: 14px;
  color: #777;
  -webkit-transition: color 0.4s;
  transition: color 0.4s;
}
.wrap-custom-file label .fa {
  position: absolute;
  bottom: 1rem;
  left: 50%;
  -webkit-transform: translatex(-50%);
  transform: translatex(-50%);
  font-size: 1.5rem;
  color: lightcoral;
  -webkit-transition: color 0.4s;
  transition: color 0.4s;
}
.wrap-custom-file label:hover {
  -webkit-transform: translateY(-1rem);
  transform: translateY(-1rem);
}
.wrap-custom-file label:hover span, .wrap-custom-file label:hover .fa {
  color: #333;
}
.wrap-custom-file label.file-ok {
  background-size: cover;
  background-position: center;
}
.wrap-custom-file label.file-ok span {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 0.3rem;
  font-size: 0.8rem;
  color: #000;
  background-color: rgba(255, 255, 255, 0.7);
}
.wrap-custom-file label.file-ok .fa {
  display: none;
}

</style>


@stop

@section('content')

<!-- ================= SUCCESS AND ERROR MODAL ============== -->
@if (session()->has('success_message'))
<!-- Modal success-->
<div class="modal fade " id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content bg-transparent shadow-lg border solid borger-light text-light">
            <div class="modal-header shadow-lg bg">
                <button type="button" class="close text-danger rounded" data-dismiss="modal" aria-label="Close">
                    <span  aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg p-4 text-dark b text-center">
                {!! session()->get('success_message') !!}
                
            </div>
        </div>
    </div>
</div>
@endif

@if ($errors->count() > 0)
<!-- Modal  errors-->
<div class="modal fade " id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content bg-transparent shadow-lg border solid borger-light text-light">
            @foreach($errors->all() as $error)
            <div class="modal-body bg  text-danger p-4 b text-center">
                {{ $error }}
                <button type="button" class="close text-danger " data-dismiss="modal" aria-label="Close">
                    <span class="badge badge-danger p-2" aria-hidden="true">&times;</span>
                </button>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- ================= SUCCESS AND ERROR MODAL ============== -->
<!-- // START FORM FOR STORE REGISTER  -->
@if(auth()->user())
<div class="container-fluid padding-y-sm  rounded" align="center">

  <form id="regForm" class="p-0 m-0 col-md-8 my-5 padding-x-lg rounded col-sm-12" method="post" action="{{route('store.register')}}" enctype="multipart/form-data" >
      @csrf
        <div class="card  rounded m-0 p-3 shadow-lg ">
          <div class="m-0 p-0">
            <img class=" m-0 p-0" src="kalisso.png" style="width: 200px">
          </div>
          <h4 class="text-muted text-uppercase p-3">Creation de votre boutique</h4>

<!-- // SECTION 1 -->

          <!-- One "tab" for each step in the form: -->
          <div class="tab padding-y-sm rounded p-0 m-0" align="center">
              <div class="col-md-12"> 
                <div  class="form-group row" > 
                    <div class="form-input col-md-6 mb-4" align="left">
                      <label  class=" b text-muted " for="exampleFormControlFile1">Nom de la Boutique:</label>
                      <input type="text" minLength="3" name="store_name" class="form-control-lg rounded shadow" placeholder="Donnez un nom de votre boutique " oninput="this.className = ''" required="required">
                      <input hidden="hidden" name="store_id" value="{{ 'KLS'.RAND().str_replace('-','',date('d-m-Y'))}}" class="hidden">
                    </div>

                    <div class="form-input col-md-6" align="left">
                      <label class=" b text-muted" for="exampleFormControlFile1">Categorie principale:</label>
                      <select name="type"  class="custom-select shadow form-control-lg " required="required">
                        <option  hidden="hidden" selected>Choisissez une catégorie</option>

                        @foreach(\App\Category::get() as $item)
                          <option  value="{{ $item->name }}">{{ $item->name }}</option>
                        @endforeach

                      </select>

                    </div>
                </div>

              </div>

              <div class="col-md-12"> 
                <div  class="form-group row" > 

                    <div class="form-input col-md-6 mb-3" align="left">
                      <label class=" b text-muted" for="exampleFormControlFile1">Votre Pays:</label>
                      <select required="required"  name="town" class="custom-select form-control-lg ">
                        <option hidden="hidden" selected="selected">Choisissez un pays:</option>
                        @foreach(DB::table('country')->get() as $item)
                          <option  value="{{ $item->nicename }}">{{ $item->nicename }}</option>
                        @endforeach
                      </select>
                      <input hidden type="text" name="country" value="congo-brazzaville">
                    </div>
                    <div class="form-input col-md-6 mb-4" align="left">
                        <label  class=" b text-muted" for="exampleFormControlFile1">Adresse de votre boutique:</label>
                        <input type="text" name="adress" required="required" class="form-control-lg" placeholder="Saisissez votre adresse " >
                    </div>
                </div>

              </div>
          </div>
             
    

<!-- //SECTION 2 -->
          <div class="tab padding-y-sm " align="center">
               <div class="col-md-12"> 
                <div  class="form-group row" > 
                    <div class="form-input col-md-6 mb-4" align="left">
                      <label  class=" b text-muted " for="exampleFormControlFile1">Description de votre boutique:</label>
                      <textarea required="required" class="form-control"  placeholder="Décrivez votre boutique ou les carecteristiques de votre boutique en quelque ligne... "  id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                    </div>

                    <div class="form-input col-md-6 row-sm" align="left">
                        <div class=" b m-auto text-muted h6 p-0 m-0" for="image1">Importer votre logo:<br>
                         <label class="text-muted small">Si vous n'avez pas de logo, vous pouvez en créer</label>
                          <a href="https://hatchful.shopify.com/fr/">Créer mon logo</a>
                        </div>
                      
                        <!-- Our File Inputs -->
                        <div  class="wrap-custom-file p-0 m-0 m-auto shadow-lg border rounded border-danger solid">
                          <input type="file"  name="logo"  id="image1" accept=".gif, .jpg, .png, .jpeg" />
                          <label  for="image1">
                            <span>VOTRE LOGO</span>
                            <i class="fa fa-plus-circle"></i>
                          </label>
                         
                        </div>

              
                    </div>
                </div>

              </div>
              <div class="col-md-12"> 
                 <div  class="form-group row" >

                    <div class="form-input col-md-6" align="left">
                      <label class=" b text-muted" for="exampleFormControlFile1">Votre capital:</label>
                      <select required="required" name="capital_price" class="custom-select form-control-lg ">
                        <option hidden="hidden" >Choisissez la fourchete:</option>
                        
                          <option selected=""  value="100000"> 100 000 Fcfa</option>
                          <option  value="500000"> 500 000 Fcfa</option>
                          <option  value="1000000"> 1 000 000 Fcfa</option>
                          <option  value="+1000000">De plus d'1 million Fcfa</option>
                     
                      </select>
                     
                    </div>
                    <div class="form-input col-md-6 padding-y p-0 m-0 " align="left">
                      <label class="p-0 m-0 b text-muted" for="exampleFormControlFile1">Pièce d'identité (RECTO - VERSO):</label>

                        <div class="row padding-y-sm  m-0 ">
                            <!-- recto File Inputs -->
                            <div  class="col-sm-5 wrap-custom-file p-0 m-0 m-auto shadow-lg border rounded border-danger solid">
                              <input type="file"  name="document[]" id="image2" accept=".gif, .jpg, .png, .jpeg" />
                              <label  for="image2">
                                <span>RECTO</span>
                                <i class="fa fa-plus-circle"></i>
                              </label>
                            </div>  

                            <!-- verso File Inputs -->
                            <div  class="col-sm-5 wrap-custom-file p-0 m-0 m-auto shadow-lg border rounded border-danger solid">
                              <input type="file"  name="document[]" id="image3" accept=".gif, .jpg, .png, .jpeg" />
                              <label  for="image3">
                                <span >VERSO</span>
                                <i class="fa fa-plus-circle"></i>
                              </label>
                            </div>
                        </div>

                    </div>

                </div>
              </div>

              </div>


<!-- // SECTION 3 -->


          <div class="tab padding-y-sm " align="center">
             <div class="col-md-12"> 
                 <div  class="form-group row" >
                    <div class="form-input col-md-6 mb-4" align="left">
                        <label  class=" b text-muted" for="exampleFormControlFile1">Votre nom:</label>
                        <input type="text" required name="founder_name" class="form-control-lg" placeholder="Nom du propriétaire" oninput="this.className = ''">
                    </div>
                    <div class="form-input col-md-6 mb-4" align="left">
                        <label  class=" b text-muted" for="exampleFormControlFile1">Email:</label>
                        <input  type="email"  name="email" value="{{old('email') ?? auth()->user()->email }}"   class="form-control-lg" placeholder="Votre email" >
                    </div>
                  </div>
              </div>
              <div class="col-md-12"> 
                 <div  class="form-group row" >
                    <div class="form-input col-md-6 mb-4" align="left">
                        <label  class=" b text-muted" for="exampleFormControlFile1">Téléphone:</label>
                        <input type="tel" name="phone"   required class="form-control-lg" placeholder="Votre numéro Téléphone" value="{{ auth()->user()->phone }}"  oninput="this.className = ''" >
                    </div>
                   <!--  <div class="form-input col-md-6 mb-4" align="left">
                        <label  class=" b text-muted" for="exampleFormControlFile1">Adresse personnelle:</label>
                        <input type="text" name="email" required class="form-control-lg" placeholder="Votre email" oninput="this.className = ''">
                    </div> -->
                  </div>
              </div>

          </div>
          <div  class="isFinish ">
                <img src="oie_rounded_corners.gif" width="50" alt="">
          </div>

          <div class="">
           
            <div class="text-right" >
              <button type="button" class="bg-none border m-0 solid border-danger rounded btn-lg h5 b btn-outline-danger" id="prevBtn" onclick="nextPrev(-1)">Precedent</button>
              <button type="button" class="bg-none border m-0 solid border-danger rounded btn-lg h5 b btn-outline-danger" id="nextBtn" onclick="nextPrev(1)">Suivant</button>
            </div>
          </div>

          <!-- Circles which indicates the steps of the form: -->
          <div style="text-align:center;margin-top:5px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
   
          </div>

          <div id="progress"></div>
     </div>
  </form>


      <div class="col-md-8 p-4 text-light">
        <div class="row">
          <div class="col-md-4">
            <a class="text-dark" href="/">&copy; Kalisso.com, Inc.</a>
          </div>
          <div class="col-md-4">
            <a class="text-dark" href="/contact">&phone; Contactez-nous</a>
          </div>
          <div class="col-md-4">
            <a class="text-dark" href="/reglement"> Confidentialité &amp; conditions</a>
          </div>
          
        </div>
      </div>

         </div>            
</div>



<!-- // END FORM -->



</div>
@else
  <div align="center" class="container m-auto text-light px-5 py-5"> 
       Vous n'etes pas connecter
  <a href="/login" class="btn btn-outline-light p-3 mt-4">Connectez vous </a>
  </div>

@endif
@endsection


@section('js')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" integrity="sha512-VZ6m0F78+yo3sbu48gElK4irv2dzPoep8oo9LEjxviigcnnnNvnTOJRSrIhuFk68FMLOpiNz+T77nNY89rnWDg==" crossorigin="anonymous"></script>
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>


<script type="text/javascript">
  
 var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Envoyer";
   
  } else {
    document.getElementById("nextBtn").innerHTML = "Suivant";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");

  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    // document.getElementsByClassName("isFinish").show();
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var  y, i, valid = true;
  y = document.getElementsByClassName("tab");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";

  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}


///////////////////////////////////////////////////////////////////////////



$('input[type="file"]').each(function(){
  // Refs
  var $file = $(this),
      $label = $file.next('label'),
      $labelText = $label.find('span'),
      labelDefault = $labelText.text();

  // When a new file is selected
  $file.on('change', function(event){
    var fileName = $file.val().split( '\\' ).pop(),
        tmppath = URL.createObjectURL(event.target.files[0]);
    //Check successfully selection
    if( fileName ){
      $label
        .addClass('file-ok')
        .css('background-image', 'url(' + tmppath + ')');
      $labelText.text(fileName);
    }else{
      $label.removeClass('file-ok');
      $labelText.text(labelDefault);
    }
  });

// End loop of file input elements
});



        (function myOnLoadFunc(){

            $('#exampleModalCenter').modal('show').fadeOut(10, function() {
                $(this).modal('hide');
            });

        })()



</script>

 <script type="text/javascript"> $(document).ready(function() { $('#regForm').on('submit', function() { setInterval(function(){ $.getJSON('/progress', function(data) { $('#progress').html(data[0]); }); }, 1000); $.post( $(this).prop('action'), {"_token": $(this).find('input[name=_token]').val()}, function() { window.location.href = 'success'; }, 'json' ); return false; }); }); </script> 


@stop



