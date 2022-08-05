<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="{{setting('site.description')}}">
  <meta name="keywords" content="auto, immo, location, maison, voiture">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{asset('storage/'.setting('site.logo'))}}" type="image/png">

  <title>{{ setting('site.title') }} | @yield('title') </title>
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  @yield('css')
  @yield('withdrawl_css')
  @yield('decouvert_css')
  @yield('deposit_css')
  @yield('transfert_css')
  <style type="text/css">
      .select2-container .select2-selection--single .select2-selection__rendered{
          padding-right: 7rem!important;
      }
  </style>
  <link href="{{asset('src/select2.min.css')}}" rel="stylesheet" />
  <script src="{{asset('src/select2.min.js')}}" defer></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div id="app">

    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>

        </ul>
      </nav>
      @include('partials.nav')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        @yield('content')
        @include('pages.modal_global.show')
      </div>
      <!-- /.content-wrapper -->

      @yield('footer')
    </div>
  </div>

  <!-- Js Plugins -->
  
    
 <script src="{{asset('js/app.js')}}" ></script> 
  @yield('js')
  @yield('withdrawl_js')
  @yield('decouvert_js')
  @yield('deposit_js')
  @yield('transfert_js')
  <script type="text/javascript">
      $(document).ready(function(){
        $('.notfound').hide();
        // Search all columns
        $('#txt_searchall').keyup(function(){
          // Search Text
          var search = $(this).val();

          // Hide all table tbody rows
          $('table tbody tr').hide();

          // Count total search result
          var len = $('table tbody tr:not(.notfound) td:contains("'+search+'")').length;

          if(len > 0){
            // Searching text in columns and show match row
            $('table tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
              $(this).closest('tr').show();
            });

          }else{
            // $('.notfound').removeAttribute("hidden");
            $('.notfound').show();
          }

        });

        // Search on name column only
        $('#txt_name').keyup(function(){
          // Search Text
          var search = $(this).val();

          // Hide all table tbody rows
          $('table tbody tr').hide();

          // Count total search result
          var len = $('table tbody tr:not(.notfound) td:nth-child(2):contains("'+search+'")').length;

          if(len > 0){
            // Searching text in columns and show match row
            $('table tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
               $(this).closest('tr').show();
            });
          }else{
            $('.notfound').show();
          }

        });

      });

    // Case-insensitive searching (Note - remove the below script for Case sensitive search )
    $.expr[":"].contains = $.expr.createPseudo(function(arg) {
       return function( elem ) {
         return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
       };
    });

    $(document).ready(function() {
        $('.js-example-basic-single').select2({
           placeholder:  'Selectionner un membre',
           allowClear: true
        });
    });

    
</script>

  <!-- AdminLTE App -->

  <script src="{{asset('assets/dist/js/adminlte.js')}}"></script>  
    
</body>

</html>