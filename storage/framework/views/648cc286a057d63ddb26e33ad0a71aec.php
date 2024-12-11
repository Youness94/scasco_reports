
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
                                                      <div class="col-md-3 mb-3">
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
                                                      <div class="col-md-3 mb-3">
                                                            <label class="form-label" for="year_objective">Nom d'affaire</label>
                                                            <input type="text" class="form-control <?php $__errorArgs = ['case_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="case_name" value="<?php echo e($potentialCase->case_name); ?>">
                                                            <?php $__errorArgs = ['case_name'];
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
                                                      <!-- Select branches -->
                                                      <div class="col-md-3 mb-3">
                                                            <label class="form-label" for="branches">Sélectionner les branches</label>
                                                            <select id="branches" name="branches[]" class="form-control <?php $__errorArgs = ['branches'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" multiple>
                                                                  <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branche): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                  <option value="<?php echo e($branche->id); ?>"
                                                                        <?php echo e(in_array($branche->id, old('branches', $potentialCase->branches->pluck('id')->toArray())) ? 'selected' : ''); ?>>
                                                                        <?php echo e($branche->name); ?>

                                                                  </option>
                                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['branches'];
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

                                                      <!-- Container for dynamically added branch_ca input fields -->
                                                      <div id="branch-ca-inputs" class="col-md-3 mb-3"></div>




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

        $('#branches').select2({
            placeholder: "Sélectionner les branches",
            closeOnSelect: false,
            templateResult: formatState,
            templateSelection: formatState
        });


        function formatState(opt) {
            if (!opt.id) {
                return opt.text;
            }
            var optimage = $(opt.element).data('image');
            var $opt = $('<span></span>');

            if (optimage) {
                $opt.append( opt.text);
            } else {
                $opt.append( opt.text);
            }
            return $opt;
        }

        function generateBranchCAInputs() {
            var selectedBranches = $('#branches').val();
            var container = $('#branch-ca-inputs');
            container.empty();

            selectedBranches.forEach(function(branchId) {

                var branchName = getBranchName(branchId);
                var branchCaValue = getBranchCAValue(branchId); 

                var inputHtml = `
                   <div class="mb-3">
                       <label for="branch_ca_${branchId}"> CA for ${branchName}</label>
                        <input type="number" id="branch_ca_${branchId}" name="branch_ca[${branchId}]" class="form-control" placeholder="Enter CA for ${branchName}" min=".01" step=".01" value="${branchCaValue}">
                    </div>
                `;
                container.append(inputHtml);
            });
        }

        function getBranchCAValue(branchId) {

            var branchCAData = <?php echo json_encode($potentialCase->branches->pluck('pivot.branch_ca', 'id'), 512) ?>;
            return branchCAData[branchId] || ''; 
        }

        function getBranchName(branchId) {

            var branchNames = <?php echo json_encode($potentialCase->branches->pluck('name', 'id'), 512) ?>;
            return branchNames[branchId] || 'Unknown Branch'; 
        }

        $('#branches').on('change', function() {
            generateBranchCAInputs();
        });

        generateBranchCAInputs();
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