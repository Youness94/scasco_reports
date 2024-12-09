
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('Modifier Affaire'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> <a href="<?php echo e(route('all.potential_cases')); ?>">Les Affaires</a> <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Modifier Affaire <?php $__env->endSlot(); ?>
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
            <form method="POST" action="<?php echo e(route('update.potential_case', ['id' => $potentialCase->id])); ?>" class="forms-sample" enctype="multipart/form-data">

                  <?php echo csrf_field(); ?>
                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-header">Modifier l'Affaire</div>
                                    <div class="card-body d-flex flex-column">
                                          <div class="live-preview flex-grow-1">
                                                <div class="row">
                                                      <!-- Select Client -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_id">Ville</label>
                                                            <select id="client_id" class="form-control <?php $__errorArgs = ['client_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="client_id">
                                                                  <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                  <option value="<?php echo e($client->id); ?>" <?php echo e(old('client_id', $potentialCase->client_id) == $client->id ? 'selected' : ''); ?>>
                                                                        <?php echo e($client->client_first_name); ?> <?php echo e($client->client_last_name); ?>

                                                                  </option>
                                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['client_id'];
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
                                                            <div class=" mt-3">
                                                                  <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                                                        id="create-btn" data-bs-target="#showModal"><i
                                                                              class="ri-add-line align-bottom me-1"></i> Ajouter Client</button>
                                                            </div>
                                                      </div>

                                                      <!-- Select Services -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="services">Sélectionner les Services</label>
                                                            <select id="services" name="services[]" class="form-control <?php $__errorArgs = ['services'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" multiple>
                                                                  <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                  <option value="<?php echo e($service->id); ?>"
                                                                        <?php echo e(in_array($service->id, old('services', $potentialCase->services->pluck('id')->toArray())) ? 'selected' : ''); ?>>
                                                                        <?php echo e($service->name); ?>

                                                                  </option>
                                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['services'];
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

                                                      <div id="branches-container" class="col-md-4 mb-3">
                                                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($potentialCase->services->contains('id', $service->id)): ?>
                                                            <div class="service-branches" data-service-id="<?php echo e($service->id); ?>">
                                                                  <label class="form-label">Branches pour <?php echo e($service->name); ?></label>
                                                                  <select name="branches[<?php echo e($service->id); ?>][]" class="form-control branches-select" multiple>
                                                                        <?php $__currentLoopData = $service->branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($branch->id); ?>"
                                                                              <?php if(in_array($branch->id, json_decode(optional($potentialCase->services->where('id', $service->id)->first())->pivot->branch_ids, true) ?? [])): ?>
                                                                              selected
                                                                              <?php endif; ?>>
                                                                              <?php echo e($branch->name); ?>

                                                                        </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                  </select>

                                                                  <!-- Amount Input for Each Branch -->
                                                                  <div class="amounts-container mt-3">
                                                                        <?php $__currentLoopData = $service->branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <div class="form-group branch-amount">
                                                                              <label for="amount_<?php echo e($branch->id); ?>">Montant pour <?php echo e($branch->name); ?></label>
                                                                              <input type="number" name="amounts[<?php echo e($service->id); ?>][<?php echo e($branch->id); ?>]"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(old('amounts.' . $service->id . '.' . $branch->id, 
                        json_decode(optional($potentialCase->services->where('id', $service->id)->first())->pivot->branch_data, true)[$branch->id] ?? '')); ?>">
                                                                        </div>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                  </div>
                                                            </div>
                                                            <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <!-- Add Client Modal -->

            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                              <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                          id="close-modal"></button>
                              </div>
                              <form class="tablelist-form" autocomplete="off" method="POST" action="<?php echo e(route('store.client.potential.case')); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="modal-body">
                                          <div>
                                                <label class="form-label" for="client_type">Type de client</label>
                                                <select id="client_type" class="form-control <?php $__errorArgs = ['client_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="client_type">
                                                      <option value="Particulier" <?php echo e(old('client_type') == 'Particulier' ? 'selected' : ''); ?>>Particulier</option>
                                                      <option value="Entreprise" <?php echo e(old('client_type') == 'Entreprise' ? 'selected' : ''); ?>>Entreprise</option>
                                                </select>
                                                <?php $__errorArgs = ['client_type'];
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

                                          <div class="mb-3">
                                                <label class="form-label" for="client_first_name">Prénom du Client</label>
                                                <input type="text" class="form-control <?php $__errorArgs = ['client_first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="client_first_name" value="<?php echo e(old('client_first_name')); ?>">
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

                                          <div class="mb-3">
                                                <label class="form-label" for="client_last_name">Nom du Client</label>
                                                <input type="text" class="form-control <?php $__errorArgs = ['client_last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="client_last_name" value="<?php echo e(old('client_last_name')); ?>">
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

                                          <div class="mb-3">
                                                <label class="form-label" for="city_id">Ville</label>
                                                <select id="city_id" class="js-example-basic-single form-control <?php $__errorArgs = ['city_id'];
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

                                          <div class="mb-3">
                                                <label class="form-label" for="client_address">Adresse du Client</label>
                                                <input type="text" class="form-control <?php $__errorArgs = ['client_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="client_address" value="<?php echo e(old('client_address')); ?>">
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

                                          <div class="mb-3">
                                                <label class="form-label" for="client_phone">Téléphone du Client</label>
                                                <input type="text" class="form-control <?php $__errorArgs = ['client_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="client_phone" value="<?php echo e(old('client_phone')); ?>">
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
                                          <div class="mb-3">
                                                <label class="form-label" for="client_email">E-mail du Client</label>
                                                <input type="email" class="form-control <?php $__errorArgs = ['client_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="client_email" value="<?php echo e(old('client_email')); ?>">
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
                                          <div class="mb-3">
                                                <label class="form-label" for="raison_sociale">Raison Sociale du Client</label>
                                                <input type="text" class="form-control <?php $__errorArgs = ['raison_sociale'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="raison_sociale" value="<?php echo e(old('raison_sociale')); ?>">
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
                                          <div class="mb-3">
                                                <label class="form-label" for="RC">RC du Client</label>
                                                <input type="text" class="form-control <?php $__errorArgs = ['RC'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="RC" value="<?php echo e(old('RC')); ?>">
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
                                          <div class="mb-3">
                                                <label class="form-label" for="ICE">ICE du Client</label>
                                                <input type="text" class="form-control <?php $__errorArgs = ['ICE'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="ICE" value="<?php echo e(old('ICE')); ?>">
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
                                    <div class="modal-footer">
                                          <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                                <button type="submit" class="btn btn-success" id="add-btn">Ajouter Client</button>
                                                <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                          </div>
                                    </div>
                              </form>
                        </div>
                  </div>
            </div>

            <!-- Modal -->
            <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                              <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                          id="btn-close"></button>
                              </div>
                              <div class="modal-body">
                                    <div class="mt-2 text-center">
                                          <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                          <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                <h4>Are you Sure ?</h4>
                                                <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                                          </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                          <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                          <button type="button" class="btn w-sm btn-danger " id="delete-record">Yes, Delete It!</button>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
            <!--end modal -->
      </div> <!-- end col -->
</div><!--end row-->


</div>
</div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<!--jquery cdn-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- Bootstrap JS (necessary for modal functionality) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="<?php echo e(URL::asset('build/js/pages/select2.init.js')); ?>"></script>

<script src="<?php echo e(URL::asset('build/js/pages/profile-setting.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<script>
      $(document).ready(function() {
            var branchesContainer = $('#branches-container');

            // Handle service selection changes
            $('#services').on('change', function() {
                  var selectedServiceIds = $(this).val();

                  // Remove deselected services' branches
                  branchesContainer.find('.service-branches').each(function() {
                        var serviceId = $(this).data('service-id').toString();
                        if (!selectedServiceIds.includes(serviceId)) {
                              removeBranchesFromService(serviceId);
                              $(this).remove();
                        }
                  });

                  // Add branches for newly selected services
                  selectedServiceIds.forEach(function(serviceId) {
                        if (branchesContainer.find(`.service-branches[data-service-id=${serviceId}]`).length === 0) {
                              addBranchesForService(serviceId);
                        }
                  });
            });

            // Add branches for a selected service
            function addBranchesForService(serviceId) {
                  $.ajax({
                        url: '/edit-branches-by-service',
                        method: 'GET',
                        data: {
                              service_id: serviceId
                        },
                        success: function(response) {
                              var branches = response.branches;
                              var serviceBranchesHtml = `
                    <div class="service-branches" data-service-id="${serviceId}">
                        <label class="form-label">Branches pour ${response.service_name}</label>
                        <select name="branches[${serviceId}][]" class="form-control" multiple>
                            ${branches.map(branch => `<option value="${branch.id}">${branch.name}</option>`).join('')}
                        </select>
                        <label class="form-label">Montant(s)</label>
                        <input type="text" name="amounts[${serviceId}][]" class="form-control" placeholder="Montant pour chaque branche">
                    </div>
                `;
                              branchesContainer.append(serviceBranchesHtml);
                        }
                  });
            }

            // Remove branches for a deselected service
            function removeBranchesFromService(serviceId) {
                  $.ajax({
                        url: '/remove-branches-from-service',
                        method: 'POST',
                        data: {
                              service_id: serviceId,
                              _token: '<?php echo e(csrf_token()); ?>'
                        },
                        success: function(response) {
                              if (response.success) {
                                    console.log(`Branches for service ID ${serviceId} removed successfully.`);
                              }
                        }
                  });
            }

            // Update branches and amounts for a selected service
            branchesContainer.on('change', 'select, input[name^="amounts"]', function() {
                  var serviceId = $(this).closest('.service-branches').data('service-id');
                  var selectedBranchIds = $(this).closest('.service-branches').find('select').val();
                  var amounts = [];

                  // Collect amounts entered for each branch
                  $(this).closest('.service-branches').find('input[name^="amounts"]').each(function() {
                        amounts.push($(this).val());
                  });

                  $.ajax({
                        url: '/update-branches-for-service',
                        method: 'POST',
                        data: {
                              service_id: serviceId,
                              branch_ids: selectedBranchIds,
                              amounts: amounts,
                              _token: '<?php echo e(csrf_token()); ?>'
                        },
                        success: function(response) {
                              if (response.success) {
                                    console.log(`Branches and amounts for service ID ${serviceId} updated successfully.`);
                              }
                        }
                  });
            });
      });
</script>
<script>
      $(document).ready(function() {
            // ==========
            $('#services').select2({
                  placeholder: "Sélectionner les Services",
                  width: '100%',
                  templateSelection: formatState,
                  templateResult: formatState,
                  closeOnSelect: false
            });

            // =================
            $('.branches-select').select2({
                  placeholder: "Sélectionner les Branches",
                  width: '100%',
                  templateSelection: formatState,
                  templateResult: formatState,
                  closeOnSelect: false
            });

            function formatState(opt) {
                  if (!opt.id) {
                        return opt.text;
                  }

                  var optimage = $(opt.element).data('image');
                  if (!optimage) {
                        return opt.text;
                  } else {
                        var $opt = $(
                              '<span><input type="checkbox" /> ' + opt.text + '</span>'
                        );
                        return $opt;
                  }
            }
      });
</script>
<script>
      $(document).ready(function() {
            // Handle Add Client Modal submission
            $('form.tablelist-form').on('submit', function(e) {
                  e.preventDefault();
                  var formData = new FormData(this);

                  $.ajax({
                        url: "<?php echo e(route('store.client.potential.case')); ?>", // Your controller method route
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                              if (response.status === 'success') {
                                    // Add the new client to the dropdown
                                    var newOption = new Option(response.client_name, response.client_id, true, true);
                                    $('#client_id').append(newOption).trigger('change');

                                    // Close the modal
                                    $('#showModal').modal('hide');

                                    // Optionally, show success message (using Toastr or alert)
                                    toastr.success(response.message);
                              } else {
                                    toastr.error(response.message); // Show error message
                              }
                        },
                        error: function(error) {
                              toastr.error('An error occurred while adding the client.');
                        }
                  });
            });
      });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\scasco_reports\resources\views/potential_cases/edit_potential_case.blade.php ENDPATH**/ ?>