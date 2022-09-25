@extends('layouts.master')

@section('title', 'Aide & FAQ')

@include('layouts.navbar')

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


<div class="container-fluid">
    <!-- Row -->
    <div class="row">
        <div class="col-xl-12 pa-0">
            <div class="faq-search-wrap bg-teal-light-3">
                <div class="container">
                    <h1 class="display-5 text-white mb-20">Ask a question or browse by category below.</h1>
                    <div class="form-group w-100 mb-0">
                        <div class="input-group">
                            <input class="form-control form-control-lg filled-input bg-white" placeholder="Search by keywords" type="text">
                            <div class="input-group-append">
                                <span class="input-group-text"><span class="feather-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-sm-60 mt-30">
                <div class="hk-row">
                    <div class="col-xl-4">
                        <div class="card">
                            <h6 class="card-header">
                                            Category
                                        </h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex align-items-center active">
                                    <i class="ion ion-md-sunny mr-15"></i>Terms &amp; conditions<span class="badge badge-light badge-pill ml-15">06</span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="ion ion-md-unlock mr-15"></i>Privacy policy<span class="badge badge-light badge-pill ml-15">14</span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="ion ion-md-bookmark mr-15"></i>Terms of use<span class="badge badge-light badge-pill ml-15">10</span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="ion ion-md-filing mr-15"></i>Documentation<span class="badge badge-light badge-pill ml-15">27</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card card-lg">
                            <h3 class="card-header border-bottom-0">
                                            Terms and Conditions
                                        </h3>
                            <div class="accordion accordion-type-2 accordion-flush" id="accordion_2">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between activestate">
                                        <a role="button" data-toggle="collapse" href="#collapse_1i" aria-expanded="true">The Intellectual Property</a>
                                    </div>
                                    <div id="collapse_1i" class="collapse show" data-parent="#accordion_2" role="tabpanel">
                                        <div class="card-body pa-15">The Intellectual Property disclosure will inform users that the contents, logo and other visual media you created is your property and is protected by copyright laws.</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_2i" aria-expanded="false">Termination clause</a>
                                    </div>
                                    <div id="collapse_2i" class="collapse" data-parent="#accordion_2">
                                        <div class="card-body pa-15">A Termination clause will inform that users’ accounts on your website and mobile app or users’ access to your website and mobile (if users can’t have an account with you) can be terminated in case of abuses or at your sole discretion.</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_3i" aria-expanded="false">Governing Law</a>
                                    </div>
                                    <div id="collapse_3i" class="collapse" data-parent="#accordion_2">
                                        <div class="card-body pa-15">A Governing Law will inform users which laws govern the agreement. This should the country in which your company is headquartered or the country from which you operate your website and mobile app.</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_4i" aria-expanded="false">Limit what users can do</a>
                                    </div>
                                    <div id="collapse_4i" class="collapse" data-parent="#accordion_2">
                                        <div class="card-body pa-15">A Limit What Users Can Do clause can inform users that by agreeing to use your service, they’re also agreeing to not do certain things. This can be part of a very long and thorough list in your Terms and Conditions agreements so as to encompass the most amount of negative uses.</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_5i" aria-expanded="false">Limitation of liability of your products</a>
                                    </div>
                                    <div id="collapse_5i" class="collapse" data-parent="#accordion_2">
                                        <div class="card-body pa-15">No matter what kind of goods you sell, best practices direct you to present any warranties you are disclaiming and liabilities you are limiting in a way that your customers will notice.</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_6i" aria-expanded="false">How to enforce Terms and Conditions</a>
                                    </div>
                                    <div id="collapse_6i" class="collapse" data-parent="#accordion_2">
                                        <div class="card-body pa-15">While creating and having a Terms and Conditions is important, it’s far more important to understand how you can make the Terms and Conditions enforceable. You should always use clickwrap to get users to agree to your Terms and Conditions. Clickwrap is when you make your users take some action – typically clicking something – to show they’re agreeing. Here’s how Engine Yard uses the clickwrap agreement with the I agree check box:</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->
</div>



@include('layouts.footer')
@stop

@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.2.0/css/ionicons.min.css" integrity="sha256-F3Xeb7IIFr1QsWD113kV2JXaEbjhsfpgrKkwZFGIA4E=" crossorigin="anonymous" />



@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
    var x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude + 
        "<br>Longitude: " + position.coords.longitude;
    }
    </script>
@stop