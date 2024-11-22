
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('Créer devis'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> <a href="<?php echo e(route('all.quotes')); ?>">Les Devis</a> <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Créer Devis <?php $__env->endSlot(); ?>
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
            <form method="POST" action="<?php echo e(route('store.quote')); ?>" class="forms-sample" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>
                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-header">Informations Client</div>

                                    <div class="card-body d-flex flex-column">
                                          <div class="live-preview flex-grow-1">
                                                <div class="row">
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
                                                                  <option value="<?php echo e($city->id); ?>" <?php echo e(old('city_id') == $city->id ? 'selected' : ''); ?>>
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
                                                      <div class="col-md-4 mb-3">

                                                            <label class="form-label" for="address_line">Address</label>
                                                            <input type="text" class="form-control <?php $__errorArgs = ['address_line'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="address_line" value="<?php echo e(old('address_line')); ?>">
                                                      </div>

                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="payment_method_id">Méthode de paiement</label>
                                                            <select id="payment_method_id" class="form-control <?php $__errorArgs = ['payment_method_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="payment_method_id">
                                                                  <option selected disabled value="">choisissez une méthode</option>
                                                                  <?php $__currentLoopData = $payment_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                  <option value="<?php echo e($payment_method->id); ?>" <?php echo e(old('payment_method_id') == $payment_method->id ? 'selected' : ''); ?>>
                                                                        <?php echo e($payment_method->name); ?>

                                                                  </option>
                                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['payment_method_id'];
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
                                                      <div id="quantity-section" class="col-md-6 mb-3" style="display: none;">
                                                            <label class="form-label">Détails des Chèques</label>
                                                            <div class="row">
                                                                  <div class="col-md-4 mb-3">
                                                                        <!-- <label class="form-label">Quantité de Chèques</label> -->
                                                                        <input type="number" class="form-control" name="cheque_quantity" placeholder="Entrez le nombre de chèques">
                                                                  </div>
                                                            </div>
                                                            <div id="quantity-inputs"></div>
                                                      </div>

                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>

                  <div class="col-md-12">
                        <div class="card">
                              <div class="card-header">Informations de devis</div>

                              <div class="card-body d-flex flex-column">
                                    <div class="live-preview flex-grow-1">
                                          <div class="row">
                                                <div class="col-md-4 mb-3">
                                                      <label class="form-label" for="date_effet">Date effet</label>
                                                      <input type="date" class="form-control <?php $__errorArgs = ['date_effet'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="date_effet" value="<?php echo e(old('date_effet')); ?>">
                                                      <?php $__errorArgs = ['date_effet'];
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
                                                      <label class="form-label" for="date_echeance">Date echeance</label>
                                                      <input type="date" class="form-control <?php $__errorArgs = ['date_echeance'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="date_echeance" value="<?php echo e(old('date_echeance')); ?>">
                                                      <?php $__errorArgs = ['date_echeance'];
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
                                                      <label class="form-label" for="prorata_days">Prorata en J</label>
                                                      <input type="number" class="form-control <?php $__errorArgs = ['prorata_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="prorata_days" placeholder="prorata J" value="<?php echo e(old('prorata_days')); ?>" readonly>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="date_MEC">Date MEC</label>
                                                      <input type="date" class="form-control <?php $__errorArgs = ['date_MEC'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="date_MEC" placeholder="valeur venale" value="<?php echo e(old('date_MEC')); ?>">
                                                      <?php $__errorArgs = ['date_MEC'];
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

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="age_du_vehicule_by_years">Âge du véhicule (Années)</label>
                                                      <input type="number" class="form-control <?php $__errorArgs = ['age_du_vehicule_by_years'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="age_du_vehicule_by_years" placeholder="Âge du véhicule (Années)" value="<?php echo e(old('age_du_vehicule_by_years')); ?>" readonly>
                                                </div>


                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label" for="valeur_neuf">Valeur à neuf</label>
                                                      <input type="number" class="form-control <?php $__errorArgs = ['valeur_neuf'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="valeur_neuf" id="valeur_neuf" value="<?php echo e(old('valeur_neuf')); ?>">

                                                </div>

                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label" for="valeur_venale">Valeur venale</label>
                                                      <input type="number" class="form-control <?php $__errorArgs = ['valeur_venale'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="valeur_venale" value="<?php echo e(old('valeur_venale')); ?>">
                                                      <?php $__errorArgs = ['valeur_venale'];
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

                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label" for="valeur_glaces">Valeur glaces</label>
                                                      <input type="number" class="form-control <?php $__errorArgs = ['valeur_glaces'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="valeur_glaces" id="valeur_glaces" value="<?php echo e(old('valeur_glaces')); ?>">
                                                      <?php $__errorArgs = ['valeur_glaces'];
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
                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label" for="valeur_glaces">Valeur retroviseurs</label>
                                                      <input type="number" class="form-control <?php $__errorArgs = ['valeur_retroviseurs'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="valeur_retroviseurs" name="valeur_retroviseurs" value="<?php echo e(old('valeur_retroviseurs')); ?>">
                                                      <?php $__errorArgs = ['valeur_retroviseurs'];
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

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="energie">Type de energie</label>
                                                      <select id="energie" class="form-control <?php $__errorArgs = ['energie'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="energie">
                                                            <option value="DIESEL" <?php echo e(old('energie') == 'DIESEL' ? 'selected' : ''); ?>>DIESEL</option>
                                                            <option value="ESSENCE" <?php echo e(old('energie') == 'ESSENCE' ? 'selected' : ''); ?>>ESSENCE</option>
                                                            <option value="HYBRIDE" <?php echo e(old('energie') == 'HYBRIDE' ? 'selected' : ''); ?>>HYBRIDE</option>
                                                            <option value="ELECTRIQUE" <?php echo e(old('energie') == 'ELECTRIQUE' ? 'selected' : ''); ?>>ELECTRIQUE</option>
                                                      </select>
                                                      <?php $__errorArgs = ['energie'];
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

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="puissance_fiscale">Type de energie</label>
                                                      <select id="puissance_fiscale" class="form-control <?php $__errorArgs = ['puissance_fiscale'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="puissance_fiscale">
                                                            <option value="1" <?php echo e(old('puissance_fiscale') == '1' ? 'selected' : ''); ?>>1</option>
                                                            <option value="2" <?php echo e(old('puissance_fiscale') == '2' ? 'selected' : ''); ?>>2</option>
                                                            <option value="3" <?php echo e(old('puissance_fiscale') == '3' ? 'selected' : ''); ?>>3</option>
                                                            <option value="4" <?php echo e(old('puissance_fiscale') == '4' ? 'selected' : ''); ?>>4</option>
                                                            <option value="5" <?php echo e(old('puissance_fiscale') == '5' ? 'selected' : ''); ?>>5</option>
                                                            <option value="6" <?php echo e(old('puissance_fiscale') == '6' ? 'selected' : ''); ?>>6</option>
                                                            <option value="7" <?php echo e(old('puissance_fiscale') == '7' ? 'selected' : ''); ?>>7</option>
                                                            <option value="8" <?php echo e(old('puissance_fiscale') == '8' ? 'selected' : ''); ?>>8</option>
                                                            <option value="9" <?php echo e(old('puissance_fiscale') == '9' ? 'selected' : ''); ?>>9</option>
                                                            <option value="10" <?php echo e(old('puissance_fiscale') == '10' ? 'selected' : ''); ?>>10</option>
                                                            <option value="11" <?php echo e(old('puissance_fiscale') == '11' ? 'selected' : ''); ?>>11</option>
                                                      </select>
                                                      <?php $__errorArgs = ['energie'];
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
                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="vol">Vol</label>
                                                      <select id="vol" class="form-control <?php $__errorArgs = ['vol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="vol">
                                                            <option value="0" <?php echo e(old('vol') == '0' ? 'selected' : ''); ?>>Non</option>
                                                            <option value="1" <?php echo e(old('vol') == '1' ? 'selected' : ''); ?>>Oui</option>

                                                      </select>
                                                      <?php $__errorArgs = ['vol'];
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
                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="bris_de_glace">Bris de glace</label>
                                                      <select id="bris_de_glace" class="form-control <?php $__errorArgs = ['bris_de_glace'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="bris_de_glace">
                                                            <option value="0" <?php echo e(old('bris_de_glace') == '0' ? 'selected' : ''); ?>>Non</option>
                                                            <option value="1" <?php echo e(old('bris_de_glace') == '1' ? 'selected' : ''); ?>>Oui</option>

                                                      </select>
                                                      <?php $__errorArgs = ['bris_de_glace'];
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

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="dommage_collision">Dommage collision</label>
                                                      <select id="dommage_collision" class="form-control <?php $__errorArgs = ['dommage_collision'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="dommage_collision">
                                                            <option value="0" <?php echo e(old('dommage_collision') == '0' ? 'selected' : ''); ?>>Non</option>
                                                            <option value="1" <?php echo e(old('dommage_collision') == '1' ? 'selected' : ''); ?>>Oui</option>
                                                      </select>
                                                      <?php $__errorArgs = ['dommage_collision'];
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

                                                <div class="col-md-6 mb-3" id="dommage_collision_value_container" style="display: none;">
                                                      <label class="form-label" for="dommage_collision_value">Plafond DC</label>
                                                      <select id="dommage_collision_value" class="form-control <?php $__errorArgs = ['dommage_collision_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="dommage_collision_value">
                                                            <option value="10000" <?php echo e(old('dommage_collision_value') == '10000' ? 'selected' : ''); ?>>10,000</option>
                                                            <option value="20000" <?php echo e(old('dommage_collision_value') == '20000' ? 'selected' : ''); ?>>20,000</option>
                                                            <option value="30000" <?php echo e(old('dommage_collision_value') == '30000' ? 'selected' : ''); ?>>30,000</option>
                                                            <option value="40000" <?php echo e(old('dommage_collision_value') == '40000' ? 'selected' : ''); ?>>40,000</option>
                                                            <option value="50000" <?php echo e(old('dommage_collision_value') == '50000' ? 'selected' : ''); ?>>50,000</option>
                                                      </select>
                                                      <?php $__errorArgs = ['dommage_collision_value'];
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

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="tierce">Tierce</label>
                                                      <select id="tierce" class="form-control <?php $__errorArgs = ['tierce'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="tierce">
                                                            <option value="0" <?php echo e(old('tierce') == '0' ? 'selected' : ''); ?>>Non</option>
                                                            <option value="1" <?php echo e(old('tierce') == '1' ? 'selected' : ''); ?>>Oui</option>
                                                      </select>
                                                      <?php $__errorArgs = ['tierce'];
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

                                                <div class="col-md-6 mb-3" id="tierce_value_container" style="display: none;">
                                                      <label class="form-label" for="tierce_value">Valeur de tierce</label>
                                                      <select id="tierce_value" class="form-control <?php $__errorArgs = ['tierce_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="tierce_value">
                                                            <option value="0.03" <?php echo e(old('tierce_value') == '0.03' ? 'selected' : ''); ?>>3%</option>
                                                            <option value="0.05" <?php echo e(old('tierce_value') == '0.05' ? 'selected' : ''); ?>>5%</option>
                                                            <option value="0.1" <?php echo e(old('tierce_value') == '0.1' ? 'selected' : ''); ?>>10%</option>
                                                            <option value="0.15" <?php echo e(old('tierce_value') == '0.15' ? 'selected' : ''); ?>>15%</option>
                                                            <option value="0.2" <?php echo e(old('tierce_value') == '0.2' ? 'selected' : ''); ?>>20%</option>
                                                      </select>
                                                      <?php $__errorArgs = ['tierce_value'];
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

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="assistance">Assistance</label>
                                                      <select id="assistance" class="form-control <?php $__errorArgs = ['assistance'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="assistance">
                                                            <option value="0" <?php echo e(old('assistance') == '0' ? 'selected' : ''); ?>>Non</option>
                                                            <option value="1" <?php echo e(old('assistance') == '1' ? 'selected' : ''); ?>>Oui</option>
                                                      </select>
                                                      <?php $__errorArgs = ['assistance'];
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

                                                <div class="col-md-6 mb-3" id="assistance_type_container" style="display: none;">
                                                      <label class="form-label" for="assistance_type">Type d'assistance</label>
                                                      <select id="assistance_type" class="form-control <?php $__errorArgs = ['assistance_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="assistance_type">
                                                            <option value="basique" <?php echo e(old('assistance_type') == 'basique' ? 'selected' : ''); ?>>Basique</option>
                                                            <option value="economique" <?php echo e(old('assistance_type') == 'economique' ? 'selected' : ''); ?>>Economique</option>
                                                            <option value="standard" <?php echo e(old('assistance_type') == 'standard' ? 'selected' : ''); ?>>Standard</option>
                                                            <option value="elargie" <?php echo e(old('assistance_type') == 'elargie' ? 'selected' : ''); ?>>Elargie</option>
                                                            <option value="gold" <?php echo e(old('assistance_type') == 'gold' ? 'selected' : ''); ?>>Gold</option>
                                                            <option value="vip" <?php echo e(old('assistance_type') == 'vip' ? 'selected' : ''); ?>>VIP</option>
                                                      </select>
                                                      <?php $__errorArgs = ['assistance_type'];
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



                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="rachat_de_vetustes">Rachat de vetustes</label>
                                                      <select class="form-control <?php $__errorArgs = ['rachat_de_vetustes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="rachat_de_vetustes" id="rachat_de_vetustes">
                                                            <option value="0" <?php echo e(old('rachat_de_vetustes') == '0' ? 'selected' : ''); ?>>Non</option>
                                                            <option value="1" <?php echo e(old('rachat_de_vetustes') == '1' ? 'selected' : ''); ?>>Oui</option>

                                                      </select>
                                                      <?php $__errorArgs = ['rachat_de_vetustes'];
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

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="perte_financiere">Perte financiere</label>
                                                      <select class="form-control <?php $__errorArgs = ['perte_financiere'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="perte_financiere" id="perte_financiere">
                                                            <option value="0" <?php echo e(old('perte_financiere') == '0' ? 'selected' : ''); ?>>Non</option>
                                                            <option value="1" <?php echo e(old('perte_financiere') == '1' ? 'selected' : ''); ?>>Oui</option>

                                                      </select>
                                                      <?php $__errorArgs = ['perte_financiere'];
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

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="innondations">Innondations</label>
                                                      <select id="innondations" class="form-control <?php $__errorArgs = ['innondations'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="innondations">
                                                            <option value="0" <?php echo e(old('innondations') == '0' ? 'selected' : ''); ?>>Non</option>
                                                            <option value="1" <?php echo e(old('innondations') == '1' ? 'selected' : ''); ?>>Oui</option>

                                                      </select>
                                                      <?php $__errorArgs = ['innondations'];
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



                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="dommage_collision_deplafonnee">Dommage collision déplafonnée</label>
                                                      <select id="dommage_collision_deplafonnee" class="form-control <?php $__errorArgs = ['dommage_collision_deplafonnee'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="dommage_collision_deplafonnee">
                                                            <option value="0" <?php echo e(old('dommage_collision_deplafonnee') == '0' ? 'selected' : ''); ?>>Non</option>
                                                            <option value="1" <?php echo e(old('dommage_collision_deplafonnee') == '1' ? 'selected' : ''); ?>>Oui</option>

                                                      </select>
                                                      <?php $__errorArgs = ['dommage_collision_deplafonnee'];
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

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="protection_des_passagers">Protection des passagers</label>
                                                      <select id="protection_des_passagers" class="form-control <?php $__errorArgs = ['protection_des_passagers'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="protection_des_passagers">
                                                            <option value="0" <?php echo e(old('protection_des_passagers') == '0' ? 'selected' : ''); ?>>Non</option>
                                                            <option value="1" <?php echo e(old('protection_des_passagers') == '1' ? 'selected' : ''); ?>>Oui</option>

                                                      </select>
                                                      <?php $__errorArgs = ['protection_des_passagers'];
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
                                                <div class="col-md-6 mb-3" id="protection_des_passagers_formule_container" style="display: none;">
                                                      <label class="form-label" for="protection_des_passagers_formule">Type de formule</label>
                                                      <select id="protection_des_passagers_formule" class="form-control <?php $__errorArgs = ['protection_des_passagers_formule'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="protection_des_passagers_formule">
                                                            <option value="formule 1" <?php echo e(old('protection_des_passagers_formule') == 'formule 1' ? 'selected' : ''); ?>>formule 1</option>
                                                            <option value="formule 2" <?php echo e(old('protection_des_passagers_formule') == 'formule 2' ? 'selected' : ''); ?>>formule 2</option>
                                                            <option value="formule 3" <?php echo e(old('protection_des_passagers_formule') == 'formule 3' ? 'selected' : ''); ?>>formule 3</option>
                                                      </select>
                                                      <?php $__errorArgs = ['protection_des_passagers_formule'];
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

<script>
      document.addEventListener('DOMContentLoaded', function() {
            function calculateVehicleAge() {
                  const dateMEC = new Date(document.querySelector('input[name="date_MEC"]').value);
                  const currentDate = new Date();

                  if (!isNaN(dateMEC.getTime())) {
                        const timeDifference = currentDate - dateMEC;
                        const daysDifference = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                        const ageInYears = daysDifference / 365.25; // Using 365.25 for more accurate year calculation
                        document.querySelector('input[name="age_du_vehicule_by_years"]').value = ageInYears.toFixed(2); // Format to 2 decimal places
                  } else {
                        document.querySelector('input[name="age_du_vehicule_by_years"]').value = '';
                  }
            }

            document.querySelector('input[name="date_MEC"]').addEventListener('change', calculateVehicleAge);
      });
</script>
<script>
      document.addEventListener('DOMContentLoaded', function() {
            function calculateProrataDays() {
                  const dateEffetInput = document.querySelector('input[name="date_effet"]');
                  const dateEcheanceInput = document.querySelector('input[name="date_echeance"]');

                  const dateEffet = new Date(dateEffetInput.value);
                  const dateEcheance = new Date(dateEcheanceInput.value);

                  // Check if both dates are valid
                  if (!isNaN(dateEffet.getTime()) && !isNaN(dateEcheance.getTime())) {
                        const timeDifference = dateEcheance - dateEffet; // Difference in milliseconds
                        const prorataDays = Math.floor(timeDifference / (1000 * 60 * 60 * 24)); // Convert to days

                        document.querySelector('input[name="prorata_days"]').value = prorataDays; // Update input with the result
                  } else {
                        document.querySelector('input[name="prorata_days"]').value = ''; // Clear input if dates are invalid
                  }
            }

            // Event listeners for date input changes
            document.querySelector('input[name="date_effet"]').addEventListener('change', calculateProrataDays);
            document.querySelector('input[name="date_echeance"]').addEventListener('change', calculateProrataDays);
      });
</script>
<script>
      document.addEventListener('DOMContentLoaded', function() {
            function toggleVisibility(selectId, containerId) {
                  const selectElement = document.querySelector(selectId);
                  const containerElement = document.querySelector(containerId);
                  if (selectElement.value === '1') {
                        containerElement.style.display = 'block';
                  } else {
                        containerElement.style.display = 'none';
                  }
            }

            // Initial check on page load
            toggleVisibility('#dommage_collision', '#dommage_collision_value_container');
            toggleVisibility('#tierce', '#tierce_value_container');
            toggleVisibility('#assistance', '#assistance_type_container');
            toggleVisibility('#protection_des_passagers', '#protection_des_passagers_formule_container');

            // Event listeners for change
            document.querySelector('#dommage_collision').addEventListener('change', function() {
                  toggleVisibility('#dommage_collision', '#dommage_collision_value_container');
            });

            document.querySelector('#tierce').addEventListener('change', function() {
                  toggleVisibility('#tierce', '#tierce_value_container');
            });

            document.querySelector('#assistance').addEventListener('change', function() {
                  toggleVisibility('#assistance', '#assistance_type_container');
            });
            document.querySelector('#protection_des_passagers').addEventListener('change', function() {
                  toggleVisibility('#protection_des_passagers', '#protection_des_passagers_formule_container');
            });
      });
</script>


<script>
      document.addEventListener('DOMContentLoaded', function() {
            const paymentMethodSelect = document.getElementById('payment_method_id');
            const quantitySection = document.getElementById('quantity-section');
            const quantityInput = document.querySelector('input[name="cheque_quantity"]');
            const quantityInputsContainer = document.getElementById('quantity-inputs');

            paymentMethodSelect.addEventListener('change', function() {
                  const selectedOption = this.options[this.selectedIndex].text.toLowerCase();

                  if (selectedOption === 'chèque') {
                        quantitySection.style.display = 'block'; // Show the quantity section

                        quantityInput.addEventListener('input', function() {
                              const quantity = parseInt(this.value, 10); // Parse input to an integer
                              quantityInputsContainer.innerHTML = ''; // Clear previous inputs

                              if (quantity && !isNaN(quantity) && quantity > 0) {
                                    for (let i = 1; i <= quantity; i++) {
                                          // Create cheque number input
                                          const numberInput = document.createElement('input');
                                          numberInput.type = 'text';
                                          numberInput.name = `cheques[${i}][cheque_number]`;
                                          numberInput.placeholder = `Le numéro chèque ${i}`;
                                          numberInput.classList.add('form-control', 'mb-2');

                                          // Create cheque date input
                                          const dateInput = document.createElement('input');
                                          dateInput.type = 'date';
                                          dateInput.name = `cheques[${i}][cheque_date]`;
                                          dateInput.classList.add('form-control', 'mb-2');

                                          // Wrap inputs in a group
                                          const inputGroup = document.createElement('div');
                                          inputGroup.classList.add('row', 'mb-3');
                                          inputGroup.innerHTML = `
                            <div class="col-md-4">
                                ${numberInput.outerHTML}
                            </div>
                            <div class="col-md-3">
                                ${dateInput.outerHTML}
                            </div>
                        `;

                                          // Append to container
                                          quantityInputsContainer.appendChild(inputGroup);
                                    }
                              }
                        });
                  } else {
                        quantitySection.style.display = 'none'; // Hide the quantity section
                        quantityInputsContainer.innerHTML = ''; // Clear all inputs
                  }
            });
      });
</script>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/js/pages/profile-setting.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\scasco-ANCFCC-devis\resources\views/quotes/add_quote.blade.php ENDPATH**/ ?>