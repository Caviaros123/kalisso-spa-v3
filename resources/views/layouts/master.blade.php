<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Kalisso.com">
	<meta charset="utf-8" name="acceuil" content="Achat et vente en ligne parmi des millions de produits en stock. Livraison gratuite à partir de 2.000Fcfa. Vos articles à petits prix : culture, high-tech, mode, jouets, sport ...">

	<meta name="facebook-domain-verification" content="gzle0io231unljen9dwbd88zbu03w0" />
	<meta name="p:domain_verify" content="54a2f03ee61e85df18a9aee867e4baa4"/>
	<title>Kalisso.com - @yield('title') </title>
	<link rel="shortcut icon" href="{{ asset('site_kali_icon.png') }}" type="image/png" title="icon">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<?php setlocale(LC_TIME, 'fr_FR.utf8', 'fra'); ?>
	@include('assets.css')

	@yield('extra-css')

	<style type="text/css">
		#load {
			width: 100%;
			height: 100%;
			size: 100px !important;
			position: fixed;
			z-index: 9999;
			background: url("oie_tSD8zDBU9WRl.gif") no-repeat center center rgba(0, 0, 0, 0.50)
		}


		.back-to-top {
			position: fixed;
			bottom: 25px;
			right: 25px;
			display: none;
		}
	</style>
	<!-- Facebook Pixel Code -->
	<script>
		! function(f, b, e, v, n, t, s) {
			if (f.fbq) return;
			n = f.fbq = function() {
				n.callMethod ?
					n.callMethod.apply(n, arguments) : n.queue.push(arguments)
			};
			if (!f._fbq) f._fbq = n;
			n.push = n;
			n.loaded = !0;
			n.version = '2.0';
			n.queue = [];
			t = b.createElement(e);
			t.async = !0;
			t.src = v;
			s = b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t, s)
		}(window, document, 'script',
			'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '242037474240129');
		fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=242037474240129&ev=PageView&noscript=1" /></noscript>
	<!-- End Facebook Pixel Code -->
	<script>
		window.fbAsyncInit = function() {
			FB.init({
				appId: '226942292235939',
				cookie: true,
				xfbml: true,
				version: 'v10.0'
			});

			FB.AppEvents.logPageView();

		};

		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {
				return;
			}
			js = d.createElement(s);
			js.id = id;
			js.src = "https://connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/594986ad5598a994d46f4a17f/6ddb370b31a3d957474c953ec.js");</script>
	<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
	  <script>

	    // Enable pusher logging - don't include this in production
	    Pusher.logToConsole = true;

	    var pusher = new Pusher('9de644d8a0cf1a1c4aec', {
	      cluster: 'eu'
	    });

	    var channel = pusher.subscribe('my-channel');
	    channel.bind('my-event', function(data) {
	      alert(JSON.stringify(data));
	    });
	  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body >
	
	<div id="app">

		
		<div id="load" class="text-danger"></div>
		<!-- <img src="svg-loaders/circles.svg" width="50" alt=""> -->
		@yield('navbar-menu')

		@yield('content')

		{{-- <a id="back-to-top" href="#" class="btn btn-danger bg-danger text-light btn-lg my-5 back-to-top" role="button">
			<i class="fas fa-chevron-up"></i>
		</a> --}}

		@if(request()->is('shop/*') || request()->is('show/*'))

			@include('partials.shop_nav_footer')

		@elseif(request()->is('checkout'))

			@include('partials.nav_checkout')

		@else
			@include('partials.nav_footer')
		@endif

		<!-- //cookies -->
		

		@yield('footer')
		<!-- Messenger Plug-in Discussion Code -->
	   
	</div>

	<script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
	<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
	<!-- TODO: Add SDKs for Firebase products that you want to use
	     https://firebase.google.com/docs/web/setup#available-libraries -->
	<script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-analytics.js"></script>

	<script>
	  // Your web app's Firebase configuration
	  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
	  var firebaseConfig = {
	    apiKey: "AIzaSyCc2BBFgf_osbxj-5-E_KQKEV4SuATFuRI",
	    authDomain: "kalisso-298808.firebaseapp.com",
	    projectId: "kalisso-298808",
	    storageBucket: "kalisso-298808.appspot.com",
	    messagingSenderId: "84460790081",
	    appId: "1:84460790081:web:5fd6866e8ca6be405601c0",
	    measurementId: "G-GYX9DFZG8J"
	  };
	  // Initialize Firebase
	  firebase.initializeApp(firebaseConfig);
	  firebase.analytics();
	</script>

	@yield('js')

	@include('assets.js')

	@yield('extra-js')



	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>

	
{{-- 	<script type="text/javascript">
		if (process.env.MIX_ENV_MODE === 'production') {
		    Vue.config.devtools = false;
		    Vue.config.debug = false;
		    Vue.config.silent = true; 
		}
	</script> --}}

	 <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v10.0'
          });
        };

        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/fr_FR/sdk/xfbml.customerchat.js';
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>

      <!-- Your Plug-in Discussion code -->
      <div class="fb-customerchat"
        attribution="biz_inbox"
        page_id="112662330510760">
      </div>

		<script>

		document.onreadystatechange = function() {
			var state = document.readyState
			if (state == 'interactive') {
				document.getElementById('app').style.visibility = "hidden";
			} else if (state == 'complete') {
			setTimeout(function() {
				document.getElementById('interactive');
				document.getElementById('load').style.visibility = "hidden";
				document.getElementById('app').style.visibility = "visible";
		}, 1000);
			}
		}


		$(document).ready(function() {
			$(window).scroll(function() {
				if ($(this).scrollTop() > 50) {
					$('#back-to-top').fadeIn();
				} else {
					$('#back-to-top').fadeOut();
				}
			});
			// scroll body to 0px on click
			$('#back-to-top').click(function() {
				$('body,html').animate({
					scrollTop: 0
				}, 400);
				return false;
			});
		});


	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<!-- The core Firebase JS SDK is always required and must be listed first -->

	
  	
</body>
</html>