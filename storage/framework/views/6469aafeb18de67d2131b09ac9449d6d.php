
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('Les rendez-Vous'); ?>
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
<?php $__env->slot('title'); ?> Les Rendez-Vous <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header mb-3 mb-lg-4 mt-3">
            <!-- <div class="row align-items-center">
                <div class="col-xl-8 col-sm-6 col-12 d-flex flex-column justify-content-center">
                    <h3 class="page-title">Liste des Associés</h3>
                </div>
                <div class="col-xl-4 col-sm-6 col-12 d-flex flex-column justify-content-center">
                    <ul class="breadcrumb ml-auto">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('accueil')); ?>">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active">Liste Associés</li>
                    </ul>
                </div>
            </div> -->
        </div>

        <div class="row mt-3">



            
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
                        <div class="card-header d-flex flex-column">
                            <div class="row align-items-center">
                                <div class="col-md-10">
                                    <h5 class="card-title mb-0">Les Rendez-Vous</h5>
                                </div>
                                <div class="col-md-2 d-flex justify-content-end">
                                    <a href="<?php echo e(route('add.appointment')); ?>" class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i> Ajouter</a> 
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>Téléphone</th>
                                        <th>Némuro d'affaire</th>
                                        <th>Date</th>
                                        <th>Lieu de rendez-vous</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($appointment->potential_case->client->client_first_name); ?> <?php echo e($appointment->potential_case->client->client_first_name); ?></td>
                                        <td><?php echo e($appointment->potential_case->client->client_phone ?? "--"); ?> </td>
                                        <td><?php echo e($appointment->potential_case->case_number ?? "N/V"); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($appointment->date_appointment)->format('F d, Y') ?? 'N/V'); ?></td>
                                        <td><?php echo e($appointment->place ?? "N/V"); ?></td>
                                        <td>
                                            <?php switch($appointment->status):
                                            case ('pending'): ?>
                                            <a class="text-warning">En attente</a>
                                            <?php break; ?>
                                            <?php case ('completed'): ?>
                                            <a class="text-success">Complété</a>
                                            <?php break; ?>
                                            <?php case ('cancelled'): ?>
                                            <a class="text-danger">Annulé</a>
                                            <?php break; ?>
                                            <?php default: ?>
                                            <a class="text-muted">Pas de statut</a>
                                            <?php endswitch; ?>
                                        </td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a href="<?php echo e(route('edit.appointment',$appointment->id)); ?>" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier</a></li>
                                                    <li><a href="<?php echo e(route('display.appointment',$appointment->id)); ?>" class="dropdown-item edit-item-btn"><i class="ri-eye-line align-bottom me-2 text-muted"></i> Affaicher</a></li>
                                                    <li><a href="<?php echo e(route('delete.appointment',$appointment->id)); ?>" class="dropdown-item edit-item-btn"><i class="ri-delete-bin-2-fill align-bottom me-2 text-muted"></i> Supprimer</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\scasco_reports\resources\views/appointments/appointments_list.blade.php ENDPATH**/ ?>