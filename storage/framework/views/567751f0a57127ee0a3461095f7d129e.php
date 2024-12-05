
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('Modifier client'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> <a href="<?php echo e(route('all.clients')); ?>">Les Positions</a> <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Modifier Client <?php $__env->endSlot(); ?>
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
            <form method="POST" action="<?php echo e(route('update.client', ['id' => $client->id])); ?>" class="forms-sample" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>
                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-header">Client</div>

                                    <div class="card-body d-flex flex-column">
                                          <div class="live-preview flex-grow-1">
                                                <div class="row">
                                                      <!-- Client Type -->

                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_type">Type de client</label>
                                                            <select id="client_type" class="form-control <?php $__errorArgs = ['client_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="client_type">
                                                                  <option value="Particulier" <?php echo e(old('client_type',$client->client_type) == 'Particulier' ? 'selected' : ''); ?>>Particulier</option>
                                                                  <option value="Entreprise" <?php echo e(old('client_type',$client->client_type) == 'Entreprise' ? 'selected' : ''); ?>>Entreprise</option>
                                                            </select>
                                                            <?php $__errorArgs = ['Type de client'];
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

                                                      <!-- First Name -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_first_name">Prénom du Client</label>
                                                            <input type="text" class="form-control <?php $__errorArgs = ['client_first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="client_first_name" value="<?php echo e($client->client_first_name); ?>">
                                                            <?php $__errorArgs = ['client_first_name'];
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

                                                      <!-- Last Name -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_last_name">Nom du Client</label>
                                                            <input type="text" class="form-control <?php $__errorArgs = ['client_last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="client_last_name" value="<?php echo e($client->client_last_name); ?>">
                                                            <?php $__errorArgs = ['client_last_name'];
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

                                                      <!-- City -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="city_id">Ville</label>
                                                            <select id="city_id" class="form-control <?php $__errorArgs = ['city_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="city_id">
                                                                  <option selected disabled value="">Choisissez une ville</option>
                                                                  <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                  <option value="<?php echo e($city->id); ?>" <?php echo e(old('city_id',$client->city_id) == $city->id ? 'selected' : ''); ?>>
                                                                        <?php echo e($city->name); ?>

                                                                  </option>
                                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['city_id'];
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

                                                      <!-- Client Address -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_address">Adresse du Client</label>
                                                            <input type="text" class="form-control <?php $__errorArgs = ['client_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="client_address" value="<?php echo e($client->client_address); ?>">
                                                            <?php $__errorArgs = ['client_address'];
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

                                                      <!-- Client Phone -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_phone">Téléphone du Client</label>
                                                            <input type="text" class="form-control <?php $__errorArgs = ['client_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="client_phone" value="<?php echo e($client->client_phone); ?>">
                                                            <?php $__errorArgs = ['client_phone'];
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

                                                      <!-- Client Email -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_email">E-mail du Client</label>
                                                            <input type="email" class="form-control <?php $__errorArgs = ['client_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="client_email" value="<?php echo e($client->client_email); ?>">
                                                            <?php $__errorArgs = ['client_email'];
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

                                                      <!-- Raison Sociale -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="raison_sociale">Raison Sociale du Client</label>
                                                            <input type="text" class="form-control <?php $__errorArgs = ['raison_sociale'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="raison_sociale" value="<?php echo e($client->raison_sociale); ?>">
                                                            <?php $__errorArgs = ['raison_sociale'];
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

                                                      <!-- RC -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="RC">RC du Client</label>
                                                            <input type="text" class="form-control <?php $__errorArgs = ['RC'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="RC" value="<?php echo e($client->RC); ?>">
                                                            <?php $__errorArgs = ['RC'];
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

                                                      <!-- ICE -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="ICE">ICE du Client</label>
                                                            <input type="text" class="form-control <?php $__errorArgs = ['ICE'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="ICE" value="<?php echo e($client->ICE); ?>">
                                                            <?php $__errorArgs = ['ICE'];
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\scasco_reports\resources\views\clients\edit_client.blade.php ENDPATH**/ ?>