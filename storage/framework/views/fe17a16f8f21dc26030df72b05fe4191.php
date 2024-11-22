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

                <?php if(Auth::check() && (Auth::user()->can('voir les utilisateurs') || Auth::user()->can('créer utilisateur'))): ?>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-admin-fill"></i> <span>Utilisateurs</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('voir les utilisateurs')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('all.users')); ?>" class="nav-link">Liste des utilisateurs
                                </a>

                            </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('créer utilisateur')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('add.user')); ?>" class="nav-link">Ajouter un utilisateur
                                </a>
                            </li>
                            <?php endif; ?>

                        </ul>
                    </div>
                </li>
                <?php endif; ?>
                <?php if(Auth::check() && (Auth::user()->can('voir les devis') || Auth::user()->can('créer devis'))): ?>
                <li class="menu-title"><span>Devis</span></li>
                <?php endif; ?>
                <?php if(Auth::check() && (Auth::user()->can('voir les devis') || Auth::user()->can('créer devis') || Auth::user()->can('mettre à jour le devis') )): ?>
                <li class="nav-item">
                    <a class="nav-link menu-link" aria-expanded="<?php echo e(request()->routeIs('all.quotes') || request()->routeIs('add.quote') || request()->routeIs('pending.quote') || request()->routeIs('processing.quote') || request()->routeIs('completed.quote') || request()->routeIs('cancelled.quote') ? 'true' : 'false'); ?>" href="#Devis" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="Devis">
                        <i class="ri-layout-3-line"></i> <span>Devis</span>
                    </a>
                    <div class="collapse menu-dropdown <?php echo e(request()->routeIs('all.quotes') || request()->routeIs('add.quote') || request()->routeIs('pending.quote') || request()->routeIs('processing.quote') || request()->routeIs('completed.quote') || request()->routeIs('cancelled.quote')? 'show' : ''); ?>" id="Devis">
                        <ul class="nav nav-sm flex-column">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('créer devis')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('add.quote')); ?>" class="nav-link <?php echo e(Route::is('add.quote') ? 'active' : ''); ?>">Ajouter devis</a>
                            </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('voir les devis')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('all.quotes')); ?>" class="nav-link <?php echo e(Route::is('all.quotes') ? 'active' : ''); ?>">Les devis</a>
                            </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('mettre à jour le devis')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('pending.quote')); ?>" class="nav-link <?php echo e(Route::is('pending.quote') ? 'active' : ''); ?>">Les devis en attente</a>
                            </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('mettre à jour le devis')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('processing.quote')); ?>" class="nav-link <?php echo e(Route::is('processing.quote') ? 'active' : ''); ?>">Les devis en cours de traitement</a>
                            </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('mettre à jour le devis')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('completed.quote')); ?>" class="nav-link <?php echo e(Route::is('completed.quote') ? 'active' : ''); ?>">Les devis complétés</a>
                            </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('mettre à jour le devis')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('cancelled.quote')); ?>" class="nav-link <?php echo e(Route::is('cancelled.quote') ? 'active' : ''); ?>">Les devis annulés</a>
                            </li>
                            <?php endif; ?>

                        </ul>
                    </div>
                </li>
                <?php endif; ?>
                <?php if(Auth::check() && (
                Auth::user()->can('voir les permissions') ||
                Auth::user()->can('voir les roles') ||
                Auth::user()->can('créer role')
                )): ?>
                <li class="menu-title"><span>Rôles & Permisions</span></li>
                <?php endif; ?>
                <?php if(Auth::check() && (Auth::user()->can('voir les roles') || Auth::user()->can('créer role'))): ?>
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
<div class="vertical-overlay"></div><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\material\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>