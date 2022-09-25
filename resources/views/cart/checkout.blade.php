@extends('layouts.master')

@section('title', 'Paiement')

@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />
<style type="text/css">
    .container {
      max-width: 960px;
    }

    .lh-condensed { line-height: 1.25; }
</style>
@stop


@section('content')

<!-- ================= SUCCESS AND ERROR MODAL ============== -->
 @if (session()->get('success_validate'))
     <!-- Modal success-->
     <div class="modal fade " id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <button type="button" class="close text-danger rounded" data-dismiss="modal" aria-label="Close">
                <span  aria-hidden="true">&times;</span>
            </button>
            <div class="modal-content bg shadow-lg border solid borger-light text-light">
                <div class="modal-header shadow-lg bg text-center">


                    <form  action="https://epaycongo.com/payment" method="post" >
                 
                          <div class="modal-body bg p-2 text-dark b text-center">
                           <div class="text-success">
                             <p>
                             <strong class="text-danger">Vous serez rediriger vers une page de paiement</strong></p>
                           </div>

                              <input type="hidden" name="signature" value="{{session()->get('datas')['signature'] ?? ''}}" />
                              <input type="hidden" name="amount" value="{{session()->get('datas')['amount'] ?? ''}}" />
                              <input type="hidden" name="acid" value="{{session()->get('datas')['acid'] ?? ''}}" />
                              <input type="hidden" name="emailId" value="{{session()->get('datas')['emailId'] ?? ''}}" />
                              <input type="hidden" name="successurl" value="{{session()->get('datas')['successurl'] ?? ''}}" />
                              <input type="hidden" name="cancelurl" value="{{session()->get('datas')['cancelurl'] ?? ''}}" />
                              <input type="hidden" name="currency" value="{{session()->get('datas')['currency'] ?? ''}}" />
                              <input type="hidden" name="Reference" value="{{ session()->get('datas')['Reference'] ?? ''}}" />

                     
                         {{-- <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Annuler</button> --}}
                         <button type="submit" name="submit" class="form-control-lg shadow btn-outline-success rounded">Valider le paiement</button>
                     </div>
                 </form>

                    
                </div>
                
                
       </div>
   </div>
</div>


@endif



<!-- ================= SUCCESS AND ERROR MODAL ============== -->
@if (session()->get('success_message'))
<!-- Modal success-->
<div class="modal fade " id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content bg shadow-lg border solid borger-light text-light">
            <div class="modal-header shadow-lg bg">
                <button type="button" class="close text-danger rounded" data-dismiss="modal" aria-label="Close">
                    <span  aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body bg p-4 text-dark b text-center">
               <div class="text-success">
                {!! session()->get('success_message') !!}
            </div>
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



@if (auth()->user())

    <!-- ==============PAIEMENT MOBILE============= -->
                                                  
    <?php
        $acid="167";
        $key = "eb53195f1b3a37c5d4330bcac3e05b28b3926c26";
        $token = "46fd45e4160e46ab9221f481e5149ecd3c90eac6";
        $sign = md5($token . $key);
        $signature = $sign;
        $currency = "XAF";
        $amount = Cart::total();
        $datetrans = date('Y-m-d H:i:s');
        $emailId = "caviaros123@gmail.com";
        $successurl="https://kalisso.com/merci";
        $cancelurl="https://kalisso.com/erreur";
    ?>

   
