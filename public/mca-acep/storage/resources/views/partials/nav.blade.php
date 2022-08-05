<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link" >
    <img src="{{ asset('logo.png')}}" alt="{{setting('site.title')}} Logo" class="brand-image " style="opacity: .8">
    <span class="brand-text font-weight-bold ">{{setting('site.title')}}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ Voyager::image(auth()->user()->avatar) ?? asset('logo.png')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{auth()->user() ? auth()->user()->name : ''}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item active">
          <a href="/" class="nav-link @if(request()->is('/*')) active @else   @endif ">
            <i class="nav-icon fa fa-home"></i>
            <p>
              Tableau de bord

            </p>
          </a>
        </li>
         <li class="nav-item ">
          <a href="/users" class="nav-link ">
            <i class="fa fa-users nav-icon"></i>
            <p> Tous les Utilisateurs</p>
          </a>
        </li>
        <li class="nav-item ">
          <a href="/transactions" class="nav-link ">
            <i class="far fa-circle nav-icon"></i>
            <p>Transactions</p>
          </a>
        </li>
        <li class="nav-item has-treeview ">
          <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Gestion
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item pl-2">
              <a href="/bank/group/account" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Groupes Banque</p>
              </a>
            </li>
            <li class="nav-item pl-2">
              <a href="/scorecard/all/account/group" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Groupes Cartes</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview ">
          <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Banque
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item pl-2">
              <a href="{{route('bank.index')}}" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Listes des comptes</p>
              </a>
            </li>
            <li class="nav-item pl-2">
              <a href="{{ route('bank.group.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Groupes</p>
              </a>
            </li> 
          </ul>
        </li>
        <li class="nav-item has-treeview ">
          <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-calendar"></i>
            <p>
              Carte de pointage
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item pl-2">
              <a href="{{ route('carte.index')}}" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Listes des cartes</p>
              </a>
            </li>
            <li class="nav-item pl-2">
              <a href="{{ route('carte.group.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Groupes</p>
              </a>
            </li>
          </ul>
        </li>
        <hr>       {{--  <li class="nav-item">
          <a href="pages/widgets.html" class="nav-link">
            <i class="nav-icon fas fa-tools"></i>
            <p>
              Paramètres

            </p>
          </a>
        </li> --}}
      </ul>
    </nav>
      <div class="zoom-wrap">
          <a class="text-light form-control text-center shadow zoom-in btn btn-danger" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          Déconnexion <span class="fa fa-power-off"></span>
        </a>
      </div>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
      </form>
    <!-- /.sidebar-menu -->
    <!-- SECTION NAV -->
  </div>
  <!-- /.sidebar -->
</aside>