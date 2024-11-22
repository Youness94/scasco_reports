<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('accueil') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::to('img/favicon.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::to('img/logo.png') }}" alt="" height="45">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('accueil') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::to('img/favicon.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::to('img/logo.png') }}" alt="" height="45">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>Menu</span></li>
                <a class="nav-link menu-link" href="{{route('accueil')}}">
                    <i class="ri-dashboard-2-line"></i>
                    <span>Tableau de Bord</span>
                </a>

                @if (Auth::check() && (Auth::user()->can('voir les utilisateurs') || Auth::user()->can('créer utilisateur')) )
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs('all.client.users') || request()->routeIs('add.client.user')  ? 'true' : 'false' }}"  aria-controls="sidebarAuth">
                        <i class="ri-admin-fill"></i> <span>Utilisateurs</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('all.client.users') || request()->routeIs('add.client.user')  ? 'show' : '' }}" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            @can('voir les utilisateurs')
                            <li class="nav-item">
                                <a href="{{ route('all.client.users') }}" class="nav-link {{ Route::is('all.client.users') ? 'active' : '' }}">Liste des utilisateurs
                                </a>

                            </li>
                            @endcan
                            @can('créer utilisateur')
                            <li class="nav-item">
                                <a href="{{ route('add.client.user') }}" class="nav-link {{ Route::is('all.client.user') ? 'active' : '' }}">Ajouter un utilisateur
                                </a>
                            </li>
                            @endcan

                        </ul>
                    </div>
                </li>
                @endif

                @if (Auth::check() && (Auth::user()->can('voir les admins') || Auth::user()->can('créer admin')) && Auth::user()->user_type === 'Admin')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAdmin" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs('all.users') || request()->routeIs('add.user')  ? 'true' : 'false' }}" aria-controls="sidebarAdmin">
                        <i class="ri-admin-fill"></i> <span>Admins</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('all.admins') || request()->routeIs('add.admin')  ? 'show' : '' }}" id="sidebarAdmin">
                        <ul class="nav nav-sm flex-column">
                            @can('voir les admins')
                            <li class="nav-item">
                                <a href="{{ route('all.admins') }}" class="nav-link {{ Route::is('all.admins') ? 'active' : '' }}">Liste des admins
                                </a>

                            </li>
                            @endcan
                            @can('créer admin')
                            <li class="nav-item">
                                <a href="{{ route('add.admin') }}" class="nav-link {{ Route::is('add.admin') ? 'active' : '' }}">Ajouter un admin
                                </a>
                            </li>
                            @endcan

                        </ul>
                    </div>
                </li>
                @endif

                @if (Auth::check() && (Auth::user()->can('voir les devis') || Auth::user()->can('créer devis')))
                <li class="menu-title"><span>Devis</span></li>
                @endif
                @if (Auth::check() && (Auth::user()->can('voir les devis') || Auth::user()->can('créer devis') || Auth::user()->can('mettre à jour le devis') ))
                <li class="nav-item">
                    <a class="nav-link menu-link" aria-expanded="{{ request()->routeIs('all.quotes') || request()->routeIs('add.quote') || request()->routeIs('pending.quote') || request()->routeIs('processing.quote') || request()->routeIs('completed.quote') || request()->routeIs('cancelled.quote') ? 'true' : 'false' }}" href="#Devis" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="Devis">
                        <i class="ri-layout-3-line"></i> <span>Devis</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('all.quotes') || request()->routeIs('add.quote') || request()->routeIs('pending.quote') || request()->routeIs('processing.quote') || request()->routeIs('completed.quote') || request()->routeIs('cancelled.quote')? 'show' : '' }}" id="Devis">
                        <ul class="nav nav-sm flex-column">
                            @can('créer devis')
                            <li class="nav-item">
                                <a href="{{route('add.quote')}}" class="nav-link {{ Route::is('add.quote') ? 'active' : '' }}">Ajouter devis</a>
                            </li>
                            @endcan
                            @can('voir les devis')
                            <li class="nav-item">
                                <a href="{{route('all.quotes')}}" class="nav-link {{ Route::is('all.quotes') ? 'active' : '' }}">Les devis</a>
                            </li>
                            @endcan
                            @can('mettre à jour le devis')
                            <li class="nav-item">
                                <a href="{{route('pending.quote')}}" class="nav-link {{ Route::is('pending.quote') ? 'active' : '' }}">Les devis en attente</a>
                            </li>
                            @endcan
                            @can('mettre à jour le devis')
                            <li class="nav-item">
                                <a href="{{route('processing.quote')}}" class="nav-link {{ Route::is('processing.quote') ? 'active' : '' }}">Les devis en cours de traitement</a>
                            </li>
                            @endcan
                            @can('mettre à jour le devis')
                            <li class="nav-item">
                                <a href="{{route('completed.quote')}}" class="nav-link {{ Route::is('completed.quote') ? 'active' : '' }}">Les devis complétés</a>
                            </li>
                            @endcan
                            @can('mettre à jour le devis')
                            <li class="nav-item">
                                <a href="{{route('cancelled.quote')}}" class="nav-link {{ Route::is('cancelled.quote') ? 'active' : '' }}">Les devis annulés</a>
                            </li>
                            @endcan

                        </ul>
                    </div>
                </li>
                @endif
                @if (Auth::check() && (
                Auth::user()->can('voir les permissions') ||
                Auth::user()->can('voir les roles') ||
                Auth::user()->can('créer role') || 
                Auth::user()->user_type === 'Admin' 
                )&& Auth::user()->user_type === 'Admin')
                <li class="menu-title"><span>Rôles & Permisions</span></li>
                @endif
                @if (Auth::check() && (Auth::user()->can('voir les roles') || Auth::user()->can('créer role')  ) && Auth::user()->user_type === 'Admin')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#Roles" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="Roles">
                        <i class="ri-layout-3-line"></i> <span>Rôles</span>
                    </a>
                    <div class="collapse menu-dropdown" id="Roles">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('add.role')}}" class="nav-link">Ajouter role</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('all.roles')}}" class="nav-link">Les roles</a>
                            </li>


                        </ul>
                    </div>
                </li>
                @endif


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>