<div class="container padding-y">


  <!--   <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h2>Checkout form</h2>
        <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
    </div> -->
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4 padding-y">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Votre panier</span>
                <span class="badge badge-danger badge-pill">{{Cart::content('default')->count()}}</span>
            </h4>
            <ul class="list-group mb-3 sticky-top">
                @foreach(Cart::content() as $data )
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div class="row p-2 mr-0">
                            <div class="img-wrap pt-2 shadow-lg mr-0 img-sm border-right">
                                <img class="mr-0 p-0 rounded shadow-sm" src="{{Voyager::image($data->options->images)}}">
                            </div>
                        </div>
                        <a  href="{{route('cart.show', $data->model->slug)}}"><h6 class="my-0 text-muted b">{{ $data->name }}</h6></a>

                        <small class="text-muted pr-3">Qté: {{$data->qty}}</small>
                        <span class=" b text-danger">{{ presentPrice($data->subtotal) }}</span>
                    </li>

                @endforeach
                @if(session()->has('coupon'))
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small class="text-uppercase">{{session()->get('coupon')['name']}}</small>
                        </div>
                        <span class="text-success">-{{ presentPrice($discount) }}</span>
                        <form action="{{ route('coupon.destroy')}}" method="POST" style="display: inline;"> 
                            @csrf
                            @method('delete')
                              <button type="submit" class="btn btn-danger btn-sm" title="Retirer la réduction" value="Retirer"><i class="fa fa-trash"></i>
                              </button>
                          </form>
                    </li>

                @endif    
                <li class="list-group-item d-flex justify-content-between">
                    <span class="h3 b">Total :</span>
                    <strong class="h4">{{ presentPrice(Cart::total()-$discount) }}</strong>
                </li>
            </ul>
            @if(!session()->has('coupon'))
                <form class="card p-2" action="{{ route('coupon.store') }}" method="POST">
                    @csrf
                        <label for="coupon_code" class="text-muted pb-2 m-left b p-1"> Vous Avez un Code Promo?</label>
                    <div class="input-group">
                        <input id="coupon_code" type="text" name="coupon_code" placeholder="Votre coupon ici..." class="form-control " required="required">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">Appliquer</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3 ">Adresse de facturation</h4>

            

            <form id="Checkout_Submit" class="needs-validation" novalidate="" action="{{ route('checkout.store') }}" method="post">
                @csrf
                @if(\DB::table('tbl_address')->where('user_id', auth()->id())->where('default_address', 1)->get())
                <br>
                <div class="container">
                    <div class="card p-2 rounded shadow border-solid border-success">
                        <div class="card-body">
                            <p>
                                <label class="b text-success h5">Votre adresse sauvegardée:</label>
                                <br>
                                <ul class="nav navbar-nav">

                                    @forelse(\DB::table('tbl_address')->where('user_id', auth()->id())->where('default_address', 1)->get() as $address)
                                    <li class="b text-danger">
                                        ID: {{$address ?? ''->title}}
                                    </li>
                                    <li>
                                        {{$address ?? ''->recipient_name}}
                                    </li>
                                    <li>
                                        {{$address ?? ''->phone_number}}
                                    </li>
                                    <li>
                                        {{$address ?? ''->address_line1}}
                                    </li>
                                    <li>
                                        {{$address ?? ''->country}}
                                    </li>
                                    <li>
                                        {{$address ?? ''->state}}
                                    </li>
                                    @empty
                                        <li>
                                            <p>Vous n'avez aucune adresse sauvegarder</p>
                                        </li>
                                    @endforelse
                                </ul>
                            </p>
                        </div>
                        <div class="card-footer" align="right">
                            <button class="btn btn-danger rounded my-1 ">Modifier <i class="fa fa-edit pl-2"></i></button>
                        </div>
                    </div>

                </div>
                @endif
                <div  @if(\DB::table('tbl_address')->where('user_id', auth()->id())->where('default_address', 1)->get()) hidden="hidden" @else   @endif>
                    <div class="row" >
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Nom<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="firstName" placeholder=""  value="{{auth()->user()->name ?? $address ?? ''->recipient_name}}" required="">
                            <div class="invalid-feedback"> Valid first name is required. </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Prénom<span class="text-danger">*</span></label>
                            <input type="text" name="lastname" class="form-control" id="lastName" placeholder="" value="{{auth()->user()->lastname ?? $address ?? ''->recipient_name}}" required="">
                            <div class="invalid-feedback"> Valid last name is required. </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email">Téléphone <span class="text-danger">*</span></label>
                        <input type="tel" name="phone" class="form-control text-danger" id="email" placeholder="00 000 00 00" value="{{auth()->user()->phone ?? $address ?? ''->phone_number}}" maxlength="9" minlength="9" required="required">
                        <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                    </div>

                     <div class="mb-3">
                        <label for="email">Email <span class="text-danger">(Facultatif)</span></label>
                        <input type="email" name="email" value="{{auth()->user()->email ?? $address ?? ''->recipient_name}}" class="form-control" id="email" required="" placeholder="you@example.com" >
                        <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                    </div>
                    <div class="mb-3">
                        <label for="address">Adresse<span class="text-danger">* Ex: 1234 rue dolisie Moungali </span></label>
                        <input type="text" class="form-control" id="address" value="{{$address ?? ''->address_line1 ?? ''}}" placeholder="" name="address" required="">
                        <div class="invalid-feedback"> Please enter your shipping address. </div>
                    </div>
                  
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Pays<span class="text-danger">*</span></label>
                            <select class="custom-select d-block w-100" name="country" id="country" required="">
                                <option hidden="hidden">Choisir votre pays...</option>
                                <option hidden="hidden" value="{{ $address ?? ''->country ?? ''}}" selected="selected">{{ $address ?? ''->country ?? '' }}</option>
                                @foreach(App\Pay::get() as $pays)
                                        <option  value="{{$pays->name}}">{{$pays->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"> Please select a valid country. </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">Ville<span class="text-danger">*</span></label>
                            <select class="custom-select d-block w-100" name="city" id="state" required="">
                               <option hidden="hidden" selected="selected">Choisir votre ville...</option>
                               <option hidden="hidden" value="{{ $address ?? ''->state }}" selected="selected">{{ $address ?? ''->state }}</option>
                                @foreach(App\City::get() as $ville)
                                        <option value="{{$ville->name}}">{{$ville->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"> Please provide a valid state. </div>
                        </div>
                        
                    </div>
                    <input type="hidden" name="amount" value="{{ $amount }}" />
                    <input type="hidden" name="signature" value="{{ $sign }}" />
                    <input type="hidden" name="acid" value="{{ $acid }}" />
                    <input type="hidden" name="emailId" value="{{ $emailId }}" />
                    <input type="hidden" name="successurl" value="{{ $successurl }}" />
                    <input type="hidden" name="cancelurl" value="{{ $cancelurl }}" />
                    <input type="hidden" name="currency" value="{{ $currency }}" />
                    <input type="hidden" name="Reference" value="{{ rand() }}" />
                    <hr class="mb-2">
                    <input type="text" hidden name="payment_gateway" value="epay">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="save_address"  class="custom-control-input" id="save-info">
                        <label class="custom-control-label label-danger" for="save-info">Sauvegarder cette adresse pour ma prochaine commande</label>
                    </div>
                    </div> 
                
                <hr>
                {{-- <div class="d-none d-md-block">
                    <button type="submit"  class="btn-lg btn-success form-control">Valider</button>
                </div> --}}
            </form>
             <p class="text-muted padding-y-sm"><strong>Note:</strong> Une fois validez, vous recevrez un message sur votre mobile afin de finaliser la transaction.</p>
             <ul class="list-inline mb-4 space-between text-center">
                {{-- <li class="list-inline-item"><a href="#">Privacy</a></li> --}}
                <li class="list-inline-item text-muted"><a class="text-muted " href="/reglement">Terms & Contditions</a></li>
                <li class="list-inline-item text-muted"><a class="text-muted " href="/aide">Assistance?</a></li>
            </ul>
        </div>
       
    </div>
    
       
    
</div>




@else

<!-- WEB VIEW UI-->

   
<div class="container padding-y">
  <!--   <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h2>Checkout form</h2>
        <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
    </div> -->
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4 padding-y">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Votre panier</span>
                <span class="badge badge-danger badge-pill">{{Cart::content('default')->count()}}</span>
            </h4>
            <ul class="list-group mb-3 sticky-top">
                @foreach(Cart::content() as $data )
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div class="row p-2 mr-0">
                            <div class="img-wrap pt-2 shadow-lg mr-0 img-sm border-right">
                                <img class="mr-0 p-0" src="{{$data->options->images}}">
                            </div>
                        </div>
                        <a  href="{{route('cart.show', $data->model->slug)}}"><h6 class="my-0 text-muted b">{{ $data->name }}</h6></a>

                        <small class="text-muted pr-3">Qté: {{$data->qty}}</small>
                        <span class=" b text-danger">{{ presentPrice($data->subtotal) }}</span>
                    </li>

                @endforeach
                @if(session()->has('coupon'))
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small class="text-uppercase">{{session()->get('coupon')['name']}}</small>
                        </div>
                        <span class="text-success">-{{ presentPrice($discount) }}</span>
                        <form action="{{ route('coupon.destroy')}}" method="POST" style="display: inline;"> 
                            @csrf
                            @method('delete')
                              <button type="submit" class="btn btn-danger btn-sm" title="Retirer la réduction" value="Retirer"><i class="fa fa-trash"></i>
                              </button>
                          </form>
                    </li>

                @endif    
                <li class="list-group-item d-flex justify-content-between">
                    <span class="h3 b">Total :</span>
                    <strong class="h4">{{ presentPrice(Cart::total()-$discount) }}</strong>
                </li>
            </ul>
            @if(!session()->has('coupon'))
                <form class="card p-2" action="{{ route('coupon.store') }}" method="POST">
                    @csrf
                        <label for="coupon_code" class="text-muted pb-2 m-left b p-1"> Vous Avez un Code Promo?</label>
                    <div class="input-group">
                        <input id="coupon_code" type="text" name="coupon_code" placeholder="Votre coupon ici..." class="form-control " required="required">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">Appliquer</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Adresse de facturation</h4>
           

            <form id="Checkout_Submit" class="needs-validation"  novalidate=""  method="post">
                @csrf
                <input hidden type="number" name="amount" value="{{Cart::total()}}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Nom<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" id="firstName" placeholder=""  value="{{auth()->user()->name}}" required="">
                        <div class="invalid-feedback"> Valid first name is required. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Prénom<span class="text-danger">*</span></label>
                        <input type="text" name="lastname" class="form-control" id="lastName" placeholder="" value="{{auth()->user()->lastname}}" required="">
                        <div class="invalid-feedback"> Valid last name is required. </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="email">Téléphone <span class="text-danger">*</span></label>
                    <input type="email" name="phone" class="form-control text-danger" id="email" placeholder="00 000 00 00" value="{{auth()->user()->phone}}" maxlength="9" minlength="9" required="required">
                    <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                </div>

                 <div class="mb-3">
                    <label for="email">Email <span class="text-danger">(Facultatif)</span></label>
                    <input type="email" name="email" value="{{auth()->user()->email ?? ''}}" class="form-control" id="email" placeholder="you@example.com">
                    <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                </div>


                <div class="mb-3">
                    <label for="address">Adresse<span class="text-danger">* Ex: 1234 rue dolisie Moungali </span></label>
                    <input type="text" class="form-control" id="address" placeholder="" name="address" required="">
                    <div class="invalid-feedback"> Please enter your shipping address. </div>
                </div>
                <div class="mb-3">
                    <label for="address2">Adresse 2 <span class="text-danger">(Facultatif)</span></label>
                    <input type="text" name="address" class="form-control" id="address2" placeholder="Apartment or suite">
                </div>
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Pays<span class="text-danger">*</span></label>
                        <select class="custom-select d-block w-100" name="country" id="country" required="">
                            <option hidden="hidden" >Choisir...</option>
                            @foreach(App\Pay::get() as $pays)
                                    <option  value="{{$pays->name}}">{{$pays->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"> Please select a valid country. </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">Ville<span class="text-danger">*</span></label>
                        <select class="custom-select d-block w-100" name="city" id="state" required="">
                           <option hidden="hidden" value="">Choisir...</option>
                            @foreach(App\City::get() as $ville)
                                    <option  value="{{$ville->name}}">{{$ville->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"> Pveuillez fournir un pays valide. </div>
                    </div>
                    <div hidden="hidden" class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" placeholder="" name="phone_code" value="242" required="">
                        <div class="invalid-feedback"> Zip code required. </div>
                    </div>
                </div>
                
                <hr class="mb-2">
                <h4 class="mb-3">Moyens de paiements</h4>
                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
                        <label class="custom-control-label" for="credit">MTN MoMo</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
                        <label class="custom-control-label" for="debit">AIRTEL Money card</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
                        <label class="custom-control-label" for="paypal">PayPal</label>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-name">Name on card</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                        <small class="text-muted">Full name as displayed on card</small>
                        <div class="invalid-feedback"> Name on card is required </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">Credit card number</label>
                        <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                        <div class="invalid-feedback"> Credit card number is required </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">Expiration</label>
                        <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                        <div class="invalid-feedback"> Expiration date required </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cc-cvv">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                        <div class="invalid-feedback"> Security code required </div>
                    </div>
                </div> -->
                <hr class="mb-2">
           
                <!-- <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="" class="custom-control-input"  id="same-address">
                    <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                </div> -->
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="save_address" class="custom-control-input" id="save-info">
                    <label class="custom-control-label" for="save-info">Sauvegarder ces informations pour une prochaine commande</label>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" name="submit" value="epay" type="submit">Valider le paiement</button>
            </form>
        </div>
    </div>
    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="text-muted padding-y-sm"><strong>Note:</strong> Une fois validez vous recevrez un message sur votre mobile afin de finaliser la transaction.</p>
        <ul class="list-inline">
            {{-- <li class="list-inline-item"><a href="#">Privacy</a></li> --}}
            <li class="list-inline-item"><a href="/reglement">Terms et conditions</a></li>
            <li class="list-inline-item"><a href="/aide">Support</a></li>
        </ul>
    </footer>
</div>



@endif

@stop


@section('js')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript">

     $(window).on("load", function() { 
        (function myOnLoadFunc(){
            $('#exampleModalCenter').modal('show');
        })();


    });


    // function orderPost() {

    //      var postData = {
    //        'phone' => '+242064272080',
    //         'amount' =>  '100',
    //         'pin_code' => '1122',
    //     };

    //     let axiosConfig = {
    //       headers: {
    //             'Accept' => 'application/json; charset=UTF-8',
    //             'apiClientCode' => '1580436250',
    //             'apiClientToken' => '15523Tdy2Jx5S07LM81Qh4',
    //       }
    //     };

    //     axios.post('http://www.digibox.cg/api/momo/digibox/request-payment-autorization-code', postData, axiosConfig)
    //     .then((res) => {

    //         alert('success_message'+res);
    //       console.log("RESPONSE RECEIVED: ", res);
    //     })
    //     .catch((err) => {
    //         alert('error'+err);

    //       console.log("AXIOS ERROR: ", err);
    //     })


    //   }
    // ;


    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
      'use strict'

      window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation')

        // Loop over them and prevent submission
        Array.prototype.filter.call(forms, function (form) {
          form.addEventListener('submit', function (event) {
            if (form.checkValidity() === false) {
              event.preventDefault()
              event.stopPropagation()
            }
            form.classList.add('was-validated')
          }, false)
        })
      }, false)
    }())
</script>
@stop
