<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
   <img class="animation__shake" src="{{ asset('template/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
</div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
   <!-- Left navbar links -->
   <ul class="navbar-nav">
      <li class="nav-item">
         <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
         <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
         <a href="#" class="nav-link">Contact</a>
      </li> --}}
   </ul>
   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!-- <li class="nav-item">
         <a class="nav-link" data-widget="navbar-search" href="#" role="button">
         <i class="fas fa-search"></i>
         </a>
         <div class="navbar-search-block">
            <form class="form-inline">
               <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                     <button class="btn btn-navbar" type="submit">
                     <i class="fas fa-search"></i>
                     </button>
                     <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                     <i class="fas fa-times"></i>
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </li> -->
      <!-- Messages Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
         <a class="nav-link" data-toggle="dropdown" href="#">
         <i class="far fa-comments"></i>
         <span class="badge badge-danger navbar-badge">3</span>
         </a>
         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
               <div class="media">
                  <img src="{{ asset('template/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                  <div class="media-body">
                     <h3 class="dropdown-item-title">
                        Brad Diesel
                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                     </h3>
                     <p class="text-sm">Call me whenever you can...</p>
                     <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
               </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
               <div class="media">
                  <img src="{{ asset('template/dist/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                     <h3 class="dropdown-item-title">
                        John Pierce
                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                     </h3>
                     <p class="text-sm">I got your message bro</p>
                     <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
               </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
               <div class="media">
                  <img src="{{ asset('template/dist/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                     <h3 class="dropdown-item-title">
                        Nora Silvester
                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                     </h3>
                     <p class="text-sm">The subject goes here</p>
                     <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
               </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
         </div>
      </li> -->
      <!-- Notifications Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
         <a class="nav-link" data-toggle="dropdown" href="#">
         <i class="far fa-bell"></i>
         <span class="badge badge-warning navbar-badge">15</span>
         </a>
         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
         </div>
      </li> -->
      <!-- Profile Dropdown Menu -->
      <li class="nav-item dropdown">
         <a class="nav-link" data-toggle="dropdown" href="#" style="padding-top:4px;">
            @if (auth()->user()->profile_picture)
               <img src="{{asset('storage/' . auth()->user()->profile_picture)}}" alt="{{auth()->user()->name}}" class="img-circle" style="width:30px;height:auto;">
            @else
               <img src="{{asset('template/dist/img/user.png')}}" alt="{{auth()->user()->name}}" class="img-circle" style="width:30px;height:auto;">
            @endif
         </a>
         <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
            @can('user_myprofile')
               <a href="{{route('myProfile')}}" class="dropdown-item">
                  <i class="fas fa-user mr-2"></i> Meu Perfil
               </a>
            @endcan
            @can('my_company')
               <a href="{{route('myCompany')}}" class="dropdown-item">
                  <i class="fas fa-university mr-2"></i> Minha Empresa
               </a>
            @endcan
            <div class="dropdown-divider"></div>
            <a href="{{route('logout')}}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Sair do sistema">
               <i class="fas fa-power-off mr-2"></i> Sair
            </a>
         </div>
      </li>
   </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="index3.html" class="brand-link">
   <img src="{{ asset('template/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
   <span class="brand-text font-weight-light">Artisan CRM</span>
   </a>
   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
               <a href="{{route('dashboard')}}" class="nav-link">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                     Dashboard
                  </p>
               </a>
            </li>
            <li class="nav-item">
               @can('viewAny', \App\Models\Company::class)
                  <a href="{{route('company.index')}}" class="nav-link">
                     <i class="nav-icon fas fa-university"></i>
                     <p>
                        Empresas
                     </p>
                  </a>
               @endcan
            </li>
            @can('viewAny', \App\Models\User::class)
               <li class="nav-item">
                  <a href="{{route('user.index')}}" class="nav-link">
                     <i class="nav-icon fas fa-users"></i>
                     <p>Usuários</p>
                  </a>
               </li>
            @endcan
            @can('viewAny', \App\Models\Lead::class)
               <li class="nav-item">
                  <a href="{{route('lead.index')}}" class="nav-link">
                     <i class="nav-icon fas fa-funnel-dollar"></i>
                     <p>Leads</p>
                  </a>
               </li>
            @endcan
            @if (Auth::user()->can('viewAny', \App\Models\Permission::class) || Auth::user()->can('viewAny', \App\Models\Profile::class) || Auth::user()->can('viewAny', \App\Models\Product::class) || Auth::user()->can('viewAny', \App\Models\Origin::class))
               <li class="nav-item">
                  <a href="#" class="nav-link">
                     <i class="nav-icon fas fa-cogs"></i>
                     <p>
                        Configurações
                        <i class="right fas fa-angle-left"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: none;">
                     @can('viewAny', \App\Models\Permission::class)
                        <li class="nav-item">
                           <a href="{{route('permission.index')}}" class="nav-link">
                              <p>Permissões</p>
                           </a>
                        </li>
                     @endcan
                     @can('viewAny', \App\Models\Profile::class)
                        <li class="nav-item">
                           <a href="{{route('profile.index')}}" class="nav-link">
                              <p>Perfis</p>
                           </a>
                        </li>
                     @endcan
                     @can('viewAny', \App\Models\Product::class)
                        <li class="nav-item">
                           <a href="{{route('product.index')}}" class="nav-link">
                              <p>Produtos</p>
                           </a>
                        </li>
                     @endcan
                     @can('viewAny', \App\Models\Origin::class)
                        <li class="nav-item">
                           <a href="{{route('origin.index')}}" class="nav-link">
                              <p>Origens</p>
                           </a>
                        </li>
                     @endcan
                  </ul>
               </li>
            @endif
            <!-- <li class="nav-item">
               <a href="pages/widgets.html" class="nav-link">
                  <i class="nav-icon fas fa-bell"></i>
                  <p>
                     Novidades
                  </p>
               </a>
            </li> -->
            <li class="nav-item">
               <a href="{{route('logout')}}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Sair do sistema">
                  <i class="nav-icon fas fa-power-off"></i>
                  <p>
                     Sair
                  </p>
               </a>
               <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                  @csrf
               </form>
            </li>
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>