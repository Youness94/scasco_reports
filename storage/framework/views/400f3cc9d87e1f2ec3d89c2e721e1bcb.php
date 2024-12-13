
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('Modifier position'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> <a href="<?php echo e(route('all.positions')); ?>">Les Positions</a> <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Modifier Position <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<?php echo Toastr::message(); ?>


<div class="page-wrapper">
      <div class="content container-fluid">

            <div class="page-header mb-3 mb-lg-4 mt-3">

            </div>

            <!-- <div class="row"> -->

            <!-- <div class="col-xxl-12"> -->
            <!-- <div class="card">
                              <div class="card-body d-flex flex-column">-->
            <!-- <div class="live-preview flex-grow-1"> -->
            <form method="POST" action="<?php echo e(route('update.objective', ['id' => $objective->id])); ?>" class="forms-sample" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>

                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-header">Objectif</div>

                                    <div class="card-body d-flex flex-column">
                                          <div class="live-preview flex-grow-1">
                                                <div class="row">
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="year_objective">Objectif</label>
                                                            <input type="number" class="form-control <?php $__errorArgs = ['year_objective'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="year_objective" value="<?php echo e(old('year_objective', $objective->year_objective)); ?>">
                                                            <?php $__errorArgs = ['year_objective'];
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

                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="commercial_id">Chargé d'affaire</label>
                                                            <select name="commercial_id" id="commercial_id" class="form-control">
                                                                  <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                  <option value="<?php echo e($user->id); ?>" <?php echo e(old('commercial_id', $objective->commercial_id) == $user->id ? 'selected' : ''); ?>>
                                                                        <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                                                                  </option>
                                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['commercial_id'];
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

                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="objective_status">Status de l'Objectif</label>
                                                            <select name="objective_status" id="objective_status" class="form-control">
                                                                  <?php $__currentLoopData = $objective_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                  <option value="<?php echo e($status); ?>" <?php echo e(old('objective_status', $objective->objective_status) == $status ? 'selected' : ''); ?>>
                                                                        <?php echo e(ucfirst($status)); ?> <!-- Capitalize status for better readability -->
                                                                  </option>
                                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['objective_status'];
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

                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="year">L'année d'objectif</label>
                                                            <input type="text" name="year" value="<?php echo e(date('Y')); ?>" class="form-control" readonly>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>

                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-body d-flex flex-row">
                                          <div class="flex-grow-1">
                                          </div>
                                          <div class="d-flex justify-content-end">
                                                <button class="btn btn-primary" type="submit">Submit</button>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </form>
            <!-- </div>

                              </div>-->
            <!-- </div> -->
      </div> <!-- end col -->
</div><!--end row-->


</div>
</div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/js/pages/profile-setting.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\scasco_reports\resources\views/objectives/edit_objective.blade.php ENDPATH**/ ?>