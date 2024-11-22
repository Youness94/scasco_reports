
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('Les devis'); ?>
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
<?php $__env->slot('title'); ?> Les Devis <?php $__env->endSlot(); ?>
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
                        <div class="card-header">
                            <h5 class="card-title mb-0">Les Devis</h5>
                        </div>
                        <div class="row g-4 m-2">
                            <div class="col-sm-auto">
                                <div>
                                    <a href="<?php echo e(route('add.quote')); ?>" class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i> Ajouter</a>
                                    <!-- <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add</button> -->
                                    <!-- <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button> -->
                                </div>
                            </div>

                        </div>
                        <form method="POST" action="<?php echo e(route('quote.infos.bulk.status.update')); ?>" class="forms-sample" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="card-body">
                                <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Select</th>
                                            <th>Quote Number</th>
                                            <th>Current Status</th>
                                            <!-- <th>New Status</th> -->
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="quote_info_ids[]" value="<?php echo e($quote->id); ?>">
                                            </td>
                                            <td><?php echo e($quote->quote_number); ?></td>
                                            <td>
                                                <span class="badge bg-success-subtle text-success text-uppercase">
                                                    <?php if($quote->latestStatus): ?>
                                                    <?php switch($quote->latestStatus->quote_status):
                                                    case ('pending'): ?>
                                                    <a class="text-warning">En attente</a>
                                                    <?php break; ?>
                                                    <?php case ('completed'): ?>
                                                    <a class="text-success">Complété</a>
                                                    <?php break; ?>
                                                    <?php case ('processing'): ?>
                                                    <a class="text-primary">En cours de traitement</a>
                                                    <?php break; ?>
                                                    <?php case ('cancelled'): ?>
                                                    <a class="text-danger">Annulé</a>
                                                    <?php break; ?>
                                                    <?php default: ?>
                                                    <a class="text-muted">Statut inconnu</a>
                                                    <?php endswitch; ?>
                                                    <?php else: ?>
                                                    <a class="text-muted">Pas de statut</a>
                                                    <?php endif; ?>
                                                </span>
                                            </td>
                                            <!-- <form action="<?php echo e(route('quote.info.status.update', ['id' => $quote->id, 'status' => ''])); ?>" method="POST" id="statusForm">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <td>
                                                    <select name="quote_statuses[<?php echo e($quote->id); ?>]" required>
                                                        <?php
                                                        $latestStatus = $quote->quotes_status->last() ? $quote->quotes_status->last()->quote_status : null;
                                                        ?>
                                                        <option value="pending" <?php echo e(old('order_status', $latestStatus) === 'pending' ? 'selected' : ''); ?>>Pending</option>
                                                        <option value="completed" <?php echo e(old('order_status', $latestStatus) === 'completed' ? 'selected' : ''); ?>>Completed</option>
                                                        <option value="processing" <?php echo e(old('order_status', $latestStatus) === 'processing' ? 'selected' : ''); ?>>Processing</option>
                                                        <option value="cancelled" <?php echo e(old('order_status', $latestStatus) === 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                                                    </select>
                                                </td>
                                            </form> -->
                                            <td>
                                                <?php echo e($quote->latestStatus->note ?? 'N/A'); ?>

                                                <!-- <input type="text" name="notes[<?php echo e($quote->id); ?>]" class="form-control" placeholder="Note"> -->
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row g-4 m-2">
                                <!-- <div class="col-sm-auto"> -->
                                <div class="col-md-4 mb-3">

                                    <select name="bulk_status" id="bulk_status" class="form-control">
                                        <option value="">Select Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="completed">Completed</option>
                                        <option value="processing">Processing</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <textarea name="bulk_note" class="form-control" placeholder="Enter note for all selected quotes"></textarea>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                                <!-- </div> -->
                            </div>
                        </form>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\scasco-ANCFCC-devis\resources\views/quotes/quotes_status_processing.blade.php ENDPATH**/ ?>