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

              

                @if (Auth::check() && (Auth::user()->can('voir les admins') || Auth::user()->can('créer admin')))
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
                @if (Auth::check() && (Auth::user()->can('voir les positions') || Auth::user()->can('créer position')))
                <li class="menu-title"><span>Affaires</span></li>
                @endif
                @if (Auth::check() && (Auth::user()->can('voir les positions') || Auth::user()->can('créer position') ))
                <li class="nav-item">
                    <a class="nav-link menu-link" aria-expanded="{{ request()->routeIs('all.potential_cases') || request()->routeIs('add.potential_case')  ? 'true' : 'false' }}" href="#potencialCases" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="potencialCases">
                        <i class="ri-layout-3-line"></i> <span>Affaires</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('all.potential_cases') || request()->routeIs('add.potential_case') ? 'show' : '' }}" id="potencialCases">
                        <ul class="nav nav-sm flex-column">
                            @can('créer position')
                            <li class="nav-item">
                                <a href="{{route('add.potential_case')}}" class="nav-link {{ Route::is('add.potential_case') ? 'active' : '' }}">Ajouter Affaire</a>
                            </li>
                            @endcan
                            @can('voir les positions')
                            <li class="nav-item">
                                <a href="{{route('all.potential_cases')}}" class="nav-link {{ Route::is('all.potential_cases') ? 'active' : '' }}">Les Affaires</a>
                            </li>
                            @endcan
                          

                        </ul>
                    </div>
                </li>
                @endif
                @if (Auth::check() && (Auth::user()->can('voir les positions') || Auth::user()->can('créer position') ))
                <li class="nav-item">
                    <a class="nav-link menu-link" aria-expanded="{{ request()->routeIs('all.reports') || request()->routeIs('add.report')  ? 'true' : 'false' }}" href="#Reports" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="Reports">
                        <i class="ri-layout-3-line"></i> <span>Comptes Rendus</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('all.reports') || request()->routeIs('add.report') ? 'show' : '' }}" id="Reports">
                        <ul class="nav nav-sm flex-column">
                            @can('créer position')
                            <li class="nav-item">
                                <a href="{{route('add.report')}}" class="nav-link {{ Route::is('add.report') ? 'active' : '' }}">Ajouter Compte Rendu</a>
                            </li>
                            @endcan
                            @can('voir les positions')
                            <li class="nav-item">
                                <a href="{{route('all.reports')}}" class="nav-link {{ Route::is('all.reports') ? 'active' : '' }}">Les Comptes Rendus</a>
                            </li>
                            @endcan
                          

                        </ul>
                    </div>
                </li>
                @endif

                @if (Auth::check() && (Auth::user()->can('voir les positions') || Auth::user()->can('créer position') ))
                <li class="nav-item">
                    <a class="nav-link menu-link" aria-expanded="{{ request()->routeIs('all.appointments') || request()->routeIs('add.appointment')  ? 'true' : 'false' }}" href="#Appointment" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="Appointment">
                        <i class="ri-layout-3-line"></i> <span>Rendez-Vous</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('all.appointments') || request()->routeIs('add.appointment') ? 'show' : '' }}" id="Appointment">
                        <ul class="nav nav-sm flex-column">
                            @can('créer position')
                            <li class="nav-item">
                                <a href="{{route('add.appointment')}}" class="nav-link {{ Route::is('add.appointment') ? 'active' : '' }}">Ajouter Rendez-Vous</a>
                            </li>
                            @endcan
                            @can('voir les positions')
                            <li class="nav-item">
                                <a href="{{route('all.appointments')}}" class="nav-link {{ Route::is('all.appointments') ? 'active' : '' }}">Les Rendez-Vous</a>
                            </li>
                            @endcan
                            @can('voir les positions')
                            <li class="nav-item">
                                <a href="{{route('display.appointments')}}" class="nav-link {{ Route::is('all.display.appointments') ? 'active' : '' }}">Détailes des Rendez-Vous</a>
                            </li>
                            @endcan

                        </ul>
                    </div>
                </li>
                @endif
                @if (Auth::check() && (Auth::user()->can('voir les positions') || Auth::user()->can('créer position')))
                <li class="menu-title"><span>Objectifs</span></li>
                @endif
                @if (Auth::check() && (Auth::user()->can('voir les positions') || Auth::user()->can('créer position') ))
                <li class="nav-item">
                    <a class="nav-link menu-link" aria-expanded="{{ request()->routeIs('all.objectives') || request()->routeIs('add.objective')  ? 'true' : 'false' }}" href="#Objectifs" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="Objectifs">
                        <i class="ri-layout-3-line"></i> <span>Objectifs</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('all.objectives') || request()->routeIs('add.objective') ? 'show' : '' }}" id="Objectifs">
                        <ul class="nav nav-sm flex-column">
                            @can('créer position')
                            <li class="nav-item">
                                <a href="{{route('add.objective')}}" class="nav-link {{ Route::is('add.objective') ? 'active' : '' }}">Ajouter Objectif</a>
                            </li>
                            @endcan
                            @can('voir les positions')
                            <li class="nav-item">
                                <a href="{{route('all.objectives')}}" class="nav-link {{ Route::is('all.objectives') ? 'active' : '' }}">Les Objectifs</a>
                            </li>
                            @endcan
                          

                        </ul>
                    </div>
                </li>
                @endif
                @if (Auth::check() && (Auth::user()->can('voir les positions') || Auth::user()->can('créer position')))
                <li class="menu-title"><span>Services</span></li>
                @endif
                @if (Auth::check() && (Auth::user()->can('voir les positions') || Auth::user()->can('créer position') ))
                <li class="nav-item">
                    <a class="nav-link menu-link" aria-expanded="{{ request()->routeIs('all.services') || request()->routeIs('add.service')  ? 'true' : 'false' }}" href="#Services" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="Services">
                        <i class="ri-layout-3-line"></i> <span>Services</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('all.services') || request()->routeIs('add.service') ? 'show' : '' }}" id="Services">
                        <ul class="nav nav-sm flex-column">
                            @can('créer position')
                            <li class="nav-item">
                                <a href="{{route('add.service')}}" class="nav-link {{ Route::is('add.service') ? 'active' : '' }}">Ajouter service</a>
                            </li>
                            @endcan
                            @can('voir les positions')
                            <li class="nav-item">
                                <a href="{{route('all.services')}}" class="nav-link {{ Route::is('all.services') ? 'active' : '' }}">Les services</a>
                            </li>
                            @endcan
                          

                        </ul>
                    </div>
                </li>
                @endif
                @if (Auth::check() && (Auth::user()->can('voir les positions') || Auth::user()->can('créer position') ))
                <li class="nav-item">
                    <a class="nav-link menu-link" aria-expanded="{{ request()->routeIs('all.branches') || request()->routeIs('add.branche')  ? 'true' : 'false' }}" href="#Branches" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="Branches">
                        <i class="ri-layout-3-line"></i> <span>Branches</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('all.branches') || request()->routeIs('add.branche') ? 'show' : '' }}" id="Branches">
                        <ul class="nav nav-sm flex-column">
                            @can('créer position')
                            <li class="nav-item">
                                <a href="{{route('add.branche')}}" class="nav-link {{ Route::is('add.branche') ? 'active' : '' }}">Ajouter branche</a>
                            </li>
                            @endcan
                            @can('voir les positions')
                            <li class="nav-item">
                                <a href="{{route('all.branches')}}" class="nav-link {{ Route::is('all.branches') ? 'active' : '' }}">Les branches</a>
                            </li>
                            @endcan
                          

                        </ul>
                    </div>
                </li>
                @endif
                @if (Auth::check() && (Auth::user()->can('voir les positions') || Auth::user()->can('créer position') ))
                <li class="nav-item">
                    <a class="nav-link menu-link" aria-expanded="{{ request()->routeIs('all.clients') || request()->routeIs('add.client')  ? 'true' : 'false' }}" href="#Clients" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="Clients">
                        <i class="ri-layout-3-line"></i> <span>Clients</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('all.clients') || request()->routeIs('add.client') ? 'show' : '' }}" id="Clients">
                        <ul class="nav nav-sm flex-column">
                            @can('créer position')
                            <li class="nav-item">
                                <a href="{{route('add.client')}}" class="nav-link {{ Route::is('add.client') ? 'active' : '' }}">Ajouter client</a>
                            </li>
                            @endcan
                            @can('voir les positions')
                            <li class="nav-item">
                                <a href="{{route('all.clients')}}" class="nav-link {{ Route::is('all.clients') ? 'active' : '' }}">Les clients</a>
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
                @if (Auth::check() && (Auth::user()->can('voir les roles') || Auth::user()->can('créer role')  ))
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