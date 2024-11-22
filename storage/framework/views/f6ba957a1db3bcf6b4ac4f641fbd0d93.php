<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('translation.dashboards'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(URL::asset('build/libs/swiper/swiper-bundle.min.css')); ?>" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col">

        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-16 mb-1">Bonjour, <?php echo e(Auth::user()->first_name); ?>!</h4>
                            <p class="text-muted mb-0">Voici ce qui se passe avec votre tableau de bord aujourd'hui.</p>
                        </div>
                        <div class="mt-3 mt-lg-0">
                            <form action="javascript:void(0);">
                                <div class="row g-3 mb-0 align-items-center">
                                    <div class="col-sm-auto">
                                        <div class="input-group">
                                            <div class="form-control border dash-filter-picker" id="currentDateDisplay">
                                                <span id="currentDate"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-auto">
                                        <a href="<?php echo e(route('add.quote')); ?>" class="btn btn-soft-primary"><i class="ri-add-circle-line align-middle me-1"></i>
                                            Ajouter Devis</a>
                                    </div>
                                    <!--end col-->


                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                    </div><!-- end card header -->
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Devis en attente</p>
                                </div>

                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><?php echo e($quotes_status_pending); ?>

                                    </h4>
                                    <a href="<?php echo e(route('pending.quote')); ?>" class="text-decoration-underline">Les devis en attente</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-warning rounded fs-3">
                                        <i class="las la-file-invoice"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Devis en cours de traitement</p>
                                </div>

                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><?php echo e($quotes_status_processing); ?></h4>
                                    <a href="<?php echo e(route('processing.quote')); ?>" class="text-decoration-underline">Les devis en cours de traitement</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-info rounded fs-3">
                                        <i class="las la-file-invoice"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Devis terminés</p>
                                </div>

                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><?php echo e($quotes_status_completed); ?>

                                    </h4>
                                    <a href="<?php echo e(route('completed.quote')); ?>" class="text-decoration-underline">Les devis terminés</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-success rounded fs-3">
                                        <i class="las la-file-invoice"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Devis annulés</p>
                                </div>

                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><?php echo e($quotes_status_cancelled); ?>

                                    </h4>
                                    <a href="<?php echo e(route('cancelled.quote')); ?>" class="text-decoration-underline">Les devis annulés</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-danger rounded fs-3">
                                        <i class="las la-file-invoice"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div> <!-- end row-->

            <div class="row">

                <div class="col-xl-12">
                    <div class="card card-height-100">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Devis par mois</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div id="quotes_chart_bar"  class="apex-charts" dir="ltr"></div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>



            </div>

            <div class="row">
                <div class="col-xl-4">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Devis par pourcentage</h4>
                            <div class="flex-shrink-0">

                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div id="quotes_chart_pie" data-colors='["--vz-primary",]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div> <!-- .card-->
                </div> <!-- .col-->
                <!-- end col -->
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Devis récents</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                    <tbody>
                                        <?php $__currentLoopData = $recent_quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent_quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $recent_quote->quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">

                                                    <div>
                                                        <h5 class="fs-14 my-1"><a href="apps-ecommerce-product-details" class="text-reset">
                                                        <?php echo e($recent_quote->quote_number ?? 'N/A'); ?></a></h5>
                                                        <span class="text-muted">Devis</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal"><?php echo e($recent_quote->date_creation); ?></h5>
                                                <span class="text-muted">Date de création</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal"><?php echo e($quote->prime_ht ?? 'N/A'); ?></h5>
                                                <span class="text-muted">Prime HT</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal"><?php echo e($quote->prime_ht_tax ?? 'N/A'); ?></h5>
                                                <span class="text-muted">Taxe</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal"><?php echo e(($quote->prime_ht ?? 0) + ($quote->prime_ht_tax ?? 0)); ?></h5>
                                                <span class="text-muted">Prime</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal"><?php echo e(($quote->prime_totale_annuelle ?? 0)); ?></h5>
                                                <span class="text-muted">Prime Totale annuelle</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal"><?php echo e(($quote->prorata ?? 0)); ?></h5>
                                                <span class="text-muted">Prorata</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal">
                                                    <span class="badge bg-success-subtle text-success text-uppercase">
                                                        <?php if($recent_quote->latestStatus): ?>
                                                        <?php switch($recent_quote->latestStatus->quote_status):
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
                                                        <a class="text-muted">Pas de statut</a>
                                                        <?php endswitch; ?>
                                                        <?php endif; ?>
                                                    </span>
                                                </h5>
                                                <span class="text-muted">Status</span>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                <div class="col-sm">
                                    <div class="text-muted">
                                    Afficher les détails
                                    </div>
                                </div>
                                <div class="col-sm-auto  mt-3 mt-sm-0">
                                    <a href="<?php echo e(route('all.quotes')); ?>" class="text-decoration-underline">Tous les devis</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div> <!-- end row-->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-height-100">
                    <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Devis terminés</h4>

                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                    <tbody>
                                        <?php $__currentLoopData = $completed_quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $completed_quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $completed_quote->quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">

                                                    <div>
                                                        <h5 class="fs-14 my-1"><a href="apps-ecommerce-product-details" class="text-reset">
                                                        <?php echo e($completed_quote->quote_number ?? 'N/A'); ?></a></h5>
                                                        <span class="text-muted">Devis</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal"><?php echo e($completed_quote->date_creation); ?></h5>
                                                <span class="text-muted">Date de création</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal"><?php echo e($quote->prime_ht ?? 'N/A'); ?></h5>
                                                <span class="text-muted">Prime HT</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal"><?php echo e($quote->prime_ht_tax ?? 'N/A'); ?></h5>
                                                <span class="text-muted">Taxe</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal"><?php echo e(($quote->prime_ht ?? 0) + ($quote->prime_ht_tax ?? 0)); ?></h5>
                                                <span class="text-muted">Prime</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal"><?php echo e(($quote->prime_totale_annuelle ?? 0)); ?></h5>
                                                <span class="text-muted">Prime Totale annuelle</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal"><?php echo e(($quote->prorata ?? 0)); ?></h5>
                                                <span class="text-muted">Prorata</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal">
                                                    <span class="badge bg-success-subtle text-success text-uppercase">
                                                        <?php if($completed_quote->latestStatus): ?>
                                                        <?php switch($completed_quote->latestStatus->quote_status):
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
                                                        <a class="text-muted">Pas de statut</a>
                                                        <?php endswitch; ?>
                                                        <?php endif; ?>
                                                    </span>
                                                </h5>
                                                <span class="text-muted">Status</span>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                <div class="col-sm">
                                    <div class="text-muted">
                                    Afficher les détails
                                    </div>
                                </div>
                                <div class="col-sm-auto  mt-3 mt-sm-0">
                                    <a href="<?php echo e(route('completed.quote')); ?>" class="text-decoration-underline">Tous les devis</a>
                                </div>
                            </div>

                        </div>
                    </div> <!-- .card-->
                </div> <!-- .col-->

                <div class="col-xl-12">
                    <div class="card">
                    <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Devis annulés</h4>

                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                    <tbody>
                                        <?php $__currentLoopData = $cancelled_quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cancelled_quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $cancelled_quote->quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">

                                                    <div>
                                                        <h5 class="fs-14 my-1"><a href="apps-ecommerce-product-details" class="text-reset">
                                                        <?php echo e($cancelled_quote->quote_number ?? 'N/A'); ?></a></h5>
                                                        <span class="text-muted">Devis</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal"><?php echo e($cancelled_quote->date_creation); ?></h5>
                                                <span class="text-muted">Date de création</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal"><?php echo e($quote->prime_ht ?? 'N/A'); ?></h5>
                                                <span class="text-muted">Prime HT</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal"><?php echo e($quote->prime_ht_tax ?? 'N/A'); ?></h5>
                                                <span class="text-muted">Taxe</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal"><?php echo e(($quote->prime_ht ?? 0) + ($quote->prime_ht_tax ?? 0)); ?></h5>
                                                <span class="text-muted">Prime</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal"><?php echo e(($quote->prime_totale_annuelle ?? 0)); ?></h5>
                                                <span class="text-muted">Prime Totale annuelle</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal"><?php echo e(($quote->prorata ?? 0)); ?></h5>
                                                <span class="text-muted">Prorata</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal">
                                                    <span class="badge bg-success-subtle text-success text-uppercase">
                                                        <?php if($cancelled_quote->latestStatus): ?>
                                                        <?php switch($cancelled_quote->latestStatus->quote_status):
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
                                                        <a class="text-muted">Pas de statut</a>
                                                        <?php endswitch; ?>
                                                        <?php endif; ?>
                                                    </span>
                                                </h5>
                                                <span class="text-muted">Status</span>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                <div class="col-sm">
                                    <div class="text-muted">
                                    Afficher les détails
                                    </div>
                                </div>
                                <div class="col-sm-auto  mt-3 mt-sm-0">
                                    <a href="<?php echo e(route('cancelled.quote')); ?>" class="text-decoration-underline">Tous les devis</a>
                                </div>
                            </div>

                        </div>
                    </div> <!-- .card-->
                </div> <!-- .col-->
            </div> <!-- end row-->

        </div> <!-- end .h-100-->

    </div> <!-- end col -->

  
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

<!-- apexcharts -->
<script src="<?php echo e(URL::asset('build/libs/apexcharts/apexcharts.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/jsvectormap/maps/world-merc.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/swiper/swiper-bundle.min.js')); ?>"></script>
<!-- <script src="<?php echo e(URL::asset('build/js/pages/chartjs.init.js')); ?>"></script> -->
<!-- dashboard init -->
<script src="<?php echo e(URL::asset('build/js/pages/dashboard-ecommerce.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="<?php echo e(URL::asset('build/js/pages/apexcharts-pie.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/pages/apexcharts-bar.init.js')); ?>"></script>

<script>
    // Get reference to the span element where the date will be displayed
    var currentDateTimeSpan = document.getElementById("currentDate");

    // Function to update the current date and time
    function updateCurrentDateTime() {
        // Get today's date and time
        var today = new Date();

        // Format date and time as 'Day, Month Date, Year - HH:MM:SS AM/PM'
        var formattedDateTime = today.toLocaleString('fr-US', {
            weekday: 'long',
            month: 'long',
            day: 'numeric',
            year: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric',
            hour12: true
        });

        // Update the content of the span element with the formatted date and time
        currentDateTimeSpan.textContent = formattedDateTime;
    }

    // Call the function initially to set the current date and time
    updateCurrentDateTime();

    // Set up an interval to update the current date and time every second
    setInterval(updateCurrentDateTime, 1000); // Update every second (1000 milliseconds)
</script>
<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch("/quotes-bar-chart-home")
            .then((response) => response.json())
            .then((data) => {
                console.log("Fetched data:", data);
                if (
                    data.labels &&
                    data.quotes &&
                    data.quotes_status_pending &&
                    data.quotes_status_processing &&
                    data.quotes_status_completed &&
                    data.quotes_status_cancelled
                ) {
                    var colors = ["#808b96", "#ff5733", "#3364ff", "#42ff33", "#ff333f"];
                    var chartElement = document.querySelector("#quotes_chart_bar");
                    if (chartElement.dataset.colors) {
                        colors = JSON.parse(chartElement.dataset.colors).map(function(value) {
                            return getComputedStyle(document.documentElement).getPropertyValue(value).trim();
                        });
                    }

                    var options = {
                        chart: {
                            height: 350,
                            type: "bar",
                            toolbar: {
                                show: false,
                            },
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                            },
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        series: [{
                                name: "Devis",
                                data: data.quotes,
                            },
                            {
                                name: "Les devis en attente",
                                data: data.quotes_status_pending,
                            },
                            {
                                name: "Devis en cours de traitement",
                                data: data.quotes_status_processing,
                            },
                            {
                                name: "Devis terminés",
                                data: data.quotes_status_completed,
                            },
                            {
                                name: "Les devis annulés",
                                data: data.quotes_status_cancelled,
                            },
                        ],
                        colors: colors,
                        grid: {
                            borderColor: "#f1f1f1",
                        },
                        xaxis: {
                            categories: data.labels,
                        },
                    };

                    var chart = new ApexCharts(chartElement, options);
                    chart.render();
                } else {
                    console.error("Invalid data structure:", data);
                }
            })
            .catch((error) => {
                console.error("Error fetching quote data:", error);
            });
    });
</script> -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\scasco_reports\resources\views/dashboard/accueil.blade.php ENDPATH**/ ?>