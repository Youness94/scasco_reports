<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="<?php echo e(route('accueil')); ?>" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(URL::to('img/favicon.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::to('img/logo.png')); ?>" alt="" height="45">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="<?php echo e(route('accueil')); ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(URL::to('img/favicon.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::to('img/logo.png')); ?>" alt="" height="45">
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
                <a class="nav-link menu-link" href="<?php echo e(route('accueil')); ?>">
                    <i class="ri-dashboard-2-line"></i>
                    <span>Tableau de Bord</span>
                </a>

              

                <?php if(Auth::check() && (Auth::user()->can('voir les admins') || Auth::user()->can('créer admin')) && Auth::user()->user_type === 'Admin'): ?>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAdmin" data-bs-toggle="collapse" role="button" aria-expanded="<?php echo e(request()->routeIs('all.users') || request()->routeIs('add.user')  ? 'true' : 'false'); ?>" aria-controls="sidebarAdmin">
                        <i class="ri-admin-fill"></i> <span>Admins</span>
                    </a>
                    <div class="collapse menu-dropdown <?php echo e(request()->routeIs('all.admins') || request()->routeIs('add.admin')  ? 'show' : ''); ?>" id="sidebarAdmin">
                        <ul class="nav nav-sm flex-column">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('voir les admins')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('all.admins')); ?>" class="nav-link <?php echo e(Route::is('all.admins') ? 'active' : ''); ?>">Liste des admins
                                </a>

                            </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('créer admin')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('add.admin')); ?>" class="nav-link <?php echo e(Route::is('add.admin') ? 'active' : ''); ?>">Ajouter un admin
                                </a>
                            </li>
                            <?php endif; ?>

                        </ul>
                    </div>
                </li>
                <?php endif; ?>

                <?php if(Auth::check() && (Auth::user()->can('voir les positions') || Auth::user()->can('créer position'))): ?>
                <li class="menu-title"><span>Devis</span></li>
                <?php endif; ?>
                <?php if(Auth::check() && (Auth::user()->can('voir les positions') || Auth::user()->can('créer position') )): ?>
                <li class="nav-item">
                    <a class="nav-link menu-link" aria-expanded="<?php echo e(request()->routeIs('all.positions') || request()->routeIs('add.position')  ? 'true' : 'false'); ?>" href="#Positions" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="Positions">
                        <i class="ri-layout-3-line"></i> <span>Positions</span>
                    </a>
                    <div class="collapse menu-dropdown <?php echo e(request()->routeIs('all.position') || request()->routeIs('add.position') ? 'show' : ''); ?>" id="Positions">
                        <ul class="nav nav-sm flex-column">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('créer position')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('add.position')); ?>" class="nav-link <?php echo e(Route::is('add.position') ? 'active' : ''); ?>">Ajouter position</a>
                            </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('voir les positions')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('all.positions')); ?>" class="nav-link <?php echo e(Route::is('all.positions') ? 'active' : ''); ?>">Les positions</a>
                            </li>
                            <?php endif; ?>
                          

                        </ul>
                    </div>
                </li>
                <?php endif; ?>
                <?php if(Auth::check() && (
                Auth::user()->can('voir les permissions') ||
                Auth::user()->can('voir les roles') ||
                Auth::user()->can('créer role') || 
                Auth::user()->user_type === 'Admin' 
                )&& Auth::user()->user_type === 'Admin'): ?>
                <li class="menu-title"><span>Rôles & Permisions</span></li>
                <?php endif; ?>
                <?php if(Auth::check() && (Auth::user()->can('voir les roles') || Auth::user()->can('créer role')  ) && Auth::user()->user_type === 'Admin'): ?>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#Roles" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="Roles">
                        <i class="ri-layout-3-line"></i> <span>Rôles</span>
                    </a>
                    <div class="collapse menu-dropdown" id="Roles">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?php echo e(route('add.role')); ?>" class="nav-link">Ajouter role</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('all.roles')); ?>" class="nav-link">Les roles</a>
                            </li>


                        </ul>
                    </div>
                </li>
                <?php endif; ?>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\scasco_reports\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>