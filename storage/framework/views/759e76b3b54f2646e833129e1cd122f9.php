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
<?php $__env->slot('title'); ?> List des Admins <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- <div class="page-header mb-3 mb-lg-4 mt-3">
            <div class="row align-items-center">
                <div class="col-xl-8 col-sm-6 col-12 d-flex flex-column justify-content-center">
                    <h3 class="page-title">Modifier admin</h3>
                </div>
                <div class="col-xl-4 col-sm-6 col-12 d-flex flex-column justify-content-center">
                    <ul class="breadcrumb ml-auto">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('all.admins')); ?>">Admins</a></li>
                        <li class="breadcrumb-item active">Modifier admin</li>
                    </ul>
                </div>
            </div>
        </div> -->

        
        <?php echo Toastr::message(); ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">Informations Admin</div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.update', ['id' => $user->id])); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="row">

                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Prénom <span class="login-danger"></span></label>
                                    <input type="text" class="form-control" name="first_name" value="<?php echo e($user->first_name); ?>">
                                    <input type="hidden" class="form-control" name="id" value="<?php echo e($user->id); ?>">
                                </div>


                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Nom <span class="login-danger"></span></label>
                                    <input type="text" class="form-control" name="last_name" value="<?php echo e($user->last_name); ?>">
                                    <input type="hidden" class="form-control" name="id" value="<?php echo e($user->id); ?>">
                                </div>

                                <div class="col-12 col-sm-4 mb-3">
                                    <label>E-mail <span class="login-danger"></span></label>
                                    <input type="text" class="form-control" name="email" value="<?php echo e($user->email); ?>">
                                </div>

                                <!-- 
                                     <div class="col-xxl-12">
                                        <label>Phone  <span class="login-danger">*</span></label>
                                        <input type="number" class="form-control" name="phonenumber" value="<?php echo e($user->phonenumber); ?>">
                                    </div>
                              -->

                                <!-- <div class="col-12 col-sm-4 mb-3">
                                    <label>Status <span class="login-danger">*</span></label>
                                    <select class="form-control select" name="status">
                                        <option disabled><?php echo e(old('status')); ?></option>
                                        <option value="Active" <?php echo e($user->status == 'Active' ? 'selected' : ''); ?>>Active</option>
                                        <option value="Inactive" <?php echo e($user->status == 'Inactive' ? 'selected' : ''); ?>>Inactive</option>
                                    </select>
                                </div> -->
                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Status: <span class="login-danger"></span></label>
                                    <select class="form-control select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="status_user" id="status_user">

                                        <option value="Active" <?php echo e(old('status',$user->status) == 'Active' ? 'selected' : ''); ?>>Active</option>
                                        <option value="Inactive" <?php echo e(old('status',$user->status) == 'Inactive' ? 'selected' : ''); ?>>Inactive</option>


                                    </select>
                                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>


                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Role<span class="login-danger"></span></label>
                                    <select class="form-control select <?php $__errorArgs = ['role_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="roles[]" id="roles">

                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($role); ?>" <?php echo e(old('roles', $user->roles->pluck('name')->first()) == $role ? 'selected' : ''); ?>>
                                            <?php echo e($role); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['roles'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <!-- responsibles -->
                                <div class="col-md-4 mb-3" id="responsible_div" style="display:none;">
                                    <label class="form-label" for="responsible_id">Responsable</label>
                                    <select id="responsible_id" class="js-example-basic-single form-control <?php $__errorArgs = ['responsible_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="responsible_id">
                                        <option selected disabled value="">Choisissez Responsable</option>
                                        <?php $__currentLoopData = $responsibles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $responsible): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($responsible->id); ?>" <?php echo e(old('responsible_id', $user->responsible_id) == $responsible->id ? 'selected' : ''); ?>>
                                            <?php echo e($responsible->first_name); ?> <?php echo e($responsible->last_name); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['responsible_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger"><?php echo e($message); ?></span>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <!-- <div class="mb-3">
                                    <label class="form-label" for="image">Image upload</label>
                                    <input class="form-control" name="photo" type="file" id="image">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="image">Image Preview</label>
                                    <img id="photo" class="wd-80 rounded-circle" src="<?php echo e((!empty($user->photo)) ? url('upload/admin_images/'.$user->photo) : url('upload/no_image.jpg')); ?>" alt="profile">
                                </div> -->

                                <!-- <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Position <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" name="position" value="<?php echo e($user->position); ?>">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Department <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" name="department" value="<?php echo e($user->department); ?>">
                                    </div>
                                </div> -->
                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Date de Mise à Jour <span class="login-danger"></span></label>
                                    <input type="text" class="form-control" name="updated_at" value="<?php echo e($user->updated_at); ?>" readonly>
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
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rolesSelect = document.getElementById('roles');
        const responsibleDiv = document.getElementById('responsible_div');

        // Show/hide responsible div based on the selected role
        function toggleResponsibleDiv() {
            const selectedRole = rolesSelect.value;
            if (selectedRole === 'Admin' || selectedRole === 'Commercial') {
                responsibleDiv.style.display = 'block';
            } else {
                responsibleDiv.style.display = 'none';
            }
        }

        // Initial check on page load
        toggleResponsibleDiv();

        // Check on role change
        rolesSelect.addEventListener('change', toggleResponsibleDiv);
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\scasco_reports\resources\views/usermanagement/user_update.blade.php ENDPATH**/ ?>