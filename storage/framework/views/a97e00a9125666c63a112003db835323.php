<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('Modifier Role'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> <a href="<?php echo e(route('all.roles')); ?>">Liste des Roles</a> <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Modifier Role <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<?php echo Toastr::message(); ?>


<div class="page-wrapper">
      <div class="content container-fluid">

            <div class="page-header mb-3 mb-lg-4 mt-3">
                  <!-- <div class="row align-items-center">
                        <div class="col-xl-8 col-sm-6 col-12 d-flex flex-column justify-content-center">
                              <h3 class="page-title">Modifier Role</h3>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12 d-flex flex-column justify-content-center">
                              <ul class="breadcrumb ml-auto">
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('all.roles')); ?>">Liste des Roles</a></li>
                                    <li class="breadcrumb-item active">Modifier Role</li>
                              </ul>
                        </div>
                  </div> -->
            </div>

            <div class="row">
                  <div class="col-xxl-12">
                        <div class="card">
                              <div class="card-body d-flex flex-column">
                                    <div class="live-preview flex-grow-1">
                                          <form method="POST" action="<?php echo e(route('update.role', ['id' => $role->id])); ?>" class="forms-sample" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="row">
                                                      <div class="col-12 col-sm-4 mb-3">
                                                            <label>Role : <span class="login-danger">*</span></label>
                                                            <input type="text" class="form-control" name="name" value="<?php echo e($role->name); ?>">
                                                      </div>

                                                     


                                                      <div class="col-12">
                                                            <div class="text-end">
                                                                  <button type="submit" class="btn btn-primary">Soumettre</button>
                                                            </div>
                                                      </div>
                                                </div>
                                    </div>
                                    </form>
                              </div>

                        </div>
                  </div>
            </div> <!-- end col -->
      </div><!--end row-->


</div>
</div>




<?php $__env->stopSection(); ?>


<!-- 
<div class="row">
      <div class="col-12 col-sm-4 mb-3"> -->
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\scasco_reports\resources\views/roles/edit_role.blade.php ENDPATH**/ ?>