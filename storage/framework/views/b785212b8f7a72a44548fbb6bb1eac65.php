<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('Ajouter des permissions aux rôles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> <a href="<?php echo e(route('all.roles')); ?>">Liste des Roles</a> <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Ajouter des permissions aux rôles <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<?php echo Toastr::message(); ?>


<div class="page-wrapper">
    <div class="content container-fluid">

       
    
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                <div class="card-header">
                        <h5 class="card-title mb-0">Ajouter des permissions aux rôles</h5>
                    </div>
                    <div class="row g-4 m-2">
                        <div class="col-sm-auto">
                            <div>

                                <!-- <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add</button> -->
                                <!-- <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button> -->
                            </div>
                        </div>

                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="live-preview flex-grow-1">
                            <form method="POST" action="<?php echo e(route('give.permission.to.role', ['id' => $role->id])); ?>" class="forms-sample" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-check">
                                            <input type="checkbox" name="permission[]" value="<?php echo e($permission->name); ?>" <?php echo e(in_array($permission->id, $rolePermissions) ? 'checked' : ''); ?> class="form-check-input" />
                                            <?php echo e($permission->name); ?>

                                        </label>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                <div class="col-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Soumettre</button>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\scasco_reports\resources\views/roles/add-permissions.blade.php ENDPATH**/ ?>