<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('Ajouter admin'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> <a href="<?php echo e(route('all.admins')); ?>">Admins</a> <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Ajouter admin <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<?php echo Toastr::message(); ?>


<div class="page-wrapper">
      <div class="content container-fluid">
            <div class="page-header mb-3 mb-lg-4 mt-3">
                  <!-- <div class="row align-items-center">
                        <div class="col-xl-8 col-sm-6 col-12 d-flex flex-column justify-content-center">
                              <h3 class="page-title">Ajouter admin</h3>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12 d-flex flex-column justify-content-center">
                              <ul class="breadcrumb ml-auto">
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('all.admins')); ?>">admins</a></li>
                                    <li class="breadcrumb-item active">Ajouter admin</li>
                              </ul>
                        </div>
                  </div> -->
            </div>

            <div class="row">
                  <div class="col-sm-12">
                        <div class="card comman-shadow">
                              <div class="card-header">Informations Admin</div>
                              <div class="card-body">
                                    
                                    <form method="POST" action="<?php echo e(route('store.admin')); ?>" class="forms-sample" enctype="multipart/form-data">
                                          <?php echo csrf_field(); ?>

                                          <div class="row">

                                                <div class="col-12 col-sm-4 mb-3">
                                                      <label>Prénom : <span class="login-danger">*</span></label>
                                                      <input type="text" class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="first_name" value="<?php echo e(old('first_name')); ?>">
                                                      <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> <?php echo e($message); ?> </span>
                                                      </span>
                                                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-12 col-sm-4 mb-3">
                                                      <label>Nom: <span class="login-danger">*</span></label>
                                                      <input type="text" class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="last_name" value="<?php echo e(old('last_name')); ?>">
                                                      <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> <?php echo e($message); ?> </span>
                                                      </span>
                                                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>

                                                <div class="col-12 col-sm-4 mb-3">
                                                      <label>E-mail: <span class="login-danger">*</span></label>
                                                      <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>">
                                                      <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> <?php echo e($message); ?> </span>
                                                      </span>
                                                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-12 col-sm-4 mb-3">
                                                      <label>Phone: <span class="login-danger">*</span></label>
                                                      <input type="number" class="form-control <?php $__errorArgs = ['phonenumber'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="phonenumber" value="<?php echo e(old('phonenumber')); ?>">
                                                      <?php $__errorArgs = ['phonenumber'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> <?php echo e($message); ?> </span>
                                                      </span>
                                                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-12 col-sm-4 mb-3">
                                                      <label>Role Name <span class="login-danger">*</span></label>
                                                      <select class="form-control select <?php $__errorArgs = ['roles'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="roles" id="roles" value="<?php echo e(old('roles')); ?>">
                                                            <option selected disabled>Role Type</option>
                                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($role); ?>"><?php echo e($role); ?></option>
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
                                                <!-- <option value="Partenaire Admin">Partenaire Admin</option>
                                                                  <option value="Partenaire Super Admin">Partenaire Super Admin</option> -->
                                                <!-- <div class="col-12 col-sm-4 mb-3">
                                                      <label for="">Roles</label>
                                                      <select name="roles" class="form-control" multiple>
                                                            <option value="">Select Role</option>
                                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($role); ?>"><?php echo e($role); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </select>
                                                      <?php $__errorArgs = ['role_name'];
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
                                                </div> -->


                                                <div class="col-12 col-sm-4 mb-3">
                                                      <label>Mot de Passe: <span class="login-danger">*</span></label>
                                                      <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" value="<?php echo e(old('password')); ?>">
                                                      <?php $__errorArgs = ['password'];
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

                                                <div class="col-12">
                                                      <div class="text-end">
                                                            <button type="submit" class="btn btn-primary">Soumettre</button>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\scasco_reports\resources\views/usermanagement/add_user.blade.php ENDPATH**/ ?>