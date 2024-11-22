<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('Les admins'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> <a href="<?php echo e(route('accueil')); ?>">Tableau de Bord</a> <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> List des Admins  <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?> 

<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header mb-3 mb-lg-4 mt-3">
            <!-- <div class="row align-items-center">
                <div class="col-xl-8 col-sm-6 col-12 d-flex flex-column justify-content-center">
                    <h3 class="page-title">Liste des Utilisateurs</h3>
                </div>
                <div class="col-xl-4 col-sm-6 col-12 d-flex flex-column justify-content-center">
                    <ul class="breadcrumb ml-auto">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('accueil')); ?>">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active">List Users</li>
                    </ul>
                </div>
            </div> -->
        </div>
        
        <?php echo Toastr::message(); ?>

        <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
        <?php endif; ?>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Liste des Admins</h5>
                    </div>
                    <div class="row g-4 m-3">
                        <div class="col-sm-auto">
                            <div>
                                <a href="<?php echo e(route('add.admin')); ?>" class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i> Ajouter</a>
                                <!-- <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add</button> -->
                                <!-- <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button> -->
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <?php if(!empty($users) && count($users) > 0): ?>
                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="sort" data-sort="customer_name">Name</th>
                                    <th class="sort" data-sort="email">Email</th>
                                    <th class="sort" data-sort="phone">Role Name</th>
                                    <th class="sort" data-sort="date">Status</th>
                                    <th class="sort" data-sort="action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="customer_name"><?php echo e($list->first_name); ?></td>
                                    <td class="email"><?php echo e($list->email); ?></td>
                                    <td class="phone"><?php echo e(isset($userRoles[$list->id]) ? $userRoles[$list->id] : 'N/A'); ?></td>

                                    <td class="status"><span class="badge bg-success-subtle text-success text-uppercase">
                                            <div class="edit-delete-btn">
                                                <?php if($list->status === 'Active'): ?>
                                                <a class="text-success"><?php echo e($list->status); ?></a>
                                                <?php else: ?>
                                                <a class="text-warning"><?php echo e($list->status); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </span></td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <!-- <li><a href="#" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li> -->
                                                <li><a href="<?php echo e(route('edit.admin',$list->id)); ?>" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier</a></li>

                                            </ul>
                                        </div>
                                    </td>
                                    
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>¨
                    <?php else: ?>
                    <p>Aucun client disponible.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</div>




<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="<?php echo e(URL::asset('build/js/pages/datatables.init.js')); ?>"></script>

<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\scasco-ANCFCC-devis\resources\views/usermanagement/list_users.blade.php ENDPATH**/ ?>