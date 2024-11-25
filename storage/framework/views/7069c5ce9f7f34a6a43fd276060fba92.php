
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('Détails de Client'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo e(URL::asset('build/libs/glightbox/css/glightbox.min.css')); ?>">
<?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?> <?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> <a href="<?php echo e(route('all.clients')); ?>">Tableau de Bord</a> <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Détails de Client <?php $__env->endSlot(); ?> <?php echo $__env->renderComponent(); ?>
<div class="row">
    <div class="col-xxl-3">
        <div class="card card-bg-fill">
            <div class="card-body p-4">
                <div class="text-center">
                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                        
                        <img src="<?php echo e((!empty($client->photo)) ? asset('photos/client_images/'.$client->photo) : asset('images/photo_defaults.jpg')); ?>" class="rounded-circle avatar-xl img-thumbnail " alt="user-profile-image">
                        <!-- <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                            <input id="profile-img-file-input" type="file" class="profile-img-file-input" name="photo">
                            <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                <span class="avatar-title rounded-circle bg-light text-body">
                                    <i class="ri-camera-fill"></i>
                                </span>
                            </label>
                        </div> -->
                    </div>

                </div>
            </div>
        </div>
        <!--end card-->
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-5">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Infos</h5>
                    </div>
                    <!-- <div class="flex-shrink-0">
                            <a href="javascript:void(0);" class="badge bg-light text-primary fs-12"><i
                                ></i> Edit</a>
                        </div> -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="firstnameInput" class="form-label" style="color: #E9823B; font-size: 20px;">Ville :</label>
                            <p class="form-label" style=" font-size: 15px;"><?php echo e($client->city->name); ?></p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="firstnameInput" class="form-label" style="color: #E9823B; font-size: 20px;">Raison Sociale :</label>
                            <p class="form-label" style=" font-size: 15px;"><?php echo e($client->raison_sociale ?? 'N/V'); ?></p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="firstnameInput" class="form-label" style="color: #E9823B; font-size: 20;">RC :</label>
                            <p class="form-label" style=" font-size: 15px;"><?php echo e($client->RC ?? 'N/V'); ?></p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="firstnameInput" class="form-label" style="color: #E9823B; font-size: 20px;">ICE :</label>
                            <p class="form-label" style=" font-size: 15px;"><?php echo e($client->ICE ?? 'N/V'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    <div class="col-xxl-9">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                            <i class="fas fa-home"></i>
                            Client
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                            <i class="far fa-user"></i>
                            Client Infos
                        </a>
                    </li>

                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="personalDetails" role="tabpanel">



                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="firstnameInput" class="form-label" style="color: #E9823B; font-size: 20px;">Nom de client</label>
                                    <p style=" font-size: 15px;"><?php echo e($client->client_first_name); ?></p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="lastnameInput" class="form-label" style="color: #E9823B; font-size: 20px;">Prénom de client</label>
                                    <p style=" font-size: 15px;"><?php echo e($client->client_last_name); ?></p>
                                </div>
                            </div>

                            <!--end col-->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="phonenumberInput" class="form-label" style="color: #E9823B; font-size: 20px;">Téléphone</label>
                                    <p style=" font-size: 15px;"><?php echo e($client->client_phone); ?></p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label" style="color: #E9823B; font-size: 20px;">E-mail</label>
                                    <p style=" font-size: 15px;"><?php echo e($client->client_email); ?></p>
                                </div>
                            </div>
                            <!--end col-->



                           

                            <!--end col-->
                        </div>
                        <!--end row-->

                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane" id="changePassword" role="tabpanel">


                        <div class="row g-2">
                            
                            
                            <!--end col-->
                        </div>
                        <!--end row-->





                    </div>
                    <!--end tab-pane-->

                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/libs/glightbox/js/glightbox.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/isotope-layout/isotope.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/pages/gallery.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/pages/profile-setting.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\scasco_reports\resources\views/clients/client_details.blade.php ENDPATH**/ ?>